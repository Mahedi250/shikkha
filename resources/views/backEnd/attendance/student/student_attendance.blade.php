@extends('backEnd.master')

@section('title') 

@lang('lang.collect_fees')

@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endsection
@section('mainContent')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Student Attendance List</h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              	 <a class="btn btn-primary btn-sm" style="float:right; color:white;" id='print'>print</a>{{ route('student.attendance.print') }}
                <h3 class="card-title">All Student Attendance </h3>

              </div><br>
              <div class="row p-2">

              	<div class="form-group col-3">
              		<label>Class</label>
              		 <select class="form-control submitable" name="class_id" id="class_id">
              		 	<option value="">All</option>
              		 	  @foreach($classes as $row)
              		 	    <option value="{{ $row->id }}">{{ $row->class_name }}</option>
              		 	  @endforeach  
              		 </select>
              	</div>

              	<div class="form-group col-3">
              		<label>Date</label>
              		 <input type="date" class="form-control submitable" name="attendance_date" id="attendance_date">
              	</div>
              	
              	<div class="form-group col-3">
              		<label>Students</label>
              		 <select class="form-control submitable" name="student_id" id="student_id">
              		 	<option value="">All</option>
              		 	@foreach($students as $row)
              		 	    <option value="{{ $row->id }}">{{ $row->full_name }}</option>
  						@endforeach
              		 </select>
              	</div>

              	<div class="form-group col-3">
              		<label>Month</label>
              		 <select class="form-control submitable" name="month" id="month">
              		 	<option value="">All</option>
              		 	<option value="1">January</option>
              		 	<option value="2">February</option>
              		 	<option value="3">March</option>
              		 	<option value="4">April</option>
              		 	<option value="5">May</option>
              		 	<option value="6">June</option>
              		 	<option value="7">July</option>
              		 	<option value="8">August</option>
              		 	<option value="9">September</option>
              		 	<option value="10">October</option>
              		 	<option value="11">November</option>
              		 	<option value="12">December</option>
              		 </select>
              	</div>

              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <table id="" class="table table-bordered table-striped table-sm ytable">
                    <thead>
                    <tr>
                      <th>Roll</th>
                      <th>Photo</th>
                      <th>Name</th>
                      <th>Class</th>
                      <th>Attendance Date</th>
                      <th>Attendance Type</th>
                      <th>Note</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                  
                    </tbody>
                  </table>
                </div>
	          </div>
	      </div>
	  </div>
	</div>
</section>
</div>

@endsection

@section('script')

<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" defer></script>
<script type="text/javascript">
	$(function products(){
		table=$('.ytable').DataTable({
			"processing":true,
		    "serverSide":true,
		    "searching":false,
		    "lengthMenu": [ 15, 30, 40, 50, 75, 100 ,1000,100000 ],
		    "ajax":{
		       "url": "{{ route('student.attendance') }}", 
		       "data":function(e) {
		          e.class_id =$("#class_id").val();
		          e.attendance_date =$("#attendance_date").val();
		          e.student_id =$("#student_id").val();
		          e.month =$("#month").val();
		       }
		    },
			columns:[
				{data:'roll_no',name:'roll_no'},
				{data:'student_photo',name:'student_photo'},
				{data:'full_name'  ,name:'full_name'},
				{data:'class_name'  ,name:'class_name'},
				{data:'attendance_date',name:'attendance_date'},
				{data:'attendance_type',name:'attendance_type'},
				{data:'notes',name:'notes'},
				{data:'action',name:'action',orderable:true, searchable:true},
			]
		});
	});



	//submitable class call for every change
  $(document).on('change','.submitable', function(){
    $('.ytable').DataTable().ajax.reload();
  });

      $('body').on('click', '#print', function() {
        $('.loading_button').show();
            $.ajax({
                url: "{{ route('student.attendance.print') }}",
                type: 'get',
                data:{class_id : $('#class_id').val(), attendance_date: $('#attendance_date').val(),student_id: $('#student_id').val(),month: $('#month').val() },
                success: function(data) {
                    //return;
                    $(data).printThis({
                        debug: false,
                        importCSS: true,
                        importStyle:true,
                        removeInline: false,
                        printDelay: 500,
                        header: null,
                        footer: null,
                    });
                    $('.loading_button').hide();
                }
            });
        }); 

</script>
@endsection