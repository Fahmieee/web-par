<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UnitKerja;
use App\Users;
use App\Jabatan;
use App\Wilayah;
use App\Units;
use App\Documents;
use App\Trainings;
use DataTables;
use View;
use Hash;

class UserController extends Controller
{
    public function drivers()
    {
    	$unitkerjas = UnitKerja::all();
    	$jabatans = Jabatan::all();

    	$units = Units::where("pemilik", "PAR")
    	->get();

    	$docunits = Documents::where("type", "2")
    	->get();

    	$docdrivers = Documents::where("type", "1")
    	->get();

    	$trains = Trainings::all();

        return view('content.users.drivers.index', compact('unitkerjas','jabatans',"units","docunits","docdrivers","trains"));
    }

    public function getdrivers()
    {
        $drives = Users::select("users.*","jabatan_name", "wilayah_name","unitkerja_name")
        ->leftJoin("jabatan", "users.jabatan_id", "=", "jabatan.id")
        ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
        ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
        ->where("jabatan_id", "1")
        ->get();

        return Datatables::of($drives)->make(true);
    }

    public function resetpassword(Request $request)
    {

    	$reset = Users::where(['id'=>$request->id])
        ->update(['password'=>Hash::make('123'), 'flag_pass'=>'0', 'flag_prof'=>'0']);

        return response()->json($reset);

    }

    public function ambilwilayah(Request $request)
    {

    	$wilayah = Wilayah::where("unitkerja_id", $request->id)
    	->get();

    	return response()->json($wilayah);

    }

    public function ambilunit(Request $request)
    {

    	$units = Units::where("pemilik", 'PAR')
    	->get();

    	return response()->json($units);

    }

    public function simpanunit(Request $request)
    {
    	date_default_timezone_set('Asia/Jakarta');

    	$noplatspasi = str_replace(' ', '', $request->nopol);

    	$units = Units::where("no_police", $request->nopol)
    	->first();

    	if(!$units){

	    	$saveunits = new Units();
	        $saveunits->pemilik	 = 'PAR';
	        $saveunits->merk = $request->merk;
	        $saveunits->model = $request->model;
	        $saveunits->varian = $request->varian;
	        $saveunits->years = $request->tahun;
	        $saveunits->mes = $request->mes;
	        $saveunits->transmition = $request->transmisi;
	        $saveunits->no_police = $request->nopol;
	        $saveunits->color = $request->color;
	        $saveunits->save();

	        $data = '0';

	    } else {

	    	$data = '1';

	    }

        return response()->json($data);

    }
}
