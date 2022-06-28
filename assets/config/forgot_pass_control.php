<?php 
 require "dbConnect.php";
 require "../modules/sessions.php";

 if (isset($_POST['sendToken'])) {
    $email = $_POST['email'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_stmt_init($dbConnect);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"s",$email);
    $execute = mysqli_stmt_execute($stmt);

    // Check if users exist
    $result = mysqli_stmt_get_result($stmt);
    $rowNum = mysqli_num_rows($result);
    if ($rowNum < 1) {
        $_SESSION['error_msg'] = 'This user does not exist';
        redirect('../../forgot-pass');
    }else{
        //Create a new token
      $token = rand(100000,999999);

        // Save the token
        $sql = "UPDATE users SET password_reset = '$token' WHERE email = '$email'";
        $query = mysqli_query($dbConnect,$sql);
        if ($query) {
            $to = $email;
            $subject = "Password Reset";
            $message = "Please use the OTP to reset your password: ".$token;
            $message = wordwrap($message,100,"\r\n");
            $headers = "From: Earlycode Airline <earlycode_airline@ea.com>";
            $mail =  mail($to,$subject,$message,$headers);
            if($mail){
                $_SESSION['success_msg'] = 'Please enter the 6 digit OTP sent to your mail';
                redirect('../../reset-pass');
            }else{
                $_SESSION['error_msg'] = 'Something went wrong';
                //redirect('../../forgot-pass');
            }
        }else{
            $_SESSION['error_msg'] = 'Something went wrong';
            redirect('../../forgot-pass');
        }
    }
 }
 elseif(isset($_POST['resetPass'])){
    $token = $_POST['token'];
    $new = $_POST['newp'];
    $con = $_POST['conp'];

    $sql = "SELECT * FROM users WHERE password_reset = ?";
    $stmt = mysqli_stmt_init($dbConnect);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"s",$token);
    $execute = mysqli_stmt_execute($stmt);

    // Check if users exist
    $result = mysqli_stmt_get_result($stmt);
    $rowNum = mysqli_num_rows($result);
    if ($rowNum < 1) {
        $_SESSION['error_msg'] = 'Invalid Token';
        redirect('../../reset-pass');
    }else{
        if (strlen($new) < 6) {
            $_SESSION['error_msg'] = 'Password not strong';
            redirect('../../reset-pass');
        }
        elseif($new != $con){
            $_SESSION['error_msg'] = 'Password do not match';
            redirect('../../reset-pass');
        }else{
            $password = password_hash($new, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET user_password = '$password', password_reset = 'SET' WHERE password_reset = '$token'";
            $query = mysqli_query($dbConnect,$sql);
            if ($query) {
                $_SESSION['error_msg'] = 'Password reset successfully';
                redirect('../../login');
            }else{
                $_SESSION['error_msg'] = 'Something went wrong';
                redirect('../../reset-pass');
            }
        }
    }

 }