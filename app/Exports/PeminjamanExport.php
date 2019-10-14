<?php

namespace App\Exports;

use App\Peminjaman;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class PeminjamanExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        $peminjaman = Peminjaman::with(['pegawai', 'detail'])->get();

        return view('layouts.partials.exports.excel.peminjaman', ['peminjaman'=>$peminjaman]);
    }
}
