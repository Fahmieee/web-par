@extends('layouts.content')
@section('content')
<!-- Zero configuration table -->
<style type="text/css">
    #customers {
      font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    #customers td, #customers th {
      border: 1px solid #ddd;
      padding-bottom: 0px;
      padding-top: 0px;
      padding-left: 10px;
      padding-right: 8px;
    }

    #customers tr:nth-child(even){background-color: #f2f2f2;}

    #customers th {
      padding-top: 9px;
      padding-bottom: 9px;
      text-align: left;
      background-color: #1E9FF2;
      color: white;
    }
</style>
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Korlap</h4><br>
                    <button class="btn btn-success" onclick="TambahKorlap();"><i class="la la-plus"></i> Tambah Korlaps</button> 
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
                                        <th>Nama Korlap</th>
                                        <th>Email</th>
                                        <th>No Telp</th>
                                        <th>PJ Unitkerja</th>
                                        <th width="20%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @php
                                    $no=0;
                                    @endphp
                                    @foreach($korlaps as $korlap)
                                    @php
                                    $no++;

                                    $pj = DB::table('drivers')
                                    ->select('unit_kerja.unitkerja_name')
                                    ->leftJoin('users', 'drivers.driver_id', '=', 'users.id')
                                    ->leftJoin('wilayah', 'users.wilayah_id', '=', 'wilayah.id')
                                    ->leftJoin('unit_kerja', 'wilayah.unitkerja_id', '=', 'unit_kerja.id')
                                    ->where("drivers.korlap_id", $korlap->id)
                                    ->first();

                                    @endphp
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $korlap->username }}</td>
                                        <td>{{ $korlap->first_name }}</td>
                                        <td>{{ $korlap->email }}</td>
                                        <td>{{ $korlap->phone }}</td>
                                        <td>{{ $pj ? $pj->unitkerja_name : '' }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-success" onclick="EditKorlap({{ $korlap->id }})" type="button"><i class="la la-edit"></i></button> <button class="btn btn-sm btn-danger" onclick="Delete()" type="button"><i class="la la-trash"></i></button> <button class="btn btn-sm btn-info" onclick="Reset({{ $korlap->id }})" type="button"><i class="la la-key"></i></button>
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
@include('content.users.korlap.modal')
@include('includes.footer')
<script type="text/javascript">

function Reset(id){

    $('#id').val(id);
    $('#modal_reset').modal('show');

}

// var table = "";
//     $(function() {
//     table = $('.datatables2').DataTable({
//         pageLength: 10,
//         processing: true,
//         serverSide: true,
//         order: [[ 2, 'asc' ]],
//         ajax:{
//              url: "{{ route('korlaps.getdriver') }}",
//              dataType: "json",
//              type: "POST",  
//              headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
//              data: function (d) {
//                 d.unitkerja = $('#unitkerja').val();
                
//             },
//         },
//         columns: [
//             { 
//                 render: function ( data, type, row ) {

//                     return "<input type='checkbox' class='form-control'>";
//                 }
//             },
//             { data: 'username', name: 'username' },
//             { data: 'first_name', name: 'first_name' },
//             { data: 'unitkerja_name', name: 'unitkerja_name' },
//             { data: 'wilayah_name', name: 'wilayah_name' },
//             { 
//                 render: function ( data, type, row ) {

//                     if(row.driver_type == '1'){
//                         var type = 'Dedicated';
//                     } else {
//                         var type = 'Pool';
//                     }

//                     return ""+type+"";
//                 }
//             },
//         ]
//     });

// });

// $('#unitkerja').on('change', function () {

//     table.ajax.reload();

// });


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

function TambahKorlap(){

    $('#modal_tambah').modal('show');

}

$(function() {

    $('.datatables').DataTable();

});


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
            url: "{{ route('simpankorlap') }}",
            data: {
                '_token': $('input[name=_token]').val(),
                'nama': $('#nama').val(),
                'email': $('#email').val(),
                'phone': $('#phone').val(),
                'nik': $('#nik').val(),
                'unitkerja': $('#unitkerja').val(),
                'alamat': $('#alamat').val(),
                'password': $('#pass').val(),
               },
            success: function(data) {

                if(data == '0'){

                    swal({
                        title: "Berhasil!!",
                        text: "Korlap Berhasil Tersimpan!",
                        icon: "success",
                        buttons: false,
                        timer: 2000,
                    });

                    $('#tambahunits').modal('hide');

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

function EditKorlap(id){

    $.ajax({
       type: 'POST',
       url: "{{ route('editkorlap') }}",
       data: {
            '_token': $('input[name=_token]').val(),
            'id': id
        },
       success: function(data) {

        $('#namaedit').val(data.first_name);
        $('#emailedit').val(data.email);
        $('#nikedit').val(data.username);
        $('#phoneedit').val(data.phone);
        $('#alamatedit').val(data.address);
        $('#idedit').val(data.id);
        $('#unitkerjaedit').val(data.unitkerja);

       }

   });

    $('#editkorlap').modal('show');


}

function UpdateKorlap(){

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

        $('#editkorlap').modal('hide');

        $.ajax({
            type: 'POST',
            url: "{{ route('updatekorlap') }}",
            data: {
                '_token': $('input[name=_token]').val(),
                'nama': $('#namaedit').val(),
                'email': $('#emailedit').val(),
                'phone': $('#phoneedit').val(),
                'nik': $('#nikedit').val(),
                'unitkerja': $('#unitkerjaedit').val(),
                'alamat': $('#alamatedit').val(),
                'id': $('#idedit').val(),
               },
            success: function(data) {

                swal({
                    title: "Berhasil!!",
                    text: "Korlap Berhasil Diperbaharui!",
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