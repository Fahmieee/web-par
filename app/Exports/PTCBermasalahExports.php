<?php

namespace App\Exports;

use App\PTCNotok;
USE DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class PTCBermasalahExports implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    private $dari;
    private $sampai;
    private $unitkerja;
    private $type;

    public function __construct($dari,$sampai,$unitkerja,$type)
    {
        $this->dari = $dari;
        $this->sampai = $sampai;
        $this->unitkerja = $unitkerja;
        $this->type = $type;
    }
    
    public function view(): View
    {
        if($this->unitkerja == '' && $this->type == ''){

            $ptcsalahs = PTCNotok::select('pretrip_check_notoke.*', 'users.first_name', 'users.username', 'pretrip_check.date', 'unit_kerja.unitkerja_name','units.no_police','pretrip_check.time','check_answer.parameter','check_answer.level','check_detail.name as detail_name','check_types.name as type_name')
            ->leftJoin("pretrip_check", "pretrip_check_notoke.pretripcheck_id", "=", "pretrip_check.id")
            ->leftJoin("users", "pretrip_check.user_id", "=", "users.id")
            ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
            ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
            ->leftJoin("units", "pretrip_check.unit_id", "=", "units.id")
            ->leftJoin("check_answer", "pretrip_check_notoke.checkanswer_id", "=", "check_answer.id")
            ->leftJoin("check_detail", "check_answer.checkdetail_id", "=", "check_detail.id")
            ->leftJoin("check_types", "check_detail.checktype_id", "=", "check_types.id")
            ->whereBetween('pretrip_check.date', [$this->dari, $this->sampai])
            ->where('pretrip_check.status', 'SUBMITED')
            ->get();

        } else if($this->unitkerja != '' && $this->type == ''){

            $ptcsalahs = PTCNotok::select('pretrip_check_notoke.*', 'users.first_name', 'users.username', 'pretrip_check.date', 'unit_kerja.unitkerja_name','units.no_police','pretrip_check.time','check_answer.parameter','check_answer.level','check_detail.name as detail_name','check_types.name as type_name')
            ->leftJoin("pretrip_check", "pretrip_check_notoke.pretripcheck_id", "=", "pretrip_check.id")
            ->leftJoin("users", "pretrip_check.user_id", "=", "users.id")
            ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
            ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
            ->leftJoin("units", "pretrip_check.unit_id", "=", "units.id")
            ->leftJoin("check_answer", "pretrip_check_notoke.checkanswer_id", "=", "check_answer.id")
            ->leftJoin("check_detail", "check_answer.checkdetail_id", "=", "check_detail.id")
            ->leftJoin("check_types", "check_detail.checktype_id", "=", "check_types.id")
            ->whereBetween('pretrip_check.date', [$this->dari, $this->sampai])
            ->where([
                ['pretrip_check.status', '=', 'SUBMITED'],
                ['unit_kerja.id', '=', $this->unitkerja],
            ])
            ->get();

        } else if($this->unitkerja == '' && $this->type != ''){

            $ptcsalahs = PTCNotok::select('pretrip_check_notoke.*', 'users.first_name', 'users.username', 'pretrip_check.date', 'unit_kerja.unitkerja_name','units.no_police','pretrip_check.time','check_answer.parameter','check_answer.level','check_detail.name as detail_name','check_types.name as type_name')
            ->leftJoin("pretrip_check", "pretrip_check_notoke.pretripcheck_id", "=", "pretrip_check.id")
            ->leftJoin("users", "pretrip_check.user_id", "=", "users.id")
            ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
            ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
            ->leftJoin("units", "pretrip_check.unit_id", "=", "units.id")
            ->leftJoin("check_answer", "pretrip_check_notoke.checkanswer_id", "=", "check_answer.id")
            ->leftJoin("check_detail", "check_answer.checkdetail_id", "=", "check_detail.id")
            ->leftJoin("check_types", "check_detail.checktype_id", "=", "check_types.id")
            ->whereBetween('pretrip_check.date', [$this->dari, $this->sampai])
            ->where([
                ['pretrip_check.status', '=', 'SUBMITED'],
                ['check_types.id', '=', $this->type],
            ])
            ->get();

        } else {

            $ptcsalahs = PTCNotok::select('pretrip_check_notoke.*', 'users.first_name', 'users.username', 'pretrip_check.date', 'unit_kerja.unitkerja_name','units.no_police','pretrip_check.time','check_answer.parameter','check_answer.level','check_detail.name as detail_name','check_types.name as type_name')
            ->leftJoin("pretrip_check", "pretrip_check_notoke.pretripcheck_id", "=", "pretrip_check.id")
            ->leftJoin("users", "pretrip_check.user_id", "=", "users.id")
            ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
            ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
            ->leftJoin("units", "pretrip_check.unit_id", "=", "units.id")
            ->leftJoin("check_answer", "pretrip_check_notoke.checkanswer_id", "=", "check_answer.id")
            ->leftJoin("check_detail", "check_answer.checkdetail_id", "=", "check_detail.id")
            ->leftJoin("check_types", "check_detail.checktype_id", "=", "check_types.id")
            ->whereBetween('pretrip_check.date', [$this->dari, $this->sampai])
            ->where([
                ['pretrip_check.status', '=', 'SUBMITED'],
                ['unit_kerja.id', '=', $this->unitkerja],
                ['check_types.id', '=', $this->type],
            ])
            ->get();

        }

        return view('report.ptcbermasalah.printexcel', ['ptcsalahs' => $ptcsalahs]);
    }
}
