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
                                        <th style="display: none;">ID</th>
                                        <th>Username</th>
                                        <th>Nama Driver</th>
                                        <th>Type Driver</th>
                                        <th>Unit</th>
                                        <th>Wilayah kerja</th>
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

    $('#modal_tambah').modal('show');

}

var table
$(function() {
    table = $('.datatables').DataTable({
        pageLength: 10,
        processing: true,
        serverSide: true,
        order: [[ 0, 'desc' ]],
        columnDefs: [
            {
                "targets": [ 0 ],
                "visible": false
            }
        ],
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
            { 
                render: function ( data, type, row ) {

                    if(row.no_police == null){

                        return '-';

                    } else {

                        return row.no_police;

                    }
                }
            },
            { data: 'unitkerja_name', name: 'unitkerja_name' },
            { 
                render: function ( data, type, row ) {

                   return '<button class="btn btn-sm btn-success" onclick="EditDriver('+row.id+')" type="button"><i class="la la-edit"></i></button> <button class="btn btn-sm btn-danger" onclick="Delete('+row.id+')" type="button"><i class="la la-trash"></i></button> <button class="btn btn-sm btn-info" onclick="Reset('+row.id+')" type="button"><i class="la la-key"></i></button>';
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

        content_data += "<option value=''>Pilih Unit Kendaraan</option>";

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

$('#unit').on('change', function () {

    $.ajax({
        url: "{{ route('docunit') }}",
        type: "POST",
        data: {
            '_token': $('input[name=_token]').val(),
            'id': $(this).val(),
        },
        success:function(data) {

            $('.datedocunit').val('');

            var no = -1;
            var content_data ="";

            $.each(data, function() {

                no++;
                var doc_id = data[no]['document_id'];
                var dates = data[no]['exp_date'];

                $('#docunit_'+doc_id).val(dates);

            });

        }

    });

});

$('#type').on('change', function () {

    if($(this).val() == '1'){

        $('#tab-user').attr("style", "display:block;");
        $('#tab-unit').attr("style", "display:block;");

    } else {

        $('#tab-user').attr("style", "display:none;");
        $('#tab-unit').attr("style", "display:none;");

    }

});

$('#typeedit').on('change', function () {

    if($(this).val() == '1'){

        $('#tab-useredit').attr("style", "display:block;");
        $('#tab-unitedit').attr("style", "display:block;");

    } else {

        $('#tab-useredit').attr("style", "display:none;");
        $('#tab-unitedit').attr("style", "display:none;");

    }

});

function BuatUnitBaru(){

    $('#modal_unit_baru').modal({backdrop: 'static', keyboard: false})
    $('#modal_unit_baru').modal('show');


    $('#modal_tambah').modal('hide');

}

function SimpanDriver(){

    var empty = false;
    $('input.mandatory,select.mandatory').each(function() {
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

        var typedocdriver = [];
        var datedocdriver = [];
        var typedocunit = [];
        var datedocunit = [];
        var typetraining = [];
        var datetraining = [];

        $('.typedocdriver').each(function(){
            typedocdriver.push($(this).val());
        });

        $('.datedocdriver').each(function(){
            datedocdriver.push($(this).val());
        });

        $('.typedocunit').each(function(){
            typedocunit.push($(this).val());
        });

        $('.datedocunit').each(function(){
            datedocunit.push($(this).val());
        });

        $('.typetraining').each(function(){
            typetraining.push($(this).val());
        });

        $('.datetraining').each(function(){
            datetraining.push($(this).val());
        });

        $.ajax({
            type: 'POST',
            url: "{{ route('simpandriver') }}",
            data: {
                '_token': $('input[name=_token]').val(),
                'nama': $('#nama').val(),
                'email': $('#email').val(),
                'phone': $('#phone').val(),
                'nik': $('#nik').val(),
                'unitkerja': $('#unitkerja').val(),
                'wilayah': $('#wilayah').val(),
                'type': $('#type').val(),
                'korlap': $('#korlap').val(),
                'alamat': $('#alamat').val(),
                'namaclient': $('#namaclient').val(),
                'emailclient': $('#emailclient').val(),
                'jabatan': $('#jabatan').val(),
                'phoneclient': $('#phoneclient').val(),
                'typedocdriver': typedocdriver,
                'datedocdriver': datedocdriver,
                'unit': $('#unit').val(),
                'typedocunit': typedocunit,
                'datedocunit': datedocunit,
                'typetraining': typetraining,
                'datetraining': datetraining,
               },
            success: function(data) {

                if(data == '0'){

                    swal({
                        title: "Berhasil!!",
                        text: "Driver Berhasil Tersimpan!",
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

function EditDriver(id){

    $.ajax({
       type: 'POST',
       url: "{{ route('editdriver') }}",
       data: {
            '_token': $('input[name=_token]').val(),
            'id': id
        },
       success: function(data) {

            if(data.driver_type == '1'){
                $('#tab-useredit').attr("style","display:block;");
                $('#tab-unitedit').attr("style","display:block;");

                $.ajax({
                   type: 'POST',
                   url: "{{ route('editclient') }}",
                   data: {
                        '_token': $('input[name=_token]').val(),
                        'id': id
                    },
                   success: function(datas) {

                        $('#namaclientedit').val(datas.first_name);
                        $('#emailclientedit').val(datas.email);
                        $('#jabatanedit').val(datas.jabatan_id);
                        $('#phoneclientedit').val(datas.phone);

                   }
               });

                $.ajax({
                    url: "{{ route('docunit') }}",
                    type: "POST",
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'id': data.unit_id,
                    },
                    success:function(data) {

                        $('.datedocunit').val('');

                        var no = -1;
                        var content_data ="";

                        $.each(data, function() {

                            no++;
                            var doc_id = data[no]['document_id'];
                            var dates = data[no]['exp_date'];

                            $('#iddocunitedit_'+doc_id).val(dates);

                        });

                    }

                });

            } else {
                $('#tab-useredit').attr("style","display:none;");
                $('#tab-unitedit').attr("style","display:none;");
            }

            $('#namaedit').val(data.first_name);
            $('#emailedit').val(data.email);
            $('#phoneedit').val(data.phone);
            $('#nikedit').val(data.username);
            $('#unitkerjaedit').val(data.unitkerja_id);
            $('#wilayahedit').val(data.wilayah_id);
            $('#typeedit').val(data.driver_type);
            $('#alamatedit').val(data.address);
            $('#korlapedit').val(data.korlap_id);
            $('#unitedit').val(data.unit_id);
            $('#ids').val(id);


       }
   });

    $.ajax({
        url: "{{ route('docdriver') }}",
        type: "POST",
        data: {
            '_token': $('input[name=_token]').val(),
            'id': id,
        },
        success:function(data) {

            $('.datedocdriveredit').val('');

            var no = -1;
            var content_data ="";

            $.each(data, function() {

                no++;
                var doc_id = data[no]['document_id'];
                var dates = data[no]['exp_date'];

                $('#iddocdriveredit_'+doc_id).val(dates);

            });

        }

    });

    $.ajax({
        url: "{{ route('trainingdriver') }}",
        type: "POST",
        data: {
            '_token': $('input[name=_token]').val(),
            'id': id,
        },
        success:function(data) {

            $('.datetrainingedit').val('');

            var no = -1;
            var content_data ="";

            $.each(data, function() {

                no++;
                var training_id = data[no]['training_id'];
                var dates = data[no]['date'];

                $('#idtrainingedit_'+training_id).val(dates);

            });

        }

    });


    $('#editdriver').modal('show');

}

function UpdateDrivers(){

    var typedocdriveredit = [];
    var datedocdriveredit = [];
    var typedocunitedit = [];
    var datedocunitedit = [];
    var typetrainingedit = [];
    var datetrainingedit = [];

    $('.typedocdriveredit').each(function(){
        typedocdriveredit.push($(this).val());
    });

    $('.datedocdriveredit').each(function(){
        datedocdriveredit.push($(this).val());
    });

    $('.typedocunitedit').each(function(){
        typedocunitedit.push($(this).val());
    });

    $('.datedocunitedit').each(function(){
        datedocunitedit.push($(this).val());
    });

    $('.typetrainingedit').each(function(){
        typetrainingedit.push($(this).val());
    });

    $('.datetrainingedit').each(function(){
        datetrainingedit.push($(this).val());
    });

    $.ajax({
        type: 'POST',
        url: "{{ route('updatedriver') }}",
        data: {
            '_token': $('input[name=_token]').val(),
            'id': $('#ids').val(),
            'nama': $('#namaedit').val(),
            'email': $('#emailedit').val(),
            'phone': $('#phoneedit').val(),
            'nik': $('#nikedit').val(),
            'unitkerja': $('#unitkerjaedit').val(),
            'wilayah': $('#wilayahedit').val(),
            'type': $('#typeedit').val(),
            'korlap': $('#korlapedit').val(),
            'alamat': $('#alamatedit').val(),
            'namaclient': $('#namaclientedit').val(),
            'emailclient': $('#emailclientedit').val(),
            'jabatan': $('#jabatanedit').val(),
            'phoneclient': $('#phoneclientedit').val(),
            'typedocdriver': typedocdriveredit,
            'datedocdriver': datedocdriveredit,
            'unit': $('#unitedit').val(),
            'typedocunit': typedocunitedit,
            'datedocunit': datedocunitedit,
            'typetraining': typetrainingedit,
            'datetraining': datetrainingedit,
           },
        success: function(data) {

            swal({
                title: "Berhasil!!",
                text: "Driver Berhasil Diperbaharui!",
                icon: "success",
                buttons: false,
                timer: 2000,
            });

            $('#tambahunits').modal('hide');

            setTimeout(function(){ window.location.reload() }, 1500);

        }

    });

}

$('#unitedit').on('change', function () {

    $.ajax({
        url: "{{ route('docunit') }}",
        type: "POST",
        data: {
            '_token': $('input[name=_token]').val(),
            'id': $(this).val(),
        },
        success:function(data) {

            $('.datedocunitedit').val('');

            var no = -1;
            var content_data ="";

            $.each(data, function() {

                no++;
                var doc_id = data[no]['document_id'];
                var dates = data[no]['exp_date'];

                $('#iddocunitedit_'+doc_id).val(dates);

            });

        }

    });

});

</script>
@stop