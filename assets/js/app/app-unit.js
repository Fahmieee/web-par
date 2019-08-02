
define([
    "jQuery",
    "jQueryUI",
    "sidebar",
    "treeview",
    "bootstrap",
    "datatables",  
    "datatablesBootstrap", 
    "jqvalidate",
    "bootstrapDatepicker"
	], function (
    $,
    jQueryUI,
    sidebar, 
    treeview,
    bootstrap,  
    datatables,
    datatablesBootstrap,
    jqvalidate,
    bootstrapDatepicker
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
                    "url": App.baseUrl+"unit/dataList",
                    "dataType": "json",
                    "type": "POST",
                },
                "columns": [
                    { "data": "id" }, 
                    { "data": "type_unit" },
                    { "data": "branch" },
                    { "data": "type_assets" },
                    { "data": "merk" },
                    { "data": "varian" },
                    { "data": "no_police" },
                    { "data": "stnk_due_date" },
                    { "data": "kir_due_date" },
                    { "data": "action","orderable": false }
                ]      
            });
            
          

            if($("#form").length > 0){
                $("#save-btn").removeAttr("disabled");
                $("#form").validate({ 
                    rules: {
                        merk: {
                            required: true
                        }, 
                        branch_id: {
                            required: true
                        }, 
                        type_assets: {
                            required: true
                        }, 
                        type_unit: {
                            required: true
                        }, 
                        model: {
                            required: true
                        }, 
                        varian: {
                            required: true
                        }, 
                        no_police: {
                            required: true
                        }
                    },
                    messages: { 
                        merk: {
                            required: "Merk Harus Diisi"
                        },
                        branch_id: {
                            required: "Cabang Harus Diisi"
                        },
                        type_unit: {
                            required: "Tipe Unit Harus Diisi"
                        },
                        model: {
                            required: "Model Harus Diisi"
                        },
                        varian: {
                            required: "Varian Harus Diisi"
                        },
                        no_police: {
                            required: "No Polisi Harus Diisi"
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
            

            $("#kir_due_date").datepicker({
                autoclose:true,
                todayHighlight:true,
                format:'yyyy-mm-dd'
            });
            $("#stnk_due_date").datepicker({
                autoclose:true,
                todayHighlight:true,
                format:'yyyy-mm-dd'
            });
        }, 
        searchTable:function(){ 
            $('#search').on('click', function () {
                console.log("SEARCH"); 
                var type_unit = $("#type_unit").val();  
                var merk = $("#merk").val(); 
                var branch_id = $("#branch_id").val(); 
                var no_police = $("#no_police").val();  
                var unit_name = $("#unit_name").val();  
                var type_assets = $("#type_assets").val();  
                App.table.column(1).search(type_unit,true,true); 
                App.table.column(2).search(merk,true,true); 
                App.table.column(3).search(branch_id,true,true); 
                App.table.column(4).search(no_police,true,true); 
                App.table.column(5).search(type_assets,true,true); 
                App.table.column(6).search(unit_name,true,true); 

                App.table.draw();
                
            }); 
        },
        resetSearch:function(){
            $('#reset').on( 'click', function () { 
                $("#type_unit").val(""); 
                $("#merk").val(""); 
                $("#branch_id").val(""); 
                $("#no_police").val("");
                $("#type_assets").val("");
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