define([
    "jQuery",
    "jQueryUI",
    "sidebar",
	"bootstrap",
    "datatables",  
    "datatablesBootstrap", 
    "treeview",
    "jqvalidate",
    "uiForm"
	], function (
    $,
    jQueryUI,
	bootstrap,  
    datatables,
    datatablesBootstrap,
    sidebar, 
    treeview,
    jqvalidate,
    uiForm
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
            App.initDatatables();
            App.formValidation(); 
            
            $("#checkAll").change(function () {  
                $("input:checkbox.cb-element").prop('checked', $(this).prop("checked"));
                $("input:checkbox.cb-element-child").prop('checked', $(this).prop("checked"));
            });
            $(".cb-element").change(function () { 
                
                App.checkAllCheckbox();
                $parent = $(this).closest( "tr" ).find(".cb-element-child"); 
                $parent.prop('checked', $(this).prop("checked"));
            });

            $(".cb-element-child").change(function () { 
                $parent = $(this).closest( "tr" ).find(".cb-element");
                $child = $(this).closest( "tr" ).find(".cb-element-child"); 
                $childChecked = $(this).closest( "tr" ).find(".cb-element-child:checked"); 

                _tot = $child.length                        
                _tot_checked = $childChecked.length;   
                if(_tot != _tot_checked){
                    $parent.prop('checked',false);
                }else{
                   $parent.prop('checked',true);
                }
                App.checkAllCheckbox();
            });

            var group_id_selected = $("#group_id_selected").val();
            var role_id_selected = $("#role_id_selected").val();
            $( "#area_id" ).change(function() {
                var area_id = $(this).val();
                $.ajax({
                  method: "GET",
                  url: App.baseUrl+"group/getGroupsByArea",
                  data: { area_id: area_id}
                })
                .done(function( msg ) {
                    var response = JSON.parse(msg);
                    var groups = response.data;
                    if(response.status){
                        var html = '<option  >Pilih Departemen</option>';
                        for (var i = 0; i < groups.length; i++) { 
                            if(group_id_selected == groups[i].id){
                                html += "<option value='"+groups[i].id+"' selected>"+groups[i].name+"</option>";
                            }else{
                                html += "<option value='"+groups[i].id+"'>"+groups[i].name+"</option>";    
                            } 
                        }

                        $("#group_id").html(html);
                        if(role_id_selected.length > 0){
                            $( "#group_id" ).trigger('change'); 
                        }
                    }
                   
                });
            });

            $( "#group_id" ).change(function() {
                var group_id = $(this).val();
                $.ajax({
                  method: "GET",
                  url: App.baseUrl+"role/getRoleByGroup",
                  data: { group_id: group_id}
                })
                .done(function( msg ) {
                    var response = JSON.parse(msg);
                    var roles = response.data;
                    if(response.status){
                        var html = '<option  >Pilih Jabatan</option>';
                        for (var i = 0; i < roles.length; i++) { 
                            if(role_id_selected == roles[i].id){
                                html += "<option value='"+roles[i].id+"' selected>"+roles[i].name+"</option>";
                            }else{
                                html += "<option value='"+roles[i].id+"'>"+roles[i].name+"</option>";    
                            } 
                        }

                        $("#role_id").html(html);
                    }
                   
                });
            });

            $("#area_id").change();
        },
        initDatatables :function(){
            App.table = $('#table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax":{
                    "url": App.baseUrl+"privilleges/dataList",
                    "dataType": "json",
                    "type": "POST",
                },
                "columns": [
                    { "data": "id" },
                    { "data": "role_name" }, 
                    { "data": "group_name" },
                    { "data": "area_name" },
                    { "data": "action" ,"orderable": false}
                ]      
            });
            
            //append button to datatables
            add_btn = '<a href="'+App.baseUrl+'privilleges/create" class="btn btn-sm btn-primary ml-2 mt-1"><i class="fa fa-plus"></i> Privilleges</a>';
            $('#table_filter').append(add_btn);
        },
        formValidation:function(){
            if($("#form").length > 0){
                $("#save-btn").removeAttr("disabled");
                $("#form").validate({ 
                    rules: {
                        name: {
                            required: true
                        },
                        ship_type_id: {
                            required: true
                        },
                        currency_id: {
                            required: true
                        },
                        code: {
                            required: true
                        }
                    },
                    messages: {
                        name: {
                            required: "Nama Tipe Kapal Harus Diisi"
                        },
                        ship_type_id: {
                            required: "Tipe Kapal Harus Diisi"
                        },
                         currency_id: {
                            required: "Currency Harus Diisi"
                        },
                        code: {
                            required: "Kode Tipe Kapal Harus Diisi"
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
        checkAllCheckbox:function(){
            _tot = $(".cb-element").length                        
            _tot_checked = $(".cb-element:checked").length;   
            if(_tot != _tot_checked){
                $("#checkAll").prop('checked',false);
            }else{
                $("#checkAll").prop('checked',true);
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