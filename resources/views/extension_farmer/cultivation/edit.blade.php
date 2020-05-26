@extends('master')

@section('content')
<section class="content">
<div class="container-fluid"> 
<div class="card card-info">
  <div class="card-header">
    <h2 class="text-center mt-1 mb-1 alert aqua">Edit Area Under Cultivation Form</h2>
  </div>
{{-- <div class="card-header">
<h3 class="card-title">Edit Area Under Cultivation</h3>
</div> --}}
<form role="form" method="POST" action="{{route('cultivation-update',$cultivation->id)}}">
 @csrf
<div class="card-body">
  <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label>Crop Name:</label>
              <select  name="crop" id="crop" class="form-control select2bs4">
                @foreach($product as $p)
                <option value="{{ $p->id }}"
                 {{($cultivation->product_id == $p->id) ? 'selected' : '' }}>
                   {{$p->product}}
                </option>
                @endforeach
              </select>
          </div> 
          <div class="form-group">
            <label>Estimated Output:&nbsp;</label>
            <input id="output" type="text" class="form-control" value="{{$cultivation->estimated_output}}" name="output">
          </div>
        </div>
        
          <div class="col-md-4">
            <div class="form-group">
              <label>Quantity/Acerage:<small>(Should be in Acres or number)</small>&nbsp;</label>
               <input id="quantity" type="text" class="form-control" name="quantity" value="{{$cultivation->quantity}}"/>
            </div>
            <div class="form-group">
              <label>Estimated Output unit:&nbsp;</label>
              <select  name="e_unit" id="e_unit" class="form-control select2bs4">
                <option disabled selected>{{$cultivation->unit}}</option>
                @foreach($e_unit as $e)
                <option value="
                {{$e->id}}" {{($cultivation->e_units == $e->id) ? 'selected' : '' }}>
                {{$e->unit}}
                </option>

                @endforeach
                </select>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label>units:&nbsp;</label>
              <select  name="unit" id="unit" class="form-control select2bs4">
              <option disabled selected>{{$cultivation->Unit}}</option>
              @foreach($c_unit as $c)
                <option value="{{ $c->id }}" {{($cultivation->c_units) ? 'selected':''}}>
                {{$c->unit}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Sowing_date:&nbsp;</label>
              <input id="date" type="month" class="form-control" name="date" value="{{$cultivation->sowing_date}}"/>
            </div>
          </div>

            <div class="col-md-12">
            <div class="form-group">
              <label>Remarks:&nbsp;<small>(Please mention location or address)</small></label>
              <textarea class="form-control" rows="3" name="remarks">{{$cultivation->remarks}}</textarea>
            </div>
          </div>
        </div>            
        </div>

        <div class="card-footer">
        <div class="form-group row mb-0">
          <div class="col-md-6 offset-md-4">
              <button type="submit" class="btn btn-success btn-sm">Update</button>
                 <a class="btn btn-primary btn-sm" href="{{ route('view_cultivation_details')}}">Go back</a>
            </div>
      </div>
    </div>
</form>
</div>
</div>
</section>

</div>
</div>
@endsection
   
     












