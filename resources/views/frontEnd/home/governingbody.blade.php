@extends('frontEnd.home.front_master')

@push('css')
   <!-- <link rel="stylesheet" href="{{asset('public/')}}/frontend/css/new_style.css"/> -->
@endpush

@section('main_content')
 
  @php

  $testimonial=App\SmTestimonial::all();
 // dd($testimonial);
  @endphp
      
    <section class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-title">
                        <h3>Governing Body</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
 
    <section class="page-content">
        <div class="container">
        
            <div class="row">
                <div class="col-md-9">
                 @foreach($testimonial as $value)
                    <div class="row">
                       
                       
                       <div class="col-sm-2 col-md-4">
                         
                       </div>
                        <div class="col-sm-10 col-md-4">
                            <div class="governing-box">
                                <div class="teacherImageMain">
                                    <a href="#" data-toggle="modal" data-target="#exampleModal2">
                                        <div class="teacherImage">
                                            <img src="{{asset($value->image)}}" alt="Miss Watson" class="d-block w-100">

                                         
                                        </div>
                                        <div class="teacherName">
                                            <h4>{{$value->name}}</h4>
                                            <p>{{$value->designation}}</p>
                                       </div>
                                    </a>
                                    
                                </div>
                            </div>
                        </div>
                         
                    </div>
                  @endforeach
                    
                    </div>
                
                <div class="col-md-3">
                    <div class="page-sidebar mt-2">
                        <i class="fa fa-check-square-o" aria-hidden="true"></i> Related Topics
                    </div>
                    <div class="page-sidebar-list">
                        <ul class="list-group">
                            <li class="list-group-item"><a href="{{url('/')}}/about"><i class="fa fa-angle-double-right"
                                        aria-hidden="true"></i>Why Choose Us</a></li>
                            <li class="list-group-item"><a href="{{url('/')}}/message"><i
                                        class="fa fa-angle-double-right" aria-hidden="true"></i> Message </a></li>
                           
                            <li class="list-group-item"><a href="{{url('/')}}/governingbody"><i
                                        class="fa fa-angle-double-right" aria-hidden="true"></i> Governing Body</a></li>
                            <li class="list-group-item"><a href="{{url('/')}}/mission"><i
                                        class="fa fa-angle-double-right" aria-hidden="true"></i> Mission & Vision</a>
                            </li>
                            
                    

                        </ul>
                    </div>
                </div>
                
            </div>
          
        </div>
    </section>

@endsection