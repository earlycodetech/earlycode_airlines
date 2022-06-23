<?php
require "../assets/config/dbConnect.php";
require "../assets/modules/sessions.php";
$currentUser = $_SESSION['id'];

$sql = "SELECT * FROM users WHERE id = '$currentUser'";
$query = mysqli_query($dbConnect, $sql);
$row = mysqli_fetch_assoc($query);

auth();
adminAuth();
require "../assets/modules/dasnav.php";
?>

<!-- Content wrapper -->
<div class="content-wrapper">
    <div class="container py-3">
        
        <div class="card p-3 shadow-lg w-75 mx-auto">
            <?php echo errorMsg(); echo successMsg(); ?>
     
             <form action="../assets/config/routes_control" method="post">
                <h5>From:</h5>
                <input type="text" name="from" class="form-control mb-3">

                <h5>To:</h5>
                <input type="text" name="to" class="form-control mb-3">

                <h5>Price:</h5>
                <input type="number" name="price" class="form-control mb-3">

                <h5>Max No of Passengers:</h5>
                <input type="number" name="noPass" class="form-control mb-3">

                <button type="submit" name="addRoute" class="btn btn-primary rounded-0">Add route</button>
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