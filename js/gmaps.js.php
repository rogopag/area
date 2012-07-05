<?php 
header('Content-Type: text/javascript;');
include '/home/rogopag/www/projects/area/wordpress/searchmap.php';
?>

$(document).ready(function(){
loadMap();
});

function loadMap() {
      if (GBrowserIsCompatible()) {
			map = new GMap2(document.getElementById("carta"));
			map.addControl(new GSmallMapControl());
			map.addControl(new GMapTypeControl());
			<?php if ( $lat != NULL) {?>
			var marker = new GMarker(new GLatLng(<?php echo $lat;?>,<?php echo $lang;?>));
         map.setCenter(new GLatLng(<?php echo $lat;?>, <?php echo $lang;?>), 10, null);
           map.addOverlay(marker);
           <?php } else {?>
            map.setCenter(new GLatLng(44.809121700077355, 10.01953125), 5, null);
             <?php } ?>
    }
}
