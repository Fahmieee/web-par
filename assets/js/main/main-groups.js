require(["../common" ], function (common) {  
    require(["main-function","../app/app-groups"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});