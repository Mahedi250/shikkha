@extends('backEnd.master')

@section('title') 

@lang('lang.collect_fees')

@endsection
@section('css')

@endsection
@section('mainContent')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Fees Collect</h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-3">
            <div class="card">
            	@if($student->student_photo !==NULL)
            	<img class="card-img-top" src="{{ $student->student_photo }}" alt="Card image cap">
            	@else
            	<img class="card-img-top" src="{{ asset('public/uploads/student/no_photo.jpg') }}" alt="Card image cap">
            	@endif
                <div class="card-body">
                	<h5 class="card-title">Name: {{ $student->full_name }}</h5>
                	<h5 class="card-title">Roll: {{ $student->roll_no }}</h5>
                	<h5 class="card-title">Fee: {{ $student->monthly_fee }}</h5>
                </div>
	        </div>
	        <div class="card">
	        	<div class="card-header">
	        		Fees History Of {{ date('Y') }}
	        	</div>
	        	<div class="card-body">
	        		<table class="table">
	        			@foreach($history as $his)
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
	        	</div>
	        </div>

	      </div>

	       <div class="col-9">
	    <form id="fees_collect" action="{{ route('store.fees') }}" method="POST" >
           @csrf
            <div class="card">
            	<div class="card-header">Fees Collect</div>
                <div class="card-body">
                	<h4>Choose Fees Month</h4>
                	<div class="row m-2">
	                	<div class="form-check form-check-inline col-lg-3">
						  <input class="form-check-input month_name cal" name="fees_month[]" type="checkbox" id="inlineCheckbox1" value="1">
						  <label class="form-check-label" for="inlineCheckbox1">January</label>
						</div>
						<div class="form-check form-check-inline col-lg-3">
						  <input class="form-check-input month_name cal" name="fees_month[]" type="checkbox" id="inlineCheckbox2" value="2">
						  <label class="form-check-label" for="inlineCheckbox2">February</label>
						</div>
						<div class="form-check form-check-inline col-lg-3">
						  <input class="form-check-input month_name cal" name="fees_month[]" type="checkbox" id="inlineCheckbox3" value="3" >
						  <label class="form-check-label" for="inlineCheckbox3">March</label>
						</div>
                	</div>
                	
					<div class="row m-2">
	                	<div class="form-check form-check-inline col-lg-3">
						  <input class="form-check-input month_name cal" name="fees_month[]" type="checkbox" id="april" value="4">
						  <label class="form-check-label" for="april">April</label>
						</div>
						<div class="form-check form-check-inline col-lg-3">
						  <input class="form-check-input month_name cal" name="fees_month[]" type="checkbox" id="may" value="5">
						  <label class="form-check-label" for="may">May</label>
						</div>
						<div class="form-check form-check-inline col-lg-3">
						  <input class="form-check-input month_name cal" name="fees_month[]" type="checkbox" id="june" value="6" >
						  <label class="form-check-label" for="june">June</label>
						</div>
                	</div>

                	<div class="row m-2">
	                	<div class="form-check form-check-inline col-lg-3">
						  <input class="form-check-input month_name cal" name="fees_month[]" type="checkbox" id="july" value="7">
						  <label class="form-check-label" for="july">July</label>
						</div>
						<div class="form-check form-check-inline col-lg-3">
						  <input class="form-check-input month_name cal" name="fees_month[]" type="checkbox" id="august" value="8">
						  <label class="form-check-label" for="august">August</label>
						</div>
						<div class="form-check form-check-inline col-lg-3">
						  <input class="form-check-input month_name cal" name="fees_month[]" type="checkbox" id="september" value="9" >
						  <label class="form-check-label" for="september">September</label>
						</div>
                	</div>
                	<input type="hidden" name="monthly_fee_amount" id="monthly_fee_amount" value="{{ $student->monthly_fee }}">
                	<div class="row m-2">
	                	<div class="form-check form-check-inline col-lg-3">
						  <input class="form-check-input month_name cal" name="fees_month[]" type="checkbox" id="october" value="10">
						  <label class="form-check-label" for="october">October</label>
						</div>
						<div class="form-check form-check-inline col-lg-3">
						  <input class="form-check-input month_name cal" name="fees_month[]" type="checkbox" id="november" value="11">
						  <label class="form-check-label" for="november">November</label>
						</div>
						<div class="form-check form-check-inline col-lg-3">
						  <input class="form-check-input month_name cal" name="fees_month[]" type="checkbox" id="december" value="12" >
						  <label class="form-check-label" for="december">December</label>
						</div>
                	</div><br>
                	<h4>Admission Fees</h4>
                	<div class="row m-2">
	                	<div class="form-check form-check-inline col-lg-3">
						  <input class="form-check-input cal" name="admission_fee" type="checkbox" id="admission_fee" value="{{ $student->admission_fee }}" @isset($admission) disabled @endisset>
						  <label class="form-check-label" for="admission_fee">Admission Fee ({{ $student->admission_fee }} )</label>
						</div>
                	</div>
                	<br>
                	<h4>Choose Other Fees</h4>
                	<div>
                	  <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <div class="col-md-6">
                                	<div class="row m-2">
                                	  @foreach($fees as $row)
					                	<div class="form-check form-check-inline col-lg-3">
										  <input class="form-check-input  cal fees_type" name="fees_type[]" type="checkbox" id="{{ $row->fees_name }}" data-price="{{ $row->amount }}"  value="{{ $row->id }}">
										  <label class="form-check-label" for="{{ $row->fees_name }}">{{ $row->fees_name }}</label>
										  
										</div>
									  @endforeach
				                	</div>
                                 {{--    <label><b>Select Other Fees :</b></label>
                                    <select name="fees_id" class="form-control form-control-sm selectpicker"
                                        data-live-search="true" id="fees_id">
                                        <option disabled selected>--Choose One--</option>
                                        @foreach($fees as $row)
                                        <option value="{{ $row->id }}">{{ $row->fees_name }} - {{ $row->amount }}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <div class="">
                                    	  <div class="create_fees_table">
						                    <div class="">
						                        <table class="table table-sm">
						                            <thead class="">
						                                <tr>
						                                    <th>Fee Type</th>
						                                    <th>Amount</th>
						                                    <th>Action</th>
						                                </tr>
						                            </thead>
						                            <tbody id="fees_row">
						                                
						                            </tbody>
						                        </table>
						                    </div>
						                </div>
                                    </div> --}}<hr>
                                    <div class="row">
	                                    <div class="col-lg-4">
	                                    	 <div class="form-group row">
											    <label for="inputEmail3" class="col-sm-4 col-form-label"> Fine</label>
											    <div class="col-sm-6">
											      <input type="text" name="fine" value="0" class="form-control form-control-sm cal" id="fine" >
											    </div>
											  </div>
											  <div class="form-group row">
											    <label for="inputEmail3" class="col-sm-4 col-form-label">Discount</label>
											    <div class="col-sm-6" placeholder="00.00">
											      <input type="text" name="discount_amount" value="0" class="form-control form-control-sm cal" id="discount_amount" >
											    </div>
											  </div>
	                                    </div>

	                                    <div class="col-lg-4">
	                                    	 <div class="form-group row">
											    <label for="inputEmail3" class="col-sm-4 col-form-label">Slip</label>
											    <div class="col-sm-6">
											      <input type="text" name="slip" class="form-control form-control-sm" >
											    </div>
											  </div>
											  <div class="form-group row">
											    <label for="inputEmail3" class="col-sm-4 col-form-label">Note</label>
											    <div class="col-sm-6" >
											      <input type="text" name="note" class="form-control form-control-sm"  >
											    </div>
											  </div>
	                                    </div>

	                                    <div class="col-lg-4">
	                                    	 <div class="form-group row">
											    <label for="inputEmail3" class="col-sm-4 col-form-label">Payment</label>
											    <div class="col-sm-6">
											      <select class="niceSelect w-100 bb " id="payment_mode" name="payment_mode">
											      	<option value="cash">Cash</option>
											      	<option value="bank">Bank</option>
											      </select>
											    </div>
											  </div>
											  <div class="form-group row">
											    <label for="inputEmail3" class="col-sm-4 col-form-label">Year</label>
											    <div class="col-sm-6">
											      <select class="niceSelect w-100 bb form-control" name="fees_year" id="year">
											      	<option value="2020" @if(date('Y')=='2020') selected @endif>2020</option>
											      	<option value="2021" @if(date('Y')=='2021') selected @endif>2021</option>
											      	<option value="2022" @if(date('Y')=='2022') selected @endif>2022</option>
											      	<option value="2023" @if(date('Y')=='2023') selected @endif>2023</option>
											      	<option value="2024" @if(date('Y')=='2024') selected @endif>2024</option>
											      	<option value="2025" @if(date('Y')=='2025') selected @endif>2025</option>
											      	<option value="2026" @if(date('Y')=='2026') selected @endif>2026</option>
											      	<option value="2027" @if(date('Y')=='2027') selected @endif>2027</option>
											      	<option value="2028" @if(date('Y')=='2028') selected @endif>2028</option>
											      	<option value="2029" @if(date('Y')=='2029') selected @endif>2029</option>
											      	<option value="2030" @if(date('Y')=='2030') selected @endif>2030</option>
											      </select>
											    </div>
											  </div>

											  <div class="form-group row">
											    <label for="inputEmail3" class="col-sm-4 col-form-label">Total</label>
											    <div class="col-sm-6" >
											      <input type="text"  name="total" class="form-control form-control-sm total" id="total" required>
											          @if($errors->has('total'))
											      	    <p class="text-danger">{{ $errors->first('total') }}</p>
											      	@endif
											    </div>
											    
											  </div>
	                                    </div>
	                                    <!--all necessary hidden filed-->
	                                    <input type="hidden" name="student_id" value="{{ $student->id }}" id="student_id">

	                                  
	                                    
	                                    <div class="m-3"><br>
	                                    	<button type="submit" class="btn btn-primary"  style="float: right;">SUBMIT</button>
	                                    </div>

	                                </div> 
	                                <button  class="btn btn-info" id="print" style="float: right;"><span class="d-none" id="loading_button">... </span>print</button> 
                                </div>
                            </div>
                        </div>
                      </div>
                	</div>
                </div>
	          </div>
	        </form>
	      </div>

	     

	  </div>
	</div>
