<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>card</title>
    <style>
        .final {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .main {
            position: absolute;
            width: inherit;
            margin-top: 198px;
            display: grid;
            grid-template-columns: 20% 40% 40%;



        }

        .studentid {
            padding: 6px;
            width: 152px;
            position: absolute;
            border-radius: 10px;
            background-color: #e04757;
            margin-top: 115PX;
            margin-left: 419px;
            color: #f8aa42;
            text-align: center;
            font-weight: bold;


        }

        .key {

            vertical-align: top;
            text-align: left;
            color: #6e9ebe;
            width: 140px;

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

        .imgContaiter {

            border: 2px solid;
            height: 111px;
            width: 135px;
            border-radius: 10px;
        }

        .container {


            width: 974px;
            height: 432px;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
            border: 2px dotted;




        }

        .header {


            position: absolute;
            text-align: center;
            background-color: #2d8bb0;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            height: 92px;
            width: inherit;
            font-weight: bold;
        }

        .header p {


            margin: 0;
        }


        .footer {
            position: absolute;
            width: inherit;
            height: 44px;
            margin-top: 387px;
            background-color: #4aa593;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
            text-align: center;
            font-weight: bold;

        }

        .footer p {
            margin: 0;
            margin-top: 12px;
        }

        .content {

            display: flex;
            flex-direction: column;


            justify-content: center;
        }

        .subject {


            border-left: 2px solid rgb(205 204 204);
            margin-left: -44px;

        }

        .sublist {
            columns: 2;
            list-style-type: decimal;
            -webkit-columns: 2;
            -moz-columns: 2;
            color: red;
        }
        .final-content{
            display:flex;
            justify-content: center;
            align-items:center;
            flex-direction:column;
            grid-row-gap:2rem;
        }
    </style>
</head>

<body>
    <div class="final-content">
        @php
        //dd($students);
        @endphp
        @foreach ($students as $ss)
        
        <div class="final">

            <div class="container">
                <div class="header">
                    <div class="content">
    
                        <p style="color:red">{{ optional($ss->school)->school_name }}</p>
                        <p style="color:red">Adress : {{ optional($ss->school)->address}}</p>
                        <p style="color:red">phone :{{ optional($ss->school)->phone }}</p>
    
    
                    </div>
                </div>
                <div class="studentid">
                    Admit card
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
                    <div class="subject">
                        <storng style="margin-left: 9px;color: #c75a78;">Exam Term : {{ $examtype->GetExamTitle->title }}</storng>
                        <div style="border-bottom: 2px solid; color: #2d8bb0;margin-left: 8px">Subject</div>
                        <ul class="sublist">
    @foreach ($subject as $sub)
    <li>{{ $sub->GetSubjectName->subject_name }}</li>
    @endforeach
                            {{-- <li>bangla</li>
                            <li>bangla</li>
                            <li>bangla</li>
                            <li>bangla</li>
                            <li>bangla</li> --}}
    
                        </ul>
    
                    </div>
    
    
                </div>
                <div class="footer">
                    <div class="content">
                       
                    </div>
                </div>
    
    
            </div>
    
        </div>
        @endforeach
    </div>
    
</body>

</html>