<?php
// Start the session (assuming you have started the session in other scripts as well)
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page (change 'login.php' to the actual login page filename)
header("Location: login.php");
exit();
