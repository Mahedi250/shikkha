@extends('backEnd.master')
@section('title') 
@lang('lang.monthly') @lang('lang.fees_collection') @lang('lang.report')
@endsection
@section('mainContent')
@php  $setting = App\SmGeneralSettings::find(1);  if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; }   @endphp 

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.monthly') @lang('lang.collection') @lang('lang.report')</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.fees_collection')</a>
                <a href="#">@lang('lang.report')</a>
                <a href="#">@lang('lang.monthly') @lang('lang.collection') @lang('lang.report')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="main-title">
                    <h3 class="mb-30">@lang('lang.select_criteria') </h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                @if(session()->has('message-success') != "")
                    @if(session()->has('message-success'))
                    <div class="alert alert-success">
                        {{ session()->get('message-success') }}
                    </div>
                    @endif
                @endif
                <div class="white-box">
                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'transaction_report_search', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student']) }}
                    <div class="row">
                        <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                        <div class="col-lg-3 mt-30-md">
                            <select class="w-100 niceSelect bb form-control {{ $errors->has('class') ? ' is-invalid' : '' }}" id="select_class" name="class">
                                <option data-display="@lang('lang.select_class') " value="">@lang('lang.select_class') *</option>
                                @foreach($classes as $class)
                                <option value="{{$class->id}}"  {{ isset($class_id)? ($class_id == $class->id? 'selected':''): (old("class") == $class->id ? "selected":"")}}>{{$class->class_name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('class'))
                            <span class="invalid-feedback invalid-select" role="alert">
                                <strong>{{ $errors->first('class') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-lg-3 mt-30-md" id="select_section_div">
                            <select class="w-100 niceSelect bb form-control{{ $errors->has('section') ? ' is-invalid' : '' }}" id="select_section" name="section">
                                <option data-display="@lang('lang.select_section') " value="">@lang('lang.select_section') *</option>
                            </select>
                            <div class="pull-right loader loader_style" id="select_section_loader">
                                <img class="loader_img_style" src="{{asset('public/backEnd/img/demo_wait.gif')}}" alt="loader">
                            </div>
                            @if ($errors->has('section'))
                            <span class="invalid-feedback invalid-select" role="alert">
                                <strong>{{ $errors->first('section') }}</strong>
                            </span>
                            @endif
                        </div>
                        @php $current_month = date('m'); @endphp
                        <div class="col-lg-3 mt-30-md">
                            <select class="w-100 niceSelect bb form-control{{ $errors->has('month') ? ' is-invalid' : '' }}" name="month">
                                <option data-display="Select Month *" value="">@lang('lang.select_month') *</option>
                                <option value="01" {{isset($month)? ($month == "01"? 'selected':''):($current_month == "01"? 'selected':'')}}>@lang('lang.january')</option>
                                <option value="02" {{isset($month)? ($month == "02"? 'selected':''):($current_month == "02"? 'selected':'')}}>@lang('lang.february')</option>
                                <option value="03" {{isset($month)? ($month == "03"? 'selected':''):($current_month == "03"? 'selected':'')}}>@lang('lang.march')</option>
                                <option value="04" {{isset($month)? ($month == "04"? 'selected':''):($current_month == "04"? 'selected':'')}}>@lang('lang.april')</option>
                                <option value="05" {{isset($month)? ($month == "05"? 'selected':''):($current_month == "05"? 'selected':'')}}>@lang('lang.may')</option>
                                <option value="06" {{isset($month)? ($month == "06"? 'selected':''):($current_month == "06"? 'selected':'')}}>@lang('lang.june')</option>
                                <option value="07" {{isset($month)? ($month == "07"? 'selected':''):($current_month == "07"? 'selected':'')}}>@lang('lang.july')</option>
                                <option value="08" {{isset($month)? ($month == "08"? 'selected':''):($current_month == "08"? 'selected':'')}}>@lang('lang.august')</option>
                                <option value="09" {{isset($month)? ($month == "09"? 'selected':''):($current_month == "09"? 'selected':'')}}>@lang('lang.september')</option>
                                <option value="10" {{isset($month)? ($month == "10"? 'selected':''):($current_month == "10"? 'selected':'')}}>@lang('lang.october')</option>
                                <option value="11" {{isset($month)? ($month == "11"? 'selected':''):($current_month == "11"? 'selected':'')}}>@lang('lang.november')</option>
                                <option value="12" {{isset($month)? ($month == "12"? 'selected':''):($current_month == "12"? 'selected':'')}}>@lang('lang.december')</option>

                            </select>
                            @if ($errors->has('month'))
                            <span class="invalid-feedback invalid-select" role="alert">
                                <strong>{{ $errors->first('month') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-lg-3 mt-30-md">
                            <select class="w-100 bb niceSelect form-control{{ $errors->has('year') ? ' is-invalid' : '' }}" name="year">
                                <option data-display="Select Year *" value="">@lang('lang.select_year') *</option>
                                @php 
                                    $current_year = date('Y');
                                    $ini = date('y');
                                    $limit = $ini + 30;
                                @endphp
                                @for($i = $ini; $i <= $limit; $i++)
                                    <option value="{{$current_year}}" {{isset($year)? ($year == $current_year? 'selected':''):(date('Y') == $current_year? 'selected':'')}}>{{$current_year--}}</option>
                                @endfor
                            </select>
                            @if ($errors->has('year'))
                            <span class="invalid-feedback invalid-select" role="alert">
                                <strong>{{ $errors->first('year') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-lg-12 mt-20 text-right">
                            <button type="submit" class="primary-btn small fix-gr-bg">
                                <span class="ti-search pr-2"></span>
                                @lang('lang.search')
                            </button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        @if(isset($fees_payments))
        <div class="row mt-40">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0">@lang('lang.fees_collection_details')</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table id="table_id_al" class="display school-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>@lang('lang.payment') @lang('lang.id')</th>
                                    <th>@lang('lang.date')</th>
                                    <th>@lang('lang.name')</th>
                                    <th>@lang('lang.class')</th>
                                    <th>@lang('lang.fees_type')</th>
                                    <th>@lang('lang.mode')</th>
                                    <th>@lang('lang.amount')</th>
                                    <th>@lang('lang.fine')</th>
                                    <th>@lang('lang.total')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $grand_amount = 0;
                                    $grand_total = 0;
                                    $grand_discount = 0;
                                    $grand_fine = 0;
                                    $total = 0;
                                @endphp
                                @foreach($fees_payments as $students)
                                    @foreach($students as $fees_payment)
                                    @php $total = 0; @endphp
                                    <tr>
                                        <td>{{$fees_payment->fees_type_id.'/'.$fees_payment->id}}</td>
                                        <td  data-sort="{{strtotime($fees_payment->payment_date)}}" >
                                            {{$fees_payment->payment_date != ""? dateConvert($fees_payment->payment_date):''}}

                                        </td>
                                        <td>{{$fees_payment->studentInfo !=""?$fees_payment->studentInfo->full_name:""}}</td>
                                        <td>
                                            @if($fees_payment->studentInfo!="" && $fees_payment->studentInfo->className!="")
                                            {{$fees_payment->studentInfo->className->class_name}}
                                            @endif
                                        </td>
                                        <td>{{$fees_payment->feesType!=""?$fees_payment->feesType->name:""}}</td>
                                        <td>
                                            {{@$fees_payment->payment_mode}}
                                        </td>
                                        <td>
                                            @php
                                                $total =  $total + $fees_payment->amount;
                                                $grand_amount =  $grand_amount + $fees_payment->amount;
                                                echo generalSetting()->currency_symbol.$fees_payment->amount;
                                            @endphp
                                        </td>
                                        
                                        <td>
                                            @php
                                                $total =  $total + $fees_payment->fine;
                                                $grand_fine =  $grand_fine + $fees_payment->fine;
                                                echo generalSetting()->currency_symbol.$fees_payment->fine;
                                            @endphp
                                        </td>
                                        <td>
                                            @php
                                                $grand_total =  $grand_total + $total;
                                                echo generalSetting()->currency_symbol.$total;
                                            @endphp
                                        </td>
                                    </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                            <tfoot>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>@lang('lang.grand_total') </th>
                                <th>{{generalSetting()->currency_symbol}}{{$grand_amount}}</th>
                                <th>{{generalSetting()->currency_symbol}}{{$grand_fine}}</th>
                                <th>{{generalSetting()->currency_symbol}}{{$grand_total}}</th>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
@push('script')
<script>
        $('input[name="date_range"]').daterangepicker({
            ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            "startDate": moment().subtract(7, 'days'),
            "endDate": moment()
            }, function(start, end, label) {
            console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
        });
    </script>
@endpush
