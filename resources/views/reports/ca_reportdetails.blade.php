@extends('master')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
           
      <h2 class="text-center mt-1 mb-1 alert aqua">Details of {{ $type }}</h2>
                  
                  <!-- /.card-header -->
                  <div class="card-body">
                    
              
            <div class="card">                
                <div class="card-body">
                      <table id="example3" class="display table table-bordered">
                        <thead>                  
                            <tr>
                                <th>Sl. No.</th>
                                <!-- <th>Type</th> -->
                                <th>Product</th>
                                <th>Expected Prize(Nu.)</th>
                                <th>Dzongkhag</th>
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
                              <td>Nu.{{$report->price}}</td> 
                              <td>{{$report->dzongkhag}}</td>
                              <td>{{$report->submittedDate}}</td>          
                              <td>{{$report->quantity}} {{$report->unit}}</td>          
                            </tr>
                           @endforeach 
                        </tbody>
                      </table>
                </div>
            </div>
   
    
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