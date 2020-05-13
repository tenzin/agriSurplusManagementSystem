@extends('master')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
  <form class="form-horizontal" method="POST" action = "{{route('cunit-store')}}">
    @csrf
  <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Add Cultivation Unit</h3>
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
              <label for="cunit">Cultivation Unit:<font color="red">*</font></label>
              <input id="cunit" type="text" class="form-control" name="cunit" maxlength="50" placeholder="Enter unit..." required/>
            </div>                
          </div>
      </div>
          </div>
          <!-- /.card-body -->
          @csrf
          <div class="card-footer">
            <a href="{{ url()->current() }}" class="btn btn-danger">Reset</a>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
  </div>
</form>

    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Cultivation Units List</h3>
        </div>
        <div class="card-body">
              <table id="example1" class="table table-bordered">
                <thead>                  
                  <tr>
                    <th>Sl. No.</th>
                    <th>Units</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($cunits as $cunit)
                            <tr>
                              <td>{{$loop->iteration}}</td>
                              <td>{{$cunit->unit}}</td> 
                              <td>                    
                                <a href="{{ route('cunit-edit',[$cunit->id]) }}" class="btn btn-primary btn-xs" onclick="return confirm('Are you sure to you want to edit this data?');"> Edit</a> &nbsp;
                                <a href="{{ route('cunit-delete',[$cunit->id]) }}" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to you want to delete this data?');"> Delete</a>                      
                              </td>                     
                            </tr>
                @endforeach            
                </tbody>
              </table>
        </div>
    </div>
         
</div>


@endsection
