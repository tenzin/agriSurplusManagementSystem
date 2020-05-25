@extends('master')

@section('custom_css')
@include('includes/chart-css')

@endsection
@section('content')

<div class="container-fluid">
   <div class="row">
      <!-- CA info-->
      <div class="col-lg-2 col-6">
         <div class="small-box btn-outline-info">
            <div class="inner">
               <p>Commercial Aggregator</p>
               <h3>{{$ca_usres}}</h3>
            </div>
            <div class="icon">
               <i class="fas fa-users nav-icon"></i>
            </div>
         </div>
      </div>
      <div class="col-lg-2 col-6">
         <div class="small-box btn-outline-success">
            <div class="inner">
               <p>Vegetable Supply Company</p>
               <h3>{{$vsc}}</h3>
            </div>
            <div class="icon">
               <i class="fas fa-users nav-icon"></i>
            </div>
         </div>
      </div>
     
      <div class="col-lg-2 col-6">
         <div class="small-box btn-outline-warning">
            <div class="inner">
               <p>Reginal Office</p>
               <h3>{{$ardc}}</h3>
            </div>
            <div class="icon">
               <i class="fas fa-users nav-icon"></i>
            </div>
         </div>
      </div>
      <!-- LUC info-->
      <div class="col-lg-2 col-6">
         <div class="small-box btn-outline-primary">
            <div class="inner">
               <p>Land User Certificate</p>
               <h3>{{$luc_users}}</h3>
            </div>
            <div class="icon">
               <i class="fas fa-users nav-icon"></i>
            </div>
         </div>
      </div>
       <!-- EO info-->
       <div class="col-lg-2 col-6">
         <div class="small-box btn-outline-secondary">
            <div class="inner">
               <p>Extension Officer</p>
               <h3>{{$extions}}</h3>
            </div>
            <div class="icon">
               <i class="fas fa-users nav-icon"></i>
            </div>
         </div>
      </div>
      <!-- Farmer group info-->
      <div class="col-lg-2 col-6">
         <div class="small-box btn-outline-dark">
            <div class="inner">
               <p>Farmer Groups</p>
               <h3>{{$farmers}}</h3>
            </div>
            <div class="icon">
               <i class="fas fa-users nav-icon"></i>
            </div>
         </div>
      </div>
   </div>
@endsection

 