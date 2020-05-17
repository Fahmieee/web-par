<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pretrip_Check;
use App\PTCNotok;
use App\TypePTC;
use App\DetailPTC;
use App\MedicalCheckup;
use App\Clocks;
use App\UnitKerja;
use Mapper;
use DataTables;
use DB;
use App\Exports\DCUExports;
use App\Exports\PTCExports;
use App\Exports\PTCBermasalahExports;
use App\Exports\ClockExports;
use App\Exports\TotalKerjaExports;

class ReportController extends Controller
{
    public function ptc()
    {
    	date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');

        $awal = date('Y-m-01', strtotime($date));
        $akhir = date('Y-m-t', strtotime($date));

        $unitkerjas = UnitKerja::all();

        return view('report.ptc.index', compact('date','unitkerjas','awal','akhir'));

    }

    public function getptc(Request $request)
    {

        if($request->unitkerja == ''){

            $ptcus = Pretrip_Check::select('pretrip_check.*', 'users.first_name', 'users.username', DB::raw('DATE_FORMAT(pretrip_check.date, "%d %b %Y") as dates'), 'unit_kerja.unitkerja_name','units.no_police')
            ->leftJoin("users", "pretrip_check.user_id", "=", "users.id")
            ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
            ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
            ->leftJoin("units", "pretrip_check.unit_id", "=", "units.id")
            ->whereBetween('pretrip_check.date', [$request->awal, $request->akhir])
            ->where('pretrip_check.status', 'SUBMITED')
            ->get();

        } else {

            $ptcus = Pretrip_Check::select('pretrip_check.*', 'users.first_name', 'users.username', DB::raw('DATE_FORMAT(pretrip_check.date, "%d %b %Y") as dates'), 'unit_kerja.unitkerja_name','units.no_police')
            ->leftJoin("users", "pretrip_check.user_id", "=", "users.id")
            ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
            ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
            ->leftJoin("units", "pretrip_check.unit_id", "=", "units.id")
            ->whereBetween('pretrip_check.date', [$request->awal, $request->akhir])
            ->where([
                ['pretrip_check.status', '=', 'SUBMITED'],
                ['unit_kerja.id', '=', $request->unitkerja],
            ])
            ->get();

        }

        return Datatables::of($ptcus)->make(true);

    }

    public function ptcprintexcel(Request $request)
    {

        return (new PTCExports($request->dari,$request->sampai,$request->unit))->download('ReportPTCExcel.xlsx');

    }

    public function ptcbermasalah()
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');

        $awal = date('Y-m-01', strtotime($date));
        $akhir = date('Y-m-t', strtotime($date));

        $unitkerjas = UnitKerja::all();
        $bagians = TypePTC::all();

