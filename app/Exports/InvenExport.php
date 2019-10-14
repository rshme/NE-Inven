<?php

namespace App\Exports;

use App\Inventaris;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class InvenExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
    	$inventaris = Inventaris::with(['jenis', 'ruang', 'petugas'])->get();
        return view('layouts.partials.exports.excel.inventaris', ['inventaris'=>$inventaris]);
    }
}
