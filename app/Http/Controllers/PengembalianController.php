<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeminjamanRequest;
use App\Peminjaman;
use Illuminate\Http\Request;
use DataTables;
use Date;
use App\Exports\PeminjamanExport;
use Excel;
use PDF;
use Cookie;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('check');
    }
    
    public function index()
    {
        $pengembalian = Peminjaman::where('tanggal_kembali', '!=', NULL)->get();

        return view('pages.pengembalian.index', compact('pengembalian'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.pengembalian.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PeminjamanRequest $request)
    {

        $target = \App\DetailPinjam::with(['peminjaman', 'inventaris'])->orderBy('created_at', 'desc')->where('id_inventaris', $request->id_inventaris)->where('jumlah', '>', 0)->first();
        $barang = $target->inventaris;

        if ($request->jumlah < 1) {
            return response()->json(['msg'=>'Jumlah tidak valid !'], 401);
        }

        if ($request->jumlah > $target->jumlah) {
            return response()->json(['msg'=>'Jumlah tidak sesuai !'], 401);
        }

        $target->update([
            'jumlah'=>$target->jumlah - $request->jumlah
        ]);

        $barang->update([
            'jumlah'=> $barang->jumlah + $request->jumlah
        ]);

        if ($target->jumlah === 0) {
            $target->peminjaman->update([
                'tanggal_kembali'=>Date::now()->format('Y-m-d'),
                'status_peminjaman'=>'Sudah Kembali',
            ]);
        }
        else{
            $target->peminjaman->update([
                'tanggal_kembali'=>Date::now()->format('Y-m-d'),
                'status_peminjaman'=>'Belum Kembali',
            ]);
        }

        return response()->json(['msg'=>'Peminjaman '.$target->peminjaman->pegawai->nama_pegawai.' telah dikembalikan sebanyak '.$request->jumlah]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function show(Peminjaman $pengembalian)
    {
        $data = Peminjaman::with(['detail', 'pegawai'])->findOrFail($pengembalian->id_peminjaman);

        return view('pages.pengembalian.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function edit(Peminjaman $pengembalian)
    {
        $data = Peminjaman::findOrFail($pengembalian->id_peminjaman);

        return view('pages.pengembalian.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function update(PeminjamanRequest $request, Peminjaman $pengembalian)
    {
        $target = Peminjaman::findOrFail($pengembalian->id_peminjaman);

        $barang = \App\Inventaris::where('id_inventaris', $request->id_inventaris)->first();

        $jumlah = NULL;
        $tgl_kembali = NULL;

        if ($request->jumlah < 1) {
            return response()->json(['msg'=>'Jumlah tidak valid !'], 401);
        }
        if ($request->status_peminjaman === 'Belum Kembali') {
            $tgl_kembali = NULL;
        }

            // jika jumlah lebih besar dari sebelumnya
            if ($request->jumlah >= $target->detail->jumlah) {
                $res = $request->jumlah - $target->detail->jumlah;

                if ($barang->jumlah >= $res) {
                    $barang->update([
                        'jumlah'=> $barang->jumlah - $res
                    ]);

                    $jumlah = $request->jumlah;

                    $response = [
                        'msg'=>'Peminjaman Berhasil Diedit'
                    ];
                }
                else{
                    // $jumlah = $target->detail->jumlah + $barang->jumlah;

                    // $barang->update([
                    //     'jumlah'=>0
                    // ]);

                    $response = [
                        'msg'=>'Jumlah melebihi stok barang !'
                    ];

                    return response()->json($response, 401);
                }
            }

            // jika jumlah lebih kecil dari sebelumnya
            else{
                $jumlah = $request->jumlah;

                $barang->update([
                    'jumlah'=> $barang->jumlah + ($target->detail->jumlah - $jumlah)
                ]);

                $response = [
                    'msg'=>'Peminjaman Berhasil Diedit'
                ];
            }

        //jika status sudah kembali
        // if ($request->status_peminjaman === 'Sudah Kembali') {
            
        //     if ($request->jumlah > $target->detail->jumlah || $request->jumlah < $target->detail->jumlah) {
        //         return response()->json(['msg'=>'Jumlah tidak sesuai dengan jumlah peminjaman'], 401);
        //     }   

        //     $barang->update([
        //         'jumlah'=>$barang->jumlah + $request->jumlah
        //     ]);

        //     $response = [
        //         'msg'=>'Peminjaman Sudah Dikembalikan'
        //     ];

        //     $tgl_kembali = Date::now()->format('Y-m-d');
        //     $jumlah = $request->jumlah;
        // }

        $target->update([
            'id_pegawai'=>$request->id_pegawai,
            'status_peminjaman'=>'Belum Kembali',
            'tanggal_kembali'=>$tgl_kembali
        ]);

        $target->detail->update([
            'id_inventaris'=>$request->id_inventaris,
            'jumlah'=>$jumlah
        ]);

        return response()->json($response);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Peminjaman $pengembalian)
    {
        $data = Peminjaman::findOrFail($pengembalian->id_peminjaman);
            
       // ambil barang
        $barang = \App\Inventaris::where('id_inventaris', $data->detail->id_inventaris)->first();

        $barang->update([
            'jumlah'=>$barang->jumlah + $data->detail->jumlah
        ]);

        $data->forceDelete();
        $data->delete();

        return response()->json(['msg'=>'Peminjaman '.$data->pegawai->nama_pegawai.' Berhasil Dihapus']);
    }

    public function datatables()
    {
        $pengembalian = Peminjaman::query()->with(['pegawai', 'detail'])->where('tanggal_kembali','!=', NULL)->get();

        return DataTables::of($pengembalian)->
        addColumn('pegawai', function($pengembalian){
            return $pengembalian->pegawai->nama_pegawai;
        })->
        addColumn('barang', function($pengembalian){
            if ($pengembalian->detail !== NULL) {
                return $pengembalian->detail->inventaris->nama;
            }
            else{
                return '-';
            }
        })->
        addColumn('sisa', function($pengembalian){
            if ($pengembalian->detail !== NULL) {
                return $pengembalian->detail->jumlah;
            }
            else{
                return '-';
            }
        })->
        addColumn('tgl_pinjam', function($pengembalian){
            return Date::parse($pengembalian->tanggal_pinjam)->format('d-m-Y');
        })->
        addColumn('tgl_kembali', function($pengembalian){
            if ($pengembalian->tanggal_kembali === NULL) {
                return '-';
            }
            return Date::parse($pengembalian->tanggal_kembali)->format('d-m-Y');
        })->
        addColumn('action', function($pengembalian){
            return view('layouts.partials.actions.pengembalian_action', [
                'model'=>$pengembalian,
                'url_show'=>route('pengembalian.show', $pengembalian->id_peminjaman),
                'url_edit'=>route('pengembalian.edit', $pengembalian->id_peminjaman),
                'url_delete'=>route('pengembalian.destroy', $pengembalian->id_peminjaman),
            ]);
        })->
        rawColumns(['action'])->
        addIndexColumn()->
        make(true);
    }

    public function search()
    {
        $q = request('q');

        if ($q !== null) {
            $pegawai = \App\Pegawai::where('id_pegawai', $q)->first();

            $data = Peminjaman::with(['detail'])->where('id_pegawai', $q)->get();

            if (count($data) > 0) {
                return view('pages.pengembalian.result', compact('data'));
            }

            return response()->json(['msg'=>$pegawai->nama_pegawai.' tidak memiliki peminjaman'], 401);
        }

    }

    public function excel()
    {
        return Excel::download(new PengembalianExport, 'pengembalian.xlsx');
    }

    public function pdf(){
        $pengembalian = Peminjaman::where('tanggal_kembali', '!=' , NULL)->with(['pegawai', 'detail'])->get();

        $pdf = PDF::loadView('layouts.partials.exports.pdf.pengembalian', compact('pengembalian'));

        return $pdf->download('pengembalian.pdf');
    }
}
