<form action="{{route('admin.subscription.update', ['id' => $edit->id])}}"  method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label ol-form-label">{{get_phrase('Package Title')}}</label>
        <input type="text" class="form-control ol-form-control" id="title" name="title" value="{{$edit->title}}" placeholder="{{get_phrase('Enter package title')}}" required>
    </div>
        <div class="mb-3">
            <label class="form-label ol-form-label">{{get_phrase('Pricing type')}}</label>
            <div class="ol-radio-wrap d-flex flex-wrap">
                <div class="form-check form-check-radio">
                    <input class="form-check-input form-check-input-radio" type="radio" name="package_type" id="paid" value="paid" @if($edit->package_type == 'paid') checked @endif>
                    <label class="form-check-label form-check-label-radio" for="paid">
                        {{get_phrase('Paid')}}
                    </label>
                </div>
                <div class="form-check form-check-radio">
                    <input class="form-check-input form-check-input-radio" type="radio" name="package_type" id="free" value="free" @if($edit->package_type == 'free') checked @endif>
                    <label class="form-check-label form-check-label-radio" for="free">
                        {{get_phrase('Free')}}
                    </label>
                </div>
            </div>                           
        </div>

        <div class="packagePaid">
            <div class="mb-3">
                <label for="period" class="form-label ol-form-label">{{get_phrase('Package Period')}}</label>
                <select class="ol-select2" name='period' data-minimum-results-for-search="Infinity">
                    <option disabled selected>{{get_phrase('Select a period')}}</option>
                    <option value="Monthly" @if($edit->period == 'Monthly') selected @endif>{{get_phrase('Monthly')}}</option>
                    <option value="Half-yearly" @if($edit->period == 'Half-yearly') selected @endif>{{get_phrase('Half Yearly')}}</option>
                    <option value="Yearly" @if($edit->period == 'Yearly') selected @endif>{{get_phrase('Yearly')}}</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label ol-form-label">{{get_phrase('Package Price')}}</label>
                <input type="text" class="form-control ol-form-control" id="price" name="price" value="{{$edit->price}}" placeholder="{{get_phrase('Enter package price')}}">
            </div>
        </div>

      <div class="mb-3">
        <label for="summary" class="form-label ol-form-label">{{get_phrase('Package Short Summary')}}</label>
        <textarea class="form-control ol-form-textarea" name="short_description" id="summary" placeholder="here">{{$edit->short_description}}</textarea>
    </div>
     <div class="mb-3">
        <label for="tag" class="form-label ol-form-label">{{get_phrase('Blog Count')}}</label>
        <input type="text" class="form-control ol-form-control" name="blog_count" value="{{$edit->blog_count}}"  placeholder="{{get_phrase('Enter Number of blogs')}}" required>
    </div>
     <div class="mb-3">
        <label for="status" class="form-label ol-form-label">{{get_phrase('Status')}}</label>
        <select class="ol-select2" name='status' data-minimum-results-for-search="Infinity" required>
            <option disabled>{{get_phrase('Select a Status')}}</option>
            <option value="1" @if($edit->status == 1) selected @endif>{{get_phrase('Active')}}</option>
            <option value="0" @if($edit->status == 0) selected @endif>{{get_phrase('Deactive')}}</option>
        </select>
    </div>
     <div class="mb-3">
        <label for="image" class="form-label ol-form-label">{{get_phrase('Package Image')}}</label>
        <input type="file" name="image" class="form-control ol-form-control" id="image">
    </div>

     <button  type="submit" class="btn ol-btn-primary">{{get_phrase('Create')}}</button>
</form>

<script>
    "use strict";
    $(document).ready(function() {
        $('.ol-select2').select2({
            dropdownParent: $('#edit-modal')
        });
    });
</script>

<script> 
    "use strict";
    $("#submit-btn").on('click', function() {
        event.preventDefault(); 
        var title = $("#title").val();
        if(!title){
            warning('Package Title  is required');
        }
        if(title){
            $("#form-action").trigger('submit');
        }
    });

    $(document).ready(function () {
    function togglePackageDiv() {
        if ($('#paid').is(':checked')) {
            $('.packagePaid').show();
            $('.packagePaid').find('input, select').attr('required', true); 
        } else {
            $('.packagePaid').hide();
            $('.packagePaid').find('input, select').removeAttr('required'); 
        }
    }

    // On page load
    togglePackageDiv();

    // On radio change
    $('input[name="package_type"]').on('change', function () {
        togglePackageDiv();
    });
});

</script>