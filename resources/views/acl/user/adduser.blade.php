@extends('master')
@section('content')
<div class="content-header">
   <form class="form-horizontal" method="POST" action = "{{route('new-user')}}">
     @csrf
   <div class="card card">
           <div class="card-header">
             <h3 class="card-title">Add New User</h3>
             
           </div>
           <!-- /.card-header --->
           <div class="card-body">
            @include('Layouts.message') 
         <div class="row">
            <div class="col-md-3">
               <div class="form-group">
                  <label>CID No:<font color="red">*</font></label>
                  <input name="cid" id="cid" class="form-control" placeholder="Enter the CID" maxlength="13" required>
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
               <div class="form-group">
                  <label>longitude:<small></small>&nbsp;<font color="red">*</font></label>
                 <input id="longitude" type="text" class="form-control" name="longitude"  placeholder="Enter the longitude"/>
              </div>
            </div>
            <div class="col-md-4">
               <div class="form-group">
                  <label>Dzongkhag:<font color="red">*</font></label>
                  <select class="custom-select d-block w-100" id="dzongkhag" name="dzongkhag">
                     <option value="">Choose...</option>
                     @foreach($dzongkhags as $row)
                         <option value="{{$row->id}}">{{$row->dzongkhag}}</option>
                     @endforeach
                   </select>
               </div>
               <div class="form-group">
                  <label>Gewog:<font color="red">*</font></label>
                  <select class="custom-select d-block w-100" id="gewog" name="gewog">
                     <option value="">Choose...</option>
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

               <div class="form-group">
                  <label>latitude:<small></small>&nbsp;<font color="red">*</font></label>
                  <input id="latitude" type="text" class="form-control" name="latitude" placeholder="Enter the latitude"/>
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
                  <input id="number" type="text" class="form-control" name="number"  placeholder="Enter the contact Number" maxlength="8" required/>
               </div>
               <div class="form-group">
                  <label>Is_Staff:<small></small>&nbsp;</label>
                  <input type="radio" name="staff" id="staff" value="1"> : TRUE</input>
                  <input type="radio" name="staff" id="staff1" value="0"> : FALSE</input>
               </div>
            </div>
               
         
         </div>
      </div>
           <!-- /.card-body -->
           @csrf
           <div class="card-footer">
           <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
              <button type="submit"class="btn btn-success btn-sm">Submit</button>
                <a class="btn btn-primary btn-sm" href="{{ route('system-user')}}">Go back</a>
               </div>
            </div>
   </div>
 </form>
</div>


@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
          $(window).on('load', function() {
        console.log('All assets are loaded')
    })
    $(document).ready(function () {
        $("#dzongkhag").on('change',function(e){
            console.log(e);
            var id = e.target.value;
            //alert(id);
            $.get('/json-dzongkhag?dzongkhag=' + id, function(data){
                console.log(data);
                $('#gewog').empty();
                $('#gewog').append('<option value="">Select Gewog</option>');
                $.each(data, function(index, gewogObj){
                    $('#gewog').append('<option value="'+ gewogObj.id +'">'+ gewogObj.gewog + '</option>');
                })
            });
        });
      
    });
    
</script>



