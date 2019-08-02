
define([
    "jQuery",
    "jQueryUI",
    "sidebar",
	"bootstrap",
    "datatables",  
    "datatablesBootstrap", 
    "treeview",
    "jqvalidate"
	], function (
    $,
    jQueryUI,
	bootstrap,  
    datatables,
    datatablesBootstrap,
    sidebar, 
    treeview,
    jqvalidate
	) {
    return {  
        table:null,
        init: function () { 
            App.initFunc();
            App.initEvent();  
            App.initConfirm();

             App.searchTable();
            App.resetSearch();

            $(".loadingpage").hide();
        }, 
        initEvent : function(){  
            App.table = $('#table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax":{
                    "url": App.baseUrl+"maintenance_request/dataList",
                    "dataType": "json",
                    "type": "POST",
                },
                "columns": [
                    { "data": "id" }, 
                    { "data": "order_no" }, 
                    { "data": "order_date" }, 
                    { "data": "order_type" }, 
                    { "data": "workshop_name" }, 
                    { "data": "driver_name" }, 
                    { "data": "unit_name" }, 
                    { "data": "status" }, 
                    { "data": "action","orderable": false }
                ]      
            }); 

            if($("#form").length > 0){
                $("#save-btn").removeAttr("disabled");
                $("#form").validate({ 
                    rules: {
                        distance: {
                            required: true
                        } 
                    },
                    messages: { 
                        distance: {
                            required: "KM Harus Diisi"
                        } 
                    }, 
                    debug:true,
                    
                    errorPlacement: function(error, element) {
                        var name = element.attr('name');
                        var errorSelector = '.form-control-feedback[for="' + name + '"]';
                        var $element = $(errorSelector);
                        if ($element.length) { 
                            $(errorSelector).html(error.html());
                        } else {
                            error.insertAfter(element);
                        }
                    },
                    submitHandler : function(form) { 
                        form.submit();
                    }
                }); 
            }
            
        }, 
        searchTable:function(){ 
             $(".dataTables_filter").hide();
            $('#search').on('click', function () { 
                var order_no = $("#order_no").val();  
                var maintenance = $("#maintenance").val(); 
                var unit_name = $("#unit_name").val();  

                App.table.column(1).search(order_no,true,true); 
                App.table.column(2).search(maintenance,true,true); 
                App.table.column(3).search(unit_name,true,true);  

                App.table.draw();
                
            }); 
        },
        resetSearch:function(){
            $('#reset').on( 'click', function () { 
                $("#order_no").val(""); 
                $("#maintenance").val(""); 
                $("#unit_name").val("");  

                App.table.search( '' ).columns().search( '' ).draw();
            });
        },
        initConfirm :function(){
            $('#table tbody').on( 'click', '.delete', function () {
                var url = $(this).attr("url");
                App.confirm("Apakah Anda Yakin Untuk Mengubah Ini?",function(){
                   $.ajax({
                      method: "GET",
                      url: url
                    }).done(function( msg ) {
                        App.table.ajax.reload(null,true);
                    });        
                })
            });
        }
	}
});