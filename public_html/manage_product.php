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
    <script rel="stylesheet" src="./js/manage.js"></script>
    <script rel="stylesheet" src="./js/main.js"></script>

  </head>
</head>
<body>

  <?php
    // <!-- Navbar -->
    include_once("./templates/header.php");
  ?>
  <br></br>
  <div class="container text-center">
    <div class="">
  <a href="#" data-bs-toggle="modal" data-bs-target="#form_products" class="btn btn-primary">Add New Product</a> 
  </div>    
  <h1>List Of Products</h1>   
  <table class="table table-bordered table-hover text-center">
    <thead>
      <tr>
        <th>#</th>
        <th>Product</th>
        <th>Category</th>
        <th>Brand</th>
        <th>Price</th>
        <th>Stock</th>
        <th>Added Date</th>
        <th>Status</th>
        <th>Actions</th>

      </tr>
    </thead>
    <tbody id="get_product">
      <!--<tr>
        <td>1</td>
        <td>Electronics</td>
        <td>Root</td>
        <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
        <td>
            <a href="#" class="btn btn-danger btn-sm">Delete</a>
            <a href="#" class="btn btn-info btn-sm">Edit</a>
        </td>
      </tr>-->
    </tbody>
  </table>
  </div>
  <?php 
    include_once("./templates/update_products.php");
    
    //Product Form
    include_once("./templates/products.php");
   ?>
</body>
</html>