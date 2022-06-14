<?php
    require "../modules/sessions.php";


    // Checks if the user clicks the register button
    if (!isset($_POST['register'])) {
       redirect("../../booking-form");
    }