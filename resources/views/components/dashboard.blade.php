<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="{{asset('logo.png')}}" type="image/x-icon">
    <title>{{config('app.name')}}  - Dashboard</title>


    <!-- Linear Icon css -->
    <link rel="stylesheet" href="{{asset('assets/css/linearicon.css')}}">

    <!-- fontawesome css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/font-awesome.css')}}">

    <!-- Themify icon css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/themify.css')}}">

    <!-- ratio css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/ratio.css')}}">

    <!-- remixicon css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/remixicon.css')}}">

    <!-- Feather icon css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/feather-icon.css')}}">

    <!-- Plugins css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/scrollbar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/animate.css')}}">

    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/bootstrap.css')}}">

    <!-- vector map css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vector-map.css')}}">

    <!-- Slick Slider Css -->
    <link rel="stylesheet" href="{{asset('assets/css/vendors/slick.css')}}">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">

    <!-- Select2 css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/select2.min.css')}}">


    <link rel="stylesheet" href="{{ URL::to('toastr.min.css') }}">
    <script src="{{ URL::to('toastr_jquery.min.js') }}"></script>
	<script src="{{ URL::to('toastr.min.js') }}"></script>
    <script src="{{asset('qrcode/qrcode.js')}}"></script>

    <style>
        .status-warning span {
            background-color: rgba(226, 187, 36, 0.45);
            color: #e19400;
            padding: 5px 10px;
            text-transform: capitalize;
            display: inline-block;
            border-radius: 5px;
            font-size: 12px;
            font-weight: 400;
            }
    </style>
</head>

<body>

    <!-- tap on top start -->
    <div class="tap-top">
        <span class="lnr lnr-chevron-up"></span>
    </div>
    <!-- tap on tap end -->

    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <x-nav/>

        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <x-sidebar/>
            <!-- index body start -->
            <div class="page-body">
                {!! Toastr::message() !!}
               {{ $slot }}

                <!-- footer start-->
                <div class="container-fluid">
                    <footer class="footer">
                        <div class="row">
                            <div class="col-md-12 footer-copyright text-center">

                                <p class="mb-0">Copyright 2024 © Pharmaceutical  AntiCounterfeiting </p>
                            </div>
                        </div>
                    </footer>
                </div>
                <!-- footer End-->
            </div>
            <!-- index body end -->

        </div>
        <!-- Page Body End -->
    </div>
    <!-- page-wrapper End-->

    <!-- Modal Start -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="modal-title" id="staticBackdropLabel">Logging Out</h5>
                    <p>Are you sure you want to log out?</p>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="button-box">
                        <button type="button" class="btn btn--no" data-bs-dismiss="modal">No</button>
                        <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                 <button type="submit" class="btn  btn--yes btn-primary">Yes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End -->

    <!-- sidebar effect -->
    <script src="{{asset('assets/js/ethers.js')}}"></script>
    <script src="{{asset('custom.js')}}"></script>
    <!-- select2 js -->
    <script src="{{asset('assets/js/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/select2-custom.js')}}"></script>
    <!-- latest js -->
    <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>

    <!-- Bootstrap js -->
    <script src="{{asset('assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>

    <!-- feather icon js -->
    <script src="{{asset('assets/js/icons/feather-icon/feather.min.js')}}"></script>
    <script src="{{asset('assets/js/icons/feather-icon/feather-icon.js')}}"></script>

    <!-- scrollbar simplebar js -->
    <script src="{{asset('assets/js/scrollbar/simplebar.js')}}"></script>
    <script src="{{asset('assets/js/scrollbar/custom.js')}}"></script>

    <!-- Sidebar jquery -->
    <script src="{{asset('assets/js/config.js')}}"></script>

    <!-- tooltip init js -->
    <script src="{{asset('assets/js/tooltip-init.js')}}"></script>

    <!-- Plugins JS -->
    <script src="{{asset('assets/js/sidebar-menu.js')}}"></script>
    <script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('assets/js/notify/index.js')}}"></script>

    <!-- Apexchar js -->
    <script src="{{asset('assets/js/chart/apex-chart/apex-chart1.js')}}"></script>
    <script src="{{asset('assets/js/chart/apex-chart/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/chart/apex-chart/apex-chart.js')}}"></script>
    <script src="{{asset('assets/js/chart/apex-chart/stock-prices.js')}}"></script>
    <script src="{{asset('assets/js/chart/apex-chart/chart-custom1.js')}}"></script>


    <!-- slick slider js -->
    <script src="{{asset('assets/js/slick.min.js')}}"></script>
    <script src="{{asset('assets/js/custom-slick.js')}}"></script>

    <!-- customizer js -->
    <script src="{{asset('assets/js/customizer.js')}}"></script>

    <!-- ratio js -->
    <script src="{{asset('assets/js/ratio.js')}}"></script>

    <!-- sidebar effect -->
    <script src="{{asset('assets/js/sidebareffect.js')}}"></script>


    <!-- Theme js -->
    <script src="{{asset('assets/js/script.js')}}"></script>




    <script>
        var input = document.getElementById('my-dropdown');
        var datalist = document.getElementById('options');

        input.addEventListener('input', function () {
            var inputValue = this.value;
            var option;

            for (var i = 0; i < datalist.options.length; i++) {
                option = datalist.options[i];
                if (option.value === inputValue) {
                        option.selected = true;
                        break;
                }
            }
        });
    </script>

    @stack('scripts')

</body>


</html>
