<?php

namespace App\Exports;

use App\Inventaris;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class PeriodeInvenExport implements FromView, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($begin, $until)
    {
        $this->begin = $begin;
        $this->until = $until;
    }
    public function view() : View
    {
    	$inventaris = Inventaris::with(['jenis', 'ruang', 'petugas'])->where('tanggal_register', '>=', $this->begin)->where('tanggal_register', '<=', $this->until)->get();
        
        return view('layouts.partials.exports.excel.inventaris', ['inventaris'=>$inventaris]);
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
