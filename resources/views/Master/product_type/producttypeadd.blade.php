@extends('master')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
  <form class="form-horizontal" method="POST" action = "{{route('product-type-store')}}">
    @csrf
  <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Add Product Type</h3>
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
                  <label>Product Type:<font color="red">*</font></label>
                  <input id="producttype" type="text" class="form-control" name="producttype" maxlength="50" placeholder="Enter product type..."/>
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
          <h3 class="card-title">Product Type List</h3>
        </div>
        <div class="card-body">
              <table id="example1" class="table table-bordered">
                <thead>                  
                  <tr>
                    <th>Sl. No.</th>
                    <th>Type</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($ptypes as $ptype)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$ptype->type}}</td> 
                    <td>
                      <a href="{{ route('product-type-edit',[$ptype->id]) }}" class="btn btn-primary btn-xs" onclick="return confirm('Are you sure to you want to edit this data?');"> Edit</a> &nbsp;
                      <a href="{{ route('product-type-delete',[$ptype->id]) }}" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to you want to delete this data?');">Delete</a>
                    </td>                     
                  </tr>
      @endforeach  
                        
                </tbody>
              </table>
        </div>
    </div>
         
</div>



@endsection
