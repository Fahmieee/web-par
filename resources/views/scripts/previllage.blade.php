<script type="text/javascript">

	function TambahPrevillage(){

		$('#tambahprevillage').modal('show');

	}

	function SimpanPrevillageBaru(){

        var empty = false;
        $('select.harus').each(function() {
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

            $('#tambahprevillage').modal('hide');

            var menu = [];

            $('.menu:checked').each(function(){
                menu.push($(this).val());
            });

            $.ajax({
                type: 'POST',
                url: "{{ route('simpanprevillage') }}",
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': $('#roleid').val(),
                    'menu': menu,
                },
                success: function(data) {

                	if(data == 1){

                		swal({
	                        title: "Perhatian!",
	                        text: "Role Tersebut Sudah Memiliki Previllage",
	                        icon: "error",
	                        buttons: false,
	                        timer: 2000,
	                    });

                	} else {

                		swal({
	                        title: "Berhasil!",
	                        text: "Previllage Berhasil Disimpan",
	                        icon: "success",
	                        buttons: false,
	                        timer: 2000,
	                    });

	                    setTimeout(function(){ window.location.reload() }, 1500);

                	}

                    
                }

            });

        }

    }

    function Delete(id){

        $('#id').val(id);
        $('#hapusprevillage').modal('show');

    }

    function YakinHapusPrevillages(){

        $.ajax({
           type: 'POST',
           url: "{{ route('deleteprevillage') }}",
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