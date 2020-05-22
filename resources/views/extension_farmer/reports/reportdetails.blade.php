@extends('master')

@section('content')

    <!-- Content Header (Page header) -->
    <!-- Extension-Farmer report details -->
<div class="content-header">
  <div class="card card-info">
    <div class="card-header">
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
      </div>
      <div class="row">
        <div class="col text-left">
          <strong>Details of Surplus 
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
            <th>Quantity</th>
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
            <td class="text-right">{{$report->quantity}} {{$report->unit}}</td>                                                  
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
      // "processing" : true,
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