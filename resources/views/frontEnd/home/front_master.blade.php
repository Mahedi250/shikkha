<style>
    /* .footer-list ul {
        list-style: none;
        padding-left: 0;
        margin-bottom: 50px;
    }

    .footer-list ul li {
        display: block;
        margin-bottom: 10px;
        cursor: pointer;
    }

    .f_title {
        margin-bottom: 40px;
    }

    .f_title h4 {
        color: #415094;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 0px;
    } */
    .icon_1 {
        font-weight: 300;
        font-size:xx-large;
    }
    .teacherImage img {
            height: 100% !important;
        }
</style>
@php
    if(moduleStatusCheck('ParentRegistration')){
        $is_registration_permission = Modules\ParentRegistration\Entities\SmRegistrationSetting::first('position');
    }

    $setting  = generalSetting();
    App::setLocale(getUserLanguage());
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" @if(isset ($ttl_rtl ) && $ttl_rtl ==1) dir="rtl" class="rtl" @endif >
<head>
    <meta charset="utf-8"/>
    <meta name="viewport"
          content="shikkha app is a School management System"/>
    <link rel="icon" href="{{asset($setting->favicon)}}" type="image/png"/>
    <title>{{ $setting->site_title ? $setting->site_title :  'Infix Edu ERP' }}</title>
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <!-- Bootstrap CSS -->
    @if( $setting->site_title == 1)
        <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/rtl/bootstrap.min.css"/>
    @else
        <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/bootstrap.css"/>
    @endif
    @push('css')
    <!--<link rel="stylesheet" href="{{asset('public/')}}/frontend/css/new_style.css"/> -->
    @endpush

    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/jquery-ui.css"/>

    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/bootstrap-datepicker.min.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/themify-icons.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/nice-select.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/magnific-popup.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/fastselect.min.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/owl.carousel.min.css"/>
    <!-- main css -->

    @if($setting->site_title ==1)
        <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/rtl/style.css"/>
    @else
        <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/{{@activeStyle()->path_main_style}}"/>
    @endif

    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/fullcalendar.min.css">
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/fullcalendar.print.css">
   <!--
    <link rel="stylesheet" href="{{asset('public/')}}/frontend/css/infix.css"/>
    <link rel="stylesheet" href="{{asset('public/')}}/frontend/css/black.css"/>
    <link rel="stylesheet" href="{{asset('public/')}}/frontend/css/responsive.css"/>
    -->
    
    <link rel="stylesheet" href="{{asset('public/')}}/frontend/font/all.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous">
     <!--new added-->
    <link rel="stylesheet" href="../cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" />
    <link rel="stylesheet" href="{{asset('public/')}}/frontend/css/style.css"/>
    <link rel="stylesheet" href="{{asset('public/')}}/frontend/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="{{asset('public/')}}/frontend/css/venobox.css"/>
   <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&amp;display=swap" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css2?family=Parisienne&amp;display=swap" rel="stylesheet"> 
    <!--new added-->
    @stack('css')
</head>

<body class="client light">
<!--================ Start Header Menu Area =================-->
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
   @php
        
        $logo=App\SmGeneralSettings::first()->logo;
        // dd($logo);
    @endphp

        <div class="container">
            @php
         //  dd($setting);
            @endphp
            <a class="navbar-brand" href="{{url('/')}}/home">
                <img src="{{asset($setting->logo ? $setting->logo : 'public/uploads/settings/logo.png')}}" alt="logo">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link " href="{{url('/')}}/home">Home
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link  dropdown-toggle " id="navbarDropdown" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">About us
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{url('/')}}/about">Why Choose Us</a>
                            <a class="dropdown-item" href="{{url('/')}}/mission">Message</a>             
                            <a class="dropdown-item" href="{{url('/')}}/governingbody">Governing Body</a>
                            <a class="dropdown-item" href="{{url('/')}}/mission">Mission & Vision</a>
                            
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link  dropdown-toggle " id="navbarDropdown" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Academic
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Academic Info</a>
                           
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link  dropdown-toggle " id="navbarDropdown" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Information
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{url('/')}}/noticeboard">Notice Board</a>
                            <a class="dropdown-item" href="{{url('/')}}/news-page">News and Events</a>
                          <!--  <a class="dropdown-item" href="payment-procedure.html">Payment Procedure</a> -->
                          <!--  <a class="dropdown-item" href="facilities.html">Facilities</a>-->
                            
                        <!--    <a class="dropdown-item" href="Library.html">Library</a>
                            <a class="dropdown-item" href="Hostel.html">Hostel</a>
                            -->
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link  dropdown-toggle " id="navbarDropdown" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Admission
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="apply-now.html">Apply Now</a>
                            
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link  dropdown-toggle " id="navbarDropdown" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Teacher's Info
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Principal</a>
                            <a class="dropdown-item" href="#">V.C Principal</a>
                            
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link  dropdown-toggle " id="navbarDropdown" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Gallery
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Photo Gallery</a>
                           
                        </div>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link " href="{{url('/')}}/contact">Contact
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link  dropdown-toggle " id="navbarDropdown" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">স্বাধীনতার সুবর্ণ জয়ন্তী কর্নার
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="suborno-notice.html">নোটিশ</a>
                            <a class="dropdown-item" href="suborno-photo-gallery.html">ছবির গ্যালারী</a>
                            
                        </div>
                    </li>
                    @if (!auth()->check())
                    <li class="nav-item portal {{Request::path() == 'login'? 'active':''}}">
                        <a style="text-align: center;" class="nav-link" target="_blank" href="{{url('/')}}/login">@lang('lang.login')
                            <!-- <span class="sr-only">(current)</span> -->
                        </a>
                    </li>
                     @else
                      <li class="nav-item portal {{Request::path() == 'login'? 'active':''}}">
                        <a style="text-align: center;" class="nav-link" target="_blank" href="{{url('/')}}/login">@lang('lang.dashboard')
                            <!-- <span class="sr-only">(current)</span> -->
                        </a>
                    </li>
                      @endif 
                    <li class="nav-item portal">
                        <a style="text-align: center;" class="nav-link"  href="{{url('/parentregistration/registration')}}">Apply
                            <!-- <span class="sr-only">(current)</span> -->
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<!--================ End Header Menu Area =================-->

