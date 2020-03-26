<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UnitKerja;
use App\Users;
use App\Jabatan;
use App\Wilayah;
use App\Units;
use App\Documents;
use App\Trainings;
use App\DocUnit;
use App\DocDriver;
use App\UserRoles;
use App\TrainingDrivers;
use App\Drivers;
use App\UnitDrivers;
use DataTables;
use View;
use Hash;

class UserController extends Controller
{
    public function drivers()
    {
    	$unitkerjas = UnitKerja::all();
    	$jabatans = Jabatan::all();

        $korlaps = Users::select("users.*","unitkerja_name")
        ->leftJoin("users_roles", "users.id", "=", "users_roles.user_id")
        ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
        ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
        ->where("users_roles.role_id","5")
        ->get();

    	$units = Units::where("pemilik", "PAR")
    	->get();

    	$docunits = Documents::where("type", "2")
    	->get();

    	$docdrivers = Documents::where("type", "1")
    	->get();

        $wilayahs = Wilayah::all();

    	$trains = Trainings::all();

        return view('content.users.drivers.index', compact('unitkerjas','jabatans',"units","docunits","docdrivers","trains","korlaps","wilayahs"));
    }

    public function getdrivers()
    {
        $drives = Users::select("users.*","jabatan_name", "wilayah_name","unitkerja_name")
        ->leftJoin("jabatan", "users.jabatan_id", "=", "jabatan.id")
        ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
        ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
        ->where("jabatan_id", "1")
        ->get();

        return Datatables::of($drives)->make(true);
    }

    public function resetpassword(Request $request)
    {

    	$reset = Users::where(['id'=>$request->id])
        ->update(['password'=>Hash::make('123'), 'flag_pass'=>'0', 'flag_prof'=>'0']);

        return response()->json($reset);

    }

    public function ambilwilayah(Request $request)
    {

    	$wilayah = Wilayah::where("unitkerja_id", $request->id)
    	->get();

    	return response()->json($wilayah);

    }

    public function ambilunit(Request $request)
    {

    	$units = Units::where("pemilik", 'PAR')
    	->get();

    	return response()->json($units);

    }

    public function docunit(Request $request)
    {

        $docunits = DocUnit::where("unit_id", $request->id)
        ->get();

        return response()->json($docunits);

    }

    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');

        $users = Users::where("username", $request->nik)
        ->first();

