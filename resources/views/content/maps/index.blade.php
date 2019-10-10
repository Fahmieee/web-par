@extends('layouts.content')
@section('content')
<!-- Zero configuration table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Report Clock In-Out</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">

                        <div align="center" style="width: 740px; height: 300px;">
                            {!! Mapper::render() !!}
                        </div>
                        
                        <div class="row">
                            <div class="col-6">
                                <p>Pilih Tanggal Dari :</p>
                                <input type="date" class="form-control" id="dari">
                            </div>
                            <div class="col-6">
                                <p>Pilih Tanggal Sampai :</p>
                                <input type="date" class="form-control" id="sampai">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-6">
                                <p>Pilih Unit Kerja :</p>
                                <select class="form-control" id="unitkerja">
                                   <option>All</option>
                                   <option value="mori">MOR I</option>
                                   <option value="morii">MOR II</option>
                                   <option value="moriii">MOR III</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <p>Pilih Wilayah :</p>
                                <select class="form-control" id="wilayah">
                                   <option>All</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        
                        <div class="row">

                            <div class="col-xl-6 col-lg-6 col-12">
                                <div class="card bg-gradient-directional-danger">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="media-body text-white text-left">
                                                    <div class="ball-pulse-sync loader-white loaderz" style="display: none;">
                                                        <div></div>
                                                        <div></div>
                                                        <div></div>
                                                    </div>
                                                    <h3 style="display: block;" class="text-white isi" id="lembur">4</h3>
                                                    <span>Lembur</span>
                                                </div>
                                                <div class="align-self-center">
                                                    <i class="icon-cup text-white font-large-2 float-right"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <div class="card bg-gradient-directional-success">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="media-body text-white text-left">
                                                    <div class="ball-pulse-sync loader-white loaderz" style="display: none;">
                                                        <div></div>
                                                        <div></div>
                                                        <div></div>
                                                    </div>
                                                    <h3 style="display: block;" class="text-white isi" id="tidaklembur">8</h3>
                                                    <span>Tidak Lembur</span>
                                                </div>
                                                <div class="align-self-center">
                                                    <i class="icon-like text-white font-large-2 float-right"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-content" id="loadercontent" style="display: none;">
                            <div class="card-body text-center">
                                <div class="loader-wrapper">
                                    <div class="loader-container">
                                        <div class="ball-pulse-rise loader-success">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        {{ csrf_field() }}
                        <div class="row tabelisi" id="contents" style="display: block;">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered dataex-html5-export">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Pengemudi</th>
                                                        <th>Tanggal</th>
                                                        <th>Clock In</th>
                                                        <th>Clock Out</th>
                                                        <th>Unit Kerja</th>
                                                        <th>Lembur</th>
                                                        <th>Jam Lembur</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Mahmud Abbas Kean</td>
                                                        <td>12 Sep 2019</td>
                                                        <th>09:00:45</th>
                                                        <th>16:50:00</th>
                                                        <td>MOR I - Medan</td>
                                                        <td><div class="badge border-danger danger badge-border">Tidak Lembur</div></td>
                                                        <td>-</td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Khoirul Jadid</td>
                                                        <td>12 Sept 2019</td>
                                                        <th>08:00:45</th>
                                                        <th>18:02:00</th>
                                                        <td>MOR I - Batam</td>
                                                        <td><div class="badge border-success success badge-border">Lembur</div></td>
                                                        <td>01:02:00</td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>Yudi Kurniawan</td>
                                                        <td>23 Sep 2019</td>
                                                        <th>09:00:45</th>
                                                        <th>19:02:00</th>
                                                        <td>MOR I - Batam</td>
                                                        <td><div class="badge border-success success badge-border">Lembur</div></td>
                                                        <td>02:02:00</td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>Yustiansyah</td>
                                                        <td>22 Sep 2019</td>
                                                        <th>09:23:45</th>
                                                        <th>18:32:11</th>
                                                        <td>MOR II - Palembang</td>
                                                        <td><div class="badge border-success success badge-border">Lembur</div></td>
                                                        <td>01:32:11</td>
                                                    </tr>
                                                    <tr>
                                                        <td>5</td>
                                                        <td>Karina Yustisio</td>
                                                        <td>11 Sep 2019</td>
                                                        <th>08:45:25</th>
                                                        <th>16:02:00</th>
                                                        <td>MOR III - Plumpang</td>
                                                        <td><div class="badge border-danger danger badge-border">Tidak Lembur</div></td>
                                                        <td>-</td>
                                                    </tr>
                                                    <tr>
                                                        <td>6</td>
                                                        <td>Yusuf Waringin</td>
                                                        <td>21 Sep 2019</td>
                                                        <th>08:50:12</th>
                                                        <th>17:02:00</th>
                                                        <td>MOR II - Bengkulu</td>
                                                        <td><div class="badge border-danger danger badge-border">Tidak Lembur</div></td>
                                                        <td>-</td>
                                                    </tr>
                                                    <tr>
                                                        <td>7</td>
                                                        <td>Wahdi Osman</td>
                                                        <td>24 Sep 2019</td>
                                                        <th>08:49:32</th>
                                                        <th>17:05:00</th>
                                                        <td>MOR III - Kramat Raya</td>
                                                        <td><div class="badge border-danger danger badge-border">Tidak Lembur</div></td>
                                                        <td>-</td>
                                                    </tr>
                                                    <tr>
                                                        <td>8</td>
                                                        <td>Erha Ismayanto</td>
                                                        <td>17 Sep 2019</td>
                                                        <th>08:35:22</th>
                                                        <th>16:56:00</th>
                                                        <td>MOR I - Medan</td>
                                                        <td><div class="badge border-danger danger badge-border">Tidak Lembur</div></td>
                                                        <td>-</td>
                                                    </tr>
                                                    <tr>
                                                        <td>9</td>
                                                        <td>Indra Rahmayadi</td>
                                                        <td>22 Sep 2019</td>
                                                        <th>07:56:22</th>
                                                        <th>17:02:00</th>
                                                        <td>MOR III - Plumpang</td>
                                                        <td><div class="badge border-danger danger badge-border">Tidak Lembur</div></td>
                                                        <td>-</td>
                                                    </tr>
                                                    <tr>
                                                        <td>10</td>
                                                        <td>Uus Wicaksono</td>
                                                        <td>19 Sep 2019</td>
                                                        <th>08:50:12</th>
                                                        <th>21:22:00</th>
                                                        <td>MOR II - Palembang</td>
                                                        <td><div class="badge border-success success badge-border">Lembur</div></td>
                                                        <td>04:22:00</td>
                                                    </tr>
                                                    <tr>
                                                        <td>11</td>
                                                        <td>Oman Sulaeman</td>
                                                        <td>9 Sep 2019</td>
                                                        <th>08:23:33</th>
                                                        <th>16:43:24</th>
                                                        <td>MOR I - Medan</td>
                                                        <td><div class="badge border-danger danger badge-border">Tidak Lembur</div></td>
                                                        <td>-</td>
                                                    </tr>
                                                    <tr>
                                                        <td>12</td>
                                                        <td>Bowo Alpenieble</td>
                                                        <td>12 Sep 2019</td>
                                                        <th>07:46:12</th>
                                                        <th>17:00:56</th>
                                                        <td>MOR III - Plumpang</td>
                                                        <td><div class="badge border-danger danger badge-border">Tidak Lembur</div></td>
                                                        <td>-</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ Zero configuration table -->

@include('includes.footer')
@stop