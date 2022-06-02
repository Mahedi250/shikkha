@extends('backEnd.master')
@section('title')
@lang('lang.member') @lang('lang.list')
@endsection
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
  <div class="container-fluid">
    <div class="row justify-content-between">
      <h1>@lang('lang.issue_books')</h1>
      <div class="bc-pages">
        <a href="{{route('dashboard')}}">@lang('lang.dashboard')</a>
        <a href="#">@lang('lang.library')</a>
        <a href="#">@lang('lang.issue_books')</a>
      </div>
    </div>
  </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
  <div class="container-fluid p-0">

    <div class="row mt-40">
      <div class="col-lg-12">
        @include('backEnd.partials.alertMessage')
        <div class="row">
         <div class="col-lg-12">
          <table id="table_id" class="display school-table" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th width="15%">@lang('lang.member') @lang('lang.id')</th>
                <th width="15%">@lang('lang.full_name')</th>
                <th width="15%">@lang('lang.member_type')</th>
                <th width="15%">@lang('lang.phone')</th>
                <th width="15%">@lang('lang.email')</th>
                <th width="15%">@lang('lang.action')</th>
              </tr>
            </thead>

            <tbody>
               @foreach($activeMembers as $value)
              <tr>
                <td>{{$value->member_ud_id}}</td>

                <td>

                  @if($value->member_type == '2')
                      {{$value->studentDetails != ""? $value->studentDetails->full_name:''}}
                  @elseif($value->member_type == '3')
                      {{$value->parentsDetails != ""? $value->parentsDetails->fathers_name:''}}
                  @else
                      {{$value->staffDetails != ""? $value->staffDetails->full_name:''}}
                  @endif

                </td>

                <td>{{$value->memberTypes->name}}</td>
                <td>
                  @if($value->member_type == '2')
                      {{$value->studentDetails != ""? $value->studentDetails->mobile:''}}
                  @elseif($value->member_type == '3')
                      {{$value->parentsDetails != ""? $value->parentsDetails->fathers_mobile:''}}
                  @else
                      {{$value->staffDetails != ""? $value->staffDetails->mobile:''}}
                  @endif

                  </td>
                <td>
                  @if($value->member_type == '2')
                      {{$value->studentDetails != ""? $value->studentDetails->email:''}}
                  @elseif($value->member_type == '3')
                      {{$value->parentsDetails != ""? $value->parentsDetails->guardians_email:''}}
                  @else
                      {{$value->staffDetails != ""? $value->staffDetails->email:''}}
                  @endif
                </td>
                <td>
                    <a class="primary-btn fix-gr-bg nowrap" href="{{route('issue-books',[@$value->member_type,@$value->student_staff_id])}}">@lang('lang.issue_return_Book')</a>
                </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endsection
