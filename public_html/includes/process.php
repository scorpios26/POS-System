<?php 
include_once("../database/constants.php");
include_once("user.php");
include_once("DBOperation.php");
include_once("manage.php");

//For registration processing
if (isset($_POST["username"]) AND isset($_POST["email"])) {
    $user = new User();
    $result = $user->createUserAccount($_POST["username"],$_POST["email"],$_POST["password1"],$_POST["usertype"]);
    echo $result;
    exit();
}

//For login processing
if (isset($_POST["log_email"]) AND isset($_POST["log_password"])) {
    $user = new User();
    $result = $user->userLogin($_POST["log_email"],$_POST["log_password"]);
    echo $result;
    exit();
}

//To get User
if (isset($_POST["getUser"])) {
    $obj = new DBOperation();
    $rows = $obj->getAllRecord("user");
    foreach ($rows as $row) {
        echo "<option value ='".$row["id"]."'>".$row["user_type"]."</option>";
    }

    exit();
}

//To get Category
if (isset($_POST["getCategory"])) {
    $obj = new DBOperation();
    $rows = $obj->getAllRecord("categories");
    foreach ($rows as $row) {
        echo "<option value ='".$row["cid"]."'>".$row["category_name"]."</option>";
    }

    exit();
}

//To get Brand
if (isset($_POST["getBrand"])) {
    $obj = new DBOperation();
    $rows = $obj->getAllRecord("brands");
    foreach ($rows as $row) {
        echo "<option value ='".$row["bid"]."'>".$row["brand_name"]."</option>";
    }

    exit();
}

//ADD CATEGORY
if (isset($_POST["category_name"]) AND isset($_POST["parent_cat"])) {
    $obj = new DBOperation();
    $result = $obj->addCategory($_POST["parent_cat"],$_POST["category_name"]);
    echo $result;
    exit();
}

//ADD BRAND
if (isset($_POST["brand_name"])) {
    $obj = new DBOperation();
    $result = $obj->addBrand($_POST["brand_name"]);
    echo $result;
    exit();
}

//ADD PRODUCT
if (isset($_POST["added_date"]) AND isset($_POST["product_name"])) {
    $obj = new DBOperation();
    $result = $obj->addProduct($_POST["select_cat"],
                                $_POST["select_brand"],
                                $_POST["product_name"],
                                $_POST["product_price"],
                                $_POST["product_qty"],
                                $_POST["added_date"]);
    echo $result;
    exit();
}

//Manage Category
if (isset($_POST["manageCategory"])) {
    $m = new Manage();
    // Check if 'pageno' is set in the POST request, default to 1 if not
    // $pageno = isset($_POST["pageno"]) && is_numeric($_POST["pageno"]) ? $_POST["pageno"] : 1;
    
    $result = $m->manageRecordWithPagination("categories",$_POST["pageno"]);
    $rows = $result["rows"];
    $pagination = $result["pagination"];
    if (count($rows) > 0) {
        $n = (($_POST["pageno"] - 1) * 10)+1;
        foreach ($rows as $row) {
            ?>
            <tr>
                <td><?php echo $n; ?></td>
                <td><?php echo $row["category"]; ?></td>
                <td><?php echo $row["parent"]; ?></td>
                <td><a href="#" class="btn btn-success btn-sm">&nbsp;Active</a></td>
                <td>
                    <a href="#" did="<?php echo $row['cid']; ?>" class="btn btn-danger btn-sm del_cat">&nbsp;Delete</a>
                    <a href="#" eid ="<?php echo $row['cid']; ?>"class="btn btn-info btn-sm edit_cat">&nbsp;Edit</a>
                </td>
            </tr>
            <?php
            $n++;
        }
        ?> 
            <tr><td colspan="5"><?php echo $pagination; ?></td></tr>
        <?php 
        exit();
    }
}
//Delete Category
if (isset($_POST["deleteCategory"])) {
    $m = new Manage();
    $result = $m->deleteRecord("categories","cid",$_POST["id"]);
    echo $result;
}

//Update Category
if (isset($_POST["updateCategory"])) {
    $m = new Manage();
    $result = $m->getSingleRecord("categories","cid",$_POST["id"]);
    echo json_encode($result);
    exit();
}

//Update Categories Record after getting data
if (isset($_POST["update_category"])) {
    $m = new Manage();
    $id = $_POST["cid"];
    $name = $_POST["update_category"];
    $parent = $_POST["parent_cat"];
    $result = $m->update_record("categories", ["cid" => $id], ["parent_cat" => $parent, "category_name" => $name, "status" => 1]);
    echo $result;
}

