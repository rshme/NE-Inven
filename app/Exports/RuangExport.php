<?php

namespace App\Exports;

use App\Ruang;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class RuangExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        $ruang = Ruang::all();

        return view('layouts.partials.exports.excel.ruang', ['ruang'=>$ruang]);
    }
}
