define([
    "jQuery",
	"bootstrap",
    "jqvalidate",
    "datatables",
    "uiForm",
    "bootstrapDateTimepicker"
	], function (
    $,
	bootstrap,
    jqvalidate,
    datatables,
    uiForm,
    bootstrapDateTimepicker
	) {
    return {  
        init: function () { 
        	App.initFunc();
            App.initEvent(); 
            console.log("loaded");
            $(".loadingpage").hide();
		},
         
        initEvent : function(){ 
            $("#est_biaya_maintenance_start").datetimepicker({
                format: 'yyyy-mm-dd hh:ii',
                todayBtn: true,
                autoclose: true
            });
            $("#est_biaya_maintenance_end").datetimepicker({
                format: 'yyyy-mm-dd hh:ii',
                todayBtn: true,
                autoclose: true
            }); 
            $("#btn-login").removeAttr("disabled");
            $("#form-login").validate({ 
                rules: {
                    username: {
                        required: true
                    },
                    password: {
                        required: true
                    }
                },
                messages: {
                    username: {
                        required: "Username is Required"
                    },
                    password: {
                        required: "Password is Required"
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