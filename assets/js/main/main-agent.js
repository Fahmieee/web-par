require(["../common" ], function (common) {  
    require(["main-function","../app/app-agent"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});