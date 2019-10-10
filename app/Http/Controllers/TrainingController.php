<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Trainings;
use DataTables;
use View;

class TrainingController extends Controller
{
    public function index()
    {
        return view('content.trainings.index');
    }

    public function GetData()
    {
        $train = Trainings::all();

        return Datatables::of($train)->make(true);
    }
}
