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

                                            <a href="{{route('notes.edit', $note->id)}}" class="btn btn-warning btn-flat">
                                                <i class="fas fa-edit"></i></a>
                                            <a href="#" onclick="confirmDelete('{{$note->id}}', this)" class="btn btn-danger">
                                                <i class="fas fa-trash"></i></a>
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
    function confirmDelete(id, reference) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                performDelete(id, reference);
            }
        });
    }

    function performDelete(id, reference) {
        axios.delete('/notes/' + id)
            .then(function(response) {
                console.log(response);
                // toastr.success(response.data.message);
                reference.closest('tr').remove();
                showMessage(response.data);
            })
            .catch(function(error) {
                console.log(error.response);
                // toastr.error(error.response.data.message);
                showMessage(error.response.data);
            });
    }

    function showMessage(data) {
        Swal.fire(
            data.title,
            data.text,
            data.icon
        );
    }
</script>
@endsection
