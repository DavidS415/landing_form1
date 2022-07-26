<?php

// Initialize the session
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../index.php");
    exit;
} else {
    
    // Unset all of the session variables
    $_SESSION = array();
    
    // Destroy the session.
    session_destroy();
    
    // Redirect to login page
    header("location: ../login.php");
    exit;

}

?>