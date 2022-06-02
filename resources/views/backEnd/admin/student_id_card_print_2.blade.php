<!DOCTYPE html>
<html>
<head>
    <title>@lang('lang.student_id_card')</title>
    {{-- <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/bootstrap.css" /> --}}
    {{-- <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/style.css" /> --}}
    <style>
        .final {

            display: flex;
            margin: 2rem 0;
            padding: 5px,0,5px,0
           
        }
        .final-content{
            display:flex;
            justify-content: center;
            align-items:center;
            flex-direction:column;
            grid-row-gap:2rem;
        }

        .main {
            position: absolute;
            width: inherit;
            margin-top: 153px;
            display: grid;
            grid-template-columns: 30% 70%;



        }

        .studentid {
            padding: 6px;
            width: 263px;
            position: absolute;
            border-radius: 10px;
            background-color: #82376f;
            margin-top: 105PX;
            margin-left: 177px;
            color: #5db663;
            text-align: center;
            font-weight: bold;
        }

        .key {
            vertical-align: top;
            text-align: left;
            color: #6e9ebe;
            width: 161px;
        }

        .value {
            vertical-align: top;
            text-align: left;
            width: 250px;
            color: #c75a78;
          }

        table {
            font-weight: bold;
            height: 20px;
        }

        .photo {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .photo1 {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .imgContaiter {

            border: 2px solid;
            height: 111px;
            width: 135px;
            border-radius: 10px;
              background-size: auto;
             
        }
         .imgContaiter img {
   border-radius: 10px;
        }

        .container {
            width: 603px;
            height: 357px;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
            border: 2px dotted;
        }

        .header {
            position: absolute;
            display: flex;
            flex-direction: row;
            justify-content: center;
            background-color: #266771;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            height: 92px;
            width: inherit;
            font-weight: bold;
        }


        .footer {
            position: absolute;
            width: inherit;
            height: 69px;
            margin-top: 288px;
            background-color: #5db663;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
            text-align: center;
            font-weight: bold;

        }
        .content {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;            
        }

        p{
            margin: 0;
        }

        .logocontainer{
            margin-right: 20px;
        }

    </style>
</head>
@php

@endphp
<body id="abc">
    
    @php
        // dd($students);
        $logo=App\SmGeneralSettings::first()->logo;
        // dd($logo);
    @endphp
        <input type="button" onclick="printDiv('abc')" id="button" class="primary-btn small fix-gr-bg" value="print" />

       
           

    <div class="final-content">
        @foreach ( $students as $ss)
       
                <div class="final">
    
                    <div class="container">
                        <div class="header">
                            <div class="logocontainer"><img style='height: 100%; width: 100%; object-fit:cover' src="{{asset($logo)}}" alt="img not added yet"></div>
                            
                            <div class="content">
                                <p style="color:red">{{ $id_card->title }}</p>
                              
            
                            </div>
                        </div>
                        <div class="studentid">
                            Student ID : {{ $ss->user->username }}
                        </div>
            
                        <div class="main">
                            <div class="photo">
                                <div class="imgContaiter"><img style='height: 100%; width: 100%; object-fit:cover' src="{{asset($ss->student_photo)}}" alt="img not added yet"></div>
                            </div>
                            <div class="info">
                                <table>
                                    <tbody>
            
                                        <tr>
                                            <td class="key">
                                                Student Name
                                            </td>
            
                                            <td class="value">
                                                <span>: </span> {{ $ss->full_name}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="key">
                                                Class
                                            </td>
                                            <td class="value">
                                                <span>: </span>{{ $ss->class->class_name}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="key">
                                                Section
                                            </td>
                                            <td class="value">
                                                <span>: </span>{{ $ss->sections[0]->section_name}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="key">
                                                Roll No
                                            </td>
                                            <td class="value">
                                                <span>: </span>{{ $ss->roll_no }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="key">
                                                DOB
                                            </td>
                                            <td class="value">
                                                <span>: </span>{{$ss->date_of_birth}}
                                            </td>
                                        </tr>
            
                                    </tbody>
            
                                </table>
            
                            </div>
            
            
                        </div>
                        <div class="footer">
                            <div class="content">
                                <p style="color:red">Address: {{ optional($ss->school)->address}}</p>
                                <p style="color:red">phone :{{  optional($ss->school)->phone  }}</p>
                            </div>
                        </div>
            
            
                    </div>
            
                </div>
        
        @endforeach
    </div>


           
         

           
    
       
		
    <script src="{{asset('public/backEnd/')}}/vendors/js/jquery-3.2.1.min.js"></script>
    <script>


        
function printDiv(divName) {

    // document.getElementById("button").remove();

     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
            </script>
</body>
</html>

