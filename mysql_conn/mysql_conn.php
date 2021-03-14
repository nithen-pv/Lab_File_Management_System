<?php 
$servername = "localhost";
$user_name = "root";
$pass_word = "";
$dbname = "project";

// Create connection
$conn = new mysqli($servername, $user_name, $pass_word,$dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";

?>