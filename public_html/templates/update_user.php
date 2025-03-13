 <!-- Modal -->
 <div class="modal fade" id="form_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">User</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form id="update_user_form" onsubmit="return false">
            <div class="form-group">
                <label>User Name</label>
                <input type="hidden" name="id" id="id" value="">
                <input type="text" class="form-control" name="update_username" id="update_username">
                <small id="user_error" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="update_email" id="update_email">
                <small id="email_error" class="form-text text-muted"></small>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update User</button>
        </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>