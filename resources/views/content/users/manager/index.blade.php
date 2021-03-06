@extends('layouts.content')
@section('content')
<!-- Zero configuration table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Manager</h4><br>
                    <button class="btn btn-success" onclick="TambahManager();"><i class="la la-plus"></i> Tambah Manager</button> 
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
                            <table class="table table-striped table-bordered datatables" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Nama Pengguna</th>
                                        <th>Email</th>
                                        <th>Banyak Asmen</th>
                                        <th width="20%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @php
                                    $no = 0;
                                    @endphp
                                    @foreach($managers as $manager)
                                    @php
                                        $no++;
                                        $asmenx = DB::table('drivers')
                                        ->select('asmen_id')
                                        ->where([
                                            ['manager_id', '=', $manager->id],
                                            ['asmen_id', '!=', null],
                                        ])
                                        ->distinct()
                                        ->get();
                                    @endphp

                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td>{{ $manager->username }}</td>
                                            <td>{{ $manager->first_name }}</td>
                                            <td>{{ $manager->email }}</td>
                                            <td>{{ $asmenx->count() }} Asmen</td>
                                            <td>
                                                <a href="/manager/edit?id={{ $manager->id }}"><button class="btn btn-sm btn-success" type="button"><i class="la la-edit"></i></button></a> <button class="btn btn-sm btn-danger" onclick="Delete({{ $manager->id }})" type="button"><i class="la la-trash"></i></button> <button class="btn btn-sm btn-info" onclick="Reset({{ $manager->id }})" type="button"><i class="la la-key"></i></button>
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
@include('content.users.manager.modal')
@include('includes.footer')
<script type="text/javascript">

$(function() {

    $('.datatables').DataTable();

});

function Reset(id){

    $('#id').val(id);
    $('#modal_reset').modal('show');

}


function ResetNow(){

    $('#modal_reset').modal('hide');

    $.ajax({
        url: "{{ route('resetpassword') }}",
        type: "POST",
        data: {
            '_token': $('input[name=_token]').val(),
            'id': $('#id').val(),
        },
        success:function(data) {

            swal({
                title: "Berhasil!",
                text: "Password Berhasil di Reset menjadi 123",
                icon: "success",
                buttons: false,
                timer: 2000,
            });

        }

    });


}

function TambahManager(){

    $('#modal_tambah').modal('show');

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

        var asmen = [];

        $('.asmen:checked').each(function(){
            asmen.push($(this).val());
        });

        $.ajax({
            type: 'POST',
            url: "{{ route('simpanmanager') }}",
            data: {
                '_token': $('input[name=_token]').val(),
                'nama': $('#nama').val(),
                'email': $('#email').val(),
                'wilayah': $('#wilayah').val(),
                'username': $('#username').val(),
                'password': $('#pass').val(),
                'asmen': asmen,
               },
            success: function(data) {

                if(data == '0'){

                    swal({
                        title: "Berhasil!!",
                        text: "Data Diri Manager Berhasil Tersimpan!",
                        icon: "success",
                        buttons: false,
                        timer: 2000,
                    });

                    $('#modal_tambah').modal('hide');

                    setTimeout(function(){ window.location.reload() }, 1500);

                } else {

                    swal({
                        title: "Warning!!",
                        text: "Data Sudah ada di Sistem kami!",
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

        $('#id').val(id);
        $('#deleteuser').modal('show');

    }

function YakinHapusAsmen(){

    $.ajax({
       type: 'POST',
       url: "{{ route('deleteusers') }}",
       data: {
            '_token': $('input[name=_token]').val(),
            'id': $('#id').val()
        },
       success: function(data) {

            swal("Data berhasil Terhapus!", {
               icon: "success",
               buttons: false,
               timer: 2000,
            });
            setTimeout(function(){ window.location.reload() }, 1500);
       }
   });
}


</script>
@stop