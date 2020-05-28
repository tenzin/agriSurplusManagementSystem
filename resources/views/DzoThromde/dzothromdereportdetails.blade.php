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
            <th>Harvest</th>          
            <th>Rate</th>         
            <th>Gewog</th>
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
            <td>{{date('d/m/Y',strtotime($report->harvestDate))}}</td> 
            <td>{{$report->price}}</td>        
            <td>{{$report->gewog}}</td>
            <td>{{$report->quantity}}</td>
            <td>{{$report->taken}}</td>
            <td>{{$report->quantity+$report->taken}} {{$report->unit}}</td>                                                  
          </tr>
          @endforeach 
          
        </tbody>
        <tfoot>
          <tr>
              <th class="text-right" colspan="6">Total</th>
            <th><div id="btotal"></div></th>  
            <th><div id="ttotal"></div></th>  
            <th><div id="gtotal"></div></th>  
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
                  orientation: 'landscape',
                  pageSize: 'A4',
                  
              }
          ],
      //  "ajax" : {

      //     url: 

      //  },
       drawCallback: function () {
        var bsum = $('#example3').DataTable().column(6).data().sum();
        var tsum = $('#example3').DataTable().column(7).data().sum();
        var gsum = $('#example3').DataTable().column(8).data().sum();
       // console.log('sum:'+sum);
        document.getElementById('btotal').innerHTML = '<div id="btotal">'+bsum+'</div>';
        document.getElementById('ttotal').innerHTML = '<div id="btotal">'+tsum+'</div>';
        document.getElementById('gtotal').innerHTML = '<div id="btotal">'+gsum+'</div>';
       },
          
    });
 });

</script>     
@endsection