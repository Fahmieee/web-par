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
                    "url": App.baseUrl+"user/dataList",
                    "dataType": "json",
                    "type": "POST",
                }, 
                "columns": [
                    { "data": "id" },  
                    { "data": "username" }, 
                    { "data": "name" },
                    { "data": "department" },
                    { "data": "company" },
                    { "data": "phone" }, 
                    { "data": "action" ,"orderable": false}
                ]      
            });

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
                        company: {
                            required: true
                        },
                        department: {
                            required: true
                        }, 
                        username: {
                            required: ($("#user_id").val().length <= 0)
                        },
                        password: {
                            required:  ($("#user_id").val().length <= 0),
                            minlength: 8
                        },
                        password_confirm: {
                            required:  ($("#user_id").val().length <= 0),
                            minlength: 8,
                            equalTo: "#password"
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

             $("#join_date").datepicker({
                autoclose:true,
                todayHighlight:true,
                format:'yyyy-mm-dd'
            });
        }, 

        searchTable:function(){ 
            $('#search').on('click', function () {
                console.log("SEARCH"); 
                var username = $("#username").val(); 
                var name = $("#name").val();
                var handphone = $("#handphone").val(); 
                var join_date = $("#join_date").val(); 
  
                App.table.column(1).search(username,true,true);
                App.table.column(2).search(name,true,true);
                App.table.column(3).search(handphone,true,true);  
                App.table.column(4).search(join_date,true,true);

                App.table.draw();
                
            }); 
        },
        resetSearch:function(){
            $('#reset').on( 'click', function () { 
                $("#username").val(""); 
                $("#name").val("");
                $("#handphone").val(""); 
                $("#join_date").val("");

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

            $('#table tbody').on( 'click', '.approve', function () {
                var url = $(this).attr("url");
                App.confirm("Apakah Anda Yakin Untuk Approve User Ini?",function(){
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