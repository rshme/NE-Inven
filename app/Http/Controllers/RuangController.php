<?php

namespace App\Http\Controllers;

use App\Http\Requests\RuangRequest;
use App\Ruang;
use Illuminate\Http\Request;
use DataTables;
use App\Exports\RuangExport;
use Excel;
use PDF;

class RuangController extends Controller
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
        $ruangs = Ruang::all();

        return view('pages.ruang.index', compact('ruangs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.ruang.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RuangRequest $request)
    {
        $ruang = Ruang::create($request->all());

        return response()->json(['msg' => $ruang->nama_ruang . ' Telah Ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ruang  $ruang
     * @return \Illuminate\Http\Response
     */
    public function show(Ruang $ruang)
    {
        $data = Ruang::findOrFail($ruang->id_ruang);

        return view('pages.ruang.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ruang  $ruang
     * @return \Illuminate\Http\Response
     */
    public function edit(Ruang $ruang)
    {
        $data = Ruang::findOrFail($ruang->id_ruang);

        return view('pages.ruang.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ruang  $ruang
     * @return \Illuminate\Http\Response
     */
    public function update(RuangRequest $request, Ruang $ruang)
    {
        $data = Ruang::findOrFail($ruang->id_ruang);

        if ($request->kode_ruang !== NULL) {
            $data->update($request->all());
        }
        else{
            $data->update([
                'nama_ruang'=>$request->nama_ruang,
                'keterangan'=>$request->keterangan
            ]);
        }

        return response()->json(['msg' => 'Ruang Berhasil Diedit']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ruang  $ruang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ruang $ruang)
    {
        $data = Ruang::findOrFail($ruang->id_ruang);

        $check = \App\Inventaris::where('id_ruang', $ruang->id_ruang)->first();

        if($check){
            return response()->json(['msg'=>'Masih ada inventaris yang memakai Ruang : '.$ruang->nama_ruang], 401);
        }

        $data->forceDelete();
        $data->delete();

        return response()->json(['msg' => 'Ruang '.$data->nama_ruang.' Berhasil Dihapus']);
    }

    public function datatables()
    {
        $ruang  = Ruang::query();

        return DataTables::of($ruang)->addColumn('action', function ($ruang) {
            return view('layouts.partials.actions.ruang_action', [
                'model' => $ruang,
                'url_show' => route('ruang.show', $ruang->id_ruang),
                'url_edit' => route('ruang.edit', $ruang->id_ruang),
                'url_delete' => route('ruang.destroy', $ruang->id_ruang),
            ]);
        })->rawColumns(['action'])->addIndexColumn()->make(true);
    }

    public function excel()
    {
        return Excel::download(new RuangExport, 'ruang.xlsx');
    }
    public function pdf()
    {
        $ruang = Ruang::all();

        $pdf = PDF::loadView('layouts.partials.exports.pdf.ruang', ['ruang'=>$ruang]);

         return $pdf->download('ruang.pdf');
    }
}
