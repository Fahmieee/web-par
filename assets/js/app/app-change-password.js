define([
    "jQuery",
	"bootstrap",
    "jqvalidate",
    "datatables",
    "sidebar", 
    "treeview",
	], function (
    $,
	bootstrap,
    jqvalidate,
    datatables,
    sidebar,
    treeview
	) {
    return {  
        init: function () { 
        	App.initFunc();
            App.initEvent(); 
            console.log("loaded");
            $(".loadingpage").hide();
		},
         
        initEvent : function(){  
            $("#form-change-password").validate({ 
                rules: {
                    old: {
                        required: true
                    },
                    new: {
                        required: true,
                        minlength: 8
                    },
                    new_confirm: {
                        required: true,
                        equalTo: "#new",
                        minlength: 8
                    },

                },
                messages: {
                    old: {
                        required: "Password Lama Harus Diisi"
                    },
                    new: {
                        required: "Password Baru Harus Diisi",
                        minlength: "Minimal 8"
                    },
                    new_confirm: {
                        required: "Konfirmasi Password Harus Diisi",
                        equalTo: "Password tidak sama",
                        minlength: "Minimal 8"
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
	}
});