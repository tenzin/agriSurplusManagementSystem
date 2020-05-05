@extends('master') 

@section('content')
<div class="container normal-page">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">User lists
                <hr/>
                  <a class="btn btn-primary" href="{{url('resetPassword')}}">Agency-User Reset Password</a>
                  </div>
                <div class="card-body">
                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <table class="table-hover table-bordered table-stripped">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <input type="text" id="myInput" placeholder="Search..." class="form-control" />
                        <br/>

                        <tbody id="myTable">
                            {{-- @foreach($users as $user)

                            <tr>
                                <td class="text-center">{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->Agency['administrative_name']}}</td>
                                <td>{{$user->Agency['department_name']}}</td>
                                <!-- <td>{{$user->Agency['field_office_name']}}</td> -->
                                <td>{{$user->email}}</td>
                                <td>{{$user->role->name}}</td>

                                <td class="td-actions text-right">
                                    <button type="button" rel="tooltip" class="btn btn-info btn-sm btn-round btn-icon">
                                        <a href="{{url('/acl/user/view',$user->id)}}" style="color:white"><i class="now-ui-icons gestures_tap-01"></i>
                                    </button>
                                    <button type="button" rel="tooltip" class="btn btn-success btn-sm btn-round btn-icon">
                                    <a href="{{url('/acl/user/edit',$user->id)}}" style="color:white">  <i class="now-ui-icons ui-2_settings-90"></i>
                                    </button>
                                    <button type="button" rel="tooltip" class="btn btn-danger btn-sm btn-round btn-icon" onclick="return confirm('Confirm Delete?');">
                                    <a href="{{url('/acl/user/delete',$user->id)}}" style="color:white"> <i class="now-ui-icons ui-1_simple-remove"></i>
                                    </button>
                                </td>
                            </tr>
                          @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
