require(["../common" ], function (common) {  
    require(["main-function","../app/app-preorder"], function (func,application) { 
    App = $.extend(application,func);
        App.init();  
    }); 
});