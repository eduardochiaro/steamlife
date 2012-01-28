<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
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
<?php echo $this->googlemapapi->printMap();?>

<form action="<?php echo site_url('maps/save')?>" method="post">
	<p><label>name</label><input type="text" name="name" value=""></p>
	<p><label>position</label><input type="text" name="position" value=""></p>
	<button type="submit">send</button>
</form>
</body>
</html> 