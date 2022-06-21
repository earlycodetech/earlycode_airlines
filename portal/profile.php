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
            <form action="../assets/config/update_ctrl" method="POST">
                <div class="d-flex justify-content-end">
                    <img src="../assets/img/abidijan.jpeg" width="150" height="150" class="img-thumbnail p-1 border">
                </div>
                <div class="row mt-5">
                    <div class="col-md-6 text-dark mb-3">
                        <label>First Name:</label>
                        <input type="text" placeholder="<?php echo $row['firstname'] ?>" name="fname" class="form-control bg-info border-0 border-bottom border-white text-dark rounded-0">
                    </div>

                    <div class="col-md-6 text-dark mb-3">
                        <label>Last Name:</label>
                        <input type="text"  placeholder="<?php echo $row['lastname'] ?>" name="lname" class="form-control bg-info border-0 border-bottom border-white text-dark rounded-0">
                    </div>

                    <div class="col-md-6 text-dark mb-3">
                        <label>User Name:</label>
                        <input type="text"  value="<?php echo $row['username'] ?>" class="form-control bg-info border-0 border-bottom border-white text-dark rounded-0" readonly>
                    </div>

                    <div class="col-md-6 text-dark mb-3">
                        <label>Phone:</label>
                        <input type="tel"  placeholder="<?php echo $row['phone'] ?>" name="phone" class="form-control bg-info border-0 border-bottom border-white text-dark rounded-0">
                    </div>

                    <div class="col-md-6 text-dark mb-3">
                        <label>Email:</label>
                        <input type="email"  value="<?php echo $row['email'] ?>"  class="form-control bg-info border-0 border-bottom border-white text-dark rounded-0" readonly>
                    </div>
                    <div class="col-md-6 text-dark mb-3">
                        <label>Date of Birth:</label>
                        <input type="text"  placeholder="<?php echo $row['dob'] ?>" onfocus="this.type='date'" name="dob" class="form-control bg-info border-0 border-bottom border-white text-dark rounded-0">
                    </div>
                </div>
                <button type="submit" name="userUpdate" class="btn btn-primary rounded-0 my-3">Update</button>
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