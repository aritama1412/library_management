
<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- DataTables  & Plugins -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('assets/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>

{{-- select2 --}}
<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>

{{-- sweetalert --}}
<script src="{{ asset('vendor/sweetalert/sweetalert.all.js')}}"></script>

<!-- AdminLTE for demo purposes -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<script src="{{asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-datepicker/datepicker-locale/bootstrap-datepicker.id.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {

        $('.selectpicker').selectpicker({
          size: 10,
          noneSelectedText: "Tidak ada yang dipilih",
        });
    
        $('.select2').select2({
          // something ...
        })

        $('.date').datepicker({
          autoclose: true,
          format: "dd-M-yyyy",
          todayHighlight: true,
          language:'en',
          orientation: 'bottom auto'
        });
    });
</script>


<script>
  $(document).ready(function() {
     var sessionStatus = "<?= session()->has('status') ? session()->get('status') : null ?>";
     var sessionMsg = "<?= session()->has('msg') ? session()->get('msg') : null ?>";
     if (sessionStatus != '') {
         const Toast = Swal.mixin({
             toast: true,
             position: 'top',
             // width: '1400px',
             timer: 2500,
             showConfirmButton: false,
             timerProgressBar: true,
             didOpen: (toast) => {
                 toast.addEventListener('mouseenter', Swal.stopTimer)
                 toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
         })

         if (/^Success/.test(sessionStatus) || /^Sukses/.test(sessionStatus) || /^success/.test(sessionStatus) || /^sukses/.test(sessionStatus)) {
             var iconData = 'success';
         } else if (/^Error/.test(sessionStatus) || /^error/.test(sessionStatus)) {
             var iconData = 'error';
         }else{
             var iconData = 'success';
         }
         Toast.fire({
             icon: iconData,
             title: sessionMsg
         })
     }
 });
</script>

@section('js')
@show
