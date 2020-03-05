@extends('layouts.content')
@section('content')
<!-- Zero configuration table -->
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data DRIVER</h4><br>
                    <button class="btn btn-success" onclick="TambahDriver();"><i class="la la-plus"></i> Tambah Driver</button> 
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
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Nama Driver</th>
                                        <th>Type Driver</th>
                                        <th>Wilayah</th>
                                        <th>Unit kerja</th>
                                        <th>Actions</th>
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
@include('content.users.drivers.modal')
@include('includes.footer')
<script type="text/javascript">

function Reset(id){

    $('#id').val(id);
    $('#modal_reset').modal('show');

}

function Simpan(){

    var empty = false;
    $('input.unitz').each(function() {
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
            url: "{{ route('simpanunit') }}",
            data: {
                '_token': $('input[name=_token]').val(),
                'merk': $('#merk').val(),
                'varian': $('#varian').val(),
                'mes': $('#mes').val(),
                'nopol': $('#nopol').val(),
                'model': $('#model').val(),
                'tahun': $('#tahun').val(),
                'transmisi': $('#transmisi').val(),
                'color': $('#color').val(),
               },
            success: function(data) {

                if(data == '0'){

                    swal({
                        title: "Berhasil!!",
                        text: "Unit Berhasil Tersimpan!",
                        icon: "success",
                        buttons: false,
                        timer: 2000,
                    });

                    $('#modal_tambah').modal('show');

                    $('#modal_unit_baru').modal('hide');

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

function Batal(){

    $('#modal_unit_baru').modal('hide');

    $('#modal_tambah').modal('show');



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
                text: "Password Berhasil di Reset",
                icon: "success",
                buttons: false,
                timer: 2000,
            });

        }

    });


}

function TambahDriver(){

    $('#modal_tambah').modal({backdrop: 'static', keyboard: false})
    $('#modal_tambah').modal('show');

}

var table
$(function() {
    table = $('.datatables').DataTable({
        pageLength: 10,
        processing: true,
        serverSide: true,
        order: [[ 0, 'desc' ]],
        ajax: "{{ route('getdrivers') }}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'username', name: 'username' },
            { data: 'first_name', name: 'first_name' },
            { 
                render: function ( data, type, row ) {

                    if(row.driver_type == 2){

                        return '<span class="badge badge badge-pill badge-primary float-left">POOL</span>';

                    } else {

                        return '<span class="badge badge badge-pill badge-success float-left">DEDICATED</span>';

                    }
                }
            },
            { data: 'wilayah_name', name: 'wilayah_name' },
            { data: 'unitkerja_name', name: 'unitkerja_name' },
            { 
                render: function ( data, type, row ) {

                   return '<button class="btn btn-sm btn-success" type="button"><i class="la la-edit"></i></button> <button class="btn btn-sm btn-primary" type="button"><i class="la la-eye"></i></button> <button class="btn btn-sm btn-info" onclick="Reset('+row.id+')" type="button"><i class="la la-key"></i></button>';
                }
            },
        ]
    });
});

$('#unitkerja').on('change', function () {

    $.ajax({
        url: "{{ route('ambilwilayah') }}",
        type: "POST",
        data: {
            '_token': $('input[name=_token]').val(),
            'id': $(this).val(),
        },
        success:function(data) {

            var no = -1;
            var content_data ="";

            $.each(data, function() {

                no++;
                var wilayah_name = data[no]['wilayah_name'];
                var id = data[no]['id'];

                content_data += "<option value="+id+">"+wilayah_name+"</option>";

            });

            $('#wilayah').html(content_data);

        }

    });

});

$.ajax({
    url: "{{ route('ambilunit') }}",
    type: "GET",
    success:function(data) {

        var no = -1;
        var content_data ="";

        $.each(data, function() {

            no++;
            var merk = data[no]['merk'];
            var model = data[no]['model'];
            var no_police = data[no]['no_police'];
            var id = data[no]['id'];

            content_data += "<option value="+id+">"+no_police+" | "+merk+" "+model+"</option>";

        });

        $('#unit').html(content_data);

    }

});

function BuatUnitBaru(){

    $('#modal_unit_baru').modal({backdrop: 'static', keyboard: false})
    $('#modal_unit_baru').modal('show');


    $('#modal_tambah').modal('hide');

}

</script>
@stop