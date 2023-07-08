@extends('ControlPanel.parent')
@section('title','Dashboard')
@section('lg_title','Note')
@section('main_title','View Note')
@section('sm_title','All Note')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Index Note</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 5%">#</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th style="width: 20%">Setting</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($notes as $note)
                                <tr>
                                    <td>{{$loop->index +1}}</td>
                                    <td><a href="{{route('notes.show',$note->id)}}">{{$note->title}}</a></td>
                                    <td>{{$note->description}}</td>
                                    <td>
                                        <div class="btn-group">
                                                <a href="#" onclick="confirmRestore('{{$note->id}}', this)" class="btn btn-primary">
                                                    <i class="fas fa-undo"></i>
                                                  </a>


                                                <a href="#" onclick="confirmForceDelete('{{$note->id}}')" class="btn btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                  </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
@section('scripts')

<script>
function confirmRestore(id, reference) {
  Swal.fire({
    title: 'Are you sure?',
    text: "To restore this note!",
    icon: 'warning',
    showCancelButton: true,
    cancelButtonColor: '#d33',
    confirmButtonColor: '#3085d6',
    confirmButtonText: 'Yes, restore it!'
  }).then((result) => {
    if (result.isConfirmed) {
      performRestore(id, reference);
    }
  });
}
function performRestore(id, reference) {
  axios.post(`/notes/${id}/restore`)
    .then(response => {
      console.log('Note restored:', response.data);
      window.location.href = '/notes';

    })
    .catch(error => {
      console.error('Error restoring note:', error);
    });
}

  function confirmForceDelete(noteId) {
    Swal.fire({
      title: 'Are you sure To Delete it?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      cancelButtonColor: '#d33',
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        performForceDelete(noteId);
      }
    });
  }

  function performForceDelete(noteId) {
    axios.delete(`/notes/${noteId}/forceDelete`)
      .then(response => {
        console.log('Note deleted Successfully:', response.data);
        window.location.href = '/notes';
      })
      .catch(error => {
        console.error('Error performing forcedelete:', error);
      });
  }

</script>
@endsection
