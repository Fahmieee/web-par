require(["../common" ], function (common) {  
    require(["main-function","../app/app-notification"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});