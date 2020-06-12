@extends('master')

@section('content')
    <!-- Content Header (Page header) -->
    <!-- Extension-Farmer report details -->
<div class="content-header">
  <div class="card card-info">
    <div class="card-header">
      <div class="row">
        <div class="col text-left">
          <strong>Submitted Surplus(Based on harvest date)</strong>
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
            <th>Harvest</th>          
            <th>Rate</th>
            <th>Balance</th>
            <th>Taken</th>
            <th>Total Quantity</th>
          </tr>
        </thead>
        <tbody>
          @foreach($surplus as $report)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$report->type}}</td>             
            <td>{{$report->product}}</td>
            <td class="text-right">{{date('d/m/Y',strtotime($report->harvestDate))}}</td> 
            <td class="text-right">{{$report->price}}</td>
            <td class="text-right">{{$report->quantity}} </td>
            <td class="text-right">{{$report->taken}} </td>     
            <td class="text-right">{{$report->quantity+$report->taken}}&nbsp; {{$report->unit}} </td>                                    
          </tr>
          @endforeach 
          
        </tbody>
        <tfoot>
          <tr>
            <th class="text-right" colspan="5">Total</th>
            <th class="text-right"><div id="btotalId"></div></th>
            <th class="text-right"><div id="takentotalId"></div></th>
            <th class="text-right"><div id="gtotalId"></div></th>
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

        dom: 'B<"clear">lfrtip',
        buttons: [
            {
                  extend: 'copy',
                  title:'Details of Surplus',
                  
            },           
            {
                  extend: 'print',
                  pageSize: 'A4',
                  
              },
            {
                  extend: 'excelHtml5',
                  title: 'Details of Surplus',
                  orientation: 'landscape',
                  pageSize: 'A4',
                  
              },
              {
                  extend: 'pdfHtml5',
                  title: 'Details of Surplus',
                  orientation: 'landscape',
                  pageSize: 'A4',
                  align: 'center',
                  
              }
          ],
     
       drawCallback: function () {
        var balancetotol = $('#example3').DataTable().column(5).data().sum(); 
        var takentotal = $('#example3').DataTable().column(6).data().sum();
        var gtotalsum = $('#example3').DataTable().column(7).data().sum();
        
        document.getElementById('btotalId').innerHTML = '<div id="btotalId">'+balancetotol+'</div>';
        document.getElementById('takentotalId').innerHTML = '<div id="takentotalId">'+takentotal+'</div>';
        document.getElementById('gtotalId').innerHTML = '<div id="gtotalId">'+gtotalsum+'</div>';
        

       },
    });
 });

</script>     
@endsection