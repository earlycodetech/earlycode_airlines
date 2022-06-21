<?php
    require "dbConnect.php";  
    require "../modules/sessions.php";
    date_default_timezone_set("Africa/Lagos");



    // Checks if the user clicks the register button
    if (!isset($_POST['register'])) {
       redirect("../../booking-form");
    }else{
      // Collect All required data

      $firstName = $_POST['fname'];
      $lastName = $_POST['lname'];
      $userName = $_POST['uname'];
      $phone = $_POST['phone'];
      $email = $_POST['email'];
      $dob = $_POST['dob'];
      $password = $_POST['password'];
      $cpassword = $_POST['cpass'];
      $role = 'user';
      $date = date("Y-m-d h:i:s");

      // Build Constraints
      if (strlen($password) < 8) {
         $_SESSION['error_msg'] = "Pasword must be greater than 8 characters";
         redirect("../../booking-form");
      }elseif ($password !== $cpassword) {
         $_SESSION['error_msg'] = "Password do not match";
         redirect("../../booking-form");
      }else{
         // Hash users password
         $password = password_hash($password, PASSWORD_DEFAULT);

         // Steps to insert

         // 1: Prepare SQL Command
         $sql = "INSERT INTO users(firstname,lastname,username,phone,email,dob,user_password,user_role,date_created) VALUES(?,?,?,?,?,?,?,?,?)";

         // 2: Initialize Connection to database
         $stmt = mysqli_stmt_init($dbConnect);

         // 3: Prepare SQL
         mysqli_stmt_prepare($stmt,$sql);

         // 4: Bind Our Values to Placeholders
         mysqli_stmt_bind_param($stmt,"sssssssss",$firstName,$lastName,$userName,$phone,$email,$dob,$password,$role,$date);

         $execute = mysqli_stmt_execute($stmt);
         if ($execute) {
           $_SESSION['success_msg']= "Account created successfully, please login..";
           redirect("../../login");
         }else{
            $_SESSION['error_msg'] = "Something went wrong";
            redirect("../../booking-form");
         }
      }

    }