@extends('layouts\appManager')

@section('title') KiotFleet @endsection

@section('content')
<script>document.getElementById('home').style.color = "#ffc451";</script>

<div class="pages p-2">

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


  <div class="d-flex justify-content-between">
    <div class="container3 d-flex p-3 page-header">
      <div class="ri ri-dashboard-fill page-icon" style=""></div>
      <label class="page_title" style="margin-top: -5px;">Dashboard</label>
    </div>
    <div class=" " style="width: 200px;">
    </div>
  </div>
    <div style="color: white; height: 10px;">1</div>
    <div class="content" style="width: 80%; margin: auto;">
        <div class="row">
            <!-- User Card -->
            <div class="col-xxl-4 col-md-4 p-3">
                <div class="card info-card sales-card">

                  <div class="card-body">
                    <h5 class="card-title" style="text-align: center">Users</h5>

                    <div class="d-flex align-items-center" style="padding-left: 20%;">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; font-size: 24px; background-color:rgb(241, 162, 159)"
                      style="background-color: #abdba8; color: #0e7016;">
                        <i class="ri ri-user-fill"></i>
                      </div>
                      <div class="ps-3">
                        <h6><span class="text-success pt-1 fw-bold">{{$users}}</span></h6>
                      </div>
                    </div>
                  </div>

                </div>
              </div><!-- End User Card -->

              <!-- vehicles Card -->
              <div class="col-xxl-4 col-md-4 p-3">
                <div class="card info-card revenue-card">

                  <div class="card-body">
                    <h5 class="card-title" style="text-align: center">Vehicles</h5>

                    <div class="d-flex align-items-center" style="padding-left: 20%;">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"style="width: 50px; height: 50px; font-size: 24px; background-color:rgb(204, 174, 207)">
                        <div class="ri ri-bus-2-fill" width="35" height="35" style="color: #444;"></div>
                      </div>
                      <div class="ps-3">
                        <h6><span class="text-success pt-1 fw-bold">{{$vehicles}}</span></h6>
                      </div>
                    </div>
                  </div>

                </div>
              </div><!-- End vehicles Card -->

              <!-- Schedules Card -->
              <div class="col-xxl-4 col-md-4 p-3">
                <div class="card info-card sales-card">

                  <div class="card-body">
                    <h5 class="card-title" style="text-align: center">Schedules</h5>

                    <div class="d-flex align-items-center" style="padding-left: 20%;">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; font-size: 24px; background-color:rgb(144, 214, 247)"
                        style="background-color: #dfd5d0; color: rgb(204, 104, 10);">
                        <i class="ri ri-timer-fill"></i>
                      </div>
                      <div class="ps-3">
                        <h6><span class="text-success pt-1 fw-bold">{{$schedules}}</span></h6>
                      </div>
                    </div>
                  </div>

                </div>
              </div><!-- End Schedules Card -->

            <!-- Maintenance Card -->
            <div class="col-xxl-4 col-md-4 p-3">
                <div class="card info-card sales-card">

                  <div class="card-body">
                    <h5 class="card-title" style="text-align: center">Maintenance</h5>

                    <div class="d-flex align-items-center" style="padding-left: 20%;">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; font-size: 24px; background-color:rgb(243, 241, 117)"
                        style="background-color: #d4d3b3; color: #706108;">
                        <i class="page_icon ri ri-car-washing-fill"></i>
                      </div>
                      <div class="ps-3">
                        <h6><span class="text-success pt-1 fw-bold">{{$maintenances}}</span></h6>
                      </div>
                    </div>
                  </div>

                </div>
              </div><!-- End Maintenance Card -->

              <!-- Exit-Requests Card -->
              <div class="col-xxl-4 col-md-4 p-3">
                <div class="card info-card revenue-card">

                  <div class="card-body">
                    <h5 class="card-title" style="text-align: center">Exit-Requests</h5>

                    <div class="d-flex align-items-center" style="padding-left: 20%;">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; font-size: 24px; background-color:rgb(152, 241, 141)"
                        style="background-color: #d4b4b3; color: #701408;">
                        <i class="bi "><img src="../image/vehicle/exit_request.webp" alt="" width="25" height="29"></i>
                      </div>
                      <div class="ps-3">
                        <h6><span class="text-success pt-1 fw-bold">{{$requests}}</span></h6>
                      </div>
                    </div>
                  </div>

                </div>
              </div><!-- End Exit-Requests Card -->

            <!-- Drivers Card -->
            <div class="col-xxl-4 col-md-4 p-3">
                <div class="card info-card sales-card">

                  <div class="card-body">
                    <h5 class="card-title" style="text-align: center">Drivers</h5>

                    <div class="d-flex align-items-center" style="padding-left: 20%;">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; font-size: 24px; background-color:rgb(243, 193, 147)"
                        style="background-color: #b3c8d4; color: #094770;">
                        <i class="bi "><img src="../image/profile/driver.png" alt="" width="29" height="25"></i>
                      </div>
                      <div class="ps-3">
                        <h6><span class="text-success pt-1 fw-bold">{{$drivers}}</span></h6>
                      </div>
                    </div>
                  </div>

                </div>
              </div><!-- End drivers Card -->
        </div>
    </div>
</div>

@endsection
