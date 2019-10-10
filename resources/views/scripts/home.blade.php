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

</script>