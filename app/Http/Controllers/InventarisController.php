<?php

namespace App\Http\Controllers;

use App\Http\Requests\InventarisRequest as InvenReq;
use App\Http\Requests\PeriodeRequest;
use App\Inventaris;
use App\Jenis;
use App\Ruang;
use Illuminate\Http\Request;
use DataTables;
use Date;
use Excel;
use App\Exports\InvenExport;
use App\Exports\PeriodeInvenExport;
use PDF;

class InventarisController extends Controller
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
        $data = Inventaris::all();

        return view('pages.inventaris.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_ruang = Ruang::all();
        $all_jenis = Jenis::all();

        return view('pages.inventaris.create', ['all_ruang'=>$all_ruang, 'all_jenis'=>$all_jenis]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvenReq $request)
    {

        $find = Inventaris::where('nama', 'LIKE', '%'. $request->nama .'%')->first();

        $getdata = count(Inventaris::all());

        if ($getdata < 1) {
            $order = 1;
        }
        else{
            $order = $getdata + 1;
        }

        $inven = $request->all();

        $inven['kode_inventaris'] = 

        Date::now()->format('dmy')
        .'-'.
        \App\Jenis::where('id_jenis', $request->id_jenis)->first()['id_jenis']
        .'-'.
        \App\Ruang::where('id_ruang', $request->id_ruang)->first()['id_ruang']
        .'-'.
        auth()->user()->petugas->id_petugas
        .'-'. 
        $order;

        $inven['tanggal_register'] = Date::now()->format('Y-m-d');

        $inven['id_petugas'] = auth()->user()->petugas->id_petugas;

        if ($request->jumlah < 1) {
            return response()->json(['msg'=>'Jumlah tidak valid !'], 401);
        }

        if (!$find) {
            $data = Inventaris::create($inven);

            return response()->json(['msg'=>$data->nama . ' Telah Ditambahkan']);
        }
        return response()->json(['msg'=>'Nama Barang Sudah Ada'], 401);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inventaris  $inventaris
     * @return \Illuminate\Http\Response
     */
    public function show(Inventaris $inventari)
    {
        $data = Inventaris::with(['jenis', 'ruang', 'petugas'])->findOrFail($inventari->id_inventaris);

        $target = explode('-', $data->kode_inventaris);

        $target[1] = Jenis::where('id_jenis', $target[1])->first()['kode_jenis'];

        $target[2] = Ruang::where('id_ruang', $target[2])->first()['kode_ruang'];

        $kode = implode('-', $target);

        return view('pages.inventaris.show', ['data'=>$data, 'kode_inventaris'=>$kode]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inventaris  $inventaris
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventaris $inventari)
    {
        $data = Inventaris::with(['jenis', 'ruang', 'petugas'])->findOrFail($inventari->id_inventaris);

        return view('pages.inventaris.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inventaris  $inventaris
     * @return \Illuminate\Http\Response
     */
    public function update(InvenReq $request, Inventaris $inventari)
    {
        $inven = Inventaris::findOrFail($inventari->id_inventaris);

        $data = $request->all();

        $target = explode('-', $inven->kode_inventaris);

        $date = str_replace('-', '', Date::parse($request->tanggal_register)->format('dmy'));

        $target[0] = $date;

        $target[1] = $request->id_jenis;

        $target[2] = $request->id_ruang;

        $kode = implode('-', $target);

        $data['kode_inventaris'] = $kode;

        if ($request->jumlah < 1) {
            return response()->json(['msg'=>'Jumlah tidak valid !'], 401);
        }

        $inven->update($data);

        return response()->json(['msg'=>'Barang Berhasil Diubah']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inventaris  $inventaris
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventaris $inventari)
    {
        $data = Inventaris::with(['detail'])->findOrFail($inventari->id_inventaris);

        $detail = \App\DetailPinjam::orderBy('updated_at', 'desc')->where('id_inventaris', $inventari->id_inventaris)->first();

        if ($detail) {

            $peminjaman = \App\Peminjaman::where('id_peminjaman', $detail->id_peminjaman)->first();

            if ($peminjaman->status_peminjaman === 'Sudah Kembali') {

                $allDetail = \App\DetailPinjam::where('id_inventaris', $inventari->id_inventaris)->pluck('id_peminjaman');

                $allPeminjaman = \App\Peminjaman::whereIn('id_peminjaman', $allDetail)->get(['id_peminjaman']);

                $data->forceDelete();
                $data->delete();

                \App\Peminjaman::destroy($allPeminjaman->toArray());

                return response()->json(['msg'=>$data->nama.' berhasil dihapus']);

            }
            else if($peminjaman->status_peminjaman === 'Belum Kembali'){
                return response()->json(['msg'=>$data->nama.' sedang dipinjam !'], 401);
            }
        }

        else{
            $data->delete();
            
           return response()->json([
                'msg'=> 'Barang '.$data->nama.' Dihapus'
            ]);
        }
    }

    public function datatables()
    {
        $inventaris = Inventaris::query()->with(['jenis', 'ruang', 'petugas'])->get();

        return DataTables::of($inventaris)->
        addColumn('action', function($inventaris){
            return view('layouts.partials.actions.inventaris_action', [
                'model'=>$inventaris,
                'url_show'=>route('inventaris.show', $inventaris->id_inventaris),
                'url_edit'=>route('inventaris.edit', $inventaris->id_inventaris),
                'url_delete'=>route('inventaris.destroy', $inventaris->id_inventaris),
            ]);
        })->
        addColumn('jenis', function($inventaris){
            return $inventaris->jenis->nama_jenis;
        })->
        addColumn('ruang', function($inventaris){
            return $inventaris->ruang->nama_ruang;
        })->
        addColumn('petugas', function($inventaris){
            return $inventaris->petugas->nama_petugas;
        })->
        addColumn('kode', function($inventaris){
            $data = explode('-', $inventaris->kode_inventaris);

            // data[1] = id_jenis, data[2] = id_ruang

            $data[1] = Jenis::where('id_jenis', $data[1])->first()['kode_jenis'];

            $data[2] = Ruang::where('id_ruang', $data[2])->first()['kode_ruang'];

            return implode('-', $data);
        })->
        addColumn('tgl_register', function($inventaris){
            return Date::parse($inventaris->tanggal_register)->format('d-m-Y');
        })->
        addColumn('kondisi', function($inventaris){
            return ucfirst($inventaris->kondisi);
        })->
        rawColumns(['action'])->
        addIndexColumn()->
        make(true);
    }

    public function excel()
    {
        return Excel::download(new InvenExport, 'inventaris.xlsx');
    }

    public function excelPeriode(PeriodeRequest $request)
    {
        $begin = str_replace('-', '', Date::parse($request->begin)->format('dmy'));
        $until = str_replace('-','', Date::parse($request->until)->format('dmy'));
        return Excel::download(new PeriodeInvenExport($request->begin, $request->until), 'inventaris('.$begin.' - '.$until.').xlsx');
    }

    public function pdf()
    {
        $inventaris = Inventaris::with(['petugas', 'jenis', 'ruang'])->get();

        $pdf = PDF::loadView('layouts.partials.exports.pdf.inventaris', compact('inventaris'));

        return $pdf->download('inventaris.pdf');
    }

    public function pdfPeriode(PeriodeRequest $request)
    {
        $inventaris = Inventaris::where('tanggal_register', '>=', $request->begin)->where('tanggal_register', '<=', $request->until)->with(['petugas', 'jenis', 'ruang'])->get();

        $begin = str_replace('-', '', Date::parse($request->begin)->format('dmy'));
        $until = str_replace('-','', Date::parse($request->until)->format('dmy'));

        $pdf = PDF::loadView('layouts.partials.exports.pdf.inventaris', compact('inventaris'));

        return $pdf->download('inventaris('.$begin.' - '.$until.').pdf');
    }
}
