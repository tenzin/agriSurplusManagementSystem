@extends('layouts.app')

@section('content')
<div class="container">
<div class="py-2 text-center">
  <h1>Demand <i class="fa fa-edit text-primary"></i> </h1>
  <h5>Ref. No: <b>{{$nextNumber}}</b></h5>
  <hr>
</div>
{!! Form::open(['action' => ['DemandController@update',$individuals->id],'method' => 'POST','enctype'=>'multipart/form-data']) !!}
<div class="row">
  <div class="col-md-4 order-md-2 mb-4">
    <h4 class="d-flex justify-content-between align-items-center mb-3">
      <span class="text-muted">Demand list</span>
      @isset($counts)
      <span class="badge badge-secondary badge-pill">{{$counts}}</span>
      @endisset
      
    </h4>
    <ul class="list-group mb-3">
      @isset($demands)
      @foreach($demands as $demand)
      <li class="list-group-item d-flex justify-content-between lh-condensed">
        <div>
          <h6 class="my-0 text-primary">{{$demand->product}}</a></h6>
          <small class="text-muted">{{$demand->type}}</small>
        </div>
        <small class="text-muted">Q. {{$demand->quantity}} @ Nu. {{$demand->price}}</small>
      </li>
      @endforeach
      @endisset
      
    </ul>
  </div>
  <div class="col-md-8 order-md-1">
    <h4 class="mb-3">Product details</h4>
    <form class="needs-validation" novalidate>
    <div class="row">
        <div class="col-md-6 mb-3">
          <label for="country">Product Type*</label>
          <select class="custom-select d-block w-100" id="producttype" name="producttype" required>
            <option value="">Choose...</option>
            @foreach($products as $producttype)
              <option value="
                {{$producttype->id}}" {{($individuals->productType_id == $producttype->id) ? 'selected' : '' }}>
                {{$producttype->type}}</option>
            @endforeach
          </select>
          <div class="invalid-feedback">
            Please select a valid country.
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <label for="state">Product*</label>
          <select class="custom-select d-block w-100" id="product" name="product" required>
            <option value="">Choose...</option>
            @foreach($produce as $row)
              <option value="
                {{$row->id}}" {{($individuals->product_id == $row->id) ? 'selected' : '' }}>
                {{$row->product}}</option>
            @endforeach
          </select>
          <div class="invalid-feedback">
            Please provide a valid state.
          </div>
        </div>
      </div>

      <div class="row">
          <div class="col-md-3 mb-3">
              <label for="qty">Quantity*</label>
              {{Form::text('quantity',$demand->quantity,['class'=>'form-control','id'=>'quantity', 'placeholder' =>'Quantity'])}}
              <div class="invalid-feedback">
                  Please enter Quantity.
              </div>
          </div>
          <div class="col-md-3 mb-3">
              <label for="unit">Unit*</label>
              <div class="input-group">
                  <select class="custom-select d-block w-100" id="unit" name="unit" required>
                  <option value="">Choose...</option>
                  @foreach($units as $row)
                    <option value="
                      {{$row->id}}" {{($individuals->unit_id == $row->id) ? 'selected' : '' }}>
                      {{$row->unit}}</option>
                  @endforeach
                  </select>
                  <div class="invalid-feedback" style="width: 100%;">
                  Unit is required.
                  </div>
              </div>
          </div>
          <div class="col-md-3 mb-3">
              <label for="unit">Price* (tentative)</label>
              <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text">Nu.</span>
                  </div>
                  {{Form::text('price',$individuals->price,['class'=>'form-control','id'=>'price', 'placeholder' =>'Price'])}}
                  <div class="invalid-feedback" style="width: 100%;">
                  Price is required.
                  </div>
              </div>
          </div>
          <div class="col-md-3 mb-3">
              <label for="qty">Required Date*</label>
              {{Form::date('date',$individuals->tentativeRequiredDate,['class'=>'form-control','id'=>'date', 'placeholder' =>'Required Date'])}}
              <div class="invalid-feedback">
                  Please enter date of requirement.
              </div>
          </div>
      </div>

      <div class="row">
          <div class="col-md-12 mb-3">
              <label for="unit">Remarks</label>
              <textarea class="form-control" id="remarks" name="remarks" cols="50" rows="2" 
              id="remarks" placeholder="If any ....">{{$individuals->remarks}}</textarea>
                  <div class="invalid-feedback" style="width: 100%;">
                  Price is required.
                  </div>
          </div>
      </div>

      <hr class="mb-4">
      {{Form::hidden('_method','PUT')}}
      {{Form::submit('UPDATE',['class'=>'btn btn-primary btn-lg btn-block'])}}<br>

    </form>
  </div>
</div>
  {!! Form::close() !!}
@endsection
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
          $(window).on('load', function() {
        console.log('All assets are loaded')
    })
    $(document).ready(function () {

        $("#producttype").on('change',function(e){
            console.log(e);
            var id = e.target.value;
            //alert(id);
            $.get('/json-product_type?product_type=' + id, function(data){
                console.log(data);
                $('#product').empty();
                $('#product').append('<option value="">Select Products</option>');
                $.each(data, function(index, ageproductObj){
                    $('#product').append('<option value="'+ ageproductObj.id +'">'+ ageproductObj.product + '</option>');
                })
            });

        });
        $("#quantity").keypress(function (e) {
          if (e.which != 46)
          {
            if(isNaN(document.getElementById("quantity").value))
            {
              alert('Invalid number!!!!');
              document.getElementById("quantity").style.color = "red";
              return false;
            }
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
              $("#errmsg").html("Digits Only").show().fadeOut("slow");
                  return false;
            }
          }
          document.getElementById("quantity").style.color = "black";
          
      });
      $("#price").keypress(function (e) {
          if (e.which != 46)
          {
            if(isNaN(document.getElementById("price").value))
            {
              alert('Invalid number!!!!');
              document.getElementById("price").style.color = "red";
              return false;
            }
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
              $("#errmsg").html("Digits Only").show().fadeOut("slow");
                  return false;
            }
          }
          document.getElementById("price").style.color = "black";
      });
      
    });
    function myFunction() {
      if (confirm('Are you sure you want to your demand list?. Once you submit, you cannot add or delete or update.'))  {
        var id = document.getElementById("refnumber").value;
        $.get('/json-submit-demand?ref_number=' + id, function(data){
          window.location = "/home/";
        });
      }
      else {
          
      }
    }
    
</script>