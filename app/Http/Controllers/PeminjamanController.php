<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeminjamanRequest;
use App\Peminjaman;
use Illuminate\Http\Request;
use DataTables;
use Date;
use App\Exports\PeminjamanExport;
use Excel;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $peminjaman = Peminjaman::all();

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
        $this->validate($request, [
            'id_pegawai'=>'required',
            'id_inventaris'=>'required',
            'jumlah'=>'required|integer',
        ]);

        $tgl_pinjam = Date::now()->format('Y-m-d');

        $barang = \App\Inventaris::where('id_inventaris', $request->id_inventaris)->first();

        if ($barang->jumlah > $request->jumlah) {

            $peminjaman = Peminjaman::create([
            'id_pegawai'=>$request->id_pegawai,
            'tanggal_pinjam'=>$tgl_pinjam,
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

            if ($barang->jumlah > 0) {
                $peminjaman = Peminjaman::create([
                'id_pegawai'=>$request->id_pegawai,
                'tanggal_pinjam'=>$tgl_pinjam,
                ]);

                $peminjaman->detail()->create([
                    'id_peminjaman'=>$peminjaman->id_peminjaman,
                    'id_inventaris'=>$request->id_inventaris,
                    'jumlah'=> $barang->jumlah
                ]);

                return response()->json(['msg'=>'Hanya Terpinjam '.$barang->jumlah.' Karena Barang Sudah Habis']);
            }
            else{
                return response()->json(['msg'=>'Stok Barang '.$barang->nama.' Sudah Habis'], 401);
            }
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

        // jika jumlah > dari jumlah sebelumnya
        if ($request->jumlah > $target->detail->jumlah) {
            if ($barang->jumlah > ($request->jumlah - $target->detail->jumlah)) {
               $barang->update([
                    'jumlah'=>$barang->jumlah - ($request->jumlah - $target->detail->jumlah) 
                ]);
            }
            else{
                $barang->update([
                    'jumlah'=>0
                ]);
            }
        }

        // jika jumlah < dari jumlah sebelumnya
        elseif($request->jumlah <= $target->detail->jumlah){

            if ($request->status_peminjaman === 'sudah_kembali' && $target->status_peminjaman !== 'sudah_kembali') {
               $barang->update([
                    'jumlah'=> $barang->jumlah + $request->jumlah
                ]);

            }

            else{
                $barang->update([
                    'jumlah'=> $barang->jumlah + ($target->detail->jumlah - $request->jumlah),
                ]);
            }
        }

        if ($barang->jumlah > $request->jumlah) {
            $data = $target->update([
            'id_pegawai'=>$request->id_pegawai,
            'status_peminjaman'=>$request->status_peminjaman,
            ]);

            $target->detail->update([
                'jumlah'=>$request->jumlah,
                'id_inventaris'=>$request->id_inventaris
            ]);

            if ($request->status_peminjaman === 'sudah_kembali') {
                    $target->update([
                        'tanggal_kembali'=> Date::now()->format('Y-m-d')
                    ]);
            }
            else{
                    $target->update([
                        'tanggal_kembali'=> NULL
                    ]);
                    $barang->update(['jumlah'=>$barang->jumlah - $request->jumlah]);
                }

            return response()->json(['msg'=>'Peminjaman Berhasil Diedit']);
        }

        else{
            if ($barang->jumlah > 0) {
                $data = $target->update([
                'id_pegawai'=>$request->id_pegawai,
                'status_peminjaman'=>$request->status_peminjaman,
                ]);

                $target->detail->update([
                    'jumlah'=>$request->jumlah,
                    'id_inventaris'=>$request->id_inventaris
                ]);

                if ($request->status_peminjaman === 'sudah_kembali') {
                    $target->update([
                        'tanggal_kembali'=> Date::now()->format('Y-m-d')
                    ]);
                }
                else{
                    $target->update([
                        'tanggal_kembali'=> NULL
                    ]);
                    $barang->update(['jumlah'=>$barang->jumlah - $request->jumlah]);
                }

                return response()->json(['msg'=>'Peminjaman Berhasil Diedit']);
            }
            else{
                return response()->json(['msg'=>'Barang Sudah Habis']);
            }
        }
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
            'jumlah'=> $barang->jumlah + $data->detail->jumlah
        ]);

        $data->forceDelete();
        $data->delete();

        return response()->json(['msg'=>'Peminjaman '.$data->pegawai->nama_pegawai.' Berhasil Dihapus']);
    }

    public function datatables()
    {
        $peminjaman = Peminjaman::query()->with(['pegawai', 'detail'])->get();

        return DataTables::of($peminjaman)->
        addColumn('pegawai', function($peminjaman){
            return $peminjaman->pegawai->nama_pegawai;
        })->
        addColumn('barang', function($peminjaman){
           return $peminjaman->detail->inventaris->nama;
        })->
        addColumn('jumlah', function($peminjaman){
            return $peminjaman->detail->jumlah;
        })->
        addColumn('tgl_pinjam', function($peminjaman){
            return Date::parse($peminjaman->tanggal_pinjam)->format('d-m-Y');
        })->
        addColumn('tgl_kembali', function($peminjaman){
            if ($peminjaman->tanggal_kembali === NULL) {
                return '-';
            }
            return Date::parse($peminjaman->tanggal_kembali)->format('d-m-Y');
        })->
        addColumn('status', function($peminjaman){
            if ($peminjaman->status_peminjaman === 'belum_kembali') {
                return 'Belum Kembali';
            }
            else if($peminjaman->status_peminjaman === 'sudah_kembali'){
                return 'Sudah Kembali';
            }
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
}
