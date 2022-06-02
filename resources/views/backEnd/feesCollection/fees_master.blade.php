@extends('backEnd.master')

@section('title') 

@lang('lang.fees_master')

@endsection

@section('mainContent')

@push('css')

@endpush

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Fees Master</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button class="btn btn-primary" data-toggle="modal" data-target="#addModal"> + Add New</button>
            </ol>
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
                <h3 class="card-title">All Others Fees</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <table id="" class="table table-bordered table-striped table-sm ytable">
                    <thead>
                    <tr>
                      <th>SL</th>
                      <th>Name/Title</th>
                      <th>Amount</th>
                      <th>Date</th>
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

{{-- category insert modal --}}
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Fees Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <form action="{{ route('store.fees_master') }}" method="Post" id="add-form">
      @csrf
      <div class="modal-body">
          <div class="form-group">
            <label for="category_name">Fees Name/Title</label>
            <input type="text" class="form-control"  name="fees_name" required="" >
            <small id="emailHelp" class="form-text text-muted">This is fees name</small>
          </div>
          <div class="form-group">
            <label for="category_name">Amount</label>
            <input type="text" class="form-control"  name="amount" required="" >
          </div>
          <div class="form-group">
            <label for="category_name">Due Date</label>
            <input type="date" class="form-control"  name="date" required="">
          </div> 
          <div class="form-group">
            <label for="category_name">Status</label>
            <select class="form-control" name="active_status">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
          </div>     
      </div>
      <div class="modal-footer">
        <button type="Submit" class="btn btn-primary"> <span class="d-none"> loading..... </span>  Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>

{{-- edit modal --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Fees Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     <div id="modal_body">
            
     </div> 
    </div>
  </div>
</div>


<script type="text/javascript">
    $(function childcategory(){
        var table=$('.ytable').DataTable({
            processing:true,
            serverSide:true,
            searching:false,
            ajax:"{{ route('fees-master') }}",
            columns:[
                {data:'DT_RowIndex',name:'DT_RowIndex'},
                {data:'fees_name'  ,name:'fees_name'},
                {data:'amount',name:'amount'},
                {data:'date',name:'date'},
                {data:'active_status',name:'active_status'},
                {data:'action',name:'action',orderable:true, searchable:true},

            ]
        });
    });


  $('body').on('click','.edit', function(){
    let id=$(this).data('id');
        $.ajax({
            url: "{{ url('edit/master/fees/') }}" + "/" + id,
            type: 'get',
            success: function(data) {
                $("#modal_body").html(data);
            }
        });
  });

</script>
@endsection

