<?php
    require "dbConnect.php";
    require "../modules/sessions.php";
    $currentUser = $_SESSION['id'];
    if (!isset($_POST['userUpdate'])) {
       redirect("logout");
    }else{
        $firstName = $_POST['fname'];
        $lastName = $_POST['lname'];
        $phone = $_POST['phone'];
        $dob = $_POST['dob'];

        //The empty function checks if the input field has been filled
        if (!empty($firstName)) {
            $sql = "UPDATE users SET firstname = '$firstName'  WHERE id = '$currentUser'";
            $query = mysqli_query($dbConnect,$sql);
            if ($query) {
               $_SESSION['success_msg'] = "Update Successfull";
               redirect('../../portal/profile');
            }else{
                $_SESSION['error_msg'] = "Update Failed";
                redirect('../../portal/profile');
            }
        }else{
            redirect('../../portal/profile');
        }

        if (!empty($lastName)) {
            $sql = "UPDATE users SET lastname = '$lastName'  WHERE id = '$currentUser'";
            $query = mysqli_query($dbConnect,$sql);
            if ($query) {
               $_SESSION['success_msg'] = "Update Successfull";
               redirect('../../portal/profile');
            }else{
                $_SESSION['error_msg'] = "Update Failed";
                redirect('../../portal/profile');
            }
        }else{
            redirect('../../portal/profile');
        }
      
        if (!empty($phone)) {
            $sql = "UPDATE users SET phone = '$phone'  WHERE id = '$currentUser'";
            $query = mysqli_query($dbConnect,$sql);
            if ($query) {
               $_SESSION['success_msg'] = "Update Successfull";
               redirect('../../portal/profile');
            }else{
                $_SESSION['error_msg'] = "Update Failed";
                redirect('../../portal/profile');
            }
        }else{
            redirect('../../portal/profile');
        }

        if (!empty($dob)) {
            $sql = "UPDATE users SET dob = '$dob'  WHERE id = '$currentUser'";
            $query = mysqli_query($dbConnect,$sql);
            if ($query) {
               $_SESSION['success_msg'] = "Update Successfull";
               redirect('../../portal/profile');
            }else{
                $_SESSION['error_msg'] = "Update Failed";
                redirect('../../portal/profile');
            }
        }else{
            redirect('../../portal/profile');
        }
    }