<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Documents;
use DataTables;
use View;

class DocumentController extends Controller
{
    public function index()
    {
        return view('content.documents.index');
    }

    public function GetData()
    {
        $doc = Documents::all();

        return Datatables::of($doc)->make(true);
    }
}
