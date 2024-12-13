<?php  
include_once("./database/constants.php");
if(isset($_SESSION["userid"])){
  header("location:".DOMAIN."/dashboard.php");
};

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
    <link rel="stylesheet" href="./includes/style.css">
    <script rel src="./js/main.js"></script>

  </head>
</head>
<body>
<div class="overlay">
  <div class="loader"></div>
</div>
  <?php
    // <!-- Navbar -->
    include_once("./templates/header.php");
  ?>
  <div class="container">
    <?php 
      if (isset($_GET["msg"]) AND !empty($_GET["msg"])) {
        ?>

        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <?php echo $_GET["msg"]; ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <?php
        
      }
    ?>
  <div class="card mx-auto mt-5" style="width: 18rem;">
  <img src="./images/user.png" class="card-img-top mt-4" alt="Login Icon">
  <div class="card-body">
        <form id="login_form" onsubmit="return false">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" name="log_email" id="log_email">
        <small id="e_error" class="form-text text-muted"></small>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" name="log_password" id="log_password">
        <small id="p_error" class="form-text text-muted"></small>
      </div>
      <button type="submit" class="btn btn-primary"><i class="bi bi-lock"></i>&nbsp;Login</button>
      <!-- <span><a href="register.php" style="text-decoration: none;">&nbsp;Register</a></span> -->
    </form>
  </div>
  <div class="card-footer"><a href="#" style="text-decoration: none;">Forget Password?</a></div>
</div>
  </div>
</body>
</html>