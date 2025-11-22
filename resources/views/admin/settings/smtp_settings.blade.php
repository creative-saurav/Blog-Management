@extends('layouts.admin')
@section('title', get_phrase('SMTP  Settings'))
@section('admin_layout')

<div class="ol-card radius-8px">
    <div class="ol-card-body my-2 py-20px px-20px">
        <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap flex-md-nowrap">
            <h4 class="title fs-16px">
                <i class="fi-rr-settings-sliders me-2"></i>
                {{ get_phrase('SMTP Settings') }}
            </h4>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-sm-6">
        <div class="ol-card">
            <div class="ol-card-body p-3 py-4">
                <form action="{{route('admin.smtp_settings.update')}}" method="post" enctype="multipart/form-data\">
                    @csrf
                    <div class="mb-3">
                        <label for="smtp_protocol" class="form-label ol-form-label"> {{get_phrase('Protocol (smtp or ssmtp or mail)* ')}}* </label>
                        <input type="text" class="form-control ol-form-control" name="smtp_protocol" id="smtp_protocol" value="{{ get_settings('smtp_protocol') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="smtp_crypto" class="form-label ol-form-label"> {{get_phrase('Smtp crypto (ssl or tls)* ')}}* </label>
                        <input type="text" class="form-control ol-form-control" name="smtp_crypto" id="smtp_crypto" value="{{ get_settings('smtp_crypto') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="smtp_host" class="form-label ol-form-label"> {{get_phrase('Smtp Host* ')}}* </label>
                        <input type="text" class="form-control ol-form-control" name="smtp_host" id="smtp_host" value="{{ get_settings('smtp_host') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="smtp_port" class="form-label ol-form-label"> {{get_phrase('Smtp Port* ')}}* </label>
                        <input type="text" class="form-control ol-form-control" name="smtp_port" id="smtp_port" value="{{ get_settings('smtp_port') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="smtp_username" class="form-label ol-form-label"> {{get_phrase('Smtp Username* ')}}* </label>
                        <input type="text" class="form-control ol-form-control" name="smtp_username" id="smtp_username" value="{{ get_settings('smtp_username') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="smtp_password" class="form-label ol-form-label"> {{get_phrase('Smtp Password* ')}}* </label>
                        <input type="text" class="form-control ol-form-control" name="smtp_password" id="smtp_password" value="{{ get_settings('smtp_password') }}" required>
                    </div>
                    <button type="submit" class="btn ol-btn-primary fs-14px"> {{get_phrase('Update')}} </button>
                </form>
            </div>
        </div>
       
    </div>
</div>

@endsection