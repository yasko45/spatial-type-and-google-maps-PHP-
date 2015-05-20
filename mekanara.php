<?php
include "ayar.php"; ?>
<html>
<head>
<style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
    </style>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script> 
 <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false"></script>
<script type="text/javascript">

function mekan_ara(){
	
	var adi=document.getElementById('adi').value;

document.getElementById('dosya').value="";
	$.ajax({ 
  		type:'POST',
  		url:'islemler.php', 
  	    data: 'islem=mekanara&adi='+adi,
  		success:function(link){
			var res = link.split(",");
			for(var i=0;i<res.length-1;i++){
				 var res2= res[i].split("-");
  			document.getElementById('dosya').value += res2[2]+"\n";
			}

			yukle(link);
			  }
  	});
   
    
	
	
}

function yukle(link){
			 var res = link.split(",");
			
			 var haritaAyarlari = {
				 
               center: new google.maps.LatLng (40.93841495689795,29.278564453125),
               zoom: 5
            };
			document.getElementById("harita").style.display = 'block';
            var harita = new google.maps.Map(document.getElementById("harita"), haritaAyarlari);
            
			
            /**
             * Bulundugumuz Yeri Isaretleyelim
             */
			 
            var marker = new google.maps.Marker({
               position: harita.getCenter(),
               map: harita,
               title: res[2]
            });
			
			
			for(var i=0;i<=res.length;i++){
				
				
				 var res2= res[i].split("-");
				
			var position = new google.maps.LatLng(res2[0], res2[1]);
    var marker = new google.maps.Marker({
      position: position,
      map: harita,
	  title: res2[2]
    });
	
	google.maps.event.addListener(marker, 'click', function() {
    infowindow.open(map,marker);
  });

	
			}
            
            /**
			
             * Harita Ayarlari
             */
			  
		 }
</script>

</head>
<body>

<div style="float:left;"><input type="text" name="adi" id="adi" onBlur="mekan_ara();"/><br>
<textarea disabled="disabled" name="dosya" id="dosya" style="background-color:transparent; border-width:0px;"rows="12" cols="15"></textarea></div>
    <div id="harita" style="float:left;display: none; width: 600px; height: 550px; background: #eee"></div>
  

</body>
</html>
