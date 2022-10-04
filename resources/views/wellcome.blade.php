@extends('layouts.appManager')

@section('title') KiotFleet @endsection

@auth
    @if (Auth::user()->role != "admin")
        @section('aboutus')
            <li><a class="nav-link scrollto" href="#about">About</a></li>
            <li><a class="nav-link scrollto" href="#services">Services</a></li>
        @endsection
    @endif
@endauth

@section('message')

@endsection

@section('content')
<script>document.getElementById('home').style.color = "#ffc451";</script>

<div style="width: 100%; margin-top: -2%;">

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="align-items-center justify-content-center">
    <div style="width: 100%; margin: auto; position: absoulute">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                {{session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @include('notification')
        @elseif (session('danger'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-octagon me-1"></i>
                {{session('danger')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @include('notification')
        @else
            @include('notification')
        @endif
    </div>


    <div class="container" data-aos="fade-up">

      <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
        <div class="col-xl-6 col-lg-8">
          <h1>KiotFleet The Smart Choice for Travel<span>.</span></h1>
          <h2>Enjoy Comfortable Bus Travel in the KIOT</h2>
        </div>
      </div>

      <div class="row gy-4 mt-5 justify-content-center" data-aos="zoom-in" data-aos-delay="250">
        <div class="col-xl-2 col-md-4">
          <div class="icon-box">
            <i class="bx bx-chair"></i>
            <h3><a href="">Seat Reservation</a></h3>
          </div>
        </div>
        <div class="col-xl-2 col-md-4">
          <div class="icon-box">
            <i class="bx bxl-dribbble"></i>
            <h3><a href="">Custom pickup and drop-off</a></h3>
          </div>
        </div>
        <div class="col-xl-2 col-md-4">
          <div class="icon-box">
            <i class="ri ri-map-pin-2-fill"></i>
            <h3><a href="">Direct, point-to-point service</a></h3>
          </div>
        </div>
        <div class="col-xl-2 col-md-4">
          <div class="icon-box">
            <i class="ri ri-route-fill"></i>
            <h3><a href="">Suggest a route & travel free</a></h3>
          </div>
        </div>
        <div class="col-xl-2 col-md-4">
          <div class="icon-box">
            <i class="ri ri-bus-fill"></i>
            <h3><a href="">Services on Bus</a></h3>
          </div>
        </div>
      </div>

    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
            <img src="assets/img/maxresdefault_3.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade-right" data-aos-delay="100">
            <h3>KiotFleets' goal is to provide you a convenient and easy to use bus service.</h3>
            <p class="fst-italic">
              We always offer the best deals, plus a safe and pleasant travel experience.
            </p>
            <ul>
              <li><i class="ri-check-double-line"></i> just a few clicks away on our App or website.</li>
              <li><i class="ri-check-double-line"></i> Once on board, our partners' experienced drivers will get you safely from A to B while you kick back in comfortable seats and take advantage of onboard entertainment.</li>
              <li><i class="ri-check-double-line"></i> With many direct connections to popular destinations in Kombolcha, Desie or anyother you will never have to pause your movie to change buses!.</li>
            </ul>
            <p>
              Save with KiotFleet! Save time with direct bus connections and save the environment by traveling
              on one of the most environmentally friendly means of transport.
            </p>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Features Section ======= -->
    <section id="features" class="features">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="image col-lg-6" style='background-image: url("assets/img/cta-bg1.jpg");' data-aos="fade-right"></div>
          <div class="col-lg-6" data-aos="fade-left" data-aos-delay="100">
            <div class="icon-box mt-5 mt-lg-0" data-aos="zoom-in" data-aos-delay="150">
              <i class="bx bx-timer"></i>
              <h4>On-time, Every time</h4>
              <p>All measures are taken to ensure that the
                buses depart on-time every single time.</p>
            </div>
            <div class="icon-box mt-5" data-aos="zoom-in" data-aos-delay="150">
              <i class="bx bx-cube-alt"></i>
              <h4>Comfortable Journey</h4>
              <p>Enjoy OurBus on-board amenities
                for a relaxing ride</p>
            </div>
            <div class="icon-box mt-5" data-aos="zoom-in" data-aos-delay="150">
              <i class="bx bx-images"></i>
              <h4>User Friendly Cancellation Policy</h4>
              <p>Never pay penalties for rescheduling
                your city commute up to 2 hours and
                your intercity travel up to 24 hours
                prior to the journey.</p>
            </div>
            <div class="icon-box mt-5" data-aos="zoom-in" data-aos-delay="150">
              <i class="bx bx-shield"></i>
              <h4>Real-time Tracking and Notification</h4>
              <p>Track your ride and share schedules</p>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Features Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Services</h2>
          <p>Check our Services</p>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-chair"></i></div>
              <h4><a href="">Seat Reservations</a></h4>
              <p>We offer the option to find and reserve a seat before your bus trip</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bx bxl-dribbble"></i></div>
              <h4><a href="">Custom pickup and drop-off locations steps away</a></h4>
              <p>Using our buses you can picked and drop anywhere on the road from the start to end</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="ri ri-map-pin-2-fill"></i></div>
              <h4><a href="">Direct, point-to-point service</a></h4>
              <p>Special transportation system in which you can travels directly to a destination</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="ri ri-route-fill"></i></div>
              <h4><a href="">Suggest a route & travel free</a></h4>
              <p>Bus services are free to all community of the university</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="ri ri-bike-fill"></i></div>
              <h4><a href="">Bikes</a></h4>
              <p>You have the option to bring your bike on your trip with KiotFleet</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="ri ri-bus-fill"></i></div>
              <h4><a href="">Services on Bus</a></h4>
              <p>In order to make your journey as comfortable as possible, KiotFleet offers a wide range of different services on board for you</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Services Section -->
  </main><!-- End #main -->

</div>
@endsection

