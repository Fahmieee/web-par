define(['jQuery'], function ($) {
    return { 
        clickEvent               : "click", 
        loading                  : $("#loading"),
        baseUrl                  : document.getElementById("base_url").value,
        initFunc    : function () {
            App.initValidationForm();
        }, 
        initValidationForm :function(){
            $('.number').keydown(function (e) {
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                     // Allow: Ctrl+A, Command+A
                    (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
                     // Allow: home, end, left, right, down, up
                    (e.keyCode >= 35 && e.keyCode <= 40)) {
                         // let it happen, don't do anything
                         return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
        },
        alert       : function(msg, callback){
            $("#alert_modal .modal-title").text("");
            // if (title != undefined && title != false && title != "") {
            //     $("#alert_modal .modal-title").text(title);
            // }
            $(".alert-msg").text(msg);
            $(".alert-cancel").hide();
            $(".alert-ok").show(); 

            $('#alert_modal').modal('show');

            $("#alert_modal .alert-ok").bind(App.clickEvent, function (e) {
                if (callback != undefined && callback != null && callback != false) {
                    callback();
                }
             
                setTimeout(function() {
                    $("#alert_modal").modal("hide");
                }, 200);
                
                e.preventDefault(); 
                $(this).unbind();
            }); 
        }, 
        confirm       : function(msg, callbackOk, callbackCancel){
            $("#alert_modal .modal-title").text("");
            // if (title != undefined && title != false && title != "") {
            //     $("#alert_modal .modal-title").text(title);
            // }

            $(".alert-msg").text(msg);
            $(".alert-cancel").show();
            $(".alert-ok").show(); 

            $('#alert_modal').modal('show');

            $("#alert_modal .alert-ok").bind(App.clickEvent, function (e) {
                if (callbackOk != undefined && callbackOk != null && callbackOk != false) {
                    callbackOk();
                }
                setTimeout(function() {
                    $("#alert_modal").modal("hide");
                }, 200);
                
                e.preventDefault();
                $(this).unbind();
                $("#alert_modal .alert-cancel").unbind();
            });

            $("#alert_modal .alert-cancel").bind(App.clickEvent, function (e) {
                if (callbackCancel != undefined && callbackCancel != null && callbackCancel != false) {
                    callbackCancel();
                }
                setTimeout(function() { 
                    $("#alert_modal").modal("hide");
                }, 200);
                
                e.preventDefault();
                $(this).unbind();
                $("#alert_modal .alert-ok").unbind();
            });
        }, 
        approval       : function(msg, callbackOk, callbackCancel){
            $("#alert_approval .modal-title").text(""); 

            $(".alert-msg").text(msg);
            $(".alert-cancel").show();
            $(".alert-reject").show();
            $(".alert-approve").show(); 

            $('#alert_approval').modal('show');
            $("#alert_approval .alert-cancel").bind(App.clickEvent, function (e) { 
                setTimeout(function() {
                    $("#alert_approval").modal("hide");
                }, 200);
                
                e.preventDefault();
                $(this).unbind();
                $("#alert_approval .alert-approve").unbind();
            });
            $("#alert_approval .alert-approve").bind(App.clickEvent, function (e) {
                if (callbackOk != undefined && callbackOk != null && callbackOk != false) {
                    callbackOk();
                }
                setTimeout(function() {
                    $("#alert_approval").modal("hide");
                }, 200);
                
                e.preventDefault();
                $(this).unbind();
                $("#alert_approval .alert-cancel").unbind();
            }); 

            $("#alert_approval .alert-reject").bind(App.clickEvent, function (e) {
                if (callbackCancel != undefined && callbackCancel != null && callbackCancel != false) {
                    callbackCancel();
                }
                setTimeout(function() {
                    $("#alert_approval").modal("hide");
                }, 200);
                
                e.preventDefault();
                $(this).unbind();
                $("#alert_approval .alert-ok").unbind();
            });
        }, 
    }
});