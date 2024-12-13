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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.0/dist/sweetalert2.all.min.js"></script>
    <script rel="stylesheet" src="./js/main.js"></script>
    <script rel="stylesheet" src="./js/clock.js"></script>

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
        <div class="col-md-4">
        <div class="card mx-auto"  style="width: 14rem; align-items: center;">
            <img src="./images/new-user-profile.png" class="card-img-top mt-4" style="width: 12rem;" alt="Card Image">
            <div class="card-body">
                <h5 class="card-title">Profile Info</h5>
                <p class="card-text"><i class="bi bi-person-fill"></i>&nbsp;<?php echo htmlspecialchars($username); ?></p>
                <p class="card-text"><i class="bi bi-person-fill"></i>&nbsp;Admin</p>
                <p class="card-text">Last Login: xxxx-xxx-xxxx</p>
                <a href="#" class="btn btn-primary"><i class="bi bi-pen-fill"></i>&nbsp;Edit Profile</a>
            </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="bg-secondary-subtle p-5 rounded-lg h-100">
                <h1 class="text-center">Welcome Admin</h1>
                <div class="row">
                    <div class="col-sm-6 text-center">
                    <iframe src="https://free.timeanddate.com/clock/i9ihrsm1/n2399/szw160/szh160/hocbbb/hbw6/cf100/hgr0/hwc000/hcw15/fas16/fdi64/mqc000/mqs4/mql20/mqw2/mqd94/mhc000/mhs3/mhl20/mhw2/mhd94/mmc000/mml10/mmw1/mmd94/hmr7/hsc000/hss1/hsl90" frameborder="0" width="160" height="160"></iframe>
                        <div id="MyClockDisplay" class="clock font-monospace h3" onload="showTime()"></div>
                    </div>
                    <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">New Orders</h5>
                            <p class="card-text">Create invoices and orders</p>
                            <a href="new_order.php" class="btn btn-primary">New Orders</a>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- <h1 class="mt-4" style="text-align: center;">AJT Pharmacy</h1> -->
                <h1 class="mt-4" style="text-align: center;">Point Of Sale</h1>
            </div>
        </div>
    </div>
  </div>

                        <div class="container mt-4">
                            <div class="row">
                                <div class="col-md-4">
                                <div class="card mx-auto">
                                <div class="card-body">
                                    <h5 class="card-title">Manage Categories</h5>
                                    <p class="card-text">Manage and add Categories</p>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#form_category" class="btn btn-primary">Add</a>
                                    <a href="manage_categories.php" class="btn btn-primary">Manage</a>
                                </div>
                                </div>
                                </div>
                                <div class="col-md-4">
                                <div class="card mx-auto">
                                <div class="card-body">
                                    <h5 class="card-title">Manage Brands</h5>
                                    <p class="card-text">Manage and add Brands</p>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#form_brand" class="btn btn-primary">Add</a>
                                    <a href="manage_brand.php" class="btn btn-primary">Manage</a>
                                </div>
                                </div>
                                </div>
                                <div class="col-md-4">
                                <div class="card mx-auto">
                                <div class="card-body">
                                    <h5 class="card-title">Manage Products</h5>
                                    <p class="card-text">Manage and add New Products</p>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#form_products" class="btn btn-primary">Add</a>
                                    <a href="manage_product.php" class="btn btn-primary">Manage</a>
                                </div>
                                </div>
                                </div>
                            </div>
                        </div>

    <?php 
    //Category Form
    include_once("./templates/category.php");
    //Brand Form
    include_once("./templates/brand.php");
    //Product Form
    include_once("./templates/products.php");
    ?>
</body>
</html>