@yield('main_content')

<!--================Footer Area =================-->


@php

$contact_info =App\SmContactPage::first();
//dd($contact_info);
@endphp

<section class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="upfooter">
                        <ul>
                            <li><img src="frontend/vnsc/images/mail.png" alt=""> <span>Get Appointment</span> </li>
                            <li><img src="frontend/vnsc/images/placeholder.png" alt=""> <span>Contact Us Today</span>
                            </li>
                            <li><img src="frontend/vnsc/images/paper-plane.png" alt=""> <span>Take a School Tour</span>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
            <div class="row mt-4 m-footer">
                <div class="col-lg-12">
                    <div class="footer-content">
                        <div class="footer-inner-content1">
                            <div class="footer-logo">
                                <h5>About us</h5>
                                <p style="word-wrap:calc(50,50);">
                                    Weclome to {{$setting->school_name}}</p>
                                <a href="#" class="btn">Contact us</a>
                            </div>
                        </div>
                        <div class="footer-inner-content2">
                            <div class="quick-view">
                                <h5>Important Link</h5>
                                <ul>
                                    <li><a href="http://www.dhaka.gov.bd/" target="_blank">Dhaka Districts office</a>
                                    </li>
                                    <li><a href="https://www.dhakaeducationboard.gov.bd/" target="_blank">Dhaka
                                            Education Board</a></li>
                                    <li><a href="https://erp.dhakaeducationboard.gov.bd/index.php/auth/login/"
                                            target="_blank">eTIF</a></li>
                                    <li><a href="http://www.dshe.gov.bd/" target="_blank">Directorate of Secondary and
                                            Higher Education</a></li>
                                    <li><a href="http://www.dpe.gov.bd/" target="_blank">Directorate of Primary
                                            Education</a></li>
                                    <li><a href="http://www.moedu.gov.bd/" target="_blank">Ministry of Education</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="footer-inner-content3">
                            <div class="quick-view">
                                <h5>Services</h5>
                                <ul>
                                    <li><a href="{{url('/parentregistration/registration')}}" >Admission</a></li>
                                  
                                    
                                    <li><a href="{{url('/')}}/home">Home</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="footer-inner-content4">
                            <div class="quick-view">
                                <h5>Contact Info</h5>
                                <ul>
                                    <li>{{$contact_info->phone}}</li>

                                    <p style="color: #fff;margin-top: 4px;margin-bottom: 7px; font-weight: bold;">
                                        Working ours</p>
                                    <li>{{$contact_info->phone_text}}</li>
                                    <!-- <li>Friday &amp; Saturday : Close</li> -->
                                    <!-- <li>Help Line Number (Mobile)</li> -->
                                    <!-- <li class="helpNumber">01867268422, 01866785183, 01866785184</li> -->
                                    <!-- <li>Help Line Number (Tel)</li> -->
                                    <!-- <li class="helpNumber"> -->
                                        <!-- 02-48317513, 02-48317519 -->
                                    <!-- </li> -->
                                    <li>Email Address</li>
                                    <li class="emailaddress">
                                    {{$contact_info->email}}
                                    </li>
                                    <li>Address</li>
                                    <li class="emailaddress">
                                    {{$contact_info->address}}
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- <div class="footer-inner-content5">
                            <div class="quick-view">
                                <h5>Visitor Counter</h5>
                                <div class="">
                                    <ul>

                                        <li><i class="fa fa-desktop" aria-hidden="true"> </i> Today Total Visitors :
                                            <b>202</b>
                                        </li>

                                        <li><i class="fa fa-users" aria-hidden="true"> </i> Grand Total From 30 Jun 2021
                                            : 620968<b></b>
                                    </ul>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-12 text-center">
                    <div class="social_widget">
                        @foreach($social_icons as $social_icon)
                            @if (@$social_icon->url != "")
                                <a class="icon_1" href="{{@$social_icon->url}}">
                                    <i class="{{$social_icon->icon}}"></i>
                                </a>
                            @endif
                        @endforeach
                    </div>
                    <div class="copyright">
                        <p>© Copyright 2022 , All Rights Reserved<br>Powered by Shikkha App Demo, A product of <a
                                href="#">Source Code Ltd</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <script src="{{asset('public/')}}/frontend/js/jquery.min.js"></script>
    <script src="{{asset('public/')}}/frontend/js/popper.min.js"></script>
    <script src="{{asset('public/')}}/frontend/js/bootstrap.min.js"></script>
    <script src="{{asset('public/')}}/frontend/js/custom.js"></script>

    <script>
        $(document).ready(function () {
            $('.tab-list').click(function () {
                $(this).toggleClass('tab-list-bootom-border');
                $(this).siblings().removeClass('tab-list-bootom-border');
            });
        });
    </script>
    <script src="{{asset('public/')}}/frontend/js/venobox.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.venobox').venobox();
        });
    </script>
    <script src="{{asset('public/')}}/frontend/js/wow.min.js"></script>
    <script src="../cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script>
        $('.eventslider').slick({
            dots: false,
            infinite: true,
            speed: 1000,
            autoplay: true,
            arrows: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    </script>

@yield('script')

</body>
</html>