@extends('backEnd.master')
@section('title')
@lang('lang.exam_attendance') @lang('lang.create')
@endsection
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.examinations')</h1>
            <div class="bc-pages">
                <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.examinations')</a>
                <a href="{{route('online-exam')}}">@lang('lang.online_exam')</a>
                <a href="{{route("manage_online_exam_question", [$online_exam->id])}}">@lang('lang.online_exam_question')</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title m-0">
                            <h3 class="mb-30"> @lang('lang.exam_details')</h3>
                        </div>
                    </div>
                </div>
                <div class="row student-details mt-0">
                    <div class="col-lg-12">
                        <div class="student-meta-box">
                            <div class=" staff-meta-top"></div>
                            <div class="white-box">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="single-meta mt-20">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="value text-left">
                                                        @lang('lang.title')
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="name">
                                                        {{$online_exam->title}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-meta">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="value text-left">
                                                        @lang('lang.class')
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="name">
                                                        {{@$online_exam->class!=""?@$online_exam->class->class_name:""}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-meta">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="value text-left">
                                                        @lang('lang.section')
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="name">
                                                        {{@$online_exam->section !=""?@$online_exam->section->section_name:""}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-meta">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="value text-left">
                                                        @lang('lang.subject')
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="name">
                                                        {{@$online_exam->subject!=""?@$online_exam->subject->subject_name:""}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="single-meta mt-20">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="value text-left">
                                                        @lang('lang.date')
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="name">          
                                                    {{@@$online_exam->date != ""? dateConvert(@@$online_exam->date):''}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-meta">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="value text-left">
                                                        @lang('lang.time')
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="name">
                                                        {{@@$online_exam->start_time.' - '.@@$online_exam->end_time}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-meta">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="value text-left">
                                                        @lang('lang.passing_percentage')
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="name">
                                                        {{@$online_exam->percentage}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 mb-30">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0">@lang('lang.question_list')</h3>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
                <input type="hidden" id="online_exam_id_ajax" name="online_exam_id" value="{{ @$online_exam->id}}">
                <div class="row">
                    <div class="col-lg-12">
                        <table id="table_id" class="display school-table pb-120" cellspacing="0" width="100%">
                            <thead>
                                @if(session()->has('message-success') != "" ||
                                session()->get('message-danger') != "")
                                <tr>
                                    <td colspan="6">
                                        @if(session()->has('message-success'))
                                        <div class="alert alert-success">
                                            {{ session()->get('message-success') }}
                                        </div>
                                        @elseif(session()->has('message-danger'))
                                        <div class="alert alert-danger">
                                            {{ session()->get('message-danger') }}
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <th>@lang('lang.sl')</th>
                                    <th>@lang('lang.group')</th>
                                    <th>@lang('lang.type')</th>
                                    <th>@lang('lang.question')</th>
                                    <th>@lang('lang.marks')</th>
                                    <th>@lang('lang.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total_marks = 0; @endphp
                                @foreach($question_banks as $question_bank)
                                @php $total_marks += $question_bank->mark; @endphp
                                <tr class="abc">
                                    <td>
                                        <input data-id="{{ @$question_bank->id}}" type="checkbox" id="question{{ @$question_bank->id}}" class="common-checkbox" name="questions[]" value="{{ @$question_bank->id}}" {{in_array(@$question_bank->id, @@$already_assigned)? 'checked': ''}}>
                                        <label for="question{{@$question_bank->id}}"></label>
                                    </td>
                                    <td>{{@$question_bank->questionGroup !=""?@$question_bank->questionGroup->title:""}}</td>
                                    <td>
                                        @if(@$question_bank->type == "M")
                                            {{'Multiple Choice'}}
                                        @elseif(@$question_bank->type == "MI")
                                        @lang('lang.multiple_image')
                                        @elseif(@$question_bank->type == "F")
                                            {{'Fill In The Blanks'}}
                                        @else
                                            {{'True False'}}
                                        @endif
                                    </td>
                                    <td>{{@$question_bank->question}}</td>
                                    <td>{{@$question_bank->marks}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                @lang('lang.select')
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item modalLink" data-modal-size="modal-lg" title="View Question"  href="{{route('view_online_question_modal', [$question_bank->id])}}" >@lang('lang.view')</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                <!-- <tr>
                                    <td colspan="5" align="center">
                                        <button class="primary-btn fix-gr-bg">
                                            <span class="ti-check"></span>
                                            save Questions
                                        </button>
                                    </td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- {{ Form::close() }} --}}
            </div>
        </div>
    </div>
</section>
<div class="modal fade admin-query" id="deleteOnlineExamQuestion" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('lang.delete') @lang('lang.item')</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <h4>@lang('lang.are_you_sure_to_delete')</h4>
                </div>
                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">@lang('lang.cancel')</button>
                     {{ Form::open(['route' => 'online-exam-question-delete', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                     <input type="hidden" name="id" id="online_exam_question_id">
                    <button class="primary-btn fix-gr-bg" type="submit">@lang('lang.delete')</button>
                     {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
$(document).on('change','.common-checkbox',function (){
        let url = $("#url").val();
        let onlineExamId=$("#online_exam_id_ajax").val();
        let questionBankId = $(this).val();
        let checkbox='';
        if ($(this).is(':checked'))
            {
                checkbox = $(this).val();
            }
        $.ajax({
            type:"POST",
            dataType:"Json",
            data:{questions:questionBankId,online_exam_id:onlineExamId,checkbox:checkbox},
            url:url + "/" + "online-exam-question-assign",
            success:function(data){
                if (data == "success") {
                    toastr.success('Operation successful', 'Successful', {
                    timeOut: 5000
                    })
                } else {
                    toastr.error('Operation Failed', 'Failed', {
                    timeOut: 5000
                    })
                }
            }
        });
});
</script>
@endpush