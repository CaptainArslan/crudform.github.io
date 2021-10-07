<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$db = "user_detail";

// Create connection
$con =  mysqli_connect($servername, $username, $password,$db );

//Check connection
// if ($con->connect_error) {
//  die("Connection failed: " . $con->connect_error);
// }
// echo "Connected successfully";

?>