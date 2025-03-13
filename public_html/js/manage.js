$(document).ready(function(){
    var DOMAIN = "http://localhost/inventory_system/public_html/";

    //--------------------------CATEGORIES-----------------------

//Manage Category
function manageCategory(pn) {
    $.ajax({
        url : DOMAIN+"/includes/process.php",
        method: "POST",
        data: {manageCategory:1,pageno:pn},
        success: function(data) {
            $("#get_category").html(data);
        }
    })
}
manageCategory(1);

    $("body").delegate(".page-link","click",function(){
        var pn = $(this).attr("pn");
        manageCategory(pn);
    })

    $("body").delegate(".del_cat","click",function(){
        var did = $(this).attr("did");
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
            $.ajax({
                url : DOMAIN+"/includes/process.php",
                method: "POST",
                data: {deleteCategory:1,id:did},
                success: function(data) {
                    if (data == "DEPENDENT_CATEGORY"){
                        Swal.fire({
                            title: "Error!",
                            text: "Sorry, you cannot delete this category! This category is dependent on other subcategories.",
                            icon: "error"
                        }); 
                    }else if (data === "DEPENDENT_PRODUCTS_EXIST") {
                        Swal.fire({
                            title: "Error!",
                            text: "Sorry, this category is associated with existing products and cannot be deleted.",
                            icon: "error"
                        });
                    }else if(data == "CATEGORY_DELETED"){
                        Swal.fire({
                            title: "Deleted!",
                            text: "Category deleted successfully.",
                            icon: "success"
                        }).then(() => {
                            manageCategory(1);
                            window.location.href = ""; // Redirect if needed
                        });
                    }else if(data == "DELETED"){
                        Swal.fire({
                            title: "Deleted!",
                            text: "Deleted successfully.",
                            icon: "success"
                        }).then(() => {
                            manageCategory(1);
                            window.location.href = ""; // Redirect if needed
                        });
                    }else{
                        Swal.fire({
                            title: "Error!",
                            text: data,
                            icon: "error"
                        });
                    }

                }
            })
        }else{

        }
    });
    });

    //Fetch Category
    function fetch_category(){
        $.ajax({
            url : DOMAIN+"/includes/process.php",
            method : "POST",
            data : {getCategory:1},
            success : function(data){
                var root = "<option value='0'>Root</option>";
                var choose = "<option value=''>Choose Category</option>"
                $("#parent_cat").html(root+data);
                $("#update_select_cat").html(choose+data);
            }
        })
   }

   fetch_category();

    //Update Category
    $("body").delegate(".edit_cat","click",function(){
        var eid = $(this).attr("eid");
        $.ajax({
            url : DOMAIN+"/includes/process.php",
            method : "POST",
            dataType : "json",
            data: {updateCategory:1,id:eid},
            success : function(data){
                console.log(data);
                $("#cid").val(data["cid"]);
                $("#update_category").val(data["category_name"]);
                $("#parent_cat").val(data["parent_cat"]);
                $("#form_category").modal("show");
            }
        })
    })

    $("#update_category_form").on("submit", function(){
        if ($("#update_category").val() == "") {
            $("#update_category").addClass("border-danger");
            $("#cat_error").html("<span class='text-danger'>Please Enter Category Name</span>");
        } else {
            $("#category_name").removeClass("border-danger");
            $("#cat_error").html("");

            $.ajax({
                url: DOMAIN + "/includes/process.php",
                method: "POST",
                data: $("#update_category_form").serialize(),
                beforeSend: function() {
                    $("#loading").show();  // Show loading indicator
                },
                success: function(data) {
                    $("#loading").hide();  // Hide loading indicator
                    if (data === "UPDATED") {
                        Swal.fire({
                            title: "Success!",
                            text: "Category Updated Successfully",
                            icon: "success",
                        }).then(() => {
                            window.location.href = ""; // Redirect after success
                        });
                    } else {
                        Swal.fire({
                            title: "Error!",
                            text: "Error: " + data,
                            icon: "error",
                        });
                    }
                },
                error: function(xhr, status, error) {
                    $("#loading").hide();  // Hide loading indicator
                    Swal.fire({
                        title: "An error occurred!",
                        text: "Error: " + error,
                        icon: "error",
                    });
                    console.log("Status: " + status);
                    console.log("Error: " + error);
                }
            });
            
        }
    })

    //---------------------------------BRAND-----------------------------

    //Fetch Brand
    function fetch_brand(){
        $.ajax({
            url : DOMAIN+"/includes/process.php",
            method : "POST",
            data : {getBrand:1},
            success : function(data){
                var choose = "<option value=''>Choose Brand</option>"
                $("#update_select_brand").html(choose+data);
            }
        })
   }

   fetch_brand();

    //Manage Brand
    function manageBrand(pn) {
        $.ajax({
            url : DOMAIN+"/includes/process.php",
            method: "POST",
            data: {manageBrand:1,pageno:pn},
            success: function(data) {
                $("#get_brand").html(data);
            }
        })
    }
    manageBrand(1);

    $("body").delegate(".page-link","click",function(){
        var pn = $(this).attr("pn");
        manageBrand(pn);
    })

    $("body").delegate(".del_brand", "click", function() {
        var did = $(this).attr("did");
    
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: DOMAIN + "/includes/process.php",
                    method: "POST",
                    data: { deleteBrand: 1, id: did },
                    success: function(data) {
                        console.log("AJAX Response: ", data); // Log the response
                        if (data == "BRAND_ASSOCIATED") {
                            Swal.fire({
                                title: "Error!",
                                text: "Sorry, this brand is associated with existing products and cannot be deleted.",
                                icon: "error"
                            });
                        } else if (data == "DELETED") {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Brand has been deleted.",
                                icon: "success"
                            }).then(() => {
                                manageBrand(1); // Refresh the brand list
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: data,
                                icon: "error"
                            });
                        }
                    }
                });
            }
        });
    });
    

    //Update  Brand
    $("body").delegate(".edit_brand","click",function(){
        var eid = $(this).attr("eid");
        $.ajax({
            url : DOMAIN+"/includes/process.php",
            method : "POST",
            dataType : "json",
            data: {updateBrand:1,id:eid},
            success : function(data){
                console.log(data);
                $("#bid").val(data["bid"]);
                $("#update_brand").val(data["brand_name"]);
                $("#form_brand").modal("show");
            }
        })
    })

    $("#update_brand_form").on("submit", function(){
        if ($("#update_brand").val() == "") {
            $("#update_brand").addClass("border-danger");
            $("#brand_error").html("<span class='text-danger'>Please Enter Brand Name</span>");
        } else {
            $("#brand_name").removeClass("border-danger");
            $("#brand_error").html("");

            $.ajax({
                url: DOMAIN + "/includes/process.php",
                method: "POST",
                data: $("#update_brand_form").serialize(),
                beforeSend: function() {
                    $("#loading").show();  // Show loading indicator
                },
                success: function(data) {
                    $("#loading").hide();  // Hide loading indicator
                    if (data === "UPDATED") {
                        Swal.fire({
                            title: "Success!",
                            text: "Brand Updated Successfully",
                            icon: "success",
                        }).then(() => {
                            window.location.href = ""; // Redirect after success
                        });
                    } else {
                        Swal.fire({
                            title: "Error!",
                            text: "Error: " + data,
                            icon: "error",
                        });
                    }
                },
                error: function(xhr, status, error) {
                    $("#loading").hide();  // Hide loading indicator
                    Swal.fire({
                        title: "An error occurred!",
                        text: "Error: " + error,
                        icon: "error",
                    });
                    console.log("Status: " + status);
                    console.log("Error: " + error);
                }
            });
            
        }
    })

    //Manage Users
    function manageUsers(pn) {
        $.ajax({
            url : DOMAIN+"/includes/process.php",
            method: "POST",
            data: {manageUsers:1,pageno:pn},
            success: function(data) {
                $("#get_users").html(data);
            }
        })
    }
    manageUsers(1);

    $("body").delegate(".page-link","click",function(){
        var pn = $(this).attr("pn");
        manageUsers(pn);
    })

    $("body").delegate(".del_user", "click", function() {
        var did = $(this).attr("did");
    
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: DOMAIN + "/includes/process.php",
                    method: "POST",
                    data: { deleteUser: 1, id: did },
                    success: function(data) {
                        console.log("AJAX Response: ", data); // Log the response
                       if (data == "DELETED") {
                            Swal.fire({
                                title: "Deleted!",
                                text: "User has been deleted.",
                                icon: "success"
                            }).then(() => {
                                manageUsers(1); // Refresh the brand list
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: data,
                                icon: "error"
                            });
                        }
                    }
                });
            }
        });
    });

    function fetch_user(){
        $.ajax({
            url : DOMAIN+"/includes/process.php",
            method : "POST",
            data : {getUser:1},
            success : function(data){
                // var user_type = "<option value=''>Choose User Type</option>";
                // var choose = "<option value=''>Choose Category</option>"
                // $("#user_type").html(user_type+data);
                // $("#user_type").html(user_type+data);
            }
        })
   }

   fetch_user();
    

    //Update User
    $("body").delegate(".edit_user","click",function(){
        var eid = $(this).attr("eid");
        $.ajax({
            url : DOMAIN+"/includes/process.php",
            method : "POST",
            dataType : "json",
            data: {updateUser:1,id:eid},
            success : function(data){
                console.log(data);
                $("#id").val(data["id"]);
                $("#update_username").val(data["username"]);
                $("#update_email").val(data["email"]);
                $("#form_user").modal("show");
            }
        })
    })

    $("#update_user_form").on("submit", function(){
        if ($("#update_username").val() == "") {
            $("#update_username").addClass("border-danger");
            $("#user_error").html("<span class='text-danger'>Please Enter New User Name</span>");
        } else {
            $("#update_username").removeClass("border-danger");
            $("#user_error").html("");

            $.ajax({
                url: DOMAIN + "/includes/process.php",
                method: "POST",
                data: $("#update_user_form").serialize() + "&update_user=1",
                beforeSend: function() {
                    console.log($("#update_user_form").serialize());
                    $("#loading").show();  // Show loading indicator
                    
                },
                success: function(data) {
                    console.log("Server response:", data);
                    $("#loading").hide();  // Hide loading indicator
                    if (data === "UPDATED") {
                        Swal.fire({
                            title: "Success!",
                            text: "User Updated Successfully",
                            icon: "success",
                        }).then(() => {
                            window.location.href = ""; // Redirect after success
                        });
                    } else {
                        Swal.fire({
                            title: "Error!",
                            text: "Error: " + data,
                            icon: "error",
                        });
                    }
                },
                error: function(xhr, status, error) {
                    $("#loading").hide();  // Hide loading indicator
                    Swal.fire({
                        title: "An error occurred!",
                        text: "Error: " + error,
                        icon: "error",
                    });
                    console.log("Status: " + status);
                    console.log("Error: " + error);
                }
            });
            
        }
    })

    //---------------------PRODUCTS-------------------------

    //Manage Products
    function manageProduct(pn) {
        $.ajax({
            url : DOMAIN+"/includes/process.php",
            method: "POST",
            data: {manageProduct:1,pageno:pn},
            success: function(data) {
                $("#get_product").html(data);
            }
        })
    }
    manageProduct(1);

    $("body").delegate(".page-link","click",function(){
        var pn = $(this).attr("pn");
        manageProduct(pn);
    })

    $("body").delegate(".del_product", "click", function() {
        var did = $(this).attr("did");
    
        Swal.fire({
            title: "Are you sure you want to delete this?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                // Proceed with the AJAX request to delete the product
                $.ajax({
                    url: DOMAIN + "/includes/process.php",
                    method: "POST",
                    data: { deleteProduct: 1, id: did },
                    success: function(data) {
                        if (data == "DELETED") {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your product has been deleted.",
                                icon: "success"
                            });
                            manageProduct(1); // Refresh the product list
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: data,
                                icon: "error"
                            });
                        }
                    }
                });
            }
        });
    });

    //Update Product
    $("body").delegate(".edit_product","click",function(){
        var eid = $(this).attr("eid");
        $.ajax({
            url : DOMAIN+"/includes/process.php",
            method : "POST",
            dataType : "json",
            data: {updateProduct:1,id:eid},
            success : function(data){
                console.log(data);
                $("#pid").val(data["pid"]);
                $("#update_product").val(data["product_name"]);
                $("#update_select_cat").val(data["cid"]);
                $("#update_select_brand").val(data["bid"]);
                $("#product_price").val(data["product_price"]);
                $("#product_qty").val(data["product_stock"]);

            }
        })
    })
      // UPDATING PRODUCT
