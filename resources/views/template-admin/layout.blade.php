<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>Admin | MTs Nurul Islam Gunung Toar</title>
    <!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="E-Learning Admin Panel - MTs Nurul Islam Gunung Toar">
    <meta name="keywords" content="MTs Nurul Islam, Gunung Toar, E-Learning, Admin Panel, Kuantan Singingi">
    <meta name="author" content="MTs Nurul Islam Gunung Toar">

    <!-- [Favicon] icon -->
    <link rel="icon" href="{{ asset('env') }}/logo.jpg" type="image/x-icon">
    <!-- [Google Font] Family -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        id="main-font-link">
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/fonts/tabler-icons.min.css">
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/fonts/feather.css">
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/fonts/fontawesome.css">
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/fonts/material.css">
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/style-preset.css">
    <style>
        /* MTs Nurul Islam - Global E-Learning Theme Override */
        :root {
            --bs-primary: #059669 !important;
            --bs-primary-rgb: 5, 150, 105 !important;
        }
        body, .pc-sidebar .pc-link, .pc-navbar { font-family: 'Poppins', sans-serif !important; }
        .pc-header { background: #fff !important; border-bottom: 2px solid #d1fae5 !important; }
        .btn-primary { background: linear-gradient(135deg, #064e3b, #059669) !important; border-color: #059669 !important; }
        .btn-primary:hover { background: linear-gradient(135deg, #065f46, #10b981) !important; }
        .btn-outline-primary { color: #059669 !important; border-color: #059669 !important; }
        .btn-outline-primary:hover { background: #059669 !important; color: #fff !important; }
        .text-primary { color: #059669 !important; }
        .bg-primary { background: linear-gradient(135deg, #064e3b, #059669) !important; }
        .badge.bg-primary { background: #059669 !important; }
        a { color: #059669; }
        a:hover { color: #064e3b; }
        .card { border-radius: 16px !important; border: 1px solid #d1fae5 !important; box-shadow: 0 2px 12px rgba(6,78,59,0.06) !important; }
        .card-header { background: linear-gradient(135deg, #064e3b 0%, #059669 100%) !important; color: #fff !important; border-radius: 16px 16px 0 0 !important; border-bottom: none !important; }
        .card-header h5, .card-header h4, .card-header h3 { color: #fff !important; }
        .table thead th { background: #f0fdf4 !important; color: #064e3b !important; font-weight: 700 !important; border-bottom: 2px solid #d1fae5 !important; }
        .dataTables_wrapper .dt-buttons .btn { background: linear-gradient(135deg, #064e3b, #059669) !important; border: none !important; color: white !important; border-radius: 8px !important; }
        .page-item.active .page-link { background: #059669 !important; border-color: #059669 !important; }
        .page-link { color: #059669 !important; }
        .form-control:focus, .form-select:focus { border-color: #10b981 !important; box-shadow: 0 0 0 3px rgba(16,185,129,0.15) !important; }
        .pc-footer { background: #fff !important; border-top: 2px solid #d1fae5 !important; }
    </style>
    @yield('style')

</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ Sidebar Menu ] start -->
    @include('template-admin.navbar')


    <!-- [ Sidebar Menu ] end --> <!-- [ Header Topbar ] start -->
    @include('template-admin.header')

    <!-- [ Header ] end -->



    <!-- [ Main Content ] start -->
    @yield('content')

    <!-- [ Main Content ] end -->
    <footer class="pc-footer">
        <div class="footer-wrapper container-fluid">
            <div class="row">
                <div class="col-sm my-1">
                    <p class="m-0" style="color:#059669;font-size:0.82em;">🕌 MTs Nurul Islam Gunung Toar &mdash; E-Learning Platform &#9829;</p>
                </div>
                <div class="col-auto my-1">
                    <ul class="list-inline footer-link mb-0">
                        <li class="list-inline-item"><a href="/dashboard-superadmin" style="color:#059669;">Dashboard</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!--end switcher-->
    @include('sweetalert::alert')

    @yield('script')
    <!-- [Page Specific JS] start -->
    <script src="{{ asset('admin') }}/assets/js/plugins/apexcharts.min.js"></script>
    <script src="{{ asset('admin') }}/assets/js/pages/dashboard-default.js"></script>
    <!-- [Page Specific JS] end -->
    <!-- Required Js -->
    <script src="{{ asset('admin') }}/assets/js/plugins/popper.min.js"></script>
    <script src="{{ asset('admin') }}/assets/js/plugins/simplebar.min.js"></script>
    <script src="{{ asset('admin') }}/assets/js/plugins/bootstrap.min.js"></script>
    <script src="{{ asset('admin') }}/assets/js/fonts/custom-font.js"></script>
    <script src="{{ asset('admin') }}/assets/js/pcoded.js"></script>
    <script src="{{ asset('admin') }}/assets/js/plugins/feather.min.js"></script>





    <script>
        layout_change('light');
    </script>




    <script>
        change_box_container('false');
    </script>



    <script>
        layout_rtl_change('false');
    </script>


    <script>
        preset_change("preset-1");
    </script>


    <script>
        font_change("Poppins");
    </script>

    <!-- [Page Specific JS] start -->
    <!-- datatable Js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('admin') }}/assets/js/plugins/jquery.dataTables.min.js"></script>
    <script src="{{ asset('admin') }}/assets/js/plugins/dataTables.bootstrap5.min.js"></script>
    <script>
        // [ Zero Configuration ] start
        $('#simpletable').DataTable();

        // [ Default Ordering ] start
        $('#order-table').DataTable({
            order: [
                [3, 'desc']
            ]
        });

        // [ Multi-Column Ordering ]
        $('#multi-colum-dt').DataTable({
            columnDefs: [{
                    targets: [0],
                    orderData: [0, 1]
                },
                {
                    targets: [1],
                    orderData: [1, 0]
                },
                {
                    targets: [4],
                    orderData: [4, 0]
                }
            ]
        });

        // [ Complex Headers ]
        $('#complex-dt').DataTable();

        // [ DOM Positioning ]
        $('#DOM-dt').DataTable({
            dom: '<"top"i>rt<"bottom"flp><"clear">'
        });

        // [ Alternative Pagination ]
        $('#alt-pg-dt').DataTable({
            pagingType: 'full_numbers'
        });

        // [ Scroll - Vertical ]
        $('#scr-vrt-dt').DataTable({
            scrollY: '200px',
            scrollCollapse: true,
            paging: false
        });

        // [ Scroll - Vertical, Dynamic Height ]
        $('#scr-vtr-dynamic').DataTable({
            scrollY: '50vh',
            scrollCollapse: true,
            paging: false
        });

        // [ Language - Comma Decimal Place ]
        $('#lang-dt').DataTable({
            language: {
                decimal: ',',
                thousands: '.'
            }
        });
    </script>
    <!-- [Page Specific JS] end -->

</body>
<!-- [Body] end -->

</html>
