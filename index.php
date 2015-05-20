<?php
include "ayar.php"; ?>
<html>
<head>
<title>Mekanini Kesfet</title>
<style type="text/css">
body{background-color:#CCC;}
.genel{margin:auto; width:800px; }
a{text-decoration:none; color:#fff;}
ul{list-style-type:none; }
ul li {display:inline; background-color:#39F; margin:-1px;color:#fff; border-radius:5px;font-style:italic; font-family:Verdana, Geneva, sans-serif; padding:10px;}
ul li:hover{background-color:#66F; }
</style>
</head>
<body>
<div class="genel">
<ul>
	<li><a href="?islem=mekanlar" title="Mekanlar">Mekanlar</a></li>
    <li><a href="?islem=ekle" title="Ekle">Mekan Ekle</a></li>
    <li><a href="?islem=yakinmekanlar" title="Yakinimdaki Mekanlari Göster">En Yakin Mekan</a></li>
    <li><a href="?islem=mekanara" title="Mekan Ara">Mekan Ara</a></li>
</ul>
 
<hr />




<?php
if($_GET['islem']=="ekle"){
	include "ekle.php";
	
}
else if($_GET['islem']=="mekanlar"){
	include "mekanlar.php";
	
}
else if($_GET['islem']=="yakinmekanlar"){
	include "yakinmekanlar.php";
	
}
else if($_GET['islem']=="mekanara"){
	include "mekanara.php";
	
}
?>
</div>
</body>
</html>
