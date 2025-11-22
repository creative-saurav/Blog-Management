<form action="{{route('admin.blog.category.store')}}" method="post" enctype="multipart/form-data" id="form-action">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label ol-form-label"> {{get_phrase('Category name')}} </label>
        <input type="text" class="form-control ol-form-control" name="name" id="name" placeholder="{{get_phrase('Enter Category Name')}}" required>
    </div>
    <button type="submit" id="submit-btn" class="btn ol-btn-primary px-4 fs-14px"> {{get_phrase('Save')}} </button>
</form>


<script> 
    "use strict";
    $("#submit-btn").on('click', function() {
        event.preventDefault(); 
        var category_name = $("#name").val();
        if(!category_name){
            warning(' Category  name is required');
        }
        if(category_name){
            $("#form-action").trigger('submit');
        }
    });
</script>