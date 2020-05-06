@extends('master')
@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Permission form') }}</div>

                <div class="card-body">
                 @if ($errors->any())
                 <div class="alert alert-danger">
                 <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                 </ul>
                </div>
                 <br />
                     @endif
            <form method="POST" action="{{route('store-permission')}}">
                    @csrf
                        <div class="form-group">
                            <label for="name" class="col-md-4 col-form-label text-md-left">{{ __('Name') }}</label>
                            <input type="text" placeholder="Can Name" class="form-control" name="name" id="permission_name" required>
                        </div>

                        <div class="form-group">
                            <label for="label" class="col-md-4 col-form-label text-md-left">{{ __('Label') }}</label>
                            <input type="text" placeholder="Permission label" class="form-control" name="label" id="permission_label" required>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Add permission') }}

                                </button>
                                <a class="btn btn-primary" href="{{ route('view-permission')}}">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
