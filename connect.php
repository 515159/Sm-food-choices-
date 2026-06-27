<?php
mysqli_report(MYSQLI_REPORT_OFF);

$dbHostCandidates = ["localhost:3307", "127.0.0.1:3307", "localhost", "127.0.0.1"];
$dbUser = "root";
$dbPassword = "";
$dbName = "register";
$conn = false;

foreach ($dbHostCandidates as $candidate) {
    $conn = @mysqli_connect($candidate, $dbUser, $dbPassword, $dbName);
    if ($conn) {
        break;
    }
}

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
