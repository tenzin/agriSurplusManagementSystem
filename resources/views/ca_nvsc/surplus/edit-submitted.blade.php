@extends('master')

@section('content')
<style>
   select[readonly] option, select[readonly] optgroup {
        display: none;
    }
</style>
<div class="container">
<div class="py-2 text-center">
  <h1>Surplus <i class="fa fa-edit text-primary"> Submitted</i> </h1>
  @foreach($supply as $supply)
  <h5>Ref. No: <b>{{$supply->refNumber}}</b></h5>
  <hr>
</div>

{{-- {!! Form::open(['action' => ['DemandController@update_submitted',$demand->id],'method' => 'POST','enctype'=>'multipart/form-data']) !!} --}}
<form method="POST" action="{{route('update_submited',$supply->id)}}" >
@csrf
<div class="row">
  <input type="hidden" id="refno" name="refno" value="{{$supply->refNumber}}"/>
  <div class="col-md-12 order-md-1">
    <h4 class="mb-3">Product details</h4>
    <form class="needs-validation" novalidate>
    <div class="row">
        <div class="col-md-6 mb-3">
          <label for="country">Product Type*</label>
          <select class="custom-select d-block w-100" id="producttype" name="producttype" readonly>
            <option value="">Choose...</option>
            @foreach($products as $producttype)
              <option value="
                {{$producttype->id}}" {{($supply->productType_id == $producttype->id) ? 'selected' : '' }}>
                {{$producttype->type}}</option>
            @endforeach
          </select>
          <div class="invalid-feedback">
            Please select a valid country.
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <label for="state">Product*</label>
          <select class="custom-select d-block w-100" id="product" name="product" readonly>
            <option value="">Choose...</option>
            @foreach($produce as $row)
              <option value="
                {{$row->id}}" {{($supply->product_id == $row->id) ? 'selected' : '' }}>
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
          <label for="unit">Status*</label>
          <div class="input-group">
              <select class="custom-select d-block w-100" id="status" name="status" required readonly>
                {{-- <option value="A" {{($supply->status == 'A') ? 'selected' : '' }}>
                  Required</option>
                  <option value="S" {{($supply->status == 'S') ? 'selected' : '' }}>
                  Supplied</option> --}}
                  <option value="T" {{($supply->status == 'T') ? 'selected' : '' }}>
                  Transaction</option>
              </select>
              <div class="invalid-feedback" style="width: 100%;">
              Unit is required.
              </div>
          </div>
      </div>
          <div class="col-md-3 mb-3">
            <label for="qty">Taken Quantity*</label>
            <input type="hidden" id="hqty" name="hqty" value="{{$supply->quantity}}"/>
            <input type="text" value="{{ $supply->quantity}}" class="form-control" name="quantity" id="quantity" required>
            {{-- {{Form::text('quantity',$demand->quantity,['class'=>'form-control','id'=>'quantity', 'placeholder' =>'Quantity'])}} --}}
            <div class="invalid-feedback">
                Please enter Quantity.
            </div>
        </div>
          <div class="col-md-3 mb-3">
              <label for="unit">Unit*</label>
              <div class="input-group">
                  <select class="custom-select d-block w-100" id="unit" name="unit" required readonly>
                  <option value="">Choose...</option>
                  @foreach($units as $row)
                    <option value="
                      {{$row->id}}" {{($supply->unit_id == $row->id) ? 'selected' : '' }}>
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
                  <input type="text" value="{{$supply->price}}" name="price" id="price" >
                  {{-- {{Form::text('price',$demand->price,['class'=>'form-control','id'=>'price', 'placeholder' =>'Price'])}} --}}
                  <div class="invalid-feedback" style="width: 100%;">
                  Price is required.
                  </div>
              </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="qty">Tentative PickUp Date*</label>
            <input type="date" value="{{$supply->tentativePickupDate}}" class="form-control" name="date" id="date" required readonly>
            {{-- {{Form::date('date',$individuals->tentativeRequiredDate,['class'=>'form-control','id'=>'date', 'placeholder' =>'Required Date'])}} --}}
            <div class="invalid-feedback">
                Please enter date of requirement.
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="qty">Harvest Date*</label>
            <input type="date" value="{{$supply->harvestDate}}" class="form-control" name="harvestdate" id="harvestdate" required readonly>
            {{-- {{Form::date('date',$individuals->tentativeRequiredDate,['class'=>'form-control','id'=>'date', 'placeholder' =>'Required Date'])}} --}}
            <div class="invalid-feedback">
                Please enter date of requirement.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="unit">Remarks</label>
            <textarea class="form-control" id="remarks" name="remarks" cols="50" rows="2" 
            id="remarks" placeholder="If any ....">{{$supply->remarks}}</textarea>
                <div class="invalid-feedback" style="width: 100%;">
                Price is required.
                </div>
        </div>
      </div>

      {{-- <hr class="mb-4">
      {{Form::hidden('_method','GET')}}
      {{Form::submit('UPDATE',['class'=>'btn btn-primary btn-lg btn-block'])}}<br> --}}
      <hr class="mb-4">
      <button class="btn btn-primary btn-lg btn-block" type="submit">Update</button><br>
    </form>
    @endforeach
  </div>
</div>
  {{-- {!! Form::close() !!} --}}
</form>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
          $(window).on('load', function() {
        console.log('All assets are loaded')
    })
    $(document).ready(function () {
        document.getElementById("producttype").setAttribute("readonly", "true");
        document.getElementById("product").setAttribute("readonly", "true");
        $("#quantity").keypress(function (e) {
          if (e.which != 46)
          {
            if(isNaN(document.getElementById("type").value))
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
      var refNo = document.getElementById("refnumber").value,
      $this = this; //aliased so we can use in ajax success function
      $.ajax({
          type: 'POST',
          url: '/json-product-exist',
          data: {refNo: refNo},
          success: function(data){
            
            if(data == null){
                alert('Unsuccessful: To submit the demand you need at least onr or more product!');
            } else {
                //show some type of message to the user
                if (confirm('Are you sure you want to submit your demand list?. Once you submit, you cannot add or delete or update.'))  {
                var id = document.getElementById("refnumber").value;
                $.get('/json-submit-supply?ref_number=' + id, function(data){
                  window.location = "/national/";
                });
              }
            }
          } 
      });
      
    }
    
</script>