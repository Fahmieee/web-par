@extends('layouts.content')
@section('content')
<!-- eCommerce statistic -->
<div class="row">
    <div class="col-xl-3 col-lg-6 col-12">
        <div class="card pull-up">
            <div class="card-content">
                <div class="card-body">
                    <div class="media d-flex">
                        <div class="media-body text-left">
                            <h3 class="info">{{ $check }} Kali</h3>
                            <h6>Pre Trip Check</h6>
                        </div>
                        <div>
                            <i class="icon-wrench info font-large-2 float-right"></i>
                        </div>
                    </div>
                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                        <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
        <div class="card pull-up">
            <div class="card-content">
                <div class="card-body">
                    <div class="media d-flex">
                        <div class="media-body text-left">
                            <h3 class="warning">{{ $users }}</h3>
                            <h6>Total Driver</h6>
                        </div>
                        <div>
                            <i class="icon-cup warning font-large-2 float-right"></i>
                        </div>
                    </div>
                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                        <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
        <div class="card pull-up">
            <div class="card-content">
                <div class="card-body">
                    <div class="media d-flex">
                        <div class="media-body text-left">
                            <h3 class="success">{{ $suara }} Kali</h3>
                            <h6>Keluhan</h6>
                        </div>
                        <div>
                            <i class="icon-call-in success font-large-2 float-right"></i>
                        </div>
                    </div>
                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                        <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
        <div class="card pull-up">
            <div class="card-content">
                <div class="card-body">
                    <div class="media d-flex">
                        <div class="media-body text-left">
                            <h3 class="danger">{{ $dcu }} Kali</h3>
                            <h6>Daily Checkup</h6>
                        </div>
                        <div>
                            <i class="icon-heart danger font-large-2 float-right"></i>
                        </div>
                    </div>
                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                        <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ eCommerce statistic -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Aktif Clockin-out Bulan {{ date('F') }}</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </ul>
                </div>
                @php
                    $Date1 = $awal; 
                    $Date2 = $akhir; 
                      
                    $Variable1 = strtotime($Date1); 
                    $Variable2 = strtotime($Date2); 

                    $banyak = ''; 
                    $kps = '';
                    $mor3s = '';
                    $phkts = '';
                      
                    for ($currentDate = $Variable1; $currentDate <= $Variable2;  
                                                    $currentDate += (86400)) { 
                                                          
                    $Store = date('d.m', $currentDate); 

                    $tanggal = date('Y-m-d', $currentDate); 

                    $kp = DB::table('clocks')
                    ->leftJoin('users', 'clocks.user_id', '=', 'users.id')
                    ->leftJoin('wilayah', 'users.wilayah_id', '=', 'wilayah.id')
                    ->leftJoin('unit_kerja', 'wilayah.unitkerja_id', '=', 'unit_kerja.id')
                    ->where([
                        ['clockin_date', '=', $tanggal],
                        ['unit_kerja.id', '=', '21'],
                    ])
                    ->count();

                    $mor3 = DB::table('clocks')
                    ->leftJoin('users', 'clocks.user_id', '=', 'users.id')
                    ->leftJoin('wilayah', 'users.wilayah_id', '=', 'wilayah.id')
                    ->leftJoin('unit_kerja', 'wilayah.unitkerja_id', '=', 'unit_kerja.id')
                    ->where([
                        ['clockin_date', '=', $tanggal],
                        ['unit_kerja.id', '=', '3'],
                    ])
                    ->count();

                    $phkt = DB::table('clocks')
                    ->leftJoin('users', 'clocks.user_id', '=', 'users.id')
                    ->leftJoin('wilayah', 'users.wilayah_id', '=', 'wilayah.id')
                    ->leftJoin('unit_kerja', 'wilayah.unitkerja_id', '=', 'unit_kerja.id')
                    ->where([
                        ['clockin_date', '=', $tanggal],
                        ['unit_kerja.id', '=', '18'],
                    ])
                    ->count();

                    $banyak .= $Store.',';
                    $kps .= $kp.',';
                    $mor3s .= $mor3.',';
                    $phkts .= $phkt.',';
                    
                    }

                    $hasil = substr($banyak,0,-1);
                    $hasilkp = substr($kps,0,-1);
                    $hasilmor3 = substr($mor3s,0,-1);
                    $hasilphkt = substr($phkts,0,-1);
                @endphp
                <input type="hidden" value="{{ $hasil }}" id="periode">
                <input type="hidden" value="{{ $hasilkp }}" id="kp">
                <input type="hidden" value="{{ $hasilmor3 }}" id="mor3">
                <input type="hidden" value="{{ $hasilphkt }}" id="phkt">

            </div>
            <div class="card-content collapse show">
                <div class="card-body chartjs">
                    <canvas id="line-chart" height="500"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Transactions -->
<div class="row">
    <div id="recent-transactions" class="col-12">
        <div class="card">
            <div class="card-header">
                <h2>Clockin Hari ini</h2>
                <div style="font-size: 14px;font-family: 'Quicksand', Georgia, 'Times New Roman', Times, serif; color: #00BCD4;" id="showdate">Tanggal : {{ date('d F Y', strtotime($date)) }}</div>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a><br>
                <select class="form-control" id="unitkerja">
                   <option value="">Pilih Unit Kerja</option>
                   @foreach($unitkerjas as $unitkerja)
                   <option value="{{ $unitkerja->id }}">{{ $unitkerja->unitkerja_name }}</option>
                   @endforeach
                </select>

                <hr>
                <div class="table-responsive">
                    <table width="100%" class="table table-striped table-bordered datatables">
                        <thead>
                            <tr>
                                <th>Nopeg</th>
                                <th>Pengemudi</th>
                                <th>U.Kerja</th>
                                <th>Clockin</th>
                                <th>Km in</th>
                                <th>Clockout</th>
                                <th>Km Out</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Recent Transactions -->
@include('content.home.model')
@include('includes.footer')
@include('scripts.home')
<script src="/assets/content/vendors/js/charts/chart.min.js"></script>
<script src="/assets/content/js/scripts/charts/chartjs/line/line.js"></script>
@stop