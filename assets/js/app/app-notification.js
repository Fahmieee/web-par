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
            $(".loadingpage").hide();
        }, 
        initEvent : function(){   
            $(".item-notif").on("click",function(){
                var url = $(this).attr('url');
                var id = $(this).attr('id');
                $.ajax({
                  method: "GET",
                  url: App.baseUrl+"inbox/setNotificationRead/"+id
                }).done(function( msg ) {
                    var response = JSON.parse(msg);
                    console.log(response);
                    if(response.status){
                        window.location.href=url;
                    }
                }); 
            });
                 
        }
	}
});