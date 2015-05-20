 <?php
 
 $dbconn = pg_connect("dbname=mekanbul");


$dbconn2 = pg_connect("host=localhost port=5432 dbname=mekanbul");


$dbconn3 = pg_connect("host=localhost port=5432 dbname=mekanbul user=postgres password=asdasd");


$conn_string = "host=localhost port=5432 dbname=mekanbul user=postgres password=asdasd";
$dbconn4 = pg_connect($conn_string);


$dbconn5 = pg_connect("host=localhost options='--client_encoding=UTF8'");


?>
