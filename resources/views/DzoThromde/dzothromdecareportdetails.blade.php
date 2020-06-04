@extends('master')

@section('content')

    <!-- Content Header (Page header) -->
    <!-- CA detail report -->
<div class="content-header">
  <div class="card card">
    <div class="card-header">
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
      </div>
      <div class="row">
        <div class="col text-left">
          <strong>{{$title}}
          </strong>
        </div>
        <div class="col text-right">
          <i>@isset($fromdate) From: {{date('d/m/Y',strtotime($fromdate))}} @endisset 
           @isset($todate) - {{date('d/m/Y',strtotime($todate))}} @endisset</i>
        </div>
      </div>          
    </div>
    <div class="card-body">
      <table id="example3" class="display table table-bordered">
        <thead>                  
          <tr>
            <th>Sl. #</th>
            <th>Type</th>
            <th>Product</th>
            <th>Submitted</th>
            <th>Rate</th>         
            <th>Quantity</th>
          </tr>
        </thead>
        <tbody>
          @foreach($surplus as $report)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$report->type}}</td>             
            <td>{{$report->product}}</td>
            <td>{{date('d/m/Y',strtotime($report->submittedDate))}}</td>
            <td>{{$report->price}}</td>        
            <td>{{$report->quantity}} {{$report->unit}}</td>                                                  
          </tr>
          @endforeach 
          
        </tbody>
        <tfoot>
          <tr>
              <th class="text-right" colspan="5">Total</th>
            <th><input class="form-control col-auto text-right" type="text" id="total" name="total" readonly/></th>  
          </tr>
        </tfoot>
      </table>
    </div>
   
  </div>
</div>
  
@endsection
@section('custom_scripts')
  @include('Layouts.addscripts')
  <script>
  $(document).ready( function () 
  {
    $("#example3").DataTable({
      "responsive": true,
      "autoWidth": false,
    //  "serverSide" : true,
        dom: 'B<"clear">lfrtip',
        //buttons: [ 'copy','print','excel','pdf']
        buttons: [
            {
                  extend: 'copy',
                  title:'Details of Surplus',
                  
            },           
            {
                  extend: 'print',
                  title: 'Details of Surplus',
                  
              },
            {
                  extend: 'excelHtml5',
                  title: 'Details of Surplus',
                  
              },
              {
                  extend: 'pdfHtml5',
                  title: 'Details of Surplus',
                  orientation: 'landscape',
                  pageSize: 'A4',
              }
          ],
      
       drawCallback: function () {
        var sum = $('#example3').DataTable().column(5).data().sum();
       // console.log('sum:'+sum);
        document.getElementById('total').value = sum;
       },
    });
 });

</script>     
@endsection