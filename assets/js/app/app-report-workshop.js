
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
        tableRekanan:null,
        tableNonRekanan:null,
        topWorkshop:null,
        detailWorkshop:null,
        workshop_id:null,
        targetActive:null,
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
            App.tableRekanan = $('#tableRekanan').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax":{
                    "url": App.baseUrl+"report/workshopList/1",
                    "dataType": "json",
                    "type": "POST",
                },
                "columns": [
                    { "data": "id" }, 
                    { "data": "workshop_name" }, 
                    { "data": "workshop_address" },  
                    { "data": "rating" ,"orderable": false},  
                    { "data": "action","orderable": false }
                ]      
            });  
            App.workshop_id = $("#workshop_id").val();
            App.detailWorkshop = $('#detailWorkshop').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax":{
                    "url": App.baseUrl+"report/detailWorkshopList/"+App.workshop_id,
                    "dataType": "json",
                    "type": "POST",
                },
                "columns": [
                    { "data": "id" }, 
                    { "data": "order_no" }, 
                    { "data": "order_wo_no" }, 
                    { "data": "order_date" },  
                    { "data": "maintenance_type" },  
                    { "data": "rating","orderable": false  },  
                    { "data": "note" },
                     { "data": "action","orderable": false  },  
                ]      
            });  
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
              var target = $(e.target).attr("href") // activated tab
                
                App.targetActive = target;
                if(target == "#nonpartner"){
                    if(App.tableNonRekanan == null){
                        App.tableNonRekanan = $('#tableNonRekanan').DataTable({
                            "processing": true,
                            "serverSide": true,
                            "ajax":{
                                "url": App.baseUrl+"report/workshopList/2",
                                "dataType": "json",
                                "type": "POST",
                            },
                            "columns": [
                                { "data": "id" }, 
                                { "data": "workshop_name" }, 
                                { "data": "workshop_address" },  
                                { "data": "rating" ,"orderable": false},  
                                { "data": "action","orderable": false }
                            ]      
                        }); 
                    }else{
                        App.tableNonRekanan.ajax.reload();
                    }
                   
                }else if(target == "#workshoptop"){
                    if(App.topWorkshop == null){
                        App.topWorkshop = $('#topWorkshop').DataTable({
                            "processing": true,
                            "serverSide": true,
                            "ajax":{
                                "url": App.baseUrl+"report/topWorkshopList",
                                "dataType": "json",
                                "type": "POST",
                            },
                            "columns": [
                                { "data": "id" }, 
                                { "data": "workshop_name" }, 
                                { "data": "workshop_address" }, 
                                { "data": "rating","orderable": false },  
                                { "data": "action","orderable": false }
                            ]      
                        });  
                    } else{
                        App.topWorkshop.ajax.reload();
                    }
                }
            });  
            
        }, 

        searchTable:function(){ 
            $('#search').on('click', function () {
                console.log("SEARCH"); 
                var workshop_name = $("#workshop_name").val();
                var area_name = $("#area_name").val(); 
                if(App.targetActive == "#nonpartner"){
                    App.tableNonRekanan.column(1).search(workshop_name,true,true);
                    App.tableNonRekanan.column(2).search(area_name,true,true);   
                    App.tableNonRekanan.draw();
                }else if(App.targetActive == "#workshoptop"){
                    App.topWorkshop.column(1).search(workshop_name,true,true);
                    App.topWorkshop.column(2).search(area_name,true,true);   
                    App.topWorkshop.draw();
                }else{
                    App.tableRekanan.column(1).search(workshop_name,true,true);
                    App.tableRekanan.column(2).search(area_name,true,true);   
                    App.tableRekanan.draw();
                }
               
                
            }); 
        },
        resetSearch:function(){
            $('#reset').on( 'click', function () { 
                console.log("asd");
                $("#workshop_name").val("");
                $("#area_name").val(""); 
                if(App.targetActive == "#nonpartner"){
                    App.tableNonRekanan.search( '' ).columns().search( '' ).draw();
                }else if(App.targetActive == "#workshoptop"){
                    App.topWorkshop.search( '' ).columns().search( '' ).draw();
                }else{
                    App.tableRekanan.search( '' ).columns().search( '' ).draw();
                }
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