        return view('report.ptcbermasalah.index', compact('date','unitkerjas','awal','akhir','bagians'));

    }

    public function getptcbermasalah(Request $request)
    {

        if($request->unitkerja == '' && $request->type == ''){

            $ptcsalahs = PTCNotok::select('pretrip_check_notoke.*', 'users.first_name', 'users.username', DB::raw('DATE_FORMAT(pretrip_check.date, "%d %b %Y") as dates'), 'unit_kerja.unitkerja_name','units.no_police','pretrip_check.time','check_answer.parameter','check_answer.level','check_detail.name as detail_name','check_types.name as type_name')
            ->leftJoin("pretrip_check", "pretrip_check_notoke.pretripcheck_id", "=", "pretrip_check.id")
            ->leftJoin("users", "pretrip_check.user_id", "=", "users.id")
            ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
            ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
            ->leftJoin("units", "pretrip_check.unit_id", "=", "units.id")
            ->leftJoin("check_answer", "pretrip_check_notoke.checkanswer_id", "=", "check_answer.id")
            ->leftJoin("check_detail", "check_answer.checkdetail_id", "=", "check_detail.id")
            ->leftJoin("check_types", "check_detail.checktype_id", "=", "check_types.id")
            ->whereBetween('pretrip_check.date', [$request->awal, $request->akhir])
            ->where('pretrip_check.status', 'SUBMITED')
            ->get();

        } else if($request->unitkerja != '' && $request->type == ''){

            $ptcsalahs = PTCNotok::select('pretrip_check_notoke.*', 'users.first_name', 'users.username', DB::raw('DATE_FORMAT(pretrip_check.date, "%d %b %Y") as dates'), 'unit_kerja.unitkerja_name','units.no_police','pretrip_check.time','check_answer.parameter','check_answer.level','check_detail.name as detail_name','check_types.name as type_name')
            ->leftJoin("pretrip_check", "pretrip_check_notoke.pretripcheck_id", "=", "pretrip_check.id")
            ->leftJoin("users", "pretrip_check.user_id", "=", "users.id")
            ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
            ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
            ->leftJoin("units", "pretrip_check.unit_id", "=", "units.id")
            ->leftJoin("check_answer", "pretrip_check_notoke.checkanswer_id", "=", "check_answer.id")
            ->leftJoin("check_detail", "check_answer.checkdetail_id", "=", "check_detail.id")
            ->leftJoin("check_types", "check_detail.checktype_id", "=", "check_types.id")
            ->whereBetween('pretrip_check.date', [$request->awal, $request->akhir])
            ->where([
                ['pretrip_check.status', '=', 'SUBMITED'],
                ['unit_kerja.id', '=', $request->unitkerja],
            ])
            ->get();

        } else if($request->unitkerja == '' && $request->type != ''){

            $ptcsalahs = PTCNotok::select('pretrip_check_notoke.*', 'users.first_name', 'users.username', DB::raw('DATE_FORMAT(pretrip_check.date, "%d %b %Y") as dates'), 'unit_kerja.unitkerja_name','units.no_police','pretrip_check.time','check_answer.parameter','check_answer.level','check_detail.name as detail_name','check_types.name as type_name')
            ->leftJoin("pretrip_check", "pretrip_check_notoke.pretripcheck_id", "=", "pretrip_check.id")
            ->leftJoin("users", "pretrip_check.user_id", "=", "users.id")
            ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
            ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
            ->leftJoin("units", "pretrip_check.unit_id", "=", "units.id")
            ->leftJoin("check_answer", "pretrip_check_notoke.checkanswer_id", "=", "check_answer.id")
            ->leftJoin("check_detail", "check_answer.checkdetail_id", "=", "check_detail.id")
            ->leftJoin("check_types", "check_detail.checktype_id", "=", "check_types.id")
            ->whereBetween('pretrip_check.date', [$request->awal, $request->akhir])
            ->where([
                ['pretrip_check.status', '=', 'SUBMITED'],
                ['check_types.id', '=', $request->type],
            ])
            ->get();

        } else {

            $ptcsalahs = PTCNotok::select('pretrip_check_notoke.*', 'users.first_name', 'users.username', DB::raw('DATE_FORMAT(pretrip_check.date, "%d %b %Y") as dates'), 'unit_kerja.unitkerja_name','units.no_police','pretrip_check.time','check_answer.parameter','check_answer.level','check_detail.name as detail_name','check_types.name as type_name')
            ->leftJoin("pretrip_check", "pretrip_check_notoke.pretripcheck_id", "=", "pretrip_check.id")
            ->leftJoin("users", "pretrip_check.user_id", "=", "users.id")
            ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
            ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
            ->leftJoin("units", "pretrip_check.unit_id", "=", "units.id")
            ->leftJoin("check_answer", "pretrip_check_notoke.checkanswer_id", "=", "check_answer.id")
            ->leftJoin("check_detail", "check_answer.checkdetail_id", "=", "check_detail.id")
            ->leftJoin("check_types", "check_detail.checktype_id", "=", "check_types.id")
            ->whereBetween('pretrip_check.date', [$request->awal, $request->akhir])
            ->where([
                ['pretrip_check.status', '=', 'SUBMITED'],
                ['unit_kerja.id', '=', $request->unitkerja],
                ['check_types.id', '=', $request->type],
            ])
            ->get();

        }

        return Datatables::of($ptcsalahs)->make(true);

    }

    public function ptcbermasalahprintexcel(Request $request)
    {

        return (new PTCBermasalahExports($request->dari,$request->sampai,$request->unit,$request->type))->download('ReportPTCBermasalahExcel.xlsx');

    }

    public function dcu()
    {
    	date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');

        $awal = date('Y-m-01', strtotime($date));
        $akhir = date('Y-m-t', strtotime($date));

        $unitkerjas = UnitKerja::all();

        return view('report.dcu.index', compact('date','unitkerjas','awal','akhir'));

    }

    public function getdcu(Request $request)
    {   
        if($request->unitkerja == ''){

            $dcus = MedicalCheckup::select('medical_checkup.*', 'users.first_name', 'users.username', DB::raw('DATE_FORMAT(medical_checkup.date, "%d %b %Y") as dates'), 'unit_kerja.unitkerja_name')
            ->leftJoin("users", "medical_checkup.user_id", "=", "users.id")
            ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
            ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
            ->whereBetween('medical_checkup.date', [$request->awal, $request->akhir])
            ->get();

        } else {

            $dcus = MedicalCheckup::select('medical_checkup.*', 'users.first_name', 'users.username', DB::raw('DATE_FORMAT(medical_checkup.date, "%d %b %Y") as dates'), 'unit_kerja.unitkerja_name')
            ->leftJoin("users", "medical_checkup.user_id", "=", "users.id")
            ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
            ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
            ->whereBetween('medical_checkup.date', [$request->awal, $request->akhir])
            ->where('unit_kerja.id', $request->unitkerja)
            ->get();

        }

        return Datatables::of($dcus)->make(true);

    }

    public function dcuprintexcel(Request $request)
    {

        return (new DCUExports($request->dari,$request->sampai,$request->unit))->download('ReportDCUExcel.xlsx');

    }

    public function clockinout()
    {
    	date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');

        $awal = date('Y-m-01', strtotime($date));
        $akhir = date('Y-m-t', strtotime($date));

        $unitkerjas = UnitKerja::all();

    	return view('report.clockinout.index', compact('date','unitkerjas','awal','akhir'));

    }

    public function getclockinout(Request $request)
    {

        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');

        if($request->unitkerja == ''){

            $clocks = Clocks::select('clocks.*', 'users.first_name', 'users.username', DB::raw('DATE_FORMAT(clocks.clockin_date, "%d %b %Y") as dates'), 'unit_kerja.unitkerja_name')
            ->leftJoin("users", "clocks.user_id", "=", "users.id")
            ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
            ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
            ->whereBetween('clocks.clockin_date', [$request->awal, $request->akhir])
            ->get();

        } else {

            $clocks = Clocks::select('clocks.*', 'users.first_name', 'users.username', DB::raw('DATE_FORMAT(clocks.clockin_date, "%d %b %Y") as dates'), 'unit_kerja.unitkerja_name')
            ->leftJoin("users", "clocks.user_id", "=", "users.id")
            ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
            ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
            ->whereBetween('clocks.clockin_date', [$request->awal, $request->akhir])
            ->where('unit_kerja.id', $request->unitkerja)
            ->get();

        }

        return Datatables::of($clocks)->make(true);


    }

    public function clocksprintexcel(Request $request)
    {

        return (new ClockExports($request->dari,$request->sampai,$request->unit))->download('ReportClockInOutExcel.xlsx');

    }

    public function viewdetailptc(Request $request)
    {

    	$details = DetailPTC::where('checktype_id', $request->id)
    	->get();

    	return response()->json($details);

    }

    public function totalkerja()
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');

        $awal = date('Y-m-01', strtotime($date));
        $akhir = date('Y-m-t', strtotime($date));

        $unitkerjas = UnitKerja::all();

        $clocks = Clocks::select("users.id","users.username","users.first_name","unit_kerja.unitkerja_name")
        ->leftJoin("users", "clocks.user_id", "=", "users.id")
        ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
        ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
        ->whereBetween('clockin_date', [$awal, $akhir])
        ->distinct()
        ->get();

        return view('report.totalkerja.index', compact('date','unitkerjas','awal','akhir','clocks'));

    }


    public function totalkerjadetail(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');

        $awal = $request->dari;
        $akhir = $request->sampai;

        $unitkerjas =  UnitKerja::all();

        $units = $request->unitkerja;

        if($units == ''){

            $clocks = Clocks::select("users.id","users.username","users.first_name","unit_kerja.unitkerja_name")
            ->leftJoin("users", "clocks.user_id", "=", "users.id")
            ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
            ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
            ->whereBetween('clockin_date', [$awal, $akhir])
            ->distinct()
            ->get();

        } else {

            $clocks = Clocks::select("users.id","users.username","users.first_name","unit_kerja.unitkerja_name")
            ->leftJoin("users", "clocks.user_id", "=", "users.id")
            ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
            ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
            ->whereBetween('clockin_date', [$awal, $akhir])
            ->where('unit_kerja.id', $request->unitkerja)
            ->distinct()
            ->get();

        }

        return view('report.totalkerja.detail', compact('date','unitkerjas','awal','akhir','clocks','units'));

    }

    public function totalkerjaprintexcel(Request $request)
    {

        return (new TotalKerjaExports($request->dari,$request->sampai,$request->unitkerja))->download('ReportTotalKerjaExcel.xlsx');

    }


}
