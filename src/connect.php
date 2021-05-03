<?php

include_once("config.php");
#$db=$_ENV['DBH'];
$host=$host;

#$conn = new pg_connect("jdbc:postgresql://server25:5444/postgres");
#$conn = new pg_connect("host=$host port=$port dbname=postgres");
echo ("[".$host."|".$user."|".$pass."|".$db);
$conn = new mysqli($host, $user, $pass, $db) or die("Connect failed: \n". mysqli_error($conn));

