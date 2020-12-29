@extends('admin.layouts.master')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <span id="form_result"></span>
    <div class="row">        
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h3 class="m-0 font-weight-bold text-primary">Categories</h3>
                    <h6 class="m-0 font-weight-bold text-primary">           
                        <button type="button" class="btn btn-rounded btn-secondary" id="showModal">Add New Category</button>
                    </h6>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="categoryTable">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Banner</th>
                                <th>Icon</th>
                                <th>Featured</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        
                    </table>
                </div>
            </div>
        </div>   
    </div>  
</div>

<div class="modal fade" id="catModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelHeading"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @include('admin.category.form')
        </div>
    </div>
</div>

@include('admin.category.delete')


@endsection

@section('scripts')
<script type="text/javascript">

$('document').ready(function () {
    loader();

    var table = $('#categoryTable').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 25,
        ajax: "{{ route('Category.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'banner', name: 'banner'},
            {data: 'icon', name: 'icon'},
            {data: 'featured', name: 'featured'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    setTimeout(function(){
        loaderclose();
    }, 1000);

    $(document).on('change', '.featured', function(){

        var id = $(this).attr("id");
        $.ajax({
            url: "{{url('admin/category/featured')}}/"+id,
            method:'get',
            dataType:'json',
            success:function(data){
                $('#categoryTable').DataTable().ajax.reload();
            }
        });
    });

    $( "#showModal" ).click(function(){
        $('#saveBtn').val("create-unit");
        $('#cat_id').val('');
        $('#brandForm').trigger("reset");
        $('#modelHeading').html("Add Category");
        $('#catModal').modal('show');
    });

    $('#catForm').submit(function (e) {
        e.preventDefault();
    
        $.ajax({
            data: new FormData(this),
            url: "{{ route('Category.store') }}",
            cache: false,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            dataType: 'json',
            success: function (data) {
                if(data.errors){
                    //
                    html = '<div class="alert alert-danger alert-dismissible fade show">';
                    for(var count = 0; count < data.errors.length; count++){
                        html += '<p>' + data.errors[count] + '</p>'; 
                    }
                    html += '</div>';
                    $('#validate').html(html);    
                }else{
                    //
                    $('#catForm').trigger("reset");
                    $('#catModal').modal('hide');
                    table.draw();
                    
                    html = '<div class="alert alert-success alert-dismissible" id="form_result2">' + data.success + '</div>';
                    $('#form_result').html(html);

                    setTimeout(function() {
                        $('#form_result').fadeOut('fast');
                    }, 5000); 
                }
              

            },
            error: function (data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save');
            }
        });
    });

    $('body').on('click', '.edit', function () {
        var cat_id = $(this).data('id');
	    $.get("{{ route('Category.index') }}" +'/' + cat_id +'/edit', function (data) {
	        $('#modelHeading').html("Update Brand");
	        $('#saveBtn').val("edit-cat");
	        $('#cat_id').val(data.id);
            $('#name').val(data.name);
            $('#meta_description').val(data.meta_description);
            $('#meta_title').val(data.meta_title);
            $('#catModal').modal('show'); 
	    })
    });

    $(document).on('click', '.delete', function(){
        var id = $(this).data('id');
        $("#cat_id").val(id);
        $('#confirmModal').modal('show');
    }); 

    $('body').on('click', '#ok', function () {
        var cat_id = $("#cat_id").val();

        $.ajax({
            type: "DELETE",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('Category.store') }}"+'/'+cat_id,
            success: function (data) {
                
                $('#confirmModal').modal('hide');
                $('#categoryTable').DataTable().ajax.reload();
                
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

});

</script>
@endsection
