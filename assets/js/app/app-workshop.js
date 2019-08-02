
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
        marker:null,
        init: function () { 
            App.initFunc();
            App.initEvent();  
            App.initConfirm();
            App.searchTable();
            App.resetSearch();
            if($("#map").length){ App.initMap2(); }
            $(".loadingpage").hide();
            $('.star').starrr();
        }, 
        initMap:function(){  
            console.log("INIT MAP");
            App.map = new google.maps.Map(document.getElementById('map'), {
              zoom: 11,
              center: {lat:-6.135200, lng: 106.813301}
            });

            var lat =  $("#lat").val();
            var long =  $("#long").val();

            if(lat.length > 0 && long.length > 0){
                  App.placeMarkerAndPanTo({lat: parseFloat(lat), lng: parseFloat(long)});
            }

            App.map.addListener('click', function(e) {
              if(App.marker != null) App.removeMarker(e.latLng);
              App.placeMarkerAndPanTo(e.latLng);
              console.log(e.latLng.lat());
              console.log(e.latLng.lng());
              $("#lat").val(e.latLng.lat());
              $("#long").val(e.latLng.lng());
            }); 
        },
        initMap2:function(){  
            var map = new google.maps.Map(document.getElementById('map'), {
              center: {lat:-6.135200, lng: 106.813301},
              zoom: 11,
              mapTypeId: 'roadmap'
            });

            // Create the search box and link it to the UI element.
            var input = document.getElementById('pac-input');
            var searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            // Bias the SearchBox results towards current map's viewport.
            map.addListener('bounds_changed', function() {
              searchBox.setBounds(map.getBounds());
            });

            var markers = [];
            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener('places_changed', function() {
              var places = searchBox.getPlaces();

              if (places.length == 0) {
                return;
              }

              // Clear out the old markers.
              markers.forEach(function(marker) {
                marker.setMap(null);
              });
              markers = [];

              // For each place, get the icon, name and location.
              var bounds = new google.maps.LatLngBounds();
              places.forEach(function(place) {
                if (!place.geometry) {
                  console.log("Returned place contains no geometry");
                  return;
                }
                var icon = {
                  url: place.icon,
                  size: new google.maps.Size(71, 71),
                  origin: new google.maps.Point(0, 0),
                  anchor: new google.maps.Point(17, 34),
                  scaledSize: new google.maps.Size(25, 25)
                };

                // Create a marker for each place.
                markers.push(new google.maps.Marker({
                  map: map,
                  icon: icon,
                  title: place.name,
                  position: place.geometry.location
                }));
                var location = place.geometry.location;
                console.log(location.lat());
                console.log(location.lng());
                 $("#lat").val(location.lat());
                 $("#long").val(location.lng());
                if (place.geometry.viewport) {
                  // Only geocodes have viewport.
                  bounds.union(place.geometry.viewport);
                } else {
                  bounds.extend(place.geometry.location);
                }
              });
              map.fitBounds(bounds);
            });
        },
        placeMarkerAndPanTo:function(latLng){
            App.marker = new google.maps.Marker({
              position: latLng,
              map: App.map
            });
            App.map.panTo(latLng);
        },
        removeMarker:function(latLng){ 
            App.marker.setMap(null);
        },
        initEvent : function(){  
            App.table = $('#table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax":{
                    "url": App.baseUrl+"workshop/dataList",
                    "dataType": "json",
                    "type": "POST",
                },
                "columns": [
                    { "data": "id" }, 
                    { "data": "code" },
                    { "data": "name" },
                    { "data": "address" },
                    { "data": "phone_number" },
                    { "data": "lat" }, 
                    { "data": "long" }, 
                    { "data": "pic_name","orderable": false }, 
                    { "data": "pic_phone" ,"orderable": false}, 
                    { "data": "action","orderable": false }
                ]      
            });
            App.initFormValidation();
            
             

            

            $("#add-pic").on("click",function(){ 
                $("#pic-container").append(App.getPicHtml()); 
            });
            
        }, 
        searchTable:function(){ 
            $('#search').on('click', function () {
                console.log("SEARCH");
                var partner = $("#partner").val();
                var name = $("#name").val();
                var area = $("#area").val(); 

                App.table.column(1).search(partner,true,true);
                App.table.column(2).search(name,true,true);
                App.table.column(3).search(area,true,true);  

                App.table.draw();
                
            }); 
        },
        resetSearch:function(){
            $('#reset').on( 'click', function () {
                $("#area").val("");
                $("#name").val(""); 
                $("#partner").val("0");

                App.table.search( '' ).columns().search( '' ).draw();
            });
        },
        getPicHtml:function(){
            return ' <div class="row">'+
                            '<div class="col-md-3">'+
                              '<div class="full-width">'+
                                '<div class="md-form-group full-width">'+
                                  '<input class="md-input" id="pic_name" name="pic_name[]" autocomplete="off" required>'+
                                  '<label >Nama PIC</label>'+
                                '</div>'+
                              '</div>'+
                           '</div>'+
                            '<div class="col-md-3">'+
                              '<div class="full-width">'+
                                '<div class="md-form-group full-width">'+
                                  '<input class="md-input" id="pic_phone" name="pic_phone[]" autocomplete="off" required>'+
                                  '<label >No Handphone</label>'+
                                '</div>'+
                              '</div>'+
                            '</div>'+
                            '<div class="col-md-3">'+
                              '<div class="full-width">'+
                                '<div class="md-form-group full-width">'+
                                  '<input class="md-input" id="pic_email" name="pic_email[]" autocomplete="off" required>'+
                                  '<label >Email PIC</label>'+
                                '</div>'+
                              '</div>'+
                            '</div>'+
                            '<div class="col-md-3">'+
                              '<div class="full-width">'+
                                '<div class="md-form-group full-width">'+
                                  '<select id="pic_cs" name="pic_cs[]" class="md-input">'+
                                    '<option value="0">Yes</option>'+
                                    '<option value="1">No</option>'+
                                  '</select>'+
                                  '<label >Select as CS</label>'+
                                '</div>'+
                              '</div>'+
                            '</div>'+
                          '</div>'; 
        },
        initFormValidation:function(){
            if($("#form").length > 0){
                $("#save-btn").removeAttr("disabled");
                $("#form").validate({ 
                    rules: {
                        rekanan: {
                            required: true
                        }, 
                        code: {
                            required: true
                        },
                        name: {
                            required: true
                        },
                        area_id: {
                            required: true
                        }, 
                        city_id: {
                            required: true
                        }
                    },
                    messages: {
                        rekanan: {
                            required: "Nama Rekanan Harus Dipilih"
                        },
                        code: {
                            required: "Kode Workshop Harus Diisi"
                        },
                        name: {
                            required: "Nama Workshop Harus Diisi"
                        },
                        area_id: {
                            required: "Nama Area Harus Dipilih"
                        },
                        city_id: {
                            required: "Nama Kota Harus Dipilih"
                        } 
                       
                    }, 
                    debug:true,
                    
                    errorPlacement: function(error, element) {
                        var name = element.attr('name');
                        var errorSelector = '.form-control-feedback[for="' + name + '"]';
                        var $element = $(errorSelector);
                        if ($element.length) { 
                            $(errorSelector).html(error.html());
                        } else {
                            error.insertAfter(element);
                        }
                    },
                    submitHandler : function(form) { 
                        form.submit();
                    }
                }); 
            }
        },
        initConfirm :function(){
            $('#table tbody').on( 'click', '.delete', function () {
                var url = $(this).attr("url");
                App.confirm("Apakah Anda Yakin Untuk Mengubah Ini?",function(){
                   $.ajax({
                      method: "GET",
                      url: url
                    }).done(function( msg ) {
                        App.table.ajax.reload(null,true);
                    });        
                })
            });
        }
	}
});