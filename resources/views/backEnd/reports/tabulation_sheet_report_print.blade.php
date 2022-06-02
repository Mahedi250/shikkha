<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('lang.tabulation_sheet')</title>
    <style>
        body{
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 0;
            -webkit-print-color-adjust: exact !important;
            color-adjust: exact;
        }
        table {
            border-collapse: collapse;
        }
        h1,h2,h3,h4,h5,h6{
            margin: 0;
            color: #00273d;
        }
        .invoice_wrapper{
            max-width: 1200px;
            margin: auto;
            background: #fff;
            padding: 20px;
        }
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }
        .border_none{
            border: 0px solid transparent;
            border-top: 0px solid transparent !important;
        }
        .invoice_part_iner{
            background-color: #fff;
        }
        .invoice_part_iner h4{
            font-size: 30px;
            font-weight: 500;
            margin-bottom: 40px;
    
        }
        .invoice_part_iner h3{
            font-size:25px;
            font-weight: 500;
            margin-bottom: 5px;
    
        }
        .table_border thead{
            background-color: #F6F8FA;
        }
        .table td, .table th {
            padding: 5px 0;
            vertical-align: top;
            border-top: 0 solid transparent;
            color: #79838b;
        }
        .table td , .table th {
            padding: 5px 0;
            vertical-align: top;
            border-top: 0 solid transparent;
            color: #79838b;
        }
        .table_border tr{
            border-bottom: 1px solid #000 !important;
        }
        th p span, td p span{
            color: #212E40;
        }
        .table th {
            color: #00273d;
            font-weight: 300;
            border-bottom: 1px solid #f1f2f3 !important;
            background-color: #fafafa;
        }
        p{
            font-size: 14px;
        }
        h5{
            font-size: 12px;
            font-weight: 500;
        }
        h6{
            font-size: 10px;
            font-weight: 300;
        }
        .mt_40{
            margin-top: 40px;
        }
        .table_style th, .table_style td{
            padding: 20px;
        }
        .invoice_info_table td{
            font-size: 10px;
            padding: 0px;
        }
        .invoice_info_table td h6{
            color: #6D6D6D;
            font-weight: 400;
            }

        .text_right{
            text-align: right;
        }
        .virtical_middle{
            vertical-align: middle !important;
        }
        .thumb_logo {
            max-width: 120px;
        }
        .thumb_logo img{
            width: 100%;
        }
        .line_grid{
            display: grid;
            grid-template-columns: 140px auto;
            grid-gap: 10px;
        }
        .line_grid span{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .line_grid span:first-child{
            font-weight: 600;
            color: #79838b;
        }
        p{
            margin: 0;
        }
        .font_18 {
            font-size: 18px;
        }
        .mb-0{
            margin-bottom: 0;
        }
        .mb_30{
            margin-bottom: 30px !important;
        }
        .border_table thead tr th {
            padding: 12px 10px;
        }
        .border_table tbody tr td {
            border-bottom: 1px solid rgba(0, 0, 0,.05);
            text-align: center;
            padding: 10px;
        }
        .logo_img{
            display: flex;
            align-items: center;
        }
        .logo_img h3{
            font-size: 25px;
            margin-bottom: 5px;
            color: #79838b;
        }
        .logo_img h5{
            font-size: 14px;
            margin-bottom: 0;
            color: #79838b;
        }
        .company_info{
            margin-left: 20px;
        }
        .table_title{
            text-align: center;
        }
        .table_title h3{
            font-size: 35px;
            font-weight: 600;
            border-bottom: 1px solid #000 !important;
            text-transform: uppercase;
            padding-bottom: 3px;
            display: inline-block;
            margin-bottom: 40px;
            color: #79838b;
        }
        .gray_header_table thead th{
            background: #515151 !important;
            color: #fff;
            border: 1px solid #515151;
        }
        .gray_header_table{
            border: 1px solid #DDDDDD;
        }
        .gray_header_table tbody td, .gray_header_table tbody th {
            border: 1px solid #DDDDDD;
        }
        .gray_header_table tbody tr:nth-of-type(2n+1) td {
            background-color: #EEEEEE !important;
        }
        .max-width-400{
            width: 400px;
        }
        .max-width-500{
            width: 500px;
        }
        .ml_auto{
            margin-left: auto;
            margin-right: 0;
        }
        .mr_auto{
            margin-left: 0;
            margin-right: auto;
        }
    </style>
</head>
<script>
        var is_chrome = function () { return Boolean(window.chrome); }
        if(is_chrome) 
        {
           window.print();
        //    setTimeout(function(){window.close();}, 10000); 
           //give them 10 seconds to print, then close
        }
        else
        {
           window.print();
        }
</script>
@php
    $generalSetting= App\SmGeneralSettings::find(1);
    if(!empty($generalSetting)){
        $school_name = $generalSetting->school_name;
        $site_title = $generalSetting->site_title;
        $school_code = $generalSetting->school_code;
        $address = $generalSetting->address;
        $phone = $generalSetting->phone; 
    }
@endphp
<body onLoad="loadHandler();">
    <div class="invoice_wrapper">
        <!-- invoice print part here -->
        <div class="invoice_print mb_30">
            <div class="container">
                <div class="invoice_part_iner">
                    <table class="table border_bottom mb_30" >
                        <thead>
                            <td>
                                <div class="logo_img">
                                    <div class="thumb_logo">
                                        <img  src="{{asset('/')}}{{generalSetting()->logo }}" alt="{{$school_name}}" alt="{{$school_name}}">
                                    </div>
                                    <div class="company_info">
                                        <h3>{{isset(generalSetting()->school_name)?generalSetting()->school_name:'Infix School Management ERP'}}</h3>
                                        <h5>{{isset(generalSetting()->address)?generalSetting()->address:'Infix School Address'}}</h5>
                                    </div>
                                </div>
                            </td>
                        </thead>
                    </table>
                    <div class="table_title">
                        <h3>@lang('lang.tabulation_sheet')@lang('lang.of') 
                            {{$tabulation_details['exam_term']}} @lang('lang.in') {{date('Y')}}</h3>
                    </div>
                    <!-- middle content  -->
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                   <!-- single table  -->
                                   <table class="mb_30 max-width-500 mr_auto">
                                    <tbody>
                                      <tr>
                                          <td>
                                        @if(@$tabulation_details['student_name'])
                                           <p class="line_grid" >
                                               <span>
                                                   <span>@lang('lang.student') @lang('lang.name')</span>
                                                   <span>:</span>
                                               </span>
                                               {{$tabulation_details['student_name']}}
                                           </p>
                                        @endif
                                       </td>
                                       <td>
                                        @if(@$tabulation_details['student_roll'])
                                           <p class="line_grid" >
                                               <span>
                                                   <span>@lang('lang.class')</span>
                                                   <span>:</span>
                                               </span>
                                               {{$tabulation_details['student_class']}}
                                           </p>
                                        @endif
                                       </td>
                                      </tr>
                                      <tr>
                                           
                                           <td>
                                            @if(@$tabulation_details['student_roll'])
                                               <p class="line_grid" >
                                                   <span>
                                                       <span>@lang('lang.roll') @lang('lang.no')</span>
                                                       <span>:</span>
                                                   </span>
                                                   {{$tabulation_details['student_roll']}}
                                               </p>
                                            @endif
                                           </td>
                                           <td>
                                            @if(@$tabulation_details['student_section'])
                                               <p class="line_grid" >
                                                   <span>
                                                       <span>@lang('lang.section')</span>
                                                       <span>:</span>
                                                   </span>
                                                   {{$tabulation_details['student_section']}}
                                               </p>
                                            @endif
                                           </td>
                                      </tr>
                                      <tr>
                                           <td>
                                            @if(@$tabulation_details['student_admission_no'])
                                               <p class="line_grid" >
                                                   <span>
                                                       <span>@lang('lang.admission') @lang('lang.no')</span>
                                                       <span>:</span>
                                                   </span>
                                                   {{$tabulation_details['student_admission_no']}}
                                               </p>
                                            @endif
                                           </td>
                                           <td>
                                            @if(@$tabulation_details['exam_term'])
                                               <p class="line_grid" >
                                                   <span>
                                                       <span>@lang('lang.exam')</span>
                                                       <span>:</span>
                                                   </span>
                                                   {{$tabulation_details['exam_term']}}
                                               </p>
                                            @endif
                                           </td>
                                      </tr>
                                  </tbody>
                                   </table>
                                   <!--/ single table  -->
                                </td>
                                <td>
                                    <!-- single table  -->
                                    @if(@$tabulation_details)
                                    <table class="table border_table gray_header_table mb_30 max-width-400 ml_auto" >
                                        <thead>
                                          <tr>
                                            <th>@lang('lang.starting')</th>
                                            <th>@lang('lang.ending')</th>
                                            <th>@lang('lang.gpa')</th>
                                            <th>@lang('lang.grade')</th>
                                            <th>@lang('lang.evalution')</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($tabulation_details['grade_chart'] as $d)
                                          <tr>
                                            <td>{{$d['start']}}</td>
                                            <td>{{$d['end']}}</td>
                                            <td>{{$d['gpa']}}</td>
                                            <td>{{$d['grade_name']}}</td>
                                            <td>{{$d['description']}}</td>
                                          </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    @endif
                                    <!--/ single table  -->
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- invoice print part end -->
        
        <table class="table border_table gray_header_table mb_30" >
            <thead>
                <tr>
                    @foreach($subjects as $subject)
                        @php
                            $subject_ID     = $subject->subject_id;
                            $subject_Name   = $subject->subject->subject_name;
                            $mark_parts      = App\SmAssignSubject::getNumberOfPart($subject_ID, $class_id, $section_id, $exam_term_id);
                        @endphp
                        <th colspan="{{count($mark_parts)+2}}" class="subject-list"> {{$subject_Name}}</th>
                    @endforeach
                    <th rowspan="2">@lang('lang.total_mark')</th>
                    @if ($optional_subject_setup!='')
                    <th>
                        @lang('lang.gpa')
                    </th>
                    <th rowspan="2" >
                        @lang('lang.gpa')
                    </th>
                    <th rowspan="2">
                        @lang('lang.result')
                    </th>
                    @else
                    <th>
                        @lang('lang.gpa')
                    </th>
                    <th rowspan="2">
                        @lang('lang.result')
                    </th>
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
                            <th>
                                {{$sigle_part->exam_title}}
                            </th>
                        @endforeach
                        <th>
                            @lang('lang.total')
                        </th>
                        <th>
                            @lang('lang.gpa')
                        </th>
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
                        @php 
                            $this_student_failed=0; 
                            $tota_grade_point= 0; 
                            $tota_grade_point_main= 0; 
                            $marks_by_students = 0; 
                            $main_subject_total_gpa = 0; 
                            $Optional_subject_count = 0; 
                        @endphp
                            @php
                                $optional_subject=App\SmOptionalSubjectAssign::where('student_id','=',$student->id)->where('session_id','=',$student->session_id)->first();
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
                                    {{$tola_mark_by_subject }}
                                </td>
                                <td>
                                    @php
                                        $value=subjectFullMark($exam_term_id, $subject_ID);
                                        $persentage=subjectPercentageMark($tola_mark_by_subject,$value);
                                        $mark_grade = App\SmMarksGrade::where([
                                                    ['percent_from', '<=', $persentage], 
                                                    ['percent_upto', '>=', $persentage]])
                                                    ->where('academic_id', getAcademicId())
                                                    ->where('school_id',Auth::user()->school_id)
                                                    ->first();
            
                                        $mark_grade_gpa=0;
                                        $optional_setup_gpa=0;
                                        if (@$optional_subject->subject_id==$subject_ID) {
                                            $optional_setup_gpa= @$optional_subject_setup->gpa_above;
                                            if ($mark_grade->gpa >$optional_setup_gpa) {
                                                $mark_grade_gpa = $mark_grade->gpa-$optional_setup_gpa;
                                                $tota_grade_point = $tota_grade_point + $mark_grade_gpa;
            
                                                $tota_grade_point_main = $tota_grade_point_main + $mark_grade->gpa;
                                               
                                            } else {
                                                $tota_grade_point = $tota_grade_point + $mark_grade_gpa;
                                                $tota_grade_point_main = $tota_grade_point_main + $mark_grade->gpa;
                                            }
                                        } else {
                                            $tota_grade_point = $tota_grade_point + $mark_grade->gpa ;
                                            if($mark_grade->gpa<1){
                                                $this_student_failed =1;
                                            }
                                            $tota_grade_point_main = $tota_grade_point_main + $mark_grade->gpa;
                                        }
                                    @endphp
                                        @if (@$optional_subject->subject_id==$subject_ID)
                                            
                                                {{-- {{@$mark_grade->gpa-$optional_setup_gpa }} --}}
                                                {{@$mark_grade_gpa }}
                                                <hr>
                                                (GPA above {{ $optional_setup_gpa }})
                                            @else
                                                {{@$mark_grade->gpa }}
                                            @endif
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
                                                $number = number_format($tota_grade_point_main/ count($subjects), 2, '.', '');
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
                                        @if ($number>$max_grade)
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
                                        <span class="text-warning font-weight-bold">{{$fail_grade_name->grade_name}}</span>
                                    @else
                                    @php
                                    // if ($number>=5) {
                                    //     $number=5;
                                    // }
                                    if($number >= $max_grade){
                                        echo gradeName($max_grade);
                                    }else{
                                        echo gradeName($number);
                                    }
                                @endphp
                                @endif
                                </td>
                        @else
                        <td>
                                @if(isset($this_student_failed) && $this_student_failed == 1)
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
                                    <span class="text-warning font-weight-bold">{{$fail_grade_name->grade_name}}</span>
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
                    </tbody>
        </table>
    </div>
</body>
</html>