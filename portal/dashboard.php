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
        echo successMsg();
        echo errorMsg();
        if ($_SESSION['role'] !== 'admin') {
        ?>

            <div class="card p-3 shadow-lg w-75 mx-auto">
                <form action="" method="POST">
                    <input type="text" name="searchedFor" class="form-control">
                    <button type="submit" name="search" class="btn btn-primary rounded-0 my-3">Get Quote</button>
                </form>
                <div class="table-responsive <?php if (!isset($_POST['search'])) {
                                                    echo "d-none";
                                                } ?>">
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
                            // $sql = "SELECT * FROM users WHERE user_role = 'user' AND trash_stat = 'trash' ORDER BY id DESC LIMIT 0,3";
                            if (isset($_POST['search'])) {
                                $search = $_POST['searchedFor'];
                                $sql = "SELECT * FROM our_routes WHERE from_value LIKE '%$search%' OR to_value LIKE '%$search%'";
                            } else {
                                $sql = "SELECT * FROM our_routes";
                            }

                            $query = mysqli_query($dbConnect, $sql);
                            $num = 1;
                            while ($prow = mysqli_fetch_assoc($query)) {
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $num++;  ?></th>
                                    <td><?php echo $prow['from_value']; ?></td>
                                    <td><?php echo $prow['to_value']; ?></td>
                                    <td><?php echo "$ " . number_format($prow['price_value'], 2, '.', ','); ?></td>
                                    <td><?php echo $prow['no_passengers']; $ref = "EA".rand(10000000,99999999);?></td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $prow['id']; ?>">
                                            Book flight
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal<?php echo $prow['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-dark">
                                                       <form action="" method="post">
                                                            <input type="hidden" name="route_id" value="<?php echo $prow['id']; ?>">
                                                       </form>

                                                       <small>Pay online with your debit card</small>
                                                        <!-- //// begins flutterwave payment code //// -->
                                                        <small>Pay online with your debit card</small>
                                                        <input type="submit" class="btn-success btn" style="cursor:pointer;" value="Pay Now" id="submit" />
                                                        
                                                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
                                                            <script type="text/javascript" src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
                                                            <script type="text/javascript">
                                                            document.addEventListener("DOMContentLoaded", function(event) {
                                                            document.getElementById('submit').addEventListener('click', function () {
                                                                
                                                            var flw_ref = "", chargeResponse = "", trxref = "FDKHGK"+ Math.random(), API_publicKey = "FLWPUBK_TEST-83af4504f6370dc6576a13be3875e79b-X";//Always change flutterwave public key to your own key

                                                            //   ENTER ALL ESSENTIAL VARIABLES
                                                            // var amount_ea = "50000";
                                                            var amount_ea = <?php echo $prow['price_value'];?>;
                                                            var email_ea = <?php echo (json_encode($row['email'])); ?>;
                                                            var phone_ea = <?php echo (json_encode($row['phone'])); ?>;
                                                            var ref_ea = <?php echo(json_encode($ref)); ?>;

                                                            getpaidSetup(
                                                                {
                                                                PBFPubKey: API_publicKey,
                                                                customer_email: email_ea,
                                                                amount: amount_ea,
                                                                customer_phone: phone_ea,
                                                                currency: "NGN",
                                                                txref: ref_ea,
                                                                meta: [{metaname:"EA-NG", metavalue: "NG"}],
                                                                onclose:function(response) {
                                                                },
                                                                callback:function(response) {
                                                                    txref = response.data.txRef, chargeResponse = response.data.chargeResponseCode;
                                                                    if (chargeResponse == "00" || chargeResponse == "0") {
                                                                    //   if payment failed
                                                                        window.location = "";
                                                                    } else {
                                                                        //when successful
                                                                    window.location = "success?id=<?php $prow['id']; ?>";
                                                                    }
                                                                }
                                                                }
                                                            );
                                                            });
                                                            });
                                                        </script>
                                                        <!-- END OF PAYMENT SCRIPT -->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
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

                                $query = mysqli_query($dbConnect, $sql);
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