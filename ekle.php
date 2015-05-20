<?php
include "ayar.php"; ?>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>En Yakınınızdaki Mekanları Keşfedin</title>
<link href="http://code.google.com/apis/maps/documentation/javascript/examples/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script> 
<script type="text/javascript">

function mekan_ekle(){
	var adi=document.getElementById('adi').value
var x=document.getElementById('x').value;
var y=document.getElementById('y').value;
var kategori=document.getElementById('kategori').value;
	$.ajax({ 
  		type:'POST',
  		url:'islemler.php', 
  	    data: 'islem=mekanekle&adi='+adi+'&x='+x+'&y='+y+'&kategori='+kategori,
  		success:function(link){
  			alert("Başarıyla Eklendi");
  }
  	});
   
    
	
	
}


</script>       
</head>
<body>
<form name="harita_formu" method="post">
            <input type="hidden" name="tur" value="harita">
            <table id="box-table-a">
                <tbody>
                    <tr>
                       
                        <td>
                            <script type="text/javascript"
                                   src="http://maps.google.com/maps/api/js?sensor=false">
                            </script>
                            <script type="text/javascript">
                                function initialize() {
                                    var Koordinatlar = new google.maps.LatLng(40.0843759245152,26.83813489062504);
                                    var myOptions = {
                                        zoom: 6,
                                        center: Koordinatlar,
                                        mapTypeId: google.maps.MapTypeId.HYBRID
                                    };
                                    var map = new google.maps.Map(document.getElementById("map_canvas"),
                                    myOptions);
                                    var BilgiPenceresi = new google.maps.InfoWindow(
                                    { content: 'Bilgisayar Mühendisliği',
                                        size: new google.maps.Size(50,50),
                                        position: Koordinatlar
                                    });
                                    BilgiPenceresi.open(map);
                                    var Isagretci = new google.maps.Marker({
                                        map:map,
                                        draggable:true,
                                        animation: google.maps.Animation.DROP,
                                        position: Koordinatlar,
                                        icon: 'http://google-maps-icons.googlecode.com/files/factory.png'
                                    });
                                    google.maps.event.addListener(Isagretci, 'dragend', function(){
                                        Isagretci.setAnimation(google.maps.Animation.BOUNCE);
                                    });
                                    google.maps.event.addListener(map, 'click', function(event){
                                        //map.setCenter(event.latLng);
                                        BilgiPenceresi.setPosition(event.latLng);
                                        Isagretci.setPosition(event.latLng);
                                        document.forms['harita_formu'].elements['harita_zoom'].value=map.getZoom();
document.forms['harita_formu'].elements['harita_x'].value=event.latLng.lat();

 document.forms['harita_formu'].elements['harita_zoom'].value=map.getZoom();
document.forms['harita_formu'].elements['harita_y'].value=event.latLng.lng();
                                    });
                                    google.maps.event.addListener(map, 'zoom_changed', function(event) {
                                        document.forms['harita_formu'].elements['harita_zoom'].value=map.getZoom();
//document.forms['harita_formu'].elements['harita_geo'].value=event.latLng.lat()+","+event.latLng.lng();
                                    });
                                }
                            </script>
                            <div id="map_canvas" style="width:120%; height: 500px; border:10px solid #e3e3ca"><script type="text/javascript">initialize()</script></div>
                            <input type="text" name="harita_x" id="x" value="39.86156903970107" />
                            <input type="text" name="harita_y" id="y" value="39.86156903970107" />
                            <select name="kategori" id="kategori">
                            <?php
							$k=pg_query("select * from kategori");
							while($kk=pg_fetch_array($k)){
								echo "<option value='".$kk['id']."'>".$kk['kategori_adi']."</option>";
								
							}
							
							?>
                            
                            </select>
                            <input type="text" name="harita_zoom" id="harita_zoom">
                            <input type="text" name="adi" id="adi" placeholder="Mekan Adı">
                            <input type="button" onClick="mekan_ekle();" value="Mekan Ekle">
                            
                        </td>
                    </tr>
                    
                    
                </tbody>
            </table>
        </form>
</body>
</html>

