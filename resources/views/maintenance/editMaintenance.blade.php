@extends('layouts\appManager')

@section('title') Update Maintenance @endsection

@section('content')
<script>document.getElementById('maintenance').style.color = "#ffc451";</script>
@foreach ($maintenance as $m)
    <form action="/updateMaintenance/{{$m->id}}" method="POST">
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
            <div class="ri ri-car-washing-fill page-icon" style="margin-top: -15px;"></div>
            <label class="page_title" style="margin-top: -15px;">Update Maintenance</label>
          </div>
          <div class=" " style="width: 200px;">
              @if (Auth::user()->role == "Driver")
               <input href="" type="submit"
                  class="add-new p-2" value="Send Request">
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
                                    <label >Car Type</label>
                                </td>
                                <td class="p-2" style="width: 65%;" >
                                    <input class="form-control"  type="text" name ="car_type" id ="car_type" value="{{$m->car_type}}">
                                </td>

                            </div>
                        </tr>
                        <tr>
                            <div>
                                <td class="p-2">
                                    <label >Plate_No</label>
                                </td>
                                <td class="p-2" >
                                    <input class="form-control"  type="text" name ="plate_no" id ="plate_no" value="{{$m->plate_no}}">
                                </td>

                            </div>
                        </tr>
                        <tr>
                            <div>
                                <td class="p-2">
                                    <label >Causes</label>
                                </td>
                                <td class="p-2" >
                                    <input class="form-control"  type="textarea" name ="cause" id ="cause" value="{{$m->causes}}">
                                </td>

                            </div>
                        </tr>

                        <tr>
                            <div>
                                <td class="p-2">
                                    <label>Organization</label>
                                </td>
                                <td class="p-2">
                                    <input disabled type="text" name ="organization" id ="organization" value="Kombolcha Institute of Technology">
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
