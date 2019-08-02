require(["../common" ], function (common) {  
    require(["main-function","../app/app-city"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});