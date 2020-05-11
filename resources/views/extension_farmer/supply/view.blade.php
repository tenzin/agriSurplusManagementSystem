@extends('master')

@section('content')
<form method="POST" action = "{{route('ex-supply-store')}}">
  <input type="hidden" name="refnumber" id="refnumber" value="{{ $refno2}}">
  @csrf
<div class="container-fluid">
  <div class="row">
      <div class="col-md">
          <div class="card">
              <div class="card-header"><center><p class="text-muted">{{$msg}}</p></center>
                <hr/>
              <a class="btn btn-primary" href="{{route('add-permission')}}">Add a new Product</a>
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
                  <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Product Type</th>
                          <th scope="col">Product</th>
                          <th scope="col">Quantity</th>
                          <th scope="col">Price</th>
                          <th scope="col">Required Date</th>
                          <th scope="col">Harvest Date</th>
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
                <td>{{$row->tentativePickupDate}}</td>
                <td>{{$row->harvestDate}}</td>
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
      if (confirm('Are you sure you want to your demand list?. Once you submit, you cannot add or delete or update.'))  {
        var id = document.getElementById("refnumber").value;
        $.get('/json-submit-ex-supply?ref_number=' + id, function(data){
          window.location = "/national/";
        });
      }
      else {
          
      }
    }
    
</script>
@endsection
