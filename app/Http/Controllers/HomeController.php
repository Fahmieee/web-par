<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ActivityLogin;
use App\Pretrip_Check;
use App\MedicalCheckup;
use App\SuaraPelanggan;
use App\UnitKerja;
use App\Clocks;
use DataTables;
use App\Users;

class HomeController extends Controller
{
    public function index()
    {
    	date_default_timezone_set('Asia/Jakarta');
    	$date = date('Y-m-d', strtotime("-1 day", strtotime(date("Y-m-d"))));

        $unitkerjas = UnitKerja::all();

    	$check = Pretrip_Check::count();

    	$suara = SuaraPelanggan::count();

        $dcu = MedicalCheckup::count();

        $users = Users::leftJoin("users_roles", "users.id", "=", "users_roles.user_id")
        ->where('role_id','2')
        ->count();

    	return view('content.home.index', compact('activities','check','suara','unitkerjas','date','users','dcu'));

    }

    public function getclockin(Request $request)
    {

        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d', strtotime("-1 day", strtotime(date("Y-m-d"))));

         if($request->unitkerja == ''){

            $clocks = Clocks::select('clocks.*', 'users.first_name', 'unit_kerja.unitkerja_name')
            ->leftJoin("users", "clocks.user_id", "=", "users.id")
            ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
            ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
            ->where('clocks.clockin_date', $date)
            ->get();

        } else {

            $clocks = Clocks::select('clocks.*', 'users.first_name', 'unit_kerja.unitkerja_name')
            ->leftJoin("users", "clocks.user_id", "=", "users.id")
            ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
            ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
            ->where([
                ['clocks.clockin_date', '=', $date],
                ['unit_kerja.id', '=', $request->unitkerja],
            ])
            ->get();

        }


        return Datatables::of($clocks)->make(true);


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
