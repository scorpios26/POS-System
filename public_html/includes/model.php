<?php 
class Model
{
    private $con;

    function __construct()
    {
        include_once("../database/db.php");
        $db = new Database();
        $this->con = $db->connect();
    }

    public function fetch_sales($start_date = null, $end_date = null){
        $data = [];
    
        // Base query
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
        ";
        
        // Append condition if dates are provided
        if ($start_date && $end_date) {
            // Adjusting the condition to include the entire day when start_date and end_date are the same
            if ($start_date === $end_date) {
                $query .= " WHERE DATE(i.order_date) = ?";
            } else {
                $query .= " WHERE i.order_date BETWEEN ? AND ?";
            }
        }
    
        // Prepare the statement
        if ($stmt = $this->con->prepare($query)) {
            // Bind parameters if dates are provided
            if ($start_date && $end_date) {
                if ($start_date === $end_date) {
                    $stmt->bind_param('s', $start_date); // Bind single parameter for the same date
                } else {
                    $stmt->bind_param('ss', $start_date, $end_date); // Bind both parameters for range
                }
            }
            $stmt->execute();
            $result = $stmt->get_result();
            
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            
            $stmt->close();  // Close the statement
        }
    
        return $data;
    }
}
?>
