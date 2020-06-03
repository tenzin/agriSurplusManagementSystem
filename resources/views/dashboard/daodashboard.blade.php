
@extends('master')

@section('content')

<div class="container-fluid">

   <div class="row">
      <!-- CA info-->
      <div class="col-lg-3 col-6 ">
         <div class="small-box btn-outline-info bg-warning">
            <div class="inner">
               <p>Commercial Aggregator</p>
               <h3>{{$ca}}</h3>
            </div>
            <div class="icon">
               <i class="ion ion-person-add"></i>
            </div>
         </div>
      </div>
      <!-- LUC info-->
      <div class="col-lg-3 col-6">
         <div class="small-box btn-outline-primary bg-primary">
            <div class="inner">
               <p>Land User Certificate</p>
               <h3>{{$luc}}</h3>
            </div>
            <div class="icon">
               <i class="ion ion-person-add"></i>
            </div>
         </div>
      </div>
       <!-- EO info-->
       <div class="col-lg-3 col-6">
         <div class="small-box btn-outline-secondary bg-success">
            <div class="inner">
               <p>Extension Officer</p>
               <h3>{{$ex}}</h3>
            </div>
            <div class="icon">
               <i class="ion ion-person-add"></i>
            </div>
         </div>
      </div>
      <!-- Farmer group info-->
      <div class="col-lg-3 col-6">
         <div class="small-box btn-outline-dark bg-info">
            <div class="inner">
               <p>Farmer Groups</p>
               <h3>{{$farmer}}</h3>
            </div>
            <div class="icon">
               <i class="ion ion-person-add"></i>
            </div>
         </div>
      </div>
   </div>
   <hr>
   <div class="row">
     <div class="col-md-6">
      <div class="card">
         <div class="card-header">
            <h4 class="card-title">Commerical Aggregator Information</h4>
         </div> 
         <div class="card-body">
            <table id="details" class="table table-hover table-bordered table-striped">
               <thead>
                  <tr>
                     <th>Sl.No</th>
                     <th>Name</th>
                     <th>Dzongkhag</th>
                     <th>Email</th>
                     <th>Contact</th>
                  </tr>
               </thead>
               @foreach($causer as $ud)
                 <tr>
                     <td>{{$loop->iteration}}</td>
                     <td>{{$ud->name}}</td>
                     <td>{{$ud->dzongkhag['dzongkhag']}}</td>
                     <td>{{$ud->email}}</td>
                     <td>{{$ud->contact_number}}</td>   
               </tr>
               @endforeach
            </table>
            </div>
        </div>
    </div>
         <div class="col-md-6">
       <div class="card">
         <div class="card-header">
            <h4 class="card-title">Extension Officer Information</h4>
         </div> 
         <div class="card-body">
            <table id="details" class="table table-hover table-bordered table-striped">
               <thead>
                  <tr>
                     <th>Sl.No</th>
                     <th>Name</th>
                     <th>Gewog</th>
                     <th>Email</th>
                     <th>Contact</th>
                  </tr>
               </thead>
               @foreach($exuser as $ud)
                 <tr>
                     <td>{{$loop->iteration}}</td>
                     <td>{{$ud->name}}</td>
                     <td>{{$ud->gewog['gewog']}}</td>
                     <td>{{$ud->email}}</td>
                     <td>{{$ud->contact_number}}</td>   
               </tr>
               @endforeach
            </table>
            </div>
         </div>
      </div>
   </div>
   <hr>
   <div class="row">
      <div class="col-md-6">
       <div class="card">
          <div class="card-header">
             <h4 class="card-title">Farmers Groups Information</h4>
          </div> 
          <div class="card-body">
             <table id="details" class="table table-hover table-bordered table-striped">
                <thead>
                   <tr>
                      <th>Sl.No</th>
                      <th>Name</th>
                      <th>Dzongkhag</th>
                      <th>Email</th>
                      <th>Contact</th>
                   </tr>
                </thead>
                @foreach($farmersgroup as $fg)
                  <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$fg->name}}</td>
                      <td>{{$fg->dzongkhag['dzongkhag']}}</td>
                      <td>{{$fg->email}}</td>
                      <td>{{$fg->contact_number}}</td>   
                </tr>
                @endforeach
             </table>
             </div>
         </div>
     </div>
          <div class="col-md-6">
        <div class="card">
          <div class="card-header">
             <h4 class="card-title">Land Users Certificate Information</h4>
          </div> 
          <div class="card-body">
             <table id="details" class="table table-hover table-bordered table-striped">
                <thead>
                   <tr>
                      <th>Sl.No</th>
                      <th>Name</th>
                      <th>Gewog</th>
                      <th>Email</th>
                      <th>Contact</th>
                   </tr>
                </thead>
                @foreach($landusers as $lU)
                  <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$lU->name}}</td>
                      <td>{{$lU->gewog['gewog']}}</td>
                      <td>{{$lU->email}}</td>
                      <td>{{$lU->contact_number}}</td>   
                </tr>
                @endforeach
             </table>
             </div>
          </div>
       </div>
    </div>
</div>
@endsection