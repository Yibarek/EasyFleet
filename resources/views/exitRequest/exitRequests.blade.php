@extends('layouts\appManager')

@section('title') Exit-Permissions @endsection

@section('content')
<script>document.getElementById('requests').style.color = "#ffc451";</script>

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
    <div class="col-xxl-4 col-md-5 container3 d-flex p-3 page-header">
      <div class="page-icon" style=""><img src="../image/vehicle/exit_request.webp" alt="" width="29" height="25"></div>
      <label class="page_title" style="margin-top: -5px;">Exit_Permissions</label>
    </div>
    <div class="col-xxl-4 col-md-4 p-1 search-box" style="max-width: 222px">
        <input class="ml-3" id="search" type="text" placeholder="Search.." name="search" value="{{$input}}">
        <button class="rounded-circle search-btn p-2" onclick="search()" title="Search" type="submit"><i class="fa fa-search"></i></button>
      </div>
    <div class="col-xxl-4 col-md-4 p-2 up_button" style="width: 260px;">
        @if (Auth::user()->role == "Driver")
         <a href="/requestExit"
            class="add-new p-2"> Request Exit</a>
        @endif
    </div>
  </div>
    <div style="color: rgb(255, 255, 255); height: 10px;">1</div>
  <table class="table table-borderless datatable table-hover table-sm all-tables">
      <thead>
        <tr style="height: 35px; background-color: #f1f4f9;">
          <th style="width: 5%" scope="col">NO</th>
          <th style="width: 10%"scope="col">Driver</th>
          <th class="hide" style="width: 8%" scope="col">Plate_no</th>
          <th style="width: 12%" scope="col">Requester</th>
          <th class="hide" style="width: 12%" scope="col">Cause</th>
          <th style="width: 11%"scope="col">Start_time</th>
          <th class="destination" style="width: 11%"scope="col">Destination_time</th>
          <style>

          </style>
          <th class="hide" style="width: 10%"scope="col">A will</th>
          <th style="width: 10%"scope="col">Status</th>
          @if (Auth::user()->role == "Driver" || Auth::user()->role == "Vehicle_Manager")
            <th style="width: 8%" scope="col">Action</th>
          @endif

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

            @if (Auth::user()->role == "Driver" || Auth::user()->role == "Vehicle_Manager")
            <td>
                @if (Auth::user()->role == "Driver")
                <a style="border:none; border-radius:4px; text-decoration: none; height: 25px; margin-right: 8px;"
                  @if($request->status != 'Accepted' && $request->status != 'Rejected')
                    href="/editRequest/{{$request->id}}"
                    title="Edit Request"
                  @endif
                  class="btn btn-success btn-sm pr-2 pl-2 ri ri-edit-2-fill"></a>

                  <a class="btn btn-danger btn-sm bi bi-trash-fill"
                      style="height: 25px;"
                      @if($request->status != 'Accepted' && $request->status != 'Rejected')
                        title="Delete Request"
                        href="deleteRequest/{{$request->id}}"
                     @endif
                     onclick="return myFunction();"></a>
                @elseif (Auth::user()->role == "Vehicle_Manager")
                  @if ($request->status == "Pending" || $request->status == "Rejected")
                      <a href="/acceptRequest/{{ $request->id }}"
                      style="text-decoration: none;"
                      class="btn-success btn-sm">Accept</a>
                  @endif
                  @if ($request->status == "Accepted")
                      <a href="/rejectRequest/{{ $request->id }}"
                      style="text-decoration: none;"
                      class="btn-danger btn-sm">Reject</a>
                  @endif
                @endif
            </td>
            @endif
            </tr>
        @endforeach
        <tfoot>
            <tr>

            </tr>
            <tr></tr>
                <td colspan="4">
                    {{ $requests->onEachSide(1)->links()}}
              </td>
            </tr>
        </tfoot>
        </tbody>
    </table>
</div>
@endsection
<script>
    function search() {
        var input = document.getElementById("search").value;
        location.replace("/searchRequest/"+input);
    }
  function myFunction() {
      if(!confirm("Are You Sure to delete this"))
      event.preventDefault();
  }
 </script>

