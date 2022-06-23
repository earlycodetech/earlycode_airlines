<?php
    require "dbConnect.php";
    require "../modules/sessions.php";
    $currUser = $_SESSION['id'];

    if(!isset($_POST['uploadFile'])){
        redirect('logout');
    }else{
        $file = $_FILES['file'];

        print_r($file);
        // Retrieve the values from file
        $fileName = $file['name'];
        $fileTempName = $file['tmp_name'];
        $fileError = $file['error'];
        $fileSize = $file['size'];


        // Get The file type
        $fileType = explode('.',$fileName);
        // print_r($fileType);
        $fileType = end($fileType);

        // convert the filetype to lowercase
        $fileType = strtolower($fileType);
        $location = "../img/uploads/";
        // Allowed file types
        $allowedTypes = array('jpg', 'jpeg', 'png', 'gif'); 
        if (in_array($fileType, $allowedTypes)) {
            if ($fileError < 1) {
                if ($fileSize < 5000000) {
                //    echo $fileNewName = "EA".rand(100000,999999).".".$fileType;
                    $fileNewName = "profile_user_image".$_SESSION['id'].".".$fileType;
                    if (file_exists($location.$fileNewName)) {
                       unlink($location.$fileNewName);
                       $move = move_uploaded_file($fileTempName,$location.$fileNewName);
                       $sql = "UPDATE users SET profileimg = '$fileNewName' WHERE id = '$currUser'";
                       $query = mysqli_query($dbConnect,$sql);
                       if ($query) {
                           $_SESSION['success_msg'] = "Upload was successful";
                           redirect('../../portal/profile'); 
                       }else{
                           $_SESSION['error_msg'] = "Something went wrong";
                           redirect('../../portal/profile');  
                       }
                    }else{
                        $move = move_uploaded_file($fileTempName,$location.$fileNewName);
                        $sql = "UPDATE users SET profileimg = '$fileNewName' WHERE id = '$currUser'";
                        $query = mysqli_query($dbConnect,$sql);
                        if ($query) {
                            $_SESSION['success_msg'] = "Upload was successful";
                            redirect('../../portal/profile'); 
                        }else{
                            $_SESSION['error_msg'] = "Something went wrong";
                            redirect('../../portal/profile');  
                        }

                    }
                }else{
                    $_SESSION['error_msg'] = "File too large, max: 5mb";
                    redirect('../../portal/profile'); 
                }
            }else{
                $_SESSION['error_msg'] = "Please try again, corrupt file";
                redirect('../../portal/profile');
            }
        }else{
            $_SESSION['error_msg'] = "Please upload either a jpg,png,jpeg or gif file";
            redirect('../../portal/profile');
        }
        
    }