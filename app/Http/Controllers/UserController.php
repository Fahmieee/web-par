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
use App\Roles;
use DataTables;
use View;
use Hash;
use Auth;

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

        $kendaraans = Units::select("units.*","unit_drivers.user_id")
        ->leftJoin("unit_drivers", "units.id", "=", "unit_drivers.unit_id")
        ->where([
            ['units.pemilik', '=', "PAR"],
            ['unit_drivers.user_id', '=', null],
        ])
        ->get();

        return view('content.users.drivers.index', compact('unitkerjas','jabatans',"units","docunits","docdrivers","trains","korlaps","wilayahs","kendaraans"));
    }

    public function korlaps()
    {
        $unitkerjas = UnitKerja::all();
        $jabatans = Jabatan::all();

        $korlaps = Users::select("users.*", "wilayah_name","unitkerja_name")
        ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
        ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
        ->leftJoin("users_roles", "users.id", "=", "users_roles.user_id")
        ->where("users_roles.role_id","5")
        ->orderBy("users.id","desc")
        ->get();

        $units = Units::where("pemilik", "PAR")
        ->get();

        $docunits = Documents::where("type", "2")
        ->get();

        $docdrivers = Documents::where("type", "1")
        ->get();

        $wilayahs = Wilayah::all();

        $trains = Trainings::all();

        return view('content.users.korlap.index', compact('unitkerjas','jabatans',"units","docunits","docdrivers","trains","korlaps","wilayahs"));
    }

    public function getkorlaps()
    {
        $korlaps = Users::select("users.*", "wilayah_name","unitkerja_name")
        ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
        ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
        ->leftJoin("users_roles", "users.id", "=", "users_roles.user_id")
        ->where("users_roles.role_id","5")
        ->get();

        return Datatables::of($korlaps)->make(true);
    }

    public function getdrivers()
    {
        $drives = Users::select("users.*","jabatan_name", "wilayah_name","unitkerja_name","units.no_police")
        ->leftJoin("jabatan", "users.jabatan_id", "=", "jabatan.id")
        ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
        ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
        ->leftJoin("drivers", "users.id", "=", "drivers.driver_id")
        ->leftJoin("units", "drivers.unit_id", "=", "units.id")
        ->where("jabatan_id", "1")
        ->get();

        return Datatables::of($drives)->make(true);
    }

    public function getdriversforkorlap(Request $request)
    {
        if($request->unitkerja == ''){

            $drives = Users::select("users.*","jabatan_name", "wilayah_name","unitkerja_name","units.no_police")
            ->leftJoin("jabatan", "users.jabatan_id", "=", "jabatan.id")
            ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
            ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
            ->leftJoin("drivers", "users.id", "=", "drivers.driver_id")
            ->leftJoin("units", "drivers.unit_id", "=", "units.id")
            ->where("jabatan_id", "1")
            ->get();

        } else {

            $drives = Users::select("users.*", "wilayah_name","unitkerja_name","units.no_police")
            ->leftJoin("jabatan", "users.jabatan_id", "=", "jabatan.id")
            ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
            ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
            ->leftJoin("drivers", "users.id", "=", "drivers.driver_id")
            ->leftJoin("units", "drivers.unit_id", "=", "units.id")
            ->where("jabatan_id", "1")
            ->where([
                ['jabatan_id', '=', "1"],
                ['unit_kerja.id', '=', $request->unitkerja],
            ])
            ->get();

        }
        

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

    	$units = Units::select("units.*","drivers.unit_id")
        ->leftJoin("drivers", "units.id", "=", "drivers.unit_id")
        ->where("pemilik", 'PAR')
        ->where([
            ['unit_id', '=', null],
            ['pemilik', '=', 'PAR'],
        ])
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

                if($request->gangen == 'no'){

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

                } else {

                    $units = Units::where("id", $request->unitganjil)
                    ->first();

                    $adaunitganjil = UnitDrivers::where("unit_id",  $request->unitganjil)
                    ->first();

                    if(!$adaunitganjil){

                        $saverolesclient = new UnitDrivers();
                        $saverolesclient->user_id  = $saveuser->id;
                        $saverolesclient->unit_id = $request->unitganjil;
                        $saverolesclient->save();

                    } else {

                        $clocks = UnitDrivers::where(['unit_id'=>$request->unitganjil])
                        ->update(['user_id'=>$saveuser->id]);

                    }

                    $adaunitgenap = UnitDrivers::where("unit_id",  $request->unitgenap)
                    ->first();

                    if(!$adaunitgenap){

                        $saverolesclient = new UnitDrivers();
                        $saverolesclient->user_id  = $saveuser->id;
                        $saverolesclient->unit_id = $request->unitgenap;
                        $saverolesclient->save();

                    } else {

                        $clocks = UnitDrivers::where(['unit_id'=>$request->unitgenap])
                        ->update(['user_id'=>$saveuser->id]);

                    }

                    $countdocunitganjil = count($request->datedocunitganjil);

                    for($i=0; $i < $countdocunitganjil; $i++){

                        if($request->datedocunitganjil[$i] != ''){

                            $docunits = DocUnit::where([
                                ['document_id', '=', $request->typedocunitganjil[$i]],
                                ['unit_id', '=', $request->unitganjil],
                            ])
                            ->first();

                            if(!$docunits){

                                $savedocunit = new DocUnit();
                                $savedocunit->document_id  = $request->typedocunitganjil[$i];
                                $savedocunit->unit_id = $request->unitganjil;
                                $savedocunit->exp_date = $request->datedocunitganjil[$i];
                                $savedocunit->save();

                            } else {

                                $savedocunit = DocUnit::where(['document_id'=>$request->typedocunitganjil[$i],'unit_id'=>$request->unitganjil])
                                ->update(['exp_date'=>$request->datedocunitganjil[$i]]);

                            }
                        }

                    }

                    $countdocunitgenap = count($request->datedocunitgenap);

                    for($i=0; $i < $countdocunitgenap; $i++){

                        if($request->datedocunitgenap[$i] != ''){

                            $docunits = DocUnit::where([
                                ['document_id', '=', $request->typedocunitgenap[$i]],
                                ['unit_id', '=', $request->unitgenap],
                            ])
                            ->first();

                            if(!$docunits){

                                $savedocunit = new DocUnit();
                                $savedocunit->document_id  = $request->typedocunitgenap[$i];
                                $savedocunit->unit_id = $request->unitgenap;
                                $savedocunit->exp_date = $request->datedocunitgenap[$i];
                                $savedocunit->save();

                            } else {

                                $savedocunit = DocUnit::where(['document_id'=>$request->typedocunitgenap[$i],'unit_id'=>$request->unitgenap])
                                ->update(['exp_date'=>$request->datedocunitgenap[$i]]);

                            }
                        }

                    }
                }
                
                // ======== MEMBUAT CLIENT ==========

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

                    $idclient = $saveclient->id;

                } else {

                    $idclient = $adaclient->id;
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

                if($request->gangen == 'no'){

                    $driverss = new Drivers();
                    $driverss->driver_id  = $saveuser->id;
                    $driverss->unit_id = $request->unit;
                    $driverss->user_id  = $idclient;
                    $driverss->korlap_id = $request->korlap;
                    $driverss->asmen_id  = '90';
                    $driverss->manager_id = '91';
                    $driverss->save();

                } else {

                    $driverss = new Drivers();
                    $driverss->driver_id  = $saveuser->id;
                    $driverss->unit_id = $request->unitganjil;
                    $driverss->user_id  = $idclient;
                    $driverss->korlap_id = $request->korlap;
                    $driverss->asmen_id  = '90';
                    $driverss->manager_id = '91';
                    $driverss->save();

                }

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

    public function korlapstore(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');

        $users = Users::where("username", $request->nik)
        ->first();

        $adawilayah = Wilayah::where("unitkerja_id", $request->unitkerja)
        ->first();

        if(!$adawilayah){

            $unitkerja = UnitKerja::where("id", $request->unitkerja)
            ->first();

            $savewilayah = new Wilayah();
            $savewilayah->unitkerja_id  = $unitkerja->id;
            $savewilayah->wilayah_name = $unitkerja->unitkerja_name;
            $savewilayah->save();


        }

        $wilayah = Wilayah::where("unitkerja_id", $request->unitkerja)
        ->first();

        if(!$users){

            $saveuser = new Users();
            $saveuser->jabatan_id  = '2';
            $saveuser->company_id = '1';
            $saveuser->wilayah_id = $wilayah->id;
            $saveuser->username = $request->nik;
            $saveuser->password = Hash::make($request->password);
            $saveuser->email = $request->email;
            $saveuser->first_name = $request->nama;
            $saveuser->phone = $request->phone;
            $saveuser->address = $request->alamat;
            $saveuser->nik = $request->nik;
            $saveuser->flag_pass = '0';
            $saveuser->flag_prof = '0';
            $saveuser->save();

            $saveroles = new UserRoles();
            $saveroles->user_id  = $saveuser->id;
            $saveroles->role_id = '5';
            $saveroles->save();

            // $unitkerjas = Drivers::select("drivers.*")
            // ->leftJoin("users", "drivers.driver_id", "=", "users.id")
            // ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
            // ->where("unitkerja_id", $request->unitkerja)
            // ->get();

            // foreach($unitkerjas as $unitkerja){

            //     $updates = Drivers::where(['id'=>$unitkerja->id])
            //     ->update(['korlap_id'=>$saveuser->id]);

            // }

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

        $unitdrivers = UnitDrivers::where("user_id", $request->id)
        ->get();

        if($unitdrivers->count() > 1){

            $ganjil = $unitdrivers = UnitDrivers::orderBy("id","asc")
            ->where("user_id", $request->id)
            ->first();

            $genap = $unitdrivers = UnitDrivers::orderBy("id","desc")
            ->where("user_id", $request->id)
            ->first();

            $transactionz = array(     
                'unitkerja_id' => $users->unitkerja_id,
                'korlap_id' => $users->korlap_id,
                'unitganjil' => $ganjil->unit_id,
                'unitgenap' => $genap->unit_id,
                'first_name' => $users->first_name,
                'email' => $users->email,
                'phone' => $users->phone,
                'username' => $users->username,
                'wilayah_id' => $users->wilayah_id,
                'driver_type' => $users->driver_type,
                'address' => $users->address,
                'gangen' => $unitdrivers->count(),
            );

        } else {

            $transactionz = array(     
                'unitkerja_id' => $users->unitkerja_id,
                'korlap_id' => $users->korlap_id,
                'unit_id' => $users->unit_id,
                'first_name' => $users->first_name,
                'email' => $users->email,
                'phone' => $users->phone,
                'username' => $users->username,
                'wilayah_id' => $users->wilayah_id,
                'driver_type' => $users->driver_type,
                'address' => $users->address,
                'gangen' => $unitdrivers->count(),
            );

        }


        return response()->json($transactionz);
    }

    public function editkorlap(Request $request)
    {
        $users = Users::select("users.*","drivers.driver_id","wilayah.unitkerja_id")
        ->leftJoin("drivers", "users.id", "=", "drivers.korlap_id")
        ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
        ->where('users.id',$request->id)
        ->first();



        // $drivers = Users::select('wilayah.unitkerja_id')
        // ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
        // ->where('users.id',$users->driver_id)
        // ->first();

        // if($users->driver_id == null){
        //     $unitkerjas = '';
        // } else {
        //     $unitkerjas = $drivers->unitkerja_id;
        // }


        $transactionz = array(     
            'first_name' => $users->first_name,
            'email' => $users->email,
            'username' => $users->username,
            'phone' => $users->phone,
            'address' => $users->address,
            'id' => $users->id,
            'unitkerja' => $users->unitkerja_id,
        );

        return response()->json($transactionz);
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

            $drivers = Drivers::where("driver_id", $request->id)
            ->first();

            $adaclient = Users::where("id", $drivers->user_id)
            ->first();

            if(!$adaclient) {

                $saveclient = new Users();
                $saveclient->jabatan_id  = $request->jabatan;
                $saveclient->company_id = '1';
                $saveclient->wilayah_id = $request->wilayah;
                $saveclient->username = $adaclient->username;
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
                $saveclient->username = $adaclient->username;
                $saveclient->email = $request->emailclient;
                $saveclient->first_name = $request->namaclient;
                $saveclient->phone = $request->phoneclient;
                $saveclient->address = '';
                $saveclient->save();

            }

            if($request->gangen == 'no'){

                $deleteunit = UnitDrivers::leftJoin("units", "unit_drivers.unit_id", "=", "units.id")
                ->where([
                    ['unit_drivers.user_id', '=', $request->id],
                    ['units.pemilik', '=', 'PAR'],
                ])
                ->delete();

                $saverolesclient = new UnitDrivers();
                $saverolesclient->user_id  = $saveuser->id;
                $saverolesclient->unit_id = $request->unit;
                $saverolesclient->save();

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

            } else {

                $deleteunit = UnitDrivers::leftJoin("units", "unit_drivers.unit_id", "=", "units.id")
                ->where([
                    ['unit_drivers.user_id', '=', $request->id],
                    ['units.pemilik', '=', 'PAR'],
                ])
                ->delete();

                $saveganjil = new UnitDrivers();
                $saveganjil->user_id  = $saveuser->id;
                $saveganjil->unit_id = $request->unitganjil;
                $saveganjil->save();

                $savegenap = new UnitDrivers();
                $savegenap->user_id  = $saveuser->id;
                $savegenap->unit_id = $request->unitgenap;
                $savegenap->save();

                // ======== GANJIL =========

                $countdocunitganjil = count($request->datedocunitganjil);

                for($i=0; $i < $countdocunitganjil; $i++){

                    if($request->datedocunitganjil[$i] != ''){

                        $docunitganjil = DocUnit::where([
                            ['document_id', '=', $request->typedocunitganjil[$i]],
                            ['unit_id', '=', $request->unitganjil],
                        ])
                        ->first();

                        if(!$docunitganjil){

                            $savedocunit = new DocUnit();
                            $savedocunit->document_id  = $request->typedocunitganjil[$i];
                            $savedocunit->unit_id = $request->unitganjil;
                            $savedocunit->exp_date = $request->datedocunitganjil[$i];
                            $savedocunit->save();

                        } else {

                            $savedocunit = DocUnit::where(['document_id'=>$request->typedocunitganjil[$i],'unit_id'=>$request->unitganjil])
                            ->update(['exp_date'=>$request->datedocunitganjil[$i]]);

                        }
                    }

                }

                // ========== GENAP ===========

                $countdocunitgenap = count($request->datedocunitgenap);

                for($i=0; $i < $countdocunitgenap; $i++){

                    if($request->datedocunitgenap[$i] != ''){

                        $docunitgenap = DocUnit::where([
                            ['document_id', '=', $request->typedocunitgenap[$i]],
                            ['unit_id', '=', $request->unitgenap],
                        ])
                        ->first();

                        if(!$docunitgenap){

                            $savedocunit = new DocUnit();
                            $savedocunit->document_id  = $request->typedocunitgenap[$i];
                            $savedocunit->unit_id = $request->unitgenap;
                            $savedocunit->exp_date = $request->datedocunitgenap[$i];
                            $savedocunit->save();

                        } else {

                            $savedocunit = DocUnit::where(['document_id'=>$request->typedocunitgenap[$i],'unit_id'=>$request->unitgenap])
                            ->update(['exp_date'=>$request->datedocunitgenap[$i]]);

                        }
                    }

                }

            }

            // $units = Units::where("id", $request->unit)
            // ->first();

            // $adaunit = UnitDrivers::where("unit_id",  $request->unit)
            // ->first();

            // if(!$adaunit){

            //     $saverolesclient = new UnitDrivers();
            //     $saverolesclient->user_id  = $saveuser->id;
            //     $saverolesclient->unit_id = $request->unit;
            //     $saverolesclient->save();

            // } else {

            //     $clocks = UnitDrivers::where(['unit_id'=>$request->unit])
            //     ->update(['user_id'=>$saveuser->id]);

            // }

            
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

            if($request->gangen == 'no'){

                $savedocunit = Drivers::where(['driver_id'=>$saveuser->id])
                ->update(['unit_id'=>$request->unit, 'user_id'=>$saveclient->id, 'korlap_id'=>$request->korlap]);

            } else {

                $savedocunit = Drivers::where(['driver_id'=>$saveuser->id])
                ->update(['unit_id'=>$request->unitganjil, 'user_id'=>$saveclient->id, 'korlap_id'=>$request->korlap]);

            }

            

        } else {

            $savedocunit = Drivers::where(['driver_id'=>$saveuser->id])
            ->update(['unit_id'=>null, 'user_id'=>null, 'korlap_id'=>$request->korlap]);

            $clocks = UnitDrivers::where(['user_id'=>$saveuser->id])
            ->delete();

        }


        return response()->json($users);

    }


    public function updatekorlap(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');

        $wilayah = Wilayah::where("unitkerja_id", $request->unitkerja)
        ->first();

        $saveuser = Users::findOrFail($request->id);
        $saveuser->jabatan_id  = '2';
        $saveuser->company_id = '1';
        $saveuser->wilayah_id = $wilayah->id;
        $saveuser->username = $request->nik;
        $saveuser->email = $request->email;
        $saveuser->first_name = $request->nama;
        $saveuser->phone = $request->phone;
        $saveuser->address = $request->alamat;
        $saveuser->nik = $request->nik;
        $saveuser->save();


        // $unitkerjas = Drivers::select("drivers.*")
        // ->leftJoin("users", "drivers.driver_id", "=", "users.id")
        // ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
        // ->where("unitkerja_id", $request->unitkerja)
        // ->get();

        // foreach($unitkerjas as $unitkerja){

        //     $updates = Drivers::where(['id'=>$unitkerja->id])
        //     ->update(['korlap_id'=>$saveuser->id]);

        // }



    }

    public function userweb()
    {
            
        $roles = Roles::where("device","web")
        ->get();

        return view('content.user-web.index', compact('roles'));
    }

    public function userwebgetdata()
    {
        $users = Users::select("users.*","role.name as role_name")
        ->leftJoin("users_roles", "users.id", "=", "users_roles.user_id")
        ->leftJoin("role", "users_roles.role_id", "=", "role.id")
        ->where("role.device", "web")
        ->get();

        return Datatables::of($users)->make(true);
    }

    public function simpanuserweb(Request $request)
    {   
        date_default_timezone_set('Asia/Jakarta');

        $ada = Users::where("username", $request->username)
        ->first();

            if(!$ada) {

                $data = "0";

                $save = new Users();
                $save->username = $request->username;
                $save->password = Hash::make($request->password);
                $save->email = $request->email;
                $save->first_name = $request->nama;
                $save->driver_type = '0';
                $save->nik = '0';
                $save->flag_pass = '0';
                $save->flag_prof = '0';
                $save->save();

                $saveroles = new UserRoles();
                $saveroles->user_id  = $save->id;
                $saveroles->role_id = $request->role;
                $saveroles->save();

            } else {

                $data = "1";

            }

        return response()->json($data);

    }

    public function edituserweb(Request $request)
    {

        $users = Users::select("users.*","users_roles.role_id")
        ->leftJoin("users_roles", "users.id", "=", "users_roles.user_id")
        ->where("users.id",$request->id)
        ->first();

        return response()->json($users);

    }

    public function updateuserweb(Request $request)
    {

        date_default_timezone_set('Asia/Jakarta');

        $saveuser = Users::findOrFail($request->id);
        $saveuser->username = $request->username;
        $saveuser->email = $request->email;
        $saveuser->first_name = $request->nama;
        $saveuser->save();

        $previllages = UserRoles::where(['user_id'=>$request->id])
        ->update(['role_id'=>$request->role]);

        return response()->json($saveuser);

    }

    public function gantipass()
    {
        
        return view('content.gantipass.index');
    }

    public function gantipassupdate(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');

        $user = Auth::user();

        $update = Users::findOrFail($user->id);
        $update->password = Hash::make($request->password);
        $update->save();

        return response()->json($update);

    }

    public function asmen()
    {

        $asmens = Users::select("users.*")
        ->leftJoin("users_roles", "users.id", "=", "users_roles.user_id")
        ->where("role_id", "6")
        ->get();

        $wilayahs = Wilayah::select("wilayah.*","unit_kerja.unitkerja_name")
        ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
        ->get();

        $kors = Users::select("users.*","unit_kerja.unitkerja_name")
        ->leftJoin("users_roles", "users.id", "=", "users_roles.user_id")
        ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
        ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
        ->where("role_id", "5")
        ->get();

        return view('content.users.asmen.index', compact('asmens','wilayahs','kors'));
    }

    public function simpanasmen(Request $request)
    {   
        date_default_timezone_set('Asia/Jakarta');

        $ada = Users::where("username", $request->username)
        ->first();

            if(!$ada) {

                $data = "0";

                $save = new Users();
                $save->jabatan_id = '42';
                $save->company_id = '1';
                $save->wilayah_id = $request->wilayah;
                $save->username = $request->username;
                $save->password = Hash::make($request->password);
                $save->email = $request->email;
                $save->first_name = $request->nama;
                $save->driver_type = '0';
                $save->nik = '0';
                $save->flag_pass = '0';
                $save->flag_prof = '0';
                $save->save();

                $saveroles = new UserRoles();
                $saveroles->user_id  = $save->id;
                $saveroles->role_id = "6";
                $saveroles->save();

                $counts = count($request->korlaps);

                for($i=0; $i < $counts; $i++){

                    $drivers = Drivers::where(['korlap_id'=>$request->korlaps[$i]])
                    ->update(['asmen_id'=>$save->id]);

                }

            } else {

                $data = "1";

            }

        return response()->json($data);

    }

    public function editasmen(Request $request)
    {

        $users = Users::select("users.*","users_roles.role_id")
        ->leftJoin("users_roles", "users.id", "=", "users_roles.user_id")
        ->where("users.id",$request->id)
        ->first();

        $wilayahs = Wilayah::select("wilayah.*","unit_kerja.unitkerja_name")
        ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
        ->get();

        $kors = Users::select("users.*","unit_kerja.unitkerja_name")
        ->leftJoin("users_roles", "users.id", "=", "users_roles.user_id")
        ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
        ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
        ->where("role_id", "5")
        ->get();

        return view('content.users.asmen.edit', compact('users','wilayahs','kors'));

    }

    public function updateasmen(Request $request)
    {

        date_default_timezone_set('Asia/Jakarta');

        $saveuser = Users::findOrFail($request->id);
        $saveuser->username = $request->username;
        $saveuser->email = $request->email;
        $saveuser->first_name = $request->nama;
        $saveuser->wilayah_id = $request->wilayah;
        $saveuser->save();

        $hapus = Drivers::where(['asmen_id'=>$request->id])
        ->update(['asmen_id'=>NULL]);

        $counts = count($request->korlaps);
        for($i=0; $i < $counts; $i++){

            $drivers = Drivers::where(['korlap_id'=>$request->korlaps[$i]])
            ->update(['asmen_id'=>$request->id]);

        }

        return response()->json($saveuser);

    }

    public function manager()
    {

        $managers = Users::select("users.*")
        ->leftJoin("users_roles", "users.id", "=", "users_roles.user_id")
        ->where("role_id", "7")
        ->get();

        $wilayahs = Wilayah::select("wilayah.*","unit_kerja.unitkerja_name")
        ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
        ->get();

        $asmens = Users::select("users.*","unit_kerja.unitkerja_name")
        ->leftJoin("users_roles", "users.id", "=", "users_roles.user_id")
        ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
        ->leftJoin("unit_kerja", "wilayah.unitkerja_id", "=", "unit_kerja.id")
        ->where("role_id", "6")
        ->get();

        return view('content.users.manager.index', compact('asmens','wilayahs','managers'));
    }

    public function simpanmanager(Request $request)
    {   
        date_default_timezone_set('Asia/Jakarta');

        $ada = Users::where("username", $request->username)
        ->first();

            if(!$ada) {

                $data = "0";

                $save = new Users();
                $save->jabatan_id = '43';
                $save->company_id = '1';
                $save->wilayah_id = $request->wilayah;
                $save->username = $request->username;
                $save->password = Hash::make($request->password);
                $save->email = $request->email;
                $save->first_name = $request->nama;
                $save->driver_type = '0';
                $save->nik = '0';
                $save->flag_pass = '0';
                $save->flag_prof = '0';
                $save->save();

                $saveroles = new UserRoles();
                $saveroles->user_id  = $save->id;
                $saveroles->role_id = "7";
                $saveroles->save();

                $counts = count($request->asmen);

                for($i=0; $i < $counts; $i++){

                    $drivers = Drivers::where(['asmen_id'=>$request->asmen[$i]])
                    ->update(['manager_id'=>$save->id]);

                }

            } else {

                $data = "1";

            }

        return response()->json($data);

    }

    public function client()
    {

        $clients = Users::select("users.*","jabatan_name","wilayah_name")
        ->leftJoin("users_roles", "users.id", "=", "users_roles.user_id")
        ->leftJoin("jabatan", "users.jabatan_id", "=", "jabatan.id")
        ->leftJoin("wilayah", "users.wilayah_id", "=", "wilayah.id")
        ->where("role_id", "3")
        ->get();

        return view('content.users.client.index', compact('clients'));
    }

}
