@extends('layouts.content')
@section('content')
<!-- Zero configuration table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>Report Total Kilometer Unit</h2>
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
                            <div class="col-5">
                                <p>Pilih Tanggal Dari :</p>
                                <input type="date" class="form-control" value="{{ $awal }}" id="dari">
                            </div>
                            <div class="col-5">
                                <p>Pilih Tanggal Sampai :</p>
                                <input type="date" class="form-control" value="{{ $akhir }}" id="sampai">
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
                                                        <th>Merk</th>
                                                        <th>Tahun</th>
                                                        <th>No Police</th>
                                                        <th>Total KM</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($units as $unit)

                                                    @php
                                                    $totals = DB::table('driving')
                                                    ->leftJoin("clocks", "clocks.id", "=", "driving.clock_id")
                                                    ->where('driving.unit_id', '=', $unit->id)
                                                    ->whereBetween('clockin_date', [$awal, $akhir])
                                                    ->get();

                                                    $grandtotal = 0;
                                                    foreach($totals as $total){

                                                        if($total->km_akhir == null){

                                                            $akhirs = $total->km_awal;

                                                        } else {

                                                            $akhirs = $total->km_akhir;

                                                        }

                                                        $totalnya = $akhirs - $total->km_awal;

                                                        $grandtotal += $totalnya;

                                                    }


                                                    @endphp

                                                    <tr>
                                                        <td>{{ $unit->merk }} {{ $unit->model }}</td>
                                                        <td>{{ $unit->years }}</td>
                                                        <td>{{ $unit->no_police }}</td>
                                                        <td>{{ $grandtotal }}</td>
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


        setTimeout(function(){ window.location.href = '/reporttotalkm/printexcel?dari='+dari+'&sampai='+sampai+''; }, 500);

    });

    $(function() {

        $('.datatables').DataTable();

    });

    $('#cari').on('click', function () {

        var dari = $('#dari').val();
        var sampai = $('#sampai').val();

        setTimeout(function(){ window.location.href = '/reporttotalkm/detail?dari='+dari+'&sampai='+sampai+''; }, 500);

    });
    

</script>
@stop