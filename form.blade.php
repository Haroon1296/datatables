{!! Form::open(['id' => 'catForm', 'name' => 'catForm', 'files' => true]) !!}
    <div class="modal-body">
    <span id="validate"></span>
        <input type="hidden" name="cat_id" id="cat_id">
        <div class="form-group">
            <label>Name</label> <span id="required-field">*</span>
            <input type="text" id="name" class="form-control" name="name" placeholder="Category Name">
        </div>

        <div class="form-group">
            <label>Meta Title</label>
            <input type="text" id="meta_title" class="form-control" name="meta_title" placeholder="Meta Title">
        </div>

        <div class="form-group">
            <label>Icon</label>
            <input type="file" id="icon" class="form-control" name="file">
        </div>

        <div class="form-group">
            <label>Banner</label>
            <input type="file" name="banner" class="form-control">
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" id="meta_description" name="meta_description" rows="2" placeholder="Description"></textarea>
        </div>

    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
{!! Form::close() !!}
 