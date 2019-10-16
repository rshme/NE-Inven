<?php

namespace App\Exports;

use App\Level;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class LevelExport implements FromView, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        $level = Level::all();

        return view('layouts.partials.exports.excel.level', ['level'=>$level]);
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
