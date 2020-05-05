@extends('master')

@section('content')

{{-- @include('flash-message') --}}

<div class="container-fluid"> 
<div class="card card-info">
<div class="card-header">
<h3 class="card-title">Add Unit</h3>
</div>
<form role="form" method="POST" action="{{route('unit-store')}}">
@csrf

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

<div class="card-body">
  <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Unit:<font color="red">*</font></label>
            <input id="unit" type="text" class="form-control" name="unit" maxlength="50" placeholder="Enter unit..."/>
          </div>                
        </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-info float-left">Submit</button>
    </div>
</div>        
</form>
</div>
</div>


@endsection
