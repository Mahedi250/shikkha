<!doctype html>

<html lang="en">

  <head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{ asset('/')}}/public/backEnd/css/report/bootstrap.min.css">

    <title>@lang('lang.student') @lang('lang.fees')</title>

  <style>

    *{

      margin: 0;

      padding: 0;

    }

    body{

      font-size: 12px;

      font-family: 'Poppins', sans-serif;

    }

    .student_marks_table{

      width: 95%;

      margin: 10px auto 0 auto;

    }

    .text_center{

      text-align: center;

    }

    p{

      margin: 0;

      font-size: 12px;

      text-transform: capitalize;

    }

    ul{

      margin: 0;

      padding: 0;

    }

    li{

      list-style: none;

    }

    td {

    border: 1px solid #726E6D;

    padding: .3rem;

    text-align: center;

  }

  th{

    border: 1px solid #726E6D;

    text-transform: capitalize;

    text-align: center;

    padding: .5rem;

  }

  thead{

    font-weight:bold;

    text-align:center;

    color: #222;

    font-size: 10px

  }

  .custom_table{

    width: 100%;

  }

  table.custom_table thead th {

    padding-right: 0;

    padding-left: 0;

  }

  table.custom_table thead tr > th {

    border: 0;

    padding: 0;

}

table.custom_table thead tr th .fees_title{

  font-size: 12px;

  font-weight: 600;

  border-top: 1px solid #726E6D;

  padding-top: 10px;

  margin-top: 10px;

}

.border-top{

  border-top: 0 !important;

}

  .custom_table th ul li {

    display: flex;

    justify-content: space-between;

  }

  .custom_table th ul li p {

    margin-bottom: 5px;

    font-weight: 500;

    font-size: 12px;

}

tbody td p{

  text-align: right;

}

tbody td{

  padding: 0.3rem;

}

table{

  border-spacing: 10px;

  width: 95%;

  margin: auto;

}

.fees_pay{

  text-align: center;

}

.border-0{

  border: 0 !important;

}

.copy_collect{

  text-align: center;

  font-weight: 500;

  color: #000;

}



.copyies_text{

  display: flex;

  justify-content: space-between;

  margin: 10px 0;

}

.copyies_text li{

  text-transform: capitalize;

  color: #000;

  font-weight: 500;

  border-top: 1px dashed #ddd;

}

.school_name{

  font-size: 14px;

  font-weight: 600;

  }

  .print_btn{

    float:right;

    padding: 20px;

    font-size: 12px;

  }

  .fees_book_title{

    display: inline-block;

    width: 100%;

    text-align: center;

    font-size: 12px;

    margin-top: 5px;

    border-top: 1px solid #ddd;

    padding: 5px;

  }

.footer{

  width: 95%;

  margin: auto;

  display: flex;

  justify-content: space-between;

  position: fixed;

  bottom: 30px;

  margin: auto;

  left: 0;

  right: 0;

}

.footer .footer_widget{

  width: 30%;

}

.footer .footer_widget .copyies_text{

  justify-content: space-between;

}

</style>

<style type="text/css" media="print">

    @page { size: A4 landscape; }

  </style>

  </head>

  <script>

    var is_chrome = function () { return Boolean(window.chrome); }

      if(is_chrome){

          //  window.print();

          //  setTimeout(function(){window.close();}, 10000);

           //give them 10 seconds to print, then close

        }else{

           window.print();

        }

  </script>

  <body onLoad="loadHandler();">

        @php  

          $setting = generalSetting();

        @endphp

      <div class="student_marks_table print" >

      <table class="custom_table">

        <thead>

          <tr>

            <!-- first header  -->

            <th colspan="2">

              <div style="float:left; width:30%">

                     {{--  <img src="{{url($setting->logo)}}" style="width:100px; height:auto"   alt=""> --}}
                    @if(! is_null($setting->logo))
                        <img src="{{ asset('public/uploads/settings/logo.png')}}" alt="logo" style="width:100px; height:auto">
                    @else
                        <img src="{{ asset('public/uploads/settings/logo.png')}}" alt="logo" style="width:100px; height:auto">
                    @endif

              </div>

              <div style="float:right; width:70%; text-aligh:left">

                      <h4 class="school_name">{{$setting->school_name}}</h4>

                      <p>{{$setting->address}}</p>

              </div>

                <h4 class="fees_book_title" style="display:inline-block"></h4>

              <ul>

                <li>

                  <p>

                    @lang('lang.admission') @lang('lang.no'): {{@$student->admission_no}}

                  </p> 

                  <p>

                    @lang('lang.date'): {{date('d/m/Y')}}

                  </p>

                </li>

                <li>

                  <p>

                    @lang('lang.student') @lang('lang.name'): {{@$student->full_name}} 

                  </p>

                </li>

                <li>

                  <p>

                    @lang('lang.class'): {{@$student->class->class_name}}

                  </p> 

                  <p>

                    @lang('lang.roll'):{{@$student->roll_no}}

                  </p>

                </li>

                <li>

                  <p>

                    @lang('lang.section'): {{@$student->section->section_name}}

                  </p> 

                  <p>

                  @lang('lang.group'): ___

                  </p>

                </li>

              </ul>

            </th>

            <!-- space  -->

            <th class="border-0" rowspan="9"></th>



            <!-- 2nd header  -->

            <th colspan="2">

                  <div style="float:left; width:30%">

                    @if(! is_null($setting->logo))
                        <img src="{{ asset('public/uploads/settings/logo.png')}}" alt="logo" style="width:100px; height:auto">
                    @else
                        <img src="{{ asset('public/uploads/settings/logo.png')}}" alt="logo" style="width:100px; height:auto">
                    @endif

                  </div>

                  <div style="float:right; width:70%; text-aligh:left">

                    <h4 class="school_name">{{$setting->school_name}}</h4>

                    <p>{{$setting->address}}</p>

                  </div>

                  <h4 class="fees_book_title" style="display:inline-block"></h4>

                  <ul>

                    <li>

                      <p>

                        @lang('lang.admission') @lang('lang.no'): {{@$student->admission_no}}

                      </p> 

                      <p>

                        @lang('lang.date'): {{date('d/m/Y')}}

                      </p>

                    </li>

                    <li>

                      <p>

                        @lang('lang.student') @lang('lang.name'): {{@$student->full_name}} 

                      </p>

                    </li>

                    <li>

                      <p>

                        @lang('lang.class'): {{@$student->class->class_name}}

                      </p> 

                      <p>

                        @lang('lang.roll'):{{@$student->roll_no}}

                      </p>

                    </li>

                    <li>

                      <p>

                        @lang('lang.section'): {{@$student->section->section_name}}

                      </p> 

                      <p>

                      @lang('lang.group'): ___

                      </p>

                    </li>

                  </ul>

            </th>



            <th class="border-0" rowspan="9"></th>

            <!-- space  -->



            <!-- 3rd header  -->

            <th colspan="2">

                <div style="float:left; width:30%">

                  @if(! is_null($setting->logo))
                      <img src="{{ asset('public/uploads/settings/logo.png')}}" alt="logo" style="width:100px; height:auto">
                  @else
                      <img src="{{ asset('public/uploads/settings/logo.png')}}" alt="logo" style="width:100px; height:auto">
                  @endif

                </div>

                <div style="float:right; width:70%; text-aligh:left">

                  <h4 class="school_name">{{$setting->school_name}}</h4>

                  <p>{{$setting->address}}</p>

                </div>

                <h4 class="fees_book_title" style="display:inline-block"></h4>

                <ul>

                  <li>

                    <p>

                      @lang('lang.admission') @lang('lang.no'): {{@$student->admission_no}}

                    </p> 

                    <p>

                      @lang('lang.date'): {{date('d/m/Y')}}

                    </p>

                  </li>

                  <li>

                    <p>

                      @lang('lang.student') @lang('lang.name'): {{@$student->full_name}} 

                    </p>

                  </li>

                  <li>

                    <p>

                      @lang('lang.class'): {{@$student->class->class_name}}

                    </p> 

                    <p>

                      @lang('lang.roll'):{{@$student->roll_no}}

                    </p>

                  </li>

                  <li>

                    <p>

                      @lang('lang.section'): {{@$student->section->section_name}}

                    </p> 

                    <p>

                    @lang('lang.group'): ___

                    </p>

                  </li>

                </ul>

            </th>



          </tr>

        </thead>

        <tbody>

            <tr>

              <!-- first header  -->

                <th>@lang('lang.fees') @lang('lang.details')</th>

                <th>@lang('lang.amount') ({{generalSetting()->currency_symbol}})</th>

                <!-- space  -->

                <th class="border-0" rowspan="6" ></th>

                <!-- 2nd header  -->

                <th>@lang('lang.fees') @lang('lang.details')</th>

                <th>@lang('lang.amount') ({{generalSetting()->currency_symbol}})</th>

                <th class="border-0" rowspan="6" ></th>

                <!-- 3rd header  -->

                <th>@lang('lang.fees') @lang('lang.details')</th>

                <th>@lang('lang.amount') ({{generalSetting()->currency_symbol}})</th>

            </tr>


          <tr>

             <!-- first td wrap  -->

             {{-- @if ($p_amount>0) --}}

                <td class="border-top">
                	
                	@if($admission_fee >0)
                	<p> Admission </p>
                	@endif
                    <p>

                    	@if($fees_months > 0)
                    	  @php
                    	    $month=explode(',',$fees_months);
                    	  @endphp
                    	  @foreach($month as $row)
                    	    {{ date('F', strtotime('01-'.$row.'-'.date('Y'))) }} <br>
                    	  @endforeach
                    	@endif

                    	@if($fees_type)
                    	  @php
                    	    $type=explode(',',$fees_type);
                    	  @endphp
                    	  @foreach($type as $row)
                          @php 
                            $fees_master=DB::table('sm_fees_masters')->where('id',$row)->first();
                          @endphp
                    	    {{ $fees_master->fees_name }} <br>
                    	  @endforeach
                    	@endif

                    </p>

                    {{-- @if ($discount_amount>0) --}}
                    <br>
                      <p>

                        <strong>

                          @lang('lang.discount')(-)

                        </strong> 

                      </p>

                   {{--  @endif

                    @if ($fine>0) --}}

                      <p> 

                        <strong>

                          @lang('lang.fine')(+)

                        </strong> 

                      </p>

                   {{--  @endif --}}

                    {{-- @if ($paid>0) --}}

                     {{--  <p> 

                        <strong>

                          @lang('lang.paid')(+)

                        </strong> 

                      </p> --}}

                   {{--  @endif --}}

                    {{--   <p> 

                        <strong>

                          @lang('lang.unpaid')

                        </strong> 

                      </p> --}}

                </td>



                <td class="border-top" style="text-align: right">
                	
                	@if($admission_fee > 0)
                	 {{number_format($admission_fee, 2, '.', '')}}
                	@endif
                  <p>
                	@if($fees_months>0)
                	  @php
                	    $month=explode(',',$fees_months);
                	  @endphp
                	  @foreach($month as $row)
                	     {{number_format($monthly_fee, 2, '.', '')}} <br>
                	  @endforeach
                    @endif


                    @if($fees_type)
                      @php
                        $type=explode(',',$fees_type);
                      @endphp
                      @foreach($type as $row)
                        @php 
                          $fees_master=DB::table('sm_fees_masters')->where('id',$row)->first();
                        @endphp
                        {{number_format($fees_master->amount, 2, '.', '')}}
                        <br>
                      @endforeach
                    @endif

                  </p> 

                    <br>
                    
                    {{number_format($discount_amount, 2, '.', '')}} 
                   
                      <br>
                     {{number_format($fine, 2, '.', '')}}

                  

                     {{--  <br>

                      paid --}}

                    {{-- @endif --}}

                  {{--   <br>

                  p_amount --}}

                </td>

             {{-- @endif --}}

          



            <!-- 2nd td wrap  -->

            <td class="border-top">
            	@if($admission_fee >0)
            	<p> Admission </p>
            	@endif
                <p>
                	@if($fees_months > 0)
                	  @php
                	    $month=explode(',',$fees_months);
                	  @endphp
                	  @foreach($month as $row)
                	    {{ date('F', strtotime('01-'.$row.'-'.date('Y'))) }} <br>
                	  @endforeach
                	@endif

                	@if($fees_type)
                	  @php
                	    $type=explode(',',$fees_type);
                	  @endphp
                	  @foreach($type as $row)
                	        @php 
                            $fees_master=DB::table('sm_fees_masters')->where('id',$row)->first();
                          @endphp
                          {{ $fees_master->fees_name }} <br>
                	  @endforeach
                	@endif
                </p>

                <br>
                  <p>
                    <strong>
                      @lang('lang.discount')(-)
                    </strong> 
                  </p>

                  <p> 
                    <strong>
                      @lang('lang.fine')(+)
                    </strong> 
                  </p>
            </td>

            



            <td class="border-top" style="text-align: right">
            	
            	@if($admission_fee > 0)
            	 {{number_format($admission_fee, 2, '.', '')}}
            	@endif
              <p>
            	@if($fees_months>0)
            	  @php
            	    $month=explode(',',$fees_months);
            	  @endphp
            	  @foreach($month as $row)
            	     {{number_format($monthly_fee, 2, '.', '')}} <br>
            	  @endforeach
                @endif

                 @if($fees_type)
                    @php
                      $type=explode(',',$fees_type);
                    @endphp
                    @foreach($type as $row)
                      @php 
                        $fees_master=DB::table('sm_fees_masters')->where('id',$row)->first();
                      @endphp
                      {{number_format($fees_master->amount, 2, '.', '')}}
                      <br>
                    @endforeach
                  @endif

              </p> 
                <br>  
                {{number_format($discount_amount, 2, '.', '')}} 
                  <br>
                 {{number_format($fine, 2, '.', '')}}

            </td>


           <!-- 3rd td wrap  -->
           <td class="border-top">
            	@if($admission_fee >0)
            	<p> Admission </p>
            	@endif
                <p>
                	@if($fees_months > 0)
                	  @php
                	    $month=explode(',',$fees_months);
                	  @endphp
                	  @foreach($month as $row)
                	    {{ date('F', strtotime('01-'.$row.'-'.date('Y'))) }} <br>
                	  @endforeach
                	@endif

                	@if($fees_type)
                	  @php
                	    $type=explode(',',$fees_type);
                	  @endphp
                	  @foreach($type as $row)
                	        @php 
                            $fees_master=DB::table('sm_fees_masters')->where('id',$row)->first();
                          @endphp
                          {{ $fees_master->fees_name }} <br>
                	  @endforeach
                	@endif
                </p>

                <br>
                  <p>
                    <strong>
                      @lang('lang.discount')(-)
                    </strong> 
                  </p>

                  <p> 
                    <strong>
                      @lang('lang.fine')(+)
                    </strong> 
                  </p>
            </td>



            <td class="border-top" style="text-align: right">	
            	@if($admission_fee > 0)
            	 {{number_format($admission_fee, 2, '.', '')}}
            	@endif
              <p>
            	@if($fees_months>0)
            	  @php
            	    $month=explode(',',$fees_months);
            	  @endphp
            	  @foreach($month as $row)
            	     {{number_format($monthly_fee, 2, '.', '')}} <br>
            	  @endforeach
                @endif

                  @if($fees_type)
                    @php
                      $type=explode(',',$fees_type);
                    @endphp
                    @foreach($type as $row)
                      @php 
                        $fees_master=DB::table('sm_fees_masters')->where('id',$row)->first();
                      @endphp
                      {{number_format($fees_master->amount, 2, '.', '')}}
                      <br>
                    @endforeach
                  @endif
              </p> 
                <br>  
                {{number_format($discount_amount, 2, '.', '')}} 
                  <br>
                 {{number_format($fine, 2, '.', '')}}

            </td>
          </tr>

         

          <tr>

            <td>

              <p>

                <strong>

                  @lang('lang.total') @lang('lang.payable') @lang('lang.amount')

                </strong>

              </p>

            </td>

            <td style="text-align: right">

              <strong>  {{ number_format((float) $total, 2, '.', '')}}   </strong>

             </td>

            <td>

              <p>

                <strong>

                  @lang('lang.total') @lang('lang.payable') @lang('lang.amount')

                </strong>

              </p>

            </td>

            <td style="text-align: right">
              <strong>{{ number_format((float) $total, 2, '.', '')}}</strong>
            </td>

            <!-- 3rd td wrap  -->

            <td>

              <p>

                <strong>

                  @lang('lang.total') @lang('lang.payable') @lang('lang.amount')

                </strong>

              </p>

            </td>

            <td style="text-align: right">
              <strong> {{ number_format((float) $total, 2, '.', '')}} </strong>
             </td>

          </tr>

          

          <tr>

          </tr>



          <tr>

                <td colspan="2" >

                  @lang('lang.if') @lang('lang.unpaid'),

                  @lang('lang.admission') @lang('lang.will_be') @lang('lang.cancelled') @lang('lang.after')

                </td>

                <!-- 2nd td wrap  -->

                <td colspan="2" >

                  @lang('lang.if') @lang('lang.unpaid'),

                  @lang('lang.admission') @lang('lang.will_be') @lang('lang.cancelled') @lang('lang.after')

                </td>

                <!-- 3rd td wrap  -->

                <td colspan="2" >

                  @lang('lang.if') @lang('lang.unpaid'),

                  @lang('lang.admission') @lang('lang.will_be') @lang('lang.cancelled') @lang('lang.after')

                </td>

          </tr>



          <tr>

                <td colspan="2">

                  <p class="parents_num text_center"> 

                    @lang('lang.parents') @lang('lang.phone') @lang('lang.number') : 

                    <span>

                     {{@$parent->guardians_mobile}} 

                    </span> 

                  </p>

                </td>

                <!-- 2nd td wrap  -->

                <td colspan="2">

                  <p class="parents_num text_center"> 

                    @lang('lang.parents') @lang('lang.phone') @lang('lang.number') : 

                    <span>

                      {{@$parent->guardians_mobile}} 
                      
                    </span> 

                  </p>

                </td>

                <!-- 2nd td wrap  -->

                <td colspan="2">

                  <p class="parents_num text_center"> 

                    @lang('lang.parents') @lang('lang.phone') @lang('lang.number') : 

                    <span>

                     {{@$parent->guardians_mobile}} 
                    
                    </span> 

                  </p>

                </td>

          </tr>

        </tbody>

      </table>

    </div>

