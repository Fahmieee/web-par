
define([
    "jQuery",
    "jQueryUI",
    "sidebar",
	"bootstrap",
    "datatables",  
    "datatablesBootstrap", 
    "treeview",
    "jqvalidate",
    "gmaps",
    "starrr"
	], function (
    $,
    jQueryUI,
	bootstrap,  
    datatables,
    datatablesBootstrap,
    sidebar, 
    treeview,
    jqvalidate,
    gmaps,
    starrr
	) {
    return {  
        table:null,
        map:null, 
        workshops:JSON.parse($("#data_workshop").val()),
        init: function () { 
            App.initFunc(); 

            if($("#map").length){ App.initMap(); }
            $(".loadingpage").hide(); 
        }, 
        initMap:function(){  
            console.log("INIT MAP");
            App.map = new google.maps.Map(document.getElementById('map'), {
              zoom: 11,
              center: {lat:-6.135200, lng: 106.813301}
            }); 

            for (var i = 0; i < App.workshops.length; i++) {
              var lat = parseFloat(App.workshops[i].lat);
              var long = parseFloat(App.workshops[i].long); 
              console.log(typeof lat,typeof long);
              var marker = new google.maps.Marker({ 
                position: {lat:lat,lng:long},
                title:App.workshops[i].produk_name+" - "+App.workshops[i].name
              });

              // To add the marker to the map, call setMap();
              marker.setMap(App.map);
            }
        }
	}
});