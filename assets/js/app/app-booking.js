
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
            $(".loadingpage").hide();
        }, 
        initEvent : function(){  
            App.table = $('#table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax":{
                    "url": App.baseUrl+"booking/dataList",
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
            
        }, 
        initConfirm :function(){
            
        }
	}
});