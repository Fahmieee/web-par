@extends('layouts.content')
@section('content')
<!-- Zero configuration table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Keluhan</h4>
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
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered datatables">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Keluhan</th>
                                        <th>Nama User</th>
                                        <th>Jabatan User</th>
                                        <th>Type</th>
                                        <th>Objek</th>
                                        <th>Isi Keluhan</th>
                                    </tr>
                                </thead>
                                <tbody>  
                                @php $no=0; @endphp
                                @foreach($keluhans as $keluhan) 

                                @php

                                    $objek = DB::table('users')
                                    ->select("users.first_name","units.no_police")
                                    ->leftJoin("drivers", "users.id", "=", "drivers.driver_id")
                                    ->leftJoin("units", "drivers.unit_id", "=", "units.id")
                                    ->where('users.id', $keluhan->driver_id)
                                    ->first();

                                    $no++;

                                @endphp
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $keluhan->jenis }}</td>
                                        <td>{{ $keluhan->first_name }}</td>
                                        <td>{{ $keluhan->jabatan_name }}</td>
                                        <td>{{ $keluhan->type }}</td>
                                        <td>{{ $objek->first_name }} - {{ $objek->no_police }}</td>
                                        <td>{{ $keluhan->ket }}</td>
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
</section>
<!--/ Zero configuration table -->

@include('includes.footer')
<script type="text/javascript">

</script>
@stop