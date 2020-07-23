<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ScorePeriod;
use DataTables;
use View;

class ScoringController extends Controller
{
    public function period()
    {
    	date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');     

        $periods = ScorePeriod::orderBy('id','desc')
        ->get();

    	return view('content.scoring.period.index', compact('date','periods'));

    }

    public function storeperiod(Request $request){

    	date_default_timezone_set('Asia/Jakarta');

    	$ada = ScorePeriod::where('name', $request->nama)
    	->first();

    	if(!$ada){

    		$saveuser = new ScorePeriod();
            $saveuser->name  = $request->nama;
            $saveuser->dari  = $request->dari;
            $saveuser->sampai  = $request->sampai;
            $saveuser->save();

            $data = '0';

    	} else {

    		$data = '1';

    	}

    	return response()->json($data);
    }

    public function deleteperiod(Request $request)
    {
        $hapus = ScorePeriod::findOrFail($request->id);
        $hapus->delete();

        return response()->json($hapus);
    }

    public function editperiod(Request $request)
    {
        $scores = ScorePeriod::where('id',$request->id)
        ->first();

        return response()->json($scores);
    }

    public function updateperiod(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');

        $updates = ScorePeriod::findOrFail($request->id);
        $updates->name = $request->nama;
        $updates->dari = $request->dari;
        $updates->sampai = $request->sampai;
        $updates->save();

        return response()->json($updates);

    }
}
