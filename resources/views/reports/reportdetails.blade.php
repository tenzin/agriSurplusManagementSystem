@extends('master')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
           
      <h2 class="text-center mt-1 mb-1 alert aqua">Details of {{ $type }}</h2>
                  
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
              
            <div class="card">                
                <div class="card-body">
                      <table id="example3" class="display table table-bordered">
                        <thead>                  
                            <tr>
                                <th>Sl. No.</th>
                                <!-- <th>Type</th> -->
                                <th>Product</th>
                                <th>Expected Prize(Nu.)</th>
                                <th>Gewog</th>
                                <th>Dzongkhag</th>
                                <th>Harvest</th>
                                <th>Submitted</th>
                                <th>Quantity</th>
                              </tr>
                        </thead>
                        <tbody>
                           @foreach($details as $report)
                            <tr>
                              <td>{{$loop->iteration}}</td>
                              <!-- <td>{{$report->type}}</td>  -->
                              <td>{{$report->product}}</td>                             
                              <td>{{$report->price}}</td> 
                              <td>{{$report->gewog}}</td>
                              <td>{{$report->dzongkhag}}</td>
                              <td>{{$report->harvestDate}}</td>  
                              <td>{{$report->submittedDate}}</td>          
                              <td>{{$report->quantity}} {{$report->unit}}</td>          
                            </tr>
                           @endforeach 
                        </tbody>
                      </table>
                </div>
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
                $('#product').append('<option value="0">All</option>');
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
                $('#gewog').append('<option value="0">All</option>');
                $.each(data, function(index, gewogObj){
                    $('#gewog').append('<option value="'+ gewogObj.id +'">'+ gewogObj.gewog + '</option>');
                })
            });
        })

    });

</script>
    
@endsection
@section('custom_scripts')
  @include('Layouts.addscripts')
  <script>
  $(document).ready( function () 
  {
    $("#example3").DataTable({    
        dom: 'B<"clear">lfrtip',
        // buttons: [ 'copy','print','excel','pdf']
        buttons: [
            {
                  extend: 'copy',
                  
                  title:'Product List',
                  exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7]
                }
            },           
            {
                  extend: 'print',
                  exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7]
                }
              },
            {
                  extend: 'excelHtml5',
                  title: 'Data export',
                  exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7]
                }
              },
              {
                  extend: 'pdfHtml5',
                  title: 'Data export',
                  exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7]
                }
              }
          ]
    });

  });

</script>     
@endsection