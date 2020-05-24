@extends('master')
@section('content')
<div class="container-fluid">
   <div class="card card">
      <div class="card-header">
         <h3 class="card-title">Edit User</h3>
      </div>
      <form role="form" method="POST" action="{{route('update-user')}}">
         @csrf
         <div class="card-body">
            <div class="row">
               <div class="col-md-3">
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
                     <input id="name" type="text" class="form-control" name="name" readonly value="{{$users->name}}" required/>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="form-group">
                     <label>Dzongkhag:</label>
                     <select  name="dzongkhag" id="dzongkhag" class="form-control" required>
                       
                        @foreach($dzongkhags as $dzongkhag)
                           @if($users->dzongkhag->id == $dzongkhag->id)
                           <option value="{{$dzongkhag->id}}" selected>{{$dzongkhag->dzongkhag}}</option>
                           @else
                           <option value="{{$dzongkhag->id}}">{{$dzongkhag->dzongkhag}}</option>
                           @endif
                        @endforeach
                     </select>
                  </div>
                  <div class="form-group">
                     <label>Gewog:</label>
                     <select  name="gewog" id="gewog" class="form-control" required>
                        <!-- <option disabled selected>{{$users->gewog->gewog}}</option> -->
                        @foreach($gewogs as $gewog)
                           @if($users->gewog->id == $gewog->id)
                           <option value="{{$gewog->id}}" selected>{{$gewog->gewog}}</option>
                           @else
                           <option value="{{$gewog->id}}">{{$gewog->gewog}}</option>
                           @endif
                        @endforeach
                     </select>
                  </div>
                  <div class="form-group">
                     <label>Role:</label>
                     <select  name="role" id="role" class="form-control" required>
                        <!-- <option disabled selected>{{$users->role->role}}</option> -->
                        @foreach($roles as $role)
                           @if($users->role->id == $role->id)
                           <option value="{{$role->id}}" selected>{{$role->role}}</option>
                           @else
                           <option value="{{$role->id}}">{{$role->role}}</option>
                           @endif
                        @endforeach
                     </select>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="form-group">
                     <label>Address:<small></small>&nbsp;</label>
                     <input id="address" type="text" class="form-control" name="address" value="{{$users->address}}"/>
                  </div>
                  <div class="form-group">
                     <label>Contact Number:<small></small>&nbsp;</label>
                     <input id="number" type="text" class="form-control" name="number" value="{{$users->contact_number}}"/>
                  </div>
                  <div class="form-group">
                     <label>Is_Admin:<small></small>&nbsp;</label>
                     @if($users->isAdmin=="1")
                     <input type="radio" name="admin" id="admin" value="1" checked> : TRUE</input>
                     <input type="radio" name="admin" id="admin1" value="0"> : FALSE</input>
                     @else
                     <input type="radio" name="admin" id="admin" value="1" > : TRUE</input>
                     <input type="radio" name="admin" id="admin1" value="0" checked> : FALSE</input>
                     @endif
                  </div>
                  <div class="form-group">
                     <label>Is_Active:<small></small>&nbsp;</label>
                     @if($users->isActive=="1")
                     <input type="radio" name="active" id="active" value="1" checked> : TRUE</input>
                     <input type="radio" name="active" id="active1" value="0"> : FALSE</input>
                     @else
                     <input type="radio" name="active" id="active" value="1" > : TRUE</input>
                     <input type="radio" name="active" id="adtive1" value="0" checked> : FALSE</input>
                     @endif        
                  </div>
                  <div class="form-group">
                     <label>Is_Staff:<small></small>&nbsp;</label>
                     @if($users->isStaff=="1")
                     <input type="radio" name="staff" id="staff" value="1" checked> : TRUE</input>
                     <input type="radio" name="staff" id="staff1" value="0"> : FALSE</input>
                     @else
                     <input type="radio" name="staff" id="staff" value="1" > : TRUE</input>
                     <input type="radio" name="staff" id="staff1" value="0" checked> : FALSE</input>
                     @endif
                  </div>
               </div>
            </div>
         </div>
         <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
              <button type="submit"class="btn btn-success btn-sm">Submit</button>
                <a class="btn btn-primary btn-sm" href="{{ route('system-user')}}">Go back</a>
               </div>
            </div>
      </form>
   </div>
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