$("#update_product_form").on("submit", function(event) {
    event.preventDefault();
    
    // Basic client-side validation (you can expand this based on your form structure)
    let isValid = true;
    $("#update_product_form input, #update_product_form select").each(function() {
        if ($(this).val() === "") {
            isValid = false;
            $(this).css("border", "1px solid red"); // Highlight empty fields
        } else {
            $(this).css("border", ""); // Reset border if valid
        }
    });

    if (!isValid) {
        alert("Please fill in all required fields.");
        return;
    }

    // Show loading indicator (optional)
    $("#loading").show();  // Assuming you have an element with id 'loading'

    $.ajax({
        url: DOMAIN + "/includes/process.php",
        method: "POST",
        data: $(this).serialize(),
        beforeSend: function() {
            $("#loading").show();  // Show loading indicator
        },
        success: function(data) {
            $("#loading").hide();  // Hide loading indicator
            if (data === "UPDATED") {
                Swal.fire({
                    title: "Success!",
                    text: "Product Updated Successfully",
                    icon: "success",
                }).then(() => {
                    // Optionally, reset the form
                    $("#update_product_form")[0].reset();
                    window.location.href = "";
                });
            } else if (data === "DUPLICATE_PRODUCT_FOR_SAME_BRAND") {
                Swal.fire({
                    title: "Error!",
                    text: "A product with this name already exists for this brand.",
                    icon: "error",
                });
            } else {
                Swal.fire({
                    title: "Error!",
                    text: "Error: " + data,
                    icon: "error",
                });
                console.log(data);
            }
        },
        error: function(xhr, status, error) {
            $("#loading").hide();  // Hide loading indicator
    
            Swal.fire({
                title: "An error occurred!",
                text: "Error: " + error,
                icon: "error",
            });
            console.log("Status: " + status);
            console.log("Error: " + error);
        }
    });
    
}); 
    

})

