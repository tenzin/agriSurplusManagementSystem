@extends('master')

@section('content')
<div class="container">
        <div class="py-2 text-center">
              <h1>Surplus View Details </h1>
              <hr>
              <div class="row">
              <div class="col-md-4 mb-3">
                <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text">Ref.Number</span>
                  </div>
                  <input type="text" class="form-control" name="price" id ="price" readonly value={{$row->refNumber}}>
                </div>
            </div>

                <div class="col-md-4 mb-3">
                <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text">Dzongkhag</span>
                  </div>
                  <input type="text" class="form-control" name="dzo" id ="dzo" readonly value={{$row->dzongkhag->dzongkhag}}>
                </div>
            </div>
                <div class="col-md-4 mb-3">
                <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text">Contact No</span>
                  </div>
                  @foreach($table as $data)
                    <?php 
                    $phone = $data->contact_number;
                    ?>
                  @endforeach
                  <input type="text" class="form-control" name="phone" id ="phone" readonly value={{$phone}}>
                </div>
            </div>
         </div>
              <hr>
           </div>
    <form>
      <div class="row">
        <div class="col-md-4 mb-3">
          <label >Product Type</label>
          <input type="text" class="form-control" name="" iproductd ="product" readonly value={{$row->product->product}}>
        </div>
        <div class="col-md-4 mb-3">
          <label >Product</label>
          <input type="text" class="form-control" name="producttype" id ="producttype" readonly value={{$row->product->productType->type}}>
        </div>
         <div class="col-md-4 mb-3">
            <label>Price(tentative)</label>
            <div class="input-group">
                <div class="input-group-prepend">
                     <span class="input-group-text">Nu.</span>
                </div>
                <input type="text" class="form-control" name="price" id ="price" readonly value={{$row->price}}>
            </div>
        </div> 
       </div>
      <div class="row">
          <div class="col-md-4 mb-3">
              <label for="qty">Quantity</label>
              <input type="text" class="form-control" name="quantity" id ="quantity" readonly value={{$row->quantity.' '.$row->unit->unit}}>
          </div>    
          <div class="col-md-4 mb-3">
              <label for="unit">HarvestDate</label>
                <input type="date" class="form-control" name="harvestdate" id ="harvestdate" readonly value={{$row->harvestDate}}>     
          </div>
          <div class="col-md-4 mb-3">
              <label for="unit">PickupDate(Tentative)</label>
               <input type="date" class="form-control" name="pickupdate" id ="pickupdate" readonly value={{$row->tentativePickupDate}}>
                 
             </div>
             <div class="col-md-4 mb-3">
                <label>Remarks</label>
                <textarea class="form-control" id="remarks" name="remarks" cols="50" rows="2" id="remarks" readonly value={{$row->remarks}}></textarea>
                    <div class="invalid-feedback" style="width: 100%;">
                       Remark is required.
                    </div>
            </div>
          </div>
      </div>
        
      <hr class="mb-4">
     <center> <a class="btn btn-primary btn-xx" href="{{route('view_surplus_details')}}">Back</a></center>
      
    </form>
  </div>
</div>

@endsection