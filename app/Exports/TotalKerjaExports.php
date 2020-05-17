<?php

namespace App\Exports;

use App\Clocks;
USE DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class TotalKerjaExports implements FromView
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

            $clocks = Clocks::select("users.id","users.username","users.first_name","unit_kerja.unitkerja_name")
            ->leftJoin("users", "clocks.user_id", "=", "users.id")
            ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
            ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
            ->whereBetween('clockin_date', [$this->dari, $this->sampai])
            ->distinct()
            ->get();

        } else {

            $clocks = Clocks::select("users.id","users.username","users.first_name","unit_kerja.unitkerja_name")
            ->leftJoin("users", "clocks.user_id", "=", "users.id")
            ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
            ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
            ->whereBetween('clockin_date', [$this->dari, $this->sampai])
            ->where('unit_kerja.id', $this->unitkerja)
            ->distinct()
            ->get();

        }

        return view('report.totalkerja.printexcel', ['clocks' => $clocks ,'awal' => $this->dari, 'akhir' => $this->sampai]);
    }
}
