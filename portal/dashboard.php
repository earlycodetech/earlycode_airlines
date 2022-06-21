<?php
    require "../assets/config/dbConnect.php";
    require "../assets/modules/sessions.php";
    $currentUser = $_SESSION['id'];

    $sql = "SELECT * FROM users WHERE id = '$currentUser'";
    $query = mysqli_query($dbConnect,$sql);
    $row = mysqli_fetch_assoc($query);

    auth();
    require "../assets/modules/dasnav.php";
?>

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <div class="container py-3">
                <?php 
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
                <?php }else{ ?>
<h1>Admin</h1>
                <?php } ?>
            </div>


            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
          
<?php
    require "../assets/modules/dashfoot.php";
?>