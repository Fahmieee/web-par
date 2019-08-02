var App;
if(!window.console) {
        var console = {
            log : function(){},
            warn : function(){},
            error : function(){},
            time : function(){},
            timeEnd : function(){}
        }
    }
var log = function() {};

require.config({
    paths: {
        "jQuery": "../../plugins/jquery/jquery.min",
        "bootstrap" : "../../plugins/bootstrap/js/bootstrap",
        "datatables" : "../../plugins/datatables/js/jquery.dataTables.min", 
        "datatablesBootstrap" : "../../plugins/datatables/js/dataTables.bootstrap", 
        "jqvalidate" : "../../plugins/jquery-validate/jquery.validate.min",
        "jQueryUI" : "../../plugins/jquery-ui/jquery-ui.min",
        "moment" : "../../plugins/moment/moment.min",
        "bootstrapDatepicker" : "../../plugins/bootstrap-datepicker/bootstrap-datepicker.min",
        "treeview" : "../../plugins/treeview",
        "uiForm" : "../../plugins/ui-form",
        "sidebar" : "../../plugins/sidebar",
        "jqueryStep" : "../../plugins/jquery-step/jquery.steps", 
        "bootstrapWizard" : "../../plugins/twitter-bootstrap-wizard/jquery.bootstrap.wizard",
        "bootstrapTimepicker" : "../../plugins/bootstrap-timepicker/bootstrap-timepicker",
        "bootstrapDateTimepicker" : "../../plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker",
        "highchart" : "../../plugins/highchart/highcharts.src",
        "select2" : "../../plugins/select2/select2.min",
        "gmaps" : "https://maps.google.com/maps/api/js?key=AIzaSyBmRLO-R09Rv1Y7o2SEGeus_cB1NAqYFkU&libraries=places",
        "starrr" : "../../plugins/starrr"
    },
    waitSeconds: 0,
    urlArgs: "bust=" + (new Date()).getTime(),
    shim: {
        "jQuery": {
            exports: "jQuery",
            init: function(){
                console.log('JQuery inited..');
            }
        },
        "bootstrap": {
            deps: ["jQuery"],
            exports: "bootstrap",
            init: function(){
                console.log('bootstrap inited..');
            }
        },
        "datatables": {
            deps: ["jQuery"],
            exports: "datatables",
            init: function(){
                console.log('datatables inited..');
            }
        }, 
         "datatablesBootstrap": {
            deps: ["jQuery","datatables"],
            exports: "datatablesBootstrap",
            init: function(){
                console.log('datatablesBootstrap inited..');
            }
        }, 
        "jqvalidate": {
            deps: ["jQuery"],
            exports: "jqvalidate",
            init: function(){
                console.log('jqvalidate inited..');
            }
        },
        "jQueryUI": {
            deps: ["jQuery"],
            exports: "jQueryUI",
            init: function(){
                console.log('jQueryUI inited..');
            }
        }, 
        "treeview": {
            deps: ["jQuery"],
            exports: "treeview",
            init: function(){
                console.log('treeview inited..');
            }
        }, 
        "uiForm": {
            deps: ["jQuery"],
            exports: "uiForm",
            init: function(){
                console.log('uiForm inited..');
            }
        },  
        "moment": {
            deps: ["jQuery"],
            exports: "moment",
            init: function(){
                console.log('moment inited..');
            }
        },
        "bootstrapDatepicker": {
            deps: ["jQuery","bootstrap"],
            exports: "bootstrapDatepicker",
            init: function(){
                console.log('bootstrapDatepicker inited..');
            }
        },
        "bootstrapTimepicker": {
            deps: ["jQuery","bootstrap"],
            exports: "bootstrapTimepicker",
            init: function(){
                console.log('bootstrapTimepicker inited..');
            }
        },
        "bootstrapDateTimepicker": {
            deps: ["jQuery","bootstrap"],
            exports: "bootstrapDateTimepicker",
            init: function(){
                console.log('bootstrapDateTimepicker inited..');
            }
        },
        "sidebar": {
            deps: ["jQuery"],
            exports: "sidebar",
            init: function(){
                console.log('sidebar inited..');
            }
        }, 
        "bootstrapWizard": {
            deps: ["jQuery"],
            exports: "bootstrapWizard",
            init: function(){
                console.log('bootstrapWizard inited..');
            }
        }, 
         "jqueryStep": {
            deps: ["jQuery"],
            exports: "jqueryStep",
            init: function(){
                console.log('jqueryStep inited..');
            }
        },
        "highchart": {
            deps: ["jQuery"],
            exports: "highchart",
            init: function(){
                console.log('highchart inited..');
            }
        },
        "select2": {
            deps: ["jQuery"],
            exports: "select2",
            init: function(){
                console.log('select2 inited..');
            }
        },
        "gmaps": {
            deps: ["jQuery"],
            exports: "gmaps",
            init: function(){
                console.log('gmaps inited..');
            }
        },
        "starrr": {
            deps: ["jQuery"],
            exports: "starrr",
            init: function(){
                console.log('starrr inited..');
            }
        }
    }
}); 