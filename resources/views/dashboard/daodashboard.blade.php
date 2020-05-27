
@extends('master')

@section('content')
<div class="container-fluid">
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
</div>
 @endsection