@extends('layouts.content')
@section('content')
<!-- Zero configuration table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>Report PTC Bermasalah</h2>
                    <div style="font-size: 14px;font-family: 'Quicksand', Georgia, 'Times New Roman', Times, serif; color: #00BCD4;" id="showdate">Tanggal : {{ date('d F Y', strtotime($awal)) }} - {{ date('d F Y', strtotime($akhir)) }}</div>
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
                                <input type="date" class="form-control" value="{{ $awal }}" id="dari">
                            </div>
                            <div class="col-6">
                                <p>Pilih Tanggal Sampai :</p>
                                <input type="date" class="form-control" value="{{ $akhir }}" id="sampai">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-6">
                                <p>Pilih Unit Kerja :</p>
                                <select class="form-control" id="unitkerja">
                                   <option value="">All</option>
                                   @foreach($unitkerjas as $unitkerja)
                                   <option value="{{ $unitkerja->id }}">{{ $unitkerja->unitkerja_name }}</option>
                                   @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <p>Pilih Bagian :</p>
                                <select class="form-control" id="type">
                                   <option value="">All</option>
                                   @foreach($bagians as $bagian)
                                   <option value="{{ $bagian->id }}">{{ $bagian->name }}</option>
                                   @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-content collapse show">
                                        <div class="card-body card-dashboard">
                                            <div class="table-responsive">
                                                <table width="100%" class="table table-striped table-bordered datatables">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Pengemudi</th>
                                                            <th>Unit</th>
                                                            <th>Tanggal</th>
                                                            <th>U.Kerja</th>
                                                            <th>Bagian</th>
                                                            <th>Detail</th>
                                                            <th>Kondisi</th>
                                                            <th>Level</th>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ Zero configuration table -->
<!-- @include('report.ptc.modal') -->
@include('includes.footer')
@include('scripts.reportptcbermasalah')

@stop