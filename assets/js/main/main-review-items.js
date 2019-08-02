require(["../common" ], function (common) {  
    require(["main-function","../app/app-review-items"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});