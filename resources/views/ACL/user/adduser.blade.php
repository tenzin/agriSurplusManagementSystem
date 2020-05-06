@extends('master')
@section('content')
<div class="container-fluid">
<div class="card card-info">
   <div class="card-header">
      <h3 class="card-title">Add New User</h3>
   </div>
   <form role="form" method="POST" action="{{route('new-user')}}">
      @csrf
      <div class="card-body">
         <div class="row">
            <div class="col-md-3">
               <div class="form-group">
                  <label>CID No:<font color="red">*</font></label>
                  <input  name="cid" id="cid" class="form-control" placeholder="Enter the CID" required>
               </div>
               <div class="form-group">
                  <label>Name:<small></small>&nbsp;<font color="red">*</font></label>
                  <input id="name" type="text" class="form-control" name="name" placeholder="Enter the Name" required/>
               </div>
               <div class="form-group">
                  <label>Address:<small></small>&nbsp;<font color="red">*</font></label>
                  <input id="address" type="text" class="form-control" name="address" placeholder="Enter the address" required/>
               </div>
               <div class="form-group">
                  <label>Is_Amdin:<small></small>&nbsp;</label>
                  <input type="radio" name="admin" id="admin" value="1"> : TRUE</input>
                  <input type="radio" name="admin" id="admin1" value="0"> : FALSE</input>
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label>Dzongkhag:<font color="red">*</font></label>
                  <select  name="dzongkhag" id="dzongkhag" class="form-control" required>
                     <option disabled selected value="">Select Dzongkhag</option>
                     @foreach($dzongkhags as $dzongkhag)
                     <option value="{{$dzongkhag->id}}">{{$dzongkhag->dzongkhag}}</option>
                     @endforeach
                  </select>
               </div>
               <div class="form-group">
                  <label>Gewog:<font color="red">*</font></label>
                  <select  name="gewog" id="gewog" class="form-control" required>
                     <option disabled selected value="">Select Gewog</option>
                     @foreach($gewogs as $gewog)
                     <option value="{{$gewog->id}}">{{$gewog->gewog}}</option>
                     @endforeach
                  </select>
               </div>
               <div class="form-group">
                  <label>Role:<font color="red">*</font></label>
                  <select  name="role" id="role" class="form-control" required>
                     <option disabled selected value="">Select Role</option>
                     @foreach($roles as $role)
                     <option value="{{$role->id}}">{{$role->role}}</option>
                     @endforeach
                  </select>
               </div>
               <div class="form-group">
                  <label>Is_Active:<small></small>&nbsp;</label>
                  <input type="radio" name="active" id="active" value="1"> : TRUE</input>
                  <input type="radio" name="active" id="active1" value="0"> : FALSE</input>
               </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label>Email:<small></small>&nbsp;<font color="red">*</font></label>
                  <input id="email" type="text" class="form-control" name="email"  placeholder="Enter the Email" required/>
               </div>
               <div class="form-group">
                  <label>Password:<small></small>&nbsp;<font color="red">*</font></label>
                  <input id="password" type="password" class="form-control" name="password" placeholder="Enter the Password" required/>
               </div>
               <div class="form-group">
                  <label>Contact Number:<small></small>&nbsp;<font color="red">*</font></label>
                  <input id="number" type="text" class="form-control" name="number"  placeholder="Enter the contact Number" required/>
               </div>
               <div class="form-group">
                  <label>Is_Staff:<small></small>&nbsp;</label>
                  <input type="radio" name="staff" id="staff" value="1"> : TRUE</input>
                  <input type="radio" name="staff" id="staff1" value="0"> : FALSE</input>
               </div>
            </div>
         </div>
         <div class="card-footer">
            <button type="submit" class="btn btn-info float-right">Submit</button>
         </div>
   </form>
   </div>
</div>
@endsection