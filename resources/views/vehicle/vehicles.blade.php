@extends('layouts\appManager')

@section('title') Vehicles @endsection

@section('content')
<script>document.getElementById('vehicles').style.color = "#ffc451";</script>
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
        <div class="ri ri-bus-2-fill page-icon" style=""></div>
        <label class="page_title" style="margin-top: -5px;">Vehicles</label>
      </div>
      <div class="col-xxl-4 col-md-4 p-1 search-box" style="max-width: 222px">
        <input class="ml-3" id="search" type="text" placeholder="Search.." name="search" value="{{$input}}">
        <button class="rounded-circle search-btn p-2" onclick="search()" title="Search" type="submit"><i class="fa fa-search"></i></button>
      </div>
      <div class="col-xxl-5 col-md-5 p-2 up_button" style="width: 520px;">
          @if (Auth::user()->role == "Vehicle_Manager")
           <a href="/addVehicle"
              class="add-new p-2"> Add new Vehicle</a>

           <a href="#" data-bs-toggle="modal" data-bs-target="#fuelconsumption"
            class="add-new p-2"> Fuel Consumption</a>
          @endif
      </div>
    </div>
    <div style="color: white; height: 10px;">1</div>
  <table class="table table-borderless datatable table-hover table-sm all-tables">
      <thead>
        <tr style="height: 35px; background-color: #f1f4f9;">
          <th style="width: 5%" scope="col">NO</th>
          <th style="width: 10%" scope="col">Image</th>

          <th style="width: 10%" scope="col">Plate_No</th>
          <th style="width: 10%" scope="col">Type</th>
          <th class="hide" style="width: 10%" scope="col">Model</th>
          <th style="width: 5%"scope="col">Capacity</th>
          <th class="hide" style="width: 15%"scope="col">owner</th>
          <th class="hide" style="width: 10%"scope="col">engine_power</th>
          <th class="hide"  style="width: 10%"scope="col">production_date</th>
          @if (Auth::user()->role == "Vehicle_Manager")
            <th style="width: 9%" scope="col">Action</th>
          @endif

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
            <td><a href="/v/{{$vehicle->id}}">
                <img src="../../image/vehicle/{{$vehicle->image}}" width="70" height="70" class="p-2" style="margin-right: 4px;"></a></td>
            <td>{{ $vehicle->plate_no }}</td>
            <td>{{ $vehicle->type }}</td>
            <td class="hide">{{ $vehicle->model }}</td>
            <td>{{ $vehicle->capacity }}</td>
            <td class="hide">{{ $vehicle->owner }}</td>
            <td class="hide">{{ $vehicle->engine_power }}</td>
            <td class="hide">{{ $vehicle->production_date }}</td>

              @if (Auth::user()->role == "Vehicle_Manager")
              <td>
              <a href="/editVehicle/{{$vehicle->id}}" title="Edit Vehicle"
                style="border:none; border-radius:4px; text-decoration: none; height: 25px; margin-right: 8px;"
                class="btn btn-success btn-sm pr-2 pl-2 ri ri-edit-2-fill"></a>

                <a href="deleteVehicle/{{$vehicle->id}}" title="Delete Vehicle"
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
                    {{ $vehicles->onEachSide(1)->links()}}
              </td>
            </tr>
        </tfoot>
        </tbody>
    </table>
  </div>
</div>
{{--  --}}
<div style="height: 100%; width: 100%; margin: auto; display: none;"
    class="modal fade" id="fuelconsumption" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="min-width: 75%;">
        <div class="modal-content" style="overflow: auto; height: 75%;">
            <div class="modal-header d-flex" style="height: 40px;">
                <?php $team_logo = ''; ?>

                <div class="modal-title page_title" id="staticBackdropLabel">
                    Calculate Fuel consumption
                </div>
                <span style="margin-left: 10px; margin-top: 2px;"> </span>

                <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <?php $i=1; ?>
            <div class="modal-body p-3" style=" height: 80%; margin-top: 25px;">
                <div class="pl-5" style="width: 100%; margin: auto;">
                    <table class="pl-5" style="width: 90%; margin: auto;">

                        <tr style="width: 90%; margin: auto;">
                                <td class="p-2" style="width: 15%;">
                                    <label >Fuel Consumption</label>
                                </td>
                                <td class="p-2" style="width: 35%;" >
                                    <input required class="form-control"  type="number" name ="fc" id ="fc" placeholder="litters per Kilometer">
                                </td>

                                <td class="p-2" style="width: 15%;" style="margin-right: -50px;">
                                    <label >Travel</label>
                                </td>
                                <td class="p-2" style="width: 35%;" >
                                    <input required class="form-control"  type="number" name ="kilometer" id ="kilometer" placeholder="kilometer">
                                </td>
                        </tr>

                        <tr style="width: 90%; margin: auto;">
                            <td class="p-2" style="width: 15%;">
                                <label >Cost per Litter</label>
                            </td>
                            <td class="p-2" style="width: 35%;" >
                                <input required class="form-control"  type="number" name ="cost" id ="cost" placeholder="$">
                            </td>

                            <td class="p-2" style="width: 15%;" style="margin-right: -50px;">
                                <label ></label>
                            </td>
                            <td class="p-2" style="width: 35%;" >
                            </td>
                    </tr>

                        <tr>
                            <td colspan="2" style="text-align: right; margin-left: 50%">
                                <input style="margin-right: 30px; margin-top: 50px;" type="submit" style="border: rgb(27, 134, 167);" onclick="calculate()" value="Calculate" class="add-new p-2">
                            </td>
                            <td colspan="2" style="width: 20%; text-align: left; margin-left: 50%">
                                <input style="width: 300px; margin-top: 50px;" disabled class="form-control"  type="text" name ="litter" id ="litter" placeholder="litter">
                                <input style="width: 300px; margin-top: 50px;" disabled class="form-control"  type="text" name ="totalCost" id ="totalCost" placeholder="totalcost">
                            </td>
                            <td colspan="2">
                            </td>
                            <td colspan="2">
                            </td>
                       </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
{{--  --}}
@endsection
<script>
    function calculate() {
        var fc = document.getElementById('fc');
        var kilometer = document.getElementById('kilometer');
        var cost = document.getElementById('cost');
        var litter = document.getElementById('litter');
        var totalCost = document.getElementById('totalCost');
        if (fc.value != '' && kilometer.value != '') {
            var result = (parseFloat(fc.value) * parseFloat(kilometer.value));

            litter.value = result;
            litter.value += " litters";

            var totalC = (parseFloat(cost.value) * parseFloat(litter.value));
            totalCost.value = totalC;
            totalCost.value += " birr";
        }
        else{
            alert('please fill all inputs!')
        }
    }

  function search() {
      var input = document.getElementById("search").value;
      location.replace("/searchVehicle/"+input);
  }

  function myFunction() {
      if(!confirm("Are You Sure to delete this"))
      event.preventDefault();
  }
 </script>

