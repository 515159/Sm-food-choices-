<?php
// Start the session at the beginning of the script
session_start();

// Include the file containing database connection
include("connect.php");

// Check if the database connection is established successfully
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $password= $_POST['password'];
    
    
    if (!empty($name) && !empty($password) && !is_numeric($name)) {
        // Use prepared statements to prevent SQL injection
        $query = "INSERT INTO signup (name, password) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        
        // Check if the prepared statement was created successfully
        if (!$stmt) {
            die("Error in prepared statement: " . mysqli_error($conn));
        }
        
        // Bind parameters to the prepared statement
        $success = mysqli_stmt_bind_param($stmt, "ss", $name, $password);
        
        // Check if binding parameters was successful
        if (!$success) {
            die("Error in binding parameters: " . mysqli_stmt_error($stmt));
        }

        // Execute the prepared statement
        $success = mysqli_stmt_execute($stmt);
        
        // Check if execution was successful
        if (!$success) {
            die("Error in execution: " . mysqli_stmt_error($stmt));
        }

        // Redirect to index.html after successful data insertion
        header("Location: Signin.php");
        exit; // Make sure to exit after redirecting
    } else {
        echo "<script type='text/javascript'> alert('Please enter valid information')</script>";
    }
}
?>
<!DOCTYPE html>
<!-- CodingMaker-->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SM Food Choice</title>
    <!--CSS Style-->
    <link rel="stylesheet" href="style.1.css" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
 </head>
  <body> 
    
    <div class="box"> 
        <div class="form">
        <form method="POST" action="signup.php">
        <h2>Sign up </h2>
        <div class="inputbox">
          <input type="text" name="name" required="required" >
          <span>Username</span>
          <i></i>
        </div>

        <div class="inputbox">
            <input type="password" name="password" required="required" >
            <span>Password</span>
            <i></i>
          </div>

          <div class="links">
            <a href="Signin.php">Signin</a> | <a href="contactus.html">Contact Us</a>
          </div>
          <input type="submit" value="Signup">
        </form>
    </div>
  </div>
  </body>
</html>
