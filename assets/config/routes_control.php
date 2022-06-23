<?php
    require "dbConnect.php";  
    require "../modules/sessions.php";
    date_default_timezone_set("Africa/Lagos");



    // Checks if the user clicks the register button
    if (!isset($_POST['addRoute'])) {
       redirect("logout");
    }else{
      // Collect All required data

      $from = $_POST['from'];
      $to = $_POST['to'];
      $price = $_POST['price'];
      $noPass = $_POST['noPass'];
      $date = date("Y-m-d h:i:s");


         // 1: Prepare SQL Command
         $sql = "INSERT INTO our_routes(from_value,to_value,price_value,no_passengers,date_created) VALUES(?,?,?,?,?)";

         // 2: Initialize Connection to database
         $stmt = mysqli_stmt_init($dbConnect);

         // 3: Prepare SQL
         mysqli_stmt_prepare($stmt,$sql);

         // 4: Bind Our Values to Placeholders
         mysqli_stmt_bind_param($stmt,"sssss",$from,$to,$price,$noPass,$date);

         $execute = mysqli_stmt_execute($stmt);
         if ($execute) {
           $_SESSION['success_msg']= "Route has been added";
           redirect("../../portal/routes");
         }else{
            $_SESSION['error_msg'] = "Something went wrong";
            redirect("../../portal/routes");
         }
      }