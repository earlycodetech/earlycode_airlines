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
            <div class="table-responsive">
                    <table class="table table-dark table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">From</th>
                                <th scope="col">To</th>
                                <th scope="col">Price</th>
                                <th scope="col">Passengers limit</th>
                                <th scope="col">...</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                
                            $id = $_SESSION['id'];
                             $sql = "SELECT * FROM bookings WHERE userid = '$id'";
                             $query = mysqli_query($dbConnect, $sql);
                             while($row = mysqli_fetch_assoc($query)){
                                $rid = $row['route_id'];
                            
                            $sql = "SELECT * FROM our_routes WHERE rid = '$rid'";
                            $nquery = mysqli_query($dbConnect, $sql);
                            $num = 1;
                            while ($prow = mysqli_fetch_assoc($nquery)) {
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $num++;  ?></th>
                                    <td><?php echo $prow['from_value']; ?></td>
                                    <td><?php echo $prow['to_value']; ?></td>
                                    <td><?php echo "$ " . number_format($prow['price_value'], 2, '.', ','); ?></td>
                                    <td><?php echo $prow['no_passengers']; $ref = "EA".rand(10000000,99999999);?></td>
                                    <td>
                                    </td>
                                </tr>
                            <?php 
                                }
                                    
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
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