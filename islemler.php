<?php
include "ayar.php";
$islem=addslashes($_POST['islem']);
if($islem=="mekanekle"){
	
	$x=addslashes($_POST['x']);
	$y=addslashes($_POST['y']);
	$adi=addslashes($_POST['adi']);
	$kategori=addslashes($_POST['kategori']);
	pg_query("INSERT INTO mekanlar(mekan_adi,yer,kid)
VALUES('".$adi."', ST_GeomFromText('POINT(".$x." ".$y.")', 4326),'".$kategori."' );");
}
else if($islem=="mekanara"){
	
	$adi=addslashes($_POST['adi']);
	
	$a=pg_query("select ST_X(ST_AsText(yer)) as a,ST_Y(ST_AsText(yer)) as k,mekan_adi from mekanlar where mekan_adi LIKE '%$adi%'");
	while($aa=pg_fetch_array($a)){
		echo $aa['a']."-".$aa['k']."-".$aa['mekan_adi'].",";
		
	}
}
else if($islem=="yakinmekan"){
	
	$enlem=addslashes($_POST['enlem']);
	$boylam=addslashes($_POST['boylam']);
	
	
					$min=1000000000000000000000000000;
					$e_en=0;
	$e_boy=0;
	$adi;
$don=pg_query("select ST_X(ST_AsText(yer)) as a,ST_Y(ST_AsText(yer)) as k,mekan_adi from mekanlar");
while($don2=pg_fetch_array($don)){ 
	$a=$don2['a'];
	$k=$don2['k'];
	$y=pg_fetch_array(pg_query("select ST_Distance(ST_GeomFromText('POINT($enlem $boylam)',4326),
   ST_GeomFromText('POINT($a $k)',4326)) as bilgi,mekan_adi from mekanlar"));
	
	if($y['bilgi']<$min) { $min=$y['bilgi']; $e_boy=$a; $e_en=$k; $adi=$don2['mekan_adi'];}
	
	}
	echo $e_boy.",";
	echo $e_en.",";
	echo $adi;
	
	
	

	
}

?>
