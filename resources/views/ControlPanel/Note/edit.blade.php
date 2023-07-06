@extends('ControlPanel.parent')
@section('title','Dashboard')
@section('lg_title','Edit Note')
@section('main_title','Note')
@section('sm_title','Edit Note')
@section('content')

<div class="col-md-12">
  <!-- general form elements -->
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Edit Note</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form id="create-form">
      @csrf
      <div class="card-body">
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" id="title" placeholder="Enter the Title" value="{{$note->title}}">
        </div>

        <div class="form-group">
          <label>Description</label>
          <textarea class="form-control" rows="3" id="description" placeholder="Description" style="height: 120px;">{{$note->description}}</textarea>
        </div>
        <div class="card-footer">
          <button type="button" onclick="performUpdate('{{$note->id}}')" class="btn btn-primary">Save</button>
        </div>
    </form>
  </div>
</div>
</div>
@endsection
@section('scripts')
<script src="{{asset('cms/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

<script>
   function performUpdate(id) {
    var formData = new FormData();
    formData.append('title', document.getElementById('title').value);
    formData.append('description', document.getElementById('description').value);
      formData.append('_method','PUT');
      axios.post('/notes/{{$note->id}}', formData)
      .then(function(response) {
        console.log(response);
        toastr.success(response.data.message);
        window.location.href = '/notes';
      })
      .catch(function(error) {
        console.log(error.response);
        toastr.error(error.response.data.message);
      });
  }
</script>
@endsection
