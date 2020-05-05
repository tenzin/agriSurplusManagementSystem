@extends('master')

@section('content')

<div class="container-fluid"> 
<div class="card card-info">
<div class="card-header">
<h3 class="card-title">Add New User Form</h3>
</div>
<form role="form" method="POST" action="{{route('new-user')}}">
@csrf
<div class="card-body">
  <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <label>ID Card:<font color="red">*</font></label>
            <input  name="cid" id="cid" class="form-control" placeholder="Enter the CID">
          </div> 
          <div class="form-group">
            <label>Name:<small></small>&nbsp;<font color="red">*</font></label>
            <input id="name" type="text" class="form-control" name="name" placeholder="Enter the Name"/>
          </div>
          <div class="form-group">
            <label>Address:<small></small>&nbsp;<font color="red">*</font></label>
            <input id="address" type="text" class="form-control" name="address" maxlength="5" placeholder="Enter the address"/>
          </div>
        </div>
          <div class="col-md-4">
          <div class="form-group">
            <label>Dzongkhag:<font color="red">*</font></label>
              <select  name="dzongkhag" id="dzongkhag" class="form-control">
                <option disabled selected value="">Select Dzongkhag</option>
                @foreach($dzongkhags as $dzongkhag)
                    <option value="{{$dzongkhag->id}}">{{$dzongkhag->dzongkhag}}</option>
                @endforeach
              </select>
          </div> 
          <div class="form-group">
            <label>Gewog:<font color="red">*</font></label>
              <select  name="gewog" id="gewog" class="form-control">
                <option disabled selected value="">Select Gewog</option>
                @foreach($gewogs as $gewog)
                    <option value="{{$gewog->id}}">{{$gewog->gewog}}</option>
                @endforeach
              </select>
          </div> 
          <div class="form-group">
            <label>Role:<font color="red">*</font></label>
              <select  name="role" id="role" class="form-control">
                <option disabled selected value="">Select Role</option>
                @foreach($roles as $role)
                    <option value="{{$role->id}}">{{$role->role}}</option>
                @endforeach
              </select>
          </div> 
      </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Email:<small></small>&nbsp;<font color="red">*</font></label>
              <input id="email" type="text" class="form-control" name="email"  placeholder="Enter the Email"/>
            </div>

            <div class="form-group">
              <label>Password:<small></small>&nbsp;<font color="red">*</font></label>
              <input id="password" type="password" class="form-control" name="password" placeholder="Enter the Password"/>
            </div>
          <div class="form-group">
            <label>Contact Number:<small></small>&nbsp;<font color="red">*</font></label>
            <input id="number" type="text" class="form-control" name="number"  placeholder="Enter the contact Number"/>
          </div>
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
   
     












