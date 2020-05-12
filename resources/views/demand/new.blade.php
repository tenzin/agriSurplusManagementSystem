@extends('master')

@section('content')
<div class="container">
<div class="py-2 text-center">
  <h1><i class="fa fa-plus text-success"></i> Demand </h1>
  <h5>Ref. No: <b>{{$nextNumber}}</b></h5>
  <small>Enter the product that you wish to buy.</small>
  @isset($msg)
    <p>{{$msg}}</p>
  @endisset
  <hr>
</div>
{!! Form::open(['action' => 'DemandController@store','method' => 'POST','enctype'=>'multipart/form-data']) !!}
{{Form::text('refnumber',$nextNumber,['class'=>'form-control','id'=>'refnumber', 'hidden'=>'true'])}}
<div class="row">
  <div class="col-md-4 order-md-2 mb-4">
    <h4 class="d-flex justify-content-between align-items-center mb-3">
      <span class="text-muted">Demand list</span>
      @isset($counts)
      <span class="badge badge-secondary badge-pill text-warning">{{$counts}}</span>
      @endisset
      
    </h4>
    <ul class="list-group mb-0">
      @isset($demands)
        @foreach($demands as $demand)
          <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
            <h6 class="my-0 text-primary">
              <a href="/demand/{{$demand->id}}/edit">
              <i class="fa fa-edit" aria-hidden="true"> </i> {{$demand->product}}</a>
            </h6>
              <small class="text-muted">{{$demand->type}}</small>
            </div>
            <small class="text-muted">Qty. {{$demand->quantity}} @ Nu. {{$demand->price}}</small>
            <a onclick="return confirm('Are you sure want do delete permanently?')" href="/demand-delete/{{$demand->id}}" class="text-danger">
              <i class="fa fa-trash" aria-hidden="true"> </i> Remove</a>
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
            @foreach($products as $row)
                <option value="{{$row->id}}">{{$row->type}}</option>
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
          </select>
          <div class="invalid-feedback">
            Please provide a valid state.
          </div>
        </div>
      </div>

      <div class="row">
          <div class="col-md-3 mb-3">
              <label for="qty">Quantity*</label>
              {{Form::text('quantity',null,['class'=>'form-control','id'=>'quantity', 'placeholder' =>'Quantity'])}}
              <div class="invalid-feedback">
                  Please enter Quantity.
              </div>
          </div>
          <div class="col-md-3 mb-3">
              <label for="unit">Unit*</label>
              <div class="input-group">
                  <select class="custom-select d-block w-100" id="unit" name="unit" required>
                  <option value="">Choose...</option>
                  @foreach($units as $unit)
                      <option value="{{$unit->id}}">{{$unit->unit}}</option>
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
                  {{Form::text('price',null,['class'=>'form-control','id'=>'price', 'placeholder' =>'Price'])}}
                  <div class="invalid-feedback" style="width: 100%;">
                  Price is required.
                  </div>
              </div>
          </div>
          <div class="col-md-3 mb-3">
              <label for="qty">Required Date*</label>
              {{Form::date('date',null,['class'=>'form-control','id'=>'date', 'placeholder' =>'Required Date'])}}
              <div class="invalid-feedback">
                  Please enter date of requirement.
              </div>
          </div>
      </div>

      <div class="row">
          <div class="col-md-12 mb-3">
              <label for="unit">Remarks</label>
              <textarea class="form-control" id="remarks" name="remarks" cols="50" rows="2" id="remarks" placeholder="If any ...."></textarea>
                  <div class="invalid-feedback" style="width: 100%;">
                  Price is required.
                  </div>
          </div>
      </div>

      <hr class="mb-4">
      <button class="btn btn-primary btn-lg btn-block" type="submit">ADD NEW</button><br>
      <div class="jumbotron py-3" style="background-color: orange">
      <h3>Important!!!</h3>
          <i>Your demand list are saved temporarily. Unless it is submitted, other 
            potential suppliers cannot view it. 
            You must <b>SUBMIT</b> your demand list inorder to viewed by others.</i><br>
          <p><a class="btn btn-success btn-lg text-white py-1" onclick="myFunction()">Submit</a></p>
      </div>

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
      var refNo = document.getElementById("refnumber").value;
      $.get('/json-product-exist?refNo=' + refNo, function(data){
        if(data == null || data ==''){
            alert('Unsuccessful: To submit the demand you need at least one or more product!');
        } else {
            //show some type of message to the user
            if (confirm('Are you sure you want to submit your demand list?. Once you submit, you cannot add or delete or update.'))  {
              var id = document.getElementById("refnumber").value;
              $.get('/json-submit-demand?ref_number=' + id, function(data){

              });
            }
        }
      });
      
    }
    function deletFn() {
      if (confirm('Are you sure you want delete permanently?'))  {
        $.ajax({
          type: "POST",
          url: url,
          success: function(result) {
            location.reload();
          }
        });
      }
    }
    
</script>