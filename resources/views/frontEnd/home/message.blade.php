@extends('frontEnd.home.front_master')

@push('css')
   <!-- <link rel="stylesheet" href="{{asset('public/')}}/frontend/css/new_style.css"/> -->
@endpush
@php
$testimonials = App\SmTestimonial::all();
//dd($testimonials);
@endphp
@section('main_content')
 
    <section class="inner-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-title">
                        <h3>Message</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="page-content">
        <div class="container">
           @foreach($testimonials as $value)
            <div class="row">
            
                <div class="col-md-8">
                    <div class="quote-details">
                      
                        <div class="quote-img">
                            <img src="{{$value->image}}" width="100%" height="300px" alt="">
                             <div class="page-title">
                                  <h3>Message From {{$value->designation}}</h3>
                             </div>
                            <div class="details mt-4">
                                <p>{{$value->description}}</p>
                            </div>

                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="page-sidebar mt-2">
                        <i  aria-hidden="true">Name: {{$value->name}}</i>
                       
                    </div>
                    <div class="page-sidebar mt-2">
                        
                        <i  aria-hidden="true">Designation: {{$value->designation}}</i>  
                    </div> 

                   
                </div>
            </div>
            @endforeach
        </div>
    </section>

@endsection