@extends('master')

@section('content')

    <!-- Content Header (Page header) -->
<div class="content-header">
  <form class="form-horizontal" method="POST" action = "{{route('dzothromdedreport')}}">
            @csrf
        <div class="card card">
                  <div class="card-header">
                    <h3 class="card-title">Search details of surplus by:</h3>
                    
                  </div>
                  <!-- /.card-header -->
         
          <div class="card-body">            
<!-- supply/demand report and transaction date range. -->
                <div class="row">               
                  <div class="col col-md-auto">
                    <label for="fromdate">From:</label>
                  </div>
                  <div class="col-md-2">
                    <input type="date" class="form-control" name="fromdate" id ="fromdate" value="">
                  </div>
                  <div class="col col-md-auto">
                    <label for="todate">To:</label>
                  </div>
                  <div class="col-md-2">
                    <input type="date" class="form-control" name="todate" id ="todate" value="">
                  </div>
                  <div class="col col-md-auto">
                      <label for="gewog">Gewog:</label>
                  </div>
                  <div class="col-md-4"> 
                      <select class="form-control" id="gewog" name="gewog">
                        <option value="All">All</option>
                        @foreach($gewogs as $gewog)
                                <option value="{{ $gewog->id }}">{{$gewog->gewog}}</option>
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
                    <div class="col-md-2">
                        <select class="custom-select" id="product" name="product">
                            <option value="">All</option>
                        </select>
                    </div>  
                    <div class="col-md-2">
                      <label>Type:&nbsp;</label>
                      <input id="ex" type="radio" name="rtype" value="ex" checked><label for="ex">Ext.</label>
                      <input id="ca" type="radio" name="rtype" value="ca"><label for="ex">CA</label>
                    </div>
                    <div class="col-md-1">
                      <button type="submit" class="btn btn-primary">Search</button>
                    </div>                                                                  
              </div> <!--- row ends -->
          </div> 
                  <!-- /.card-body -->
          <div class="card-footer">                               
          </div>
      </div>
    </form>                             
</div>
<div class="content-header">
  <form class="form-horizontal" method="POST" action = "{{route('aggregator_summaryreport')}}">
            @csrf
        <div class="card card">
                  <div class="card-header">
                    <h3 class="card-title center">View summary of surplus by:</h3>
                  </div>
                  <!-- /.card-header -->
         
          <div class="card-body">            
<!-- supply/demand report and transaction date range. -->
                <div class="row mb-1">               
                  <div class="col col-md-auto">
                    <label for="tyear">Year:</label>
                  </div>
                  <div class="col-md-2">
                    <select class="form-control" name="tyear" id ="tyear">
                      <option value="All" selected>All</option>
                      <option value="2020">2020<option>
                    </select>
                  </div>
                  <div class="col col-md-auto">
                    <label for="tmonth">Month:</label>
                  </div>
                  <div class="col-md-2">
                    <select class="form-control" name="tmonth" id ="tmonth">
                      <option value="All" selected>All</option>
                      <option value="5">May</option>
                    </select>
                  </div>
                  <div class="col col-md-auto">
                      <label for="gewog">Gewog:</label>
                  </div>
                  <div class="col-md-3"> 
                      <select class="form-control" id="gewog" name="gewog">
                        <option value="All">All</option>
                        @foreach($gewogs as $gewog)
                                <option value="{{ $gewog->id }}">{{$gewog->gewog}}</option>
                        @endforeach                    
                      </select>
                  </div>
                  <div class="col col-md-1">
                    <button type="submit" class="btn btn-primary ">Search</button>
                  </div>  
                </div>
          </div> 
                  <!-- /.card-body -->
  
      </div>
    </form>                             
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
          $(window).on('load', function() {
        console.log('All data are loaded')
    })
    $(document).ready(function () {
        $("#product_type_id").on('change',function(e){
            console.log(e);
            var id = e.target.value;
            //alert(id);
            $.get('/json-product_type?product_type=' + id, function(data){
                console.log(data);
                $('#product').empty();
                $('#product').append('<option value="">All</option>');
                $.each(data, function(index, ageproductObj){
                    $('#product').append('<option value="'+ ageproductObj.id +'">'+ ageproductObj.product + '</option>');
                })
            });
        });

    });

</script>
    
@endsection