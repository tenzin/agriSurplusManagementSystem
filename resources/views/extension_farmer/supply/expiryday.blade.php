@extends('master')

@section('content')
<div class="lockscreen-wrapper">
    <div class="lockscreen-logo">
      <a href="#"><b>Expiry_</b>Day</a>
    </div>
    <!-- START LOCK SCREEN ITEM -->
    <div class="lockscreen-item">
         <!-- lockscreen image -->
    <div class="lockscreen-image">
        <img src="{{asset('images/logo.jpg')}}" alt="User Image">
      </div>
      <!-- lockscreen credentials (contains the form) -->
      <form class="lockscreen-credentials" method="POST" action={{route('ex-store')}}>
        @csrf
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Enter Expiry Day" name="expirydate" id="expirydate" required/>
  
          <div class="input-group-append">
            <button type="submit" class="btn"><i class="fas fa-arrow-right text-muted"></i></button>
          </div>
        </div>
      </form>
      <!-- /.lockscreen credentials -->
  
    </div>
    <!-- /.lockscreen-item -->
    <div class="help-block text-center">
      Enter Expiry Day for this batch of product
    </div>
  </div>
@endsection