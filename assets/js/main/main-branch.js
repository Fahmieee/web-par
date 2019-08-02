require(["../common" ], function (common) {  
    require(["main-function","../app/app-branch"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});