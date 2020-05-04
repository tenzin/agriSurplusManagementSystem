@extends('master')
@section('content')

<section class="content">
      <div class="card card-info">
         <div class="card-header">
            <h3 class="card-title">Users List</h3>
         </div>
         <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
               <thead>
                  <tr>
                     <th>Sl.No</th>
                     <th>Name</th>
                     <th>Email ID</th>
                     <th>Role</th>
                     <th>Actions</th>
                  </tr>
               </thead>
              
            </table>
         </div>
      </div>
   </section>
@endsection