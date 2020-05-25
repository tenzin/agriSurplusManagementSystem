@extends('master')

@section('content')

    <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="card card-info">
    <div class="card-header">
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
      </div>
      <div class="row">
        <div class="col text-left">
          <strong>Summary of Submitted Surplus by Type</strong>
        </div>
        <div class="col text-right">
         <span>Year:{{$tyear}}, Month: 
         @if($tmonth != "All") 
          {{ date("F", mktime(0, 0, 0, $tmonth, 1)) }}
         @else
          All
         @endif
         </span>
        </div>
      </div>          
    </div>
    <div class="card-body">
      <table id="example3" class="display table table-bordered">
        <thead>                  
          <tr class="text-center">
            <th>Sl. #</th>
            <th>Type</th>
            <th>Month</th>          
            <th>Year</th>
            <th>Gewog</th>
            <th>Quantity</th>
          </tr>
        </thead>
        <tbody>
          @foreach($summary as $report)
          <tr class="text-center">
            <td>{{$loop->iteration}}</td>
            <td class="text-left">{{$report->type}}</td>                         
            <td>{{ date("F", mktime(0, 0, 0, $report->tmonth, 1)) }}</td> 
            <td>{{$report->tyear}}</td>
            <td>{{$report->gewog}}</td>
            <td class="text-right">{{$report->quantity}} {{$report->unit}}</td>                                             
          </tr>
          @endforeach 
          
        </tbody>
        <tfoot>
          <tr>
              <th class="text-right" colspan="5">Total</th>
            <th><input class="form-control text-right" type="text" id="total" name="total" readonly/></th>  
          </tr>
        </tfoot>
      </table>
    </div>
   
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
          $(window).on('load', function() {
        console.log('All data are loaded')
    })
    $(document).ready(function () {

    });

</script>
    
@endsection
@section('custom_scripts')
  @include('Layouts.addscripts')
  <script>
  $(document).ready( function () 
  {
    $("#example3").DataTable({
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
                  
              },
            {
                  extend: 'excelHtml5',
                  title: 'Details of Surplus',
                  
              },
              {
                  extend: 'pdfHtml5',
                  title: 'Details of Surplus',
                  
              }
          ],
      //  "ajax" : {

      //     url: 

      //  },
       drawCallback: function () {
        var sum = $('#example3').DataTable().column(5).data().sum();
       // console.log('sum:'+sum);
        document.getElementById('total').value = sum;
       },
          //get sum of quantity.
          // drawCallback: function () 
          //   {
          //   var api = this.api();
          //   $( api.table().footer() ).html
          //     (
          //       api.column( 3, {page:'current'} ).data().sum()
          //     );
              
          //   },
    });
 });

</script>     
@endsection