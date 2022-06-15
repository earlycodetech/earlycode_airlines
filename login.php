<?php 
    require 'assets/modules/sessions.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airline Booking Form</title>
    <link rel="stylesheet" href="assets/css/airline.css">
    <link rel="stylesheet" href="assets/css/booking-form.css">
    <link rel="stylesheet" href="assets/css/bootstrap5.min.css">
    <link rel="stylesheet" href="assets/fontawsome/css/all.css">
    <style>
        .alertMsg{
            top: 10%;
            right: 10px;
            z-index: 999999999999999;
            color: white;
        }
    </style>
</head>

<body>
    <?php echo errorMsg(); echo successMsg(); ?>
    <?php require_once "assets/modules/nav.php"; ?>

    <div class="container">
        <form class="form-group" action="assets/config/reg_control" method="POST">
         
            <div id="form" class="mt-5">
                <h2 class="text-center text-white">Login to your account</h2>
                <div class="row mt-5">
                    <div class="col-md-6 text-white mb-3">
                        <label>Email/Username: </label>
                        <input type="text" name="email" class="form-control bg-transparent border-0 border-bottom border-white text-white rounded-0">
                    </div>
                    <div class="col-md-6 text-white mb-3">
                        <label>Password:</label>
                        <input type="password" name="password" class="form-control bg-transparent border-0 border-bottom border-white text-white rounded-0">
                    </div>

                    <div class="mt-5 text-center">
                        <button type="submit" name="login" class="btn btn-outline-light btn-lg">Login</button>
                    </div>
                </div>
            </div>



        </form>
    </div>

</body>
<script src="assets/js/bootstrap.bundle.min.js"></script>

</html>