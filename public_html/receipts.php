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
    <h3 class="my-4 text-center">RECEIPTS</h3>

    <div class="row">
        <?php
        $dir = 'PDF_INVOICE/'; // Folder where PDF files are stored
        $files = scandir($dir); // Get all files in the directory

        foreach ($files as $file) {
            // Display only PDF files
            if (pathinfo($file, PATHINFO_EXTENSION) == 'pdf') {
                echo '<div class="col-md-4 col-sm-6 mb-4">';
                echo '<div class="card">';
                echo '<div class="card-body text-center p-0">'; // Center align the link
                echo '<h5 class="card-title fs-6"><a href="'.$dir.$file.'" target="_blank">'.htmlspecialchars($file).'</a></h5>'; // Display link to PDF
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        }
        ?>
    </div>
</div>


</body>
</html>