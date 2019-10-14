<?php

namespace App\Exports;

use App\Pegawai;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PegawaiExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        $pegawai = Pegawai::all();

        return view('layouts.partials.exports.excel.pegawai', ['pegawai'=>$pegawai]);
    }
}