        if(!$users){

            $saveuser = new Users();
            $saveuser->jabatan_id  = '1';
            $saveuser->company_id = '1';
            $saveuser->wilayah_id = $request->wilayah;
            $saveuser->username = $request->nik;
            $saveuser->password = Hash::make('123');
            $saveuser->email = $request->email;
            $saveuser->first_name = $request->nama;
            $saveuser->phone = $request->phone;
            $saveuser->address = $request->alamat;
            $saveuser->driver_type = $request->type;
            $saveuser->nik = $request->nik;
            $saveuser->flag_pass = '0';
            $saveuser->flag_prof = '0';
            $saveuser->save();

            $saveroles = new UserRoles();
            $saveroles->user_id  = $saveuser->id;
            $saveroles->role_id = '2';
            $saveroles->save();

            $countdocdriver = count($request->datedocdriver);

            for($i=0; $i < $countdocdriver; $i++){

                if($request->datedocdriver[$i] != ''){

                    $docdriver = new DocDriver();
                    $docdriver->user_id = $saveuser->id;
                    $docdriver->document_id = $request->typedocdriver[$i];
                    $docdriver->exp_date = $request->datedocdriver[$i];
                    $docdriver->save();

                }
                
            }

            if($request->type == '1'){

                $units = Units::where("id", $request->unit)
                ->first();

                $adaunit = UnitDrivers::where("unit_id",  $request->unit)
                ->first();

                if(!$adaunit){

                    $saverolesclient = new UnitDrivers();
                    $saverolesclient->user_id  = $saveuser->id;
                    $saverolesclient->unit_id = $request->unit;
                    $saverolesclient->save();

                } else {

                    $clocks = UnitDrivers::where(['unit_id'=>$request->unit])
                ->update(['user_id'=>$saveuser->id]);

                }

                $noplatspasi = str_replace(' ', '', $units->no_police);

                $adaclient = Users::where("username", $noplatspasi)
                ->first();

                if(!$adaclient){

                    $saveclient = new Users();
                    $saveclient->jabatan_id  = $request->jabatan;
                    $saveclient->company_id = '1';
                    $saveclient->wilayah_id = $request->wilayah;
                    $saveclient->username = $noplatspasi;
                    $saveclient->password = Hash::make('123');
                    $saveclient->email = $request->emailclient;
                    $saveclient->first_name = $request->namaclient;
                    $saveclient->phone = $request->phoneclient;
                    $saveclient->address = '';
                    $saveclient->driver_type = '0';
                    $saveclient->nik = '0';
                    $saveclient->flag_pass = '0';
                    $saveclient->flag_prof = '0';
                    $saveclient->save();

                    $saverolesclient = new UserRoles();
                    $saverolesclient->user_id  = $saveclient->id;
                    $saverolesclient->role_id = '3';
                    $saverolesclient->save();

                }

                $countdocunit = count($request->datedocunit);

                for($i=0; $i < $countdocunit; $i++){

                    if($request->datedocunit[$i] != ''){

                        $docunits = DocUnit::where([
                            ['document_id', '=', $request->typedocunit[$i]],
                            ['unit_id', '=', $request->unit],
                        ])
                        ->first();

                        if(!$docunits){

                            $savedocunit = new DocUnit();
                            $savedocunit->document_id  = $request->typedocunit[$i];
                            $savedocunit->unit_id = $request->unit;
                            $savedocunit->exp_date = $request->datedocunit[$i];
                            $savedocunit->save();

                        } else {

                            $savedocunit = DocUnit::where(['document_id'=>$request->typedocunit[$i],'unit_id'=>$request->unit])
                            ->update(['exp_date'=>$request->datedocunit[$i]]);

                        }
                    }

                }
            }

            $counttraining = count($request->datetraining);

            for($i=0; $i < $counttraining; $i++){

                if($request->datetraining[$i] != ''){

                    $trains = TrainingDrivers::where([
                        ['training_id', '=', $request->typetraining[$i]],
                        ['user_id', '=', $saveuser->id],
                    ])
                    ->first();

                    if(!$trains){

                        $savedoctraining = new TrainingDrivers();
                        $savedoctraining->training_id  = $request->typetraining[$i];
                        $savedoctraining->user_id = $saveuser->id;
                        $savedoctraining->date = $request->datetraining[$i];
                        $savedoctraining->save();

                    } else {

                        $savedocunit = TrainingDrivers::where(['training_id'=>$request->typetraining[$i],'user_id'=>$saveuser->id])
                        ->update(['date'=>$request->datetraining[$i]]);

                    }

                }
            }


            if($request->type == '1'){

                $driverss = new Drivers();
                $driverss->driver_id  = $saveuser->id;
                $driverss->unit_id = $request->unit;
                $driverss->user_id  = $saveclient->id;
                $driverss->korlap_id = $request->korlap;
                $driverss->asmen_id  = '90';
                $driverss->manager_id = '91';
                $driverss->save();

            } else {

                $driverss = new Drivers();
                $driverss->driver_id  = $saveuser->id;
                $driverss->korlap_id = $request->korlap;
                $driverss->asmen_id  = '90';
                $driverss->manager_id = '91';
                $driverss->save();

            }

            $data = '0'; 

        } else {

            $data = '1'; 

        }

