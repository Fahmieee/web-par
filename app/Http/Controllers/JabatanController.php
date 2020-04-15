<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jabatan;
use DataTables;
use View;

class JabatanController extends Controller
{
    public function index()
    {
        return view('content.jabatan.index');
    }

    public function GetData()
    {
        $jabs = Jabatan::all();

        return Datatables::of($jabs)->make(true);
    }

    public function store(Request $request){

    	date_default_timezone_set('Asia/Jakarta');

    	$ada = Jabatan::where('jabatan_name', $request->nama)
    	->first();

    	if(!$ada){

    		$saveuser = new Jabatan();
            $saveuser->jabatan_name  = $request->nama;
            $saveuser->save();

            $data = '0';

    	} else {

    		$data = '1';

    	}

    	return response()->json($data);
    }

    public function edit(Request $request)
    {
        $jabatans = Jabatan::where('id',$request->id)
        ->first();

        return response()->json($jabatans);
    }

    public function update(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');

        $updates = Jabatan::findOrFail($request->id);
        $updates->jabatan_name = $request->nama;
        $updates->save();

        return response()->json($updates);

    }

    public function delete(Request $request)
    {
        $hapus = Jabatan::findOrFail($request->id);
        $hapus->delete();

        return response()->json($hapus);
    }
}
