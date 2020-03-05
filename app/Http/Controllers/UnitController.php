<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Units;
use DataTables;
use View;

class UnitController extends Controller
{
    public function index()
    {
        return view('content.units.index');
    }

    public function GetData()
    {
        $units = Units::where("pemilik", "PAR")->get();

        return Datatables::of($units)->make(true);
    }

    public function store(Request $request)
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

    public function edit(Request $request)
    {
        $units = Units::where('id',$request->id)
        ->first();

        return response()->json($units);
    }

    public function delete(Request $request)
    {
        $units = Units::findOrFail($request->id);
        $units->delete();

        return response()->json($units);
    }

    public function update(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');

        $saveunits = Units::findOrFail($request->id);
        $saveunits->merk = $request->merk;
        $saveunits->model = $request->model;
        $saveunits->varian = $request->varian;
        $saveunits->years = $request->tahun;
        $saveunits->mes = $request->mes;
        $saveunits->transmition = $request->transmisi;
        $saveunits->no_police = $request->nopol;
        $saveunits->color = $request->color;
        $saveunits->save();

        return response()->json($saveunits);

    }
}
