<!-- Content Wrapper. Contains page content -->
@extends('master')
    
@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Supply List</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Sl. no</th>
                    <th>Product Name</th>
                    <th>Total Quantity</th>
                    {{-- <th>Total Price</th> --}}
                    {{-- <th>Status</th> --}}
                    <th>Action &nbsp;<span class="fa fa-cogs"></span></th>
               
              </tr>
              </thead>
            <tr>
              <td>1</td>
              <td>Pumkin</td>          
              <td>10 kg</td>
              <td>
               <button type="button" class="btn btn-block bg-gradient-warning btn-xs" style="width:2cm;">
               <a href="{{route('addmore_supply_details')}}" >Add More</a>
               </button>
               <button type="button" class="btn btn-block bg-gradient-warning btn-xs" style="width:2cm;">
               <a href="{{route('viewall_supply_details')}}" >View All</a>
               </button></td>                              
            </tr>
            </table>
          </div>

        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
 @endsection

  
  
