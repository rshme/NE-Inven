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

class PeminjamanController extends Controller
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
        $peminjaman = Peminjaman::where('tanggal_kembali', NULL)->get();

        return view('pages.peminjaman.index', compact('peminjaman'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.peminjaman.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PeminjamanRequest $request)
    {

        $tgl_pinjam = Date::now()->format('Y-m-d');

        $barang = \App\Inventaris::where('id_inventaris', $request->id_inventaris)->first();

        // $detail = \App\DetailPinjam::with(['peminjaman'])->where('id_inventaris', $request->id_inventaris)->where('jumlah', '>', 0)->orderBy('updated_at', 'desc')->first();

        // if ($detail) {
        //     $pegawai = $detail->peminjaman->id_pegawai;

        //     if ($request->id_pegawai == $pegawai) {
        //         return response()->json(['msg'=>'Barang '.$barang->nama.' belum dikembalikan oleh '.$detail->peminjaman->pegawai->nama_pegawai], 401);
        //     }

        // }

        if ($request->jumlah < 1) {
            return response()->json(['msg'=>'Jumlah tidak valid !'], 401);
        }



        if ($barang->jumlah >= $request->jumlah) {

            $peminjaman = Peminjaman::create([
            'id_pegawai'=>$request->id_pegawai,
            'tanggal_pinjam'=>$tgl_pinjam,
            'status_peminjaman'=>$request->status_peminjaman
            ]);

            $peminjaman->detail()->create([
                'id_peminjaman'=>$peminjaman->id_peminjaman,
                'id_inventaris'=>$request->id_inventaris,
                'jumlah'=> $request->jumlah
            ]);

            return response()->json([
                'msg'=>'Berhasil Meminjamkan Barang Kepada ' . $peminjaman->pegawai->nama_pegawai
            ]);
        }
        else{

            return response()->json(['msg'=>'Jumlah melebihi stok barang !'], 401);

            // if ($barang->jumlah > 0) {
            //     $peminjaman = Peminjaman::create([
            //     'id_pegawai'=>$request->id_pegawai,
            //     'tanggal_pinjam'=>$tgl_pinjam,
            //     ]);

            //     $peminjaman->detail()->create([
            //         'id_peminjaman'=>$peminjaman->id_peminjaman,
            //         'id_inventaris'=>$request->id_inventaris,
            //         'jumlah'=> $barang->jumlah
            //     ]);

            //     return response()->json(['msg'=>'Hanya Terpinjam '.$barang->jumlah.' Karena Barang Sudah Habis']);
            // }
            // else{
            //     return response()->json(['msg'=>'Stok Barang '.$barang->nama.' Sudah Habis'], 401);
            // }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function show(Peminjaman $peminjaman)
    {
        $data = Peminjaman::with(['detail', 'pegawai'])->findOrFail($peminjaman->id_peminjaman);

        return view('pages.peminjaman.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function edit(Peminjaman $peminjaman)
    {
        $data = Peminjaman::findOrFail($peminjaman->id_peminjaman);

        return view('pages.peminjaman.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function update(PeminjamanRequest $request, Peminjaman $peminjaman)
    {
        $target = Peminjaman::findOrFail($peminjaman->id_peminjaman);

        $barang = \App\Inventaris::where('id_inventaris', $request->id_inventaris)->first();

        $jumlah = NULL;
        $tgl_kembali = NULL;

            if ($request->jumlah < 1) {
                return response()->json(['msg'=>'Jumlah tidak valid !'], 401);
            }

            // jika barang ganti
            // if ($request->id_inventaris !== $target->detail->id_inventaris) {
            //     $before = \App\Inventaris::where('id_inventaris', $target->detail->id_inventaris)->first();
            //     $after = \App\Inventaris::where('id_inventaris', $request->id_inventaris)->first();

            //     if ($after->jumlah < $request->jumlah) {

            //        $response = [
            //             'msg'=>'Jumlah melebihi stok barang !'
            //         ];

            //         return response()->json($response, 401);
            //     }
                
            //     $before->update([
            //         'jumlah'=>$before->jumlah + $target->detail->jumlah
            //     ]);

            //     $after->update([
            //         'jumlah'=>$after->jumlah - $request->jumlah
            //     ]);
            // }

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

        // jika status sudah kembali
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
            'status_peminjaman'=>$request->status_peminjaman,
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
    public function destroy(Peminjaman $peminjaman)
    {
        $data = Peminjaman::findOrFail($peminjaman->id_peminjaman);

        // ambil barang
        $barang = \App\Inventaris::where('id_inventaris', $data->detail->id_inventaris)->first();

        $barang->update([
            'jumlah'=>$barang->jumlah + $data->detail->jumlah
        ]);

        $data->forceDelete();
        $data->delete();

        return response()->json(['msg'=>'Peminjaman '.$data->pegawai->nama_pegawai.' Berhasil Dihapus']);

        // if ($data->status_peminjaman === 'Sudah Kembali') {
            
        //     $data->forceDelete();
        //     $data->delete();

        //     return response()->json(['msg'=>'Peminjaman '.$data->pegawai->nama_pegawai.' Berhasil Dihapus']);
        // }
        // else{
        //     return response()->json(['msg'=>'Kembalikan Barang Terlebih Dahulu'], 401);
        // }
    }

    public function datatables()
    {
        $peminjaman = Peminjaman::query()->with(['pegawai', 'detail'])->where('tanggal_kembali', NULL)->get();

        return DataTables::of($peminjaman)->
        addColumn('pegawai', function($peminjaman){
            return $peminjaman->pegawai->nama_pegawai;
        })->
        addColumn('barang', function($peminjaman){
            if ($peminjaman->detail !== NULL) {
                return $peminjaman->detail->inventaris->nama;
            }
            else{
                return '-';
            }
        })->
        addColumn('jumlah', function($peminjaman){
            if ($peminjaman->detail !== NULL) {
                return $peminjaman->detail->jumlah;
            }
            else{
                return '-';
            }
        })->
        addColumn('tgl_pinjam', function($peminjaman){
            return Date::parse($peminjaman->tanggal_pinjam)->format('d-m-Y');
        })->
        addColumn('action', function($peminjaman){
            return view('layouts.partials.actions.peminjaman_action', [
                'model'=>$peminjaman,
                'url_show'=>route('peminjaman.show', $peminjaman->id_peminjaman),
                'url_edit'=>route('peminjaman.edit', $peminjaman->id_peminjaman),
                'url_delete'=>route('peminjaman.destroy', $peminjaman->id_peminjaman),
            ]);
        })->
        rawColumns(['action'])->
        addIndexColumn()->
        make(true);
    }

    public function excel()
    {
        return Excel::download(new PeminjamanExport, 'peminjaman.xlsx');
    }

    public function pdf(){
        $peminjaman = Peminjaman::with(['pegawai', 'detail'])->get();

        $pdf = PDF::loadView('layouts.partials.exports.pdf.peminjaman', compact('peminjaman'));

        return $pdf->download('peminjaman.pdf');
    }
}
