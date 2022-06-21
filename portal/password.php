<?php
require "../assets/config/dbConnect.php";
require "../assets/modules/sessions.php";
$currentUser = $_SESSION['id'];

$sql = "SELECT * FROM users WHERE id = '$currentUser'";
$query = mysqli_query($dbConnect, $sql);
$row = mysqli_fetch_assoc($query);

auth();
require "../assets/modules/dasnav.php";
?>

<!-- Content wrapper -->
<div class="content-wrapper">
    <div class="container py-3">
        
        <div class="card p-3 shadow-lg w-75 mx-auto">
            <?php echo errorMsg(); echo successMsg(); ?>
            <form action="../assets/config/reset_pass" method="POST">
                <h4 class="text-center">Change Password</h4>
                <div class="row mt-5">
                    <div class="col-md-6 text-dark mb-3">
                        <label>Old Password:</label>
                        <input type="text"  name="old" class="form-control bg-info border-0 border-bottom border-white text-dark rounded-0">
                    </div>

                    <div class="col-md-6 text-dark mb-3">
                        <label>New Password:</label>
                        <input type="text" name="new" class="form-control bg-info border-0 border-bottom border-white text-dark rounded-0">
                    </div>

                    <div class="col-md-6 text-dark mb-3">
                        <label>Confirm Password:</label>
                        <input type="text" name="con" class="form-control bg-info border-0 border-bottom border-white text-dark rounded-0">
                    </div>
                </div>
                <button type="submit" name="resetPassword" class="btn btn-primary rounded-0 my-3">Reset</button>
            </form>

        </div>
    </div>


    <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
<style>
    ::placeholder{
        color: white !important;
    }
</style>
<?php
require "../assets/modules/dashfoot.php";
?>