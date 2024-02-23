<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('AdminPanel', 'AdminPanel | MediTips')</title>

  <!--Bootsrtap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('backend')}}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('backend')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('backend')}}/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('backend')}}/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('backend')}}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('backend')}}/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('backend')}}/plugins/summernote/summernote-bs4.min.css">
  <!-- Sweealert -->
 <link rel="stylesheet" href="{{asset('backend')}}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <!-- toastr -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">


  @stack('css')



</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  {{-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('backend')}}/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> --}}

  <!-- Navbar -->
  @if (Request::is('admin*'))
    @include('backend.includes.topbar')
  @endif
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @if(Request::is('admin*'))
    @include('backend.includes.sidebar')
  @endif
  <!-- Content Wrapper. Contains page content -->
  @if(Request::is('admin*'))
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   
    @endif
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
     @yield('admin_content')
    </section>
    <!-- /.content -->
  </div>

  <!-- /.content-wrapper -->
  @if (Request::is('admin*'))
    @include ('backend.includes.footer')
  @endif
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('backend')}}/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- ChartJS -->
<script src="{{asset('backend')}}/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{asset('backend')}}/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="{{asset('backend')}}/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{{asset('backend')}}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('backend')}}/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{asset('backend')}}/plugins/moment/moment.min.js"></script>
<script src="{{asset('backend')}}/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('backend')}}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{asset('backend')}}/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{asset('backend')}}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- sweetalert2 -->
<script src="{{asset('backend')}}//plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- toastr -->
<script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>


<!-- AdminLTE App -->
<script src="{{asset('backend')}}/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
{{-- <script src="{{asset('backend')}}/dist/js/demo.js"></script> --}}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('backend')}}/dist/js/pages/dashboard.js"></script>


<!-- Axios cdn for auto search/for category wise sub category automatic load-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.2/axios.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-json/2.6.0/jquery.json.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/JSON@1.0.0/json2.min.js"></script>
{{-- Swwetalert --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript">
       // $(document).ready(function() {
           $(document).on('click', '#delete', function(event){
               event.preventDefault();
               var link =  $(this).attr("href");
               swal({
                   title: "Are you sure you want to delete?",
                   text: "If you delete this, it will be gone forever.",
                   icon: "warning",
                   type: "warning",
                   buttons: ["Cancel","Yes!"],
                   dangerMode: true,
                   confirmButtonText: 'Yes, delete it!'
               }).then((willDelete) => {
                   if (willDelete) {
                       window.location.href = link;
                   }else{
                       swal("Safe Data!");
                   }
               });
           });
       // });
   </script>

@stack ('js')

</body>
</html>
