@extends('master')

@section('content')

{{-- @include('flash-message') --}}

<div class="container-fluid"> 
<div class="card card-info">
<div class="card-header">
<h3 class="card-title">Edit Cultivation Unit</h3>
</div>
<form role="form" method="POST" action="{{route('cunit-update',$unit->id)}}">
@csrf
<div class="card-body">
  <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="cunit">Cultivation Unit:<font color="red">*</font></label>
            <input id="cunit" type="text" class="form-control" name="cunit" maxlength="50" value="{{ $unit->unit }}"/>
           
          </div>                
        </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-info float-left">Update</button>
    </div>
</div>        
</form>
</div>
</div>


@endsection
