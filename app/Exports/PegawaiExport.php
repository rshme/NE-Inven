<?php

namespace App\Exports;

use App\Pegawai;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class PegawaiExport implements FromView, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        $pegawai = Pegawai::all();

        return view('layouts.partials.exports.excel.pegawai', ['pegawai'=>$pegawai]);
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