<footer class="footer" >

  <div class="footer_widget">

    <ul class="copyies_text">

      <li>@lang('lang.parent')/@lang('lang.student')</li>

      <li>@lang('lang.casier')</li>

      <li>@lang('lang.officer')</li>

    </ul>

    <p class="copy_collect">

      @lang('lang.parent')/@lang('lang.student') @lang('lang.copy')

    </p>

  </div>

  <div class="footer_widget">

      <ul class="copyies_text">

        <li>

          @lang('lang.parent')/@lang('lang.student')

        </li>

        <li>

          @lang('lang.casier')

        </li>

        <li>

          @lang('lang.officer')

        </li>

      </ul>

      <p class="copy_collect">

        @lang('lang.parent')/@lang('lang.student') @lang('lang.copy')

      </p>

    </div>

    <div class="footer_widget">

        <ul class="copyies_text">

          <li>

            @lang('lang.parent')/@lang('lang.student')

          </li>

          <li>

            @lang('lang.casier')

          </li>

          <li>

            @lang('lang.officer')

          </li>

        </ul>

        <p class="copy_collect">

          @lang('lang.parent')/@lang('lang.student') @lang('lang.copy')

        </p>

      </div>

</footer>

 {{--  <script>

    function printInvoice() {

      window.print();

    }

  </script>

  <script src="{{ asset('/') }}/public/backEnd/js/fees_invoice/jquery-3.2.1.slim.min.js"></script>

  <script src="{{ asset('/') }}/public/backEnd/js/fees_invoice/popper.min.js"></script>

  <script src="{{ asset('/') }}/public/backEnd/js/fees_invoice/bootstrap.min.js"></script> --}}

</body>

</html>

