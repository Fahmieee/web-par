define([
    "jQuery",
    "jQueryUI",
    "sidebar",
    "treeview",
    "bootstrap",
    "datatables",  
    "datatablesBootstrap", 
    "jqvalidate",
    "bootstrapDatepicker",
    "select2"
	], function (
    $,
    jQueryUI,
    sidebar, 
    treeview,
    bootstrap,  
    datatables,
    datatablesBootstrap,
    jqvalidate,
    bootstrapDatepicker,
    select2
	) {
    return {  
        table:null,
        init: function () { 
            App.initFunc();
            App.initEvent();  
            App.initConfirm();

            App.searchTable();
            App.resetSearch();

            $(".dataTables_filter").hide();
            $(".loadingpage").hide();
        }, 
        initEvent : function(){   
            App.table = $('#table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax":{
                    "url": App.baseUrl+"scheduler/dataList",
                    "dataType": "json",
                    "type": "POST",
                }, 
                "columns": [
                    { "data": "id" },  
                    { "data": "driver_type" },  
                    { "data": "driver_name" },
                    { "data": "company" }, 
                    { "data": "first_name" }, 
                    { "data": "merk" },
                    { "data": "model" },
                    { "data": "varian" },
                    { "data": "police_no" },
                    { "data": "action" ,"orderable": false}
                ]      
            });

            if($("#form").length > 0){
                $("#save-btn").removeAttr("disabled");
                $("#form").validate({ 
                     rules: { 
                        role_id: {
                            required: true
                        } 
                    },
                    messages: {    
                        role_id: {
                            required: "Role Harus Diisi"
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

            $("#start_date").datepicker({
                autoclose:true,
                todayHighlight:true,
                format:'yyyy-mm-dd'
            });
            $("#end_date").datepicker({
                autoclose:true,
                todayHighlight:true,
                format:'yyyy-mm-dd'
            });


            $('#driver_id').select2();
            $('#user_id').select2();
            App.findUnit();
        }, 
        findUnit:function(){
            $('#find-unit').on('click', function () {
                $.ajax({
                  method: "POST",
                  url: App.baseUrl+"unit/getUnitByNoPolice",
                  data:{
                    police_number:$("#police_number").val()
                  }
                }).done(function( msg ) { 
                    var response = JSON.parse(msg);
                    if(response.status){
                        var units = response.data[0];
                        console.log(units);
                        $("#branch_id").val(units.branch_id);
                        $("#unit_id").val(units.id);
                        if(units.type_assets == 1){
                            units.type_assets = "PAR";
                        }else{
                            units.type_assets = "VENDOR";
                        }
                        $("#type_assets").val(units.type_assets);
                        $("#type_unit").val(units.type_unit);
                        $("#merk").val(units.produk_name);
                        $("#model").val(units.model);
                        $("#varian").val(units.varian);
                        $("#transmition").val(units.transmition);
                        $("#mes").val(units.mes);
                        $("#stnk_due_date").val(units.stnk_due_date);
                        $("#kir_due_date").val(units.kir_due_date);
                        $("#mileage").val(units.mileage);
                        $("#years").val(units.years);
                        $("#chassis_number").val(units.chassis_number);
                        $("#machine_number").val(units.machine_number);
                        $("#color").val(units.color);

                    }else{
                        App.alert(response.msg);
                    }
                });  
            });
        },
        searchTable:function(){ 
            $('#search').on('click', function () {
                console.log("SEARCH");
                var driver_type = $("#driver_type").val();
                var allocation = $("#allocation").val();
                var driver_name = $("#driver_name").val(); 
                var police_number = $("#police_number").val(); 
                var merk = $("#merk").val(); 
 
                App.table.column(1).search(driver_type,true,true);
                App.table.column(2).search(allocation,true,true);
                App.table.column(3).search(driver_name,true,true); 
                App.table.column(4).search(police_number,true,true); 
                App.table.column(5).search(merk,true,true); 

                App.table.draw();
                
            }); 
        },
        resetSearch:function(){
            $('#reset').on( 'click', function () {
                $("#driver_type").val("");
                $("#allocation").val("");
                $("#driver_name").val(""); 
                $("#police_number").val(""); 
                $("#merk").val(""); 

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