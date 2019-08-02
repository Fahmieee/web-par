require(["../common" ], function (common) {  
    require(["main-function","../app/app-area"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});