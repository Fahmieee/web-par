
define([
    "jQuery",
    "jQueryUI",
    "sidebar",
	"bootstrap",
    "datatables",  
    "datatablesBootstrap", 
    "treeview",
    "jqvalidate",
    "bootstrapDatepicker",
    "starrr"
	], function (
    $,
    jQueryUI,
	bootstrap,  
    datatables,
    datatablesBootstrap,
    sidebar, 
    treeview,
    jqvalidate,
    bootstrapDatepicker,
    starrr
	) {
    return {  
        table:null,
        tableTop:null,
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

            $('.star').starrr();

             $("#to").datepicker({
                autoclose:true,
                todayHighlight:true,
                format:'yyyy-mm-dd'
            });
            App.table = $('#table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax":{
                    "url": App.baseUrl+"report/driverList",
                    "dataType": "json",
                    "type": "POST",
                },
                "columns": [
                    { "data": "id" }, 
                    { "data": "driver_id" }, 
                    { "data": "driver_name" }, 
                    { "data": "driver_type" }, 
                    { "data": "alokasi" },    
                    { "data": "rating" ,"orderable": false} 
                ]      
            }); 
          
            App.initFilterReview();
             $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
              var target = $(e.target).attr("href") // activated tab
              console.log(target);
                App.targetActive = target;
                if(target == "#drivertop"){
                    if(App.tableTop == null){
                        App.tableTop = $('#table-top').DataTable({
                            "processing": true,
                            "serverSide": true,
                            "ajax":{
                                "url": App.baseUrl+"report/topDriverList",
                                "dataType": "json",
                                "type": "POST",
                            },
                            "columns": [
                               { "data": "id" }, 
                                { "data": "driver_id" }, 
                                { "data": "driver_name" }, 
                                { "data": "driver_type" }, 
                                { "data": "alokasi" },    
                                { "data": "rating","orderable": false } 

                            ]      
                        }); 
                    }else{
                        App.tableTop.ajax.reload();
                    }
                   
                } 
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
        initFilterReview:function(){
            $("#filter-month").on("change",function(){
                var month = $(this).val();
                console.log(month);
                var report = $(".report");
                for (var i = 0; i < report.length; i++) { 
                    if(month == 0){
                         $(report[i]).show();
                    }else if($(report[i]).attr("id") == month){
                        console.log($(report[i]).attr("id"));
                        $(report[i]).show();
                    }else{
                       $(report[i]).hide();
                    } 
                }
            });
        },
        searchTable:function(){ 
            $('#search').on('click', function () {
                console.log("SEARCH"); 
                var driver_id = $("#driver_id").val();
                var driver_name = $("#driver_name").val(); 
                if(App.targetActive == "#drivertop"){
                    App.tableTop.column(1).search(driver_id,true,true);
                    App.tableTop.column(2).search(driver_name,true,true);  
                    App.tableTop.draw();
                }else{
                    App.table.column(1).search(driver_id,true,true);
                    App.table.column(2).search(driver_name,true,true);  
                    App.table.draw();
                }
               
                
            }); 
        },
        resetSearch:function(){
            $('#reset').on( 'click', function () { 
                console.log("asd");
                $("#driver_id").val("");
                $("#driver_name").val(""); 
                if(App.targetActive == "#drivertop"){
                    App.table.search( '' ).columns().search( '' ).draw();
                }else{
                    App.tableTop.search( '' ).columns().search( '' ).draw();
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