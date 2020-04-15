<script type="text/javascript">
var table
$(function() {
    table = $('.datatables').DataTable({
        pageLength: 10,
        processing: true,
        // searching: false,
        order: [[ 0, 'desc' ]],
        serverSide: true,
        ajax: "{{ route('getjabatan') }}",
        createdRow: function( row, data, dataIndex ) {
            $(row).attr("id", "items_"+data.id);
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'jabatan_name', name: 'jabatan_name' },
            { data: 'created_at', name: 'created_at' },
            { 
                render: function ( data, type, row ) {
                    return '<button onclick="Edit('+row.id+')" class="btn btn-xs btn-social-icon btn-info" data-id="'+row.id+'" data-name="'+row.name+'"> <i class="la la-edit"></i></button> <button onclick="Delete('+row.id+')" class="btn btn-xs btn-social-icon btn-danger" data-id="'+row.id+'" > <i class="la la-trash"></i></button>';
                }
            }
        ]
    });
});

function TambahJabatan(){

    $('#tambahjabatan').modal('show');

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
            url: "{{ route('simpanjabatan') }}",
            data: {
                '_token': $('input[name=_token]').val(),
                'nama': $('#nama').val(),
               },
            success: function(data) {

                if(data == 0){

                    $('#tambahjabatan').modal('hide');

                    swal({
                        title: "Berhasil!!",
                        text: "Jabatan Berhasil Tersimpan!",
                        icon: "success",
                        buttons: false,
                        timer: 2000,
                    });

                    setTimeout(function(){ window.location.reload() }, 1500);

                } else {

                    swal({
                        title: "Warning!!",
                        text: "Jabatan Tersebut Sudah Ada!",
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
       url: "{{ route('editjabatan') }}",
       data: {
            '_token': $('input[name=_token]').val(),
            'id': id
        },
       success: function(data) {

        $('#namaedit').val(data.jabatan_name);
        $('#id').val(id);

       }
    });

    $('#editjabatan').modal('show');

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

        $('#editjabatan').modal('hide');

        $.ajax({
            type: 'POST',
            url: "{{ route('updatejabatan') }}",
            data: {
                '_token': $('input[name=_token]').val(),
                'nama': $('#namaedit').val(),
                'id': $('#id').val(),
                
            },
            success: function(data) {

                swal({
                    title: "Berhasil!",
                    text: "Jabatan Berhasil Diupdate",
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

    $('#jabatanid').val(id);
    $('#deletejabatan').modal('show');

}

function Yakin(){

    $.ajax({
       type: 'POST',
       url: "{{ route('deletejabatan') }}",
       data: {
            '_token': $('input[name=_token]').val(),
            'id': $('#jabatanid').val()
        },
       success: function(data) {

            swal("Jabatan berhasil Terhapus!", {
               icon: "success",
               buttons: false,
               timer: 2000,
            });
            
            setTimeout(function(){ window.location.reload() }, 1500);
       }
   });
}
</script>