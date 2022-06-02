@php use Carbon\Carbon; @endphp
<div class="print_area">
    <div class="heading_area">
        <div class="row">
            <div class="col-md-12">
                <div class="company_name text-center">
                    <h3 style="color: black; font-weight:bold;"><b>School Name</b> </h3>
                    <h6 style="color: black; font-weight:bold;">Student Attendance Report
                    </h6>
                </div>
            </div>
        </div>
    </div>
    <table class="w-100 table-border" border="1px">
        <thead>
            <tr>
                <th style="color: black; font-size: 17px;">SL.</th>
                <th style="color: black; font-size: 17px;">Roll.</th>
                <th style="color: black; font-size: 17px;">Name</th>
                <th style="color: black; font-size: 17px;">Class</th>
                <th style="color: black; font-size: 17px;">Date</th>
                <th style="color: black; font-size: 17px;">Status</th>
                <th style="color: black; font-size: 17px;">Note</th>
            </tr>
        </thead>
        <tbody>
            @if (count($attendances) > 0)
                @foreach ($attendances as $row)
                        <tr>
                            <td style="color: black; font-size: 17px; font-weight: bold;">{{ $loop->index + 1 }}</td>
                            <td style="color: black; font-size: 17px; font-weight: bold;">{{ $row->roll_no }}</td>
                            <td style="color: black; font-size: 17px; font-weight: bold;">{{ $row->full_name }}</td>
                            <td style="color: black; font-size: 17px; font-weight: bold;">{{ $row->class_name }}</td>
                            <td style="color: black; font-size: 17px; font-weight: bold;">{{ date('d-m-Y', strtotime($row->attendance_date))  }}</td>
                            <td style="color: black; font-size: 17px; font-weight: bold;">{{ $row->attendance_type }}</td>
                            <td style="color: black; font-size: 17px; font-weight: bold;">{{ $row->notes }}</td>
                        </tr>
                @endforeach
            @else 
                <td colspan="11" class="text-center"><b>There is no data according to date.</b></td>
            @endif
            
        </tbody>
    </table>
     <br>
    <table class="table">
      <tr>
        <th style="font-weight: bold; font-size: 16px; float: left; color:black;" >PREPARED BY ............</th>
        <th style="font-weight: bold; font-size: 16px;"></th>
        <th style="font-weight: bold; font-size: 16px;"></th>
        <th style="font-weight: bold; font-size: 16px;"></th>
        <th style="font-weight: bold; font-size: 16px; color:black;">CHECKED BY ............</th>
      </tr>
    </table>
</div>