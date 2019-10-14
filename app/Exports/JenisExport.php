<?php

namespace App\Exports;

use App\Jenis;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class JenisExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        $jenis = Jenis::all();
        return view('layouts.partials.exports.excel.jenis', ['jenis'=>$jenis]);
    }
}
