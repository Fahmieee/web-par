<?php

namespace App\Exports;

use App\Clocks;
USE DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class ClockExports implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    private $dari;
    private $sampai;
    private $unitkerja;

    public function __construct($dari,$sampai,$unitkerja)
    {
        $this->dari = $dari;
        $this->sampai = $sampai;
        $this->unitkerja = $unitkerja;
    }
    
    public function view(): View
    {
        if($this->unitkerja == ''){

            $clocks = Clocks::select('clocks.*', 'users.first_name', 'users.username', 'unit_kerja.unitkerja_name')
            ->leftJoin("users", "clocks.user_id", "=", "users.id")
            ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
            ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
            ->whereBetween('clocks.clockin_date', [$this->dari, $this->sampai])
            ->get();

        } else {

            $clocks = Clocks::select('clocks.*', 'users.first_name', 'users.username', 'unit_kerja.unitkerja_name')
            ->leftJoin("users", "clocks.user_id", "=", "users.id")
            ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
            ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
            ->whereBetween('clocks.clockin_date', [$this->dari, $this->sampai])
            ->where('unit_kerja.id', $this->unitkerja)
            ->get();

        }

        return view('report.clockinout.printexcel', ['clocks' => $clocks]);
    }
}
