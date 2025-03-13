    $(document).ready(function(){
        var DOMAIN = "http://localhost/inventory_system/public_html/";
       $("#register_form").on("submit", function(){
        var status = false;
        var name = $("#username");
        var email = $("#email");
        var pass1 = $("#password1");
        var pass2 = $("#password2");
        var type = $("#usertype");
        
        var e_patt = new RegExp(/^[a-z0-9_-]+(\.[a-z0-9_-])*@[a-z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2,4})$/)
        if(name.val() == "" || name.val().length < 6 ){
            name.addClass("border-danger");
            $("#u_error").html("<span class='text-danger'>Please enter Name & Name should be 6 characters</span>");
            status = false;
        }else{
            name.removeClass("border-danger");
            $("#u_error").html("");
            status = true;
        }
        if(!e_patt.test(email.val())){
            email.addClass("border-danger");
            $("#e_error").html("<span class='text-danger'>Please enter valid Email</span>");
            status = false;
        }else{
            email.removeClass("border-danger");
            $("#e_error").html("");
            status = true;
        }
        if(pass1.val() == "" || pass1.val().length < 9){
            pass1.addClass("border-danger");
            $("#p1_error").html("<span class='text-danger'>Please enter more than 9 digit password</span>");
            status = false;
        }else{
            pass1.removeClass("border-danger");
            $("#p1_error").html("");
            status = true;
        }
        if(pass2.val() == "" || pass2.val().length < 9){
            pass2.addClass("border-danger");
            $("#p2_error").html("<span class='text-danger'>Please enter more than 9 digit password</span>");
            status = false;
        }else{
            pass2.removeClass("border-danger");
            $("#p2_error").html("");
            status = true;
        }
        if(type.val() == ""){
            type.addClass("border-danger");
            $("#t_error").html("<span class='text-danger'>Please choose usertype</span>");
            status = false;
        }else{
            type.removeClass("border-danger");
            $("#t_error").html("");
            status = true;
        }
        if ((pass1.val() == pass2.val()) && status == true){
            $(".overlay").show();
            $.ajax({
                url : DOMAIN+"/includes/process.php",
                method : "POST",
                data : $("#register_form").serialize(),
                success : function(data){
                    if (data == "EMAIL_ALREADY_EXIST") {
                        $(".overlay").hide();
                        alert("It seems like your email is already used");
                    }else if(data == "SOME_ERROR"){
                        $(".overlay").hide();
                        alert("Something Wrong");
                    }else{
                        Swal.fire({
                            title: "New User Added Successfully ",
                            text: "Redirecting to Dashboard",
                            icon: "success",
                        }).then(() => {
                            $(".overlay").hide();
                            window.location.href = encodeURI(DOMAIN+"index.php?msg=New user registered & you can login");
                        });
                        
                    }
                }
            })
        }else{
            pass2.addClass("border-danger");
            $("#p2_error").html("<span class='text-danger'>Password is not mmatched</span>");
            status = true;
        }
        
       })

       //For Login Part
       $("#login_form").on("submit", function(){
        var email = $("#log_email");
        var pass = $("#log_password");
        var status = false;
        if (email.val() == "") {
            email.addClass("border-danger");
            $("#e_error").html("<span class='text-danger'>Please Enter Email Address</span>");
            status = false;
        } else {
            email.removeClass("border-danger");
            $("#e_error").html("");
            status = true;
        }
        if (pass.val() == "") {
            pass.addClass("border-danger");
            $("#p_error").html("<span class='text-danger'>Please Enter Password</span>");
            status = false;
        } else {
            pass.removeClass("border-danger");
            $("#p_error").html("");
            status = true;
        }
        if (status) {
            $(".overlay").show();
            $.ajax({
                url : DOMAIN+"/includes/process.php",
                method : "POST",
                data : $("#login_form").serialize(),
                success : function(data){
                    if (data == "NOT_REGISTERED") {
                        $(".overlay").hide();
                        email.addClass("border-danger");
                        $("#e_error").html("<span class='text-danger'>Seems like you are not registered</span>");
                    }else if(data == "PASSWORD_NOT_MATCHED"){
                        $(".overlay").hide();
                        pass.addClass("border-danger");
                        $("#p_error").html("<span class='text-danger'>Please Enter Correct Password</span>");
                        status = false;
                    }else{
                        let timerInterval;
                        Swal.fire({
                        title: "Login Succesfully",
                        html: "Please Wait...",
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading();
                            const timer = Swal.getPopup().querySelector("b");
                            timerInterval = setInterval(() => {
                            timer.textContent = `${Swal.getTimerLeft()}`;
                            }, 100);
                        },
                        willClose: () => {
                            clearInterval(timerInterval);
                            $(".overlay").hide();
                            console.log(data);
                            window.location.href = DOMAIN+"dashboard.php";
                        }
                        }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            console.log("I was closed by the timer");
                        }
                        });
                        // $(".overlay").hide();
                        // console.log(data);
                        // window.location.href = DOMAIN+"dashboard.php";
                    }
                }
            })
        }
        
       })

       //Fetch Category
       function fetch_category(){
            $.ajax({
                url : DOMAIN+"/includes/process.php",
                method : "POST",
                data : {getCategory:1},
                success : function(data){
                    var root = "<option value='0'>Root</option>";
                    var choose = "<option value=''>Choose Category</option>";
                    $("#parent_cat").html(root+data);
                    $("#select_cat").html(choose+data);
                }
            })
       }

       fetch_category();

       //Fetch Category
    //    function fetch_category(){
    //         $.ajax({
    //             url : DOMAIN+"/includes/process.php",
    //             method : "POST",
    //             data : {getCategory:1},
    //             success : function(data){
    //                 var root = "<option value='0'>Root</option>";
    //                 var choose = "<option value=''>Choose Category</option>";
    //                 $("#parent_cat").html(root+data);
    //                 $("#select_cat").html(choose+data);
    //             }
    //         })
    //    }

    //    fetch_category();

       //Fetch Brand
       function fetch_brand(){
        $.ajax({
            url : DOMAIN+"/includes/process.php",
            method : "POST",
            data : {getBrand:1},
            success : function(data){
                var choose = "<option value=''>Choose Brand</option>";
                $("#select_brand").html(choose+data);
            }
        })
   }

   fetch_brand();

       //ADD CATEGORY
       $("#category_form").on("submit", function(e) {
        e.preventDefault();

        if ($("#category_name").val() == "") {
            $("#category_name").addClass("border-danger");
            $("#cat_error").html("<span class='text-danger'>Please Enter Category Name</span>");
        } else {
            $("#category_name").removeClass("border-danger");
            $("#cat_error").html("");

            $.ajax({
                url: DOMAIN + "/includes/process.php",
                method: "POST",
                data: $("#category_form").serialize(),
                success: function(data) {
                    if (data == "DUPLICATE_CATEGORY"){
                        // alert("This category already exists. Please enter a different name.");
                        Swal.fire({
                            title: 'Oops...',
                            text: 'Error: This category already exists. Please enter a different name.',
                            icon: 'error',
                            confirmButtonText: 'OK',
                            
                        });
                    }else if (data == "CATEGORY_ADDED") {
                        // $("#category_name").removeClass("border-danger");
                        // alert("Category added successfully!");
                        Swal.fire({
                            title: 'Category Added Succesfully',
                            text: 'Successfully completed.',
                            icon: 'success',
                            confirmButtonText: 'OK',     
                        }).then(() => {
                            window.location.href = ""; // Redirect after success
                        });
                        // $("#category_name").val("");
                        fetch_category();
                        $('#form_category').modal('hide');
                    }else{
                        alert(data);
                    }
                }
            });
        }
    });

    //ADD BRAND
    $("#brand_form").on("submit", function(e) {
        e.preventDefault();

        if ($("#brand_name").val() == "") {
            $("#brand_name").addClass("border-danger");
            $("#brand_error").html("<span class='text-danger'>Please Enter Brand Name</span>");
        } else {
            $("#brand_name").removeClass("border-danger");
            $("#brand_error").html("");

            $.ajax({
                url: DOMAIN + "/includes/process.php",
                method: "POST",
                data: $("#brand_form").serialize(),
                success: function(data) {
                    if (data == "DUPLICATE_BRAND_NAME"){
                        // alert("This brand already exists. Please enter a different name.");
                        Swal.fire({
                            title: 'Oops...',
                            text: 'Error: This brand already exists. Please enter a different name.',
                            icon: 'error',
                            confirmButtonText: 'OK',
                            
                        });
                    }else if (data == "BRAND_NAME_ADDED") {
                        // $("#category_name").removeClass("border-danger");
                        // $("#cat_error").html("<span class='text-success'>New Brand Name Added Succesfully..!</span>");
                        // alert("Brand Name added successfully!");
                        Swal.fire({
                            title: 'Brand Name Added Succesfully',
                            text: 'Successfully completed.',
                            icon: 'success',
                            confirmButtonText: 'OK',
                            }).then(() => {
                            window.location.href = ""; // Redirect after success
                        });
                        // $("#category_name").val("");
                        fetch_brand();
                        $('#form_brand').modal('hide');
                    }else{
                        alert(data);
                    }
                }
            });
        }
    });

    // ADD PRODUCT
