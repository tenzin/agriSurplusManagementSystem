@extends('master')
@section('content')
<div class="container normal-page">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit system role</div>

                <div class="card-body">
                  @if ( session('error') || $errors->any())
                  <div class="alert alert-danger" id="session_message">
                    {{ session('error') }}
                    @foreach ($errors->all() as $error)
                       <li>{{ $error }}</li>
                   @endforeach
                  </div>
                  @endif
                <form method="POST" action="{{route('update-role')}}">
                        @csrf

                        <input id="role_id"  class="form-control" type="hidden" name="role_id" value="{{$role->id}}">
                        <div class="form-group row">
                            <label for="role_name" class="col-md-4 col-form-label text-md-right">Role name </label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="role_name" value="{{$role->role}}" required>
                                </input>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="permissions" class="col-md-4 col-form-label text-md-right">Permissions</label>

                            <div class="col-md-6">
                                @foreach($permissions as $permission)

                                @if($role->permissions->contains($permission->id))
                                <input type="checkbox" name="permissions[]" value="{{$permission->id}}" checked>
                                @else
                                <input type="checkbox" name="permissions[]" value="{{$permission->id}}">
                                @endif
                                : {{$permission->label}}</input><br/>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-info">
                                  Update Role
                                </button>
                                <a class="btn btn-primary" href="{{ route('view-role')}}">Go back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('custom_scripts')


@endsection
