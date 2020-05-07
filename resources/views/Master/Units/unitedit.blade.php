@extends('master')

@section('content')

<div class="content-header">
  <form class="form-horizontal" method="POST" action = "{{route('unit-update',$unit->id)}}">
    @csrf
  <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Edit Unit</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
              @if ($errors->any())
              <div class="col-sm-12">
                  <div class="alert  alert-warning alert-dismissible fade show" role="alert">
                      @foreach ($errors->all() as $error)
                          <span><p>{{ $error }}</p></span>
                      @endforeach
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                  </div>
              </div>
          @endif
          
          @if (session('success'))
              <div class="col-sm-12">
                  <div class="alert  alert-success alert-dismissible fade show" role="alert">
                      {{ session('success') }}
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                  </div>
              </div>
          @endif
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="unit">Unit:<font color="red">*</font></label>
                <input id="unit" type="text" class="form-control" name="unit" maxlength="50" value="{{ $unit->unit }}"/>
               
              </div>                
            </div>
        </div>
          </div>
          <!-- /.card-body -->
          @csrf
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
  </div>
</form>


@endsection
