<?php 
session_start();
include_once("../fpdf/fpdf.php");

// Define the receipt size in millimeters (e.g., 80mm width x 200mm height)
$width = 80; // Width of the receipt in mm
$height = 150; // Height of the receipt in mm

if (isset($_GET["order_date"]) && isset($_GET["invoice_no"])) {
    $pdf = new FPDF('P', 'mm', array($width, $height));
    $pdf->SetMargins(5,5,5);
    $pdf->SetAutoPageBreak(false,0);
    $pdf->AddPage();

    // Set font - use a smaller font size for receipt
    $pdf->SetFont('Courier', 'B', 10); // Smaller font size for receipt

    // Center alignment for title
    $pdf->Cell(70,10, 'AJT Pharmacy', 0, 1, 'C');
    $pdf->SetFont('Courier', '', 7); // Regular font for content
    $pdf->Ln(-5); // Reduce space between sections
    $pdf->Cell(70,8, 'Antique Philippines', 0, 1, 'C');
    $pdf->Ln(-5); // Reduce space between sections
    $pdf->Cell(70,8, '033-45454-45434', 0, 1, 'C');
    $pdf->SetFont('Courier', 'B', 8); // Smaller font size for receipt
    $pdf->Ln(-3); // Reduce space between sections
    $pdf->Cell(70,10, 'Sales Invoice', 0, 1, 'C');
    
    // Set font for other content
    $pdf->SetFont('Courier', '', 7); // Adjust font size for smaller text

    // Format the order date to include AM/PM
    $orderDate = $_GET["order_date"];
    $dateTime = new DateTime($orderDate);
    $formattedDate = $dateTime->format('Y-m-d g:i A'); // 'g:i A' for 12-hour format with AM/PM
    $pdf->Ln(-2); // Reduce space between sections
    $pdf->Cell(40, 8, 'Order Date:', 0, 0);
    $pdf->Cell(0, 8, $formattedDate, 0, 1, 'R'); // Right-align the date
    $pdf->Ln(-5); // Reduce space between sections
    $pdf->Cell(40, 8, 'Customer Name.:', 0, 0);
    $pdf->Cell(0, 8, $_GET["cust_name"], 0, 1, 'R'); // Right-align the customer number
    $pdf->Ln(-5); // Reduce space between sections
    $pdf->Cell(40, 8, 'Invoice No.:', 0, 0);
    $pdf->Cell(0, 8, $_GET["invoice_no"], 0, 1, 'R'); // Right-align the invoice number
    $pdf->Ln(-5); // Reduce space between sections
    $pdf->Cell(40, 8, '==============================================', 0, 0);

    // $pdf->Cell($width, 5, '', 0, 1);
    $pdf->Ln(10); // Reduce space between sections

    // Table headers
    $pdf->SetFont('Courier', 'B', 8); // Bold font for headers
    $pdf->Ln(-5); // Reduce space between sections
    $pdf->Cell(10, 8, '#', 0, 0, 'C');
    $pdf->Cell(20, 8, 'Product Name', 0, 0, 'C');
    $pdf->Cell(10, 8, 'Qty', 0, 0, 'C'); 
    $pdf->Cell(10, 8, 'Price', 0, 0, 'C');
    $pdf->Cell(10, 8, 'Total', 0, 1, 'C');

    $pdf->SetFont('Courier', '', 7); // Regular font for content

    $totalQty = 0; // Initialize total quantity

    for ($i = 0; $i < count($_GET["pid"]); $i++) { 
        $pdf->Ln(-5); // Reduce space between sections
        $pdf->Cell(10, 8, ($i + 1), 0, 0, 'C');
        $qty = $_GET["qty"][$i];
        $pdf->Cell(20, 8, $_GET["pro_name"][$i], 0, 0, 'C'); 
        $pdf->Cell(10, 8, $_GET["qty"][$i], 0, 0, 'C'); 
        $pdf->Cell(10, 8, $_GET["price"][$i], 0, 0, 'C');
        $pdf->Cell(15, 8, ($qty * $_GET["price"][$i]), 0, 1, 'C');
        $totalQty += $qty; // Add quantity to total
    }
    $pdf->Ln(-2); // Reduce space between sections
    $pdf->Cell(40, 8, '==============================================', 0, 0);
    $pdf->Ln(10); // Reduce space before summary
    

    // Summary

    $pdf->SetFont('Courier', '', 7); // Bold font for summary
    $pdf->Ln(-5); // Reduce space between sections
    $pdf->Cell(40, 8, 'Sub Total:', 0, 0);
    $pdf->SetFont('Courier', 'B', 8); // Bold font for headers
    $pdf->Cell(0, 8, $_GET["sub_total"], 0, 1, 'R');
    $pdf->Ln(-5); // Reduce space between sections
    $pdf->SetFont('Courier', '', 7); // Bold font for summary
    $pdf->Cell(40, 8, 'Vat Sales:', 0, 0);
    $pdf->Cell(0, 8, $_GET["vatable_sales"], 0, 1, 'R');
    $pdf->Ln(-5); // Reduce space between sections
    $pdf->Cell(40, 8, 'Vat(12%):', 0, 0);
    $pdf->Cell(0, 8, $_GET["vat"], 0, 1, 'R');
    $pdf->Ln(-5); // Reduce space between sections
    $pdf->Cell(40, 8, 'Discount:', 0, 0);
    $pdf->Cell(0, 8, $_GET["discount"].'%', 0, 1, 'R');
    $pdf->Ln(-5); // Reduce space between sections
    $pdf->Cell(40, 8, 'Net Total:', 0, 0);
    $pdf->SetFont('Courier', 'B', 8); // Bold font for headers
    $pdf->Cell(0, 8, $_GET["net_total"], 0, 1, 'R');
    $pdf->Ln(-5); // Reduce space between sections
    $pdf->SetFont('Courier', '', 7); // Bold font for summary
    $pdf->Cell(40, 8, 'Paid:', 0, 0);
    $pdf->Cell(0, 8, $_GET["paid"], 0, 1, 'R'); 
    $pdf->Ln(-5); // Reduce space between sections
    $pdf->Cell(40, 8, 'Change:', 0, 0);
    $pdf->SetFont('Courier', 'B', 8); // Bold font for headers
    $pdf->Cell(0, 8, $_GET["due"], 0, 1, 'R');
    $pdf->Ln(-5); // Reduce space between sections
    $pdf->SetFont('Courier', '', 7); // Bold font for summary
    $pdf->Cell(10, 8, 'Payment Type:', 0, 0);
    $pdf->Cell(0, 8, $_GET["payment_type"], 0, 1, 'R');

    // Total Quantity
    $pdf->Cell(21, 8, 'Total Item(s):', 0, 0); 
    $pdf->Cell(0, 8, '('.$totalQty.')', 0, 1, 'L');

    // $pdf->Cell(0,10, 'Signature', 0, 1, 'R');

    $pdf->Cell(0,10, 'Thank You and Please Come Again !', 0, 1, 'C');

    // Save the PDF to a file
    $pdf->Output('../PDF_INVOICE/PDF_INVOICE_' . $_GET["invoice_no"] . '.pdf', 'F');

    // Send the PDF to the browser
    $pdf->Output();

    if (isset($_GET["create_pdf"]) && $_GET["create_pdf"] == true) {
        // Handle PDF creation here
        $pdf->Output('../PDF_INVOICE/PDF_INVOICE_' . $_GET["invoice_no"] . '.pdf', 'F');
        // Return a success response or handle any errors
        echo json_encode(['success' => true]);
        exit;
    }

    
}


?>
