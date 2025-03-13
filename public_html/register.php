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
    <link rel="stylesheet" href="./includes/style.css">
    <script src="./js/main.js"></script>

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
  <br></br>
  <div class="container">
    <div class="card mx-auto" style="width: 30rem;">
        <div class="card-header">Register</div>
        <div class="card-body m-3">
            <form action="" id="register_form" onsubmit="return false" autocomplete="off">
                <div class="form-group">
                    <label class="m-2" for="username">Full Name</label>
                    <input type="text" name="username" class="form-control" id="username" placeholder="Enter Username">
                    <small id="u_error" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label class="m-2" for="email">Email Address</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email">
                    <small id="e_error" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label class="m-2" for="password">Password</label>
                    <input type="password" name="password1" class="form-control" id="password1" placeholder="Enter Password">
                    <small id="p1_error" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label class="m-2" for="password2">Re-enter Password</label>
                    <input type="password" name="password2" class="form-control" id="password2" placeholder="Re-enter Pasword">
                    <small id="p2_error" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <label class="m-2" for="usertype">Usertype</label>
                    <select name="usertype" class="form-control" id="usertype">
                        <option value="">Choose User Type</option>
                        <option value="1">Admin</option>
                        <option value="0">Other</option>
                    </select>
                    <small id="t_error" class="form-text text-muted"></small>
                </div>
                <button type="submit" name="user_register" class="btn btn-primary mt-3">
                    <span class="bi bi-person"></span>&nbsp;Register
                </button>
            </form>
        </div>
        <div class="card-footer text-muted">
            <a href="#" style="text-decoration: none;">Forgot Password?</a>
        </div>
    </div>
  </div>
</body>
</html>