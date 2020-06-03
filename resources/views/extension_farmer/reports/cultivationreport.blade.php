@extends('master')

@section('content')

    <!-- Content Header (Page header) -->
<div class="content-header">
  <form class="form-horizontal" method="POST" action = "{{route('ext_cultivation_report')}}">
  <input type="hidden" name="report_type" value="areaundercultivation">
            @csrf
        <div class="card card">
                  <div class="card-header">
                    <h3 class="text-center">Report of Area Under Cultivations:</h3>
                  </div>
                  <!-- /.card-header -->
         
          <div class="card-body">            
<!-- supply/demand report and transaction date range. -->
                <div class="row">               
                  <div class="col col-md-auto">
                    <label for="tmonth">Month:</label>
                  </div>
                  <div class="col-md-3">
                    <select name="tmonth" id="tmonth" class="form-control">
                      <option value="All">All</option>
                      @foreach($months as $key => $value)
                      <option value="{{$key}}">{{$value}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col col-md-auto">
                    <label for="tyear">Year:</label>
                  </div>
                  <div class="col-md-3">
                    <select name="tyear" id="tyear" class="form-control">
                            @foreach($years as $y)
                                @if($y->year == date('Y'))
                                    <option value="{{$y->year}}" selected>{{$y->year}}</option>
                                @else  
                                    <option value="{{$y->year}}">{{$y->year}}</option>
                                @endif
                            @endforeach
                    </select>
                  </div>
                </div></br>

                <div class="row">
                    <div class="col col-md-auto">
                       <label for="product_type_id">Product Type:</label>
                    </div>
                    <div class="col-md-3">
                        <select  name="product_type" id="product_type_id" class="form-control">
                            <option value="">All</option>
                            @foreach($ptypes as $ptype)
                            <option value="{{ $ptype->id }}">{{$ptype->type}}</option>
                            @endforeach
                        </select>                               
                    </div>
                    <div class="col col-md-auto">
                       <label for="product">Product:</label>
                    </div>   
                    <div class="col-md-3">
                        <select class="custom-select" id="product" name="product">
                            <option value="">All</option>
                        </select>
                    </div> </br>
                    <div class="col-md-1">
                      <button type="submit" class="btn btn-primary ">Search</button>
                    </div>                                                                  
              </div> <!--- row ends -->
          </div> 
                  <!-- /.card-body -->
      </div>
    </form>                             
</div>

<div class="content-header">
    <form class="form-horizontal" method="POST" action = "{{route('ext_harvest_report')}}">
      <input type="hidden" name="report_type" value="harvested">
              @csrf
          <div class="card card">
                    <div class="card-header">
                      <h3 class="text-center">Report of Harvested:</h3>
                    </div>
                    <!-- /.card-header -->
           
            <div class="card-body">            
  <!-- supply/demand report and transaction date range. -->
                  <div class="row">               
                    <div class="col col-md-auto">
                      <label for="tmonth">Month:</label>
                    </div>
                    <div class="col-md-3">
                    <select name="tmonth" id="tmonth" class="form-control">
                      <option value="All">All</option>
                      @foreach($months as $key => $value)
                      <option value="{{$key}}">{{$value}}</option>
                      @endforeach
                    </select>
                    </div>
                    
                    <div class="col col-md-auto">
                      <label for="tyear">Year:</label>
                    </div>
                    <div class="col-md-3">
                      <select name="tyear" id="tyear" class="form-control">
                      @foreach($years as $year)
                        @if($year->year == date('Y'))
                          <option value="{{$year->year}}" selected>{{$year->year}}</option>
                        @else  
                        <option value="{{$year->year}}">{{$year->year}}</option>
                        @endif
                      @endforeach
                      </select>
                    </div>
                  </div></br>
  
                  <div class="row">
                      <div class="col col-md-auto">
                         <label for="product_type_id">Product Type:</label>
                      </div>
                      <div class="col-md-3">
                          <select  name="product_type" id="product_type_id" class="form-control">
                              <option value="">All</option>
                              @foreach($ptypes as $ptype)
                              <option value="{{ $ptype->id }}">{{$ptype->type}}</option>
                              @endforeach
                          </select>                               
                      </div>
                      <div class="col col-md-auto">
                         <label for="product">Product:</label>
                      </div>   
                      <div class="col-md-3">
                          <select class="custom-select" id="product" name="product">
                              <option value="">All</option>
                          </select>
                      </div> </br>
                      <div class="col-md-1">
                        <button type="submit" class="btn btn-primary ">Search</button>
                      </div>                                                                  
                </div> <!--- row ends -->
            </div> 
                    <!-- /.card-body -->
        </div>
      </form>                             
  </div>
  
    
@endsection