<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TypePTC;
use DataTables;
use View;

class TypePTCController extends Controller
{
    public function index()
    {
        return view('content.typeptc.index');
    }

    public function GetData()
    {
        $types = TypePTC::all();

        return Datatables::of($types)->make(true);
    }
}
