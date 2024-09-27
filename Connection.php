<?php
$servername = "mysql43.unoeuro.com";
$username = "ddumarcus_dk";
$password = "wB9mRzn64GA2yhHrp5Df";
$dbname = "ddumarcus_dk_db";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>
