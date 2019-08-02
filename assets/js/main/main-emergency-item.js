require(["../common" ], function (common) {  
    require(["main-function","../app/app-emergency-item"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});