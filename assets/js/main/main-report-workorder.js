require(["../common" ], function (common) {  
    require(["main-function","../app/app-report-workorder"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});