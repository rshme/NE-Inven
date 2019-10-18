<?php

namespace App\Http\Controllers;

use App\Level;
use Illuminate\Http\Request;
use DataTables;
use App\Http\Requests\LevelRequest;
use App\Exports\LevelExport;
use Excel;
use PDF;

class LevelController extends Controller
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
        $data = Level::all();
        return view('pages.level.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.petugas
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.level.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LevelRequest $request)
    {
        $level = Level::create($request->all());

        return response()->json(['msg'=>$level->nama_level . ' Telah Ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function show(Level $level)
    {
        $data = Level::findOrFail($level->id_level);

        return view('pages.level.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function edit(Level $level)
    {
        $data = Level::findOrFail($level->id_level);

        return view('pages.level.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function update(LevelRequest $request, Level $level)
    {
        $data = Level::findOrFail($level->id_level);

        $data->update([
            'nama_level'=>$request->nama_level
        ]);

        return response()->json(['msg'=>'Level Berhasil Diedit']);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function destroy(Level $level)
    {
        $data = Level::findOrFail($level->id_level);

        $data->delete();

        return response()->json(['msg'=>'Level '.$data->nama_level.' Berhasil Dihapus']);
    }

    public function datatables()
    {
        $level = Level::query();

        return DataTables::of($level)
        ->addColumn('nama', function($level){
            return ucfirst($level->nama_level);
        })
        ->addColumn('action', function ($level) {
            return view('layouts.partials.actions.level_action', [
                'model' => $level,
                'url_show' => route('level.show', $level->id_level),
                'url_edit' => route('level.edit', $level->id_level),
                'url_delete' => route('level.destroy', $level->id_level),
            ]);
        })->rawColumns(['action'])->addIndexColumn()->make(true);
    }

    public function excel()
    {
        return Excel::download(new LevelExport, 'level.xlsx');
    }

    public function pdf()
    {
        $level = Level::all();

        $pdf = PDF::loadView('layouts.partials.exports.pdf.level', compact('level'));

        return $pdf->download('level.pdf');
    }
}
