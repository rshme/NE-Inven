<?php

namespace App\Exports;

use App\Peminjaman;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class PeminjamanExport implements FromView, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        $peminjaman = Peminjaman::with(['pegawai', 'detail'])->get();

        return view('layouts.partials.exports.excel.peminjaman', ['peminjaman'=>$peminjaman]);
    }
    public function registerEvents() : array{
    	return 	[
    		AfterSheet::class => function(AfterSheet $event){
    			$cellRange = 'A1:W1';
    			$event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
    		}
    	];
    }
}
