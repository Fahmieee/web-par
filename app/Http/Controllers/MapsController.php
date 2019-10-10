<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mapper;

class MapsController extends Controller
{
    public function index()
    {
    	date_default_timezone_set('Asia/Jakarta');
    	$date = date('Y-m-d');


        Mapper::map(-6.2672084182605605, 106.62317910196745, -6.254940, 106.621422, ['zoom' => 15]);



    	return view('content.maps.index', compact('date'));

    }
}
