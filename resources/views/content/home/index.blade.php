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
                            <h3 class="warning">60 Jam</h3>
                            <h6>Lembur Driver</h6>
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
                            <h3 class="success">{{ $suara }}</h3>
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
                            <h3 class="danger">98 %</h3>
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

<!-- Recent Transactions -->
<div class="row">
    <div id="recent-transactions" class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Login Hari Ini</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            </div>
            <div class="card-content">
                <div class="table-responsive">
                    <table id="recent-orders" class="table table-hover table-xl mb-0">
                        <thead>
                            <tr>
                                <th class="border-top-0">Nama Driver</th>
                                <th class="border-top-0">Unit Kerja</th>
                                <th class="border-top-0">Wilayah</th>
                                <th class="border-top-0">Tanggal</th>
                                <th class="border-top-0">Banyaknya Login</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($activities as $activity)

                            @php

                            $date = date('Y-m-d');

                            $actlogin = DB::table('activity_login')
                            ->where([
                                ['user_id', '=', $activity->user_id],
                                ['date', '=', $date],
                            ])
                            ->count();

                            @endphp
                            <tr>
                                <td class="text-truncate">
                                    <span class="avatar avatar-xs">
                                        <img class="box-shadow-2" src="assets/content/images/portrait/small/avatar-s-3.png" alt="avatar">
                                    </span>
                                    <span>{{ $activity->first_name }}</span>
                                </td>
                                <td class="text-truncate">{{ $activity->unitkerja_name }}</td>
                                <td class="text-truncate">{{ $activity->wilayah_name }}</td>
                                <td class="text-truncate">{{ date('d M Y', strtotime($date)) }}</td>
                                <td class="text-truncate"><button type="button" onclick="DetailLogin({{ $activity->user_id }})" class="btn btn-sm btn-outline-primary round" data-toggle="modal" data-backdrop="false" data-target="#detailogin_modal">{{ $actlogin }} Kali</button></td>
                            </tr>
                            @endforeach
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
@stop