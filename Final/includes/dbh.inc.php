<?php
$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dbName = "exam";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dbName);


//not mandatory
if(!$conn){
  die("Connection Failed.".mysqli_connect_error());
}
