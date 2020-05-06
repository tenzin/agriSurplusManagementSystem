@extends('master')
@section('content')
<div class="container normal-page">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add new system role</div>

                <div class="card-body">
                  @if ( session('error') || $errors->any())
                  <div class="alert alert-danger" id="session_message">
                    {{ session('error') }}
                    @foreach ($errors->all() as $error)
                       <li>{{ $error }}</li>
                   @endforeach
                  </div>
                  @endif
                <form method="POST" action="{{route('storeRole')}}">
                        @csrf

                        <div class="form-group row">
                            <label for="role_name" class="col-md-4 col-form-label text-md-right">Role name </label>

                            <div class="col-md-6">
                                <input id="role_name"  class="form-control" name="role_name" required>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role_label" class="col-md-4 col-form-label text-md-right">Role Label </label>

                            <div class="col-md-6">
                                <input id="role_label"  class="form-control" name="role_label" required>

                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="permissions" class="col-md-4 col-form-label text-md-right">Permissions</label>

                            <div class="col-md-6">
                                @foreach($permissions as $permission)
                                <input type="checkbox" name="permissions[]" value="{{$permission->id}}"> : {{$permission->label}}</input><br/>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                   Add Role
                                </button>
                                <a class="btn btn-primary" href="{{ route('indexRole')}}">Go back</a>
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
