@extends('frontEnd.home.front_master')

@section('main_content')
  @php

$noticeboard =App\SmNoticeBoard::all();
//dd($noticeboard);

  @endphp
    
    <section class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-title">
                        <h3>Notice Board</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="page-content">
        <div class="container">
            <div class="row">
             @if(isset($noticeboard))
                 @foreach($noticeboard as $notice)
                <div class="col-md-8">
                    
                        
                        <h6> Date: {{$notice->publish_on != ""? dateConvert($notice->publish_on):''}}</h6>
                        
                        
                    
                     <div class="notice-box">
                         <h5>Notice: {{$notice->notice_title}} </h5>
                        <a href="notice-board/{{$notice->id}}" class="mobile-off">See More</a>
                    </div>
                     <div class="notice-box">
                         <h5>Details: {{$notice->notice_message}} </h5>
                     
                    </div>
                </div>
                @endforeach
                    @endif
                <div class="col-md-4">
                    <div class="page-sidebar mt-2">
                        <i class="fa fa-check-square-o" aria-hidden="true"></i> Related Topics
                    </div>
                    <div class="page-sidebar-list">
                        <ul class="list-group">
                            <li class="list-group-item"><a href="{{url('/')}}/noticeboard"><i class="fa fa-angle-double-right"
                                        aria-hidden="true"></i> Notice Board</a></li>
                      
                            
                          

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

 
@endsection

