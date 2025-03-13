$(document).ready(function(){
    var DOMAIN = "http://localhost/inventory_system/public_html/";

    function formatDateTime(date) {
        var year = date.getFullYear();
        var month = String(date.getMonth() + 1).padStart(2, '0');
        var day = String(date.getDate()).padStart(2, '0');
        var hours = String(date.getHours()).padStart(2, '0');
        var minutes = String(date.getMinutes()).padStart(2, '0');
        return `${year}-${month}-${day}T${hours}:${minutes}`;
    }

    var now = new Date();
    $("#order_date").val(formatDateTime(now));

    addNewRow();

    $("#add").click(function(){
        addNewRow();
    });

    
    // Function to add a new row
    function addNewRow(){
        $.ajax({
            url : DOMAIN + "/includes/process.php",
            method : "POST",
            data : {getNewOrderItem:1},
            success : function(data){
                $("#invoice_item").append(data);
                
                var n = 0;
                $(".number").each(function(){
                    $(this).html(++n);
                });

                $('.select2').select2({
                    width: '100%',
                });
                

               
            }
        });
    }

    $("#remove").click(function(){
        $("#invoice_item").children("tr:last").remove();
        calculate(0,0);
    })

    // Handle change event for product selection
    $("#invoice_item").on("change", ".pid", function() {
        var pid = $(this).val();
        var tr = $(this).closest('tr');
        $(".overlay").show();

        $.ajax({
            url: "http://localhost/inventory_system/public_html/includes/process.php",
            method: "POST",
            dataType: "json",
            data: { getPriceAndQty: 1, id: pid },
            success: function(data) {
                tr.find(".tqty").val(data["product_stock"]);
                tr.find(".pro_name").val(data["product_name"]);
                tr.find(".qty").val(1);
                tr.find(".price").val(data["product_price"]);
                tr.find(".amt").html(tr.find(".qty").val() * tr.find(".price").val());
                calculate(0, 0);
            }
        });
    });

    $("#invoice_item").delegate(".qty","keyup", function(){
        var qty = $(this);
        var tr = $(this).parent().parent();
        if (isNaN(qty.val())) {
            alert("Please Enter Valid Quantity");
            qty.val(1);
        } else {
            if (qty.val() - 0 > (tr.find(".tqty").val() - 0)) {
                alert("Sorry! This much of quantity is not available");
                qty.val(1);
            } else {
                tr.find(".amt").html(qty.val() * tr.find(".price").val());
                calculate(0,0);
            }
        }
    });

    // Function to calculate subtotal
    function calculate(dis, paid) {
        var sub_total = 0;
        var vatable_sales = 0;
        var vat = 0;
        var net_total = 0;
        var discount = dis;
        var paid_amt = paid;
        var due = 0;

        $(".amt").each(function() {
            sub_total += $(this).html() * 1;
        });
        vatable_sales = sub_total / 1.12;
        vat = vatable_sales * 0.12;
        net_total = vatable_sales + vat;


        // Calculate discount based on selected type
        if (discount > 0) {
            var discountAmount = (sub_total * (discount / 100)); // Apply discount percentage
            net_total -= discountAmount; // Subtract the discount from the net total
        }
        due = paid_amt - net_total;

        sub_total = sub_total.toFixed(2);
        vatable_sales = vatable_sales.toFixed(2);
        vat = vat.toFixed(2);
        net_total = net_total.toFixed(2);
        due = due.toFixed(2);

        $("#vat").val(vat);
        $("#sub_total").val(sub_total);
        $("#vatable_sales").val(vatable_sales);
        $("#discount").val(discount);
        $("#net_total").val(net_total);
        $("#due").val(due);
    }   

    $("#discount").on('change', function() {
        var discount = $(this).val();
        var paid = $("#paid").val();
        calculate(discount, paid);
    });

    $("#paid").on('keyup', function() {
        var paid = $(this).val();
        var discount = $("#discount").val();
        calculate(discount, paid);
    });


// ---------------------ORDER ACCEPTING -----------------------------

$(document).ready(function() {
    var now = new Date();
    var formattedDate = now.getFullYear() + "-" +
        ("0" + (now.getMonth() + 1)).slice(-2) + "-" +
        ("0" + now.getDate()).slice(-2) + "T" +
        ("0" + now.getHours()).slice(-2) + ":" +
        ("0" + now.getMinutes()).slice(-2);
    $("#order_date").val(formattedDate);
});

$("#order_form").click(function(event) {
    event.preventDefault(); // Prevent form submission for now

    // Retrieve current discount and paid values before submission
    var discount = $("#discount").val();
    var paid = $("#paid").val();

    // Call calculate before submitting to ensure fresh values
    calculate(discount, paid);

    var invoice = $("#get_order_data").serialize();

    if ($("#paid").val() === "") {
        alert("Please Enter Paid Amount");
    } else {
        $.ajax({
            url: DOMAIN + "/includes/process.php", // Ensure your process.php handles creating the order
            method: "POST",
            data: $("#get_order_data").serialize(),
            success: function(data) {
                if (data < 0) {
                    alert(data);
                } else {
                    // Reset form and select2 elements after successful order
                    $("#get_order_data").trigger("reset");
                    $('.select2').val(null).trigger('change');

                    // var now = new Date();
                    // var formattedDate = now.getFullYear() + "-" +
                    //     ("0" + (now.getMonth() + 1)).slice(-2) + "-" +
                    //     ("0" + now.getDate()).slice(-2) + "T" +
                    //     ("0" + now.getHours()).slice(-2) + ":" +
                    //     ("0" + now.getMinutes()).slice(-2);
                    // $("#order_date").val(formattedDate);  // Assuming your datetime input has id 'order_date'


                    // SweetAlert confirmation
                    Swal.fire({
                        title: 'Do you want to print the invoice?',
                        text: "The invoice is ready to print.",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, print it!',
                        cancelButtonText: 'No, cancel',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // If user clicks 'Yes', open the invoice in a new window for printing
                            $("#get_order_data").trigger("reset");
                            $('.select2').val(null).trigger('change');
                    
                            var now = new Date();
                            var formattedDate = now.getFullYear() + "-" +
                                ("0" + (now.getMonth() + 1)).slice(-2) + "-" +
                                ("0" + now.getDate()).slice(-2) + "T" +
                                ("0" + now.getHours()).slice(-2) + ":" +
                                ("0" + now.getMinutes()).slice(-2);
                            $("#order_date").val(formattedDate);  // Assuming your datetime input has id 'order_date'

                            window.open(DOMAIN + "/includes/invoice_bill.php?invoice_no=" + data + "&" + invoice);
                        } else {
                            // User clicked 'No', show a success message without resetting the form or generating PDF
                            // Swal.fire({
                            //     title: 'Order Completed!',
                            //     text: 'Your order has been successfully completed.',
                            //     icon: 'success',
                            //     confirmButtonText: 'OK',
                            // });

                            // No form reset or PDF generation here
                        }
                    });
                }
            }
        });
    }
});

});
