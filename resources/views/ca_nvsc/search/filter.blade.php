@extends('master')

@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Surplus List Information</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="{{ url()->current() }}" method="GET">
                <div class="row">
                  <div class="col-md-4">
                    <select name="crop" class="form-control select2bs4">
                      <option value="">--Select Product--</option>
                      {{-- @foreach ($crops as $crop)
                          <option value="{{ $crop->id }}" {{ Request::get('crop') == $crop->id ? 'selected' : '' }}>{{ $crop->name }}</option>
                      @endforeach --}}
                    </select>
                  </div>
                  <div class="col-md-5">
                    <select name="location" class="form-control select2bs4">
                      <option value="">--Select Location--</option>
                      {{-- @foreach ($locations as $location)
                          <option value="{{ $location->id }}" {{ Request::get('location') == $location->id ? 'selected' : '' }}>{{ $location->dzongkhag->name . ' - ' . $location->name }}</option>
                      @endforeach --}}
                    </select>
                  </div>
                  <div class="col-md-3">
                    <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> </button>
                    <a href="{{ url()->current() }}" class="btn btn-danger"><i class="fa fa-undo"></i> </a>
                  </div>
                </div>
              </form>
              <hr>
              <div class="row">
                
                  <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Sl. no</th>
                      <th>Product Name</th>
                      <th>Surplus From</th>
                      <th>Quantity(kg)</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      <td>1</td>          
                      <td>Chilli</td>          
                      <td>Lhuntse-Khoma</td>          
                      <td>20 kg</td>         
                      <td>
                        <button type="button" class="btn btn-block bg-warning btn-xs" style="width:2cm;">
                          <a href="" >Claim</a>
                          </button>
                      </td>          
                      {{-- @forelse ($supplyProducts as $product)
                        <tr>
                          <th>{{ $loop->iteration }}</th>
                          <th>{{ $product->crop->name }}</th>
                          <th>{{ $product->supplyFromGeowg->dzongkhag->name.'-'.$product->supplyFromGeowg->name }}</th>
                          <th>{{ $product->supplyDetails->sum('quantity') }}</th>
                        </tr>
                      @empty
                          <td colspan="5" class="text-center text-danger">Please choose an appropriate filters to search</td>
                      @endforelse --}}
                    </tbody>
                  </table>
                </div>
                
                       
            </div>
    
            <!-- ./box-body -->
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                   
                    <h5 class="description-header text-green">
                      {{-- @forelse($totalsupply as $product)
                      {{ $product->supplyDetails->sum('quantity') }}
                      @empty
                        0
                      @endforelse --}}
                      34646 kg
                    </h5>
                    <span class="description-text">TOTAL SURPLUS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    
                    <h5 class="description-header text-yellow">10,390.90 Kgs</h5>
                    <span class="description-text">TOTAL DEMAND</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    
                    <h5 class="description-header text-green">24,813 acres</h5>
                    <span class="description-text">UNDER CULTIVATION</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block">
                   
                    <h5 class="description-header text-red">1200</h5>
                    <span class="description-text">CLAMINED</span>
                  </div>
                  <!-- /.description-block -->
                </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
          </div>
  </div>
  </div>
  </section>


  </div>
  @endsection