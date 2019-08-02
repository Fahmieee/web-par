require(["../common" ], function (common) {  
    require(["main-function","../app/app-maintenance-routine"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});