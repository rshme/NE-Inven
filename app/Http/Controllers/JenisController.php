<?php

namespace App\Http\Controllers;

use App\Http\Requests\JenisRequest;
use App\Exports\JenisExport;
use App\Jenis;
use Illuminate\Http\Request;
use DataTables;
use Excel;
use PDF;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenis = Jenis::all();

        return view('pages.jenis.index', compact('jenis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.jenis.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JenisRequest $request)
    {
        $data = $request->all();

        $jenis = Jenis::create($data);

        return response()->json(['msg'=>$jenis->nama_jenis .' Telah Ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function show(Jenis $jeni)
    {
        $data = Jenis::findOrFail($jeni->id_jenis);

        return view('pages.jenis.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function edit(Jenis $jeni)
    {
        $data = Jenis::findOrFail($jeni->id_jenis);

        return view('pages.jenis.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function update(JenisRequest $request, Jenis $jeni)
    {
        $target = Jenis::findOrFail($jeni->id_jenis);

        if ($request->kode_jenis !== NULL) {
            $data = $target->update([
                'nama_jenis'=>$request->nama_jenis,
                'kode_jenis'=>$request->kode_jenis,
                'keterangan'=>$request->keterangan,
            ]);
        }else{
            $data = $target->update([
                'nama_jenis'=>$request->nama_jenis,
                'keterangan'=>$request->keterangan
            ]);
        }

        return response()->json(['msg'=>'Jenis Berhasil Diedit']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jenis  $jenis
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jenis $jeni)
    {
        $check = \App\Inventaris::where('id_jenis', $jeni->id_jenis)->first();

        if($check){
            return response()->json(['msg'=>'Masih ada inventaris yang memakai Jenis : '.$jeni->nama_jenis], 401);
        }

        $data = Jenis::findOrFail($jeni->id_jenis);

        $data->forceDelete();
        $data->delete();

        return response()->json(['msg'=>'Jenis '.$data->nama_jenis.' Berhasil Dihapus']);
    }

    public function datatables()
    {
        $jenis = Jenis::query();

        return DataTables::of($jenis)->addColumn('action', function($jenis){
            return view('layouts.partials.actions.jenis_action', [
                'model'=>$jenis,
                'url_show'=>route('jenis.show', $jenis->id_jenis),
                'url_edit'=>route('jenis.edit', $jenis->id_jenis),
                'url_delete'=>route('jenis.destroy', $jenis->id_jenis),
            ]);
        })->rawColumns(['action'])->addIndexColumn()->make(true);
    }

    public function excel(){
        return Excel::download(new JenisExport, 'jenis.xlsx');
    }

    public function pdf()
    {
        $jenis = Jenis::all();

        $pdf = PDF::loadView('layouts.partials.exports.pdf.jenis', compact('jenis'));

        return $pdf->download('jenis.pdf');
    }
}
