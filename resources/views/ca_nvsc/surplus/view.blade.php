@extends('master')

@section('content')
<form method="POST" action = "{{route('supply-store')}}">
  <input type="hidden" name="refnumber" id="refnumber" value="{{ $nextNumber}}">
  @csrf
<div class="container-fluid">
  <div class="row">
      <div class="col-md">
          <div class="card">
            @include('Layouts.message') 
              <div class="card-header"><center><p class="text-muted">{{$msg}}</p></center>
                {{-- <hr/>
              <a class="btn btn-primary" href="{{route('add-permission')}}">Add a new Product</a> --}}
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
                          <th>Action</th>
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
                  <td>
                    

                    <a href="{{route('supply-edit',$row->id)}}">
                    <i class="fa fa-edit" aria-hidden="true"> </i> Edit</a>

                   
                    &nbsp;

                    
                    <a onclick="return confirm('Are you sure want do delete permanently?')" href="/supply-delete/{{$row->id}}" class="text-danger">
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
          $(window).on('load', function() {
        console.log('All assets are loaded')
    })
   
    function myFunction() {
      var refNo = document.getElementById("refnumber").value;
      $.get('/json-ca-product-exist?refNo=' + refNo, function(data){
        if(data == null || data ==''){
            alert('Unsuccessful: To submit the demand you need at least one or more product!');
        } else {
            //show some type of message to the user
            if (confirm('Are you sure you want to submit your Surplus list?'))  {
              var id = document.getElementById("refnumber").value;
              $.get('/json-submit-supply?ref_number=' + id, function(data){
                window.location = "/date/";
              });
            }
        }
      });
      }
   
    </script>

@endsection
