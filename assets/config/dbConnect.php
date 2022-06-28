<?php
    $server = "localhost";
    $dbUsername = "u162278070_airline";
    $dbpassword = "5Ho^RAow4p";
    $dbname = "u162278070_airline";
    // $server = "localhost";
    // $dbUsername = "root";
    // $dbpassword = "";
    // $dbname = "airlines_earlycode";

    $dbConnect = mysqli_connect($server,$dbUsername,$dbpassword,$dbname);

    if (!$dbConnect) {
        die("Failed to connect to Database").mysqli_connect_error();
    }