<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('lang.mark') @lang('lang.sheet') @lang('lang.report')</title>
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
        .margin-auto{
          margin: auto;
        }
        .nowrap{
          white-space : nowrap;
        }
    .thumb.text-right {
        text-align: right;
    }
    </style>
</head>
@php
    $generalSetting= App\SmGeneralSettings::find(1);
      if(!empty($generalSetting)){
          $school_name =$generalSetting->school_name;
          $site_title =$generalSetting->site_title;
          $school_code =$generalSetting->school_code;
          $address =$generalSetting->address;
          $phone =$generalSetting->phone;
          $email =$generalSetting->email;  
      }
@endphp
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
                                        <img  src="{{asset('/')}}{{generalSetting()->logo }}" alt="{{$school_name}}">
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
                        <h3>@lang('lang.academic') @lang('lang.transcript')</h3>
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
                                           <p class="line_grid" >
                                               <span>
                                                   <span>@lang('lang.student_name')</span>
                                                   <span>:</span>
                                               </span>
                                               {{$student_detail->full_name}}
                                           </p>
                                       </td>
                                       <td>
                                           <p class="line_grid" >
                                               <span>
                                                   <span>@lang('lang.class')</span>
                                                   <span>:</span>
                                               </span>
                                               {{$student_detail->className->class_name}}
                                           </p>
                                       </td>
                                      </tr>
                                      <tr>
                                           
                                           <td>
                                               <p class="line_grid" >
                                                   <span>
                                                       <span>@lang('lang.roll') @lang('lang.no')</span>
                                                       <span>:</span>
                                                   </span>
                                                   {{$student_detail->roll_no}}
                                               </p>
                                           </td>
                                           <td>
                                               <p class="line_grid" >
                                                   <span>
                                                       <span>@lang('lang.section')</span>
                                                       <span>:</span>
                                                   </span>
                                                   {{$student_detail->section->section_name}}
                                               </p>
                                           </td>
                                      </tr>
                                      <tr>
                                           
                                           <td>
                                               <p class="line_grid" >
                                                   <span>
                                                       <span>@lang('lang.admission') @lang('lang.no')</span>
                                                       <span>:</span>
                                                   </span>
                                                   {{$student_detail->admission_no}}
                                               </p>
                                           </td>
                                           <td>
                                               <p class="line_grid" >
                                                   <span>
                                                       <span>@lang('lang.exam')</span>
                                                       <span>:</span>
                                                   </span>
                                                   {{$exam_details->title}}
                                               </p>
                                           </td>
                                      </tr>
                                  </tbody>
                                   </table>
                                   <!--/ single table  -->
                                </td>
                                <td>
                                    <!-- single table  -->
                                    @if(@$grades)
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
                                        @foreach($grades as $grade_d)
                                          <tr>
                                            <td>{{$grade_d->percent_from}}</td>
                                            <td>{{$grade_d->percent_upto}}</td>
                                            <td>{{$grade_d->gpa}}</td>
                                            <td>{{$grade_d->grade_name}}</td>
                                            <td>{{$grade_d->description}}</td>
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
                <th>@lang('lang.sl')</th>
                <th>@lang('lang.subject') @lang('lang.name')</th>
                <th>@lang('lang.total') @lang('lang.mark')</th>
                <th>@lang('lang.highest_marks')</th>
                <th>@lang('lang.obtained_marks')</th>
                <th>@lang('lang.letter') @lang('lang.grade')</th>
                <th>@lang('lang.remarks')</th>
              </tr>
            </thead>
            <tbody>
            @php
              $main_subject_total_gpa=0;
              $Optional_subject_count=0;
                if($optional_subject!=''){
                    $Optional_subject_count=$subjects->count()-1;
                }else{
                    $Optional_subject_count=$subjects->count();
                }
              $sum_gpa= 0;  
              $resultCount=1; 
              $subject_count=1; 
              $tota_grade_point=0; 
              $this_student_failed=0; 
              $count=1;
              $total_mark=0;
              $temp_grade=[];
            @endphp
            @foreach($mark_sheet as $data)
            @php
                $temp_grade[]=$data->total_gpa_grade;
                if ($data->subject_id==$optional_subject) { 
                    continue;
                }
            @endphp  
            <tr>
              <td>{{ $count }}</td>
              <td>{{$data->subject->subject_name}}</td>
              <td>{{@subjectFullMark($exam_details->id, $data->subject->id )}}</td>
              <td>{{@subjectHighestMark($exam_type_id, $data->subject->id, $class_id, $section_id)}}</td>
              <td>{{@$data->total_marks}}</td>
              <td>
                @php
                  $result = markGpa(@subjectPercentageMark(@$data->total_marks , @subjectFullMark($exam_details->id, $data->subject->id)));
                  $main_subject_total_gpa += $result->gpa;
                  $total_mark+=@$data->total_marks;
                @endphp
                {{@$data->total_gpa_grade}}
              </td>
              <td>{{@$data->teacher_remarks}}</td>
              @php
                  $count++
              @endphp
            </tr>
            @endforeach
            <tr>
              <td colspan="6"><strong>@lang('lang.additional_subject')</strong></td>
              <td colspan="5"></td>
            </tr>
            @foreach($mark_sheet as $data)
            @php
              if ($data->subject_id!=$optional_subject) { 
                  continue;
              }
            @endphp
            <tr>
                <td>{{ $count }}</td>
                <td>{{$data->subject->subject_name}}</td>
                <td>{{@subjectFullMark($exam_details->id, $data->subject->id )}}</td>
                <td>{{@subjectHighestMark($exam_type_id, $data->subject->id, $class_id, $section_id)}}</td>
                <td>
                  {{@$data->total_marks}}
                  @php
                      $total_mark+=@$data->total_marks;
                  @endphp
                </td>
                <td>
                  {{@$data->total_gpa_grade}}
                  <span>
                  @php
                      if($data->total_gpa_point > @$optional_subject_setup->gpa_above){
                          $optional_countable_gpa= $data->total_gpa_point - @$optional_subject_setup->gpa_above;
                      }else{
                          $optional_countable_gpa=0;
                      }
                  @endphp
                  </span>
                </td>
                <td>{{@$data->teacher_remarks}}</td>
              </tr>
              @endforeach
            </tbody>
        </table>
        <table class="table border_table gray_header_table mb_30 max-width-400 ml_auto margin-auto" >
          <tbody>
            <tr>
              <td class="nowrap">@lang('lang.attendance')</td>
              @if(isset($exam_content))
              <td class="nowrap">{{@$student_attendance}} @lang('lang.of') {{@$total_class_days}}</td>
              @else
              <td class="nowrap">@lang('lang.no') @lang('lang.data') @lang('lang.found')</td>
              @endif
              <td class="nowrap">@lang('lang.total_mark')</td>
              <td>{{@$total_mark}}</td>
            </tr>
            <tr>
              <td class="nowrap">@lang('lang.average') @lang('lang.mark')</td>
              <td class="nowrap">
                @php
                    $average_mark = $total_mark/($Optional_subject_count+1);
                @endphp
                {{number_format(@$average_mark, 2, '.', '')}}
              </td>
              <td class="nowrap">@lang('lang.gpa_above') ( {{@$optional_subject_setup->gpa_above}} )</td>
              <td class="nowrap">{{$optional_countable_gpa}}</td>
            </tr>
            <tr>
              <td class="nowrap">@lang('lang.without') @lang('lang.optional')</td>
                <td class="nowrap"> 
                    @php
                        $without_optional=$main_subject_total_gpa/$Optional_subject_count;
                    @endphp
                    {{number_format($without_optional, 2,'.','')}}
                </td>
              <td class="nowrap">@lang('lang.gpa')</td>
              <td class="nowrap">
                @php
                    $final_result = ($main_subject_total_gpa + $optional_countable_gpa) /$Optional_subject_count;
                    if($final_result >= $maxGrade){
                        echo number_format($maxGrade, 2,'.','');
                    } else {
                        echo number_format($final_result, 2,'.','');
                    }
                @endphp
              </td>
            </tr>
            <tr>
              <td class="nowrap">@lang('lang.grade')</td>
              <td class="nowrap">
                @php
                    if(in_array($failgpaname->grade_name,$temp_grade)){
                        echo $failgpaname->grade_name;
                    }else{
                        if($final_result >= $maxGrade){
                            $grade_details= App\SmResultStore::remarks($maxGrade);
                        } else {
                            $grade_details= App\SmResultStore::remarks($final_result);
                        }
                    }
                @endphp
                {{@$grade_details->grade_name}}
              </td>
              <td class="nowrap">@lang('lang.evaluation')</td>
              <td class="nowrap">
                  @php
                    if(in_array($failgpaname->grade_name,$temp_grade)){
                        echo $failgpaname->description;
                    }else{
                        if($final_result >= $maxGrade){
                            $grade_details= App\SmResultStore::remarks($maxGrade);
                        } else {
                            $grade_details= App\SmResultStore::remarks($final_result);
                        }
                    }
                @endphp
                {{@$grade_details->description}}
              </td>
            </tr>
          </tbody>
      </table>
      @if(isset($exam_content))
      <table style="width:100%" class="border-0">
            <tbody>
              <tr> 
                <td class="border-0">
                  <p class="result-date" style="text-align:left; float:left; display:inline-block; margin-top:50px; padding-left: 0; color: #79838b;">
                    @lang('lang.date_of_publication_of_result') : 
                      <strong>
                        {{dateConvert(@$exam_content->publish_date)}}
                      </strong>
                  </p>
                </td>
                <td class="border-0"> 
                  <div class="text-right d-flex flex-column justify-content-end">
                    <div class="thumb text-right">
                      @if (@$exam_content->file)
                        <img src="{{asset(@$exam_content->file)}}" width="100px">
                      @endif
                    </div>
                        <p style="text-align:right; float:right; display:inline-block; margin-top:5px; color: #79838b;">
                        ({{@$exam_content->title}})
                        </p> 
                    </div>
                </td>
            </tr>
        </tbody>
      </table>
      @endif
    </div>
</body>
</html>