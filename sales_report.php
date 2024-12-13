<?php
include_once("./database/constants.php");
if (!isset($_SESSION["userid"])) {
    header("location:".DOMAIN."/");
    exit;
} 

// If the user is logged in, display the username
// if (isset($_SESSION["username"])) {
//     echo "Welcome, " . htmlspecialchars($_SESSION["username"]) . "!";
    
// } else {
//     echo "Username not set.";
// }

$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Admin';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory System</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- datepicker -->
    <script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.0/themes/base/jquery-ui.css">
    <!-- datepicker -->
     <!-- datatables -->
    <link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.1.6/b-3.1.2/b-html5-3.1.2/b-print-3.1.2/r-3.0.3/datatables.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.1.6/b-3.1.2/b-html5-3.1.2/b-print-3.1.2/r-3.0.3/datatables.min.js"></script>
     <!--datatables -->
    <script rel="stylesheet" src="./js/main.js"></script>
    <script rel="stylesheet" src="./js/sales.js"></script>
    <link rel="stylesheet" href="./includes/style.css">

  </head>
</head>
<body>

  <?php
    // <!-- Navbar -->
    include_once("./templates/header.php");
  ?>
  <div class="container">
    <div class="row">
        <div class="col-md-12 mt-5">
            <h5 class="text-center">Sales Report</h5>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-info text-white" id="basic-addon1"><i class="bi bi-calendar-heart"></i></span>
                        <input type="text" class="form-control" id="start_date" placeholder="Start Date" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                <div class="input-group mb-3">
                        <span class="input-group-text bg-info text-white" id="basic-addon1"><i class="bi bi-calendar-heart"></i></span>
                        <input type="text" class="form-control" id="end_date" placeholder="End Date" readonly>
                    </div>
                </div>
            </div>
            <button id="filter" class="btn btn-info btn-sm">Filter</button>
            <button id="reset" class="btn btn-warning btn-sm">Reset</button>
            <button class="btn btn-outline-success"><span id="total_sales">Total Sales: 0.00</span></button>
        </div>
            <div class="row mt-3 mb-5">
                <div class="col-md-12">
                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered" id="records">
                            <thead>
                                <tr>
                                    <th>Invoice ID</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Sub Total</th>
                                    <th>Discount</th>
                                    <th>Net Total</th>
                                    <th>Paid</th>
                                    <th>Change</th>
                                    <th>Payment Type</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>

</body>
</html>