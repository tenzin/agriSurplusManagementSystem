@extends('master')

@section('content')
    <div class="container">
       <div class="py-2 text-center">
              <h2>Surplus View Details</h2>
                  <h5>Ref. No:&nbsp;<b>{{$row->refNumber}}</b></h5>
              <hr>
        </div>
      <div class="row justify-content-center">
      <form>
        <div class="col-md-12 order-md-1">
         <h4 class="mb-3">Address:</h4>
           <div class="form-group row">
              <div class="col-md-6 mb-3">
                <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text">Dzongkhag</span>
                  </div>
                    <input type="text" class="form-control" name="price" id ="price" readonly value={{$row->gewog->dzongkhag->dzongkhag}}>
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text">Gewog</span>
                  </div>
                   <input type="text" class="form-control" name="dzo" id ="dzo" readonly value={{$row->gewog->gewog}}>
                </div>
              </div>
            </div>
              <div class="from-group row">
               <div class="col-md-6 mb-3">
                 <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text">Pickup Point</span>
                  </div>
                  <input type="text" class="form-control" name="phone" id ="phone" readonly value=>
                </div>    
              </div>
              <div class="col-md-6 mb-3">
                <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text">Phone</span>
                  </div>
                  <input type="text" class="form-control" name="phone" id ="phone" readonly value=>
                </div>    
              </div>
          </div>
         <hr>
      <div class="form-group row">
        <div class="col-md-6 mb-3">
          <label >Product Type</label>
          <input type="text" class="form-control" name="" iproductd ="product" readonly value={{$row->product->product}}>
        </div>
        <div class="col-md-6 mb-3">
          <label >Product</label>
          <input type="text" class="form-control" name="producttype" id ="producttype" readonly value={{$row->product->productType->type}}>
        </div>
      </div>

        <div class="form-group row">
          <div class="col-md-6 mb-3">
            <label>Price(tentative)</label>
              <div class="input-group">
                <div class="input-group-prepend">
                     <span class="input-group-text">Nu.</span>
                </div>
                <input type="text" class="form-control" name="price" id ="price" readonly value={{$row->price}}>
              </div>
            </div> 
          <div class="col-md-6 mb-3">
              <label for="qty">Quantity</label>
              <input type="text" class="form-control" name="quantity" id ="quantity" readonly value={{$row->quantity.' '.$row->unit->unit}}>
          </div> 
       </div>

      <div class="form-group row">  
          <div class="col-md-6 mb-3">
              <label for="unit">HarvestDate</label>
                <input type="date" class="form-control" name="harvestdate" id ="harvestdate" readonly value={{$row->harvestDate}}>     
          </div>
          <div class="col-md-6 mb-3">
              <label for="unit">PickupDate(Tentative)</label>
               <input type="date" class="form-control" name="pickupdate" id ="pickupdate" readonly value={{$row->tentativePickupDate}}>    
          </div>
        </div>

        <div class="form-group row">
          <div class="col-md-12 mb-3">
            <label>Remarks</label>
            <textarea class="form-control" id="remarks" name="remarks" cols="50" rows="2" id="remarks" readonly>{{$row->remarks}}></textarea>
          </div>
        </div>
      
       {{-- <!-- <div class="row">
           <div class="col-md-4 mb-3">
              <label>Contact Number</label>
               @foreach($table as $data)
               <?php
                $phone=$data->contact_number;
                ?>
               @endforeach
              <input type="text" class="form-control" name="contact" id ="contact" readonly value={{$phone}}> 
            </div>-->--}}
         <div class="form-group row mb-0">
           <div class="col-md-6 offset-md-6">
              <a class="btn btn-primary btn-sm" href="{{ route('view_supply_details')}}">Go back</a>
            </div>
            <hr> 
        </div>
    </form>
  </div>
  </div>
</div>
</div>
</div>

@endsection








