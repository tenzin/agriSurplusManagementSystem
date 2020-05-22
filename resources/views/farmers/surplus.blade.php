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
          <div class="card-title">
            <!--start of row1 title -->
            
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
                  <div class="col"><input type="text" class="form-control" name="remark" id ="remark" value="{{$trans->remark ?? ''}}"></div>
                </div>
              </div>                 

            </div>
               
          </div> <!-- end of card-title -->

        </div> <!-- end of card-header -->
  <div class="card-body">  

    <div class="row">
          
        <div class="col-lg-3 col-md-3">
          <div class="form-group row"> 
            <div class="col-auto"><label for="producttype">Type:<font color="red">*</font></label></div>
            <div class="col">
            <select class="form-control custom-select" id="producttype" name="producttype" required>
              <option value="">Choose...</option>
              @foreach($product_type as $row)
                  <option value="{{$row->id}}">{{$row->type}}</option>
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
              <option value="">Choose...</option>
            </select>          
            </div>
         </div>
        </div>

        <div class="col-lg-3 col-md-3">
         <div class="form-group row"> 
                  <div class="col col-md-auto"><label for="harvestdate">Harvest<font color="red">*</font>:</label></div>
                  <div class="col"><input type="date" class="form-control" name="harvestdate" id ="harvestdate" value="{{$trans->harvestdate ?? date('Y-m-d') }}" required></div>              
          </div>
        </div>   

        <div class="col-lg-3 col-md-3">
          <div class="form-group row">
            <div class="col-auto"><label for="quantity">Qty:<font color="red">*</font></label></div>                   
            <div class="col"><input type="text" class="form-control  text-right" name="quantity" id ="quantity" required/></div> 
            <div class="col">
              <select name="unit" id="unit">
              </select>
            </div>              
          </div>
        </div> 
        
        <div class="col-lg-3 col-md-3">
            <div class="form-group row">      
               <div class="col-auto"><label for="price">Price(Nu.):</label></div>     
               <div class="col"><input type="text" class="form-control" name="price" id ="price" /></div>       
               <div class="col"><button class="btn btn-info" type="submit"><i class="fa fa-plus"></i></button></div>
            </div>
        </div>  
           
    
    </div>    <!-- end for input row1 -->

   </div> <!-- end of card-body -->
   <div class="card-footer"></div>
  </div> <!-- end of card-body -->
 </div> <!-- end of card -->  

  <div class="card"> 
<!-- list of items saved -->
  <div class="card-body"> 
    <div class="row text-center">
          <h6 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Saved List &nbsp;&nbsp;</span>
            @if($supply !== null)
            <span class="badge badge-secondary badge-pill text-warning">&nbsp;{{$supply->count()}}</span>
            @endif             
          </h6>
    </div>
    <div class="row">
        <div class="col col-md-8">
        <!-- <div class="col-md-4 order-md-2 mb-4"> -->
          <ul class="list-group mb-0">
                <li class="list-group-item d-flex justify-content-between lh-condensed bg-success">
                  <div class="col"><strong>Product</strong></div>
                  <div class="col"><strong>Quantity/Unit Price</strong></div>
                  <div class="col text-right"><strong>Harvest Date</strong></div>
                  <div class="col text-right"><strong>Action</strong></div>
                </li>
            @if($supply !== null)
              @foreach($supply as $supplys)
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                  <div class="col">{{$supplys->product}}</div>
                  <div class="col">{{$supplys->quantity}}&nbsp;{{$supplys->unit}} 
                   @if($supplys->price > 0)  
                    @ Nu. {{$supplys->price}} 
                   @endif 
                  </div>
                  <div class="col text-right">{{date('d/m/Y',strtotime($supplys->harvestDate))}}</div>
                  <div class="col text-right">
                  <a href="{{route('farmer-edit',$supplys->id)}}"><i class="fa fa-edit" aria-hidden="true"></i></a>                   
                  &nbsp; &nbsp;&nbsp;
                  <a onclick="return confirm('Are you sure want do delete permanently?')" href="/farmer-remove/{{$supplys->id}}" class="text-danger">
                      <i class="fa fa-trash" aria-hidden="true"></i></a>
                  </div> 
                </li>
              @endforeach
            @endif
          </ul>
        </div> <!-- end of col-md-4 for the list item -->
        <div class="col">
          <div class="jumbotron py-3" style="background-color: orange">
              <h5><strong>Note</strong></h5>
                  <i>Your surplus items are saved temporarily. Unless it is submitted, other 
                    potential suppliers can not view it. 
                    You must <b>SUBMIT</b> your surplus list to make it viewable by others.</i>
                    <p><button class="btn btn-success btn-lg text-white py-1" id="sbutton" type="button" name="subutton" value="" onclick="myFunction()">Submit</button></p>
          </div>
        </div>
    </div>  <!-- item list row ends -->
  </div> <!-- end of card-body -->  
  </div> <!-- card for list ends -->  
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
              $.get('/farmer-submit?refNumber=' + id, function(data){
                window.location = "/farmer-create";
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















