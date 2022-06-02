@extends('backEnd.master')
@section('title')
@lang('lang.tabulation_sheet_report')
@endsection
@section('mainContent')
    <style type="text/css">
        .table tbody td {
            padding: 5px;
            text-align: center;
            vertical-align: middle;
        }

        .table head th {
            padding: 5px;
            text-align: center;
            vertical-align: middle;
        }

        .table head tr th {
            padding: 5px;
            text-align: center;
            vertical-align: middle;
        }

        tr, th, td {
            border: 1px solid #a2a6c5;
            text-align: center !important;
        }

        th, td {
            white-space: nowrap;
            text-align: center !important;
        }

        th.subject-list {
            white-space: inherit;
        }

        #main-content {
            width: auto !important;
        }

        .main-wrapper {
            display: inherit;
        }

        .table thead th {
            padding: 5px;
            vertical-align: middle;
        }

        .student_name, .subject-list {
            line-height: 12px;
        }

        .student_name b {
            min-width: 20%;
        }

        .gradeChart tbody td{
            padding: 0px;
            padding-left: 5px;
        }
        .gradeChart thead th{
            background: #f2f2f2;
        }
        hr{
            margin: 0px;
        }
    </style>
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>@lang('lang.tabulation_sheet_report') </h1>
                <div class="bc-pages">
                    <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                    <a href="#">@lang('lang.reports')</a>
                    <a href="{{route('tabulation_sheet_report')}}">@lang('lang.tabulation_sheet_report')</a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30">@lang('lang.select_criteria') </h3>
                    </div>
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
                @if(session()->has('message-danger') != "")
                    @if(session()->has('message-danger'))
                        <div class="alert alert-danger">
                            {{ session()->get('message-danger') }}
                        </div>
                    @endif
                @endif
                <div class="white-box">
                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'tabulation_sheet_report', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student']) }}
                    <div class="row">
                        <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                        <div class="col-lg-3 mt-30-md md_mb_20">
                            <select class="w-100 bb niceSelect form-control{{ $errors->has('exam') ? ' is-invalid' : '' }}"
                                    name="exam">
                                <option data-display="@lang('lang.select_exam')*" value="">@lang('lang.select_exam')*
                                </option>
                                @foreach($exam_types as $exam)
                                    <option value="{{$exam->id}}" {{isset($exam_id)? ($exam_id == $exam->id? 'selected':''):''}}>{{$exam->title}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('exam'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('exam') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-lg-3 mt-30-md md_mb_20">
                            <select class="w-100 bb niceSelect form-control {{ $errors->has('class') ? ' is-invalid' : '' }}"
                                    id="select_class" name="class">
                                <option data-display="@lang('lang.select_class') *" value="">@lang('lang.select_class')
                                    *
                                </option>
                                @foreach($classes as $class)
                                    <option value="{{$class->id}}" {{isset($class_id)? ($class_id == $class->id? 'selected':''):''}}>{{$class->class_name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('class'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('class') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-lg-3 mt-30-md md_mb_20" id="select_section_div">
                            <select class="w-100 bb niceSelect form-control{{ $errors->has('section') ? ' is-invalid' : '' }} select_section"
                                    id="select_section" name="section">
                                <option data-display="@lang('lang.select_section') *" value="">@lang('lang.select_section') *</option>
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
                        <div class="col-lg-3 mt-30-md md_mb_20" id="select_student_div">
                            <select class="w-100 bb niceSelect form-control{{ $errors->has('student') ? ' is-invalid' : '' }}"
                                    id="select_student" name="student">
                                <option data-display="@lang('lang.select_student') *"
                                        value="">@lang('lang.select_student') *</option>
                            </select>
                            <div class="pull-right loader loader_style" id="select_student_loader">
                                <img class="loader_img_style" src="{{asset('public/backEnd/img/demo_wait.gif')}}" alt="loader">
                            </div>
                            @if ($errors->has('student'))
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong>{{ $errors->first('student') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-lg-12 mt-20 text-right">
                            <button type="submit" class="primary-btn small fix-gr-bg">
                                <span class="ti-search"></span>
                                @lang('lang.search')
                            </button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </section>
    @if(isset($marks))
        @php
            $generalSetting= App\SmGeneralSettings::find(1);
            if(!empty($generalSetting)){
                $school_name =$generalSetting->school_name;
                $site_title =$generalSetting->site_title;
                $school_code =$generalSetting->school_code;
                $address =$generalSetting->address;
                $phone =$generalSetting->phone;
            }
        @endphp
        <section class="student-details mt-20">
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-30 mt-30"> 
                                @lang('lang.tabulation_sheet_report')
                            </h3>
                        </div>
                    </div>
                    <div class="col-lg-8 pull-right mt-20">
                        <div class="print_button pull-right">
                            {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'tabulation-sheet/print', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student', 'target' => '_blank']) }}
                            <input type="hidden" name="exam_term_id" value="{{$exam_term_id}}">
                            <input type="hidden" name="class_id" value="{{$class_id}}">
                            <input type="hidden" name="section_id" value="{{$section_id}}">
                            @if(!empty($student_id))
                                <input type="hidden" name="student_id" value="{{$student_id}}">
                            @endif
                            <button type="submit" class="primary-btn small fix-gr-bg"><i class="ti-printer"> </i> @lang('lang.print')
                            </button>
                           {{ Form::close() }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="single-report-admit">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-lg-4">
                                        <img class="logo-img" src="{{ generalSetting()->logo }}" alt="{{ generalSetting()->school_name }}">
                                    </div>
                                    <div class=" col-lg-8 text-left text-lg-right mt-30-md">
                                        <h3 class="text-white"> {{isset(generalSetting()->school_name)?generalSetting()->school_name:'Infix School Management ERP'}} </h3>
                                        <p class="text-white mb-0"> {{isset(generalSetting()->address)?generalSetting()->address:'Infix School Adress'}} </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="white-box">
                            <div class="row">
                                <div class="col-lg-7">
                                    <h4 class="exam_title text-center text-uppercase"> @lang('lang.tabulation_sheet')
                                        @lang('lang.of') {{$tabulation_details['exam_term']}} 
                                        @lang('lang.in') {{$year}}
                                    </h4>
                                    <hr>
                                    <br>

                                    <div class="row">
                                        <div class="col-lg-7">
                                            @if(@$tabulation_details['student_name'])
                                                @if(@$tabulation_details['student_name'])
                                                    <p class="student_name">
                                                        <strong>
                                                            @lang('lang.student') @lang('lang.name') : 
                                                        </strong> 
                                                            {{$tabulation_details['student_name']}}
                                                    </p>
                                                @endif
                                                @if(@$tabulation_details['student_roll'])
                                                    <p class="student_name">
                                                        <strong>
                                                            @lang('lang.student') @lang('lang.roll') : 
                                                        </strong> 
                                                            {{$tabulation_details['student_roll']}}
                                                    </p>
                                                @endif
                                                @if(@$tabulation_details['student_admission_no'])
                                                    <p class="student_name">
                                                        <strong>
                                                            @lang('lang.student') @lang('lang.admission') : 
                                                        </strong> 
                                                            {{$tabulation_details['student_admission_no']}}
                                                    </p>
                                                @endif
                                            @else
                                                @foreach($tabulation_details['subject_list'] as $d)
                                                    <p class="subject-list">
                                                        {{$d}}
                                                    </p>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="col-lg-5">
                                            @if(@$tabulation_details['student_class'])
                                                <p class="student_name">
                                                    <strong>
                                                        @lang('lang.class') :  
                                                    </strong> 
                                                        {{$tabulation_details['student_class']}}
                                                </p>
                                            @endif
                                            @if(@$tabulation_details['student_section'])
                                                <p class="student_name">
                                                    <strong>
                                                        @lang('lang.section') : 
                                                    </strong> 
                                                        {{$tabulation_details['student_section']}}
                                                </p>
                                            @endif
                                            @if(@$tabulation_details['student_admission_no'])
                                                <p class="student_name">
                                                    <strong> 
                                                        @lang('lang.exam') : 
                                                    </strong> 
                                                        {{$tabulation_details['exam_term']}}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    @if(@$tabulation_details)
                                        <table class="table gradeChart">
                                            <thead>
                                                <th>
                                                    @lang('lang.serial')
                                                </th>
                                                <th>
                                                    @lang('lang.starting')
                                                </th>
                                                <th>
                                                    @lang('lang.ending')
                                                </th>
                                                <th>
                                                    @lang('lang.gpa')
                                                </th>
                                                <th>
                                                    @lang('lang.grade')
                                                </th>
                                                <th>
                                                    @lang('lang.evaluation')
                                                </th>
                                            </thead>
                                            <tbody>
                                            @foreach($tabulation_details['grade_chart'] as $key=>$d)
                                                <tr>
                                                    <td>
                                                        {{$key+1}}
                                                    </td>
                                                    <td>
                                                        {{$d['start']}}
                                                    </td>
                                                    <td>
                                                        {{$d['end']}}
                                                    </td>
                                                    <td>
                                                        {{$d['gpa']}}
                                                    </td>
                                                    <td>
                                                        {{$d['grade_name']}}
                                                    </td>
                                                    <td class="text-left">
                                                        {{$d['description']}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="mt-30 mb-20 table table-striped table-bordered ">
                                    <thead>
                                        <tr>
                                            @foreach($subjects as $subject)
                                                @php
                                                    $subject_ID    = $subject->subject_id;
                                                    $subject_Name   = $subject->subject->subject_name;
                                                    $mark_parts      = App\SmAssignSubject::getNumberOfPart($subject_ID, $class_id, $section_id, $exam_term_id);
                                                @endphp
                                            <th colspan="{{count($mark_parts)+2}}" class="subject-list"> 
                                                {{$subject_Name}}
                                            </th>
                                            @endforeach
                                            <th rowspan="2">
                                                @lang('lang.total_mark')
                                            </th>
                                            @if ($optional_subject_setup!='')
                                            <th >@lang('lang.gpa')</th>
                                            <th rowspan="2" >@lang('lang.gpa')</th>
                                            <th rowspan="2">@lang('lang.result')</th>
                                            @else
                                            <th >@lang('lang.gpa')</th>
                                            <th rowspan="2">@lang('lang.result')</th>
                                            @endif
                                        </tr>
                                        <tr>
                                        @foreach($subjects as $subject)
                                            @php
                                                $subject_ID     = $subject->subject_id;
                                                $subject_Name   = $subject->subject->subject_name;
                                                $mark_parts     = App\SmAssignSubject::getNumberOfPart($subject_ID, $class_id, $section_id, $exam_term_id);
                                            @endphp
                                            
                                        @foreach($mark_parts as $sigle_part)
                                            <th>{{$sigle_part->exam_title}} ({{$sigle_part->exam_mark}})</th>
                                        @endforeach
                                            <th>@lang('lang.total')</th>
                                            <th>@lang('lang.gpa')</th>
                                        @endforeach
                                            @if ($optional_subject_setup!='')
                                            <th> 
                                                <small>
                                                    @lang('lang.without_additional')
                                                </small> 
                                            </th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php  
                                        $count=1;  
                                    @endphp
                                    @foreach($students as $student)
                                        @php $this_student_failed=0; 
                                            $tota_grade_point= 0; 
                                            $tota_grade_point_main= 0; 
                                            $marks_by_students = 0;
                                            $gpa_without_optional_count=0;  
                                            $main_subject_total_gpa =0;  
                                            $Optional_subject_count=0;  
                                            $optional_subject_gpa=0;  
                                            $opt_sub_gpa=0;
                                        @endphp
                                        @php
                                            $optional_subject=App\SmOptionalSubjectAssign::where('student_id','=',$student->id)
                                                            ->where('session_id','=',$student->session_id)
                                                            ->first();
                                        @endphp
                                        <tr>
                                            @foreach($subjects as $subject)
                                                @php
                                                    $subject_ID     = $subject->subject_id;
                                                    $subject_Name   = $subject->subject->subject_name;
                                                    $mark_parts     = App\SmAssignSubject::getMarksOfPart($student->id, $subject_ID, $class_id, $section_id, $exam_term_id);
                                                    $subject_count= 0;
                                                    $optional_subject_marks=DB::table('sm_optional_subject_assigns')
                                                        ->join('sm_mark_stores','sm_mark_stores.subject_id','=','sm_optional_subject_assigns.subject_id')
                                                        ->where('sm_optional_subject_assigns.student_id','=',$student->id)
                                                        ->first();
                                                @endphp
                                            @foreach($mark_parts as $sigle_part)
                                                <td class="total">{{$sigle_part->total_marks}}</td>
                                            @endforeach
                                            <td class="total">
                                                @php
                                                    $tola_mark_by_subject = App\SmAssignSubject::getSumMark($student->id, $subject_ID, $class_id, $section_id, $exam_term_id);
                                                    $marks_by_students  = $marks_by_students + $tola_mark_by_subject;
                                                @endphp
                                                {{$tola_mark_by_subject}}
                                            </td>
                                                <td>
                                                @php
                                                    $value=subjectFullMark($exam_term_id, $subject_ID);
                                                    $persentage=subjectPercentageMark($tola_mark_by_subject,$value);
                                                    $mark_grade = App\SmMarksGrade::where([
                                                                ['percent_from', '<=', $persentage], 
                                                                ['percent_upto', '>=', $persentage]
                                                                ])
                                                                ->where('school_id',Auth::user()->school_id)
                                                                ->where('academic_id',getAcademicId())
                                                                ->first();

                                                        $mark_grade_gpa=0;
                                                        $optional_setup_gpa=0;
                                                        if (@$optional_subject->subject_id==$subject_ID) {
                                                            $optional_setup_gpa= @$optional_subject_setup->gpa_above;
                                                            if (@$mark_grade->gpa >$optional_setup_gpa) {
                                                                $mark_grade_gpa = @$mark_grade->gpa-$optional_setup_gpa;
                                                                $tota_grade_point = $tota_grade_point + @$mark_grade_gpa;
                                                                $tota_grade_point_main = $tota_grade_point_main + @$mark_grade->gpa;
                                                            } else {
                                                                $tota_grade_point = $tota_grade_point + @$mark_grade_gpa;
                                                                $tota_grade_point_main = $tota_grade_point_main + @$mark_grade->gpa;
                                                            }
                                                        } else {
                                                            $tota_grade_point = $tota_grade_point + @$mark_grade->gpa ;
                                                            if(@$mark_grade->gpa<1){
                                                                $this_student_failed =1;
                                                            }
                                                            $tota_grade_point_main = $tota_grade_point_main + @$mark_grade->gpa;
                                                        }
                                                    @endphp
                                                        @if(@$optional_subject->subject_id==$subject_ID)
                                                            {{@$mark_grade_gpa}}
                                                            <hr>
                                                            (@lang('lang.gpa') {{ $optional_setup_gpa }})
                                                        @else
                                                            {{@$mark_grade->gpa}}
                                                        @endif
                                                        @php
                                                            if(@$optional_subject->subject_id==$subject_ID){
                                                                $optional_subject_gpa+= @$mark_grade->gpa-$optional_setup_gpa;
                                                                $opt_sub_gpa+=$optional_setup_gpa;
                                                            }
                                                        @endphp
                                                </td>
                                                @endforeach
                                                <td>{{$marks_by_students}}
                                                    @php 
                                                        $marks_by_students = 0; 
                                                    @endphp
                                                </td>
                                                @if ($optional_subject_setup!='')
                                                <td>
                                                    @if(isset($this_student_failed) && $this_student_failed==1)
                                                        @if(!empty($tota_grade_point_main))
                                                        <p id="main_subject_total_gpa"></p>
                                                        @endif
                                                    @else
                                                        @php
                                                        if (@$optional_subject!='') {
                                                            if(!empty($tota_grade_point_main)){
                                                                $subject = count($subjects)-1;
                                                                $without_optional_subject=($tota_grade_point_main - $opt_sub_gpa) - $optional_subject_gpa;
                                                                $number = number_format($without_optional_subject/ $subject , 2, '.', '');
                                                            }else{
                                                                $number = 0;
                                                            }
                                                        } else{
                                                            $subject_count=count($subjects);
                                                            if(!empty($tota_grade_point_main)){
                                                                
                                                                $number = number_format($tota_grade_point_main/ $subject_count, 2, '.', '');
                                                            }else{
                                                                $number = 0;
                                                            }
                                                        }  
                                                        @endphp 
                                                            {{$number==0?'0.00':$number}}
                                                            @php 
                                                                $subject_count=0;
                                                                $tota_grade_point_main= 0; 
                                                                $subject_count =count($subjects)-1;
                                                            @endphp
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @php 
                                                        $subject_count=0;
                                                        $subject_count =count($subjects)-1;
                                                        @endphp
                                                        @if(isset($this_student_failed) && $this_student_failed==1)
                                                            {{number_format($tota_grade_point/ $subject_count, 2, '.', '')}}
                                                        @else
                                                        @php
                                                        if (@$optional_subject!='') {
                                                            $subject_count=count($subjects)-1;
                                                            if(!empty($tota_grade_point)){
                                                                $number = number_format($tota_grade_point/ $subject_count, 2, '.', '');
                                                            }else{
                                                                $number = 0;
                                                            }
                                                        } else{
                                                            $subject_count=count($subjects);
                                                            if(!empty($tota_grade_point)){
                                                                $number = number_format($tota_grade_point/ $subject_count, 2, '.', '');
                                                            }else{
                                                                $number = 0;
                                                            }
                                                        }
                                                        @endphp
                                                            @if ($number >= $max_grade)
                                                                    {{$max_grade}}
                                                            @else
                                                            {{$number==0?'0.00':$number}}
                                                            @endif
                                                            @php 
                                                                $tota_grade_point= 0; 
                                                            @endphp
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if(isset($this_student_failed) && $this_student_failed==1)
                                                            <span class="text-warning font-weight-bold">
                                                                {{$fail_grade_name->grade_name}}
                                                            </span>
                                                        @else
                                                        @if($number >= $max_grade)
                                                            {{gradeName($max_grade)}}
                                                        @else
                                                            {{gradeName($number)}}
                                                        @endif
                                                        @endif
                                                    </td>
                                                @else
                                                <td>
                                                    @if(isset($this_student_failed) && $this_student_failed==1)
                                                        {{number_format($tota_grade_point/ count($subjects), 2, '.', '')}}
                                                    @else
                                                    @php
                                                    $subject_count=0;
                                                    if (@$optional_subject!='') {
                                                        $subject_count=count($subjects)-1;
                                                            if(!empty($tota_grade_point)){
                                                                $number = number_format($tota_grade_point/ $subject_count, 2, '.', '');
                                                            }else{
                                                                $number = 0;
                                                            }
                                                    } else{
                                                        $subject_count=count($subjects);
                                                            if(!empty($tota_grade_point)){
                                                                $number = number_format($tota_grade_point/ $subject_count, 2, '.', '');
                                                            }else{
                                                                $number = 0;
                                                            }
                                                    }
                                                    @endphp    
                                                        {{$number==0?'0.00':$number}}
                                                        @php 
                                                            $tota_grade_point= 0; 
                                                        @endphp
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(isset($this_student_failed) && $this_student_failed==1)
                                                        <span class="text-dander font-weight-bold">
                                                            {{$fail_grade_name->grade_name}}
                                                        </span>
                                                    @else
                                                    @php
                                                        $main_subject_total_gpa=0;
                                                        $Optional_subject_count=0;
                                                            if($optional_subject_mark!=''){
                                                                $Optional_subject_count=$subjects->count()-1;
                                                            }else{
                                                                $Optional_subject_count=$subjects->count();
                                                            }
                                                    @endphp
                                                    @foreach($mark_sheet as $data)
                                                        @php
                                                            if ($data->subject_id==$optional_subject_mark) { 
                                                                continue;
                                                            }
                                                            $result = markGpa($persentage);
                                                            $main_subject_total_gpa += $result->gpa;
                                                        @endphp
                                                    @endforeach
                                                        {{gradeName($number)}}
                                                    @endif
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                        {{-- Mark calculation start --}}
                                    </tbody>
                                </table>
                                <script>
                                    function myFunction(value, subject) {
                                        if (value != "") {
                                            var res = Number(value / subject).toFixed(2);
                                        } else {
                                            var res = 0;
                                        }
                                        document.getElementById("main_subject_total_gpa").innerHTML = res;
                                    }
                                    myFunction({{ $main_subject_total_gpa }}, {{ $Optional_subject_count }});
                                </script>
                        {{-- Mark calculation end --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
