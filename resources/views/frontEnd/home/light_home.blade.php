                    
@extends('frontEnd.home.front_master')
<section style="padding: 10px;">
    <div class="container">
        <div class="row">
            <div class="EIIN">EIIN :{{$setting->school_code}} </div> <br> 
        @php 
    //  dd($setting);

        @endphp
            <div class="col-md-2 col-lg-2 col-sm-2">
                <img class="logo_1" src="{{asset($setting->logo ? $setting->logo : 'public/uploads/settings/logo.png')}}" alt="">
            </div>
            <div class="col-md-6 col-lg-6 col-sm-6">
                <h2 style="text-align: center; color: #2EC6F5;font-weight: 800;"> {{$setting->school_name}}
                </h2>
                <!-- school name in bangla -->
                <h2 style="text-align: center; color: #2EC6F5;font-weight: 800;"> {{$setting->copyright_text}} 
                </h2>
            </div>
            <div class="col-md-4 col-lg-4 col-sm-4">
                <img width="100%" style="margin:10px" src="{{asset('public/frontend/img/media/60010.png')}}" alt="">
            </div>
        </div>
        <div class="hotline">Hotline: {{$setting->phone}}</div>
    </div>
</section>

@php
                      $coursecate= App\SmCourseCategory::all();
                     //  dd($coursecate);
                     @endphp
  <section class="slider">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
             @foreach($coursecate as $key => $value)
            <li data-target="#carouselExampleIndicators" data-slide-to="{{$key++}}" class="active"></li>
            
            @endforeach
        </ol>
        <div class="carousel-inner">
                @foreach($coursecate as $key => $value)
            <div class="carousel-item  {{$key == 0 ?'active' : ''}} ">
                <img class="d-block w-100 " src="{{asset($value->category_image)}}"
                    alt="First slide">
            </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>
@push('css')
   <!-- <link rel="stylesheet" href="{{asset('public/')}}/frontend/css/new_style.css"/> -->
@endpush

@section('main_content')


    <section id="VorteCholse" class="m-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <marquee behavior="" direction="left" scrollamount="3" style="background: #ff5e4e4f;" class="p-1">
                    </marquee>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="slider-bottom-img">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <a href="https://play.google.com/store/apps/details?id=com.sourcecode.shikkhastudent"
                            style="display: flex; justify-content: space-between;align-items: center;">
                            <img src="{{asset('public/frontend/img/media/App-Portfolio.png')}}" alt="" class="img-responsive" style="width: 100%; ">
                        </a>
                    </div>
                    <div class="col-md-5">
                        <img src="{{asset('public/frontend/img/media/mujibBorsho1.png')}}" alt="" class="img-responsive" height="300px" width="100%">
                    </div>
                </div>
            </div>
        </div>
    </section>
  @if(isset($per["Testimonial"]))
    <section id="talk">
        <div class="container mt-5">
          @foreach($testimonial as $value)
            <div class="row">
           
                <div class="col-lg-8">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade  show  active " id="pills-home1" role="tabpanel"
                            aria-labelledby="pills-home1-tab">

                            <h4>Message from {{$value->designation}}</h4>
                            <div class="detials">
                                <p>{{$value->description}}</p>
                            </div>

                            <span>{{$value->name}}</span>
                            <h6>{{$value->designation}}, {{$value->institution_name}}</h6>
                        </div>
                        
                      
                    </div>
                </div>
                 <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" class="tab-unorder-list">
                                <li class="nav-item tab-list btn-img text-center">
                                    <a class="pill-nav" id="pills-home1-tab" data-toggle="pill" href="#pills-home1"
                                        role="tab" aria-controls="pills-home1" aria-selected="true">
                                        <img height="200px" width="300px" src="{{asset($value->image)}}"
                                            class="d-block" alt="Name">
                                    </a>
                                    <div class="tab-overlay">
                                        <p class="tab-name">{{$value->name}}</p>
                                        <h5>{{$value->designation}}</h5>
                                    </div>
                                </li>
                                

                            </ul>
                        </div>
                        
                       
                    </div>
                </div>
                
               
            </div>
            @endforeach
        </div>
    </section>
