@extends('master')
@section('content')
<div class="container normal-page">
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               Users List
               <hr/>
               <a class="btn btn-primary btn-sm" href="{{route('add-user')}}">Add New User</a>
               <a class="btn btn-primary btn-sm" href="{{route('user-reset')}}">User Reset Password</a>
            </div>
            <!--card header-->
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
                        <th>Sl.No</th>
                        <th>Name</th>
                        <th>Email ID</th>
                        <th>Role</th>
                        <th>Actions</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($users as $user)
                     <tr>
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->Role['role']}}</td>
                        <td>
                           <a href="{{route('user-view',$user['id'])}}" class="btn btn-primary btn-xs"></span>View</a>
                           <a href="{{route('edit-user',$user['id'])}}" class="btn btn-warning btn-xs"></span>Edit</a>
                           <a href="{{route('delete-user',$user['id'])}}" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to delete this data??');"></span>Delete</a>
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection