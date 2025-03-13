 <!-- Modal -->
 <div class="modal fade" id="form_category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Category</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form id="category_form" onsubmit="return false">
            <div class="form-group">
                <label>Category Name</label>
                <input type="hidden" name="cid" value="">
                <input type="text" class="form-control" name="category_name" id="category_name">
                <small id="cat_error" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" class="form-label">Parent Category</label>
                <select class="form-control" name="parent_cat" id="parent_cat">
                    
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Add</button>
        </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>