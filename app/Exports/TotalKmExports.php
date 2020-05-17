<?php

namespace App\Exports;

use App\Units;
USE DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class TotalKmExports implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    private $dari;
    private $sampai;
    private $unitkerja;

    public function __construct($dari,$sampai)
    {
        $this->dari = $dari;
        $this->sampai = $sampai;
    }
    
    public function view(): View
    {
        
    	$units = Units::where("pemilik", "PAR")
        ->orderBy('id', 'desc')
        ->get();

        return view('report.totalkm.printexcel', ['units' => $units ,'awal' => $this->dari, 'akhir' => $this->sampai]);
    }
}
