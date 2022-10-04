@extends('layouts\appManager')

@section('title') Report @endsection

@section('content')
<script>document.getElementById('users').style.color = "#ffc451";</script>

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

  <div class="row" style="width: 100%; max-width: 700px;; margin: auto;">
    <div class="col-xxl-12 col-md-12 container3 d-flex p-4 page-header">
      <label class="page_title" style="width: 100%; margin-bottom: 50px; text-align: center;"> WOLO UNIVERSITY KOMBOLCHA INSTITUTION OF TECHNOLOGY TRANSPORTATION</label>
    </div>
    
    <div class="col-xxl-12 col-md-12 container3 d-flex p-4 page-header" style="margin-top: 40px;">
        <label class="page_title" style="width: 100%; margin-bottom: 50px; text-align: center;  font-size: 17px;"><strong>{{$report}}</strong></label>
        <label class="page_title" style="width: 100%; margin-bottom: 50px; text-align: center;  font-size: 17px;">From : {{$from}}</label>
        <label class="page_title" style="width: 100%; margin-bottom: 50px; text-align: center;  font-size: 17px;">To : {{$to}}</label>
      </div>

    {{-- <div class="col-xxl-4 col-md-4 p-2 up_button" style="width: 200px;">
        @if (Auth::user()->role == "admin")
         <a href="/addUser"
            class="add-new p-2"> Print</a>
        @endif
    </div> --}}
  </div>
    <div style="color: white; height: 10px;">1</div>
    @if ($report == "User")
    <table class="table table-borderless datatable table-hover table-sm all-tables" style="width: 100%; max-width: 700px;; margin: auto;">
        <thead>
            <tr style="height: 35px; background-color: #f1f4f9;">
            <th style="width: 5%" scope="col">NO</th>
            <th style="width: 25%" scope="col">Username</th>

            <th class="hide" style="width: 15%" scope="col">Email</th>
            <th class="hide" style="width: 12%" scope="col">Phone</th>
            <th style="width: 5%"scope="col">Role</th>

            </tr>
        </thead>
        <tbody class="allData">

        <?php
            $no = 0;
        ?>
            
            @foreach ($users as $user)
            <?php
                $no++;
            ?>
            <tr>
                <th scope="row">{{++$no}}</th>
                <td><a href="/userProfile/{{$user->id}}" style="text-decoration: none;"><img src="../image/profile/{{$user->profile_image}}" width="35" height="35" class="rounded-circle" style="margin-right: 4px;"> {{ $user->username }}</a></td>
                <td class="hide">{{ $user->email }}</td>
                <td class="hide">{{ $user->phone_no }}</td>
                <td>{{ $user->role }}</td>
            </tr>
            @endforeach
            @if ($no == 0)
                <tr style="text-align: center;"><td class="not-found" colspan="7"><h6>No User Found</h6></td></tr>
            @endif

        </tbody>
        {{--  --}}
        {{--  --}}
        
        {{--  --}}
        {{--  --}}
    </table>
    @elseif($report == "Vehicle")
    <table class="table table-borderless datatable table-hover table-sm all-tables" style="width: 100%; max-width: 700px; margin: auto;">
        <thead>
          <tr style="height: 35px; background-color: #f1f4f9;">
            <th style="width: 5%" scope="col">NO</th>
            <th style="width: 15%" scope="col">Plate_No</th>
            <th style="width: 15%" scope="col">Type</th>
            <th class="hide" style="width: 12%" scope="col">Model</th>
            <th style="width: 5%"scope="col">Capacity</th>
            <th class="hide" style="width: 25%"scope="col">owner</th>
            <th class="hide"  style="width: 15%"scope="col">production_date</th>
  
          </tr>
        </thead>
        <tbody>
  
        <?php
          $no = 0;
        ?>
          @if ($Vcount == 0)
              <tr style="text-align: center;"><td class="not-found" colspan="9"><h6>No Vehicle Found</h6></td></tr>
          @endif
          @foreach ($vehicles as $vehicle)
            <tr>
              <th scope="row">{{ ++$no }}</th>
              <td>{{ $vehicle->type }}</td>
              <td class="hide">{{ $vehicle->model }}</td>
              <td>{{ $vehicle->capacity }}</td>
              <td class="hide">{{ $vehicle->owner }}</td>
              <td class="hide">{{ $vehicle->production_date }}</td>
  
              </tr>
          @endforeach
          </tbody>
      </table>
    @elseif($report == "Schedule")
    <table class="table table-borderless datatable table-hover table-sm all-tables" style="width: 100%; max-width: 700px; margin: auto;">
        <thead>
          <tr style="height: 35px; background-color: #f1f4f9;">
            <th style="width: 5%" scope="col">NO</th>
            <th style="width: 10%" scope="col">Date</th>
            <th style="width: 15%" scope="col">Car Type</th>
            <th style="width: 15%" scope="col">Driver</th>
            <th style="width: 10%" scope="col">Starting and Destination Fermata</th>
            <th class="hide" style="width: 20%"scope="col">Remark</th>
        
          </tr>
        </thead>
        <tbody>
  
        <?php
          $no = 0;
        ?>
          @if ($Scount == 0)
              <tr style="text-align: center;"><td class="not-found" colspan="9"><h6>No Schedule Found</h6></td></tr>
          @endif
          @foreach ($schedules as $schedule)
            <tr>
              <th scope="row">{{ ++$no }}</th>
              <td>{{ $schedule->date }}</td>
              <td>{{ $schedule->car_type }}</td>
              <td>{{ $schedule->driver }}</td>
              <td>{{ $schedule->fermata }}</td>
              <td class="hide">{{ $schedule->remark }}</td>
            </tr>
  
          @endforeach
          </tbody>
      </table>
    @elseif($report == "Exit_Request")
    <table class="table table-borderless datatable table-hover table-sm all-tables" style="width: 100%; max-width: 700px; margin: auto;">
        <thead>
          <tr style="height: 35px; background-color: #f1f4f9;">
            <th style="width: 5%" scope="col">NO</th>
            <th style="width: 10%"scope="col">Driver</th>
            <th style="width: 12%" scope="col">Requester</th>
            <th class="hide" style="width: 12%" scope="col">Cause</th>
            <th style="width: 11%"scope="col">Start_time</th>
            <th class="destination" style="width: 11%"scope="col">Destination_time</th>
            <style>
  
            </style>
            <th class="hide" style="width: 10%"scope="col">A will</th>
            <th style="width: 10%"scope="col">Status</th>
            
          </tr>
        </thead>
        <tbody>
  
        <?php
          $no = 0;
        ?>
          @if ($Rcount == 0)
              <tr style="text-align: center;"><td class="not-found" colspan="9"><h6>No request Found</h6></td></tr>
          @endif
          @foreach ($requests as $request)
  
            <tr>
              <th scope="row">{{ ++$no }}</th>
              <td>{{ $request->driver }}</td>
              <td class="hide">{{ $request->plate_no }}</td>
              <td>{{ $request->requester }}</td>
              <td class="hide">{{ $request->cause }}</td>
              <td>{{ $request->start_time }}</td>
              <td>{{ $request->arrival_time }}</td>
              <td class="hide">{{ $request->A_will }}</td>
  
              @if ($request->status == 'Accepted')
                  <td class="badge bg-success">{{$request->status}}</td>
              @elseif ($request->status == 'Rejected')
                  <td class="badge bg-danger">{{$request->status}}</td>
              @else
                  <td class="badge bg-warning" >{{$request->status}}</td>
              @endif
  
              
              </tr>
          @endforeach
          </tbody>
      </table>
    @elseif($report == "Maintenance")
    <table class="table table-borderless datatable table-hover table-sm all-tables" style="width: 100%; max-width: 700px; margin: auto;">
        <thead>
          <tr style="height: 35px; background-color: #f1f4f9;">
            <th style="width: 5%" scope="col">NO</th>
            <th class="hide" style="width: 10%" scope="col">Car_Type</th>
            <th style="width: 15%" scope="col">Plate_No</th>
            <th style="width: 12%" scope="col">Driver</th>
            <th style="width: 20%"scope="col">Causes</th>
            <th style="width: 10%"scope="col">status</th>
          </tr>
        </thead>
        <tbody>
  
        <?php
          $no = 0;
        ?>
          @if ($Mcount == 0)
              <tr style="text-align: center;"><td class="not-found" colspan="7"><h6>No Maintenance Found</h6></td></tr>
          @endif
          @foreach ($maintenances as $maintenance)
  
            <tr>
              <th scope="row">{{ ++$no }}</th>
              <td class="hide">{{ $maintenance->car_type }}</td>
              <td>{{ $maintenance->plate_no }}</td>
              <td>{{ $maintenance->requester }}</td>
              <td>{{ $maintenance->causes }}</td>
              @if ($maintenance->status == 'Accepted')
                  <td style="align-content: center" class="badge bg-success">{{$maintenance->status}}</td>
              @elseif ($maintenance->status == 'Rejected')
                  <td style="align-content: center" class="badge bg-danger">{{$maintenance->status}}</td>
              @elseif ($maintenance->status == 'Pending')
                  <td style="align-content: center" class="badge bg-warning" >{{$maintenance->status}}</td>
              @else
                  <td style="align-content: center" class="badge bg-gradient" >no status</td>
              @endif
              </tr>
          @endforeach
          </tbody>
      </table>
    @endif
</div>
<script>
    function search() {
        var input = document.getElementById("search").value;
        location.replace("/searchUser/"+input);
    }

    function myFunction() {
        if(!confirm("Are You Sure to delete this"))
        event.preventDefault();
    }
   </script>

@endsection

