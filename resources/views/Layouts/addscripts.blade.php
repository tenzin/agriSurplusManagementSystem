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