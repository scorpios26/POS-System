<?php 

class DBOperation {
    
    private $con;

    function __construct()
    {
        include_once("../database/db.php");
        $db = new Database();
        $this->con = $db->connect();   
    }

    public function addCategory($parent,$cat){
        //Check if category already exist
        $check_stmt = $this->con->prepare("SELECT * FROM categories WHERE category_name = ?");
        if ($check_stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($this->con->error));
        }
        $check_stmt->bind_param("s", $cat);
        $check_stmt->execute();
        $result = $check_stmt->get_result();
        
        if ($result->num_rows >0) {
            return 'DUPLICATE_CATEGORY';
        }else{
        //Proceed to insert the category
        $pre_stmt = $this->con->prepare("INSERT INTO `categories`(`parent_cat`, `category_name`, `status`) VALUES (?,?,?)");
        $status = 1;
        $pre_stmt->bind_param("isi", $parent,$cat,$status);
        $result = $pre_stmt->execute() or die($this->con->error);
        if ($result) {
            return 'CATEGORY_ADDED';
        }else{
            return 0;
        }
    }
}

    public function addBrand($brand_name){
        //Check if brand already exist
        $check_stmt = $this->con->prepare("SELECT * FROM brands WHERE brand_name = ?");
        if ($check_stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($this->con->error));
        }
        $check_stmt->bind_param("s", $brand_name);
        $check_stmt->execute();
        $result = $check_stmt->get_result();
        
        if ($result->num_rows >0) {
            return 'DUPLICATE_BRAND_NAME';
        }else{
        //Proceed to insert the brand
        $pre_stmt = $this->con->prepare("INSERT INTO `brands`(`brand_name`, `status`) VALUES (?,?)");
        $status = 1;
        $pre_stmt->bind_param("si", $brand_name,$status);
        $result = $pre_stmt->execute() or die($this->con->error);
        if ($result) {
            return 'BRAND_NAME_ADDED';
        }else{
            return 0;
        }
    }
}

public function addProduct($cid, $bid, $prod_name, $price, $stock, $date) {
    // Check if the product already exists with the same name and the same brand (no need to check by name alone)
    $check_stmt = $this->con->prepare("SELECT * FROM products WHERE product_name = ? AND bid = ?");
    if ($check_stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($this->con->error));
    }

    // Bind the parameters for product name and brand id (bid)
    $check_stmt->bind_param("si", $prod_name, $bid);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    // If the product name exists under the same brand, return a duplicate error
    if ($result->num_rows > 0) {
        return 'DUPLICATE_PRODUCT_FOR_SAME_BRAND';
    } else {
        // Proceed to insert the new product
        $pre_stmt = $this->con->prepare("INSERT INTO `products`(`cid`, `bid`, `product_name`, `product_price`, `product_stock`, `added_date`, `p_status`) 
                                         VALUES (?,?,?,?,?,?,?)");

        if ($pre_stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($this->con->error));
        }

        $status = 1;  // Assuming '1' means the product is active or available
        $pre_stmt->bind_param("iisdisi", $cid, $bid, $prod_name, $price, $stock, $date, $status);

        $result = $pre_stmt->execute();
        if ($result) {
            return 'NEW_PRODUCT_ADDED';
        } else {
            return 'INSERTION_FAILED' . htmlspecialchars($this->con->error);
        }
    }
}


    
    public function getAllRecord($table){
        $pre_stmt = $this->con->prepare("SELECT * FROM " .$table);
        $pre_stmt->execute() or die($this->con->error);
        $result = $pre_stmt->get_result();
        $rows = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $rows[] = $row;
            }
            return $rows;
        }
        return 'NO_DATA';
    }

}


// $opr = new DBOperation();
// echo $opr->addCategory(0, "Gadgets");
// echo "<pre>";
// print_r($opr->getAllRecord("categories"));

 ?>