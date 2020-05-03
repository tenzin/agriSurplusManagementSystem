@extends('master') 
@section('content')

<div class="container normal-page">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-success">
                <div class="card-header">
                    <h5 class="title">Update Profile</h5>
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
                    <form method="POST" action="#">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-5 ">
                                <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                                    <label for="current-confirm">Current Password</label>
                                    <input id="current-password" type="password" class="form-control" name="current-password" required> @if ($errors->has('current-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                    </span> @endif
                                </div>
                            </div>

                        </div>

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

                    <form method="POST" action="#">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-4 ">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="form-control" name="email" required>

                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-8 ">
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
                    <form method="POST" action="#">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">Phone</label>
                                    <input type="tel" pattern="^\d{8}$" class="form-control" name="phone" required>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-8 ">
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
                     
                    <div class="form-group">
                        <label for="role">Role</label>
                        <input type="text" class="form-control" disabled value="#" name="empId" id="empId">
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" disabled value="#" name="empId" id="empId">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" disabled value="@" name="empId" id="empId">
                    </div>
                    <div class="form-group">
                        <label for="contact">Contact Number</label>
                        <input type="text" class="form-control" disabled value="#" name="empId" id="empId">
                    </div>
                    <div class="form-group">
                        <label for="dzongkhag">Dzongkhag</label>
                        <input class="form-control" disabled value="">
                    </div>
                    <div class="form-group">
                        <label for="geog">Geog</label>
                        <input type="number" class="form-control" disabled value="#">
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

@endsection 