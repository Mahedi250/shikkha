@extends('backEnd.master')
@section('title')
@lang('lang.api') @lang('lang.access')
@endsection
@section('mainContent')
    <style type="text/css">
        #selectStaffsDiv, .forStudentWrapper {
            display: none;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background: linear-gradient(339deg, rgba(255,255,255,1) 0%, rgba(46,198,245,1) 58%, rgba(0,212,255,1) 100%);
        }

        input:focus + .slider {
            box-shadow: 0 0 1px linear-gradient(339deg, rgba(255,255,255,1) 0%, rgba(46,198,245,1) 58%, rgba(0,212,255,1) 100%);
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>@lang('lang.api') @lang('lang.access')</h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                    <a href="#">@lang('lang.system_settings')</a>
                    <a href="#">@lang('lang.api') @lang('lang.access')</a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30">
                                @lang('lang.api') @lang('lang.access')
                            </h3>
                        </div>
                        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'background-settings-update', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                        <div class="white-box">
                                @if(session()->has('message-success'))
                                    <div class="alert alert-success">
                                        @lang('lang.inserted_message')
                                    </div>
                                @elseif(session()->has('message-danger'))
                                    <div class="alert alert-danger">
                                        @lang('lang.error_message')
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="d-flex align-items-center justify-content-center">

                                            <span style="font-size: 22px; padding-right: 15px;">@lang('lang.enable') @lang('lang.api') @lang('lang.access') </span>
                                             @php
                                                if(@$value->staff_user->access_status == 0){
                                                        $permission_id=483;
                                                }else{
                                                        $permission_id=484;
                                                }
                                            @endphp
                                            @if(userPermission($permission_id))
                                            <label class="switch">
                                                <input type="checkbox"
                                                       class="switch-input2" {{@$settings->api_url == 0? '':'checked'}}>
                                                <span class="slider round"></span>
                                            </label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="mt-20">
        <div class="white-box">
            <form action="{{route('set_fcm_key')}}" method="post">
                @csrf
                <div class="col-lg-12 d-flex">

                    {{-- <div class="col-lg-6">sfsd</div>
                    <div class="col-lg-6">fsdfds</div> --}}
                <div class="col-lg-6 mb-20">
                            <div class="input-effect ">
                                <input  class="primary-input form-control{{ $errors->has('fcm_key') ? ' is-invalid' : '' }}"
                                       type="text" name="fcm_key" value="{{env('FCM_SECRET_KEY')}}">
                                <label>@lang('lang.fcm_key') <span>*</span></label>
                                <span class="focus-border"></span>
                                @if ($errors->has('fcm_key'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('fcm_key') }}</strong>
                                        </span>
                                @endif
                            </div>
                </div>
            
                <div class="col-lg-4 mt-10">
                    <button type="submit" class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="">
                        <span class="ti-check"></span>
                        @lang('lang.save') @lang('lang.fcm_key')
                    </button>
                </div>
            </div>
        </form>
        </div>
    </div>
    </section>
@endsection
