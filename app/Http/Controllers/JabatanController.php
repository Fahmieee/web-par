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
}
