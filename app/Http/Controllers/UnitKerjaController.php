<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UnitKerja;
use DataTables;
use View;

class UnitKerjaController extends Controller
{
    public function index()
    {
        return view('content.unitkerja.index');
    }

    public function GetData()
    {
        $unitkerja = UnitKerja::all();

        return Datatables::of($unitkerja)->make(true);
    }
}
