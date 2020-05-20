@extends('master')

@section('content')
<div class="container">
<div>Submitted surplus reference list</div>
      <!-- parent field -->
<div class="card"> 
<!-- list of transactions submitted -->
  <div class="card-header bg-secondary">
    <div class="row" style="font-weight:bold;">
        <div class="col">
            <span>Reference</span>
        </div>
        <div class="col">
            <span>Phone</span>
        </div>
        <div class="col">
            <span>Location</span>
        </div>
        <div class="col">
            <span>Remark</span>
        </div>
        <div class="col">
            <span>Pickup</span>
        </div>
        <div class="col">
            <span>Expiry</span>
        </div>      
    </div>
   </div> 
   <div class="card-body"> 
            @if($trans !== null)
              @foreach($trans as $row)
              <div class="row mb-1">
                  <div class="col">
                    <a href="{{route('farmer-batch',$row->refNumber)}}">{{$row->refNumber}}&nbsp;<i class="fa fa-external-link-alt"></i></a>     
                  </div>
                  <div class="col">
                    <span>{{$row->phone}}</span>
                  </div>
                  <div class="col">
                    <span>{{$row->location}}</span>
                  </div>
                  <div class="col">
                    <span>{{$row->remark}}</span>
                  </div>        
                  <div class="col">
                    <span>{{date('d/m/Y',strtotime($row->pickupdate))}}</span>
                  </div>
                  <div class="col">
                    <span>{{date('d/m/Y',strtotime($row->expirydate))}}</span>
                  </div>
                </div>
              @endforeach
              {{ $trans->links() }}
            @endif
  </div> <!-- end of card-body -->  
</div> <!-- card for list ends -->  
@endsection















