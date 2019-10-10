<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Wilayah;
use DataTables;
use View;

class WilayahController extends Controller
{
    public function index()
    {
        return view('content.wilayah.index');
    }

    public function GetData()
    {
        $wilayah = Wilayah::select("wilayah.*","unit_kerja.unitkerja_name")
        ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
        ->orderBy('wilayah.id', 'desc');

        return Datatables::of($wilayah)->make(true);
    }
}
