<nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
  <div class="container-fluid">
    <!-- Brand name -->
    <a class="navbar-brand ms-5" href="#">POS System</a>

    <!-- Toggler for smaller screens -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav me-auto">
        <a class="nav-link active" aria-current="page" href="index.php">
          <i class="bi bi-house-fill">&nbsp;</i>Home
        </a>
        <?php
          if (isset($_SESSION["userid"])) {
        ?>
        <!-- <a class="nav-link active" aria-current="page" href="register.php">
          <i class="bi bi-person-fill-add">&nbsp;</i>Add User
        </a> -->
        <!-- <a class="nav-link active" aria-current="page" href="sales_report.php">
          <i class="bi bi-bar-chart-fill">&nbsp;</i>Sales Report
        </a> -->
        <!-- <a class="nav-link active" aria-current="page" href="manage_users.php">
          <i class="bi bi-people-fill">&nbsp;</i>Users
        </a> -->
        <li class="nav-item dropdown">
          <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Reports
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="sales_report.php">Sales Report</a></li>
            <li><a class="dropdown-item" href="receipts.php">Receipts</a></li>
            <!-- <li><a class="dropdown-item" href="#">Something else here</a></li> -->
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Manage
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="manage_brand.php">Manage Brand</a></li>
            <li><a class="dropdown-item" href="manage_categories.php">Manage Categories</a></li>
            <!-- <li><a class="dropdown-item" href="#">Something else here</a></li> -->
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Manage Users
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="register.php">Add User</a></li>
            <li><a class="dropdown-item" href="manage_users.php">Users</a></li>
            <!-- <li><a class="dropdown-item" href="#">Something else here</a></li> -->
          </ul>
        </li>
        <!-- <a class="nav-link active" aria-current="page" href="manage_categories.php">
          <i class="bi bi-grid-fill">&nbsp;</i>Categories
        </a> -->
        <!-- <a class="nav-link active" aria-current="page" href="manage_brand.php">
          <i class="bi bi-bookmark-fill">&nbsp;</i>Brands
        </a> -->
        <a class="nav-link active" aria-current="page" href="manage_product.php">
          <i class="bi bi-bag-fill">&nbsp;</i>Products
        </a>
        <a class="nav-link active" aria-current="page" href="new_order.php">
          <i class="bi bi-cart-fill">&nbsp;</i>Invoice
        </a>
        <!-- <a class="nav-link active" aria-current="page" href="receipts.php">
          <i class="bi bi-receipt">&nbsp;</i>Receipts
        </a> -->

        
        <?php
          }
        ?>
      </div>

      <!-- Right-aligned Logout link -->
      <div class="navbar-nav">
        <?php
          if (isset($_SESSION["userid"])) {
        ?>
        <a class="nav-link active me-4" aria-current="page" href="logout.php">
          <i class="bi bi-arrow-left-circle-fill">&nbsp;</i>Logout
        </a>
        <?php
          }
        ?>
      </div>
    </div>
  </div>
</nav>
