<!-- Content Wrapper. Contains page content -->
@extends('master')
    
@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        </div>
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Area Under Cultivation List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example3" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sl. no</th>
                      <th>Crope_Name</th>
                      <th>Total Acerage</th>
                      <th>Action &nbsp;<span class="fa fa-cogs"></span></th>
                 
                </tr>
                </thead>
                
              <tr>
                <td>1</td>
                <td>Chilli</td> 
                <td>30 Acres</td>
                {{-- <td>{{$c->cultivationDetails->unit->type}}</td> --}}
           
                <td>
                 <button type="button" class="btn btn-block bg-gradient-warning btn-xs" style="width:2cm;">
                 <a href="{{route('addmore_cultivation_details')}}" >Add More</a>
                 </button>
                 <button type="button" class="btn btn-block bg-gradient-warning btn-xs" style="width:2cm;">
                 <a href="{{route('viewall_cultivation_details')}}" >View All</a>
                 </button></td>                              
              </tr>
            
                
              </table>
            </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
 @endsection

  
  
