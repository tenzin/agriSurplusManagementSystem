@extends('master')

@section('content')
<div class="container-fluid">
   <div class="row">
      <!-- CA info-->
      <div class="col-lg-2 col-6">
         <div class="small-box btn-outline-info">
            <div class="inner">
               <p>Commercial Aggregator</p>
               <h3>{{$ca}}</h3>
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
               <h3>{{$luc}}</h3>
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
               <h3>{{$luc}}</h3>
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
               <h3>{{$ex}}</h3>
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
               <h3>{{$farmer}}</h3>
            </div>
            <div class="icon">
               <i class="fas fa-users nav-icon"></i>
            </div>
         </div>
      </div>
   <hr>
   <div class="col-lg-3">
      <div class="card type">
        <div class="card-header">
          <h4 class="card-title">Product Types</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <tbody>
                @foreach($producttype as $t)
                <tr>
                  <td>{{$t->type}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
   </div>
   <div class="col-lg-3">
      <div class="card product">
        <div class="card-header">
          <h4 class="card-title">Products</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <tbody>
                @foreach($product as $p)
                <tr>
                 <td>{{$p->product}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
   </div>
</div>
   <section class="content">
      <div class="card card">
         <div class="card-header">
            <h3 class="card-title">Extension Information</h3>
         </div>
         <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
               <thead>
                  <tr>
                     <th>Sl. no</th>
                     <th>Name</th>
                     <th>Gewog</th>
                     <th>Email</th>
                     <th>Contact</th>
                     <!-- <th>Action &nbsp;<span class="fa fa-cogs"></span></th> -->
                  </tr>
               </thead>
               <tr>
                 @foreach($users_data as $ud)
                     <td>{{$loop->iteration}}</td>
                     <td>{{$ud->name}}</td>
                     <td>{{$ud->gewog['gewog']}}</td>
                     <td>{{$ud->email}}</td>
                     
                     <td>{{$ud->contact_number}}</td>   
                 @endforeach
               </tr>
            </table>
         </div>
      </div>
   </section>
</div>  
@endsection
