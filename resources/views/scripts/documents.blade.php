<script type="text/javascript">
var table
$(function() {
    table = $('.datatables').DataTable({
        pageLength: 10,
        processing: true,
        // searching: false,
        serverSide: true,
        ajax: "{{ route('getdocuments') }}",
        createdRow: function( row, data, dataIndex ) {
            $(row).attr("id", "items_"+data.id);
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'doc_name', name: 'doc_name' },
            { data: 'type', name: 'type' },
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