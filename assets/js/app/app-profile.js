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
            if($("#form").length > 0){
                $("#save-btn").removeAttr("disabled");
                $("#form").validate({ 
                     rules: {
                        name: {
                            required: true
                        },
                        email: {
                            required: true
                        },   
                        department: {
                            required: true
                        },
                        nip: {
                            required: true
                        },
                        username: {
                            required: true
                        },
                        password: {
                            required: true,
                            minlength: 8
                        },
                        password_confirm: {
                            required: true,
                            minlength: 8,
                            equalTo: "#password"
                        },
                        role_id: {
                            required: true
                        } 
                    },
                    messages: {
                        name: {
                            required: "Nama Harus Diisi"
                        },
                        email: {
                            required: "Email Harus Diisi"
                        }, 
                        company: {
                            required: "Perusahaan Harus Diisi"
                        },
                        department: {
                            required: "Jabatan Harus Diisi"
                        },
                         nip: {
                            required: "NIP Harus Diisi"
                        }, 
                        username: {
                            required: "Username Harus Diisi"
                        },
                        password: {
                            required: "Password Harus Diisi",
                            minlength: "Minimal 8 "
                        }, 
                        password_confirm: {
                            required: "Ulangi Password Harus Diisi",
                            minlength: "Minimal 8 ",
                            equalTo: "Password Tidak Sama"
                        },    
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
                        var html = '<option  >Pilih Grup</option>';
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
                        var html = '<option  >Pilih Role</option>';
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
            $( "#area_id" ).trigger('change'); 
            
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