<?php
    require "dbConnect.php";
    require "../modules/sessions.php";
    $currentUser = $_SESSION['id'];


    if (!isset($_POST['resetPassword'])) {
       redirect("logout");
    }else{
        $old = $_POST['old'];
        $new = $_POST['new'];
        $confirm = $_POST['con'];

        $sql = "SELECT user_password FROM users WHERE id = '$currentUser'";
        $query = mysqli_query($dbConnect,$sql);
        $row = mysqli_fetch_assoc($query);

       if (!password_verify($old,$row['user_password'])) {
         $_SESSION['error_msg'] = "Incorrect old password";
         redirect('../../portal/password');
       }
       elseif($new !== $confirm){
        $_SESSION['error_msg'] = "Passwords do not match";
        redirect('../../portal/password');
       }else{
        $new = password_hash($new, PASSWORD_DEFAULT);  
        $sql = "UPDATE users SET user_password = '$new'  WHERE id = '$currentUser'";
            $query = mysqli_query($dbConnect,$sql);
            if ($query) {
               $_SESSION['success_msg'] = "Password reset was successful";
               redirect('../../portal/password');
            }else{
                $_SESSION['error_msg'] = "Password reset failed";
                redirect('../../portal/password');
            }
       }
    }