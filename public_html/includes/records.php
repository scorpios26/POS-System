<?php 
include 'model.php';

$model = new Model();

// Capture the start_date and end_date from the POST request
$start_date = isset($_POST['start_date']) ? $_POST['start_date'] : null;
$end_date = isset($_POST['end_date']) ? $_POST['end_date'] : null;

// Call the fetch_sales method with the captured dates
$rows = $model->fetch_sales($start_date, $end_date);

// Initialize total sales to 0 and an array to track unique invoices
$total_sales = 0;
$unique_invoices = [];

// Loop through rows to sum the net total for unique invoices
foreach ($rows as $row) {
    $invoice_id = $row['Invoice ID'];

    // Check if the invoice ID is not already in the unique invoices array
    if (!isset($unique_invoices[$invoice_id])) {
        $unique_invoices[$invoice_id] = true; // Mark this invoice as counted
        $total_sales += (float)$row['Net Total']; // Add net total for this unique invoice
    }
}

// Prepare the response with sales data and total sales
$response = [
    "data" => $rows,          // Sales data for the table
    "total_sales" => $total_sales  // Total sales value for unique invoices
];

echo json_encode($response);

?>  
