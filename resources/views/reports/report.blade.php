@extends('master')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
          <form class="form-horizontal" method="POST" action = "{{route('report-details')}}">
            @csrf
          <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title">Search By:</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    @if ($errors->any())
                      <div class="col-sm-12">
                          <div class="alert  alert-warning alert-dismissible fade show" role="alert">
                              @foreach ($errors->all() as $error)
                                  <span><p>{{ $error }}</p></span>
                              @endforeach
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                          </div>
                      </div>
                  @endif

                  @if (session('success'))
                      <div class="col-sm-12">
                          <div class="alert  alert-success alert-dismissible fade show" role="alert">
                              {{ session('success') }}
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                          </div>
                      </div>
                  @endif
<!-- supply/demand report and transaction date range. -->

                <div class="row mb-1">
                  <div class="col-sm-2 text-right">
                    <label for="report_type">Type:<font color="red">*</font></label>
                  </div>
                  <div class="col-md-2">
                    <select name="report_type" id="report_type" required>
                      <option value="">Select type</option>
                      <option value="Surplus" selected>Surplus</option>
                      <!-- <option value="Demand">Demand</option> -->
                    </select>
                  </div>

                  <div class="col-sm-2 text-right">
                    <label for="fromdate">From:<font color="red">*</font></label>
                  </div>
                  <div class="col-md-2">
                  <input type="date" class="form-control" name="fromdate" id ="fromdate" value="{{ date('Y-m-d') }}" required>
                  </div>
                  <div class="col-sm-2 text-right">
                    <label for="report_type">To:</label>
                  </div>
                  <div class="col-md-2">
                  <input type="date" class="form-control" name="todate" id ="fromdate" value="{{ date('Y-m-d') }}">
                  </div>

                </div>

                <div class="row">
                    <div class="col-sm-2 text-right">
                       <label for="product_type_id">Product Type:</label>
                    </div>
                    <div class="col-md-4">
                        <select  name="product_type" id="product_type_id" class="form-control select2bs4">
                            <option value="">All</option>
                            @foreach($ptypes as $ptype)
                            <option value="{{ $ptype->id }}">{{$ptype->type}}</option>
                            @endforeach
                        </select>                               
                    </div>
                    <div class="col-sm-2 text-right">
                       <label for="product">Product:</label>
                    </div>   
                    <div class="col-md-4">
                        <select class="custom-select d-block w-100" id="product" name="product">
                            <option value="">All</option>
                        </select>
                    </div>  
                          <div class="invalid-feedback">
                            Please provide a valid input.
                          </div>                    
                </div>

                  <!-- Selection of Dzongkhag and Gewog. -->
            <div class="row mt-2">
              <div class="col-sm-2 text-right">
                  <label for="dzongkhag">Dzongkhag:</label>
              </div>

              <div class="col-md-4">    
                  <select class="form-control select2bs4" id="dzongkhag" name="dzongkhag">
                     <option value="">All</option>
                     @foreach($dzongkhags as $row)
                         <option value="{{$row->id}}">{{$row->dzongkhag}}</option>
                     @endforeach
                   </select>
              </div>       
               
              <div class="col-sm-2 text-right">
                <label for="gewog">Gewog:</label>
              </div>

              <div class="col-md-4"> 
                  <select class="form-control select2bs4" id="gewog" name="gewog">
                     <option value="">All</option>
                   </select>
               </div>
              
            </div>   
            

                  <!-- /.card-body -->
                  @csrf
                  <div class="card-footer mt-1">                   
                    <button type="submit" class="btn btn-primary float-right ">Search</button>
                  </div>
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

        $("#dzongkhag").on('change',function(e){
            console.log(e);
            var dzid = e.target.value;
            //alert(id);
            $.get('/json-dzongkhag?dzongkhag=' + dzid, function(data){
                console.log(data);
                $('#gewog').empty();
                $('#gewog').append('<option value="">All</option>');
                $.each(data, function(index, gewogObj){
                    $('#gewog').append('<option value="'+ gewogObj.id +'">'+ gewogObj.gewog + '</option>');
                })
            });
        })

    });

</script>
    
@endsection