<?php
    require "dbConnect.php";
    require "../modules/sessions.php";
    if (isset($_GET['delUser'])) {
        $del =  $_GET['delUser'];


        $sql = "DELETE FROM users WHERE id = '$del'";
        $sql = "UPDATE users SET trash_stat = 'trash' WHERE id = '$del'";
        $query = mysqli_query($dbConnect,$sql);
        if ($query) {
            $_SESSION['success_msg'] = "Records Deleted Successfully";
            redirect('../../portal/dashboard');
        }else{
            $_SESSION['error_msg'] = "Records failed to delete";
            redirect('../../portal/dashboard');
        }
    }
    elseif(isset($_GET['book'])){
        $bid = $_GET['book'];
        $uid = $_SESSION['id'];

        // 1: Prepare SQL Command
        $sql = "INSERT INTO bookings(route_id,userid) VALUES(?,?)";

        // 2: Initialize Connection to database
        $stmt = mysqli_stmt_init($dbConnect);

        // 3: Prepare SQL
        mysqli_stmt_prepare($stmt,$sql);

        // 4: Bind Our Values to Placeholders
        mysqli_stmt_bind_param($stmt,"ss",$bid,$uid);

        $execute = mysqli_stmt_execute($stmt);
        if ($execute) {
          $_SESSION['success_msg']= "Booking Successfull, pending verification..";
          redirect("../../portal/dashboard");
        }else{
           $_SESSION['error_msg'] = "Something went wrong";
           redirect("../../portal/dashboard");
        }
    }




    // Main ELse
    else{
        redirect('logout');
    }
