<?php

namespace App\Http\Controllers;

use App\Pegawai;
use Illuminate\Http\Request;
use DataTables;
use App\Http\Requests\PegawaiRequest;
use App\Exports\PegawaiExport;
use Excel;
use PDF;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
       $this->middleware(['check', 'admin']);
    }
    
    public function index()
    {
        $data = Pegawai::all();

        return view('pages.pegawai.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.pegawai.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PegawaiRequest $request)
    {

        $pegawai = Pegawai::create([
            'nama_pegawai'=>$request->nama_pegawai,
            'nip'=>$request->nip,
            'alamat'=>$request->alamat
        ]);

        return response()->json(['msg'=>$pegawai->nama_pegawai . ' Telah Ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai)
    {
        $data = Pegawai::findOrFail($pegawai->id_pegawai);

        return view('pages.pegawai.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $pegawai)
    {
        $data = Pegawai::findOrFail($pegawai->id_pegawai);

        return view('pages.pegawai.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(PegawaiRequest $request, Pegawai $pegawai)
    {
        $data = Pegawai::findOrFail($pegawai->id_pegawai);

        if ($request->nip !== NULL) {
            $data->update($request->all());
        }
        else{
            $user = $data->update([
                'nama_pegawai'=>$request->nama_pegawai,
                'alamat'=>$request->alamat
            ]);
        }
        

        return response()->json(['msg'=>'Pegawai Berhasil Diedit']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        $data = Pegawai::findOrFail($pegawai->id_pegawai);

        $check = \App\Peminjaman::where('id_pegawai', $pegawai->id_pegawai)->first();

        if ($check) {
            return response()->json(['msg'=>'Pegawai '.$data->nama_pegawai.' masih memiliki peminjaman !'], 401);
        }

        $data->forceDelete();
        $data->delete();

        return response()->json(['msg'=>'Pegawai '.$data->nama_pegawai.' Berhasil Dihapus']);
    }

    public function datatables()
    {
        $pegawai = Pegawai::query();

        return DataTables::of($pegawai)->addColumn('action', function($pegawai){
            return view('layouts.partials.actions.pegawai_action', [
                'model'=>$pegawai,
                'url_show'=>route('pegawai.show', $pegawai->id_pegawai),
                'url_edit'=>route('pegawai.edit', $pegawai->id_pegawai),
                'url_delete'=>route('pegawai.destroy', $pegawai->id_pegawai),
            ]);
        })->rawColumns(['action'])->addIndexColumn()->make(true);
    }

    public function excel()
    {
        return Excel::download(new PegawaiExport, 'pegawai.xlsx');
    }

    public function pdf()
    {
        $pegawai = Pegawai::all();

        $pdf = PDF::loadView('layouts.partials.exports.pdf.pegawai', compact('pegawai'));

        return $pdf->download('pegawai.pdf');
    }
}
