@extends('layouts\appManager')

@section('title') Schedules @endsection

@section('content')
<script>document.getElementById('schedules').style.color = "#ffc451";</script>
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


  <div class="row">
    <div class="col-xxl-4 col-md-4 container3 d-flex p-3 page-header">
        <div class="ri ri-timer-line page-icon" style=""></div>
        <label class="page_title" style="margin-top: -5px;">Schedules</label>
      </div>
      <div class="col-xxl-4 col-md-4 p-1 search-box" style="max-width: 222px">
        <input class="ml-3" id="search" type="text" placeholder="Search.." name="search" value="{{$input}}">
        <button class="rounded-circle search-btn p-2" onclick="search()" title="Search" type="submit"><i class="mb-4 fa fa-search"></i></button>
      </div>
      <div class="col-xxl-4 col-md-4 up_button" style="width: 230px;">
          @if (Auth::user()->role == "Vehicle_Manager")
           <a href="/addSchedule"
              class="add-new p-2"> Add Schedule</a>
          @endif
      </div>
    </div>
    <div style="color: white; height: 10px;">1</div>
  <table class="table table-borderless datatable table-hover table-sm all-tables">
      <thead>
        <tr style="height: 35px; background-color: #f1f4f9;">
          <th style="width: 5%" scope="col">NO</th>
          <th style="width: 10%" scope="col">Date</th>
          <th style="width: 15%" scope="col">Car Type</th>
          <th style="width: 15%" scope="col">Driver</th>
          <th style="width: 10%" scope="col">Starting and Destination Fermata</th>
          <th class="hide" style="width: 20%"scope="col">Remark</th>
          <th style="width: 12%; text-align: center;"scope="col"><div style="text-align: center; width: 100%; height: 100%;"><label class="zmdi zmdi-eye mt-4"></label></div></th>
          @if (Auth::user()->role == "Vehicle_Manager")
            <th style="width: 8%" scope="col">Action</th>
          @endif

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
            <td scope="col"><div style="text-align: center;"><a href="#" data-bs-toggle="modal" data-bs-target="#viewSchedule{{$schedule->id}}">view-Schedule</a></div></td>


              @if (Auth::user()->role == "Vehicle_Manager")
              <td >
                <a href="/editSchedule/{{$schedule->id}}" title="Edit Schedcule"
                    style="border:none; border-radius:4px; text-decoration: none; height: 25px; margin-right: 8px;"
                    class="btn btn-success btn-sm pr-2 pl-2 ri ri-edit-2-fill"></a>

                    <a href="deleteSchedule/{{$schedule->id}}" title="Delete Schedule"
                        class="btn btn-danger btn-sm bi bi-trash-fill"
                        style="height: 25px;"
                        onclick="return myFunction();"></a>
                </td>
              @endif


            </tr>

        @endforeach
        <tfoot>
            <tr>

            </tr>
            <tr></tr>
                <td colspan="4">
                    {{ $schedules->onEachSide(1)->links()}}
              </td>
            </tr>
        </tfoot>
        </tbody>
    </table>
  </div>
</div>

{{-- shedule modal start--}}
@foreach ($schedules as $schedule)
<div style="height: 100%; width: 100%; margin: auto; display: none;"
    class="modal fade" id="viewSchedule{{$schedule->id}}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="min-width: 88%;">
        <div class="modal-content" style="overflow: auto; height: 50%;">
            <div class="modal-header d-flex" style="height: 40px;">
                <?php $team_logo = ''; ?>

                <div class="modal-title page_title" id="staticBackdropLabel">
                    {{$schedule->car_type}} --- {{$schedule->date}} --- {{$schedule->fermata}}
                </div>
                <span style="margin-left: 10px; margin-top: 2px;"> </span>

                <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <?php $i=1; ?>
            <div class="modal-body p-3" style=" height: 80%; margin-top: 25px;">
                <table class="table-bordered" style="text-align: center; width: 95%; margin: auto;">
                  <tr>
                    <td colspan="4" class="schedule-header"><label>Morning(ጧት)</label></td>
                    <td colspan="2" class="schedule-header"><label>Day(ቀን)</label></td>
                    <td colspan="5" class="schedule-header"><label>Night(ማታ)</label></td>
                  </tr>
                  <tr>
                    <th class="schedule-tiitle p-2"><label>ጧት 11:45 መግቢያ</label></th>
                    <th class="schedule-tiitle p-2"><label>ጧት 11:45 መግቢያ</label></th>
                    <th class="schedule-tiitle p-2"><label>ጧት 1:15 መግቢያ</label></th>
                    <th class="schedule-tiitle p-2"><label>ጧት 2:15 ላይብራሪ መውጫ</label></th>
                    <th class="schedule-tiitle p-2"><label>ቀን 6:10 መግቢያ</label></th>
                    <th class="schedule-tiitle p-2"><label>ቀን 7:20 መውጫ</label></th>
                    <th class="schedule-tiitle p-2"><label>ማታ 11:30 መውጫ</label></th>
                    <th class="schedule-tiitle p-2"><label>ማታ 11:45 ላይብራሪ መግቢያ</label></th>
                    <th class="schedule-tiitle p-2"><label>ማታ 12:20 ላይብራሪ መውጫ</label></th>
                    <th class="schedule-tiitle p-2"><label>ማታ 1:30 መግቢያ</label></th>
                    <th class="schedule-tiitle p-2"><label>ጧት 2:00 መውጫ</label></th>
                  </tr>
                  <tr>
                    <td class="schedule-mark">
                        <label @if ($schedule->morning1 == "yes")
                             class="ri ri-check-fill p-3"
                        @endif></label>
                    </td>
                    <td class="schedule-mark">
                        <label @if ($schedule->morning2 == "yes")
                             class="ri ri-check-fill p-3"
                        @endif></label>
                    </td>
                    <td class="schedule-mark">
                        <label @if ($schedule->morning3 == "yes")
                             class="ri ri-check-fill p-3"
                        @endif></label>
                    </td>
                    <td class="schedule-mark">
                        <label @if ($schedule->morning4 == "yes")
                             class="ri ri-check-fill p-3"
                        @endif></label>
                    </td>
                    <td class="schedule-mark">
                        <label @if ($schedule->day1 == "yes")
                             class="ri ri-check-fill p-3"
                        @endif></label>
                    </td>
                    <td class="schedule-mark">
                        <label @if ($schedule->day2 == "yes")
                             class="ri ri-check-fill p-3"
                        @endif></label>
                    </td>
                    <td class="schedule-mark">
                        <label @if ($schedule->night1 == "yes")
                             class="ri ri-check-fill p-3"
                        @endif></label>
                    </td>
                    <td class="schedule-mark">
                        <label @if ($schedule->night2 == "yes")
                             class="ri ri-check-fill p-3"
                        @endif></label>
                    </td>
                    <td class="schedule-mark">
                        <label @if ($schedule->night3 == "yes")
                             class="ri ri-check-fill p-3"
                        @endif></label>
                    </td>
                    <td class="schedule-mark">
                        <label @if ($schedule->night4 == "yes")
                             class="ri ri-check-fill p-3"
                        @endif></label>
                    </td>
                    <td class="schedule-mark">
                        <label @if ($schedule->night5 == "yes")
                             class="ri ri-check-fill p-3"
                        @endif></label>
                    </td>
                  </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endforeach
{{-- modal end--}}
@endsection
<script>
    function search() {
        var input = document.getElementById("search").value;
        location.replace("/searchSchedule/"+input);
    }
  function myFunction() {
      if(!confirm("Are You Sure to delete this"))
      event.preventDefault();
  }
 </script>

