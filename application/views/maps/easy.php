<!DOCTYPE html>
<html lang="en">
<head>
<meta charset=utf-8>
<meta name="viewport" content="width=620">
<title>Map</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo site_url('static/css/style.css')?>">
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&sensor=true"></script>
<!-- necessary for google maps polyline drawing in IE -->
<style type="text/css">
  v\:* {
    behavior:url(#default#VML);
  }
  #map{
  	width: 100%;
  	height: 500px;
  }
</style>
</head>
<body>

<div id="map_container">
<div id="map">
	
</div>
</div>
<a href="javascript:geo()">my location</a>
<br/>
<select id="search" > 
<option>accounting</option>
<option>airport</option>
<option>amusement_park</option>
<option>aquarium</option>
<option>art_gallery</option>
<option>atm</option>
<option>bakery</option>
<option>bank</option>
<option>bar</option>
<option>beauty_salon</option>
<option>bicycle_store</option>
<option>book_store</option>
<option>bowling_alley</option>
<option>bus_station</option>
<option>cafe</option>
<option>campground</option>
<option>car_dealer</option>
<option>car_rental</option>
<option>car_repair</option>
<option>car_wash</option>
<option>casino</option>
<option>cemetery</option>
<option>church</option>
<option>city_hall</option>
<option>clothing_store</option>
<option>convenience_store</option>
<option>courthouse</option>
<option>dentist</option>
<option>department_store</option>
<option>doctor</option>
<option>electrician</option>
<option>electronics_store</option>
<option>embassy</option>
<option>establishment</option>
<option>finance</option>
<option>fire_station</option>
<option>florist</option>
<option>food</option>
<option>funeral_home</option>
<option>furniture_store</option>
<option>gas_station</option>
<option>general_contractor</option>
<option>grocery_or_supermarket</option>
<option>gym</option>
<option>hair_care</option>
<option>hardware_store</option>
<option>health</option>
<option>hindu_temple</option>
<option>home_goods_store</option>
<option>hospital</option>
<option>insurance_agency</option>
<option>jewelry_store</option>
<option>laundry</option>
<option>lawyer</option>
<option>library</option>
<option>liquor_store</option>
<option>local_government_office</option>
<option>locksmith</option>
<option>lodging</option>
<option>meal_delivery</option>
<option>meal_takeaway</option>
<option>mosque</option>
<option>movie_rental</option>
<option>movie_theater</option>
<option>moving_company</option>
<option>museum</option>
<option>night_club</option>
<option>painter</option>
<option>park</option>
<option>parking</option>
<option>pet_store</option>
<option>pharmacy</option>
<option>physiotherapist</option>
<option>place_of_worship</option>
<option>plumber</option>
<option>police</option>
<option>post_office</option>
<option>real_estate_agency</option>
<option>restaurant</option>
<option>roofing_contractor</option>
<option>rv_park</option>
<option>school</option>
<option>shoe_store</option>
<option>shopping_mall</option>
<option>spa</option>
<option>stadium</option>
<option>storage</option>
<option>store</option>
<option>subway_station</option>
<option>synagogue</option>
<option>taxi_stand</option>
<option>train_station</option>
<option>travel_agency</option>
<option>university</option>
<option>veterinary_care</option>
<option>zoo</option>	
	
</select>
<button id="" onclick="search()">search</button>
<script>

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
		zoom: 15
	});
	
	infowindow = new google.maps.InfoWindow();

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
}
function search(){
	
	_request = $('#search').val();
	
	var request = {
		location: location_point,
		radius: '5000',
		types: [_request]
	};
	
	if(markerList && markerList.length !== 0){
		for(var i = 0; i < markerList.length; ++i){
			markerList[i].setMap(null);
    	}
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
</script>
</body>
</html> 