<script type="text/javascript">
var table
var no = 0;
$(function() {
    table = $('.datatables').DataTable({
        pageLength: 10,
        processing: true,
        columnDefs: [
                {
                    "targets": [ 0 ],
                    "visible": false
                }
            ],
        order: [[ 0, 'desc' ]],
        serverSide: true,
        ajax: "{{ route('getunits') }}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'merk', name: 'merk' },
            { data: 'model', name: 'model' },
            { data: 'varian', name: 'varian' },
            { data: 'years', name: 'years' },
            { data: 'transmition', name: 'transmition' },
            { data: 'mes', name: 'mes' },
            { data: 'no_police', name: 'no_police' },
            { data: 'mileage', name: 'mileage' },
            { 
                    render: function ( data, type, row ) {
                        return '<button class="btn btn-sm btn-danger" onclick="HapusUnits('+row.id+')" type="button"><i class="la la-trash"></i></button> <button class="btn btn-sm btn-primary" onclick="EditUnits('+row.id+')" type="button"><i class="la la-pencil"></i></button> <button class="btn btn-sm btn-success" onclick="ResetUnits('+row.id+')" type="button"><i class="la la-car"></i></button>';
                    }
                },
        ]
    });
});

function ResetUnits(id){



}

function Tambah(){

    $('#tambahunits').modal('show');
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

function EditUnits(id){

    $.ajax({
       type: 'POST',
       url: "{{ route('editunits') }}",
       data: {
            '_token': $('input[name=_token]').val(),
            'id': id
        },
       success: function(data) {

        $('#merkedit').val(data.merk);
        $('#varianedit').val(data.varian);
        $('#mesedit').val(data.mes);
        $('#nopoledit').val(data.no_police);
        $('#modeledit').val(data.model);
        $('#tahunedit').val(data.years);
        $('#transmisiedit').val(data.transmition);
        $('#coloredit').val(data.color);
        $('#ids').val(id);
       }
   });

    $('#editunits').modal('show');

}

function Update(){

    var empty = false;
    $('input.unitzedit').each(function() {
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
            url: "{{ route('updateunits') }}",
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('#ids').val(),
                'merk': $('#merkedit').val(),
                'varian': $('#varianedit').val(),
                'mes': $('#mesedit').val(),
                'nopol': $('#nopoledit').val(),
                'model': $('#modeledit').val(),
                'tahun': $('#tahunedit').val(),
                'transmisi': $('#transmisiedit').val(),
                'color': $('#coloredit').val(),
               },
            success: function(data) {


                swal({
                    title: "Berhasil!!",
                    text: "Unit Berhasil Diperbaharui!",
                    icon: "success",
                    buttons: false,
                    timer: 2000,
                });

                $('#editunits').modal('hide');

                setTimeout(function(){ window.location.href = '/home'; }, 1500);

               
            }

        });

    }

}

function HapusUnits(id){

        $('#id').val(id);
        $('#deleteunit').modal('show');

    }

    function YakinHapusUnit(){

        $.ajax({
           type: 'POST',
           url: "{{ route('deleteunits') }}",
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