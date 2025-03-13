$(document).ready(function(){
    var DOMAIN = "http://localhost/inventory_system/public_html/";

    $(function() {
        $("#start_date").datepicker({
            "dateFormat": "yy-mm-dd",
        });
        $("#end_date").datepicker({
            "dateFormat": "yy-mm-dd",
        });
    });

    function fetch_sales(start_date, end_date){
        $.ajax({
            url: DOMAIN + "/includes/records.php",
            type: "POST",
            data: {
                start_date: start_date, 
                end_date: end_date       
            },
            dataType: "json",
            success: function(data){
                $('#records').DataTable({
                    "data": data.data,
                    //buttons
                    layout: {
                        top: {
                            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                        }
                    },
                    destroy: true, // Destroy the old table to replace with new data
                    columns: [
                        { data: 'Invoice ID' },
                        { data: 'Product Name' },
                        { data: 'Price' },
                        { data: 'Quantity' },
                        { data: 'Sub Total' },
                        { data: 'Discount' },
                        { data: 'Net Total' },
                        { data: 'Paid' },
                        { data: 'Change' },
                        { data: 'Payment Type' },
                        { data: 'Date' }
                    ]
                });
                console.log(data);  // Display the result in the console
                // Display total sales with commas
                $('#total_sales').text('Total Sales: ₱' + Number(data.total_sales).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2}));

            },
            error: function(xhr, status, error){
                console.log("Error: " + error);
            }
        });
    }

    // Call fetch_sales with hardcoded dates initially
    fetch_sales(null, null);

    $(document).on("click", "#filter", function(e){
        e.preventDefault();

        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();

        if (start_date == "" || end_date == "") {
            alert("Both start and end dates are required.");
        } else {
            fetch_sales(start_date, end_date);
        }
    });

    // Reset

    $(document).on("click", "#reset", function(e) {
        e.preventDefault();

        $("#start_date").val(''); // empty value
        $("#end_date").val('');

        $('#records').DataTable().destroy();
        fetch_sales();
    });
});
