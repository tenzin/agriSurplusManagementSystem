@extends('master')
@section('content')
<div class="container normal-page">
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card card-info">
            <div class="card-header">Password Reset List
            </div>
            <!--card header-->
            <div class="card-body">
               <table id="example1" class="table table-bordered table-striped">
                  <thead>
                     <tr>
                        <th>Sl.No</th>
                        <th>Name</th>
                        <th>Dzongkhag</th>
                        <th>Gewog</th>
                        <th>Email ID</th>
                        <th>Role</th>
                        <th>Actions</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($users as $user)
                     <tr>
                        <td class="text-center">{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->Dzongkhag['dzongkhag']}}</td>
                        <td>{{$user->Gewog['gewog']}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->Role['role']}}</td>
                        <td>
                           <a href="{{route('user-resetpassword', $user['id'])}}" class="btn btn-success btn-xs"></span>Reset</a>
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