@extends('master')
@section('content')
<section class="content">
   <div class="card card">
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
            <tbody>
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
            </tbody>
         </table>
      </div>
      <div class="form-group row mb-0">
         <div class="col-md-6 offset-md-5">
            <a class="btn btn-primary btn-sm" href="{{ route('system-user')}}">Go back</a>
         </div><hr>
      </div>
   </div>
</section>
@endsection