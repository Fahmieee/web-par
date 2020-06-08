<script type="text/javascript">

   var table = "";
    $(function() {
        table = $('.datatables').DataTable({
            pageLength: 20,
            processing: true,
            serverSide: true,
            order: [[ 2, 'desc' ]],
            ajax:{
                 url: "{{ route('getdcu') }}",
                 dataType: "json",
                 type: "POST",  
                 headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                 data: function (d) {
                    d.awal = $('#dari').val(),
                    d.akhir = $('#sampai').val(),
                    d.unitkerja = $('#unitkerja').val();
                    
                },
            },
            columns: [
                { data: 'username', name: 'username' },
                { data: 'first_name', name: 'first_name' },
                { data: 'dates', name: 'dates' },
                { data: 'time', name: 'time' },
                { data: 'suhu', name: 'suhu' },
                { data: 'darah', name: 'darah' },
                { data: 'unitkerja_name', name: 'unitkerja_name' },
                { 
                    render: function ( data, type, row ) {

                        if(row.hasil == 3){

                            var status = "Unfit";
                            var btn = "btn-danger";

                        } else {

                            var status = "Fit";
                            var btn = "btn-success";

                        }

                        return "<button type='button' class='btn btn-sm "+btn+"'>"+status+"</button";
                    }
                },
                { 
                    render: function ( data, type, row ) {

                        return "<button type='button' class='btn btn-sm btn-info' onclick='LihatDCU("+row.id+")'><i class='la la-eye'></i></button>";
                    }
                },
            ]
        });

    });

    function convertDateDBtoIndo(string,string2){

        bulanIndo = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September' , 'Oktober', 'November', 'Desember'];

        tanggaldari = string.split("-")[2];
        bulandari = string.split("-")[1];
        tahundari = string.split("-")[0];

        tanggalsampai= string2.split("-")[2];
        bulansampai = string2.split("-")[1];
        tahunsampai = string2.split("-")[0];

        $('#showdate').html('Tanggal : '+tanggaldari+ ' '+bulanIndo[Math.abs(bulandari)]+' '+tahundari+' - '+tanggalsampai+ ' '+bulanIndo[Math.abs(bulansampai)]+' '+tahunsampai);

    }

    $('#dari').on('change', function () {

        table.ajax.reload();

        var dari = $('#dari').val();
        var sampai = $('#sampai').val();

        convertDateDBtoIndo(dari,sampai);

    });

    $('#sampai').on('change', function () {

        table.ajax.reload();

        var dari = $('#dari').val();
        var sampai = $('#sampai').val();

        convertDateDBtoIndo(dari,sampai);

    });

    $('#unitkerja').on('change', function () {

        table.ajax.reload();

    });

    function LihatDCU(id){

        $.ajax({
            type: 'POST',
            url: "{{ route('lihatdcu') }}",
            data: {
                '_token': $('input[name=_token]').val(),
                'id': id,
                },
            success: function(data) {

                var content_data = '<img width="60%" src="https://mobile-par.ndt-dev.com/assets/img_dcu/'+data.img+'">';

                $('#photodcu').html(content_data);

            }

        });

        $('#lihat').modal('show');

    }

</script>