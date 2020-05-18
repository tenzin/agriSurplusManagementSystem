@extends('master')

@section('content')
<div class="container">
<div>Details of each submission. &nbsp;&nbsp;&nbsp;</div>
      <!-- parent field -->

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
                <div class="col col-md-auto  mt-1"><label for="phone">Phone:</label></div>
                <div class="col col-md-6"><input type="text"  class="form-control" name="phone" id="phone" value="{{ $trans->phone ?? '' }}" readonly></div>                          
               </div> 
              </div> 

              <div class="col">
                <div class="form-group row">  
                  <div class="col col-md-auto"><label for="pickupdate">Pickup:</label></div>
                  <div class="col col-md-5"><input type="text" class="form-control" name="pickupdate" id ="pickupdate" value="{{date('d/m/Y',strtotime($trans->pickupdate)) }}" readonly></div>
                </div>
              </div>  

              <div class="col">
                <div class="row">    
                  <div class="col col-md-auto mt-1"><label for="expiryday">Expiry Date:</label></div>
                  <div class="col col-md-5"><input type="text" class="form-control" name="expiryday" id ="expiryday" value="{{ date('d/m/Y',strtotime($trans->expiryDate)) }}" readonly></div>
                </div>
              </div>   
            <!-- break column into new line -->
            <div class="w-100"></div>
              <div class="col">
                <div class="row">  
                  <div class="col col-md-auto mt-1"><label for="location">Location:</label></div>
                  <div class="col"><input type="text"  class="form-control" name="location" id="location" value="{{$trans->location ?? ''}}" readonly></div>             
                </div>
              </div> 

              <div class="col">
                <div class="row">    
                  <div class="col col-md-auto mt-1"><label for="remarks">Remark:</label></div>
                  <div class="col"><input type="text" class="form-control" name="remark" id ="remark" value="{{$trans->remark ?? ''}}" readonly></div>
                </div>
              </div> 

            </div>               
          </div> <!-- end of card-title -->
 </div> <!-- end of card-header -->
</div>
<div class="card">
  <div class="card-header bg-secondary">
      <div class="row" style="font-weight:bold;">
          <div class="col">
              <span>Type</span>
          </div>
          <div class="col">
              <span>Product</span>
          </div>
          <div class="col text-right">
              <span>Quantity</span>
          </div>
          <div class="col text-right">
              <span>Unit Price(Nu.)</span>
          </div>
          <div class="col text-right">
              <span>Harvest Date</span>
          </div>
      </div>
  </div>
  <div class="card-body">
            @if($surplus !== null)
              @foreach($surplus as $row)
              <div class="row">
                  <div class="col"><span>  {{$row->type}}</span></div>   
                  <div class="col"><span>  {{$row->product}}</span></div>                    
                  <div class="col text-right"><span> {{$row->quantity}} {{$row->unit}}</span></div>
                  <div class="col text-right"><span> {{$row->price}}</span></div>
                  @if($row->harvestDate !== null)
                  <div class="col text-right ml-2"><span>{{date('d/m/Y',strtotime($row->harvestDate))}}</span></div>  
                  @else
                   <div class="col text-right ml-2">&nbsp;</div>
                  @endif  
              </div>
              @endforeach
            @endif
    </div> <!-- end of card-body -->  
</div> <!-- card for list ends -->  
@endsection















