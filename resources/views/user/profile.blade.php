@extends('layouts\appManager')

@section('content')
<main id="main" class="main"  style="margin-left: 7%; width: 100%;">
    @php
        $role = '';
        if (Auth::user()->role == 'Maintenance')
            $role = 'Mechanic';
        else
            $role = Auth::user()->role;
    @endphp
    <div class="pagetitle">

    </div>{{-- End Page Title --}}
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
    <section class="section profile">

    @section('title') {{Auth::user()->username}} - profile @endsection
    <h4 style="margin-top: 50px; margin-bottom: -30px;">Profile</h4>
    <div class="row" style="margin-top: 40px;">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="../../image/profile/{{Auth::user()->profile_image}}" alt="Profile" class="rounded-circle"
              style="width: 70%; height: 70%;">
              <h3>{{Auth::user()->username}}</h3>
              <h5>{{$role}}</h5>
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-7">

          <div class="card">
            <div class="card-body pt-3">
              {{-- Bordered Tabs --}}

              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-6 label" style="font-weight: 600;">Full Name</div>
                    <div class="col-lg-9 col-md-8">{{Auth::user()->username}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-6 label" style="font-weight: 600;">Email</div>
                    <div class="col-lg-9 col-md-8">{{Auth::user()->email}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-6 label" style="font-weight: 600;">Phone</div>
                    <div class="col-lg-9 col-md-8">{{Auth::user()->phone_no}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-6 label" style="font-weight: 600;">Role</div>
                    <div class="col-lg-9 col-md-8">{{$role}}</div>
                  </div>

                  @if (Auth::user()->role == 'Driver')
                    <div class="row">
                        <?php
                            $date = new DateTime(Auth::user()->licence_expired);
                            $year = $date -> format('Y');
                            $month = $date -> format('m');
                            $day = $date -> format('d');
                        ?>
                        <div class="col-lg-3 col-md-6 label" style="font-weight: 600;">Licence_Expired</div>
                        <input type="date" class="col-lg-9 col-md-8" disabled value="{{$year.'-'.$month.'-'.$day}}">
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-6 label" style="font-weight: 600;">Licence</div>
                        <img class="col-lg-9 col-md-8" style="width: 200px; height: 150px;" src="../image/driver_licence/{{Auth::user()->licence}}" alt="">
                    </div>
                @endif
                </div>

                </div>
              {{-- End Bordered Tabs --}}

            </div>
          </div>

        </div>
      </div>

    </section>

  </main>{{-- End #main --}}
@endsection
