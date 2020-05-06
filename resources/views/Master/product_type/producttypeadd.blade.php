@extends('master')

@section('content')

{{-- @include('flash-message') --}}

<div class="container-fluid"> 
<div class="card card-info">
<div class="card-header">
<h3 class="card-title">Add Product Type</h3>
</div>
<form role="form" method="POST" action="{{route('product-type-store')}}">
@csrf

@if ( session('error') || $errors->any())
      <div class="alert alert-danger" id="session_message">
        {{ session('error') }}
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
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

<div class="card-body">

  <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Product Type:<font color="red">*</font></label>
            <input id="producttype" type="text" class="form-control" name="producttype" maxlength="50" placeholder="Enter product type..."/>
          </div>                
        </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-info float-left">Submit</button>
    </div>
</div>        
</form>
<div class="card-header bg-white">
  <div class="card-title">Product Type</div>
</div>
<div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
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