</section>
</div>

@endsection

@section('script')
<script type="text/javascript">

	 $(function() {   
	   $('.cal').change(function () {   
	   	  var sum = 0;

		    var vals = $(".fees_type:checked")
		      .map(function() {
		        return +this.dataset.price
		      })
		      .get();
		    var other_fee = vals.length>0 ? vals.reduce((a, b) => a + b) : 0; // if no, zero sum

		    //__monthly fee__//
		    var monthly_fee = {{ $student->monthly_fee }};
		    var month_cout=$('.month_name:checked').length;
		    let month_amount=Number(monthly_fee*month_cout);

	    	//__admission fee checking__//
	        if ($("#admission_fee").is(':checked')) {
	        	var admission_fee = {{ $student->admission_fee }};
	        }else{
	        	var admission_fee =0;
	        }

	        let fine=$('#fine').val();
            let discount_amount=$('#discount_amount').val();

            sum=Number(parseInt(month_amount)+parseInt(admission_fee)+parseInt(fine)+parseInt(other_fee)-parseInt(discount_amount));

		    $('#total').val(sum);
		  })

         
     })

	
	
	 $(document).on('change', '#fees_id', function() {
            var id = $(this).val();
            var name = $(this).data('name');
            var count = 0;

            $('.create_fees_table table').find('tr').each(function() {
                if ($(this).data('id') == id) {
                    count++;
                }
            });

            if (id && count == 0) {
                $.ajax({
                    url: "{{ url('fees/create/person/wise/row/') }}" + "/" + id,
                    type: 'get',
                    success: function(data) {
                        $('#fees_row').append(data);
                    }
                });
            }
        });

	    $(document).on('click', '.btn_remove', function() {
            $(this).closest('tr').remove();
        });

        //__month name on change check month is exist or not__//
        $(document).on('click', '.month_name', function() {
            var month_id = $(this).val();
            var student_id = $('#student_id').val();
            var year = $('#year').val();
            $.ajax({
                url: "{{ url('check/month/for/fees/') }}" + "/" + month_id+ "/" +student_id+ "/" +year,
                type: 'get',
                success: function(data) {
                	if (data.error) {
                		$( ".month_name" ).prop( "checked", false );
                		alert('this month already paid');
                		$('#fees_collect')[0].reset();
                	}
                   
                }
            });
        });

        //__print slip after collect fees__//
        $('#print').on('click', function(e) {
        	e.preventDefault();
        	//__admission fee checking__//
	        if ($("#admission_fee").is(':checked')) {
	        	var admission_fee =$('#admission_fee').val();
	        }else{
	        	var admission_fee =0;
	        }

        	//array catch for months__//
        	var checkboxes_value = [];
        	$('.month_name').each(function(){  
	            if(this.checked) {              
	                 checkboxes_value.push($(this).val());                                                                               
	            }  
	        }); 
	        checkboxes_value = checkboxes_value.toString(); 

	        //__feestype__//
	        var fees_type = [];
        	$('.fees_type').each(function(){  
	            if(this.checked) {              
	                 fees_type.push($(this).val());                                                                               
	            }  
	        }); 
	        fees_type = fees_type.toString(); 

	       

            $.ajax({
                url: "{{ route('fees.collect.invoice') }}",
                type: 'get',
                data: {
                    student_id: $('#student_id').val(),
                    fees_months:checkboxes_value,
                    monthly_fee: $('#monthly_fee_amount').val(),
                    admission_fee: admission_fee,
                    fine: $('#fine').val(),
                    discount_amount: $('#discount_amount').val(),
                    total: $('#total').val(),
                    fees_type: fees_type,
                    // fees_type_amount: fees_type_amount,
                },
                success: function(data) {
                     $('.loading_button').addClass('d-none');
                    //return;
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