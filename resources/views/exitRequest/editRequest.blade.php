@extends('layouts\appManager')

@section('title') Update Request @endsection

@section('content')
<script>document.getElementById('requests').style.color = "#ffc451";</script>
@foreach ($requests as $request)
    <form action="/updateRequest/{{$request->id}}" method="POST">
      @csrf
      <div class="pages p-2" style="width: 120%">
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

        <div class="d-flex justify-content-between"style="width: 100%">
          <div class="container3 d-flex p-3 page-header">
            <div class="page-icon" style="margin-top: -15px;"><img src="../image/vehicle/exit_request.webp" alt="" width="29" height="25"></div>
            <label class="page_title" style="margin-top: -15px;">Update Request</label>
          </div>
          <div class=" " style="width: 200px;">
              @if (Auth::user()->role == "Driver")
               <input href="" type="submit"
                  class="add-new p-2" value="Update exitRequest">
              @endif
          </div>
        </div>
            <div style="border: 1px solid #eee;
                        border-radius: 5px;
                        margin-bottom: -10px;
                        padding-bottom: 10px;
                        box-shadow: 1px 5px 10px 1px rgba(180, 225, 180, 0.7);
                        padding-top: 20px;
                        width: 100%; margin: auto;">

                <div class="pl-5" style="width: 95%; margin: auto;">
                    <table class="pl-5" style="width: 100%; margin: auto;">
                        <tr style="width: 100%; margin: auto;">
                            <div>
                                <td class="p-2" style="width: 35%;">
                                    <label >Plate_No</label>
                                </td>
                                <td class="p-2" style="width: 65%;" >
                                    <input class="form-control"  type="text" name ="plate_no" id ="plate_no" value="{{$request->plate_no}}">
                                </td>

                            </div>
                        </tr>
                        <tr>
                            <div>
                                <td class="p-2">
                                    <label >Requester</label>
                                </td>
                                <td class="p-2" >
                                    <input class="form-control"  type="text" name ="requester" id ="requester" value="{{$request->requester}}">
                                </td>

                            </div>
                        </tr>
                        <tr>
                            <div>
                                <td class="p-2">
                                    <label >Causes</label>
                                </td>
                                <td class="p-2" >
                                    <input class="form-control"  type="textarea" name ="cause" id ="cause" value="{{$request->cause}}">
                                </td>

                            </div>
                        </tr>

                        <tr>
                            <div>
                                <td class="p-2">
                                    <label>Start_Date and Time</label>
                                </td>
                                <td class="p-2">
                                    <div class="d-flex justify-content-bettween">
                                        <?php
                                            $date = new DateTime($request->start_time);
                                            $year = $date -> format('Y');
                                            $month = $date -> format('m');
                                            $day = $date -> format('d');
                                        ?>
                                        <input class="mr-2 form-control" type="date" name ="start_date" id ="start_date" value="{{$year.'-'.$month.'-'.$day}}">
                                        <?php
                                            $date = new DateTime($request->start_time);
                                            $hour = $date -> format('h');
                                            $minute = $date -> format('i');
                                        ?>
                                        <input class="ml-2 form-control" type="time" name ="start_time" id ="start_time" value="{{$hour.':'.$minute}}">
                                    </div>
                                </td>

                            </div>
                        </tr>

                        <tr>
                            <div>
                                <td class="p-2">
                                    <label>Destination_Date and Time</label>
                                </td>
                                <td class="p-2">
                                    <div class="d-flex justify-content-bettween">
                                        <?php
                                            $date = new DateTime($request->arrival_time);
                                            $year = $date -> format('Y');
                                            $month = $date -> format('m');
                                            $day = $date -> format('d');
                                        ?>
                                        <input class="mr-2 form-control" type="date" name ="arrival_date" id ="arrival_date" value="{{$year.'-'.$month.'-'.$day}}">
                                        <?php
                                            $date = new DateTime($request->arrival_time);
                                            $hour = $date -> format('h');
                                            $minute = $date -> format('i');
                                        ?>
                                        <input class="ml-2 form-control" type="time" name ="arrival_time" id ="arrival_time" value="{{$hour.':'.$minute}}">
                                    </div>
                                </td>

                            </div>
                        </tr>
                        <tr>
                            <div>
                                <td class="p-2">
                                    <label>Driver</label>
                                </td>
                                <td class="p-2">
                                    <input disabled type="text" name ="driver" id ="driver" value="{{Auth::user()->username}}">
                                </td>

                            </div>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="div" style="margin-bottom: 50px; "></div>
        </div>

    </form>
@endforeach
@endsection