        return response()->json($data);

    }

    public function delete(Request $request)
    {
        $users = Users::findOrFail($request->id);
        $users->delete();

        return response()->json($users);
    }

    public function edit(Request $request)
    {
        $users = Users::select("users.*","unit_kerja.id as unitkerja_id","drivers.korlap_id","drivers.unit_id")
        ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
        ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
        ->leftJoin("drivers", "users.id", "=", "drivers.driver_id")
        ->where('users.id',$request->id)
        ->first();

        return response()->json($users);
    }

    public function docdriver(Request $request)
    {

        $docdrivers = DocDriver::where("user_id", $request->id)
        ->get();

        return response()->json($docdrivers);

    }

    public function trainingdriver(Request $request)
    {

        $trainings = TrainingDrivers::where("user_id", $request->id)
        ->get();

        return response()->json($trainings);

    }

    public function editclient(Request $request)
    {

        $clients = Drivers::where("driver_id" ,$request->id)
        ->first();

        $users = Users::where("id",$clients->user_id)
        ->first();

        return response()->json($users);

    }

    public function update(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');

        $users = Users::where("username", $request->nik)
        ->first();

        $saveuser = Users::findOrFail($request->id);
        $saveuser->jabatan_id  = '1';
        $saveuser->company_id = '1';
        $saveuser->wilayah_id = $request->wilayah;
        $saveuser->username = $request->nik;
        $saveuser->email = $request->email;
        $saveuser->first_name = $request->nama;
        $saveuser->phone = $request->phone;
        $saveuser->address = $request->alamat;
        $saveuser->driver_type = $request->type;
        $saveuser->nik = $request->nik;
        $saveuser->save();

        $countdocdriver = count($request->datedocdriver);

        for($i=0; $i < $countdocdriver; $i++){

            if($request->datedocdriver[$i] != ''){

                $docdrivers = DocDriver::where([
                    ['document_id', '=', $request->typedocdriver[$i]],
                    ['user_id', '=', $saveuser->id],
                ])
                ->first();

                if(!$docdrivers){

                    $docdriver = new DocDriver();
                    $docdriver->user_id = $saveuser->id;
                    $docdriver->document_id = $request->typedocdriver[$i];
                    $docdriver->exp_date = $request->datedocdriver[$i];
                    $docdriver->save();

                } else {

                    $savedocunit = DocDriver::where(['document_id'=>$request->typedocdriver[$i],'user_id'=>$saveuser->id])
                    ->update(['exp_date'=>$request->datedocdriver[$i]]);

                }

            }
            
        }

        if($request->type == '1'){

            $units = Units::where("id", $request->unit)
            ->first();

            $noplatspasi = str_replace(' ', '', $units->no_police);

             $adaunit = UnitDrivers::where("unit_id",  $request->unit)
                ->first();

                if(!$adaunit){

                    $saverolesclient = new UnitDrivers();
                    $saverolesclient->user_id  = $saveuser->id;
                    $saverolesclient->unit_id = $request->unit;
                    $saverolesclient->save();

                } else {

                    $clocks = UnitDrivers::where(['unit_id'=>$request->unit])
                    ->update(['user_id'=>$saveuser->id]);

                }

            $adaclient = Users::where("username", $noplatspasi)
            ->first();

            if(!$adaclient) {

                $saveclient = new Users();
                $saveclient->jabatan_id  = $request->jabatan;
                $saveclient->company_id = '1';
                $saveclient->wilayah_id = $request->wilayah;
                $saveclient->username = $noplatspasi;
                $saveclient->password = Hash::make('123');
                $saveclient->email = $request->emailclient;
                $saveclient->first_name = $request->namaclient;
                $saveclient->phone = $request->phoneclient;
                $saveclient->address = '';
                $saveclient->driver_type = '0';
                $saveclient->nik = '0';
                $saveclient->flag_pass = '0';
                $saveclient->flag_prof = '0';
                $saveclient->save();

                $saverolesclient = new UserRoles();
                $saverolesclient->user_id  = $saveclient->id;
                $saverolesclient->role_id = '3';
                $saverolesclient->save();

            } else {

                $saveclient = Users::findOrFail($adaclient->id);
                $saveclient->jabatan_id  = $request->jabatan;
                $saveclient->company_id = '1';
                $saveclient->wilayah_id = $request->wilayah;
                $saveclient->username = $noplatspasi;
                $saveclient->email = $request->emailclient;
                $saveclient->first_name = $request->namaclient;
                $saveclient->phone = $request->phoneclient;
                $saveclient->address = '';
                $saveclient->save();

            }


            $countdocunit = count($request->datedocunit);

            for($i=0; $i < $countdocunit; $i++){

                if($request->datedocunit[$i] != ''){

                    $docunits = DocUnit::where([
                        ['document_id', '=', $request->typedocunit[$i]],
                        ['unit_id', '=', $request->unit],
                    ])
                    ->first();

                    if(!$docunits){

                        $savedocunit = new DocUnit();
                        $savedocunit->document_id  = $request->typedocunit[$i];
                        $savedocunit->unit_id = $request->unit;
                        $savedocunit->exp_date = $request->datedocunit[$i];
                        $savedocunit->save();

                    } else {

                        $savedocunit = DocUnit::where(['document_id'=>$request->typedocunit[$i],'unit_id'=>$request->unit])
                        ->update(['exp_date'=>$request->datedocunit[$i]]);

                    }
                }

            }
        }

        $counttraining = count($request->datetraining);

        for($i=0; $i < $counttraining; $i++){

            if($request->datetraining[$i] != ''){

                $trains = TrainingDrivers::where([
                    ['training_id', '=', $request->typetraining[$i]],
                    ['user_id', '=', $saveuser->id],
                ])
                ->first();

                if(!$trains){

                    $savedoctraining = new TrainingDrivers();
                    $savedoctraining->training_id  = $request->typetraining[$i];
                    $savedoctraining->user_id = $saveuser->id;
                    $savedoctraining->date = $request->datetraining[$i];
                    $savedoctraining->save();

                } else {

                    $savedocunit = TrainingDrivers::where(['training_id'=>$request->typetraining[$i],'user_id'=>$saveuser->id])
                    ->update(['date'=>$request->datetraining[$i]]);

                }

            }
        }


        if($request->type == '1'){

            $savedocunit = Drivers::where(['driver_id'=>$saveuser->id])
            ->update(['unit_id'=>$request->unit, 'user_id'=>$saveclient->id, 'korlap_id'=>$request->korlap]);

        } else {

            $savedocunit = Drivers::where(['driver_id'=>$saveuser->id])
            ->update(['unit_id'=>null, 'user_id'=>null, 'korlap_id'=>$request->korlap]);

            $clocks = UnitDrivers::where(['user_id'=>$saveuser->id])
            ->delete();

        }


        return response()->json($users);

    }

}
