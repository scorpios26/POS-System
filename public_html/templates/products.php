 <!-- Modal -->
 <div class="modal fade" id="form_products" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Products</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <div id="loading" style="display:none;">Loading...</div>
        <form class="row g-3" id="product_form" onsubmit=" return false">
            <div class="col-md-6">
                <label for="added_date" class="form-label">Date</label>
                <input type="text" class="form-control" name="added_date" id="added_date" value="<?php echo date("Y-m-d"); ?>" readonly>
            </div>
            <div class="col-md-6">
                <label for="product_name" class="form-label">Product Name</label>
                <input type="text" class="form-control" name="product_name" class="product_name" id="product_name" placeholder="Enter Product Name">
                <small id="prod_error" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="category_name" class="form-label">Category</label>
                <select class="form-control" name="select_cat" id="select_cat" required>


                </select>
            </div>
            <div class="form-group">
                <label for="brand_name" class="form-label">Brand</label>
                <select class="form-control" name="select_brand" id="select_brand" required>
 

                </select>
            </div>
            <div class="form-group">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="text" class="form-control" id="product_price" name="product_price">
            </div>
            <div class="form-group">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="text" class="form-control" id="product_qty" name="product_qty">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-success">Add Product</button>
            </div>
        </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>