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
                        {{ csrf_field() }}
                        <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered datatables">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Pengemudi</th>
                                                        <th>Tanggal</th>
                                                        <th>Clockin</th>
                                                        <th>Clockout</th>
                                                        <th>In Km</th>
                                                        <th>Out Km</th>
                                                        <th>Unit</th>
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
                        </div>

                        <div class="row tabelisi" id="morii" style="display: none;">
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
                                                        <td>Yustiansyah</td>
                                                        <td>22 Sep 2019</td>
                                                        <th>09:23:45</th>
                                                        <th>18:32:11</th>
                                                        <td>MOR II - Palembang</td>
                                                        <td><div class="badge border-success success badge-border">Lembur</div></td>
                                                        <td>01:32:11</td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Yusuf Waringin</td>
                                                        <td>21 Sep 2019</td>
                                                        <th>08:50:12</th>
                                                        <th>17:02:00</th>
                                                        <td>MOR II - Bengkulu</td>
                                                        <td><div class="badge border-danger danger badge-border">Tidak Lembur</div></td>
                                                        <td>-</td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td>3</td>
                                                        <td>Uus Wicaksono</td>
                                                        <td>19 Sep 2019</td>
                                                        <th>08:50:12</th>
                                                        <th>21:22:00</th>
                                                        <td>MOR II - Palembang</td>
                                                        <td><div class="badge border-success success badge-border">Lembur</div></td>
                                                        <td>04:22:00</td>
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>

                        <div class="row tabelisi" id="mori" style="display: none;">
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
                                                        <td>Erha Ismayanto</td>
                                                        <td>17 Sep 2019</td>
                                                        <th>08:35:22</th>
                                                        <th>16:56:00</th>
                                                        <td>MOR I - Medan</td>
                                                        <td><div class="badge border-danger danger badge-border">Tidak Lembur</div></td>
                                                        <td>-</td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td>5</td>
                                                        <td>Oman Sulaeman</td>
                                                        <td>9 Sep 2019</td>
                                                        <th>08:23:33</th>
                                                        <th>16:43:24</th>
                                                        <td>MOR I - Medan</td>
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
@include('scripts.reportclockinout')
@stop