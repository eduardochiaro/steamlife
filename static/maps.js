
var map;
var location_point;
var service;
var infowindow;
var markerList = [];

function geo(){
	if (navigator.geolocation){
		navigator.geolocation.getCurrentPosition(
			function( position ){
			 
				// Check to see if there is already a location.
				// There is a bug in FireFox where this gets
				// invoked more than once with a cahced result.
				if (!map){
					return;
				}
				 
				// Log that this is the initial position.
				console.log( "Initial Position Found" );
				 
				
  				location_point = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
				map.panTo(location_point); 
				map.setZoom(14);
			},
			function( error ){
				console.log( "Something went wrong: ", error );
			},
			{
				timeout: (5 * 1000),
				maximumAge: (1000 * 60 * 15),
				enableHighAccuracy: true
			}
		);
	}	
}
function initialize() {
	location_point = new google.maps.LatLng(0,0);

	map = new google.maps.Map(document.getElementById('map'), {
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		center: location_point,
		zoom: 12
	});
	
	infowindow = new google.maps.InfoWindow();

}
function getZoomLevel(m){
    var z=Math.floor((Math.log(20088000/m))/Math.log(2));
    if (z>19) z=19;
    if (z<0) z=0;
    return z;
}
$('document').ready(function(){
	initialize();
});
function callback(results, status) {
  if (status == google.maps.places.PlacesServiceStatus.OK) {
    for (var i = 0; i < results.length; i++) {
      var place = results[i];
      createMarker(results[i]);
    }
  }
  zoom = getZoomLevel(5000);
  map.setZoom(zoom);
}

function search(){
	
	_request = $('#search').val();
	
	var request = {
		location: location_point,
		radius: '5000',
		types: [_request]
	};
	
	if(markerList && markerList.length !== 0){
	  for (var i = 0; i < markerList.length; i++ ) {
	    markerList[i].setMap(null);
	  }
	  markerList = [];
    }


	service = new google.maps.places.PlacesService(map);
	service.nearbySearch(request, callback);
}
function createMarker(place){
	var marker = new google.maps.Marker({
      map: map,
      position: place.geometry.location
    });
    google.maps.event.addListener(marker, 'click', function() {
      infowindow.setContent(place.name);
      infowindow.open(map, this);
    });
    markerList.push(marker);
}
var backgroundResizeFun=function(){
	$('#map_container').css({
		width:$(window).width()+'px',
		height:($(window).height() - 45)+'px'
	});
}
$(document).ready(function(){
	backgroundResizeFun();
	$(window).resize(function(){
		backgroundResizeFun();
	});
});
