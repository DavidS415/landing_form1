<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="styles/styles.css" rel="stylesheet">
    <meta charset="utf-8">
    <title>Welcome to the Onboarding Application</title>
    <style>
      h2 {
        text-align: center;
      }
    </style>
  </head>
  <body onload="sortTable()">
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
      <h2>Current companies interested</h2>
    <?php

    // MairaDB connection block/information

    require_once "scripts/config.php";

    ?>
    <table border="1" align="center" id="ResultsTable">
    <tr>
      <td>Company Name:</td>
      <td>Company Website:</td>
      <td>Contact Name:</td>
      <td>Contact Email:</td>
      <td>Contact Phone Number:</td>
    </tr>
    <?php

// Query database for the table with data

$query = mysqli_query($mysqli, "SELECT * FROM submission")
   or die (mysqli_error($mysqli));

// Loop through the results and display each candidate in a table row

while ($row = mysqli_fetch_array($query)) {
  echo
   "<tr>
    <td>{$row['company_name']}</td>
    <td>{$row['company_url']}</td>
    <td>{$row['contact_name']}</td>
    <td>{$row['contact_email']}</td>
    <td>{$row['contact_number']}</td>
   </tr>\n";

}

?>
    </main>
  </body>
</html>