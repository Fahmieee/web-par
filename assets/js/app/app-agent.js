define([
    "jQuery",
    "bootstrap",
    "datatables",  
    "datatablesBootstrap", 
    "sidebar",
    "treeview",
    "jqvalidate",
    "jqueryStep",
    "bootstrapDatepicker",
	], function (
    $,
	bootstrap,  
    datatables,
    datatablesBootstrap,
    sidebar, 
    treeview,
    jqvalidate,
    jqueryStep,
    bootstrapDatepicker,
	) {
    return {  
        table:null,
        form:null,
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
             $('.date').datepicker({
                format: 'dd/mm/yyyy', 
                 autoclose: true
            });
            App.table = $('#table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax":{
                    "url": App.baseUrl+"agent/dataList",
                    "dataType": "json",
                    "type": "POST",
                }, 
                "columns": [
                    { "data": "id"},  
                    { "data": "username" },  
                    { "data": "call_sign" },  
                    { "data": "company_name" },  
                    { "data": "address" }, 
                    { "data": "responsible_person" }, 
                    { "data": "join_date" }, 
                    { "data": "periode_date" }, 
                    { "data": "registered_on" }, 
                    { "data": "status" }, 
                    { "data": "action","orderable": false}
                ]   
            }) ; 

            if($("#form").length > 0){
                $("#save-btn").removeAttr("disabled");
                var isRequired = true; 
                var id = $("#id").val(); 
                if(id != undefined && id.length >= 1){
                    isRequired = false;
                }
                App.form = $("#form");
                App.form.steps({
                    labels: {
                        finish: "Finish",
                        next: "Next <i class='fa fa-chevron-right'></i>",
                        previous: "<i class='fa fa-chevron-left'></i> Previous"
                    },
                    onStepChanging: function (event, currentIndex, newIndex)
                    {
                        // Allways allow previous action even if the current form is not valid!
                        if (currentIndex > newIndex)
                        {
                            return true;
                        }
                        // Forbid next action on "Warning" step if the user is to young
                        if (newIndex === 3 && Number($("#age-2").val()) < 18)
                        {
                            return false;
                        }
                        // Needed in some cases if the user went back (clean up)
                        if (currentIndex < newIndex)
                        {
                            // To remove error styles
                            App.form.find(".body:eq(" + newIndex + ") label.error").remove();
                            App.form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
                        }
                        App.form.validate().settings.ignore = ":disabled,:hidden";
                        return App.form.valid();
                    },
                    onFinished: function (event, currentIndex)
                    {
                        App.form.submit();
                    }
                }).validate({  
                    rules: {
                        name: {
                            required: true
                        },
                        email: {
                            required: true
                        },  
                        company: {
                            required: true
                        },
                        department: {
                            required: true
                        },
                        nip: {
                            required: true
                        },
                        port_id: {
                            required: true
                        },
                        username: {
                            required: true
                        },
                        siup_file: {
                            required: isRequired
                        },
                        akta_file: {
                            required: isRequired
                        },
                        skdp_file: {
                            required: isRequired
                        },
                        structure_file: {
                            required: isRequired
                        },
                        npwp_file: {
                            required: isRequired
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
                        akta_number: {
                            required: true
                        },
                        siup_number: {
                            required: true
                        },
                        npwp_number: {
                            required: true
                        }, 
                        responsible_name: {
                            required: true
                        },
                        responsible_phone_number: {
                            required: true
                        },
                        responsible_email: {
                            required: true
                        },
                        siup_date: {
                            required: true
                        },
                        company_name: {
                            required: true
                        },
                        ktp_file: {
                            required: isRequired
                        },
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
                            required: "No KTP Harus Diisi"
                        }, 
                        port_id: {
                            required: "Pelabuhan Harus Diisi"
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
                        siup_file: {
                            required: "File Siup Harus Diisi"
                        },
                        akta_file: {
                           required: "File Akta Harus Diisi"
                        },
                        skdp_file: {
                           required: "File SKDP Harus Diisi"
                        },
                        structure_file: {
                           required: "File Struktur Organisasi Harus Diisi"
                        },
                        npwp_file: {
                           required: "File NPWP Harus Diisi"
                        },
                        akta_number: {
                           required: "Nomor Akta Harus Diisi"
                        }, 
                        siup_number: {
                             required: "Nomor SIUP Harus Diisi"
                        },
                        npwp_number: {
                             required: "Nomor NPWP Harus Diisi"
                        }, 
                        responsible_name: {
                             required: "Nama Penanggung Jawab Harus Diisi"
                        },
                        responsible_phone_number: {
                             required: "Nomor Penanggung Jawab Harus Diisi"
                        },
                        responsible_email: {
                             required: "Email Penanggung Jawab Harus Diisi"
                        },
                        siup_date: {
                             required: "Tanggal Siup Harus Diisi"
                        },
                        company_name: {
                             required: "Nama Perusahaan Harus Diisi"
                        },
                        ktp_file: {
                             required: "File KTP Harus Diisi"
                        },
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
                
                //inline back button to jquery step
                var back_button =   '<div class="disabled pull-left">'
                                        +'<a href="'+App.baseUrl+'agent" class="btn-sm ml-2 disabled">Batal</a>';
                                    +'</div>';
                $('.actions').append(back_button);
            }             
        }, 
        searchTable:function(){ 
            $('#search').on('click', function () {
                console.log("SEARCH");
                var username = $("#username").val();
                var company_name = $("#company_name").val();
                var company_field = $("#company_field").val();
                var responsible_person = $("#responsible_person").val();
                var email = $("#email").val();
                var phone = $("#phone").val(); 
 
                App.table.column([1]).search(username,true,true);
                App.table.column(2).search(company_name,true,true);
                App.table.column(6).search(responsible_person,true,true);
                App.table.column(4).search(phone,true,true);
                App.table.column(5).search(email,true,true);
                App.table.search(company_field,true,true);
                

                App.table.draw();
                
            }); 
        },
        resetSearch:function(){
            $('#reset').on( 'click', function () {
                $("#username").val("");
                $("#company_name").val("");
                $("#company_field").val("");
                $("#responsible_person").val("");
                $("#email").val("");
                $("#phone").val("");

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


            $("#approve-agent").on("click",function(){
                var url = $(this).attr("url"); 
                App.confirm("Apakah Anda Yakin Menyetujui Agent Ini?",function(){
                   $.ajax({
                      method: "GET",
                      url: url
                    }).done(function( msg ) {
                         window.location.href=App.baseUrl+"agent";
                    });        
                })
            });
            $("#reject-agent").on("click",function(){
                var url = $(this).attr("url");
                var reason = $("#reason").val(); 
                if(reason.length <= 0){
                     App.alert("Silahkan Isi Alasan");
                }else{
                    App.confirm("Apakah Anda Yakin Tidak Menyetujui Agent Ini?",function(){
                       $.ajax({
                          method: "POST",
                          url: url,
                          data: {
                            company_id : $("#company_id").val(),
                            reason : $("#reason").val()
                          }
                        }).done(function( msg ) {
                             window.location.href=App.baseUrl+"agent";
                        });        
                    })
                }
                
            });
        }
	}
});