$("#product_form").on("submit", function(event) {
    event.preventDefault();
    
    // Basic client-side validation (you can expand this based on your form structure)
    let isValid = true;
    $("#product_form input, #product_form select").each(function() {
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
        success: function(response) {
            $("#loading").hide();  // Hide loading indicator

            if (response === "NEW_PRODUCT_ADDED") {
                // alert("New Product added successfully");
                Swal.fire({
                    title: 'New Product Added Succesfully',
                    text: 'Successfully completed.',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    }).then(() => {
                        window.location.href = ""; // Redirect after success
                    });
                // Optionally, reset the form
                $("#product_form")[0].reset();
            }else if(response === "DUPLICATE_PRODUCT_FOR_SAME_BRAND"){
                // alert("Error: A product with this name already exists for this brand.");
                Swal.fire({
                    title: 'Oops...',
                    text: 'Error: A product with this name already exists for this brand.',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    
                });
            
            } else {
                alert("Error: " + response);
                console.log(response);
            }
        },
        error: function(xhr, status, error) {
            $("#loading").hide();  // Hide loading indicator

            alert("An error occurred: " + error);
            console.log("Status: " + status);
            console.log("Error: " + error);

            // Optionally, show errors in a user-friendly manner, e.g., in a modal or a div
        }
    });
});



    })

    