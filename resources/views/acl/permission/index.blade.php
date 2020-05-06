@extends('master')

@section('content')


<div class="container-fluid">
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-header">Permission List
                  <hr/>
                <a class="btn btn-primary" href="{{route('add-permission')}}">Add a new Permission</a>
                </div>
                <div class="card-body">
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
                            <th class="text-center">ID</th>
                                <th>Permission name</th>
                                <th>Label</th>
                                <th>Roles</th>
                                <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($permissions as $permission)
                            <tr>
                                <td class="text-center">{{$permission->id}}</td>
                                <td>{{$permission->name}}</td>
                                <td>{{$permission->label}}</td>
                                <td>
                                <ul>
                                @foreach($permission->roles as $role)
                                <li>{{$role->role}}</li>
                                @endforeach
                              </ul>
                              </td>
                              <td>
                                <a href="{{route('edit-permission',$permission['id'])}}" class="btn btn-primary btn-xs" onclick="return confirm('Are you sure to you want to edit this data??');"></span>Edit</a>
                                <a href="{{route('destroy-permission',$permission['id'])}}" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to delete this data??');"></span>Delete</a>
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
