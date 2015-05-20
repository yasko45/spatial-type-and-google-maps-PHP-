<!DOCTYPE HTML>
<html lang="en-US">
<head>

   <meta charset="UTF-8">
   <title>Mekanını Keşfet</title>
   
   <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false"></script>
   <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script> 
   <script type="text/javascript">
   
   function getMapCoords(){
       var lnk=null;
      if ( navigator.geolocation ){
         
         navigator.geolocation.getCurrentPosition(function(pos){
            
            var enlem = pos.coords.latitude,
               boylam = pos.coords.longitude;
			  
			$.ajax({ 
  		type:'POST',
  		url:'islemler.php', 
  	    data: 'islem=yakinmekan&enlem='+enlem+'&boylam='+boylam,
  		success:function(link){
  			yukle(link);
			 
  }
  	});
   
         function yukle(link){
			 var res = link.split(",");
			
			 var haritaAyarlari = {
				 
               center: new google.maps.LatLng (res[0],res[1]),
               zoom: 7
            };
			document.getElementById("harita").style.display = 'block';
            var harita = new google.maps.Map(document.getElementById("harita"), haritaAyarlari);
            
			
            /**
             * Bulunduğumuz Yeri İşaretleyelim
             */
			 
            var marker = new google.maps.Marker({
               position: harita.getCenter(),
               map: harita,
               title: res[2]
            });
			
			var position0 = new google.maps.LatLng(enlem, boylam);
    var marker = new google.maps.Marker({
      position: position0,
      map: harita,
	  title: "Benim Konumum"
    });
	
	var flightPlanCoordinates = [
    new google.maps.LatLng(enlem, boylam),
    new google.maps.LatLng(res[0], res[1]),
   
  ];
  var flightPath = new google.maps.Polyline({
    path: flightPlanCoordinates,
    geodesic: true,
    strokeColor: '#FF0000',
    strokeOpacity: 1.0,
    strokeWeight: 2
  });

  flightPath.setMap(harita);

            
            /**
			
             * Harita Ayarları
             */
			  
		 }
           
		   
		     
            
         });

      } else {
         alert('Tarayıcınız bu özelliği desteklemiyor.');
      }
      
   }
   </script>
   
</head>
<body>

<div id="harita" style="display: none; width: 800px; height: 550px; background: #eee"></div>
<button onClick="getMapCoords()" style="background-color:#36F; border-width:0px; padding:10px; color:#fff;">Haritada Yerimi Bularak Bana En Yakın Mekanı Göster</button>

</body>
</html>
