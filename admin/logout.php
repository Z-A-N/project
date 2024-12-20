<?php
session_start(); // Start the session

// Destroy the session to log the user out
session_unset(); // Remove all session variables
session_destroy(); // Destroy the session

// Redirect to the login page after logging out
header("Location: index.php");
exit();
?>