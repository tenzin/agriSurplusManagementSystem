
@extends('master')

@section('content')
<form method="POST" action = "{{route('demand-store')}}">
  @csrf
<div class="container-fluid">
  <div class="row">
      <div class="col-md">
          <div class="card">
          <h3 class="text-primary text-center">Demand List</h3>
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
                          <th scope="col">Referance Number</th>
                          <th scope="col">Submitted Date</th>
                          <th scope="col">Expired Date</th>
                          </tr>
                      </thead>
                      <tbody>
                          
                        @foreach($demands as $row)
                        <tr>
                        <th scope="row">{{$loop->index+1}}</th>
                        <td><a href="{{route('show',$row->refNumber)}}">
                        <i class="fas fa-eye"></i>
                          {{$row->refNumber}}
                        </td>
                        <td>{{$row->submittedDate}}</td>
                        <td>{{$row->expiryDate}}</td>

                        </tr>
                        @endforeach
                       </tbody>           
                        
                    </table>
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
      $.get('/json-transaction-exist', function(data){
        if(data == null || data ==''){

              $.get('/json-submit-demand?ref_number=' + id, function(data){
                window.location = "/national/";
              });
        } else {
            //show some type of message to the user
            alert('You cannot import! You have pending product which needs to be submitted.');
            window.location = "/demand-history/";
        }
      });
      }
   
    
</script>
@endsection


