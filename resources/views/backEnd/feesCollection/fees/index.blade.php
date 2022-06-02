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
            <h1 class="m-0">Fees Collection</h1>
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
                <h3 class="card-title">All Student List </h3>
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
              		<label>Session</label>
              		 <select class="form-control submitable" name="session_id" id="session_id">
              		 	<option value="">All</option>
              		 	  @foreach($sessions as $row)
              		 	    <option value="{{ $row->id }}">{{ $row->session }}</option>
              		 	  @endforeach  
              		 </select>
              	</div>
              	
              	<div class="form-group col-3">
              		<label>Status</label>
              		 <select class="form-control submitable" name="active_status" id="active_status">
              		 	<option value="1">All</option>
              		 	    <option value="1">Active</option>
  							<option value="0">Inactive</option>
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
                      <th>Session</th>
                      <th>Fee</th>
                      <th>Phone</th>
                      <th>Admission Date</th>
                      <th>Type</th>
                      <th>Status</th>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" defer></script>
<script type="text/javascript">
	$(function products(){
		table=$('.ytable').DataTable({
			"processing":true,
		    "serverSide":true,
		    "searching":true,
		    "ajax":{
		       "url": "{{ route('fees.collection') }}", 
		       "data":function(e) {
		          e.class_id =$("#class_id").val();
		          e.session_id =$("#session_id").val();
		          e.active_status =$("#active_status").val();
		       }
		    },
			columns:[
				{data:'roll_no',name:'roll_no'},
				{data:'student_photo',name:'student_photo'},
				{data:'full_name'  ,name:'full_name'},
				{data:'class_name'  ,name:'class_name'},
				{data:'session',name:'session'},
				{data:'monthly_fee',name:'monthly_fee'},
				{data:'mobile',name:'mobile'},
				{data:'admission_date',name:'admission_date'},
				{data:'student_type',name:'student_type'},
				{data:'active_status',name:'active_status'},
				{data:'action',name:'action',orderable:true, searchable:true},
			]
		});
	});



	//submitable class call for every change
  $(document).on('change','.submitable', function(){
    $('.ytable').DataTable().ajax.reload();
  });

</script>
@endsection