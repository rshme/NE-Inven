<?php

namespace App\Exports;

use App\Petugas;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class PetugasExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        $petugas = Petugas::with(['user', 'level'])->get();

        return view('layouts.partials.exports.excel.petugas', ['petugas'=>$petugas]);
    }
}
