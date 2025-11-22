@extends('layouts.admin')
@section('title', 'Admin Dashboard')
@section('admin_layout')
<script src="{{asset('assets/backend/js/Chart.js')}}"></script>

<div class="row g-2 g-3 mb-3">
    <div class=" col-lg-3 col-md-6 col-sm-6">
        <div class="ol-card card-hover">
            <div class="ol-card-body px-20px py-3">
                <p class="sub-title fs-14px mb-2">All User</p>
                <p class="title card-title-hover fs-18px"></p>
            </div>
        </div>
    </div>
  
    <div class= " col-lg-3 col-md-6 col-sm-6" >
        <div class="ol-card card-hover">
            <div class="ol-card-body px-20px py-3">
                
                <p class="sub-title fs-14px mb-2"></p>
            </div>
        </div>
    </div>
</div>



    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
        <div class="ol-card h-100">
            <div class="ol-card-body p-4">
                <div class="chart-sm-item d-flex g-14px align-items-end justify-content-between">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-12">
        <div class="ol-card h-100">
            <div class="ol-card-body p-4">
                <canvas id="myCharts" class="w-100"></canvas>
            </div>
        </div>
    </div>
</div>



@endsection