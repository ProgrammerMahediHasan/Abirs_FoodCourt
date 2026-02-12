<!DOCTYPE html>
<html lang="en">

<head>
    <title>Abir's FoodCourt</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    {{-- <link rel="icon" type="image/png" href="{{ asset('assets/images/Abir.png') }}"> --}}

    <!-- Vendor CSS -->
    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ============================
           GLOBAL VARIABLES
        ============================ */
        :root {
            --primary: #FF7F50;
            /* Coral */
            --primary-light: rgba(255, 127, 80, 0.1);
        }

        body {
            font-family: 'Poppins', sans-serif !important;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Poppins', sans-serif !important;
        }

        /* ============================
           NAV HEADER / SIDEBAR / HEADER COLOR
        ============================ */
        .nav-header,
        .header,
        .deznav,
        .header-content {
            background-color: #FF7F50 !important;
            /* Coral */
        }

        /* ============================
           HAMBURGER & ICONS & HOVER
        ============================ */
        /* Hamburger Color (Black for Coral bg) */
        .nav-header .hamburger .line {
            background-color: #000000 !important;
            background: #000000 !important;
            color: #000000 !important;
        }

        /* Ensure hamburger wrapper is transparent or visible */
        .nav-header .hamburger {
            background-color: transparent !important;
        }

        /* Toggle between Hamburger and Arrow */
        .hamburger.active-arrow .line {
            display: none !important;
        }

        .hamburger.active-arrow .arrow-icon {
            display: block !important;
        }

        /* Always show Logo */
        .nav-header .brand-logo,
        .nav-header img.brand-title {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }

        /* Sidebar Icons Color (White for Coral bg) */
        .deznav .metismenu>li>a>i {
            color: #ffffff !important;
        }

        /* Sidebar Menu Item Hover */
        .deznav .metismenu>li>a:hover,
        .deznav .metismenu>li>a:focus,
        .deznav .metismenu>li.mm-active>a,
        .deznav .metismenu>li:hover>a {
            color: #FF7F50 !important;
            background-color: #ffffff !important;
            /* White bg on hover */
        }

        /* Ensure icon changes color on hover/active to match text */
        .deznav .metismenu>li>a:hover>i,
        .deznav .metismenu>li>a:focus>i,
        .deznav .metismenu>li.mm-active>a>i,
        .deznav .metismenu>li:hover>a>i {
            color: #FF7F50 !important;
        }

        /* Sidebar Text Color (Default - White) */
        .deznav a,
        .header a,
        .deznav .nav-label,
        .deznav .metismenu li a {
            color: #ffffff !important;
            font-size: 15px;
            /* Professional font size */
        }

        /* Header Text Sizing & Color */
        .header .dashboard_bar {
            font-size: 18px !important;
            color: #ffffff !important;
            font-weight: 600;
        }

        /* Hover Text Color specifically */
        .deznav .metismenu li a:hover {
            color: #FF7F50 !important;
        }

        /* Sub-menu styling if present */
        .deznav .metismenu ul a {
            color: rgba(255, 255, 255, 0.8) !important;
            font-size: 14px;
        }

        .deznav .metismenu ul a:hover {
            color: #ffffff !important;
            background-color: rgba(255, 255, 255, 0.2) !important;
        }

        @media only screen and (max-width: 767px) {
            .nav-header {
                height: 80px;
                /* Smaller height on mobile */
                width: 80px;
                /* Adjust width to fit hamburger if needed, or keep standard */
            }

            .nav-header img.brand-title {
                display: block !important;
                /* Show logo on mobile */
                height: 40px;
                /* Adjust size for mobile */
                margin-right: 10px;
            }
        }

        /* ============================
           SIDEBAR & HEADER TEXT
        ============================ */
        /* Note: Text colors are handled above with !important */

        .nav-header {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80px;
            /* Reduced from 120px */
            position: relative;
        }

        .header {
            height: 80px;
            /* Match nav-header */
        }

        .deznav {
            top: 80px;
            /* Match nav-header */
        }

        /* Adjust Content Body to match new header height */
        .content-body {
            /* margin-top: 80px; */
            /* Disabled to fix layout drop issue */
        }

        .nav-header img.brand-title {
            width: auto;
            height: 50px;
            /* Reduced from 70px */
            border-radius: 6px;
            background: transparent;
            /* Remove white background box if it looks odd on white header, or keep it */
            box-shadow: none;
            /* Remove shadow for cleaner look or keep it subtle */
            transition: transform 0.3s ease;
            max-width: 90%;
            object-fit: contain;
        }

        /* Professional Table Styling */
        .table thead th {
            background-color: #f8f9fa;
            color: #2c3e50;
            font-weight: 600;
            border-bottom: 2px solid #e9ecef;
            white-space: nowrap;
        }

        .table tbody td {
            vertical-align: middle;
            color: #555;
            padding: 15px 10px;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(255, 127, 80, 0.05);
        }

        .badge {
            padding: 6px 12px;
            font-weight: 500;
            border-radius: 6px;
        }
    </style>
</head>

<body>

    <div id="main-wrapper">

        <!-- Nav header start -->
        <div class="nav-header">
            <a href="{{ route('dashboard') }}" class="brand-logo">
                <img class="brand-title" src="{{ asset('assets/images/logo.svg') }}" alt="Abir FoodCourt Logo">
            </a>
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                    <i class="fas fa-arrow-right arrow-icon" style="display:none; color: #000; font-size: 24px;"></i>
                </div>
            </div>

            <script>
                document.querySelector('.hamburger').addEventListener('click', function() {
                    this.classList.toggle('active-arrow');
                });
            </script>
        </div>
        <!-- Nav header end -->

        <!-- Header start -->
        <div class="header">
            @include('layout.erp.partials.header')
        </div>
        <!-- Header end -->

        <!-- Sidebar start -->
        <div class="deznav">
            @include('layout.erp.partials.sidebar')
        </div>
        <!-- Sidebar end -->

        <!-- Content body start -->
        <div class="content-body">
            @yield('content')
        </div>
        <!-- Content body end -->

        <!-- Footer start -->
        <div class="footer">
            @include('layout.erp.partials.footer')
        </div>
        <!-- Footer end -->

    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart-js/chart.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.min.js') }}"></script>
    <script src="{{ asset('assets/js/deznav-init.js') }}"></script>

    {{-- Page-specific scripts --}}
    @yield('scripts')

    {{-- Optional: dashboard page charts --}}
    @if(Request::routeIs('/'))
    {{-- <script src="{{ asset('assets/vendor/apexchart/apexchart.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/dashboard/dashboard-1.js') }}"></script> --}}
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            if (window.jQuery && jQuery.fn.selectpicker) {
                jQuery('select[data-content]').each(function(){
                    const $el = jQuery(this);
                    if (!$el.hasClass('selectpicker')) {
                        $el.addClass('selectpicker');
                    }
                });
                jQuery('.selectpicker').selectpicker('render');
                jQuery('.selectpicker').selectpicker('refresh');
            }
        });
    </script>

</body>

</html>
