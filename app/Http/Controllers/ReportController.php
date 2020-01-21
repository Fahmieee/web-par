<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TypePTC;
use App\DetailPTC;
use App\Clocks;
use Mapper;
use DataTables;
use DB;

class ReportController extends Controller
{
    public function ptc()
    {
    	date_default_timezone_set('Asia/Jakarta');
    	$date = date('Y-m-d');

        $types = TypePTC::all();

        Mapper::map(-6.2672084182605605, 106.62317910196745, ['zoom' => 15]);

    	return view('report.ptc.index', compact('date','types'));

    }

    public function dcu()
    {
    	date_default_timezone_set('Asia/Jakarta');
    	$date = date('Y-m-d');

    	return view('report.dcu.index', compact('date'));

    }

    public function clockinout()
    {
    	date_default_timezone_set('Asia/Jakarta');
    	$date = date('Y-m-d');

    	return view('report.clockinout.index', compact('date'));

    }

    public function getclockinout()
    {

        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');

        $clocks = Clocks::select('clocks.*', 'users.first_name', DB::raw('DATE_FORMAT(clocks.clockin_date, "%d %b %Y") as dates'), 'unit_kerja.unitkerja_name')
        ->leftJoin("users", "clocks.user_id", "=", "users.id")
        ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
        ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
        ->get();

        return Datatables::of($clocks)->make(true);


    }

    public function viewdetailptc(Request $request)
    {

    	$details = DetailPTC::where('checktype_id', $request->id)
    	->get();

    	return response()->json($details);

    }


}
