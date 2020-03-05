<?php

namespace App\Exports;

use App\Pretrip_Check;
USE DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class PTCExports implements FromView
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

            $ptcus = Pretrip_Check::select('pretrip_check.*', 'users.first_name', 'users.username', 'unit_kerja.unitkerja_name','units.no_police')
            ->leftJoin("users", "pretrip_check.user_id", "=", "users.id")
            ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
            ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
            ->leftJoin("units", "pretrip_check.unit_id", "=", "units.id")
            ->whereBetween('pretrip_check.date', [$this->dari, $this->sampai])
            ->where('pretrip_check.status', 'SUBMITED')
            ->get();

        } else {

            $ptcus = Pretrip_Check::select('pretrip_check.*', 'users.first_name','users.username', 'unit_kerja.unitkerja_name','units.no_police')
            ->leftJoin("users", "pretrip_check.user_id", "=", "users.id")
            ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
            ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
            ->leftJoin("units", "pretrip_check.unit_id", "=", "units.id")
            ->whereBetween('pretrip_check.date', [$this->dari, $this->sampai])
            ->where([
                ['pretrip_check.status', '=', 'SUBMITED'],
                ['unit_kerja.id', '=', $this->unitkerja],
            ])
            ->get();

        }

        return view('report.ptc.printexcel', ['ptcus' => $ptcus]);
    }
}
