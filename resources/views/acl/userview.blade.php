@extends('master')
@section('content')

<section class="content">
        <div class="card card-info">
            <div class="card-header">
               <h3 class="card-title"> View User List</h3>
            </div>  
            <div class="card-body"> 
            <table class="table table-bordered table-striped">
               <thead>
                  <tr>
                     <th>Sl.No</th>
                     <th>CID</th>
                     <th>Name</th>
                     <th>Email ID</th>
                     <th>Dzongkhag</th>
                     <th>Gewog</th>
                     <th>Address</th>
                     <th>Contact</th>
                     <th>Role</th>
                    </tr>
                </thead>
               <tbody id="myTable">
                    @foreach($users as $user)
                        <tr>
                            <td class="text-center">{{$user->id}}</td>
                            <td>{{$user->cid}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->Dzongkhag['dzongkhag']}}</td>
                            <td>{{$user->Gewog['gewog']}}</td>
                            <td>{{$user->address}}</td>
                            <td>{{$user->contact_number}}</td>
                            <td>{{$user->Role['role']}}</td>            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      
           <div class="form-group row mb-4">
                 <div class="col-md-8 offset-md-6">
                     <a class="btn btn-primary" href="#"> Back</a>
                </div>
            </div>
          </div>           
        </div>
   </section>

   <!-- <script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
}); -->
@endsection

