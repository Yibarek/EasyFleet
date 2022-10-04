@extends('layouts\appManager')

@section('title') Maintenances @endsection

@section('content')
<script>document.getElementById('maintenance').style.color = "#ffc451";</script>

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
      <div class="ri ri-car-washing-fill page-icon" style=""></div>
      <label class="page_title" style="margin-top: -5px;">Maintenance</label>
    </div>
    <div class="col-xxl-4 col-md-4 p-1 search-box" style="max-width: 222px">
        <input class="ml-3" id="search" type="text" placeholder="Search.." name="search" value="{{$input}}">
        <button class="rounded-circle search-btn p-2" onclick="search()" title="Search" type="submit"><i class="fa fa-search"></i></button>
      </div>
    <div class="col-xxl-4 col-md-4 p-2 up_button" style="width: 260px;">
        @if (Auth::user()->role == "Driver")
         <a href="/requestMaintenance"
            class="add-new p-2"> Request Maintenance</a>
        @endif
    </div>
  </div>
    <div style="color: white; height: 10px;">1</div>
  <table class="table table-borderless datatable table-hover table-sm all-tables">
      <thead>
        <tr style="height: 35px; background-color: #f1f4f9;">
          <th style="width: 5%" scope="col">NO</th>
          <th class="hide" style="width: 10%" scope="col">Car_Type</th>

          <th style="width: 15%" scope="col">Plate_No</th>
          <th style="width: 12%" scope="col">Driver</th>
          <th style="width: 20%"scope="col">Causes</th>
          <th class="hide" style="100px; width: 15%"scope="col">Organization</th>
          <th style="width: 10%"scope="col">status</th>
          @if (Auth::user()->role == "Driver" || Auth::user()->role == "Vehicle_Manager")
            <th style="min-width: 70px; width: 10%" scope="col">Action</th>
          @endif

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
            <td class="hide">{{ $maintenance->organization }}</td>
            @if ($maintenance->status == 'Accepted')
                <td style="align-content: center" class="badge bg-success">{{$maintenance->status}}</td>
            @elseif ($maintenance->status == 'Rejected')
                <td style="align-content: center" class="badge bg-danger">{{$maintenance->status}}</td>
            @elseif ($maintenance->status == 'Pending')
                <td style="align-content: center" class="badge bg-warning" >{{$maintenance->status}}</td>
            @else
                <td style="align-content: center" class="badge bg-gradient" >no status</td>
            @endif
            {{-- <td>
              @if ($maintenance->status == '')

                @if (Auth::user()->role == "Maintenance")
                    <a href="/checkMaintenance/{{$maintenance->id}}" title="Check Maintenance"
                        style="border:none; border-radius:4px; text-decoration: none; height: 25px; margin-right: 8px;"
                        class="btn btn-success btn-sm pr-2 pl-2 badge badge-primary">check</a>
                @endif
                @if (Auth::user()->role == "Driver")
                    <a href="deleteMaintenance/{{$maintenance->id}}" title="Delete Maintenance"
                        class="btn btn-danger btn-sm bi bi-trash-fill"
                        style="height: 25px;"
                        onclick="return myFunction();"></a>
                @endif
              @else
                <label href="/checkMaintenance/{{$maintenance->id}}"
                    style="border:none; border-radius:4px; text-decoration: none; height: 25px; margin-right: 8px;"
                    class="badge badge-success">checked</label>
              @endif
              </td> --}}
            @if (Auth::user()->role == "Driver" || Auth::user()->role == "Vehicle_Manager")
            <td>
                @if (Auth::user()->role == "Driver")
                <a style="border:none; border-radius:4px; text-decoration: none; height: 25px; margin-right: 8px;"
                  @if($maintenance->status != 'Accepted' && $maintenance->status != 'Rejected')
                    href="/editMaintenance/{{$maintenance->id}}"
                    title="Edit Maintenance"
                  @endif
                  class="btn btn-success btn-sm pr-2 pl-2 ri ri-edit-2-fill"></a>

                  <a class="btn btn-danger btn-sm bi bi-trash-fill"
                      style="height: 25px;"
                      @if($maintenance->status != 'Accepted' && $maintenance->status != 'Rejected')
                        title="Delete Maintenance"
                        href="deleteMaintenance/{{$maintenance->id}}"
                     @endif
                     onclick="return myFunction();"></a>
                @elseif (Auth::user()->role == "Vehicle_Manager")
                  @if ($maintenance->status == "Pending" || $maintenance->status == "Rejected")
                      <a href="/acceptMaintenance/{{ $maintenance->id }}"
                      style="text-decoration: none;"
                      class="btn-success btn-sm">Accept</a>
                  @endif
                  @if ($maintenance->status == "Accepted")
                      <a href="/rejectMaintenance/{{ $maintenance->id }}"
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
                    {{ $maintenances->onEachSide(1)->links()}}
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
        location.replace("/searchMaintenance/"+input);
    }
    function myFunction() {
        if(!confirm("Are You Sure to delete this"))
        event.preventDefault();
    }
 </script>

