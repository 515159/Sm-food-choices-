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
    $password = $_POST['password'];

    if (!empty($name) && !empty($password)) {
        // Use prepared statements to prevent SQL injection
        $query = "SELECT * FROM signup WHERE name = ? AND password = ?";
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

        // Check if a row was returned
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) == 1) {
            // Authentication successful, set session variable and redirect
            $_SESSION['name'] = $name;
            header("Location: Home.php");
            exit; // Make sure to exit after redirecting
        } else {
            echo "<script type='text/javascript'> alert('Invalid email or password')</script>";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
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
    <link rel="stylesheet" href="style.css" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    <link
    rel="shortcut icon"
    href="logonew.jpg"
    type="image/x-icon"
  />
 </head>
  <body> 
    
    <div class="box"> 
        <div class="form">
        <form method="POST" action="Signin.php">
        <h2>Sign in </h2>
        <div class="inputbox">
          <input type="text" name = "name" required="required" >
          <span>Username</span>
          <i></i>
        </div>

        <div class="inputbox">
            <input type="password" name = "password" required="required" >
            <span>Password</span>
            <i></i>
          </div>

          <div class="links">
            <a href="signup.php">Signup</a> | <a href="contactus.html">Contact Us</a>
          </div>
          <input type="submit" value="LOGIN" style="color: rgb(42, 40, 40);">
        </form>
    </div>
  </div>
  </body>
</html>
