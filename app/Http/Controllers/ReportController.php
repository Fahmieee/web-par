<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TypePTC;
use App\DetailPTC;
use Mapper;

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

    public function viewdetailptc(Request $request)
    {

    	$details = DetailPTC::where('checktype_id', $request->id)
    	->get();

    	return response()->json($details);

    }


}