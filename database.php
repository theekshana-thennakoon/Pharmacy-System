<?php
$servername = "localhost:3306";
$username = "flockups_pharmacy";
$password = "pharmacy@123";
$dbname = "flockups_pharmacy";

$conn = new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){
	die("Connection Failed" . $conn->connect_error);
}

?>