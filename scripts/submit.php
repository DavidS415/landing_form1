<?php

session_start();

// Check if the user is logged in, if they are redirect to admin page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ./admin.php");
    exit;
}

require_once "config.php";

// Translate data from HTML for into PHP variables

if(isset($_POST['submit'])) {
  $company_name=$_POST['company_name'];
  $company_url=$_POST['company_url'];
  $contact_name=$_POST['contact_name'];
  $contact_email=$_POST['contact_email'];
  $contact_number=$_POST['contact_number'];

// Insert data from PHP variables into SQL database with script/query

  $query = "INSERT INTO submission (company_name, company_url, contact_name, contact_email, contact_number)
  VALUES ('$company_name', '$company_url', '$contact_name', '$contact_email', '$contact_number')";

// Return an error message if script/query fail or confirm success and provide links back to other pages

    if (!mysqli_query($mysqli, $query)) {
        die('An error occurred. Your information has not been submitted.');
    } else {
      echo "Thank you for your interest, we will contact you shortly.";
    }

}
?>