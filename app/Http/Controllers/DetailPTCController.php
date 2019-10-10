<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DetailPTC;
use DataTables;
use View;

class DetailPTCController extends Controller
{
    public function index()
    {
        return view('content.detailptc.index');
    }

    public function GetData()
    {
        $detptc = DetailPTC::select("check_detail.*","check_types.name AS check_name")
        ->leftJoin("check_types", "check_detail.checktype_id", "=", "check_types.id")
        ->orderBy('check_detail.id', 'desc');

        return Datatables::of($detptc)->make(true);
    }
}
