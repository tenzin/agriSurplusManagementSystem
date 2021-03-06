@extends('master')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
          <form class="form-horizontal" method="POST" action = "{{route('report-details')}}">
            @csrf
          <div class="card card">
                  <div class="card-header">
                    <h3 class="text-center">Search By:</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                   
<!-- supply/demand report and transaction date range. -->

                <div class="row">
                  <div class="col-sm-1">
                    <label for="report_type">Type:<font color="red">*</font></label>
                  </div>
                  <div class="col-md-3">
                    <select name="report_type" id="report_type" required class="form-control">
                      <option value="Extension" selected>Exetnsions/LUC/FG</option>
                      <option value="Aggegrator">Aggegrator</option>
                    </select>
                  </div>

                  <div class="col-sm-1">
                    <label for="fromdate">From:<font color="red">*</font></label>
                  </div>
                  <div class="col-md-2">
                  <input type="date" class="form-control" name="fromdate" id ="fromdate" value="{{ date('Y-m-d') }}" required>
                  </div>
                  <div class="col-sm-1">
                    <label for="report_type">To:</label>
                  </div>
                  <div class="col-md-2">
                  <input type="date" class="form-control" name="todate" id ="fromdate" value="{{ date('Y-m-d') }}">
                  </div>

                </div></br>

                <div class="row">
                    <div class="col-sm-auto">
                       <label for="product_type_id">Product Type:</label>
                    </div>
                    <div class="col-md-4">
                        <select  name="product_type" id="product_type_id" class="form-control">
                            <option value="All">All</option>
                            @foreach($ptypes as $ptype)
                            <option value="{{ $ptype->id }}">{{$ptype->type}}</option>
                            @endforeach
                        </select>                               
                    </div>
                    <div class="col-sm-1">
                       <label for="product">Product:</label>
                    </div>   
                    <div class="col-md-4">
                        <select class="custom-select" id="product" name="product">
                            <option value="All">All</option>
                        </select>
                    </div>  
                          <div class="invalid-feedback">
                            Please provide a valid input.
                          </div>                    
                </div></br>

                  <!-- Selection of Dzongkhag and Gewog. -->
            <div class="row">
              <div class="col-sm-auto">
                  <label for="dzongkhag">Dzongkhag:</label>
              </div>

              <div class="col-md-4">    
                  <select class="form-control" id="dzongkhag" name="dzongkhag">
                     <option value="All">All</option>
                     @foreach($dzongkhags as $row)
                         <option value="{{$row->id}}">{{$row->dzongkhag}}</option>
                     @endforeach
                   </select>
              </div>       
               
              <div class="col-sm-auto">
                <label for="gewog">Gewog:</label>
              </div>

              <div class="col-md-4"> 
                  <select class="form-control" id="gewog" name="gewog">
                     <option value="All">All</option>
                   </select>
               </div>
            </div>
            <div class="row mt-2">
               <div class="col-sm-auto">
                <label for="dates">Date Selection:</label>
              </div>
              <div class="col-md-4" id="dates"> 
                <input id="hdate" type="radio" name="sdate" value="harvestDate" checked>&nbsp;<label for="hdate">Harvested</label>&nbsp;
                <input id="subdate" type="radio" name="sdate" value="submittedDate">&nbsp;<label for="hdate">Submitted</label>
              </div>
              
            </div>   
                  @csrf
                                   
                  <center>  <button type="submit" class="btn btn-primary float-center ">Search</button></center>
                  
          </div>
          
        </form>            
    </div>     
     

    <div class="content-header">
      <form class="form-horizontal" method="POST" action = "{{route('ca-report')}}">
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
                      <div class="col-sm-1">
                        <label for="report_type">Type:<font color="red">*</font></label>
                      </div>
                      <div class="col-md-3">
                        <select name="report_type" id="report_type" required class="form-control">
                          <option value="Cultivation" selected>Under Cultivation</option>
                          <option value="Harvested">Harvested</option>
                        </select>
                      </div>             
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
                        </div>
                          
                        </div>
                      </br> 
                        <div class="row">
                      
                            <div class="col-sm-auto">
                                <label for="dzongkhag">Dzongkhag:</label>
                            </div>
              
                            <div class="col-md-3">    
                                <select class="form-control" id="dzongkhag" name="dzongkhag">
                                   <option value="All">All</option>
                                   @foreach($dzongkhags as $row)
                                       <option value="{{$row->id}}">{{$row->dzongkhag}}</option>
                                   @endforeach
                                 </select>
                            </div> 
                            <div class="col-sm-auto">
                              <label for="gewog">Gewog:</label>
                            </div>
              
                            <div class="col-md-4"> 
                                <select class="form-control" id="gewog" name="gewog">
                                   <option value="All">All</option>
                                 </select>
                             </div>      
                          </div>
                          
                        </br>
                        
                        <center>  <button type="submit" class="btn btn-primary ">Search</button> </center>
                                                                                        
                  </div> <!--- row ends -->
              </div> 
                      <!-- /.card-body -->
          </div>
        </form>                             
    </div>           
</div>     
  </div>  
</div> 
@endsection

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
                $('#product').append('<option value="All">All</option>');
                $.each(data, function(index, ageproductObj){
                    $('#product').append('<option value="'+ ageproductObj.id +'">'+ ageproductObj.product + '</option>');
                })
            });
        });

        $("#dzongkhag").on('change',function(e){
            console.log(e);
            var dzid = e.target.value;
            //alert(id);
            $.get('/json-dzongkhag?dzongkhag=' + dzid, function(data){
                console.log(data);
                $('#gewog').empty();
                $('#gewog').append('<option value="All">All</option>');
                $.each(data, function(index, gewogObj){
                    $('#gewog').append('<option value="'+ gewogObj.id +'">'+ gewogObj.gewog + '</option>');
                })
            });
        })

    });

</script>