<?php
    require "dbConnect.php";
    require "../modules/sessions.php";

    if(!isset($_POST['login'])){
        redirect("../../index");
    }else{
        // Collect The data
        $emailOrUsername = $_POST['emailUsername'];
        $password = $_POST['password'];

        // Run Sql to get the data in the database
        $sql = "SELECT * FROM users WHERE email = ? OR username = ?";
        $stmt = mysqli_stmt_init($dbConnect);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"ss",$emailOrUsername,$emailOrUsername);
        $execute = mysqli_stmt_execute($stmt);

        // Store the data
        $result = mysqli_stmt_get_result($stmt);

        // var_dump($result);
        if ($row = mysqli_fetch_assoc($result)) {
           $returnedPassword = $row['user_password'];
           if (password_verify($password,$returnedPassword)) {
                // Redirect to Dashboard
                $_SESSION['id'] = $row['id'];
                $_SESSION['success_msg'] = "Welcome ".$row['username'];
                redirect("../../portal/dashboard");
           }else{
            $_SESSION['error_msg']= "Incorrect password";
            redirect("../../login");
           }
        }else{
            $_SESSION['error_msg']= "This email or username does not exist";
            redirect("../../login");
        }
        // print_r($row);
        // echo $row['firstname'];
    }