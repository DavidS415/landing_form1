<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if they are redirect to admin page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ./admin.php");
    exit;
}

// Include config file
require_once "scripts/config.php";

// Define variables and initialize with empty values

$company_name = $company_url = $contact_name = $contact_email = $contact_number = "";
$company_name_err = $company_url_err = $contact_name_err = $contact_email_err = $contact_number_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

  //Validate company name
  if(empty(trim($_POST["company_name"]))){
    $company_name_err = "Please enter your company's name";
  } else {
    // Prepare a select statement
    $sql = "SELECT id FROM submission WHERE company_name = ?";

    if($stmt = $mysqli->prepare($sql)){
      // Bind variables to the prepared statement as parameters
      $stmt->bind_param("s", $param_company_name);

      // Set parameters
      $param_company_name = trim($_POST["company_name"]);

      // Attempt to execute the prepared statement
      if($stmt->execute()){
        // store result
        $stmt->store_result();

        if($stmt->num_rows == 1){
          $company_name_err = "Your company has already been submitted";
        } else {
          $company_name = trim($_POST["company_name"]);
        }
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }

      // Close statement
      $stmt->close();

    }
  }

  //Validate Website
  if(empty(trim($_POST["company_url"]))){
    $company_url_err = "Please enter your company's website";
  } else {
    // Prepare a select statement
    $sql = "SELECT id FROM submission WHERE company_url = ?";

    if($stmt = $mysqli->prepare($sql)){
      // Bind variables to the prepared statement as parameters
      $stmt->bind_param("s", $param_company_url);

      // Set parameters
      $param_company_url = trim($_POST["company_url"]);

      // Attempt to execute the prepared statement
      if($stmt->execute()){
        // store result
        $stmt->store_result();

        if($stmt->num_rows == 1){
          $company_url_err = "Your website has already been submitted";
        } else{
          $company_url = trim($_POST["company_url"]);
        }
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }

      // Close statement
      $stmt->close();
    }
  }

  //Validate Contact Name
  if(empty(trim($_POST["contact_name"]))){
    $contact_name_err = "Please enter a contact name";
  } else {
    $contact_name = trim($_POST["contact_name"]);
  }

  //Validate Contact Email
  if(empty(trim($_POST["contact_email"]))){
    $contact_email_err = "Please enter a contact email";
  } else {
    $contact_email = trim($_POST["contact_email"]);
  }

  //Validate Contact Phone Number
  if(empty(trim($_POST["contact_number"]))){
    $contact_number_err = "Please enter a contact phone number";
  } else {
    $contact_number = trim($_POST["contact_number"]);
  }

  // Check input errors before inserting in database
  if(empty($company_name_err) && empty($company_url_err) && empty($contact_name_err) && empty($contact_email_err) && empty($contact_number_err)){

    // Prepare an insert statement
    $sql = "INSERT INTO submission (company_name, company_url, contact_name, contact_email, contact_number) VALUES (?, ?, ?, ?, ?)";

    if($stmt = $mysqli->prepare($sql)){
      // Bind variables to the prepared statement as parameters
      $stmt->bind_param("sssss", $param_company_name, $param_company_url, $param_contact_name, $param_contact_email, $param_contact_number);

      // Set parameters
      $param_company_name = $company_name;
      $param_company_url = $company_url;
      $param_contact_name = $contact_name;
      $param_contact_email = $contact_email;
      $param_contact_number = $contact_number;

      // Attempt to execute the prepared statement
      if($stmt->execute()){
        //Refresh Page
        echo "<script>
                alert('Your inquiry has been submitted and is being reviewed, we will contact you shortly');
                window.location = 'index.php';
              </script>";
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }

      // Close statement
      $stmt->close();
    }
  }

  // Close connection
  $mysqli->close();
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
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="input-item">
            <label>Company Name:</label>
            <input class="form-input <?php echo (!empty($company_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $company_name; ?>" type="text" id="company-name" name="company_name">
            <span class="invalid-feedback"><?php echo $company_name_err; ?></span>
        </div>
        <div class="input-item">
            <label>Company Website:</label>
            <input class="form-input <?php echo (!empty($company_url_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $company_url; ?>" type="url" id="company-url" name="company_url">
            <span class="invalid-feedback"><?php echo $company_url_err; ?></span>
        </div>
        <div class="input-item">
            <label>Contact:</label>
            <input class="form-input <?php echo (!empty($contact_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $contact_name; ?>" type="text" id="contact-name" name="contact_name">
            <span class="invalid-feedback"><?php echo $contact_name_err; ?></span>
        </div>
        <div class="input-item">
            <label>Contact Email:</label>
            <input class="form-input <?php echo (!empty($contact_email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $contact_email; ?>"  type="email" id="contact-email" name="contact_email">
            <span class="invalid-feedback"><?php echo $contact_email_err; ?></span>
        </div>
        <div class="input-item">
            <label>Contact US Phone Number:</label>
            <input class="form-input <?php echo (!empty($contact_number_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $contact_number; ?>"  type="text" id="contact-number" name="contact_number">
            <span class="invalid-feedback"><?php echo $contact_number_err; ?></span>
        </div>
        <div class="input-item">
            <label class="input-label"></label>
            <input type="submit" value="Submit" name="submit" class="btn btn-primary">
        </div>
    </form>
  </main>  
  </body>
</html>