@extends('master')

@section('content')
<div class="container normal-page">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Role List
                  <hr/>
                <a class="btn btn-primary" href="{{route('add-role')}}">Add a new Role</a>
                </div> <!--card header-->


                <div class="card-body">
                  @include('Layouts.message') 
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th>Role name</th>
                            <th>Permissions</th>
                            <th>Users</th>
                            <th>Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td class="text-center">{{$role->id}}</td>
                                <td>{{$role->role}}</td>
                                <td>
                                  <ul>
                                @foreach($role->permissions as $permission)
                                <li>{{$permission->label}}</li>
                                @endforeach
                              </ul>
                              </td>
                              <td>
                                <ul>

                                @foreach($role->users as $user)
                                <li>{{$user->name}}</li>
                                @endforeach
                              </ul>
                              </td>

                              <td>
                                <a href="{{route('edit-role',$role['id'])}}" class="btn btn-primary btn-xs" onclick="return confirm('Are you sure to you want to edit this data??');"></span>Edit</a>
                                <a href="{{route('destroy-role',$role['id'])}}" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to delete this data??');"></span>Delete</a>
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

