<!DOCTYPE html>
<html lang="en">
<head>
<meta charset=utf-8>
<meta name="viewport" content="width=620">
<title>Map</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo site_url('static/css/style.css')?>">
<?php echo $this->googlemapapi->getHeaderJS(); ?>
<?php echo $this->googlemapapi->getMapJS(); ?>
<!-- necessary for google maps polyline drawing in IE -->
<style type="text/css">
  v\:* {
    behavior:url(#default#VML);
  }
</style>
</head>
<body>

<?php echo $this->googlemapapi->printOnLoad();?>
<div id="map_container">
<?php echo $this->googlemapapi->printMap();?>
<a href="" id="plus_map">+</a>
</div>
<form action="<?php echo site_url('maps/save')?>" method="post">
	<p><label>name</label><input type="text" name="name" value=""></p>
	<p><label>position</label><input type="text" name="position" id="form-position" value=""><button id="navigator" type="button">geo</button></p>
	
	
	<button type="submit">send</button>
</form>

<script>
$('document').ready(function(){
	$('#navigator').click(function(){
		if (navigator.geolocation) {
		  	navigator.geolocation.getCurrentPosition(success, error);
		} else {
		 	error('no support');
		}
	});
});

function success(position){
	$('#form-position').val(position.coords.latitude+','+position.coords.longitude);
}
function error(msg) {
  	console.log(msg);
}
</script>
</body>
</html> 