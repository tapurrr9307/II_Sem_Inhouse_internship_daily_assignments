<?php
// logout.php
// Fleet Management Control Center Terminal Termination

session_start();

// Wipe all current operator session data completely
$_SESSION = [];

// Destroy the underlying server session registration
session_destroy();

// Safely redirect back to the operator terminal login window
header("Location: login.php");
exit();
?>
