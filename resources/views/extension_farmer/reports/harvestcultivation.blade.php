@extends('master')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
           
      <h2 class="text-center mt-1 mb-1 alert aqua">Cultivation Haravested</h2>
                  
                  <!-- /.card-header -->
                  <div class="card-body">
           
            <div class="card">                
                <div class="card-body">
                      <table id="example3" class="display table table-bordered">
                        <thead>                  
                            <tr>
                                <th>Sl. No.</th>
                                <th>Product</th>
                                <th>Sowing Date</th>
                                <th>Cultivation</th>
                                <th>Estimated</th>
                                <th>Output</th>
                              </tr>
                        </thead>
                        <tbody>
                           @foreach($cultivations as $report)
                            <tr>
                              <td>{{$loop->iteration}}</td>
                              <td>{{$report->product}}</td>                                             
                              <td>{{date('d/m/Y',strtotime($report->sowing_date))}}</td>  
                              <td>{{$report->quantity}} {{$report->cunit}}</td>          
                              <td>{{$report->estimated_output}} {{$report->eaunit}}</td>
                              <td>{{$report->actual_output}} {{$report->eaunit}}</td>          
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
                 
              },
              {
                  extend: 'pdfHtml5',
                  title: 'Data export',
                  
              }
          ]
    });

  });

</script>     
@endsection