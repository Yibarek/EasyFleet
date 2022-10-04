@extends('layouts\appManager')

@section('content')
@foreach ($user as $u)
@php
    $role = '';
    if ($u->role == 'Maintenance')
        $role = 'Mechanic';
    else
        $role = $u->role;
@endphp

<main id="main" class="main"  style="margin-left: 7%;">

    <div class="pagetitle">
        @section('title') {{$u->username}} - profile @endsection
    </div>
    <section class="section profile">
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
    <h4 style="margin-top: 50px; margin-bottom: -30px;">User</h4>
    <div class="row" style="margin-top: 40px;">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="../../image/profile/{{$u->profile_image}}" alt="Profile" class="rounded-circle"
              style="width: 70%; height: 40%;">
              <h3>{{$u->username}}</h3>
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
                    <div class="col-lg-9 col-md-8">{{$u->username}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-6 label" style="font-weight: 600;">Email</div>
                    <div class="col-lg-9 col-md-8">{{$u->email}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-6 label" style="font-weight: 600;">Phone</div>
                    <div class="col-lg-9 col-md-8">{{$u->phone_no}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-6 label" style="font-weight: 600;">Role</div>
                    <div class="col-lg-9 col-md-8">{{$role}}</div>
                  </div>

                  @if ($u->role == 'Driver')
                    <div class="row">
                        <?php
                            $date = new DateTime($u->licence_expired);
                            $year = $date -> format('Y');
                            $month = $date -> format('m');
                            $day = $date -> format('d');
                        ?>
                        <div class="col-lg-3 col-md-6 label" style="font-weight: 600;">Licence_Expired</div>
                        <input type="date" class="col-lg-9 col-md-8" disabled value="{{$year.'-'.$month.'-'.$day}}">
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-6 label" style="font-weight: 600;">Licence</div>
                        <img class="col-lg-9 col-md-8" style="width: 200px; height: 150px;" src="../image/driver_licence/{{$u->licence}}" alt="">
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
@endforeach
@endsection
