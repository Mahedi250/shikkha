<form action="{{ route('update.fees_master') }}" method="Post" id="add-form">
      @csrf
      <input type="hidden" name="id" value="{{ $data->id }}">
      <div class="modal-body">
          <div class="form-group">
            <label for="category_name">Fees Name/Title</label>
            <input type="text" class="form-control"  name="fees_name" value="{{ $data->fees_name }}" required="" >
            <small id="emailHelp" class="form-text text-muted">This is fees name</small>
          </div>
          <div class="form-group">
            <label for="category_name">Amount</label>
            <input type="text" class="form-control"  name="amount" value="{{ $data->amount }}" required="" >
          </div>
          <div class="form-group">
            <label for="category_name">Due Date</label>
            <input type="date" class="form-control"  name="date" value="{{ $data->date }}" required="">
          </div> 
          <div class="form-group">
            <label for="category_name">Status</label>
            <select class="form-control" name="active_status">
                <option value="1" @if($data->active_status==1) selected @endif>Active</option>
                <option value="0" @if($data->active_status==0) selected @endif>Inactive</option>
            </select>
          </div>     
      </div>
      <div class="modal-footer">
        <button type="Submit" class="btn btn-primary">Update</button>
      </div>
      </form>