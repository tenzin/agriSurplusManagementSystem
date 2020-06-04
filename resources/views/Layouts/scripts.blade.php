<script src="{{asset("/bower_components/admin-lte/plugins/jquery/jquery.min.js")}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset("/bower_components/admin-lte/plugins/jquery-ui/jquery-ui.min.js")}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset("/bower_components/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<!-- ChartJS -->
<script src="{{asset("/bower_components/admin-lte/plugins/chart.js/Chart.min.js")}}"></script>
<!-- Sparkline -->
<script src="{{asset("/bower_components/admin-lte/plugins/sparklines/sparkline.js")}}"></script>
<!-- JQVMap -->
<script src="{{asset("/bower_components/admin-lte/plugins/jqvmap/jquery.vmap.min.js")}}"></script>
<script src="{{asset("/bower_components/admin-lte/plugins/jqvmap/maps/jquery.vmap.usa.js")}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset("/bower_components/admin-lte/plugins/jquery-knob/jquery.knob.min.js")}}"></script>
<!-- daterangepicker -->
<script src="{{asset("/bower_components/admin-lte/plugins/moment/moment.min.js")}}"></script>
<script src="{{asset("/bower_components/admin-lte/plugins/daterangepicker/daterangepicker.js")}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset("/bower_components/admin-lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js")}}"></script>
<!-- Summernote -->
<script src="{{asset("/bower_components/admin-lte/plugins/summernote/summernote-bs4.min.js")}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset("/bower_components/admin-lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js")}}"></script>
<!-- AdminLTE App -->
<script src="{{asset("/bower_components/admin-lte/dist/js/adminlte.js")}}"></script>
 <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset("/bower_components/admin-lte/dist/js/pages/dashboard.js")}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset("/bower_components/admin-lte/dist/js/demo.js")}}"></script>
<script src="{{asset('/bower_components/admin-lte/plugins/select2/js/select2.full.min.js')}}"></script> 

<!-- jquery-validation -->
<script src="{{asset("/bower_components/admin-lte/plugins/jquery-validation/jquery.validate.min.js")}}"></script>
<script src="{{asset("/bower_components/admin-lte/plugins/jquery-validation/additional-methods.min.js")}}"></script>
<!-- DataTables -->
<script src="{{URL::asset('/bower_components/admin-lte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('/bower_components/admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('/bower_components/admin-lte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('/bower_components/admin-lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

<link rel="stylesheet" href="{{asset('css/custom.css')}}"/>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": false,
      "autoWidth": false
   });
   

//Initialize Select2 Elements
  $('.select2').select2();

//Initialize Select2 Elements
  $('.select2bs4').select2({
  theme: 'bootstrap4'
  });

});
</script>
