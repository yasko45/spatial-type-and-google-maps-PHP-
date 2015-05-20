

<?php 
include "ayar.php"; ?>

    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
    <script>
function initialize() {
  var mapOptions = {
    zoom: 4,
    center: new google.maps.LatLng(39.825413103424786, 26.785034090280533)
  };

  var map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);

 
<?php

$veriler = pg_query("SELECT ST_X(ST_AsText(yer)) as x, ST_Y(ST_AsText(yer)) as y ,mekan_adi FROM mekanlar");
$i=0;
while($listele = pg_fetch_array($veriler)) {
?>



    var position<?=$i?> = new google.maps.LatLng(<?=$listele['x']?>, <?=$listele['y']?>);
    var marker = new google.maps.Marker({
      position: position<?=$i?>,
      map: map
    });

    marker.setTitle('<?=$listele['mekan_adi']?>');
    attachSecretMessage(marker, <?=$i?>);
  <?php } ?>
}

// The five markers show a secret message when clicked
// but that message is not within the marker's instance data
function attachSecretMessage(marker, num) {
  var message = ['This', 'is', 'the', 'secret', 'message'];
  var infowindow = new google.maps.InfoWindow({
    content: message[num]
  });

  google.maps.event.addListener(marker, 'click', function() {
    infowindow.open(marker.get('map'), marker);
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
  
    <div id="map-canvas"></div>


