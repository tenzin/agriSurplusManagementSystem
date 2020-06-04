@extends('master')

@section('content')

    <!-- Content Header (Page header) -->
<div class="content-header">
  <form class="form-horizontal" method="POST" action = "{{route('extension_sreport')}}">
            @csrf
        <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title">View summary of surplus by:</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                  </div>
                  <!-- /.card-header -->
         
          <div class="card-body">            
<!-- supply/demand report and transaction date range. -->
                <div class="row">               
                  <div class="col col-md-auto">
                    <label for="tyear">Year:</label>
                  </div>
                  <div class="col-md-3">
                    <select class="form-control" name="tyear" id ="tyear">
                      <option value="All" selected>All</option>                  
                      <option value="2020">2020<option>
                    </select>
                  </div>
                  <div class="col col-md-auto">
                    <label for="tmonth">Month:</label>
                  </div>
                  <div class="col-md-3">
                    <select class="form-control" name="tmonth" id ="tmonth">
                      <option value="All" selected>All</option>
                      <option value="5">May</option>
                      <option value="6">June</option>
                    </select>
                  </div>
                  <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Search</button>
                  </div>  
                </div>
          </div> 
                  <!-- /.card-body -->
          <div class="card-footer">                               
          </div>
      </div>
    </form>                             
</div>

<script type="text/javascript">
          $(window).on('load', function() {
        console.log('All data are loaded')
    })
    $(document).ready(function () {
       
    });

</script>
    
@endsection