@endif
<div class="col-lg-12">
                    <div class="branchhead text-center ">
                        <h2 style="font-weight:800">Our Notice Board</h2>
                    </div>
</div>

<section class="home-notice mt-5">
        <div class="container home-notice-box" style="background-image: url('{{ asset('public/frontend/img/notice_board.jpg')}}');   
   ">
            <div class="row">
                <div class="col-md-6">
                    <div class="home-notice-img"></div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="home-notice-content">
                        <marquee behavior="" direction="up" scrollamount="2">
                            <ul>
                            @foreach($notice_board as $notice)
                                <li>
                                    <a href="notice-board/{{$notice->id}}">
                                        <div class="home-notice-year-box">
                                           
                                            <span class="home-notice-content-date">{{date('d-M', strtotime($notice->notice_date))}}</span>
                                        </div>
                                        <div class="home-notice-content-details">
                                            <p>{{$notice->notice_title}}</p>
                                        </div>
                                    </a>
                                </li>
                                @endforeach 
                            </ul>
                        </marquee>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br> <br>
    <section class="classRomm">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <a href="#">
                        <div class="class-room">
                            <div class="class-room-img">
                                <img src="{{asset('public/frontend/img/media/pexels-adam-fejes-5702341.jpg')}}" alt="" class="">
                            </div>
                            <div class="class-room-overlay">
                                <h4>EDUCATIONAL CHANNEL</h4>
                                <img src="frontend/vnsc/images/youtubicon.svg" alt="">
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#">
                        <div class="class-room teacher-room">
                            <div class="class-room-img teacher-room-img">
                                <img src="{{asset('public/frontend/img/media/SMS-842x480.gif')}}" alt="" class="">
                            </div>
                            <div class="class-room-overlay teacher-overlay">
                                <h4> স্কুল</h4>
                                <p>DETAILS</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#">
                        <div class="class-room teacher-room">
                            <div class="class-room-img teacher-room-img">
                                <img src="{{asset('public/frontend/img/media/College-default-image8111709737.jpg')}}" alt="" class="">
                            </div>
                            <div class="class-room-overlay teacher-overlay">
                                <h4> কলেজ</h4>
                                <p>DETAILS</p>
                            </div>
                        </div>
                    </a>
                </div>
                                   
                       
                      
                    
                </div>
               
        
        </div>
    </section>
  

 
    <section id="newsEvent">
        <div class="row m-4">
         @if(isset($per["Latest News"]))
            <div class="col-lg-6">
                <div class="row eventLeft">
                    <div class="col-sm-12 col-lg-6 offset-lg-6">
                        <div class="eventLeft2 text-left">
                            <h3>@lang('lang.latest_news') &amp; Event</h3>
                            <p>Will get all kind of latest news and update.</p>
                        </div>
                    </div>
                </div>
            </div>
            @foreach($news as $value)
            <div class="col-lg-6">
                <div class="row eventPhoto">
                    <div class="col-lg-6 m-4">
                        <div class="eventslider">
                            <div class="card eventCard">
                                <img src="{{asset($value->image)}}" class="card-img-top"
                                    alt="...">
                                <div class="card-body eventCardBody">
                                    <h4 class="card-title"><a href="{{url('news-details/'.$value->id)}}">
                                                    {{$value->news_title}}
                                                </a></h4>
                                    <p class="date">
                                                {{$value->publish_date != ""? dateConvert($value->publish_date):''}}
                                            </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             @endforeach
        </div>
         @endif
    </section>

    <section id="video">
        <div class="">
            <div class="row mx-0">
                <div class="col-lg-12 p-0">
                    <div class="gallary-img videoImage">
                        <img src="{{$homePage->image}}" alt="" class="d-block w-100">
                        <div class="play-btn text-center">
                            <a class="venobox vbox-item" data-autoplay="true" data-vbtype="video" href="#"><i
                                    class="fa fa-play" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    
@endsection
