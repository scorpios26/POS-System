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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.0/dist/sweetalert2.all.min.js"></script>
    <script rel="stylesheet" src="./js/order.js"></script>

  </head>
</head>
<body>

  <?php
    // <!-- Navbar -->
    include_once("./templates/header.php");
  ?>
  <br></br>
    <div class="container">
        <div class="row">
            <div class="col-md-15 mx-auto">
            <div class="card mb-5" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                <div class="card-header">
                    <h4>Invoice</h4>
                </div>
                    <div class="card-body">
                        <form action="" id="get_order_data" onsubmit="return false">
                            <div class="form-group row mx-auto m-2">
                                <label for="" class="col-sm-3 col-form-label" align="right">Order Date</label>
                                <div class="col-sm-6">
                                    <input type="datetime-local" id="order_date" name="order_date" readonly class="form-control form-control-sm" value="">
                                </div>
                            </div>
                            <div class="form-group row mx-auto m-2">
                                <label for="" class="col-sm-3" align="right">Customer Name</label>
                                <div class="col-sm-6">
                                    <input type="text" id="cust_name" name="cust_name" class="form-control form-control-sm" value="" placeholder="Customer Name">
                                </div>
                            </div>

                            <div class="card"style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                                <div class="card-body">
                                    <h3>Make an Order List</h3>
                                    <table align="center">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th style="text-align:center;">Item Name</th>
                                                <th style="text-align:center;">Total Quantity</th>
                                                <th style="text-align:center;">Quantity</th>
                                                <th style="text-align:center;">Price</th>
                                                <th style="text-align:center;">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody id="invoice_item">
                                            <!-- <tr>
                                                <td><b id="number">1</b></td>
                                                <td>
                                                    <select name="pid[]" class="form-control form-control-sm" id="" required>
                                                        <option value="">Biogesic</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" name="tqty[]" readonly class="form-control form-control-sm"></td>
                                                <td><input type="text" name="qty[]" class="form-control form-control-sm" required></td>
                                                <td><input type="text" name="price[]" class="form-control form-control-sm"></td>
                                                <td>10.00</td>
                                            </tr> -->

                                        </tbody>
                                    </table> 
                                    <!-- TABLE ENDS -->
                                     <center style="padding: 10px;">
                                        <button class="btn btn-success" id="add" style="width:150px;">Add</button>
                                        <button class="btn btn-danger" id="remove" style="width:150px;">Remove</button>
                                     </center>
                                </div>
                                <!-- CARD BOY ENDS -->
                            </div>
                            <!-- ORDER LIST CARD ENDS -->

                            <p></p>
                            <div class="form-group row">
                                <label for="sub_total" class="col-sm-3 col-form-label" align="right">Sub Total</label>
                                <div class="col-sm-6">
                                    <input type="text" name="sub_total" class="form-control form-control-sm" id="sub_total" required readonly>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="vatable_sales" class="col-sm-3 col-form-label" align="right">Vatables Sales</label>
                                <div class="col-sm-6">
                                    <input type="text" name="vatable_sales" class="form-control form-control-sm" id="vatable_sales" required readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="vat" class="col-sm-3 col-form-label" align="right">Vat 12%</label>
                                <div class="col-sm-6">
                                    <input type="text" name="vat" class="form-control form-control-sm" id="vat" required readonly>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="discount" class="col-sm-3 col-form-label discount" align="right">Discount</label>
                                <div class="col-sm-6">
                                    <select name="discount" id="discount" class="form-control form-control-sm" required>
                                        <option value="0">No Discount</option>
                                        <option value="20">20% Discount</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="net_total" class="col-sm-3 col-form-label" align="right">Net Total</label>
                                <div class="col-sm-6">
                                    <input type="text" readonly name="net_total" class="form-control form-control-sm" id="net_total" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="paid" class="col-sm-3 col-form-label" align="right">Paid</label>
                                <div class="col-sm-6">
                                    <input type="text" name="paid" class="form-control form-control-sm" id="paid" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="due" class="col-sm-3 col-form-label" align="right">Change Due</label>
                                <div class="col-sm-6">
                                    <input type="text" readonly name="due" class="form-control form-control-sm" id="due">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="payment_type" class="col-sm-3 col-form-label" align="right">Payment Method</label>
                                <div class="col-sm-6">
                                <select name="payment_type" id="payment_type" class="form-control form-control-sm" required>
                                    <option value="" disabled>Select Payment Method</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Bank Transfer">Bank Transfer</option>
                                    <option value="Gcash">Gcash</option>
                                    <option value="Paymaya">Paymaya</option>
                                </select>
                                </div>
                            </div>

                            <center>
                                <input type="submit" id="order_form" style="width: 150px;" class="btn btn-info" value="Order">
                                <input type="submit" id="print_invoice" style="width: 150px;" class="btn btn-success d-none" value="Print Invoice">
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>