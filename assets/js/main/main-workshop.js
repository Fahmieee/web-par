require(["../common" ], function (common) {  
    require(["main-function","../app/app-workshop"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});