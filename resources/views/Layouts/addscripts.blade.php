<!-- buttons for export of data. -->

<script src="{{URL::asset('/bower_components/admin-lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('/bower_components/admin-lte/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('/bower_components/admin-lte/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('/bower_components/admin-lte/plugins/datatables-buttons/js/buttons.flash.min.js')}}"></script>
<script src="{{URL::asset('/bower_components/admin-lte/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{URL::asset('/bower_components/admin-lte/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('/bower_components/admin-lte/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('/bower_components/admin-lte/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('/bower_components/admin-lte/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<!-- add for sum function in datatable. -->
<script src="{{URL::asset('/js/api.1.10.21.sum().js')}}"></script>
<!-- 
<script>

$(document).ready( function () 
{
  $("#example3").DataTable({
      dom: 'B<"clear">lfrtip',
      //buttons: [ 'copy','print','excel','pdf']
      buttons: [
          'copy',
          'print',
            {
                extend: 'excelHtml5',
                title: 'Data export'
            },
            {
                extend: 'pdfHtml5',
                title: 'Data export'
            }
        ]
  });

});

</script>         -->


{{-- <script src="{{URL::asset('js/jquery-1.11.1.min.js')}}"></script> --}}

{{-- <script type="text/javascript">
    $(document).ready(function(){      
      var postURL = "<?php echo url('addmore'); ?>";
      var i=1;  


      $('#add').click(function(){  
           i++;  
        //    $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="name[]" placeholder="Enter Name of Family" class="form-control name_list" /></td><td><input type="text" name="relation[]" placeholder="Enter Realtion of Family" class="form-control name_list" /></td><td><input type="text" name="occupation[]" placeholder="Enter Occupation of Family" class="form-control name_list" /></td><td><input type="text" name="country[]" placeholder="Enter country of Family" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
        $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><select class="form-control" id="producttype" onclick="myname(this.value)" name="producttype[]" required><option value="">Choose...</option> @foreach($product_type as $row)<option value="{{$row->id}}">{{$row->type}}</option>@endforeach</select></td><td><select class="form-control" id="product" name="product[]" required><option value="">Choose...</option></select></td><td><input type="date" class="form-control" name="harvestdate[]" id ="harvestdate" value="{{$trans->harvestdate ?? date('Y-m-d') }}" required></td><td><input type="text" class="form-control" name="quantity[]" id ="quantity" required/></td><td><select class="form-control" name="unit[]" id="unit"></select></td><td><input type="text" class="form-control" name="price[]" id ="price" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');

      });  


      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  


      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });


      $('#submit').click(function(){            
           $.ajax({  
                url:postURL,  
                method:"POST",  
                data:$('#add_name').serialize(),
                type:'json',
                success:function(data)  
                {
                    if(data.error){
                        printErrorMsg(data.error);
                    }else{
                        i=1;
                        $('.dynamic-added').remove();
                        $('#add_name')[0].reset();
                        $(".print-success-msg").find("ul").html('');
                        $(".print-success-msg").css('display','block');
                        $(".print-error-msg").css('display','none');
                        $(".print-success-msg").find("ul").append('<li>Record Inserted Successfully.</li>');
                    }
                }  
           });  
      });  


      function printErrorMsg (msg) {
         $(".print-error-msg").find("ul").html('');
         $(".print-error-msg").css('display','block');
         $(".print-success-msg").css('display','none');
         $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
         });
      }
    });  


    function myname(name){
        alert(name);
        // $("#producttype").on('change',function(e){
        //     console.log(e);
        //     var id = e.target.value;
        //     alert(id);
        //     $.get('/json-farmer-products?product_type=' + id, function(data){
        //         console.log(data);
        //         $('#product').empty();
        //         $('#product').append('<option value="">Choose...</option>');
        //         $.each(data, function(index, ageproductObj){
        //             $('#product').append('<option value="'+ ageproductObj.id +'">'+ ageproductObj.product + '</option>');
        //         })
        //     });
        // });
    }
</script> --}}
