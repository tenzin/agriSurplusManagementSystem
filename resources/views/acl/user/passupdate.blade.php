@extends('master')
@section('content')
<div class="container-fluid">
<div class="card card-info">
   <div class="card-header">
      <h3 class="card-title">Update User Password</h3>
   </div>
   <form role="form" method="POST" action="{{route('user-passupdate')}}">
      @csrf
      <div class="card-body">
         <div class="row">
            <div class="col-md-4">
               <div class="form-group">
                  <label>Sl.No:<small></small>&nbsp;</label>
                  <input id="id" type="text" class="form-control" readonly value="{{$users->id}}" name="id"/>
               </div>
               <div class="form-group"> 
                  <label>CID No:</label>
                  <input  name="cid" id="cid" class="form-control" readonly value="{{$users->cid}}"/>
               </div>
               <div class="form-group">
                  <label>Name:<small></small>&nbsp;</label>
                  <input id="name" type="text" class="form-control" name="name" readonly value="{{$users->name}}"/>
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label>Dzongkhag:<small></small>&nbsp;</label>
                  <select id="dzongkhag" type="text" class="form-control" name="dzongkhag" readonly>
                     <option readonly selected>{{$users->dzongkhag->dzongkhag}}</option>
                  </select>
               </div>
               <div class="form-group">
                  <label>Gewog:<small></small>&nbsp;</label>
                  <select id="gewog" type="text" class="form-control" name="gewog" readonly>
                     <option readonly selected>{{$users->gewog->gewog}}</option>
                  </select>
               </div>
               <div class="form-group">
                  <label>Address:<small></small>&nbsp;</label>
                  <input id="address" type="text" class="form-control" name="address" readonly value="{{$users->address}}"/>
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group"> 
                  <label>Email:</label>
                  <input  name="email" id="email" class="form-control" readonly value="{{$users->email}}"/>
               </div>
               <div class="form-group">
                  <label>Password:</label>
                  <input id="password" type="password" class="form-control" name="password" required/> 
               </div>
               <div class="form-group">
                  <label for="password-confirm">Confirm Password</label>
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
               </div>
            </div>
         </div>
         <div class="card-footer">
            <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
              <button type="submit"class="btn btn-success btn-sm">Reset</button>
                <a class="btn btn-primary btn-sm" href="{{ route('user-reset')}}">Go back</a>
               </div>
            </div>
         </div>
   </form>
   </div>
</div>
@endsection