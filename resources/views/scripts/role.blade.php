<script type="text/javascript">
var table
$(function() {
    table = $('.datatables').DataTable({
        pageLength: 10,
        processing: true,
        serverSide: true,
        ajax: "{{ route('getroles') }}",
        columns: [
            { data: 'name', name: 'name' },
            { data: 'created_at', name: 'created_at' },
            { 
                render: function ( data, type, row ) {
                    return '<button class="btn btn-sm btn-info" onclick="Edit('+row.id+')"> <i class="la la-edit"></i> Edit</button> <button class="btn btn-sm btn-danger" onclick="Delete('+row.id+')" data-id="'+row.id+'" > <i class="la la-trash"></i> Delete</button>';
                }
            }
        ]
    });
});

function TambahRole(){

    $('#tambahrole').modal('show');

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
            url: "{{ route('simpanrole') }}",
            data: {
                '_token': $('input[name=_token]').val(),
                'nama': $('#nama').val(),
               },
            success: function(data) {

                if(data == 0){

                    $('#tambahrole').modal('hide');

                    swal({
                        title: "Berhasil!!",
                        text: "Role Berhasil Tersimpan!",
                        icon: "success",
                        buttons: false,
                        timer: 2000,
                    });

                    setTimeout(function(){ window.location.reload() }, 1500);

                } else {

                    swal({
                        title: "Warning!!",
                        text: "Role Tersebut Sudah Ada!",
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

    $('#roleid').val(id);
    $('#deleterole').modal('show');

}

function Yakin(){

    $.ajax({
       type: 'POST',
       url: "{{ route('deleterole') }}",
       data: {
            '_token': $('input[name=_token]').val(),
            'id': $('#roleid').val()
        },
       success: function(data) {

            swal("Role berhasil Terhapus!", {
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
       url: "{{ route('editrole') }}",
       data: {
            '_token': $('input[name=_token]').val(),
            'id': id
        },
       success: function(data) {

        $('#namaedit').val(data.name);
        $('#id').val(id);

       }
    });

    $('#editrole').modal('show');

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

        $('#editrole').modal('hide');

        $.ajax({
            type: 'POST',
            url: "{{ route('updaterole') }}",
            data: {
                '_token': $('input[name=_token]').val(),
                'nama': $('#namaedit').val(),
                'id': $('#id').val(),
                
            },
            success: function(data) {

                swal({
                    title: "Berhasil!",
                    text: "Role Berhasil Diupdate",
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