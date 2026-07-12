<?php 
//logout.php
session_start();

//step 1: clear all session data
$_SESSION = array();

//step 2: destroy the session
session_destroy();

//step 3: send user back to login
header("Location: login.php");
exit();
?>
