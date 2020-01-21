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
                 type: "GET",  
            },
            columns: [
                { data: 'id', name: 'id' },
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

</script>