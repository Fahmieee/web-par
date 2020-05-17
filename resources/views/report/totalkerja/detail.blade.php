@extends('layouts.content')
@section('content')
<!-- Zero configuration table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>Report Total Kerja Driver</h2>
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
                            <div class="col-3">
                                <p>Pilih Tanggal Dari :</p>
                                <input type="date" class="form-control" value="{{ $awal }}" id="dari">
                            </div>
                            <div class="col-3">
                                <p>Pilih Tanggal Sampai :</p>
                                <input type="date" class="form-control" value="{{ $akhir }}" id="sampai">
                            </div>
                            <div class="col-4">
                                <p>Pilih Unit Kerja :</p>
                                <select class="form-control select2" id="unitkerja">
                                    @if($units == '')
                                    <option value="" selected>All</option>
                                    @else
                                    <option value="">All</option>
                                    @endif
                                    @foreach($unitkerjas as $unitkerja)
                                    @php
                                    if($unitkerja->id == $units){
                                        $selected = 'selected';
                                    } else {
                                        $selected = '';
                                    }

                                   @endphp
                                   <option value="{{ $unitkerja->id }}" {{ $selected }}>{{ $unitkerja->unitkerja_name }}</option>
                                   @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <p></p>
                                <button id="cari" class="btn btn-glow btn-lg btn-info"> Cari</button>
                            </div>
                        </div>
                        <br>
                        <hr>
                        <!-- {{ csrf_field() }} -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-content collapse show">
                                        <button class="btn btn-success" id="excel">Export Excel</button><br><br>
                                        <div class="table-responsive">
                                            <table width="100%" class="table table-striped table-bordered datatables">
                                                <thead>
                                                    <tr>
                                                        <th>Nopeg</th>
                                                        <th>Pengemudi</th>
                                                        <th>Unit Kerja</th>
                                                        <th>Total Kerja</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($clocks as $clock)

                                                    @php
                                                    $totals = DB::table('clocks')
                                                    ->where('user_id', '=', $clock->id)
                                                    ->whereBetween('clockin_date', [$awal, $akhir])
                                                    ->get();

                                                    $totalsemua = 0;
                                                    $totaljam = null;

                                                    foreach($totals as $total){

                                                        if($total->clockout_date == null){

                                                            $clockouts = $total->clockin_date;
                                                            $clocksouttimes = '17:00';

                                                        } else {

                                                            if($total->clockin_date != $total->clockout_date){

                                                                $clockouts = $total->clockin_date;
                                                                $clocksouttimes = '17:00';

                                                            } else {

                                                                $clockouts = $total->clockout_date;
                                                                $clocksouttimes = $total->clockout_time;

                                                            }

                                                        }

                                                    $waktu_awal = strtotime($total->clockin_date.' '.$total->clockin_time);
                                                    $waktu_akhir = strtotime($clockouts.' '.$clocksouttimes);

                                                    $diff = $waktu_akhir - $waktu_awal;

                                                    $totalsemua += $diff;

                                                    $totaljam .= $total->clockin_date;

                                                    }

                                                    $jam = floor($totalsemua / (60 * 60));
                                                    $menit = $totalsemua - $jam * (60 * 60);

                                                    @endphp
                                                    <tr>
                                                        <td>{{ $clock->username }}</td>
                                                        <td>{{ $clock->first_name }}</td>
                                                        <td>{{ $clock->unitkerja_name }}</td>
                                                        <td>{{ $jam }} Jam {{ floor( $menit / 60 ) }} Menit</td>
                                                    </tr>
                                                    @endforeach
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

@include('includes.footer')
<script type="text/javascript">
    
    $('#excel').on('click', function () {

        var dari = $('#dari').val();
        var sampai = $('#sampai').val();
        var unitkerja = $('#unitkerja').val();


        setTimeout(function(){ window.location.href = '/reporttotalkerja/printexcel?dari='+dari+'&sampai='+sampai+'&unit='+unitkerja+''; }, 1500);

    });

    $(function() {

        $('.datatables').DataTable();

    });

    $('#cari').on('click', function () {

        var dari = $('#dari').val();
        var sampai = $('#sampai').val();
        var unitkerja = $('#unitkerja').val();

        setTimeout(function(){ window.location.href = '/reporttotalkerja/detail?dari='+dari+'&sampai='+sampai+'&unitkerja='+unitkerja+''; }, 500);

    });



</script>
@stop