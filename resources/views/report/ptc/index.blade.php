@extends('layouts.content')
@section('content')
<!-- Zero configuration table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Report Pre Trip-Check</h4>
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
                        <br>
                        <div class="row">
                            <div class="col-4">
                                <p>Pilih Bagian :</p>
                                <select class="form-control" id="bagian">
                                   <option>All</option>
                                   @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                   @endforeach
                                </select>
                            </div>
                            <div class="col-5">
                                <p>Pilih Bagian Detail:</p>
                                <select class="form-control" id="detail">
                                   <option>All</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <p>Pilih Level:</p>
                                <select class="form-control" id="level">
                                    <option>All</option>
                                   <option>High</option>
                                   <option>Medium</option>
                                   <option>Low</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <br>
                        <div class="row">
                            <!-- <div class="col-6">
                                <div class="order-md-2 mb-2">
                                    <ul class="list-group mb-3 card">
                                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                                            <div>
                                                <h6 class="my-0">All</h6>
                                                <small class="text-muted">Tanggal Dari dan Sampai</small>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                                            <div>
                                                <h6 class="my-0">All</h6>
                                                <small class="text-muted">Bagian mobil</small>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="order-md-2 mb-4">
                                    <ul class="list-group mb-3 card">
                                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                                            <div>
                                                <h6 class="my-0">All</h6>
                                                <small class="text-muted">Unit Kerja</small>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                                            <div>
                                                <h6 class="my-0">All</h6>
                                                <small class="text-muted">Kondisi </small>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div> -->
                            <div class="col-xl-4 col-lg-6 col-12">
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
                                                    <h3 style="display: block;" class="text-white isi" id="total">12</h3>
                                                    <span>Total PTC Bermasalah</span>
                                                </div>
                                                <div class="align-self-center">
                                                    <i class="icon-wrench text-white font-large-2 float-right"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-12">
                                <div class="card bg-gradient-directional-amber">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="media-body text-white text-left">
                                                    <div class="ball-pulse-sync loader-white loaderz" style="display: none;">
                                                        <div></div>
                                                        <div></div>
                                                        <div></div>
                                                    </div>
                                                    <h3 style="display: block;" class="text-white isi" id="onprogress">7</h3>
                                                    <span>PTC On Progress</span>
                                                </div>
                                                <div class="align-self-center">
                                                    <i class="icon-fire text-white font-large-2 float-right"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-12">
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
                                                    <h3 style="display: block;" class="text-white isi" id="selesai">5</h3>
                                                    <span>PTC Bermasalah Selesai</span>
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
                                                        <th>Nama Unit</th>
                                                        <th>Unit Kerja</th>
                                                        <th>Tanggal</th>
                                                        <th>Bagian</th>
                                                        <th>Detail</th>
                                                        <th>Level</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Mahmud Abbas Kean</td>
                                                        <td>B 9089 KLS</td>
                                                        <td>MOR I - Medan</td>
                                                        <td>4 Sep 2019</td>
                                                        <td>Electrical</td>
                                                        <td>Blower Fan (AC)</td>
                                                        <td>High</td>
                                                        <td>
                                                            <div class="badge border-success success badge-border">Selesai</div>
                                                        </td>
                                                        <td><button type="button" class="btn btn-sm btn-success box-shadow-2" data-toggle="modal" data-backdrop="false" data-target="#primary">Detail</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Khoirul Jadid</td>
                                                        <td>B 9089 DDF</td>
                                                        <td>MOR I - Batam</td>
                                                        <td>12 Sept 2019</td>
                                                        <td>Electrical</td>
                                                        <td>Temperatur / Suhu (AC)</td>
                                                        <td>High</td>
                                                        <td>
                                                            <div class="badge border-success success badge-border">Selesai</div>
                                                        </td>
                                                        <td><button type="button" class="btn btn-sm btn-success box-shadow-2" data-toggle="modal" data-backdrop="false" data-target="#primary">Detail</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>Yudi Kurniawan</td>
                                                        <td>B 9088 KLJ</td>
                                                        <td>MOR I - Batam</td>
                                                        <td>23 Sep 2019</td>
                                                        <td>Electrical</td>
                                                        <td>Power Windows Bagian Depan Kiri</td>
                                                        <td>High</td>
                                                        <td>
                                                            <div class="badge border-warning warning badge-border">On Progress</div>
                                                        </td>
                                                        <td><button type="button" class="btn btn-sm btn-success box-shadow-2" data-toggle="modal" data-backdrop="false" data-target="#primary">Detail</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>Yustiansyah</td>
                                                        <td>B 9080 KSJ</td>
                                                        <td>MOR II - Palembang</td>
                                                        <td>22 Sep 2019</td>
                                                        <td>Electrical</td>
                                                        <td>Temperatur / Suhu (AC)</td>
                                                        <td>High</td>
                                                        <td>
                                                            <div class="badge border-warning warning badge-border">On Progress</div>
                                                        </td>
                                                        <td><button type="button" class="btn btn-sm btn-success box-shadow-2" data-toggle="modal" data-backdrop="false" data-target="#primary">Detail</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>5</td>
                                                        <td>Karina Yustisio</td>
                                                        <td>B 9087 LOJ</td>
                                                        <td>MOR III - Plumpang</td>
                                                        <td>11 Sep 2019</td>
                                                        <td>Electrical</td>
                                                        <td>Fungsi Klakson</td>
                                                        <td>Medium</td>
                                                        <td>
                                                            <div class="badge border-warning warning badge-border">On Progress</div>
                                                        </td>
                                                        <td><button type="button" class="btn btn-sm btn-success box-shadow-2" data-toggle="modal" data-backdrop="false" data-target="#primary">Detail</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>6</td>
                                                        <td>Yusuf Waringin</td>
                                                        <td>B 9980 TTR</td>
                                                        <td>MOR II - Bengkulu</td>
                                                        <td>21 Sep 2019</td>
                                                        <td>Electrical</td>
                                                        <td>Central Door Lock Bagian Belakang Kanan</td>
                                                        <td>High</td>
                                                        <td>
                                                            <div class="badge border-success success badge-border">Selesai</div>
                                                        </td>
                                                        <td><button type="button" class="btn btn-sm btn-success box-shadow-2" data-toggle="modal" data-backdrop="false" data-target="#primary">Detail</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>7</td>
                                                        <td>Wahdi Osman</td>
                                                        <td>B 3321 LOJ</td>
                                                        <td>MOR III - Kramat Raya</td>
                                                        <td>24 Sep 2019</td>
                                                        <td>Electrical</td>
                                                        <td>Fungsi Klakson</td>
                                                        <td>Medium</td>
                                                        <td>
                                                            <div class="badge border-warning warning badge-border">On Progress</div>
                                                        </td>
                                                        <td><button type="button" class="btn btn-sm btn-success box-shadow-2" data-toggle="modal" data-backdrop="false" data-target="#primary">Detail</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>8</td>
                                                        <td>Erha Ismayanto</td>
                                                        <td>B 1198 OOS</td>
                                                        <td>MOR I - Medan</td>
                                                        <td>17 Sep 2019</td>
                                                        <td>Electrical</td>
                                                        <td>Blower Fan (AC)</td>
                                                        <td>High</td>
                                                        <td>
                                                            <div class="badge border-warning warning badge-border">On Progress</div>
                                                        </td>
                                                        <td><button type="button" class="btn btn-sm btn-success box-shadow-2" data-toggle="modal" data-backdrop="false" data-target="#primary">Detail</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>9</td>
                                                        <td>Indra Rahmayadi</td>
                                                        <td>D 6019 KKA</td>
                                                        <td>MOR III - Plumpang</td>
                                                        <td>22 Sep 2019</td>
                                                        <td>Electrical</td>
                                                        <td>Temperatur / Suhu (AC)</td>
                                                        <td>High</td>
                                                        <td>
                                                            <div class="badge border-success success badge-border">Selesai</div>
                                                        </td>
                                                        <td><button type="button" class="btn btn-sm btn-success box-shadow-2" data-toggle="modal" data-backdrop="false" data-target="#primary">Detail</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>10</td>
                                                        <td>Uus Wicaksono</td>
                                                        <td>H 5672 LKS</td>
                                                        <td>MOR II - Palembang</td>
                                                        <td>19 Sep 2019</td>
                                                        <td>Electrical</td>
                                                        <td>Fungsi Klakson</td>
                                                        <td>Medium</td>
                                                        <td>
                                                            <div class="badge border-warning warning badge-border">On Progress</div>
                                                        </td>
                                                        <td><button type="button" class="btn btn-sm btn-success box-shadow-2" data-toggle="modal" data-backdrop="false" data-target="#primary">Detail</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>11</td>
                                                        <td>Oman Sulaeman</td>
                                                        <td>H 8716 IKL</td>
                                                        <td>MOR I - Medan</td>
                                                        <td>9 Sep 2019</td>
                                                        <td>Electrical</td>
                                                        <td>Temperatur / Suhu (AC)</td>
                                                        <td>High</td>
                                                        <td>
                                                            <div class="badge border-success success badge-border">Selesai</div>
                                                        </td>
                                                        <td><button type="button" class="btn btn-sm btn-success box-shadow-2" data-toggle="modal" data-backdrop="false" data-target="#primary">Detail</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>12</td>
                                                        <td>Bowo Alpenieble</td>
                                                        <td>H 8811 IIO</td>
                                                        <td>MOR III - Plumpang</td>
                                                        <td>12 Sep 2019</td>
                                                        <td>Electrical</td>
                                                        <td>Fungsi On / Off (AC)</td>
                                                        <td>High</td>
                                                        <td>
                                                            <div class="badge border-warning warning badge-border">On Progress</div>
                                                        </td>
                                                        <td><button type="button" class="btn btn-sm btn-success box-shadow-2" data-toggle="modal" data-backdrop="false" data-target="#primary">Detail</button></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>

                        <div class="row tabelisi" id="contentkosong" style="display: none;">
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
                                                        <th>Nama Unit</th>
                                                        <th>Unit Kerja</th>
                                                        <th>Tanggal</th>
                                                        <th>Bagian</th>
                                                        <th>Detail</th>
                                                        <th>Level</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
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

                        <div class="row tabelisi" id="unitkerjamori" style="display: none;">
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
                                                        <th>Nama Unit</th>
                                                        <th>Unit Kerja</th>
                                                        <th>Tanggal</th>
                                                        <th>Bagian</th>
                                                        <th>Detail</th>
                                                        <th>Level</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Karina Yustisio</td>
                                                        <td>B 9087 LOJ</td>
                                                        <td>MOR III - Plumpang</td>
                                                        <td>11 Sep 2019</td>
                                                        <td>Electrical</td>
                                                        <td>Fungsi Klakson</td>
                                                        <td>Medium</td>
                                                        <td>
                                                            <div class="badge border-warning warning badge-border">On Progress</div>
                                                        </td>
                                                        <td><button type="button" class="btn btn-sm btn-success box-shadow-2" data-toggle="modal" data-backdrop="false" data-target="#primary">Detail</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Wahdi Osman</td>
                                                        <td>B 3321 LOJ</td>
                                                        <td>MOR III - Kramat Raya</td>
                                                        <td>24 Sep 2019</td>
                                                        <td>Electrical</td>
                                                        <td>Fungsi Klakson</td>
                                                        <td>Medium</td>
                                                        <td>
                                                            <div class="badge border-warning warning badge-border">On Progress</div>
                                                        </td>
                                                        <td><button type="button" class="btn btn-sm btn-success box-shadow-2" data-toggle="modal" data-backdrop="false" data-target="#primary">Detail</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>Indra Rahmayadi</td>
                                                        <td>D 6019 KKA</td>
                                                        <td>MOR III - Plumpang</td>
                                                        <td>22 Sep 2019</td>
                                                        <td>Electrical</td>
                                                        <td>Temperatur / Suhu (AC)</td>
                                                        <td>High</td>
                                                        <td>
                                                            <div class="badge border-success success badge-border">Selesai</div>
                                                        </td>
                                                        <td><button type="button" class="btn btn-sm btn-success box-shadow-2" data-toggle="modal" data-backdrop="false" data-target="#primary">Detail</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>Bowo Alpenieble</td>
                                                        <td>H 8811 IIO</td>
                                                        <td>MOR III - Plumpang</td>
                                                        <td>12 Sep 2019</td>
                                                        <td>Electrical</td>
                                                        <td>Fungsi On / Off (AC)</td>
                                                        <td>High</td>
                                                        <td>
                                                            <div class="badge border-warning warning badge-border">On Progress</div>
                                                        </td>
                                                        <td><button type="button" class="btn btn-sm btn-success box-shadow-2" data-toggle="modal" data-backdrop="false" data-target="#primary">Detail</button></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>

                        <div class="row tabelisi" id="plumpang" style="display: none;">
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
                                                        <th>Nama Unit</th>
                                                        <th>Unit Kerja</th>
                                                        <th>Tanggal</th>
                                                        <th>Bagian</th>
                                                        <th>Detail</th>
                                                        <th>Level</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Karina Yustisio</td>
                                                        <td>B 9087 LOJ</td>
                                                        <td>MOR III - Plumpang</td>
                                                        <td>11 Sep 2019</td>
                                                        <td>Electrical</td>
                                                        <td>Fungsi Klakson</td>
                                                        <td>Medium</td>
                                                        <td>
                                                            <div class="badge border-warning warning badge-border">On Progress</div>
                                                        </td>
                                                        <td><button type="button" class="btn btn-sm btn-success box-shadow-2" data-toggle="modal" data-backdrop="false" data-target="#primary">Detail</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Indra Rahmayadi</td>
                                                        <td>D 6019 KKA</td>
                                                        <td>MOR III - Plumpang</td>
                                                        <td>22 Sep 2019</td>
                                                        <td>Electrical</td>
                                                        <td>Temperatur / Suhu (AC)</td>
                                                        <td>High</td>
                                                        <td>
                                                            <div class="badge border-success success badge-border">Selesai</div>
                                                        </td>
                                                        <td><button type="button" class="btn btn-sm btn-success box-shadow-2" data-toggle="modal" data-backdrop="false" data-target="#primary">Detail</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>Bowo Alpenieble</td>
                                                        <td>H 8811 IIO</td>
                                                        <td>MOR III - Plumpang</td>
                                                        <td>12 Sep 2019</td>
                                                        <td>Electrical</td>
                                                        <td>Fungsi On / Off (AC)</td>
                                                        <td>High</td>
                                                        <td>
                                                            <div class="badge border-warning warning badge-border">On Progress</div>
                                                        </td>
                                                        <td><button type="button" class="btn btn-sm btn-success box-shadow-2" data-toggle="modal" data-backdrop="false" data-target="#primary">Detail</button></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>

                        <div class="row tabelisi" id="kramat" style="display: none;">
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
                                                        <th>Nama Unit</th>
                                                        <th>Unit Kerja</th>
                                                        <th>Tanggal</th>
                                                        <th>Bagian</th>
                                                        <th>Detail</th>
                                                        <th>Level</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Wahdi Osman</td>
                                                        <td>B 3321 LOJ</td>
                                                        <td>MOR III - Kramat Raya</td>
                                                        <td>24 Sep 2019</td>
                                                        <td>Electrical</td>
                                                        <td>Fungsi Klakson</td>
                                                        <td>Medium</td>
                                                        <td>
                                                            <div class="badge border-warning warning badge-border">On Progress</div>
                                                        </td>
                                                        <td><button type="button" class="btn btn-sm btn-success box-shadow-2" data-toggle="modal" data-backdrop="false" data-target="#primary">Detail</button></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="row tabelisi" id="klakson" style="display: none;">
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
                                                        <th>Nama Unit</th>
                                                        <th>Unit Kerja</th>
                                                        <th>Tanggal</th>
                                                        <th>Bagian</th>
                                                        <th>Detail</th>
                                                        <th>Level</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Karina Yustisio</td>
                                                        <td>B 9087 LOJ</td>
                                                        <td>MOR III - Plumpang</td>
                                                        <td>11 Sep 2019</td>
                                                        <td>Electrical</td>
                                                        <td>Fungsi Klakson</td>
                                                        <td>Medium</td>
                                                        <td>
                                                            <div class="badge border-warning warning badge-border">On Progress</div>
                                                        </td>
                                                        <td><button type="button" class="btn btn-sm btn-success box-shadow-2" data-toggle="modal" data-backdrop="false" data-target="#primary">Detail</button></td>
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="row tabelisi" id="suhu" style="display: none;">
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
                                                        <th>Nama Unit</th>
                                                        <th>Unit Kerja</th>
                                                        <th>Tanggal</th>
                                                        <th>Bagian</th>
                                                        <th>Detail</th>
                                                        <th>Level</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Indra Rahmayadi</td>
                                                        <td>D 6019 KKA</td>
                                                        <td>MOR III - Plumpang</td>
                                                        <td>22 Sep 2019</td>
                                                        <td>Electrical</td>
                                                        <td>Temperatur / Suhu (AC)</td>
                                                        <td>High</td>
                                                        <td>
                                                            <div class="badge border-success success badge-border">Selesai</div>
                                                        </td>
                                                        <td><button type="button" class="btn btn-sm btn-success box-shadow-2" data-toggle="modal" data-backdrop="false" data-target="#primary">Detail</button></td>
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>

                        <div class="row tabelisi" id="onoff" style="display: none;">
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
                                                        <th>Nama Unit</th>
                                                        <th>Unit Kerja</th>
                                                        <th>Tanggal</th>
                                                        <th>Bagian</th>
                                                        <th>Detail</th>
                                                        <th>Level</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Bowo Alpenieble</td>
                                                        <td>H 8811 IIO</td>
                                                        <td>MOR III - Plumpang</td>
                                                        <td>12 Sep 2019</td>
                                                        <td>Electrical</td>
                                                        <td>Fungsi On / Off (AC)</td>
                                                        <td>High</td>
                                                        <td>
                                                            <div class="badge border-warning warning badge-border">On Progress</div>
                                                        </td>
                                                        <td><button type="button" class="btn btn-sm btn-success box-shadow-2" data-toggle="modal" data-backdrop="false" data-target="#primary">Detail</button></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="row tabelisi" id="high" style="display: none;">
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
                                                        <th>Nama Unit</th>
                                                        <th>Unit Kerja</th>
                                                        <th>Tanggal</th>
                                                        <th>Bagian</th>
                                                        <th>Detail</th>
                                                        <th>Level</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Indra Rahmayadi</td>
                                                        <td>D 6019 KKA</td>
                                                        <td>MOR III - Plumpang</td>
                                                        <td>22 Sep 2019</td>
                                                        <td>Electrical</td>
                                                        <td>Temperatur / Suhu (AC)</td>
                                                        <td>High</td>
                                                        <td>
                                                            <div class="badge border-success success badge-border">Selesai</div>
                                                        </td>
                                                        <td><button type="button" class="btn btn-sm btn-success box-shadow-2" data-toggle="modal" data-backdrop="false" data-target="#primary">Detail</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Bowo Alpenieble</td>
                                                        <td>H 8811 IIO</td>
                                                        <td>MOR III - Plumpang</td>
                                                        <td>12 Sep 2019</td>
                                                        <td>Electrical</td>
                                                        <td>Fungsi On / Off (AC)</td>
                                                        <td>High</td>
                                                        <td>
                                                            <div class="badge border-warning warning badge-border">On Progress</div>
                                                        </td>
                                                        <td><button type="button" class="btn btn-sm btn-success box-shadow-2" data-toggle="modal" data-backdrop="false" data-target="#primary">Detail</button></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="row tabelisi" id="medium" style="display: none;">
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
                                                        <th>Nama Unit</th>
                                                        <th>Unit Kerja</th>
                                                        <th>Tanggal</th>
                                                        <th>Bagian</th>
                                                        <th>Detail</th>
                                                        <th>Level</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Karina Yustisio</td>
                                                        <td>B 9087 LOJ</td>
                                                        <td>MOR III - Plumpang</td>
                                                        <td>11 Sep 2019</td>
                                                        <td>Electrical</td>
                                                        <td>Fungsi Klakson</td>
                                                        <td>Medium</td>
                                                        <td>
                                                            <div class="badge border-warning warning badge-border">On Progress</div>
                                                        </td>
                                                        <td><button type="button" class="btn btn-sm btn-success box-shadow-2" data-toggle="modal" data-backdrop="false" data-target="#primary">Detail</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Wahdi Osman</td>
                                                        <td>B 3321 LOJ</td>
                                                        <td>MOR III - Kramat Raya</td>
                                                        <td>24 Sep 2019</td>
                                                        <td>Electrical</td>
                                                        <td>Fungsi Klakson</td>
                                                        <td>Medium</td>
                                                        <td>
                                                            <div class="badge border-warning warning badge-border">On Progress</div>
                                                        </td>
                                                        <td><button type="button" class="btn btn-sm btn-success box-shadow-2" data-toggle="modal" data-backdrop="false" data-target="#primary">Detail</button></td>
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
@include('report.ptc.modal')
@include('includes.footer')
@include('scripts.reportptc')

@stop