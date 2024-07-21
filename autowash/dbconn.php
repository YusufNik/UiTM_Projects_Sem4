<?php
/* php& mysqldb connection file */
$user = "root"; //mysqlusername
$pass = ""; //mysqlpassword
$host = "localhost"; //127.0.0.1.server name or ipaddress
$dbname= "autowash"; //your db name
$dbconn= mysqli_connect($host, $user, $pass,$dbname) or die(mysqli_error($dbconn));

?>