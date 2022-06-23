<?php
    session_start();

    function errorMsg(){
        if (isset($_SESSION['error_msg'])) {
            $message = "  <div class=\"alert bg-danger alertMsg rounded-0 position-fixed alert-dismissible fade show\" role=\"alert\">
            <strong>";
    
            $message .= htmlentities($_SESSION['error_msg']);
            $message .= " </strong>
            <button type=\"button\" class=\"btn fas fa-times text-white p-2\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
            </div>    <style>
            .alertMsg{
                top: 10%;
                right: 10px;
                z-index: 999999999999999;
                color: white;
            }
        </style>";
    
            $_SESSION['error_msg'] = null;
            return $message;
        }
    }

    
    function successMsg(){
        if (isset($_SESSION['success_msg'])) {
            $message = "  <div class=\"alert bg-success alertMsg rounded-0 position-fixed alert-dismissible fade show\" role=\"alert\">
            <strong>";
    
            $message .= htmlentities($_SESSION['success_msg']);
            $message .= " </strong>
            <button type=\"button\" class=\"btn fas fa-times text-white p-2\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
            </div>
            <style>
            .alertMsg{
                top: 10%;
                right: 10px;
                z-index: 999999999999999;
                color: white;
            }
        </style>";
    
            $_SESSION['success_msg'] = null;
            return $message;
        }
    }

    function redirect($loc){
        header("Location: ".$loc);
    }

    function auth(){
        if (!isset($_SESSION['id'])) {
            redirect("../index");
        }
    }
    
    function adminAuth(){
        if ($_SESSION['role'] !== 'admin') {
            redirect("dashboard");
        }
    }


    function activity(){
        if((time() - $_SESSION['last_login_timestamp']) > 900) // 900 = 15 * 60  
           {  
                header("Location:../assets/config/logout.php");  
           }else{
              $_SESSION['last_login_timestamp'] = time();
           }    
    }