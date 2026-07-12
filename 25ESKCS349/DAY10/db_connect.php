<?php
/**
 * Database Connection
 * Fleet Management System
 */

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "fleet_management"; // Updated to match the fleet management theme

// Create connection using Object-Oriented MySQLi
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection stability
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// Set character encoding to ensure special characters in vehicle names display correctly
$conn->set_charset("utf8");
?>
