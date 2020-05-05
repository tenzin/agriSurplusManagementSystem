@extends('master')
@section('content')

<section class="content">
      <div class="card card-info">
         <div class="card-header">
            <h3 class="card-title">Users List</h3>
         </div>
         <div class="card-body"> 
           <div class="card-header">
             <a class="btn btn-primary" href="{{route('adduser')}}">Add New User</a>
             <a class="btn btn-primary" href="#">User Reset Password</a>
         </div>  
            <table class="table table-bordered table-striped">
               <thead>
                  <tr>
                     <th>Sl.No</th>
                     <th>Name</th>
                     <th>Email ID</th>
                     <th>Role</th>
                     <th>Actions</th>
                  </tr>
               </thead>
               <input type="text" id="myInput" placeholder="Search..." class="form-control" />
            <br/>
               <tbody id="myTable">
                            @foreach($users as $user)
                            <tr>
                                <td class="text-center">{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->Role['role']}}</td>

                                <td class="td-actions">
                                    <button type="button" class="btn btn-info btn-sm">
                                    <a class="actions" href="{{route('userview')}}" >View</a>
                                    </button>
                                    <button type="button"class="btn btn-success btn-sm">
                                       <a class="actions" href="#">Edit</a>
                                    </button>
                                    <button type="button"class="btn btn-danger btn-sm">
                                       <a class="actions" href="#">Delete</a>
                                    </button>
                                </td>
                               </tr>
                          @endforeach
                        </tbody>
            </table>
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

