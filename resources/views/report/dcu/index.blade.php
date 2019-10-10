@extends('layouts.content')
@section('content')
<!-- Zero configuration table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Report Daily Checkup</h4>
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
                                                    <h3 style="display: block;" class="text-white isi" id="sakit">3</h3>
                                                    <span>DCU Kondisi Sakit</span>
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
                                                    <h3 style="display: block;" class="text-white isi" id="sehat">9</h3>
                                                    <span>DCU Kondisi Sehat</span>
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
                                                        <th>Unit Kerja</th>
                                                        <th>Suhu</th>
                                                        <th>Tekanan Darah</th>
                                                        <th>Tanggal</th>
                                                        <th>Kondisi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Mahmud Abbas Kean</td>
                                                        <td>MOR I - Medan</td>
                                                        <td>25 C</td>
                                                        <td>100/70 mmHg</td>
                                                        <td>12 Sep 2019</td>
                                                        <td><div class="badge border-success success badge-border">Sehat</div></td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Khoirul Jadid</td>
                                                        <td>MOR I - Batam</td>
                                                        <td>27 C</td>
                                                        <td>110/70 mmHg</td>
                                                        <td>12 Sept 2019</td>
                                                        <td><div class="badge border-success success badge-border">Sehat</div></td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>Yudi Kurniawan</td>
                                                        <td>MOR I - Batam</td>
                                                        <td>34 C</td>
                                                        <td>120/70 mmHg</td>
                                                        <td>23 Sep 2019</td>
                                                        <td><div class="badge border-danger danger badge-border">Sakit</div></td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>Yustiansyah</td>
                                                        <td>MOR II - Palembang</td>
                                                        <td>27 C</td>
                                                        <td>110/70 mmHg</td>
                                                        <td>22 Sep 2019</td>
                                                        <td><div class="badge border-success success badge-border">Sehat</div></td>
                                                    </tr>
                                                    <tr>
                                                        <td>5</td>
                                                        <td>Karina Yustisio</td>
                                                        <td>MOR III - Plumpang</td>
                                                        <td>26 C</td>
                                                        <td>100/80 mmHg</td>
                                                        <td>11 Sep 2019</td>
                                                        <td><div class="badge border-success success badge-border">Sehat</div></td>
                                                    </tr>
                                                    <tr>
                                                        <td>6</td>
                                                        <td>Yusuf Waringin</td>
                                                        <td>MOR II - Bengkulu</td>
                                                        <td>28 C</td>
                                                        <td>130/80 mmHg</td>
                                                        <td>21 Sep 2019</td>
                                                        <td><div class="badge border-danger danger badge-border">Sakit</div></td>
                                                    </tr>
                                                    <tr>
                                                        <td>7</td>
                                                        <td>Wahdi Osman</td>
                                                        <td>MOR III - Kramat Raya</td>
                                                        <td>25 C</td>
                                                        <td>110/80 mmHg</td>
                                                        <td>24 Sep 2019</td>
                                                        <td><div class="badge border-success success badge-border">Sehat</div></td>
                                                    </tr>
                                                    <tr>
                                                        <td>8</td>
                                                        <td>Erha Ismayanto</td>
                                                        <td>MOR I - Medan</td>
                                                        <td>26 C</td>
                                                        <td>90/80 mmHg</td>
                                                        <td>17 Sep 2019</td>
                                                        <td><div class="badge border-success success badge-border">Sehat</div></td>
                                                    </tr>
                                                    <tr>
                                                        <td>9</td>
                                                        <td>Indra Rahmayadi</td>
                                                        <td>MOR III - Plumpang</td>
                                                        <td>27 C</td>
                                                        <td>110/90 mmHg</td>
                                                        <td>22 Sep 2019</td>
                                                        <td><div class="badge border-success success badge-border">Sehat</div></td>
                                                    </tr>
                                                    <tr>
                                                        <td>10</td>
                                                        <td>Uus Wicaksono</td>
                                                        <td>MOR II - Palembang</td>
                                                        <td>27.5 C</td>
                                                        <td>115/90 mmHg</td>
                                                        <td>19 Sep 2019</td>
                                                        <td><div class="badge border-danger danger badge-border">Sakit</div></td>
                                                    </tr>
                                                    <tr>
                                                        <td>11</td>
                                                        <td>Oman Sulaeman</td>
                                                        <td>MOR I - Medan</td>
                                                        <td>26.5 C</td>
                                                        <td>100/90 mmHg</td>
                                                        <td>9 Sep 2019</td>
                                                        <td><div class="badge border-success success badge-border">Sehat</div></td>
                                                    </tr>
                                                    <tr>
                                                        <td>12</td>
                                                        <td>Bowo Alpenieble</td>
                                                        <td>MOR III - Plumpang</td>
                                                        <td>27.5 C</td>
                                                        <td>110/90 mmHg</td>
                                                        <td>12 Sep 2019</td>
                                                        <td><div class="badge border-success success badge-border">Sehat</div></td>
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
                                                        <th>Unit Kerja</th>
                                                        <th>Suhu</th>
                                                        <th>Tekanan Darah</th>
                                                        <th>Tanggal</th>
                                                        <th>Kondisi</th>
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
                                                        <th>Unit Kerja</th>
                                                        <th>Suhu</th>
                                                        <th>Tekanan Darah</th>
                                                        <th>Tanggal</th>
                                                        <th>Kondisi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Karina Yustisio</td>
                                                        <td>MOR III - Plumpang</td>
                                                        <td>26 C</td>
                                                        <td>100/80 mmHg</td>
                                                        <td>11 Sep 2019</td>
                                                        <td><div class="badge border-success success badge-border">Sehat</div></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Wahdi Osman</td>
                                                        <td>MOR III - Kramat Raya</td>
                                                        <td>25 C</td>
                                                        <td>110/80 mmHg</td>
                                                        <td>24 Sep 2019</td>
                                                        <td><div class="badge border-success success badge-border">Sehat</div></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td>3</td>
                                                        <td>Indra Rahmayadi</td>
                                                        <td>MOR III - Plumpang</td>
                                                        <td>27 C</td>
                                                        <td>110/90 mmHg</td>
                                                        <td>22 Sep 2019</td>
                                                        <td><div class="badge border-success success badge-border">Sehat</div></td>
                                                    </tr>
                                                   
                                                    <tr>
                                                        <td>4</td>
                                                        <td>Bowo Alpenieble</td>
                                                        <td>MOR III - Plumpang</td>
                                                        <td>27.5 C</td>
                                                        <td>110/90 mmHg</td>
                                                        <td>12 Sep 2019</td>
                                                        <td><div class="badge border-success success badge-border">Sehat</div></td>
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
                                                        <th>Unit Kerja</th>
                                                        <th>Suhu</th>
                                                        <th>Tekanan Darah</th>
                                                        <th>Tanggal</th>
                                                        <th>Kondisi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Karina Yustisio</td>
                                                        <td>MOR III - Plumpang</td>
                                                        <td>26 C</td>
                                                        <td>100/80 mmHg</td>
                                                        <td>11 Sep 2019</td>
                                                        <td><div class="badge border-success success badge-border">Sehat</div></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Indra Rahmayadi</td>
                                                        <td>MOR III - Plumpang</td>
                                                        <td>27 C</td>
                                                        <td>110/90 mmHg</td>
                                                        <td>22 Sep 2019</td>
                                                        <td><div class="badge border-success success badge-border">Sehat</div></td>
                                                    </tr>
                                                   
                                                    <tr>
                                                        <td>3</td>
                                                        <td>Bowo Alpenieble</td>
                                                        <td>MOR III - Plumpang</td>
                                                        <td>27.5 C</td>
                                                        <td>110/90 mmHg</td>
                                                        <td>12 Sep 2019</td>
                                                        <td><div class="badge border-success success badge-border">Sehat</div></td>
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
                                                        <th>Unit Kerja</th>
                                                        <th>Suhu</th>
                                                        <th>Tekanan Darah</th>
                                                        <th>Tanggal</th>
                                                        <th>Kondisi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                    
                                                    
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Wahdi Osman</td>
                                                        <td>MOR III - Kramat Raya</td>
                                                        <td>25 C</td>
                                                        <td>110/80 mmHg</td>
                                                        <td>24 Sep 2019</td>
                                                        <td><div class="badge border-success success badge-border">Sehat</div></td>
                                                    </tr>
                                                    
                                                    
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
                                                        <th>Unit Kerja</th>
                                                        <th>Suhu</th>
                                                        <th>Tekanan Darah</th>
                                                        <th>Tanggal</th>
                                                        <th>Kondisi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                    <tr>
                                                        <td>4</td>
                                                        <td>Yustiansyah</td>
                                                        <td>MOR II - Palembang</td>
                                                        <td>27 C</td>
                                                        <td>110/70 mmHg</td>
                                                        <td>22 Sep 2019</td>
                                                        <td><div class="badge border-success success badge-border">Sehat</div></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td>6</td>
                                                        <td>Yusuf Waringin</td>
                                                        <td>MOR II - Bengkulu</td>
                                                        <td>28 C</td>
                                                        <td>130/80 mmHg</td>
                                                        <td>21 Sep 2019</td>
                                                        <td><div class="badge border-danger danger badge-border">Sakit</div></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td>10</td>
                                                        <td>Uus Wicaksono</td>
                                                        <td>MOR II - Palembang</td>
                                                        <td>27.5 C</td>
                                                        <td>115/90 mmHg</td>
                                                        <td>19 Sep 2019</td>
                                                        <td><div class="badge border-danger danger badge-border">Sakit</div></td>
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
                                                        <th>Unit Kerja</th>
                                                        <th>Suhu</th>
                                                        <th>Tekanan Darah</th>
                                                        <th>Tanggal</th>
                                                        <th>Kondisi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Mahmud Abbas Kean</td>
                                                        <td>MOR I - Medan</td>
                                                        <td>25 C</td>
                                                        <td>100/70 mmHg</td>
                                                        <td>12 Sep 2019</td>
                                                        <td><div class="badge border-success success badge-border">Sehat</div></td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Khoirul Jadid</td>
                                                        <td>MOR I - Batam</td>
                                                        <td>27 C</td>
                                                        <td>110/70 mmHg</td>
                                                        <td>12 Sept 2019</td>
                                                        <td><div class="badge border-success success badge-border">Sehat</div></td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>Yudi Kurniawan</td>
                                                        <td>MOR I - Batam</td>
                                                        <td>34 C</td>
                                                        <td>120/70 mmHg</td>
                                                        <td>23 Sep 2019</td>
                                                        <td><div class="badge border-danger danger badge-border">Sakit</div></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td>8</td>
                                                        <td>Erha Ismayanto</td>
                                                        <td>MOR I - Medan</td>
                                                        <td>26 C</td>
                                                        <td>90/80 mmHg</td>
                                                        <td>17 Sep 2019</td>
                                                        <td><div class="badge border-success success badge-border">Sehat</div></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td>11</td>
                                                        <td>Oman Sulaeman</td>
                                                        <td>MOR I - Medan</td>
                                                        <td>26.5 C</td>
                                                        <td>100/90 mmHg</td>
                                                        <td>9 Sep 2019</td>
                                                        <td><div class="badge border-success success badge-border">Sehat</div></td>
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
@include('scripts.reportdcu')
@stop