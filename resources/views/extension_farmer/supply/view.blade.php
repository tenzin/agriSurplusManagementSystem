
@extends('master')
@section('content')
<form method="POST" action = "{{route('ex-supply-store')}}">
  <input type="hidden" name="refnumber" id="refnumber" value="{{ $nextNumber}}">
  @csrf
<div class="container-fluid">
  <div class="row">
      <div class="col-md">
          <div class="card">
              <div class="card-header"><center><p class="text-muted">{{$msg}}</p></center>
              </div>
              <div class="card-body">
                <div class="card-body">
                  @if (session('success'))
                  <div class="alert alert-success" id="session_message">
                      {{ session('success') }}
                  </div>
                  @endif
                  @if (session('error'))
                  <div class="alert alert-warning" id="session_message">
                      {{ session('error') }}
                  </div>
                  @endif
                  <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th scope="col">Sl.No</th>
                          <th scope="col">Product Type</th>
                          <th scope="col">Product</th>
                          <th scope="col">Quantity</th>
                          <th scope="col">Price</th>
                          <th scope="col">Harvest Date</th>
                          
                          <th scope="col">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                          
                @foreach($supply as $row)
                <tr>
                <th scope="row">{{$loop->index+1}}</th>
                <td>{{$row->type}}</td>
                <td>{{$row->product}}</td>
                <td>{{$row->quantity.' '.$row->unit}}</td>
                <td>Nu. {{$row->price}}</td>
                <td>{{$row->harvestDate}}</td>
                {{-- <td>{{$row->tentativePickupDate}}</td> --}}
                <td><a href="/ex-supply-edit/{{$row->id}}">
                  <i class="fa fa-edit" aria-hidden="true"> </i> Edit</a>
                 &nbsp;
                 <a onclick="return confirm('Are you sure want do Delete Permanently?')" href="/surplus-delete/{{$row->id}}" class="text-danger">
                   <i class="fa fa-trash" aria-hidden="true"> </i> Remove</a>
                  </td>
                </tr>
                   @endforeach
                  </tbody>           
                        
                    </table>
                    <div>
                      <a class="btn btn-success btn-lg btn-block text-white" onclick="myFunction()">Submit</a>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
        
    function myFunction() {
      if (confirm('Are you sure you want to submit your Surplus list?.'))  {
        var id = document.getElementById("refnumber").value;
        $.get('/json-submit-surplus?ref_number=' + id, function(data){
          window.location = "/ex-day/";
        });
      }
      else {
          
      }
    }
    
</script>
@endsection
