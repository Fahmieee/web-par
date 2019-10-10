<script type="text/javascript">
var table
$(function() {
    table = $('.datatables').DataTable({
        pageLength: 10,
        processing: true,
        // searching: false,
        serverSide: true,
        ajax: "{{ route('gettrainings') }}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'training_name', name: 'training_name' },
            { data: 'nick_name', name: 'nick_name' },
            { data: 'created_at', name: 'created_at' },
            // { 
            //     render: function ( data, type, row ) {
            //         return '<button class="btn btn-xs btn-social-icon btn-info" data-id="'+row.id+'" data-name="'+row.name+'"> <i class="la la-edit"></i></button> <button class="btn btn-xs btn-social-icon btn-danger mr-1 mb-1" data-id="'+row.id+'" > <i class="la la-trash"></i></button>';
            //     }
            // }
        ]
    });
});
</script>