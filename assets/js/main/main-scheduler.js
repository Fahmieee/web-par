require(["../common" ], function (common) {  
    require(["main-function","../app/app-scheduler"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});