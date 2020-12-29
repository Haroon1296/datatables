<!-- DELETE MODAL -->
<div id="confirmModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Confirmation </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open([ 'class' => 'form-horizontal form-bordered', 'id' => 'deleteform']) !!}
                
                <h5 class="text-center" id="msg" style="margin: 0;"> Are you sure you want to remove data? </h5>

            </div>
            <div class="modal-footer">
                <input type="button" name="ok" id="ok" class="btn btn-danger" value="OK">
                <input type="hidden" name="cat_id" id="cat_id"> @csrf {!! Form::close() !!}
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>