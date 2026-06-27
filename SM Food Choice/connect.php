<?php

mysqli_report(MYSQLI_REPORT_OFF);

$dbHostCandidates = [
    ["127.0.0.1", 3307],
    ["127.0.0.1", 3306],
];
$username = "root";
$password = "";
$db = "register";
$conn = false;
$db_error = "";

foreach ($dbHostCandidates as [$servername, $port]) {
    $candidate = mysqli_init();
    mysqli_options($candidate, MYSQLI_OPT_CONNECT_TIMEOUT, 1);

    if (@mysqli_real_connect($candidate, $servername, $username, $password, $db, $port)) {
        $conn = $candidate;
        break;
    }

    $db_error = mysqli_connect_error();
    mysqli_close($candidate);
}

if (!$conn) {
    $conn = false;
}
?>
