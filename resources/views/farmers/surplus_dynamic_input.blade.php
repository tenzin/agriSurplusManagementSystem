@extends('master')

@section('content')
<div class="container">
<div>Entry of Surplus. &nbsp;&nbsp;&nbsp;Ref. No: &nbsp;<b>{{$nextNumber}}</b></div>
      <!-- parent field -->
<form method="POST" action = "{{route('farmer-store')}}">
  <input type="hidden" name="refnumber" id="refnumber" value="{{ $nextNumber}}">
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

 <div class="card">
  <div class="card-header">         
    <div class="row">
        <div class="col">
          <div class="form-group row">
          <div class="col col-md-auto  mt-1"><label for="phone">Phone<font color="red">*</font>:</label></div>
          <div class="col col-md-6"><input type="text"  class="form-control" name="phone" id="phone" value="{{ $trans->phone ?? $phone }}" required></div>                          
          </div> 
        </div>               
        <div class="col">
          <div class="form-group row">  
            <div class="col col-md-auto"><label for="pickupdate">Pickup:</label></div>
            <div class="col"><input type="date" class="form-control" name="pickupdate" id ="pickupdate" value="{{$trans->pickupdate ?? ''}}"></div>
          </div>
        </div>  
        <div class="col">
          <div class="row">    
            <div class="col col-md-auto mt-1"><label for="expiryday">Expiry Day(s):</label></div>
            <div class="col"><input type="number" class="form-control" name="expiryday" id ="expiryday" value="{{ $days ?? '0' }}"></div>
          </div>
        </div>   
      <!-- break column into new line -->
      <div class="w-100"></div>
        <div class="col">
          <div class="row">  
            <div class="col col-md-auto mt-1"><label for="location">Location:</label></div>
            <div class="col"><input type="text"  class="form-control" name="location" id="location" value="{{$trans->location ?? ''}}"></div>             
          </div>
        </div> 
        <div class="col">
          <div class="row">    
            <div class="col col-md-auto mt-1"><label for="remarks">Remark:</label></div>
            <div class="col"><textarea type="text" class="form-control" name="remark" id ="remark" value="{{$trans->remark ?? ''}}" rows="1"></textarea></div>
          </div>
        </div>                 
      </div>
  </div> <!-- end of card-header -->
  <div class="card-body">  
    <div class="row text-center bg-secondary mb-1" style="font-weight:bold;">
      <div class="col">
        Type
      </div>
      <div class="col">
        Product
      </div>
      <div class="col text-right">
        Harvest Date
      </div>
      <div class="col text-right">
        Quantity/Unit
      </div>      
      <div class="col">
        Unit Price(Nu.)
      </div>     
    </div>
  <!-- end of header columns -->
    <div class="row">
      <div class="col col-md-3">          
          <select class="form-control custom-select" id="producttype" name="producttype[]" required>
            <option value="">Choose...</option>
            @foreach($product_type as $row)
                <option value="{{$row->id}}">{{$row->type}}</option>
            @endforeach
          </select>                          
      </div>
      <div class="col col-md-3">
          <select class="form-control custom-select" id="product" name="product[]">
            <option value="">Choose...</option>
          </select>          
      </div>
      <div class="col col-md-2">
          <input type="date" class="form-control" name="harvestdate[]" id ="harvestdate" value="{{$trans->harvestdate ?? date('Y-m-d') }}" required>              
      </div>   
      <div class="col col-md-2">
        <div class="row">
          <div class="col"><input type="text" class="form-control col" name="quantity[]" id ="quantity" required/></div> 
          <div class="col">
            <select name="unit" id="unit">
            </select>
          </div>      
        </div>          
      </div>         
      <div class="col col-md-2">
        <div class="form-group row">
          <div class="col"><input type="text" class="form-control" name="price[]" id ="price" /></div>       
          
            <div class="col"><button id="addrow" class="btn btn-info" type="button"><i class="fa fa-plus"></i></button></div>        
        
        </div>
      </div>  
    </div>
    <div id="newrows">
    </div>
    
   </div> <!-- end of card-body -->
   <div class="card-footer text-right">
    <input class="btn btn-primary" type="submit" value="Submit">
   </div>
  </div> <!-- end of card-body -->
 </div> <!-- end of card -->  
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript">
          $(window).on('load', function() {
        console.log('All assets are loaded')
    })

//
$(document).ready(function () {

        $("#producttype").on('change',function(e){
            console.log(e);
            var id = e.target.value;
            //alert(id);
            $.get('/json-farmer-products?product_type=' + id, function(data){
                console.log(data);
                $('#product').empty();
                $('#product').append('<option value="">Choose...</option>');
                $.each(data, function(index, ageproductObj){
                    $('#product').append('<option value="'+ ageproductObj.id +'">'+ ageproductObj.product + '</option>');
                })
            });
        });
       
        $("#product").on('change',function(e){
            console.log(e);
            var id = e.target.value;
            //alert(id);
            $.get('/json-farmer-unit_product?product=' + id, function(data){
                console.log(data);
                $('#unit').empty();              
                $.each(data, function(index, ageproductObj){
                    $('#unit').append('<option value="'+ ageproductObj.unit_id +'">'+ ageproductObj.unit + '</option>');
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
    // function myFunction() {
    //   if (confirm('Are you sure you want to your demand list?. Once you submit, you cannot add or delete or update.'))  {
    //     var id = document.getElementById("refnumber").value;
    //     $.get('/json-submit-supply?ref_number=' + id, function(data){
    //       window.location = "/national/";
    //     });
    //   }
      
    // }

    function myFunction() {
      var refNo = document.getElementById("refnumber").value;
      $.get('/json-farmer-product-exist?refNo=' + refNo, function(data){
        if(data == null || data ==''){
            alert('Unsuccessful: To submit details of surplus you need at least one product entered!');
        } else {
            //show some type of message to the user
            if (confirm('Are you sure you want to submit your surplus list?. Once you submitted, you cannot add or delete or update.'))  {
              var id = document.getElementById("refnumber").value;
              $.get('/json-submit-supply?ref_number=' + id, function(data){
                window.location = "/farmer-create/";
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
    //to update status to submitted if the button is clicked.
    function submitFunction()
    {
      document.getElementById('sbutton').value = "Yes";
    }
    
</script>

@endsection

@section('custom_scripts')
  @include('Layouts.dynamicscripts')
@endsection















