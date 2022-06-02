       <div class="row">
          <div class="col-3">
            <div class="card">
            	@if($payment->student_photo !==NULL)
            	<img class="card-img-top" src="{{ $payment->student_photo }}" alt="Card image cap">
            	@else
            	<img class="card-img-top" src="{{ asset('public/uploads/student/no_photo.jpg') }}" alt="Card image cap">
            	@endif
                <div class="card-body">
                	<h5 class="card-title">Name: {{ $payment->full_name }}</h5>
                	<h5 class="card-title">Roll: {{ $payment->roll_no }}</h5>
                </div>
	        </div>
	      </div>

	    <div class="col-9">
        		<div class="card">
        			<div class="card-header">
        				Fees Details
        			</div>
        			<div class="card-body">
        				<table class="table">
        					@foreach($payment_details as $his)
        					<tr>
        						<th>
        							@if($his->fees_type=='monthly')
        							 {{ date('F', strtotime('01-'.$his->fees_month.'-'.$his->fees_year)) }}
        							 @else
        							 {{ $his->fees_type }}
        							 @endif
        						</th>
        						<th>{{ $his->fees_type_amount }}</th>
        					</tr>
        					@endforeach
        				</table>
        				<h3>Total: {{ $payment->amount }} </h3>
        			</div>
        		</div>

	    </div>
	     

	  </div>