<?php
// Basic form handling and validation example
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "smart_logistics";
$conn = mysqli_connect($servername, $username, $password, $dbname);
//check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "<br>";

?>
