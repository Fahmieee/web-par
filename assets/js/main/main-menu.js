require(["../common" ], function (common) {  
    require(["main-function","../app/app-menu"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});