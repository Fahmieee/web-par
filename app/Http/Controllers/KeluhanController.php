<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SuaraPelanggan;
use DataTables;
use App\Users;

class KeluhanController extends Controller
{
    public function index()
    {
    	date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');     

        $keluhans = SuaraPelanggan::select("suara_user.*","users.first_name","jabatan.jabatan_name")
        ->leftJoin("users", "suara_user.user_id", "=", "users.id")
        ->leftJoin("jabatan", "users.jabatan_id", "=", "jabatan.id")
        ->get();  

    	return view('content.keluhan.index', compact('date','keluhans'));

    }

}
