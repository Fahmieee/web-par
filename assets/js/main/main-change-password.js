require(["../common" ], function (common) {  
    require(["main-function","../app/app-change-password"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});