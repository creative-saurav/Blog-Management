@extends('layouts.admin')
@section('title', get_phrase('Subscription Package') . ' | ' . get_phrase('Blog Management System') )
@section('admin_layout')

<div class="ol-card radius-8px">
    <div class="ol-card-body my-2 py-12px px-20px">
        <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap flex-md-nowrap">
            <h4 class="title fs-16px">
                <i class="fi-rr-settings-sliders me-2"></i>
                {{ get_phrase('Subscription Package') }}
            </h4>
            <a href="javascript:;" onclick="modal('modal-md', '{{route('admin.subscription.create')}}', '{{get_phrase('Blog Package  Create')}}')"  class="btn ol-btn-outline-secondary d-flex align-items-center cg-10px">
                <span class="fi-rr-plus"></span>
                <span> {{get_phrase('Add New Package')}} </span>
            </a>
        </div>
    </div>
</div>

<div class="ol-card mt-3">
    <div class="ol-card-body p-3">
        @if(count($packages))
        <table id="datatable" class="table nowrap w-100">
            <thead>
                <tr>
                    <th> {{get_phrase('ID')}} </th>
                    <th> {{get_phrase('Package Type')}} </th>
                    <th> {{get_phrase('Title')}} </th>
                    <th> {{get_phrase('Price')}} </th>
                    <th> {{get_phrase('Status')}} </th>
                    <th> {{get_phrase('Action')}} </th>
                </tr>
            </thead>
            <tbody>
               
                @foreach ($packages as $key=> $package)
               <tr>
                    <th scope="row" class="text-center align-middle">
                        <p class="row-number mb-0">{{++$key}}</p>
                    </th>
                    <td class="align-middle">
                        <div class="min-w-200px">
                            <p class="mb-1 capitalize">
                                 {{$package->package_type}} 
                            </p>
                        </div>
                    </td>

                    <!-- Category -->
                    <td class="align-middle">
                        <p class="mb-0"><b>{{$package->title ?? ''}}</b></p>
                        <p class="mb-0">{{get_phrase('Number of Blog Write :')}}{{$package->blog_count ?? ''}}</p>
                    </td>
                    <td class="align-middle">
                        <p class="mb-0">{{$package->price ?? '0'}}</p>
                    </td>

                    <!-- Status -->
                    <td class="align-middle print-d-none ">
                         @if($package->status == 1)
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
                                <li><a href="javascript:;" onclick="edit_modal('modal-md','{{route('admin.subscription.edit',['id'=>$package->id])}}','{{get_phrase('Update Package')}}')" class="dropdown-item fs-14px"  >{{get_phrase('Edit')}}</a></li>
                                <li><a href="javascript:;" class="dropdown-item fs-14px" onclick="delete_modal('{{route('admin.subscription.delete',['id'=>$package->id])}}')" >{{get_phrase('Delete')}}</a></li>
                                
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