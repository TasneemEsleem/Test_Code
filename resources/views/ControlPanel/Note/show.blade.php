@extends('ControlPanel.parent')
@section('title','Dashboard')
@section('lg_title','Note')
@section('main_title','Show Note')
@section('sm_title','Note')
@section('content')
 <!-- Main content -->
 <section class="content">
 <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Title :{{$note->title}}</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
      Description :  {{$note->description}}
    </div>
      <!-- /.card-body -->
      <div class="card-footer">

      </div>
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
@endsection
