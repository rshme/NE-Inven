<?php

namespace App\Exports;

use App\Level;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class LevelExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        $level = Level::all();

        return view('layouts.partials.exports.excel.level', ['level'=>$level]);
    }
}
