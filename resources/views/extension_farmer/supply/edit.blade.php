
@extends('master')

@section('content')
<div class="container">
<div class="py-2 text-center">
  <h1>Surplus <i class="fa fa-edit text-primary"></i> </h1>
  <h5>Ref. No: <b>{{$nextNumber}}</b></h5>
  <hr>
</div>
<form method="POST" action="{{route('ex-supply-update',$individuals->id)}}"  >
    @csrf
<div class="row">
  <div class="col-md-4 order-md-2 mb-4">
    <h4 class="d-flex justify-content-between align-items-center mb-3">
      <span class="text-muted">Surplus list</span>
      @isset($counts)
      <span class="badge badge-secondary badge-pill">{{$counts}}</span>
      @endisset
      
    </h4>
    <ul class="list-group mb-3">
      @isset($supplys)
      @foreach($supplys as $supply)
      <li class="list-group-item d-flex justify-content-between lh-condensed">
        <div>
          <h6 class="my-0 text-primary">{{$supply->product}}</a></h6>
          <small class="text-muted">{{$supply->type}}</small>
        </div>
        <small class="text-muted">Q. {{$supply->quantity}} @ Nu. {{$supply->price}}</small>
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
              <option value="{{$producttype->id}}" {{($individuals->productType_id == $producttype->id) ? 'selected' : '' }}>
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
          <div class="col-md-4 mb-3">
              <label for="qty">Quantity*</label>
              <input type="text" value="{{ $individuals->quantity}}" class="form-control" name="quantity" id="quantity" required>
              <div class="invalid-feedback">
                  Please enter Quantity.
              </div>
          </div>
          <div class="col-md-4 mb-3">
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
          <div class="col-md-4 mb-3">
              <label for="unit">Price* (tentative)</label>
              <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text">Nu.</span>
                  </div>
                  <input type="text" value="{{ $individuals->price}}" class="form-control" name="price" id="price" required>
                  <div class="invalid-feedback" style="width: 100%;">
                  Price is required.
                  </div>
              </div>
          </div>
          <div class="col-md-6 mb-3">
              <label for="unit">HarvestDate<font color="red">*</font></label>
              <input type="date" value="{{$individuals->harvestDate}}" class="form-control" name="date" id="date" required>
              <div class="input-group">
                  <div class="invalid-feedback" style="width: 100%;">
                  Price is required.
                  </div>
              </div>
          </div>
          <div class="col-md-6 mb-3">
              <label for="qty">tentativePickupDate*</label>
              <input type="date" value="{{$individuals->tentativePickupDate}}" class="form-control" name="date" id="date" required>
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
      <button class="btn btn-primary btn-lg btn-block" type="submit">Update</button><br>
      {{-- <a class="btn btn-success btn-lg btn-block text-white" onclick="myFunction()">Submit</a> --}}

    </form>
  </div>
</div>
</form>
  {{-- {!! Form::close() !!} --}}
@endsection

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
          window.location = "/national/";
        });
      }
      else {
          
      }
    }
    
</script>