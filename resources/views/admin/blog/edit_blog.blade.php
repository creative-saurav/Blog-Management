@extends('layouts.admin')
@section('title', get_phrase('Update Blog') . ' | ' . get_phrase('Blog Management System') )
@section('admin_layout')
<div class="ol-card radius-8px">
    <div class="ol-card-body my-2 py-12px px-20px">
        <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap flex-md-nowrap">
            <h4 class="title fs-16px">
                <i class="fi-rr-settings-sliders me-2"></i>
                {{ get_phrase('Update Blog') }}
            </h4>
            <a href="{{route('admin.blog')}}"   class="btn ol-btn-outline-secondary d-flex align-items-center cg-10px">
                <span class=" fi-br-arrow-alt-left"></span>
                <span> {{get_phrase('Back')}} </span>
            </a>
        </div>
    </div>
</div>

<form action="{{route('admin.blog.update', ['id' => $editBlog->id])}}"  method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label ol-form-label">{{get_phrase('Title')}}</label>
        <input type="text" class="form-control ol-form-control" id="title" name="title" value="{{$editBlog->title ?? ''}}" placeholder="{{get_phrase('Enter blog title')}}" required>
    </div>
    <div class="mb-3">
        <label for="category" class="form-label ol-form-label">{{get_phrase('Category')}}</label>
        <select class="ol-select2" name='category' data-minimum-results-for-search="Infinity" required>
            @php 
                $categories = App\Models\BlogCategory::get();
            @endphp
            <option disabled>{{get_phrase('Select a category')}}</option>
            @foreach($categories as $category)
               <option value="{{$category->id}}" @if($editBlog->category_id == $category->id) selected @endif>{{$category->name}}</option>
            @endforeach
        </select>
    </div>
      <div class="mb-3">
        <label for="summary" class="form-label ol-form-label">{{get_phrase('Summary')}}</label>
        <textarea class="form-control ol-form-textarea" name="summary" id="summary" placeholder="here">{{$editBlog->summary ?? ''}}</textarea>
    </div>
     <div class="mb-3">
        <label for="tag" class="form-label ol-form-label">{{get_phrase('Keywords')}}</label>
        <input type="text" class="form-control ol-form-control" name="tag" id="tags" value="{{$editBlog->tags ?? ''}}"  placeholder="{{get_phrase('Enter blog keywords')}}">
    </div>
 
    <div class="mb-3">
        <label for="oleditor" class="form-label ol-form-label">{{get_phrase('Description')}}</label>
        <textarea id="oleditor" name="description">{{$editBlog->description ?? ''}}</textarea>
    </div>
     <div class="mb-3">
        <label for="status" class="form-label ol-form-label">{{get_phrase('Status')}}</label>
        <select class="ol-select2" name='status' data-minimum-results-for-search="Infinity" required>
            <option>{{get_phrase('Select a Status')}}</option>
            <option value="1" @if($editBlog->status == 1) selected @endif>{{get_phrase('Active')}}</option>
            <option value="0" @if($editBlog->status == 0) selected @endif>{{get_phrase('Pending')}}</option>
        </select>
    </div>
       <div class="mb-3">
        <label for="thumbnail" class="form-label ol-form-label">{{get_phrase('Thumbnail')}}</label>
        <input type="file" name="thumbnail" value="{{$editBlog->thumbnail ?? ''}}" class="form-control ol-form-control" id="thumbnail">
    </div>
    <div class="mb-3">
        <label for="banner_image" class="form-label ol-form-label">{{get_phrase('Banner Image')}}</label>
        <input type="file" name="banner_image" value="{{$editBlog->banner_image ?? ''}}" class="form-control ol-form-control" id="banner_image">
    </div>
     <button type="submit" class="btn ol-btn-primary">{{get_phrase('Create')}}</button>
</form>
@endsection