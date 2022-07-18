<!-- jQuery 3 -->
<script src="{{ asset('adminLTE/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('adminLTE/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('adminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('adminLTE/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('adminLTE/bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('adminLTE/bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('adminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ asset('adminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('adminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ asset('adminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('adminLTE/bower_components/fastclick/lib/fastclick.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('adminLTE/dist/js/adminlte.min.js') }}"></script>

<!-- DataTables -->
<script src="{{ asset('adminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('adminLTE/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.10.2/validator.min.js"></script>

<script src="{{ asset('js/iziToast.min.js') }}"></script>

<link rel="stylesheet" href="{{ url('libs/izi-modal/iziModal.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/aklibs.min.css') }}">

<script src="{{ asset('js/axios.min.js') }}"></script>
<script src="{{ asset('assets/vendor/summernote/dist/summernote.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
  toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-bottom-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "2000",
      "hideDuration": "2000",
      "timeOut": "2000",
      "extendedTimeOut": "2000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
  };
</script>

<script src="{{ asset('js/sweetalert.min.js') }}"></script>

<script>
  $(function() {
    $('.select2-all').select2({
      width: '100%'
    });
  });
</script>

@include('sweet::alert')
<form action="{{ url('/logout') }}" method="post" id="logout-form">
  {{ csrf_field() }}
</form>

<script>
    $(".logout-trigger").click(function (e) {
        e.preventDefault();
        swal({
          title: "Apakah Anda Yakin ?",
          text: "Ingin Keluar Aplikasi !",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $("#logout-form").submit();
          } else {
            swal("Anda Membatalkan Untuk Keluar Aplikasi!");
          }
        });
    })
</script>

<script>
//Date picker
  $('.datepicker').datepicker({
    autoclose: true,
    format: 'dd-mm-yyyy'
  })

  function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;

        return [day, month, year].join('-');
  }
</script>

@yield('script')