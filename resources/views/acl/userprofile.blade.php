@extends('master') 

@section('content')
<div class="container normal-page">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="title center">Update Profile</h5>
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
                    @endif @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.
                        <br>
                        <br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form method="POST" action="{{ route('changePassword') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                                    <label for="new-password">New Password</label>
                                    <input id="new-password" type="password" class="form-control" name="new-password" required> @if ($errors->has('new-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new-password') }}</strong>
                                    </span> @endif
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="new-password-confirm">Confirm Password</label>
                                    <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 pr-1">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        Change Password
                                    </button>
                                </div>
                            </div>

                        </div>

                    </form>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('changeEmail') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-5 ">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="form-control" name="email" required>

                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-4 ">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        Change Email
                                    </button>
                                </div>
                            </div>

                        </div>

                    </form>
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ route('changeContact') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-5 ">
                                <div class="form-group">
                                    <label for="email">Phone</label>
                                    <input type="tel" pattern="^\d{8}$" class="form-control" name="phone" required>

                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-4 ">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        Change Contact Number
                                    </button>
                                </div>
                            </div>

                        </div>

                    </form>
                </div>
            </div>

        </div>

        <div class="col-md-5">
            <div class="card card-user">
                <div class="image">

                </div>
                <div class="card-body">
                    <div class="author">
                        <a href="#">
                            
                        @if($user->avatar)
                         <center>  <img class="avatar border-gray" width=30% src="../profilepic/{{ $user->avatar}}" alt="..."></center>
                            @else
                           <center>  <img class="avatar border-gray" width=30% src="images/avatar04.png" alt="..."/></center>
                        @endif
                          <center>  <h5 class="title">{{$user->name}}</h5> </center>
                        </a>
                        <div class="row justify-content-center">
                            <form action="{{url('/avatar')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <table class="table">
                                    <tr>

                                        <td width="30">
                                            <input type="file" name="avatar" id="avatarFile" aria-describedby="fileHelp" />
                                        </td>
                                        <td width="30%" >
                                            <input type="submit" name="upload" class="btn btn-primary" value="Upload">
                                        </td>
                                    </tr>

                                </table>

                            </form>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <input type="text" class="form-control" disabled value="{{$user->role['role']}}" name="empId" id="empId">
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" disabled value="{{$user->email}}" name="empId" id="empId">
                    </div>
                    <div class="form-group">
                        <label>CID</label>
                        <input type="number" class="form-control" disabled value="{{$user->cid}}">
                    </div>
                    <div class="form-group">
                        <label for="email">Contact Number</label>
                        <input type="text" class="form-control" disabled value="{{$user->contact_number}}" name="empId" id="empId">
                    </div>
                    
                    <div class="form-group">
                        <label>Dzongkhag </label>
                        <input type="text" class="form-control" disabled value="{{$user->dzongkhag['dzongkhag']}}">
                    </div>

                    <div class="form-group">
                        <label>Gewog </label>
                        <input type="text" class="form-control" disabled value="{{$user->gewog['gewog']}}">
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>

@endsection 