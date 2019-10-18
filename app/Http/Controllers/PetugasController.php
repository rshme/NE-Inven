<?php

namespace App\Http\Controllers;

use App\Http\Requests\PetugasRequest;
use App\Petugas;
use App\Level;
use App\User;
use Illuminate\Http\Request;
use DataTables;
use App\Exports\PetugasExport;
use Excel;
use PDF;

class PetugasController extends Controller
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
        $data = Petugas::all();
        return view('pages.petugas.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $levels = Level::all();

        return view('pages.petugas.create', compact('levels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PetugasRequest $request)
    {
        $user = User::create([
            'username'=>$request->username,
            'password'=>bcrypt($request->password)
        ]);

        $petugas = Petugas::create([
            'user_id'=>$user->id,
            'id_level'=>$request->id_level,
            'nama_petugas'=>$request->nama_petugas,
        ]);

        return response()->json(['msg'=>$petugas->nama_petugas . ' Telah Ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function show(Petugas $petuga)
    {
        $data = Petugas::with(['user', 'level'])->findOrFail($petuga->id_petugas);

        return view('pages.petugas.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function edit(Petugas $petuga)
    {
        $data = Petugas::with(['user', 'level'])->findOrFail($petuga->id_petugas);

        $levels = Level::all();

        return view('pages.petugas.edit', ['data'=>$data, 'levels'=>$levels]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function update(PetugasRequest $request, Petugas $petuga)
    {
         $data = Petugas::findOrFail($petuga->id_petugas);

        $data->update([
            'nama_petugas'=>$request->nama_petugas,
        ]);

        $user = User::findOrFail($data->user_id);

        if ($request->password) {
            $password = bcrypt($request->password);
            $user->update([
                'password'=>$password
            ]);
        }

        if ($request->username) {
            $username = $request->username;
            $user->update([
                'username'=>$username
            ]);
        }

        return response()->json(['msg'=>'Petugas Berhasil Diedit']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Petugas $petuga)
    {
        $user = User::with(['petugas'])->findOrFail($petuga->user_id);

        $check = \App\Inventaris::where('id_petugas', $petuga->id_petugas)->first();

        if ($check) {
            return response()->json(['msg'=>'Petugas '.$user->petugas->nama_petugas.' masih terdaftar di inventaris'], 401);
        }

        $user->forceDelete();
        $user->delete();

        return response()->json(['msg'=>'Petugas '.$user->petugas->nama_petugas.' Berhasil Dihapus']);
    }

    public function datatables()
    {
        $petugas = Petugas::query()->with(['level'])->get();

        return DataTables::of($petugas)->addColumn('action', function($petugas){
            return view('layouts.partials.actions.petugas_action', [
                'model'=>$petugas,
                'url_show'=>route('petugas.show', $petugas->id_petugas),
                'url_edit'=>route('petugas.edit', $petugas->id_petugas),
                'url_delete'=>route('petugas.destroy', $petugas->id_petugas),
            ]);
        })->addColumn('level', function($petugas){
            return $petugas->level->nama_level;
        })->rawColumns(['action'])->addIndexColumn()->make(true);
    }

    public function excel()
    {
        return Excel::download(new PetugasExport, 'petugas.xlsx');
    }

    public function pdf()
    {
        $petugas = Petugas::with(['level'])->get();

        $pdf = PDF::loadView('layouts.partials.exports.pdf.petugas', compact('petugas'));

        return $pdf->download('petugas.pdf');
    }
}
