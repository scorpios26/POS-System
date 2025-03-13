<?php 

class Manage
{
    private $con;

    function __construct()
    {
        include_once("../database/db.php");
        $db = new Database();
        $this->con = $db->connect();
    }

    public function manageRecordWithPagination($table, $pno){
        $a = $this->pagination($this->con,$table,$pno,10);
        if ($table == "categories") {
            $sql = "SELECT 
                        p.cid,
                        p.category_name as category, 
                        c.category_name as parent, 
                        p.status 
                    FROM 
                        categories p 
                    LEFT JOIN 
                        categories c 
                    ON 
                        p.parent_cat = c.cid" . $a["limit"];
        }else if($table == "products"){
            $sql = "SELECT 
                        p.pid,
                        p.product_name, 
                        c.category_name, 
                        b.brand_name, 
                        p.product_price, 
                        p.product_stock, 
                        p.added_date, 
                        p.p_status 
                    FROM 
                        products p,
                        brands b,
                        categories c 
                    WHERE 
                        p.bid = b.bid 
                    AND 
                        p.cid = c.cid". $a["limit"];
        }else{
            $sql = "SELECT * FROM " . $table . " " . $a["limit"];
        }
        $result = $this->con->query($sql) or die ($this->con->error);
        $rows = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }

        return ["rows"=>$rows, "pagination" =>$a["pagination"]];

    }

    private function pagination($con,$table,$pno,$n){
        $query = $con->query("SELECT COUNT(*) as total_rows FROM " .$table);
        $row = mysqli_fetch_assoc($query);
        
        $pageno = $pno;
        $numberOfRecordsPerPage = $n;
    
        $last = ceil($row["total_rows"]/$numberOfRecordsPerPage);
        
        $pagination = "<ul class ='pagination'>";
    
        if ($last != 1) {
            if ($pageno > 1) {
                $previous = "";
                $previous = $pageno - 1;
                $pagination .= "<li class ='page-item'><a class='page-link' pn='".$previous."' href='#' style='color:#333';>Previous</a></li>";
            }
            for ($i=$pageno - 5 ; $i< $pageno ; $i++ ) { 
                if ($i > 0) {
                    $pagination .= "<li class ='page-item'><a class='page-link' pn='".$i."' href='#'>".$i."</a></li>";
                }
                
            }
            $pagination .= "<li class ='page-item'><a class='page-link' pn='".$pageno."' href='#' style='color:#333';>$pageno</a></li>";
    
            for ($i=$pageno + 1; $i <= $last ; $i++) { 
                $pagination .= "<li class ='page-item'><a class='page-link' pn='".$i."' href='#'>".$i."</a></li>";
                if ($i > $pageno + 4) {
                    break;
                }
            }
            if ($last > $pageno) {
                $next = $pageno + 1;
                $pagination .= "<li class ='page-item'><a class='page-link' pn='".$next."' href='#' style='color:#333';>Next</a></li></ul>";
    
            }
        }
    //LIMIT 0,10
    //LIMIT 20,10
        $limit = " LIMIT ".(($pageno - 1) * $numberOfRecordsPerPage).",".$numberOfRecordsPerPage;
    
        return ["pagination" =>$pagination,"limit"=>$limit];
    }

    public function deleteRecord($table, $pk, $id) {
        if ($table == "categories") {
            // Check if the category has any dependent products
            $pre_stmt = $this->con->prepare("SELECT * FROM products WHERE cid = ?");
            $pre_stmt->bind_param("i", $id);
            $pre_stmt->execute();
            $result = $pre_stmt->get_result();
            
            if ($result->num_rows > 0) {
                // Dependent products found, cannot delete the category
                return 'DEPENDENT_PRODUCTS_EXIST';
            } else {
                $pre_stmt = $this->con->prepare("SELECT ".$id." FROM categories WHERE parent_cat = ?");
                $pre_stmt->bind_param("i", $id);
                $pre_stmt->execute();
                $result = $pre_stmt->get_result() or die($this->con->error);
            
                if ($result->num_rows > 0) {
                    return 'DEPENDENT_CATEGORY';
                } else {
                    // No dependencies, proceed with deletion
                    $pre_stmt = $this->con->prepare("DELETE FROM ".$table." WHERE ".$pk." = ?");
                    $pre_stmt->bind_param("i", $id);
                    $result = $pre_stmt->execute() or die($this->con->error);
    
                    if ($result) {
                        return 'DELETED';
                    }
                }
            }
        } elseif ($table == "brands") {
            // Check if the brand has any dependent products
            $pre_stmt = $this->con->prepare("SELECT * FROM products WHERE bid = ?");
            $pre_stmt->bind_param("i", $id);
            $pre_stmt->execute();
            $result = $pre_stmt->get_result();
            
            if ($result->num_rows > 0) {
                // Dependent products found, cannot delete the brand
                return 'BRAND_ASSOCIATED';
            } else {
                // No dependencies, proceed with deletion
                $pre_stmt = $this->con->prepare("DELETE FROM ".$table." WHERE ".$pk." = ?");
                $pre_stmt->bind_param("i", $id);
                $result = $pre_stmt->execute() or die($this->con->error);
    
                if ($result) {
                    return 'DELETED';
                }
            }
        }elseif ($table == "user") {
            
                // No dependencies, proceed with deletion
                $pre_stmt = $this->con->prepare("DELETE FROM ".$table." WHERE ".$pk." = ?");
                $pre_stmt->bind_param("i", $id);
                $result = $pre_stmt->execute() or die($this->con->error);
    
                if ($result) {
                    return 'DELETED';
                }
            
        }else {
            // Handle other tables if necessary
            $pre_stmt = $this->con->prepare("DELETE FROM ".$table." WHERE ".$pk." = ?");
            $pre_stmt->bind_param("i", $id);
            $result = $pre_stmt->execute() or die($this->con->error);
    
            if ($result) {
                return 'DELETED';
            }
        }
    }
    

        public function getSingleRecord($table,$pk,$id) {
            $pre_stmt = $this->con->prepare("SELECT * FROM ".$table." WHERE ".$pk."=? LIMIT 1");
            $pre_stmt->bind_param("i",$id);
            $pre_stmt->execute() or die($this->con->error);
            $result = $pre_stmt->get_result();

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
            }
            return $row;
        }

        public function update_record($table, $where, $fields) {
            $sql = "";
            $condition = "";
            
            // Building the WHERE condition
            foreach ($where as $key => $value) {
                $condition .= $key . "='" . $value . "' AND ";
            }
            $condition = substr($condition, 0, -5); // Remove the trailing ' AND '
        
            // Building the SET clause
            foreach ($fields as $key => $value) {
                $sql .= $key . "='" . $value . "', ";
            }
            $sql = substr($sql, 0, -2); // Remove the trailing ', '
        
            // Final SQL query with proper spaces
            $sql = "UPDATE " . $table . " SET " . $sql . " WHERE " . $condition;
        
            // Execute the query and return result
            if (mysqli_query($this->con, $sql)) {
                return 'UPDATED';
            } else {
                // If there's an error, return it for debugging
                return mysqli_error($this->con);
            }
        }

        public function storeCustomerOrderInvoice(
            $formatted_orderdate,
            $cust_name,
            $ar_tqty,
            $ar_qty,
            $ar_price,
            $ar_pro_name,
            $sub_total,
            $vatable_sales,
            $vat,
            $discount   ,
            $net_total,
            $paid,
            $due,
            $payment_type
        ) {
            // Insert into `invoice` table
            $pre_stmt = $this->con->prepare("INSERT INTO `invoice`
                (`customer_name`, `order_date`, `sub_total`, `vatable_sales`, `vat`, `discount`, `net_total`, `paid`, `due`, `payment_type`) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $pre_stmt->bind_param("sssdddddds", $cust_name, $formatted_orderdate, $sub_total, $vatable_sales, $vat, $discount, $net_total, $paid, $due, $payment_type);
            $pre_stmt->execute() or die($this->con->error);
            
            $invoice_no = $pre_stmt->insert_id;
    
    // Check if invoice was successfully inserted
    if ($invoice_no != null) {
        for ($i = 0; $i < count($ar_price); $i++) {
            // Subtract the ordered quantity from the total available quantity
            $rem_qty = $ar_tqty[$i] - $ar_qty[$i];
            if ($rem_qty < 0) {
                return "ORDER_FAIL_TO_COMPLETE";
            } else {
                // Prepare update statement for product stock
                $update_stmt = $this->con->prepare("UPDATE products SET product_stock = ? WHERE product_name = ?");
                $update_stmt->bind_param("is", $rem_qty, $ar_pro_name[$i]);
                $update_stmt->execute() or die($this->con->error);
            }

            // Insert product details into `invoice_details` table
            $insert_product = $this->con->prepare("INSERT INTO `invoice_details`
                (`invoice_no`, `product_name`, `price`, `qty`) 
                VALUES (?, ?, ?, ?)");
            $insert_product->bind_param("isdd", $invoice_no, $ar_pro_name[$i], $ar_price[$i], $ar_qty[$i]);
            $insert_product->execute() or die($this->con->error);
        }

        return $invoice_no;
    } else {
        return "ORDER_FAILED";
    }

    
}
// public function getSalesWithDateRange($start_date, $end_date) {
//     $query = "
//         SELECT 
//             i.invoice_no AS `Invoice ID`,
//             d.product_name AS `Product Name`,
//             d.price AS `Price`,
//             d.qty AS `Quantity`,
//             (d.price * d.qty) AS `Sub Total`,
//             i.discount AS `Discount`,
//             i.net_total AS `Net Total`,
//             i.paid AS `Paid`,
//             (i.paid - i.net_total) AS `Change`,
//             i.payment_type AS `Payment Type`,
//             i.order_date AS `Date`
//         FROM 
//             invoice i
//         JOIN 
//             invoice_details d
//         ON 
//             i.invoice_no = d.invoice_no
//         WHERE 
//             i.order_date BETWEEN ? AND ?
//     ";
    
//     $pre_stmt = $this->con->prepare($query);
//     $pre_stmt->bind_param("ss", $start_date, $end_date);
//     $pre_stmt->execute() or die($this->con->error);
//     $result = $pre_stmt->get_result();
    
//     $rows = [];
//     while ($row = $result->fetch_assoc()) {
//         $rows[] = $row;
//     }
    
//     return $rows;
// }

    public function fetch_sales(){
        $data = [];

        $query = "
            SELECT 
                i.invoice_no AS `Invoice ID`,
                d.product_name AS `Product Name`,
                d.price AS `Price`,
                d.qty AS `Quantity`,
                (d.price * d.qty) AS `Sub Total`,
                i.discount AS `Discount`,
                i.net_total AS `Net Total`,
                i.paid AS `Paid`,
                (i.paid - i.net_total) AS `Change`,
                i.payment_type AS `Payment Type`,
                i.order_date AS `Date`
            FROM 
                invoice i
            JOIN 
                invoice_details d
            ON 
                i.invoice_no = d.invoice_no
            WHERE 
                i.order_date BETWEEN ? AND ?
        ";

        if ($sql = $this->con->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
        }
       
        return $data;
    }


        // end

    }




// $obj = new Manage();
// echo "<pre>";
// print_r($obj->manageRecordWithPagination("categories", 1));
// echo $obj->deleteRecord("categories","cid", 29);
//print_r($obj->getSingleRecord("categories","cid",1));
// echo $obj->update_record("categories", ["cid" => 1], ["parent_cat" => 0, "category_name" => "Electro", "status" => 1]);
?>