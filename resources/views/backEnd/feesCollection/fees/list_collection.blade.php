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
            <h1 class="m-0">Manage Fees Collection</h1>
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
                <h3 class="card-title">All Collection List </h3>
              </div><br>
              <div class="row p-2">
              	<div class="form-group col-3">
              		<label>Student</label>
              		 <select class="form-control submitable" name="student_id" id="student_id">
              		 	<option value="">All</option>
              		 	  @foreach($students as $row)
              		 	    <option value="{{ $row->id }}">{{ $row->full_name }} - roll:{{ $row->roll_no }}</option>
              		 	  @endforeach  
              		 </select>
              	</div>
              	<div class="form-group col-3">
              		<label>Date</label>
              		<input type="date" name="payment_date" id="payment_date" class="form-control submitable">
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
                      <th>Class</th>
                      <th>Roll</th>
                      <th>Photo</th>
                      <th>Name</th>
                      <th>Payment Date</th>
                      <th>Fine</th>
                      <th>Discount</th>
                      <th>Amount</th>
                      <th>Method</th>
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

{{-- view modal --}}
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Details Of Invoice</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <div id="modal_body">
     		
     </div>	
    </div>
  </div>
</div>

@endsection

@section('script')

<script type="text/javascript">
	$(function products(){
		table=$('.ytable').DataTable({
			"processing":true,
		    "serverSide":true,
		    "searching":true,
		    "ajax":{
		       "url": "{{ route('list.collection') }}", 
		       "data":function(e) {
		          e.student_id =$("#student_id").val();
		          e.payment_date =$("#payment_date").val();
		          e.month =$("#month").val();
		       }
		    },
			columns:[
				{data:'class_name',name:'class_name'},
				{data:'roll_no',name:'roll_no'},
				{data:'student_photo',name:'student_photo'},
				{data:'full_name'  ,name:'full_name'},
				{data:'payment_date'  ,name:'payment_date'},
				{data:'fine',name:'fine'},
				{data:'discount_amount',name:'discount_amount'},
				{data:'amount',name:'amount'},
				{data:'payment_mode',name:'payment_mode'},
				{data:'action',name:'action',orderable:true, searchable:true},
			]
		});
	});



	//submitable class call for every change
  $(document).on('change','.submitable', function(){
    $('.ytable').DataTable().ajax.reload();
  });

  //__view request pass__//
  	$('body').on('click','.view', function(){
		let id=$(this).data('id');
		$.ajax({
            url: "{{ url('view/single/fees/') }}" + "/" + id,
            type: 'get',
            success: function(data) {
            	$("#modal_body").html(data);
            }
        });
	});


    //__view request pass__//
  $('body').on('click','.print', function(){
  let id=$(this).data('id');
  $.ajax({
          url: "{{ url('print/single/fees/') }}" + "/" + id,
          type: 'get',
          success: function(data) {
            $(data).printThis({
                      debug: false,
                      importCSS: true,
                      importStyle: true,
                      removeInline: false,
                      printDelay: 500,
                      header: null,
                      footer: null,
                  });
          }
      });
  });

</script>
@endsection