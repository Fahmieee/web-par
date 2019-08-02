require(["../common" ], function (common) {  
    require(["main-function","../app/app-currency"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});