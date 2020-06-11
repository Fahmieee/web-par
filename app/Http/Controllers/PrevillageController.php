<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Previllages;
use App\Roles;
use App\Menus;
use DataTables;
use View;

class PrevillageController extends Controller
{
    public function index()
    {
    	$previllages = Previllages::select("role.*")
    	->leftJoin("role", "previllages.role_id", "=", "role.id")
    	->where("role.device","web")
    	->distinct()
    	->get();

    	$menuxs = Menus::all();

    	$roles = Roles::where("device","web")
    	->get();

        return view('content.previllage.index', compact('previllages','menuxs','roles'));
    }

    public function store(Request $request) {

    	date_default_timezone_set('Asia/Jakarta');

    	$cek = Previllages::where("role_id", $request->id)
    	->first();

    	if(!$cek){

    		$data = '0';

    		$count = count($request->menu);

	        for($i=0; $i < $count; $i++){

	            $details = new Previllages();
	            $details->role_id = $request->id;
	            $details->menu_id= $request->menu[$i];
	            $details->save();
	        }

    	} else {

    		$data = '1';
    	}
        

        return response()->json($data);
    }

    public function delete(Request $request)
    {

        $previllagess = Previllages::where('role_id', $request->id)
        ->delete();

        return response()->json($previllagess);
    }

}
