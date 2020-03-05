<script type="text/javascript">
	function DetailLogin(id){

		$.ajax({
            type: 'POST',
            url: "{{ route('DetailLogins') }}",
            data: {
                '_token': $('input[name=_token]').val(),
                'user_id': id
            },

            success: function (data) {

            	var no = -1;
            	var nos = 0;
            	var content_data="";

                $.each(data, function() {

                    no++;
                    nos++;
                    var name = data[no]['first_name'];
                    var first_name = data[no]['first_name'];
                    var created = data[no]['created_at'];

                    content_data += "<tr>";
                    content_data += "<td>"+nos+"</td>";
                    content_data += "<td>"+first_name+"</td>";
                    content_data += "<td>"+created+"</td>";
                    content_data += "</tr>";

                });

                $('#detailslogin').html(content_data);

            }

        });
	}

    var table = "";
    $(function() {
        table = $('.datatables').DataTable({
            pageLength: 20,
            processing: true,
            serverSide: true,
            order: [[ 2, 'asc' ]],
            ajax:{
                 url: "{{ route('getclockin') }}",
                 dataType: "json",
                 type: "POST", 
                 headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                 data: function (d) {
                    d.unitkerja = $('#unitkerja').val();
                    
                },  
                 
            },
            columns: [
                { data: 'username', name: 'username' },
                { data: 'first_name', name: 'first_name' },
                { data: 'unitkerja_name', name: 'unitkerja_name' },
                { data: 'clockin_time', name: 'clockin_time' },
                { data: 'clockin_km', name: 'clockin_km' },
                { data: 'clockout_time', name: 'clockout_time' },
                { data: 'clockout_km', name: 'clockout_km' },
                
            ]
        });

    });

    $('#unitkerja').on('change', function () {

        table.ajax.reload();

    });

</script>