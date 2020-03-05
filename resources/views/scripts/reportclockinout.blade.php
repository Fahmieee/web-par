<script type="text/javascript">

    var table = "";
    $(function() {
        table = $('.datatables').DataTable({
            pageLength: 20,
            processing: true,
            serverSide: true,
            order: [[ 2, 'asc' ]],
            ajax:{
                 url: "{{ route('getclockinout') }}",
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
                { data: 'clockin_time', name: 'clockin_time' },
                { data: 'clockout_time', name: 'clockout_time' },
                { data: 'clockin_km', name: 'clockin_km' },
                { data: 'clockout_km', name: 'clockout_km' },
                { data: 'unitkerja_name', name: 'unitkerja_name' },
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

</script>