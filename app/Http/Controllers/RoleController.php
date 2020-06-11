<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Roles;
use DataTables;
use View;

class RoleController extends Controller
{
    public function index()
    {
        return view('content.role.index');
    }

    public function getdata()
    {
        $role = Roles::where("device", "web")
        ->get();

        return Datatables::of($role)->make(true);
    }

    public function store(Request $request){

    	date_default_timezone_set('Asia/Jakarta');

    	$ada = Roles::where('name', $request->nama)
    	->first();

    	if(!$ada){

    		$saveuser = new Roles();
            $saveuser->name  = $request->nama;
            $saveuser->device  = "web";
            $saveuser->save();

            $data = '0';

    	} else {

    		$data = '1';

    	}

    	return response()->json($data);
    }

    public function delete(Request $request)
    {
        $hapus = Roles::findOrFail($request->id);
        $hapus->delete();

        return response()->json($hapus);
    }

    public function edit(Request $request)
    {
        $roles = Roles::where('id',$request->id)
        ->first();

        return response()->json($roles);
    }

    public function update(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');

        $updates = Roles::findOrFail($request->id);
        $updates->name = $request->nama;
        $updates->save();

        return response()->json($updates);

    }

}
