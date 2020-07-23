@extends('layouts.content')
@section('content')
<!-- Zero configuration table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Periode Penilaian</h4>
                    <br><button class="btn btn-success" onclick="TambahPeriode();"><i class="la la-plus"></i> Tambah Periode Scoring</button> 
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
                                        <th>Nama Periode</th>
                                        <th>Dari</th>
                                        <th>Sampai</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>  
                                @php $no=0; @endphp
                                @foreach($periods as $period) 

                                @php

                                    $no++;

                                @endphp
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $period->name }}</td>
                                        <td>{{ date('d F Y', strtotime($period->dari)) }}</td>
                                        <td>{{ date('d F Y', strtotime($period->sampai)) }}</td>
                                        <td width="20%"><button class="btn btn-sm btn-info" onclick="Edit({{ $period->id }})"> <i class="la la-edit"></i> Edit</button> <button class="btn btn-sm btn-danger" onclick="Delete({{ $period->id }})" data-id="'+row.id+'" > <i class="la la-trash"></i> Delete</button></td>
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
@include('content.scoring.period.modal')
@include('includes.footer')
<script type="text/javascript">

    function TambahPeriode(){

        $('#tambahperiode').modal('show');

    }

    function Simpan(){

        var empty = false;
        $('input.mandatory').each(function() {
            if ($(this).val() == '') {
                empty = true;
            }
        });
        if (empty) {

            swal({
                title: "Warning!!",
                text: "Harap isi Isian yang Wajib diisi!",
                icon: "error",
                buttons: false,
                timer: 2000,
            });

        } else {

            $.ajax({
                type: 'POST',
                url: "{{ route('simpanperiod') }}",
                data: {
                    '_token': $('input[name=_token]').val(),
                    'nama': $('#nama').val(),
                    'dari': $('#dari').val(),
                    'sampai': $('#sampai').val(),
                   },
                success: function(data) {

                    if(data == 0){

                        $('#tambahperiode').modal('hide');

                        swal({
                            title: "Berhasil!!",
                            text: "Periode Berhasil Tersimpan!",
                            icon: "success",
                            buttons: false,
                            timer: 2000,
                        });

                        setTimeout(function(){ window.location.reload() }, 1500);

                    } else {

                        swal({
                            title: "Warning!!",
                            text: "Periode Tersebut Sudah Ada!",
                            icon: "warning",
                            buttons: false,
                            timer: 2000,
                        });

                    }


                }

            });


        }   

    }

    function Delete(id){

        $('#periodid').val(id);
        $('#deleteperiod').modal('show');

    }

    function Yakin(){

        $('#deleteperiod').modal('hide');

        $.ajax({
           type: 'POST',
           url: "{{ route('deleteperiod') }}",
           data: {
                '_token': $('input[name=_token]').val(),
                'id': $('#periodid').val()
            },
           success: function(data) {

                swal("Periode berhasil Terhapus!", {
                   icon: "success",
                   buttons: false,
                   timer: 2000,
                });
                
                setTimeout(function(){ window.location.reload() }, 1500);
           }
       });
    }


    function Edit(id){

        $.ajax({
           type: 'POST',
           url: "{{ route('editperiod') }}",
           data: {
                '_token': $('input[name=_token]').val(),
                'id': id
            },
           success: function(data) {

            $('#namaedit').val(data.name);
            $('#dariedit').val(data.dari);
            $('#sampaiedit').val(data.sampai);
            $('#id').val(id);

           }
        });

        $('#editperiod').modal('show');

    }

    function Update(){

        var empty = false;
        $('input.editmandatory').each(function() {
            if ($(this).val() == '') {
                empty = true;
            }
        });
        if (empty) {

            swal({
                title: "Warning!!",
                text: "Harap isi Isian yang Berbintang!",
                icon: "error",
                buttons: false,
                timer: 2000,
            });

        } else {

            $('#editperiod').modal('hide');

            $.ajax({
                type: 'POST',
                url: "{{ route('updateperiod') }}",
                data: {
                    '_token': $('input[name=_token]').val(),
                    'nama': $('#namaedit').val(),
                    'dari': $('#dariedit').val(),
                    'sampai': $('#sampaiedit').val(),
                    'id': $('#id').val(),
                    
                },
                success: function(data) {

                    swal({
                        title: "Berhasil!",
                        text: "Periode Berhasil Diupdate",
                        icon: "success",
                        buttons: false,
                        timer: 2000,
                    });

                    setTimeout(function(){ window.location.reload() }, 1500);
                }

            });

        }

    }

</script>
@stop