//Manage Brand
if (isset($_POST["manageBrand"])) {
    $m = new Manage();
    // Check if 'pageno' is set in the POST request, default to 1 if not
    // $pageno = isset($_POST["pageno"]) && is_numeric($_POST["pageno"]) ? $_POST["pageno"] : 1;
    
    $result = $m->manageRecordWithPagination("brands",$_POST["pageno"]);
    $rows = $result["rows"];
    $pagination = $result["pagination"];
    if (count($rows) > 0) {
        $n = (($_POST["pageno"] - 1) * 10)+1;
        foreach ($rows as $row) {
            ?>
            <tr>
                <td><?php echo $n; ?></td>
                <td><?php echo $row["brand_name"]; ?></td>
                <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
                <td>
                    <a href="#" did="<?php echo $row['bid']; ?>" class="btn btn-danger btn-sm del_brand">Delete</a>
                    <a href="#" eid ="<?php echo $row['bid']; ?>"class="btn btn-info btn-sm edit_brand">Edit</a>
                </td>
            </tr>
            <?php
            $n++;
        }
        ?> 
            <tr><td colspan="5"><?php echo $pagination; ?></td></tr>
        <?php 
        exit();
    }
}

//Delete Brand
if (isset($_POST["deleteBrand"])) {
    $m = new Manage();
    $result = $m->deleteRecord("brands","bid",$_POST["id"]);
    echo $result;
}

//Update Brand
if (isset($_POST["updateBrand"])) {
    $m = new Manage();
    $result = $m->getSingleRecord("brands","bid",$_POST["id"]);
    echo json_encode($result);
    exit();
}

//Update Brand Record after getting data
if (isset($_POST["update_brand"])) {
    $m = new Manage();
    $id = $_POST["bid"];
    $name = $_POST["update_brand"];
    $result = $m->update_record("brands", ["bid" => $id], ["brand_name" => $name, "status" => 1]);
    echo $result;
}

//----------------------PRODUCTS----------------------------

if (isset($_POST["manageProduct"])) {
    $m = new Manage();
    // Check if 'pageno' is set in the POST request, default to 1 if not
    // $pageno = isset($_POST["pageno"]) && is_numeric($_POST["pageno"]) ? $_POST["pageno"] : 1;
    $peso = "₱";
    
    $result = $m->manageRecordWithPagination("products",$_POST["pageno"]);
    $rows = $result["rows"];
    $pagination = $result["pagination"];
    if (count($rows) > 0) {
        $n = (($_POST["pageno"] - 1) * 10)+1;
        foreach ($rows as $row) {
            ?>
            <tr>
                <td><?php echo $n; ?></td>
                <td><?php echo $row["product_name"]; ?></td>
                <td><?php echo $row["category_name"]; ?></td>
                <td><?php echo $row["brand_name"]; ?></td>
                <td><?php echo $peso.number_format($row["product_price"]); ?></td>
                <td><?php echo $row["product_stock"]; ?></td>
                <td><?php echo $row["added_date"]; ?></td>
                <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
                <td>
                    <a href="#" did="<?php echo $row['pid']; ?>" class="btn btn-danger btn-sm del_product">Delete</a>
                    <a href="#" eid ="<?php echo $row['pid']; ?>" data-bs-toggle = "modal" data-bs-target= "#update_form_products" class="btn btn-info btn-sm edit_product">Edit</a>
                </td>
            </tr>
            <?php
            $n++;
        }
        ?> 
            <tr><td colspan="5"><?php echo $pagination; ?></td></tr>
        <?php 
        exit();
    }
}

//Delete Product
if (isset($_POST["deleteProduct"])) {
    $m = new Manage();
    $result = $m->deleteRecord("products","pid",$_POST["id"]);
    echo $result;
}

//Update Product
if (isset($_POST["updateProduct"])) {
    $m = new Manage();
    $result = $m->getSingleRecord("products","pid",$_POST["id"]);
    echo json_encode($result);
    exit();
}

//Update Product Record after getting data
if (isset($_POST["update_product"])) {
    $m = new Manage();
    $id = $_POST["pid"];
    $name = $_POST["update_product"];
    $cat = $_POST["update_select_cat"];
    $brand = $_POST["update_select_brand"];
    $price = $_POST["product_price"];
    $qty = $_POST["product_qty"];
    $date = $_POST["added_date"];
    $result = $m->update_record("products", 
                                ["pid" => $id], 
                                ["cid" => $cat, 
                                "bid" => $brand, 
                                "product_name" => $name, 
                                "product_price" => $price, 
                                "product_stock" => $qty, 
                                "added_date" => $date]);
    echo $result;
}

