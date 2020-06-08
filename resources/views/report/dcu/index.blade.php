@extends('layouts.content')
@section('content')
<!-- Zero configuration table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>Report Daily Checkup</h2>
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
                            <div class="col-12">
                                <p>Pilih Unit Kerja :</p>
                                <select class="form-control" id="unitkerja">
                                   <option value="">All</option>
                                   @foreach($unitkerjas as $unitkerja)
                                   <option value="{{ $unitkerja->id }}">{{ $unitkerja->unitkerja_name }}</option>
                                   @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-content collapse show">
                                        <button class="btn btn-success" id="excel">Export Excel</button> <button class="btn btn-danger">Export PDF</button>
                                        <br><br>
                                        <div class="table-responsive">
                                            <table width="100%" class="table table-striped table-bordered datatables">
                                                <thead>
                                                    <tr>
                                                        <th>Nopeg</th>
                                                        <th>Pengemudi</th>
                                                        <th>Tanggal</th>
                                                        <th>Waktu</th>
                                                        <th>Suhu</th>
                                                        <th>T.Darah</th>
                                                        <th>U.Kerja</th>
                                                        <th>Status</th>
                                                        <th>Doc</th>
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
</section>
<!--/ Zero configuration table -->
@include('report.dcu.modal')
@include('includes.footer')
<script type="text/javascript">
    
    $('#excel').on('click', function () {

        var dari = $('#dari').val();
        var sampai = $('#sampai').val();
        var unitkerja = $('#unitkerja').val();


        setTimeout(function(){ window.location.href = '/reportdcu/printexcel?dari='+dari+'&sampai='+sampai+'&unit='+unitkerja+''; }, 1500);

    });

</script>
@include('scripts.reportdcu')
@stop