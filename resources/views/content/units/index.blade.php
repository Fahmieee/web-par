@extends('layouts.content')
@section('content')
<!-- Zero configuration table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>Master Unit</h2>
                    <div>Berisi Data-data kendaraan dari Driver</div>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <button class="btn btn-success" onclick="Tambah()"> Tambah Unit</button>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered datatables" width="100%">
                                <thead>
                                    <tr>
                                        <th style="display: none;">ID</th>
                                        <th>Merk</th>
                                        <th>Model</th>
                                        <th>Varian</th>
                                        <th>Tahun</th>
                                        <th>Transmisi</th>
                                        <th>Mes</th>
                                        <th>Nopol</th>
                                        <th>Km</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                {{ csrf_field() }}
                                <tbody>   
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
@include('content.units.modal')
@include('includes.footer')
@include('scripts.units')
@stop