//Manage Users
if (isset($_POST["manageUsers"])) {
    $m = new Manage();
    // Check if 'pageno' is set in the POST request, default to 1 if not
    // $pageno = isset($_POST["pageno"]) && is_numeric($_POST["pageno"]) ? $_POST["pageno"] : 1;
    
    $result = $m->manageRecordWithPagination("user",$_POST["pageno"]);
    $rows = $result["rows"];
    $pagination = $result["pagination"];
    if (count($rows) > 0) {
        $n = (($_POST["pageno"] - 1) * 10)+1;
        foreach ($rows as $row) {
            ?>
            <tr>
                <td><?php echo $n; ?></td>
                <td><?php echo $row["username"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <td><?php echo $row["user_type"]; ?></td>
                <td><?php echo $row["register_date"]; ?></td>
                <td><?php echo $row["last_login"]; ?></td>
                <td>
                    <a href="#" did="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm del_user">Delete</a>
                    <a href="#" eid ="<?php echo $row['id']; ?> " class="btn btn-info btn-sm edit_user">Edit</a>
                </td>
            </tr>
            <?php
            $n++;
        }
        ?> 
            <tr><td colspan="5"><?php echo $pagination; ?></td></tr>
        <?php 
        exit();
    }
}

if (isset($_POST["deleteUser"])) {
    $m = new Manage();
    $result = $m->deleteRecord("user","id",$_POST["id"]);
    echo $result;
}

if (isset($_POST["updateUser"])) {
    $m = new Manage();
    $result = $m->getSingleRecord("user","id",$_POST["id"]);
    echo json_encode($result);
    exit();
}

if (isset($_POST["update_user"])) {
    $m = new Manage();
    $id = $_POST["id"];
    $username = $_POST["update_username"];
    $email = $_POST["update_email"];
    $result = $m->update_record("user", ["id" => $id], ["username" => $username, "email" => $email]);
    echo $result;
}

//---------------------------- ORDER PROCESSING -----------------------

if (isset($_POST["getNewOrderItem"])) {
    $obj = new DBOperation();
    $rows = $obj->getAllRecord("products");
    ?>
    <tr>
        <td><b id="" class="number">1</b></td>
        <td>
        <select name="pid[]" class="form-control form-control-sm pid select2" id="products" required>   
            <option value="">Choose Product</option>
            <?php foreach ($rows as $row): ?>
                        <option name="pro_name[]" value="<?= $row['pid']; ?>"><?= $row['product_name']; ?></option>
            <?php endforeach; ?>

        </select>
        </td>
        <td><input type="text" name="tqty[]" readonly class="form-control form-control-sm tqty"></td>
        <td><input type="text" name="qty[]" class="form-control form-control-sm qty" required></td>
        <td><input type="text" name="price[]" readonly class="form-control form-control-sm price"></td>
        <td>₱<span class="amt">00</span></td>
        <td><input type="hidden" name="pro_name[]" class="form-control form-control-sm pro_name"></td>
    </tr>
    <?php
    exit();
}

//Get Price Quantity of one Item
if (isset($_POST["getPriceAndQty"])) {
    $m = new Manage();
    $result = $m->getSingleRecord("products","pid",$_POST["id"]);
    echo json_encode($result);
    exit();
}
date_default_timezone_set('Asia/Manila');
//Get Order
if (isset($_POST["order_date"])) {
    $orderdate = $_POST["order_date"];

    // Format the order_date to ensure it's in the correct format for the database
    $formatted_orderdate = date('Y-m-d H:i:s', strtotime($orderdate));
    $cust_name = isset($_POST["cust_name"]) ? $_POST["cust_name"] : null;
    
    $ar_tqty = isset($_POST["tqty"]) ? $_POST["tqty"] : [];
    $ar_qty = isset($_POST["qty"]) ? $_POST["qty"] : [];
    $ar_price = isset($_POST["price"]) ? $_POST["price"] : [];
    $ar_pro_name = isset($_POST["pro_name"]) ? $_POST["pro_name"] : [];

    $sub_total = $_POST["sub_total"];
    $vatable_sales = $_POST["vatable_sales"];
    $vat = $_POST["vat"];
    $discount = $_POST["discount"] . "%";
    $net_total = $_POST["net_total"];
    $paid = $_POST["paid"];
    $due = $_POST["due"];
    $payment_type = $_POST["payment_type"];

    $m = new Manage();
    echo $result = $m->storeCustomerOrderInvoice(
        $formatted_orderdate,
        $cust_name,
        $ar_tqty,
        $ar_qty,
        $ar_price,
        $ar_pro_name,
        $sub_total,
        $vatable_sales,
        $vat,
        $discount,
        $net_total,
        $paid,
        $due,
        $payment_type
    );

    if (isset($_POST['fetchUsers'])) {
        $m = new DBOperation();  // Create an instance of your DBOperation class
        
        // Fetch users from the 'user' table
        $users = $m->getAllRecord("user");
    
        if ($users === 'NO_DATA') {
            echo json_encode([]);  // Return an empty array if no data
        } else {
            echo json_encode($users);  // Return fetched user data
        }
    }
    

}

?>