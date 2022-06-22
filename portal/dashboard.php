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
        <?php
             echo successMsg(); echo errorMsg();
        if ($_SESSION['role'] !== 'admin') {
        ?>

            <div class="card p-3 shadow-lg w-75 mx-auto">
                <form action="" method="POST">
                    <label class="fs-1 fw-bold">From:</label>
                    <select name="" class="form-control mb-4">
                        <option>Option 1</option>
                        <option>Option 1</option>
                        <option>Option 1</option>
                        <option>Option 1</option>
                    </select>


                    <label class="fs-1 fw-bold">To:</label>
                    <select name="" class="form-control mb-4">
                        <option>Option 1</option>
                        <option>Option 1</option>
                        <option>Option 1</option>
                        <option>Option 1</option>
                    </select>


                    <label class="fs-1 fw-bold text-capitalize">Date and Time of Departure</label>
                    <input type="datetime-local" class="form-control mb-4">

                    <label class="fs-1 fw-bold text-capitalize">No of passengers</label>
                    <input type="number" class="form-control mb-4">

                    <button type="submit" class="btn btn-primary rounded-0 my-3">Get Quote</button>
                </form>

            </div>
        <?php } else { ?>
            <div class="card">
                <div class="card-body">
                    <!-- Total Number of Users Start-->
                    <div class="d-flex justify-content-end">
                        <div class="card">
                            <div class="card-body">
                                <h5><i class="fa fa-users"></i> Total Users</h5>
                                <?php
                                $sql = "SELECT * FROM users WHERE user_role = 'user'";
                                $query = mysqli_query($dbConnect, $sql);
                                $noUsers = mysqli_num_rows($query);
                                echo "<h5 class=\"text-center\">$noUsers</h5>";
                                ?>

                            </div>
                        </div>
                    </div>
                    <!-- Total Number of Users Ends-->

                    <div class="table-responsive">
                        <table class="table table-dark table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Reg Date</th>
                                    <th scope="col">...</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    // $sql = "SELECT * FROM users WHERE user_role = 'user' AND trash_stat = 'trash' ORDER BY id DESC LIMIT 0,3";
                                    $sql = "SELECT * FROM users WHERE user_role = 'user'  ORDER BY id DESC LIMIT 0,3";

                                    $query = mysqli_query($dbConnect,$sql);
                                    $num = 1;
                                    while ($row = mysqli_fetch_assoc($query)) {   
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $num++;  ?></th>
                                    <td><?php echo $row['firstname']; ?></td>
                                    <td><?php echo $row['lastname']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['date_created']; ?></td>
                                    <td>
                                        <a href="../assets/config/params?delUser=<?php echo $row['id']; ?>" class="btn text-white btn-danger">
                                            <i class="fa fa-trash text-white"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        <form action="../assets/config/params" method="GET">
                            <input type="text" name="del">
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>


    <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->

<?php
require "../assets/modules/dashfoot.php";
?>