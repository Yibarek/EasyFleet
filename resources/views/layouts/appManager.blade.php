<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Styles -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/style.css') }}" rel="stylesheet"> --}}
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <link href="../bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../remixicon/remixicon.css" rel="stylesheet">

    {{--  --}}

  <!-- Scripts -->
  {{-- <script src="{{ asset('js/bootstrap.min.js') }}"></script> --}}

  <!-- Fonts -->
  {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

  {{-- Home Page Form --}}
  {{--  --}}
  {{--  --}}
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  {{-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> --}}

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">

{{--  --}}
{{--  --}}
{{--  --}}

{{-- Login Form --}}
{{--  --}}
{{--  --}}
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	{{-- <link rel="icon" type="image/png" href="image/icpc.png"/> --}}
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/login_vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/login_vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/login_vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/login_vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/login_vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/login_vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../assets/css/login_util.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/login_main.css">
<!--===============================================================================================-->
{{--  --}}
{{--  --}}
{{--  --}}
</head>
<body style="position: relative;
            left: 50%;
            right: 50%;
            margin-left: -50vw;
            margin-right: -50vw;
            max-width: 100vw;
            width: 100vw;">

    <div id="app" style="">

        <!-- ======= Header ======= -->
        <header id="header" class="fixed-top ">
            <div class="container d-flex align-items-center justify-content-lg-between">

            <h1><a  class="logo me-auto me-lg-0" style="color: #fff;" href="/">KiotFleet<span style="color: #fcc752">.</span></a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto me-lg-0"><img src="../assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                <li><a class="nav-link scrollto" id="home" href="/home">Home</a></li>

                @auth
                    @if (Auth::user()->role == 'admin')
                        <li><a class="nav-link scrollto" id="users" href="/users">Users</a></li>
                        <li><a class="nav-link scrollto" id="vehicles" href="/vehicles">Vehicle</a></li>
                        <li><a class="nav-link scrollto" id="schedules" href="/schedules">Schedules</a></li>
                        <li><a class="nav-link scrollto" id="maintenance" href="/maintenance">Maintenance</a></li>
                        <li><a class="nav-link scrollto" id="requests" href="/exitRequest">Exit-Permissions</a></li>
                        <li class="dropdown"><a href="#"><span>Report</span> <i class="bi bi-chevron-down"></i></a>
                            <ul>
                              <li><a onclick="var report = document.getElementById('report_type'); report.innerHTML='User'; report.value='User';" href="#" data-bs-toggle="modal" data-bs-target="#generate_report">User</a></li>
                              <li><a onclick="var report = document.getElementById('report_type'); report.innerHTML='Vehicle'; report.value='Vehicle';" href="#" data-bs-toggle="modal" data-bs-target="#generate_report">Vehicle</a></li>
                              <li><a onclick="var report = document.getElementById('report_type'); report.innerHTML='Schedule'; report.value='Schedule';" href="#" data-bs-toggle="modal" data-bs-target="#generate_report">Schedule</a></li>
                              <li><a onclick="var report = document.getElementById('report_type'); report.innerHTML='Exit_Request'; report.value='Exit_Request';" href="#" data-bs-toggle="modal" data-bs-target="#generate_report">Exit Request</a></li>
                              <li><a onclick="var report = document.getElementById('report_type'); report.innerHTML='Maintenance'; report.value='Maintenance';" href="#" data-bs-toggle="modal" data-bs-target="#generate_report">Maintenance</a></li>
                            </ul>
                          </li>
                    @endif

                    @if (Auth::user()->role == 'Vehicle_Manager')
                        <li><a class="nav-link scrollto" id="vehicles" href="/vehicles">Vehicle</a></li>
                        <li><a class="nav-link scrollto" id="schedules" href="/schedules">Schedules</a></li>
                        <li class="d-flex"><a class="nav-link scrollto" id="maintenance" href="/maintenance">Maintenance</a>
                            <label class="notify bg-danger rounded-circle" id="notify_maintenance"></label></li>
                        <li class="d-flex"><a class="nav-link scrollto" id="requests" href="/exitRequest">Exit-Permissions</a>
                            <label class="notify bg-danger rounded-circle" id="notify_request"></label></li>
                    @endif

                    @if (Auth::user()->role == 'Maintenance')
                        <li class="d-flex"><a class="nav-link scrollto" id="maintenance" href="/maintenance">Maintenance</a></li>
                    @endif

                    @if (Auth::user()->role == 'Driver')
                        <li><a class="nav-link scrollto" id="schedule" href="/schedules">Schedules</a></li>
                        <li><a class="nav-link scrollto" id="maintenance" href="/maintenance">Maintenance</a></li>
                        <li><a class="nav-link scrollto" id="requests" href="/exitRequest">Exit-Permissions</a></li>
                    @endif

                    @if (Auth::user()->role == 'Staff')
                        <li><a class="nav-link scrollto" id="schedule" href="/schedules">Schedules</a></li>
                    @endif

                    @if (Auth::user()->role == 'Security')
                    <li><a class="nav-link scrollto" id="requests" href="/exitRequest">Exit-Permissions</a></li>
                        <li><a class="nav-link scrollto" id="schedule" href="/schedules">Schedules</a></li>
                        @endif
                @else
                    <li><a class="nav-link scrollto" href="#about">About</a></li>
                    <li><a class="nav-link scrollto" href="#services">Services</a></li>
                @endauth
                    @yield('aboutus')
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>

            </nav><!-- .navbar -->



            {{-- <a href="#about" class="get-started-btn scrollto">Get Started</a> --}}
            <ul class="d-flex justify-content-between">
                @guest
                    @if (Route::has('register') && App\Http\Controllers\userController::users() == 0)
                        <li>
                            <a class="get-started-btn1 scrollto" href="{{ route('register') }}">{{ __('Sign Up') }}</a>
                        </li>
                    @endif
                    @if (Route::has('login'))
                        <li>
                            <a class="get-started-btn scrollto" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                @else

                <li class="nav-item dropdown pe-3 d-flex" style="list-style: none;">
                    @if (Auth::user()->role == 'admin')
                    <label class="d-flex" style="margin-right: -13px; margin-top: 7px;">
                        <a class="nav-link scrollto bi bi-chat-dots-fill" style="font-size: 20px; color: #ffdca9;" title="Feedbacks"
                            id="feedbacks" href="/feedbacks"></a>
                        <label class="notify bg-danger rounded-circle" id="notify_feedback"
                                style="margin-left: -27px; margin-top: 0px;"></label></label>
                    @endif

                    <a class="nav-link nav-profile d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                        <img src="../../../image/profile/{{Auth::user()->profile_image}}" width="35" height="35" alt="" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle p-2" style="font-weight: 600;  color: #fff">{{Auth::user()->username}}</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu arrow profile" style="position: absolute; left: -50px">
                        <li class="pl-2" style=" text-align: center; height: 36px;  color: #; padding-left: 8px;">
                        <span style="height: 20px; font-weight: 600;  font-size: 16px;">{{Auth::user()->username}}</span><br>
                        @php
                            $role = '';
                            if (Auth::user()->role == 'Maintenance')
                                $role = 'Mechanic';
                            else
                                $role = Auth::user()->role;
                        @endphp
                        <span style="font-size: 14px">{{$role}}</span>
                        </li>
                        <li>
                        <hr class="dropdown-divider">
                        </li>

                        <li>

                            <a class="dropdown-item d-flex align-items-center" href="/profile">
                                <span class="bi bi-person"> My Profile</span>
                            </a>
                        </li>
                        <li>
                        <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="/password">
                                <span class="bi bi-key"> Change Password</span>
                            </a>
                        </li>
                        <li>
                        <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">

                                <span class="bi bi-box-arrow-right"> {{ __('Logout') }}</span>

                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="post" class="d-none">
                                @csrf
                            </form>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

                @endguest
                </ul>
            </div>
        </header>
        <!-- End Header -->

        <main id="body" class="py-4 d-flex justify-content-center" style="width: 100%;">
            @yield('content')
        </main>

        <!-- ======= Footer ======= -->
        <footer id="footer">
            <div class="footer-top">
            <div class="container">
                <div class="row">

                <div class="col-lg-4 col-md-6">
                    <div class="footer-info">
                    <h3>KiotFleet<span>.</span></h3>
                    <p>
                        In south wollo <br>
                        Ethiopia, Kombolcha<br><br>
                        <strong>Phone:</strong> +251 95497 8811<br>
                        <strong>Email:</strong> kiotfleet@gmail.com<br>
                    </p>
                    <div class="social-links mt-3">
                        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                        <a href="#" class="google-plus"><i class="bx bxl-telegram"></i></a>
                    </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                    <li><i class="bx bx-chair"></i> <a href="#">Seat Reservation</a></li>
                    <li><i class="bx bx-world"></i> <a href="#">custom pickup and dropoff</a></li>
                    <li><i class="ri ri-map-pin-2-fill"></i> <a href="#">Point to point service</a></li>
                    <li><i class="ri ri-bike-fill"></i> <a href="#">Take your Bike in travel</a></li>
                    <li><i class="ri ri-route-fill"></i> <a href="#">Suggest a route and travel</a></li>
                    </ul>
                </div>

                <div class="col-lg-5 col-md-6 footer-newsletter">
                    <h4>Feedbacks</h4>

                    <form action="/sendFeedback" method="POST" class="bg-white pl-2" style="margin-top: -8px; padding-top: 14px; border-radius: 4px;">
                        @csrf
                        <div class="d-flex justify-content-between">
                            <div class="form-group">
                                <input style="width: 95%;" type="text" name="username" id="username" class="form-control" placeholder="Your Name" required
                                @auth
                                    disabled value="{{Auth::user()->username}}"
                                @endauth>
                            </div>
                            <div class="form-group">
                                <input style="width: 95%; border: 1px solid #ddd;" type="email" class="form-control p-2" name="email" id="email" placeholder="Your Email" required
                                @auth
                                    value="{{Auth::user()->email}}"
                                @endauth>
                            </div>
                        </div>
                        <div class="form-group">
                        <textarea style="width: 98%; max-height: 300px;"
                                    @auth @if (Auth::user()->role == 'admin')
                                            disabled="true"
                                    @endif @endauth
                                    class="form-control" name="message" id="message" rows="5" placeholder="Message" required></textarea>
                        </div>
                        <div class="my-2"></div>
                        <div class="text-center p-2"><input
                        @auth @if (Auth::user()->role == 'admin')
                                disabled="true"
                            @endif @endauth type="submit" onclick="sendFeedback()" value="Send Feedback" style=" background-color: #fcc752; width: 12em; bottom: 2px; right: 2px; position: relative;">
                        </form>

                </div>

                </div>
            </div>
            </div>

            <div class="container" style="margin-top: -22px;">
            <div class="copyright">
                &copy; Copyright <strong><span>KiotFleet</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/gp-free-multipurpose-html-bootstrap-template/ -->
                Designed by <a href="">KIOT</a>
            </div>
            </div>
        </footer><!-- End Footer -->

        {{-- <div id="preloader"></div> --}}
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    </div>

    <div style="height: 100%; width: 100%; margin: auto; display: none;"
        class="modal fade" id="generate_report" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="min-width: 40%;">
            <div class="modal-content" style="overflow: auto; height: 60%;">
                <div class="modal-header d-flex" style="height: 40px;">

                    <div class="modal-title page_title" id="staticBackdropLabel">
                        Generate Report
                    </div>
                    <span style="margin-left: 10px; margin-top: 2px;"> </span>

                    <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <?php $i=1; ?>
                <div class="modal-body p-3" style=" height: 80%; margin-top: 25px;">
                    <div class="pl-5" style="width: 85%; margin: auto;">
                        <form action="/generateReport" method="post">
                            @csrf
                        <table class="pl-5" style="width: 100%; margin: auto;">

                            <tr style="width: 100%; margin: auto;">
                                <div>
                                    <td class="p-2" style="width: 30%;">
                                        <label >Report</label>
                                    </td>
                                    <td class="p-2">
                                        <select class="p-2" name ="report" id ="report" style="width: 250px; border: solid 1px #ddd; border-radius: 4px;">
                                            <option required class="form-control" id="report_type" type="text" selected value=""></option>
                                        </select>
                                    </td>
                                </div>
                            </tr>

                            <tr>
                                <div>
                                    <td class="p-2">
                                        <label >From</label>
                                    </td>
                                    <td class="p-2" >
                                        <input required class="form-control"  type="date" name ="from" id ="from" >
                                    </td>

                                </div>
                            </tr>

                            <tr>
                                <div>
                                    <td class="p-2">
                                        <label >To</label>
                                    </td>
                                    <td class="p-2" >
                                        <input required class="form-control"  type="date" name ="to" id ="to" >
                                    </td>

                                </div>
                            </tr>

                            <tr>
                                <td colspan="2" style="text-align: center;">
                                    <input type="submit" class="add-new p-2" value="Generate">
                                </td>
                            </tr>

                        </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/purecounter/purecounter.js"></script>
    <script src="../assets/vendor/aos/aos.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/login_main.js"></script>
</body>
</html>

{{-- <script>
  var x = setInterval(function() {
    @auth
    // Live Notifications for Admin
    @if (Auth::user()->role == 'admin')
      var xhttp0;
      xhttp0 = new XMLHttpRequest();
      xhttp0.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            uncheckedFeedback = JSON.parse(this.responseText);
            if (uncheckedFeedback.count > 9) {
                document.getElementById('notify_feedback').style.visibility = 'visible';
                document.getElementById('feedbacks').style.color = '#ffc451';
                document.getElementById('notify_feedback').innerHTML = '9+';
            }
            else if (uncheckedFeedback.count > 0) {
                document.getElementById('notify_feedback').style.visibility = 'visible';
                document.getElementById('feedbacks').style.color = '#ffc451';
                document.getElementById('notify_feedback').innerHTML = uncheckedFeedback.count;
            }
            else{
                document.getElementById('feedbacks').style.color = '#ffdca9';
              document.getElementById('notify_feedback').style.visibility = 'hidden';
            }
        }

      };
      var location_unF = "/countUncheckedFeedback";
      xhttp0.open("GET", location_unF, true);
      xhttp0.send();
    @endif

    // Live Notifications for Vehicle_Manager
    @if (Auth::user()->role == 'Vehicle_Manager')
      var xhttp3;
      xhttp3 = new XMLHttpRequest();
      xhttp3.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            pendingMaintenance = JSON.parse(this.responseText);
            if (pendingMaintenance.count > 9) {
                document.getElementById('notify_maintenance').style.visibility = 'visible';
                document.getElementById('notify_maintenance').innerHTML = '9+';
            }
            else if (pendingMaintenance.count > 0) {
                document.getElementById('notify_maintenance').style.visibility = 'visible';
                document.getElementById('notify_maintenance').innerHTML = pendingMaintenance.count;
            }
            else{
              document.getElementById('notify_maintenance').style.visibility = 'hidden';
            }
        }

      };
      var location_maintenance = "/countPendingMaintenance";
      xhttp3.open("GET", location_maintenance, true);
      xhttp3.send();
    @endif

    // Live Notifications for Vehicle_Manager
    @if (Auth::user()->role == 'Vehicle_Manager')
      var xhttp1;
      xhttp1 = new XMLHttpRequest();
      xhttp1.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            pendingRequest = JSON.parse(this.responseText);
            if (pendingRequest.count > 9) {
                document.getElementById('notify_request').style.visibility = 'visible';
                document.getElementById('notify_request').innerHTML = '9+';
            }
            else if (pendingRequest.count > 0) {
                document.getElementById('notify_request').style.visibility = 'visible';
                document.getElementById('notify_request').innerHTML = pendingRequest.count;
            }
            else{
            document.getElementById('notify_request').style.visibility = 'hidden';
            }
        }

      };
      var location1 = "/countPendingRequest";
      xhttp1.open("GET", location1, true);
      xhttp1.send();
    @endif

    @endauth

  }, 1000);

</script> --}}


