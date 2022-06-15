<?php
    $server = "localhost";
    $dbUsername = "root";
    $dbpassword = "";
    $dbname = "airlines_earlycode";

    $dbConnect = mysqli_connect($server,$dbUsername,$dbpassword,$dbname);

    if (!$dbConnect) {
        die("Failed to connect to Database").mysqli_connect_error();
    }