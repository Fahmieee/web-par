
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
            App.checkAllPartsEvent();
            $(".loadingpage").hide();
            App.lastID = 0;
        }, 
        initEvent : function(){  
            App.table = $('#table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax":{
                    "url": App.baseUrl+"maintenance_routine/dataList",
                    "dataType": "json",
                    "type": "POST",
                },
                "columns": [
                    { "data": "id" }, 
                    { "data": "merk" }, 
                    { "data": "distance" }, 
                    { "data": "parts","orderable": false  }, 
                    { "data": "action","orderable": false }
                ]      
            });
             

            if($("#form").length > 0){
                $("#save-btn").removeAttr("disabled");
                $("#form").validate({ 
                    rules: {
                        distance: {
                            required: true
                        },
                         merk: {
                            required: true
                        } 
                    },
                    messages: { 
                        distance: {
                            required: "KM Harus Diisi"
                        },
                        merk: {
                            required: "MERK Harus Diisi"
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
                        var dt = new Date();
                        var isoDate = new Date(dt).toISOString();
                        array_of_parts = JSON.parse($('.parts').val());
                        console.log(array_of_parts)
                        $.ajax({
                            url: App.baseUrl+"maintenance_request/getLastIDAPI",
                            type: 'POST',
                            dataType: 'json',
                        })
                        .done(function(data) {
                            console.log(data)
                            App.lastID = parseInt(data);
                            if(array_of_parts.length > 0){
                                App.counter = 1
                                $.each(array_of_parts, function(index, val) {
                                    $.ajax({
                                        // url: "http://45.76.177.197:9763/services/PAR/_postiwo",
                                        url : App.baseUrl+"maintenance_request/post_to_api",
                                        type: 'POST',
                                        crossDomain: true,
                                        // headers: { 
                                        //     'Content-Type':'application/json'
                                        // },
                                        data: {
                                            ID : App.lastID++,  
                                            DocumentNo : $('#order_wo_no').val(),
                                            AssetNo : $('#code_assets').val(),
                                            BPValue : $('#workshop_id').val(),
                                            DateDoc : $('#order_date').val(),
                                            Description : $('#description').val(),
                                            Note : $('#note').val(),
                                            mileage : $('#mileage').val(),
                                            productvalue : val.part_name, 
                                            ProductClassificationValue : val.part_service_type,
                                            ProductClassValue : val.part_code,
                                            Qty : 1,
                                            UserName : $('#id_username').val(),
                                            Phone : $('#phone').val(),
                                            Position : $('#role_id').val(),
                                            Allocation : $('#city_id').val(),
                                            DriverName : $('#driver_name').val(),
                                            EstPricePart : $('#est_biaya_part').val(),
                                            EstPriceService : $('#est_biaya_jasa').val(),
                                            DateStartSchedule : isoDate,
                                            DateFinishSchedule : isoDate
                                           },
                                           beforeSend: function() {
                                                // setting a timeout
                                                $('#save-btn').prop('disabled', true);
                                            },
                                    })
                                    .done(function(data) {
                                        console.log(data);
                                        console.log(App.counter+' '+array_of_parts.length)
                                        if(array_of_parts.length == App.counter){
                                            form.submit();
                                        }
                                        App.counter++
                                    })
                                    .fail(function(data) {
                                        console.log(data);
                                    })
                                    .always(function() {
                                        console.log("complete");
                                    });
                                    
                                });    
                            }else{
                                 $.ajax({
                                        url : App.baseUrl+"maintenance_request/post_to_api",
                                        type: 'POST',
                                        crossDomain: true, 
                                        data: {
                                            ID : App.lastID++,
                                            DocumentNo : $('#order_wo_no').val(),
                                            AssetNo : $('#code_assets').val(),
                                            BPValue : $('#workshop_id').val(),
                                            DateDoc : $('#order_date').val(),
                                            Description : $('#description').val(),
                                            Note : $('#note').val(),
                                            mileage : $('#mileage').val(),
                                            productvalue : 'empty', 
                                            ProductClassificationValue : 'empty',
                                            ProductClassValue : 'empty',
                                            Qty : 0,
                                            UserName : $('#id_username').val(),
                                            Phone : $('#phone').val(),
                                            Position : $('#role_id').val(),
                                            Allocation : $('#city_id').val(),
                                            DriverName : $('#driver_name').val(),
                                            EstPricePart : $('#est_biaya_part').val(),
                                            EstPriceService : $('#est_biaya_jasa').val(),
                                            DateStartSchedule : isoDate,
                                            DateFinishSchedule : isoDate
                                           },
                                           beforeSend: function() {
                                                // setting a timeout
                                                $('#save-btn').prop('disabled', true);
                                            },
                                    })
                                    .done(function() {
                                        console.log("success");
                                        form.submit();
                                    })
                            }
                            console.log(data);
                        })
                        .fail(function() {
                            console.log("error");
                        })
                        .always(function() {
                            console.log("complete");
                        }); 
                       
                    }
                }); 
            }
            
        }, 
        checkAllPartsEvent:function(){
            $("#checkAll").change(function () {  
                $("input:checkbox.cb-element").prop('checked', $(this).prop("checked"));
                $("input:checkbox.cb-element-child").prop('checked', $(this).prop("checked"));
            });
            $(".cb-element").change(function () { 
                 
                $parent = $(".cb-element-child"); 
                $parent.prop('checked', $(this).prop("checked"));
            });

            $(".cb-element-child").change(function () { 
                $parent = $(".cb-element");
                $child = $(".cb-element-child"); 
                $childChecked = $(".cb-element-child:checked"); 

                _tot = $child.length                        
                _tot_checked = $childChecked.length;   
                console.log(_tot_checked,_tot);
                if(_tot != _tot_checked){
                    $parent.prop('checked',false);
                }else{
                   $parent.prop('checked',true);
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