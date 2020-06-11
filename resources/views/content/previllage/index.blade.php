@extends('layouts.content')
@section('content')
<!-- Zero configuration table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Previllage</h4><br>
                    <button class="btn btn-success" onclick="TambahPrevillage();"><i class="la la-plus"></i> Tambah Previllage</button> 
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
                                        <th width="3%">No</th>
                                        <th width="30%">Nama Previllages</th>
                                        <th>Menu yang Dibuka</th>
                                        <th width="25%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @php
                                    $no = 0;
                                    @endphp
                                    @foreach($previllages as $previllage)

                                    @php
                                        $no++;
                                        $menus = DB::table('menus')
                                        ->select('menus.*')
                                        ->leftJoin('previllages', 'menus.id', '=', 'previllages.menu_id')
                                        ->where('previllages.role_id', $previllage->id)
                                        ->get();
                                    @endphp
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $previllage->name }}</td>
                                        <td>
                                            @foreach($menus as $menu)
                                            {{ $menu->name }}, 
                                            @endforeach
                                        </td>
                                        <td>
                                           <a href="/previllage/edit?id={{ $previllage->id }}"><button class="btn btn-sm btn-info"><i class="la la-edit"></i> Edit</button></a>
                                           <button class="btn btn-sm btn-danger" onclick="Delete({{ $previllage->id }})"><i class="la la-remove"></i> Hapus</button>
                                        </td>
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
@include('content.previllage.modal')
@include('includes.footer')
@include('scripts.previllage')
@stop