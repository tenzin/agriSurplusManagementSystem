@extends('master')

@section('content')
<div class="container">
<div>Edit Surplus. &nbsp;&nbsp;&nbsp;Ref. No: &nbsp;</div>
      <!-- parent field -->
<form method="POST" action = "{{route('farmer-update')}}">
<input type="hidden" name="id" id="id" value="{{$product->id}}">
  @csrf
 <div class="card">
        <div class="card-header">         
          <div class="card-title">

        </div> <!-- end of card-header -->
  <div class="card-body">  
    <div class="row">          
        <div class="col-lg-3 col-md-3">
          <div class="form-group row"> 
            <div class="col-auto"><label for="producttype">Type:<font color="red">*</font></label></div>
            <div class="col">
            <select class="form-control custom-select" id="producttype" name="producttype" required>
              @foreach($product_type as $row)
                @if($row->id == $product->productType_id)
                <option value="{{$row->id}}" selected>{{$row->type}}</option>
                @else
                <option value="{{$row->id}}">{{$row->type}}</option>
                @endif  
              @endforeach
            </select>              
            </div>
         </div>
        </div>

        <div class="col-lg-3 col-md-3">
         <div class="form-group row"> 
          <div class="col-auto"><label for="product">Product:<font color="red">*</font></label></div>
            <div class="col">
            <select class="form-control custom-select" id="product" name="product" required>
              <option value="{{$product->product_id}}" selected>{{$product->product->product}}</option>
            </select>          
            </div>
         </div>
        </div>
          
        <div class="col-lg-3 col-md-3">
          <div class="form-group row">
            <div class="col-auto"><label for="quantity">Qty:<font color="red">*</font></label></div>                   
            <div class="col"><input type="text" class="form-control  text-right" name="quantity" id ="quantity" value="{{$product->quantity}}" required/></div> 
            <div class="col">
              <select name="unit" id="unit">
                <option value="{{$product->unit_id}}" selected>{{$product->unit->unit}}</option>
              </select>
            </div>              
          </div>
        </div> 
        
        <div class="col-lg-3 col-md-3">
            <div class="form-group row">      
               <div class="col-auto"><label for="price">Price(Nu.):</label></div>     
               <div class="col"><input type="text" class="form-control" name="price" id ="price" value="{{$product->price}}"></div>                      
            </div>
        </div>  

        <div class="form-group row"> 
                  <div class="col col-md-auto"><label for="harvestdate">Harvest<font color="red">*</font>:</label></div>
                  <div class="col"><input type="date" class="form-control" name="harvestdate" id ="harvestdate" value="{{$product->harvestDate}}" required></div>              
        </div>
           
    
    </div>    <!-- end for input row1 -->

   </div> <!-- end of card-body -->
   <div class="card-footer">
   <a href="{{ url()->previous() }}" class="btn btn-warning"><i class="fa fa-undo"></i></a>
   <button class="btn btn-success" type="submit"><i class="fa fa-check"></i></button>
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
                window.location = "/national";
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

@endsection















