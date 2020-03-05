<?php

namespace App\Exports;

use App\MedicalCheckup;
USE DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class DCUExports implements FromView
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

            $dcus = MedicalCheckup::select('medical_checkup.*', 'users.first_name', 'unit_kerja.unitkerja_name','users.username')
            ->leftJoin("users", "medical_checkup.user_id", "=", "users.id")
            ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
            ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
            ->whereBetween('medical_checkup.date', [$this->dari, $this->sampai])
            ->get();

        } else {

            $dcus = MedicalCheckup::select('medical_checkup.*', 'users.first_name', 'unit_kerja.unitkerja_name','users.username')
            ->leftJoin("users", "medical_checkup.user_id", "=", "users.id")
            ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
            ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
            ->whereBetween('medical_checkup.date', [$this->dari, $this->sampai])
            ->where('unit_kerja.id', $this->unitkerja)
            ->get();

        }

        return view('report.dcu.printexcel', ['dcus' => $dcus]);
    }
}
