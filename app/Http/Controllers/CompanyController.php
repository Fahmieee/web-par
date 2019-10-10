<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Company;
use DataTables;
use View;

class CompanyController extends Controller
{
    public function index()
    {
        return view('content.company.index');
    }

    public function GetData()
    {
        $company = Company::all();

        return Datatables::of($company)->make(true);
    }
}
