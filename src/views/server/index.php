<?php
/**
 * Created by PhpStorm.
 * User: Brett
 * Date: 30/10/2015
 * Time: 7:31 PM
 */

$this->title = 'Servers';
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="map_canvas" style="width:100%; height:100%"></div>

<style type="text/css">
    html {
        height: 100%
    }

    body {
        height: 100%;
        margin: 0;
        padding: 0
    }

    #map_canvas {
        height: 100%
    }
</style>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyA6aXUYnpxJTCdvHwVRK24Sc-fx28Z4gXc&sensor=false"></script>
<script type="text/javascript">
    function initialize() {
        var myLatlng = new google.maps.LatLng(-25.363882, 131.044922);
        var mapOptions = {
            zoom: 3,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
        var infowindow = new google.maps.InfoWindow();
        <?php foreach ($servers as $k=>$server) { ?>
        var marker_<?php echo $k; ?> = new google.maps.Marker({
            position: new google.maps.LatLng(<?php echo $server['lat']; ?>, <?php echo $server['lon']; ?>),
            title: '<?php echo addslashes($server['name']); ?>',
            map: map
        });
        google.maps.event.addListener(marker_<?php echo $k; ?>, 'click', function () {
            infowindow.setContent('<strong><a href="<?php echo $server['site']; ?>"><?php echo addslashes($server['name']); ?></a></strong><br/><?php echo $server['host']; ?>:<?php echo $server['port']; ?><br/><br/>Uptime: <?php echo $server['uptime']; ?>');
            infowindow.open(map, marker_<?php echo $k; ?>);
        });
        <?php } ?>
        initialize();
    }
</script>