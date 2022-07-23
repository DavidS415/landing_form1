<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if they are redirect to admin page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ./admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en-US">
  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="styles/styles.css" rel="stylesheet">
    <meta charset="utf-8">
    <title>Welcome to USWorkVisa.us</title>
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
          -webkit-appearance: none;
          margin: 0;
        }
        
        /* Firefox */
        input[type=number] {
          -moz-appearance: textfield;
        }
        
    </style>
  </head>
  <body>
    <div id="logout">
      <a href="scripts/logout.php">Sign Out</a>
    </div>
    <div id="admin">
      <a href="admin.php">Admin Page</a>
    </div>
    <header>
        <h1>Welcome to the USWorkVisa.us Landing Page</h1>
    </header>
  <main>
    <p id='main1'>This page will be up and running shortly but if you would like to inquire about supporting future projects please submit your info below</p>  
    <form action="scripts/submit.php" method="post">
        <div class="input-item">
            <label class="input-label" for="company-name">Company Name:</label>
            <input class="form-input" type="text" id="company-name" name="company_name">
        </div>
        <div class="input-item">
            <label class="input-label" for="company-url">Company Website:</label>
            <input class="form-input" type="url" id="company-url" name="company_url">
        </div>
        <div class="input-item">
            <label class="input-label" for="contact-name">Contact:</label>
            <input class="form-input" type="text" id="contact-name" name="contact_name">
        </div>
        <div class="input-item">
            <label class="input-label" for="contact-email">Contact Email:</label>
            <input class="form-input" type="email" id="contact-email" name="contact_email">
        </div>
        <div class="input-item">
            <label class="input-label" for="contact-number">Contact US Phone Number:</label>
            <input class="form-input" type="text" id="contact-number" name="contact_number">
        </div>
        <div class="input-item">
            <label class="input-label"></label>
            <input type="submit" value="Submit" name="submit" class="btn btn-primary">
        </div>
    </form>
  </main>  
  </body>
</html>