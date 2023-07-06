@extends('ControlPanel.parent')
@section('title','Dashboard')
@section('lg_title','Create Note')
@section('main_title','Note')
@section('sm_title','Create Note')
@section('content')

<div class="col-md-12">
  <!-- general form elements -->
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Create Note</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form id="create-form">
      @csrf
      <div class="card-body">
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" id="title" placeholder="Enter the Title" value="{{old('title')}}">
        </div>

        <div class="form-group">
          <label>Description</label>
          <textarea class="form-control" rows="3" id="description" placeholder="Description" style="height: 120px;"></textarea>
        </div>

        <div class="card-footer">
          <button type="button" onclick="performStore()" class="btn btn-primary">Save</button>
        </div>
    </form>
  </div>
</div>
</div>
@endsection
@section('scripts')
<script src="{{asset('cms/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

<script>
  function performStore() {
    var formData = new FormData();
    formData.append('title', document.getElementById('title').value);
    formData.append('description', document.getElementById('description').value);

    axios.post('/notes', formData)
      .then(function(response) {
        console.log(response);
        toastr.success(response.data.message);
        //  document.getElementById('create-form').reset();
        window.location.href = '/notes';
      })
      .catch(function(error) {
        console.log(error.response);
        toastr.error(error.response.data.message);
      });
  }
</script>
@endsection
