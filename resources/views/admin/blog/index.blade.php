@extends('layouts.admin')
@section('title', get_phrase('Blog List') . ' | ' . get_phrase('Blog Management System') )
@section('admin_layout')

<div class="ol-card radius-8px">
    <div class="ol-card-body my-2 py-12px px-20px">
        <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap flex-md-nowrap">
            <h4 class="title fs-16px">
                <i class="fi-rr-settings-sliders me-2"></i>
                {{ get_phrase('Blog') }}
            </h4>
            <a href="{{route('admin.blog.create')}}"   class="btn ol-btn-outline-secondary d-flex align-items-center cg-10px">
                <span class="fi-rr-plus"></span>
                <span> {{get_phrase('Add New Blog')}} </span>
            </a>
        </div>
    </div>
</div>

<div class="ol-card mt-3">
    <div class="ol-card-body p-3">
        @if(count($blogs))
        <table id="datatable" class="table nowrap w-100">
            <thead>
                <tr>
                    <th> {{get_phrase('ID')}} </th>
                    <th> {{get_phrase('Creator')}} </th>
                    <th> {{get_phrase('Title')}} </th>
                    <th> {{get_phrase('Category')}} </th>
                    <th> {{get_phrase('Status')}} </th>
                    <th> {{get_phrase('Action')}} </th>
                </tr>
            </thead>
            <tbody>
               
                @foreach ($blogs as $key=> $blog)
                @php 
                    $users = App\Models\User::where('id', $blog->user_id)->first();
                    $category = App\Models\BlogCategory::where('id', $blog->category_id)->first();
                @endphp
               <tr>
                    <th scope="row" class="text-center align-middle">
                        <p class="row-number mb-0">{{$key++}}</p>
                    </th>

                    <!-- Author -->
                    <td class="align-middle">
                        <div class="d-flex align-items-center gap-2 min-w-200px">
                            <img class="img-fluid rounded-circle" width="60" height="60" src="{{get_image($users->photo)}}" alt="Author">
                            <div>
                                <h4 class="title fs-14px mb-0">{{$users->name}}</h4>
                                <p class="sub-title2 text-12px mb-0">{{$users->emial}}</p>
                            </div>
                        </div>
                    </td>

                    <!-- Blog title -->
                    <td class="align-middle">
                        <div class="min-w-200px">
                            <p class="mb-1">
                                <a href="">
                                    {{$blog->title}}
                                </a>
                            </p>
                            <small class="sub-title2 text-11px"> {{ \Carbon\Carbon::parse($blog->created_at)->format('D, d-M-Y') }}</small>
                        </div>
                    </td>

                    <!-- Category -->
                    <td class="align-middle">
                        <p class="mb-0">{{$category->name ?? ''}}</p>
                    </td>

                    <!-- Status -->
                    <td class="align-middle print-d-none ">
                         @if($blog->status == 1)
                                <span class="btn btn-badge bg-success">{{ get_phrase('Active') }}</span>
                            @else
                                <span class="btn btn-badge bg-danger">{{ get_phrase('Inactive') }}</span>
                            @endif
                    </td>

                    <!-- Actions -->
                    <td class="align-middle print-d-none text-center">
                        <div class="dropdown ol-icon-dropdown ol-icon-dropdown-transparent">
                            <button class="btn ol-btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="fi-rr-menu-dots-vertical"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="{{route('admin.blog.edit',['id'=>$blog->id])}}" class="dropdown-item fs-14px"  >{{get_phrase('Edit')}}</a></li>
                                <li><a href="javascript:;" class="dropdown-item fs-14px" onclick="delete_modal('{{route('admin.blog.delete',['id'=>$blog->id])}}')" >{{get_phrase('Delete')}}</a></li>
                                
                            </ul>
                        </div>
                    </td>
                </tr>
               
                @endforeach
            </tbody>
        </table>
        @else
            @include('layouts.no_data_found')
        @endif
    </div>
</div>


@endsection