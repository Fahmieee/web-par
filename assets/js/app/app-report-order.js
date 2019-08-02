
define([
    "jQuery",
    "jQueryUI",
    "sidebar",
	"bootstrap",
    "datatables",  
    "datatablesBootstrap", 
    "treeview",
    "jqvalidate",
    "bootstrapDatepicker"
	], function (
    $,
    jQueryUI,
	bootstrap,  
    datatables,
    datatablesBootstrap,
    sidebar, 
    treeview,
    jqvalidate,
    bootstrapDatepicker
	) {
    return {  
        table:null,
        tableDetailOrder:null,
        init: function () { 
            App.initFunc();
            App.initEvent();  
            App.initConfirm();

            App.searchTable();
            App.resetSearch();

            $(".loadingpage").hide();
        }, 
        initEvent : function(){  
            $("#from").datepicker({
                autoclose:true,
                todayHighlight:true,
                format:'yyyy-mm-dd'
            });

             $("#to").datepicker({
                autoclose:true,
                todayHighlight:true,
                format:'yyyy-mm-dd'
            });
            App.table = $('#table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax":{
                    "url": App.baseUrl+"report/orderList",
                    "dataType": "json",
                    "type": "POST",
                },
                "columns": [
                    { "data": "id" }, 
                    { "data": "no_police" }, 
                    { "data": "unit_name" }, 
                    { "data": "model" }, 
                    { "data": "varian" }, 
                    { "data": "years" },  
                    { "data": "action","orderable": false }
                ]      
            }); 
            var unit_id = $("#unit_id").val();
            App.tableDetailOrder = $('#detailOrder').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax":{
                    "url": App.baseUrl+"report/detailOrderList/"+unit_id,
                    "dataType": "json",
                    "type": "POST",
                },
                "columns": [
                    { "data": "id" }, 
                    { "data": "order_wo_no" },  
                    { "data": "order_date" }, 
                    { "data": "order_time" }, 
                    { "data": "maintenance_type" },    
                    { "data": "maintenance_type" },        
                    { "data": "total_idr" },        
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
            $('#search').on('click', function () {
                console.log("SEARCH"); 
                var wo_no = $("#wo_no").val();
                var driver_name = $("#driver_name").val();
                var maintenance_type = $("#maintenance_type").val();
                var workshop_name = $("#workshop_name").val();  
                var from = $("#from").val(); 
                var to = $("#to").val(); 
                var no_police = $("#no_police").val(); 
                var unit_name = $("#unit_name").val(); 
                console.log(unit_name);
                App.table.column(1).search(wo_no,true,true);
                App.table.column(2).search(driver_name,true,true);
                App.table.column(3).search(maintenance_type,true,true);
                App.table.column(4).search(workshop_name,true,true);  
                App.table.column(5).search(no_police,true,true); 
                App.table.column(6).search(unit_name,true,true); 

                App.table.draw();
                
            }); 
        },
        resetSearch:function(){
            $('#reset').on( 'click', function () {  
                $("#wo_no").val("");
                $("#driver_name").val("");
                $("#workshop_name").val("");
                $("#maintenance_type").val("");  
                $("#from").val(""); 
                $("#to").val(""); 
                $("#no_police").val(""); 
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