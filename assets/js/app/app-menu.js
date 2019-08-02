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
        init: function () { 
        	App.initFunc();
            App.initEvent();  
            $(".loadingpage").hide();
            console.log("LOADED");
            $(".loadingpage").hide();
		}, 
        initEvent : function(){  
            $('#table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax":{
                    "url": App.baseUrl+"menu/dataList",
                    "dataType": "json",
                    "type": "POST",
                },
                "columns": [
                    { "data": "id" }, 
                    { "data": "parent" }, 
                    { "data": "name" },
                    { "data": "url" },
                    { "data": "icon" },
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
                        url: {
                            required: true
                        }
                    },
                    messages: {
                        name: {
                            required: "Nama Menu Harus Diisi"
                        },
                        url: {
                            required: "Url Harus Diisi"
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
	}
});