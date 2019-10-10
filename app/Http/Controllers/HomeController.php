<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ActivityLogin;
use App\Pretrip_Check;
use App\MedicalCheckup;
use App\SuaraPelanggan;

class HomeController extends Controller
{
    public function index()
    {
    	date_default_timezone_set('Asia/Jakarta');
    	$date = date('Y-m-d');

    	$activities = ActivityLogin::select('first_name','wilayah_name','unitkerja_name','activity_login.user_id')
    	->join("users", "activity_login.user_id", "=", "users.id")
    	->join("wilayah", "users.wilayah_id", "=", "wilayah.id")
    	->join("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
    	->where('date',$date)
    	->groupBy('first_name','wilayah_name','unitkerja_name','activity_login.user_id')
    	->limit(20)
    	->get();

    	$check = Pretrip_Check::count();

    	$suara = SuaraPelanggan::count();

    	return view('content.home.index', compact('activities','check','suara'));

    }

    public function detaillogin(Request $request)
    {
    	date_default_timezone_set('Asia/Jakarta');
    	$date = date('Y-m-d');

    	$getdetail= ActivityLogin::select('users.first_name','activity_login.created_at')
    	->join("users", "activity_login.user_id", "=", "users.id")
    	->where([
            ['user_id', '=', $request->user_id],
            ['date', '=', $date],
        ])
        ->get();

        return response()->json($getdetail);

    }
}
