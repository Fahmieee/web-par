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
        tableKurs:null,
        init: function () { 
            App.initFunc();
            App.initEvent();  
            App.initConfirm();

            $('.date').datepicker({
                format: 'dd/mm/yyyy',
                orientation: 'bottom',
                todayHighlight: true,
                 autoclose: true
            });

            $(".loadingpage").hide();
        },  
        initEvent : function(){  
            App.table = $('#table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax":{
                    "url": App.baseUrl+"currency/dataList",
                    "dataType": "json",
                    "type": "POST",
                },
                "columns": [
                    { "data": "id" },
                    { "data": "code" },
                    { "data": "country_name" },
                    { "data": "name" },
                    { "data": "description" },
                    { "data": "action" ,"orderable": false}
                ]      
            });
            //append button to datatables
            var add_btn = '<a href="'+App.baseUrl+'currency/create" class="btn btn-sm btn-primary ml-2 mt-1"><i class="fa fa-plus"></i> Currency</a>';
            $('#table_filter').append(add_btn);

            App.tableKurs = $('#table-kurs').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax":{
                    "url": App.baseUrl+"currency/kursDataList",
                    "dataType": "json",
                    "type": "POST",
                },
                "columns": [
                    { "data": "id" },
                    { "data": "currency_code" },
                    { "data": "kurs_date" },
                    { "data": "kurs_nominal" },
                    { "data": "remark" }
                ]      
            });

            add_btn = '<button class="btn btn-sm btn-primary ml-2 mt-1" data-toggle="modal" data-target="#m"><i class="fa fa-plus"></i>  Kurs</button>';
            $('#table-kurs_filter').append(add_btn);

            if($("#form").length > 0){
                $("#save-btn").removeAttr("disabled");
                $("#form").validate({ 
                    rules: {
                        name: {
                            required: true
                        },
                        country_id: {
                            required: true
                        },
                        code: {
                            required: true
                        }
                    },
                    messages: {
                        name: {
                            required: "Nama Currency Harus Diisi"
                        },
                        country_id: {
                            required: "Negara Harus Diisi"
                        },
                        code: {
                            required: "Kode Currency Harus Diisi"
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
            

            if($("#form-kurs").length > 0){
                $("#save-btn-kurs").removeAttr("disabled");
                $("#form-kurs").validate({ 
                    rules: {
                        currency_id: {
                            required: true
                        },
                        kurs_date: {
                            required: true
                        },
                        kurs_nominal: {
                            required: true
                        }
                    },
                    messages: {
                        currency_id: {
                            required: "Currency Harus Dipilih"
                        },
                        kurs_date: {
                            required: "Tanggal Kurs Harus Diisi"
                        },
                        kurs_nominal: {
                            required: "Nominal Kurs Harus Diisi"
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