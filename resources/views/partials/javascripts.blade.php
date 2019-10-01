<!-- Morris.js charts -->
<script src="{{ asset('admins/bower_components/raphael/raphael.min.js')}}"></script>
<script src="{{ asset('admins/bower_components/morris.js/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script src="{{ asset('admins/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{ asset('admins/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{ asset('admins/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('admins/bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{ asset('admins/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{ asset('admins/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{ asset('admins/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('admins/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{ asset('admins/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{ asset('admins/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admins/js/adminlte.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="{{ asset('admins/js/pages/dashboard.js')}}"></script> -->
<script src="{{ asset('admins/js/editor.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="{{ asset('admins/js/demo.js')}}"></script> -->
<!-- Datatable  -->
<!-- <script src="//code.jquery.com/jquery-1.12.3.js"></script> -->
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script
src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet"
href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet"
href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
<script>
    $(document).ready(function() {
        $('.datatable').DataTable({
        	"order": [[ 0, "desc" ]]
        });
    } );
</script>