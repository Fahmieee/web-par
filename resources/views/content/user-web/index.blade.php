@extends('layouts.content')
@section('content')
<!-- Zero configuration table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data User Akses Web</h4><br>
                    <button class="btn btn-success" onclick="TambahUser();"><i class="la la-plus"></i> Tambah User</button> 
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
                                        <th>Username</th>
                                        <th>Nama Pengguna</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th width="20%">Actions</th>
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
</section>
<!--/ Zero configuration table -->
@include('content.user-web.modal')
@include('includes.footer')
<script type="text/javascript">

var table
$(function() {
    table = $('.datatables').DataTable({
        pageLength: 10,
        processing: true,
        serverSide: true,
        ajax: "{{ route('getuserweb') }}",
        columns: [
            { data: 'username', name: 'username' },
            { data: 'first_name', name: 'first_name' },
            { data: 'email', name: 'email' },
            { data: 'role_name', name: 'role_name' },
            { 
                render: function ( data, type, row ) {
                    return '<button class="btn btn-sm btn-success" onclick="Edit('+row.id+')" type="button"><i class="la la-edit"></i></button> <button class="btn btn-sm btn-danger" onclick="Delete('+row.id+')" type="button"><i class="la la-trash"></i></button> <button class="btn btn-sm btn-info" onclick="Reset('+row.id+')" type="button"><i class="la la-key"></i></button>';
                }
            }
        ]
    });
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

function TambahUser(){

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

        $.ajax({
            type: 'POST',
            url: "{{ route('simpanuserweb') }}",
            data: {
                '_token': $('input[name=_token]').val(),
                'nama': $('#nama').val(),
                'email': $('#email').val(),
                'role': $('#role').val(),
                'username': $('#username').val(),
                'password': $('#pass').val(),
               },
            success: function(data) {

                if(data == '0'){

                    swal({
                        title: "Berhasil!!",
                        text: "User Web Berhasil Tersimpan!",
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

function Edit(id){

    $.ajax({
       type: 'POST',
       url: "{{ route('edituserweb') }}",
       data: {
            '_token': $('input[name=_token]').val(),
            'id': id
        },
       success: function(data) {

        $('#namaedit').val(data.first_name);
        $('#emailedit').val(data.email);
        $('#usernameedit').val(data.username);
        $('#idedit').val(data.id);
        $('#roleedit').val(data.role_id);

       }

   });

    $('#modal_edit').modal('show');


}

function Update(){

    var empty = false;
    $('input.mandatoryedit').each(function() {
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

        $('#modal_edit').modal('hide');

        $.ajax({
            type: 'POST',
            url: "{{ route('updateuserweb') }}",
            data: {
                '_token': $('input[name=_token]').val(),
                'nama': $('#namaedit').val(),
                'email': $('#emailedit').val(),
                'username': $('#usernameedit').val(),
                'role': $('#roleedit').val(),
                'id': $('#idedit').val(),
               },
            success: function(data) {

                swal({
                    title: "Berhasil!!",
                    text: "User Web Berhasil Diperbaharui!",
                    icon: "success",
                    buttons: false,
                    timer: 2000,
                });


                setTimeout(function(){ window.location.reload() }, 1500);

            }

        });

    }
}

function Delete(id){

        $('#id').val(id);
        $('#deleteuser').modal('show');

    }

function YakinHapusDriver(){

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