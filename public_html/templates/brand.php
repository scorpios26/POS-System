 <!-- Modal -->
 <div class="modal fade" id="form_brand" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Brand</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form id="brand_form" onsubmit="return false">
            <div class="form-group">
                <label>Brand Name</label>
                <input type="text" class="form-control" name="brand_name" id="brand_name">
                <small id="brand_error" class="form-text text-muted"></small>
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