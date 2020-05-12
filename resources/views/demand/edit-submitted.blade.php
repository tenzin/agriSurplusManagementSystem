@extends('master')

@section('content')
<style>
   select[readonly] option, select[readonly] optgroup {
        display: none;
    }
</style>
<div class="container">
<div class="py-2 text-center">
  <h1>Demand <i class="fa fa-edit text-primary"> Submitted</i> </h1>
  @foreach($demands as $demand)
  <h5>Ref. No: <b>{{$demand->refNumber}}</b></h5>
  <hr>
</div>

{!! Form::open(['action' => ['DemandController@update_submitted',$demand->id],'method' => 'POST','enctype'=>'multipart/form-data']) !!}
<div class="row">
  <input type="hidden" id="refno" name="refno" value="{{$demand->refNumber}}"/>
  <div class="col-md-12 order-md-1">
    <h4 class="mb-3">Product details</h4>
    <form class="needs-validation" novalidate>
    <div class="row">
        <div class="col-md-6 mb-3">
          <label for="country">Product Type*</label>
          <select class="custom-select d-block w-100" id="producttype" name="producttype" >
            <option value="">Choose...</option>
            @foreach($products as $producttype)
              <option value="
                {{$producttype->id}}" {{($demand->productType_id == $producttype->id) ? 'selected' : '' }}>
                {{$producttype->type}}</option>
            @endforeach
          </select>
          <div class="invalid-feedback">
            Please select a valid country.
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <label for="state">Product*</label>
          <select class="custom-select d-block w-100" id="product" name="product" >
            <option value="">Choose...</option>
            @foreach($produce as $row)
              <option value="
                {{$row->id}}" {{($demand->product_id == $row->id) ? 'selected' : '' }}>
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
              <input type="hidden" id="hqty" name="hqty" value="{{$demand->quantity}}"/>
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
                      {{$row->id}}" {{($demand->unit_id == $row->id) ? 'selected' : '' }}>
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
                  {{Form::text('price',$demand->price,['class'=>'form-control','id'=>'price', 'placeholder' =>'Price'])}}
                  <div class="invalid-feedback" style="width: 100%;">
                  Price is required.
                  </div>
              </div>
          </div>
          <div class="col-md-3 mb-3">
              <label for="unit">Status*</label>
              <div class="input-group">
                  <select class="custom-select d-block w-100" id="status" name="status" required>
                    <option value="A" {{($demand->status == 'A') ? 'selected' : '' }}>
                      Required</option>
                      <option value="S" {{($demand->status == 'S') ? 'selected' : '' }}>
                      Supplied</option>
                      <option value="T" {{($demand->status == 'T') ? 'selected' : '' }}>
                      Transaction</option>
                  </select>
                  <div class="invalid-feedback" style="width: 100%;">
                  Unit is required.
                  </div>
              </div>
          </div>
      </div>

      <div class="row">
          <div class="col-md-12 mb-3">
              <label for="unit">Remarks</label>
              <textarea class="form-control" id="remarks" name="remarks" cols="50" rows="2" 
              id="remarks" placeholder="If any ....">{{$demand->remarks}}</textarea>
                  <div class="invalid-feedback" style="width: 100%;">
                  Price is required.
                  </div>
          </div>
      </div>

      <hr class="mb-4">
      {{Form::hidden('_method','GET')}}
      {{Form::submit('UPDATE',['class'=>'btn btn-primary btn-lg btn-block'])}}<br>

    </form>
    @endforeach
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
                if (confirm('ssAre you sure you want to submit your demand list?. Once you submit, you cannot add or delete or update.'))  {
                var id = document.getElementById("refnumber").value;
                $.get('/json-submit-demand?ref_number=' + id, function(data){

                });
              }
            }
          } 
      });
      
    }
    
</script>