<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Thabit</title>
    <link rel="apple-touch-icon" href="{{url('/')}}/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('public/app-assets/images/ico/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/vendors/css/charts/apexcharts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/vendors/css/extensions/toastr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/themes/bordered-layout.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/pages/dashboard-ecommerce.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/plugins/charts/chart-apex.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/plugins/extensions/ext-component-toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/style.css')}}">

     <link rel="stylesheet" type="text/css" href="{{asset('public/app-assets/css/plugins/forms/pickers/form-flat-pickr.css')}}">
    <!-- END: Custom CSS-->
    @yield('css')
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

    @include('layouts.partials.navbar')

    <main class="container1">
        @yield('content')

    </main>
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-md-right d-none d-md-block"></span></p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>





   
    <!-- BEGIN: Vendor JS-->
    <script src="{{asset('public/app-assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('public/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
    <script src="{{asset('public/app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('public/app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{asset('public/app-assets/js/core/app.js')}}"></script>
    <!-- END: Theme JS-->


        <script src="{{asset('public/app-assets/vendors/js/ui/jquery.sticky.js')}}"></script>
 <script src="{{asset('public/app-assets/vendors/js/charts/chart.min.js')}}"></script>
<script src="{{asset('public/app-assets/js/scripts/charts/chart-chartjs.js')}}"></script>
<script src="{{asset('public/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>

    <!-- BEGIN: Page JS-->
    <script src="{{asset('public/app-assets/js/scripts/pages/dashboard-ecommerce.js')}}"></script>

    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    
    @yield('javascript')
     <!--  <script src="{{url('/')}}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="{{url('/')}}/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="{{url('/')}}/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <script src="{{url('/')}}/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
    <script src="{{url('/')}}/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="{{url('/')}}/app-assets/vendors/js/tables/datatable/responsive.bootstrap.min.js"></script> -->
    <!-- END: Page JS-->

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
            $('#example1').DataTable();
            // new DataTable('#myTable');
        });

        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        });

        $(".btn_create").click(function(){
            var url=$(this).data('url');
            var width=$(this).data('width');
            $('#commonModal').modal({backdrop: 'static', keyboard: false});
            $(".modal-dialog").css("max-width", width);

            $.ajax({
                        type: "get",
                        url:url,
                        data: {  },
                        cache: false,

                        success: function(data)
                        {
                        //if response is html
                        $('.modal-content').html(data);
                             
                        }
            });
        });


    </script>









     <!-- Right Sidebar starts -->
     <div class="modal modal-slide-in sidebar-todo-modal fade" id="commonModal">
                            <div class="modal-dialog sidebar-lg">
                                <div class="modal-content p-0">
                                   
                                </div>
                            </div>
                        </div>
                        <!-- Right Sidebar ends -->

</body>
<!-- END: Body-->

</html>