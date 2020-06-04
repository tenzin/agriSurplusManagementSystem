@extends('master')
@section('content')
<div class="container normal-page">
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card card">
            <div class="card-header">Password Reset List
            </div>
            <!--card header-->
            <div class="card-body">
               @include('Layouts.message') 
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
                           <a href="{{route('user-resetpassword', $user['id'])}}" class="btn btn-success btn-sm"></span>Reset</a>
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            <div class="form-group row mb-0">
               <div class="col-md-6 offset-md-4">
                <a class="btn btn-primary btn-sm" href="{{ route('system-user')}}">Go back</a>
               </div>
            </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection