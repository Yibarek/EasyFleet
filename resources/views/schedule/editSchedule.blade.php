@extends('layouts\appManager')

@section('title') Edit Schedule @endsection

@section('content')
<script>document.getElementById('schedules').style.color = "#ffc451";</script>
@foreach ($schedules as $schedule)
    <form action="/updateSchedule/{{$schedule->id}}" method="POST" enctype="">
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
            <div class="ri ri-time-fill page-icon" style="margin-top: -15px;"></div>
            <label class="page_title" style="margin-top: -15px;">edit Schedule</label>
          </div>
          <div class=" " style="width: 200px;">
              @if (Auth::user()->role == "Vehicle_Manager")
               <input href="" type="submit"
                  class="add-new p-2" value="Update Schedule">
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
                                <td class="p-2" style="width: 45%;">
                                    <label >Date</label>
                                </td>
                                <?php
                                    $date = new DateTime($schedule->date);
                                    $year = $date -> format('Y');
                                    $month = $date -> format('m');
                                    $day = $date -> format('d');
                                ?>
                                <td class="p-2" style="width: 55%;" >
                                    <input class="form-control" required type="date" name ="s_date" id ="s_date" value="{{$year.'-'.$month.'-'.$day}}">
                                </td>

                            </div>
                        </tr>
                        <tr>
                            <div>
                                <td class="p-2">
                                    <label >Fermata</label>
                                </td>
                                <td class="p-2" >
                                    <select name="fermata" id="fermata" style=" color: #333; width: 100%; height: 40px; border: 1px solid #e1e1e1;">
                                        <option value="ቁጠባ" @if ($schedule->fermata == 'ቁጠባ') selected @endif>ቁጠባ</option>
                                        <option value="ሽሻበር" @if ($schedule->fermata == 'ሽሻበር') selected @endif>ሽሻበር</option>
                                        <option value="ቶታል" @if ($schedule->fermata == 'ቶታል') selected @endif>ቶታል</option>
                                        <option value="ደሴ" @if ($schedule->fermata == 'ደሴ') selected @endif>ደሴ</option>
                                        <option value="በወንዝ" @if ($schedule->fermata == 'በወንዝ') selected @endif>በወንዝ</option>
                                    </select>
                                </td>

                            </div>
                        </tr>

                        <tr>
                            <div>
                                <td class="p-2">
                                    <label >car_Type</label>
                                </td>
                                <td class="p-2" >
                                    <select name="car_type" id="car_type" style=" color: #333; width: 100%; height: 40px; border: 1px solid #e1e1e1;">
                                        @foreach ($vehicles as $vehicle)
                                            <option value="{{$vehicle->type}} {{$vehicle->plate_no}}" @if ($schedule->car_type == "{{$vehicle->type}} {{$vehicle->plate_no}}") selected @endif>{{$vehicle->type}} {{$vehicle->plate_no}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div>
                                <td class="p-2">
                                    <label >Driver</label>
                                </td>
                                <td class="p-2" >
                                    <select name="driver" id="driver" style=" color: #333; width: 100%; height: 40px; border: 1px solid #e1e1e1;">
                                        @foreach ($drivers as $driver)
                                            <option value="{{$driver->username}}" @if ($schedule->driver == "{{$driver->username}}") selected @endif>{{$driver->username}}</option>
                                        @endforeach
                                    </select>
                                </td>

                            </div>
                        </tr>
                        <tr>
                            <div>
                                <td class="p-2">
                                    <label >Remark</label>
                                </td>
                                <td class="p-2" >
                                    <input class="form-control"  type="textarea" name ="remark" id ="remark" value="{{$schedule->remark}}">
                                </td>

                            </div>
                        </tr>
                        <tr>
                            <td colspan="2"><hr></td>
                        </tr>
                        <tr>
                            <div>
                                <td class="p-2" colspan="2" style="text_aline: center;">
                                    <label class="page_title">Morning(ጧት)</label>
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div>
                                <td class="p-2">
                                    <label >ጧት 11:45 መግቢያ</label>
                                </td>
                                <td class="p-2" style="width: 50%">
                                    <div class="d-flex">
                                        <label class="form-control @if($schedule->morning1 == "yes") bg bg-success @endif" name ="lbl_m_1" id ="lbl_m_1" style="color: #fff; width: 50px; height: 35px; margin-bottom: -4px;"></label>
                                            <a class="form-control ml-5 @if($schedule->morning1 == "yes") ri ri ri-close-fill @else ri-check-fill @endif btn-sm" name ="btn_m_1" id ="btn_m_1"
                                                    style="width: 50px; font-weight: 800; font-size: 18px;"
                                                    onclick="morning1()"></a>
                                            <input class="form-control ml-2"  type="text" name ="txt_m_1" id ="txt_m_1" value="{{$schedule->morning1}}" style="display: none;">
                                    </div>
                                </td>

                            </div>
                        </tr>
                        <tr>
                            <div>
                                <td class="p-2">
                                    <label >ጧት 11:45 መግቢያ</label>
                                </td>
                                <td class="p-2" style="width: 50%">
                                    <div class="d-flex">
                                        <label class="form-control @if($schedule->morning2 == "yes") bg bg-success @endif" name ="lbl_m_2" id ="lbl_m_2" style="color: #fff; width: 50px; height: 35px; margin-bottom: -4px;"></label>
                                            <a class="form-control ml-5 @if($schedule->morning2 == "yes") ri ri ri-close-fill @else ri-check-fill @endif btn-sm" name ="btn_m_2" id ="btn_m_2"
                                                    style="width: 50px; font-weight: 800; font-size: 18px;"
                                                    onclick="morning2()"></a>
                                            <input class="form-control ml-2"  type="text" name ="txt_m_2" id ="txt_m_2" value="{{$schedule->morning2}}" style="display: none;">
                                    </div>
                                </td>

                            </div>
                        </tr>
                        <tr>
                            <div>
                                <td class="p-2">
                                    <label >ጧት 1:15 መግቢያ</label>
                                </td>
                                <td class="p-2" style="width: 50%">
                                    <div class="d-flex">
                                        <label class="form-control @if($schedule->morning3 == "yes") bg bg-success @endif" name ="lbl_m_3" id ="lbl_m_3" style="color: #fff; width: 50px; height: 35px; margin-bottom: -4px;"></label>
                                            <a class="form-control ml-5 @if($schedule->morning3 == "yes") ri ri ri-close-fill @else ri-check-fill @endif btn-sm" name ="btn_m_3" id ="btn_m_3"
                                                    style="width: 50px; font-weight: 800; font-size: 18px;"
                                                    onclick="morning3()"></a>
                                            <input class="form-control ml-2"  type="text" name ="txt_m_3" id ="txt_m_3" value="{{$schedule->morning3}}" style="display: none;">
                                    </div>
                                </td>

                            </div>
                        </tr>
                        <tr>
                            <div>
                                <td class="p-2">
                                    <label >ጧት 2:15 ላይብራሪ መውጫ</label>
                                </td>
                                <td class="p-2" style="width: 50%">
                                    <div class="d-flex">
                                        <label class="form-control @if($schedule->morning4 == "yes") bg bg-success @endif" name ="lbl_m_4" id ="lbl_m_4" style="color: #fff; width: 50px; height: 35px; margin-bottom: -4px;"></label>
                                            <a class="form-control ml-5 @if($schedule->morning4 == "yes") ri ri ri-close-fill @else ri-check-fill @endif btn-sm" name ="btn_m_4" id ="btn_m_4"
                                                    style="width: 50px; font-weight: 800; font-size: 18px;"
                                                    onclick="morning4()"></a>
                                            <input class="form-control ml-2"  type="text" name ="txt_m_4" id ="txt_m_4" value="{{$schedule->morning4}}" style="display: none;">
                                    </div>
                                </td>

                            </div>
                        </tr>
                        {{-- ************************************************************************************* --}}
                        <tr>
                            <td colspan="2"><hr></td>
                        </tr>
                        <tr>
                            <div>
                                <td class="p-2" colspan="2" style="text_aline: center;">
                                    <label class="page_title mt-4">Day(ቀን)</label>
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div>
                                <td class="p-2">
                                    <label >ቀን 6:10 መግቢያ</label>
                                </td>
                                <td class="p-2" style="width: 50%">
                                    <div class="d-flex">
                                        <label class=" @if($schedule->day1 == "yes") bg bg-success @endif form-control" name ="lbl_d_1" id ="lbl_d_1" style="color: #fff; width: 50px; height: 35px; margin-bottom: -4px;"></label>
                                            <a class="form-control ml-5 @if($schedule->day1 == "yes") ri ri ri-close-fill @else ri-check-fill @endif btn-sm" name ="btn_d_1" id ="btn_d_1"
                                                    style="width: 50px; font-weight: 800; font-size: 18px;"
                                                    onclick="day1()"></a>
                                            <input class="form-control ml-2"  type="text" name ="txt_d_1" id ="txt_d_1" value="{{$schedule->day1}}" style="display: none;">
                                    </div>
                                </td>

                            </div>
                        </tr>
                        <tr>
                            <div>
                                <td class="p-2">
                                    <label >ቀን 7:25 መውጫ</label>
                                </td>
                                <td class="p-2" style="width: 50%">
                                    <div class="d-flex">
                                        <label class="form-control @if($schedule->day2 == "yes") bg bg-success @endif" name ="lbl_d_2" id ="lbl_d_2" style="color: #fff; width: 50px; height: 35px; margin-bottom: -4px;"></label>
                                            <a class="form-control ml-5 @if($schedule->day2 == "yes") ri ri ri-close-fill @else ri-check-fill @endif btn-sm" name ="btn_d_2" id ="btn_d_2"
                                                    style="width: 50px; font-weight: 800; font-size: 18px;"
                                                    onclick="day2()"></a>
                                            <input class="form-control ml-2"  type="text" name ="txt_d_2" id ="txt_d_2" value="{{$schedule->day2}}" style="display: none;">
                                    </div>
                                </td>

                            </div>
                        </tr>
                        <tr>
                            <td colspan="2"><hr></td>
                        </tr>
                        <tr>
                            <div>
                                <td class="p-2" colspan="2" style="text_aline: center;">
                                    <label class="page_title">Night(ማታ)</label>
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div>
                                <td class="p-2">
                                    <label >ማታ 11:30 መውጫ</label>
                                </td>
                                <td class="p-2" style="width: 50%">
                                    <div class="d-flex">
                                        <label class="form-control @if($schedule->night1 == "yes") bg bg-success @endif" name ="lbl_n_1" id ="lbl_n_1" style="color: #fff; width: 50px; height: 35px; margin-bottom: -4px;"></label>
                                            <a class="form-control ml-5 @if($schedule->night1 == "yes") ri ri ri-close-fill @else ri-check-fill @endif btn-sm" name ="btn_n_1" id ="btn_n_1"
                                                    style="width: 50px; font-weight: 800; font-size: 18px;"
                                                    onclick="night1()"></a>
                                            <input class="form-control ml-2"  type="text" name ="txt_n_1" id ="txt_n_1" value="{{$schedule->night1}}" style="display: none;">
                                    </div>
                                </td>

                            </div>
                        </tr>
                        <tr>
                            <div>
                                <td class="p-2">
                                    <label >ማታ 11:45 ላይብራሪ መግቢያ</label>
                                </td>
                                <td class="p-2" style="width: 50%">
                                    <div class="d-flex">
                                        <label class="form-control @if($schedule->night2 == "yes") bg bg-success @endif" name ="lbl_n_2" id ="lbl_n_2" style="color: #fff; width: 50px; height: 35px; margin-bottom: -4px;"></label>
                                            <a class="form-control ml-5 @if($schedule->night2 == "yes") ri ri ri-close-fill @else ri-check-fill @endif btn-sm" name ="btn_n_2" id ="btn_n_2"
                                                    style="width: 50px; font-weight: 800; font-size: 18px;"
                                                    onclick="night2()"></a>
                                            <input class="form-control ml-2"  type="text" name ="txt_n_2" id ="txt_n_2" value="{{$schedule->night2}}" style="display: none;">
                                    </div>
                                </td>

                            </div>
                        </tr>
                        <tr>
                            <div>
                                <td class="p-2">
                                    <label >ማታ 12:20 ላይብራሪ መውጫ</label>
                                </td>
                                <td class="p-2" style="width: 50%">
                                    <div class="d-flex">
                                        <label class="form-control @if($schedule->night3 == "yes") bg bg-success @endif" name ="lbl_n_3" id ="lbl_n_3" style="color: #fff; width: 50px; height: 35px; margin-bottom: -4px;"></label>
                                            <a class="form-control ml-5 @if($schedule->night3 == "yes") ri ri ri-close-fill @else ri-check-fill @endif btn-sm" name ="btn_n_3" id ="btn_n_3"
                                                    style="width: 50px; font-weight: 800; font-size: 18px;"
                                                    onclick="night3()"></a>
                                            <input class="form-control ml-2"  type="text" name ="txt_n_3" id ="txt_n_3" value="{{$schedule->night3}}" style="display: none;">
                                    </div>
                                </td>

                            </div>
                        </tr>
                        <tr>
                            <div>
                                <td class="p-2">
                                    <label >ማታ 1:30 መግቢያ</label>
                                </td>
                                <td class="p-2" style="width: 50%">
                                    <div class="d-flex">
                                        <label class="form-control @if($schedule->night4 == "yes") bg bg-success @endif" name ="lbl_n_4" id ="lbl_n_4" style="color: #fff; width: 50px; height: 35px; margin-bottom: -4px;"></label>
                                            <a class="form-control ml-5 @if($schedule->night4 == "yes") ri ri ri-close-fill @else ri-check-fill @endif btn-sm" name ="btn_n_4" id ="btn_n_4"
                                                    style="width: 50px; font-weight: 800; font-size: 18px;"
                                                    onclick="night4()"></a>
                                            <input class="form-control ml-2"  type="text" name ="txt_n_4" id ="txt_n_4" value="{{$schedule->night4}}" style="display: none;">
                                    </div>
                                </td>

                            </div>
                        </tr>
                        <tr>
                            <div>
                                <td class="p-2">
                                    <label >ጧት 2:00 መውጫ</label>
                                </td>
                                <td class="p-2" style="width: 50%">
                                    <div class="d-flex">
                                        <label class="form-control @if($schedule->night5 == "yes") bg bg-success @endif" name ="lbl_n_5" id ="lbl_n_5" style="color: #fff; width: 50px; height: 35px; margin-bottom: -4px;"></label>
                                            <a class="form-control ml-5 @if($schedule->night5 == "yes") ri ri ri-close-fill @else ri-check-fill @endif btn-sm" name ="btn_n_5" id ="btn_n_5"
                                                    style="width: 50px; font-weight: 800; font-size: 18px;"
                                                    onclick="night5()"></a>
                                            <input class="form-control ml-2"  type="text" name ="txt_n_5" id ="txt_n_5" value="{{$schedule->night4}}" style="display: none;">
                                    </div>
                                </td>

                            </div>
                        </tr>
                    </table>
                    {{-- <script>
                        morning1();
                        morning2();
                        morning3();
                        morning4();
                        // *****************
                        day1();
                        day2();
                        // *****************
                        night1();
                        night2();
                        night3();
                        night4();
                        night5();

                    </script> --}}
                </div>
            </div>
            <div class="div" style="margin-bottom: 50px; "></div>
        </div>
    </form>
@endforeach
@endsection

<script>
function morning1(){
    if (document.getElementById('txt_m_1').value == "no") {
        document.getElementById('txt_m_1').value = "yes";
        document.getElementById('btn_m_1').classList.remove("ri-check-fill");
        document.getElementById('btn_m_1').classList.add("ri-close-fill");
        document.getElementById('lbl_m_1').classList.add("bg-success");
    } else {
        document.getElementById('txt_m_1').value = "no";
        document.getElementById('btn_m_1').classList.remove("ri-close-fill");
        document.getElementById('btn_m_1').classList.add("ri-check-fill");
        document.getElementById('lbl_m_1').classList.remove("bg-success");
    }
}
function morning2(){
    if (document.getElementById('txt_m_2').value == "no") {
        document.getElementById('txt_m_2').value = "yes";
        document.getElementById('btn_m_2').classList.remove("ri-check-fill");
        document.getElementById('btn_m_2').classList.add("ri-close-fill");
        document.getElementById('lbl_m_2').classList.add("bg-success");
    } else {
        document.getElementById('txt_m_2').value = "no";
        document.getElementById('btn_m_2').classList.remove("ri-close-fill");
        document.getElementById('btn_m_2').classList.add("ri-check-fill");
        document.getElementById('lbl_m_2').classList.remove("bg-success");
    }
}
function morning3(){
    if (document.getElementById('txt_m_3').value == "no") {
        document.getElementById('txt_m_3').value = "yes";
        document.getElementById('btn_m_3').classList.remove("ri-check-fill");
        document.getElementById('btn_m_3').classList.add("ri-close-fill");
        document.getElementById('lbl_m_3').classList.add("bg-success");
    } else {
        document.getElementById('txt_m_3').value = "no";
        document.getElementById('btn_m_3').classList.remove("ri-close-fill");
        document.getElementById('btn_m_3').classList.add("ri-check-fill");
        document.getElementById('lbl_m_3').classList.remove("bg-success");
    }
}
function morning4(){
    if (document.getElementById('txt_m_4').value == "no") {
        document.getElementById('txt_m_4').value = "yes";
        document.getElementById('btn_m_4').classList.remove("ri-check-fill");
        document.getElementById('btn_m_4').classList.add("ri-close-fill");
        document.getElementById('lbl_m_4').classList.add("bg-success");
    } else {
        document.getElementById('txt_m_4').value = "no";
        document.getElementById('btn_m_4').classList.remove("ri-close-fill");
        document.getElementById('btn_m_4').classList.add("ri-check-fill");
        document.getElementById('lbl_m_4').classList.remove("bg-success");
    }
}
/*********************************************************************
    Day
*********************************************************************/
function day1(){
    if (document.getElementById('txt_d_1').value == "no") {
        document.getElementById('txt_d_1').value = "yes";
        document.getElementById('btn_d_1').classList.remove("ri-check-fill");
        document.getElementById('btn_d_1').classList.add("ri-close-fill");
        document.getElementById('lbl_d_1').classList.add("bg-success");
    } else {
        document.getElementById('txt_d_1').value = "no";
        document.getElementById('btn_d_1').classList.remove("ri-close-fill");
        document.getElementById('btn_d_1').classList.add("ri-check-fill");
        document.getElementById('lbl_d_1').classList.remove("bg-success");
    }
}
function day2(){
    if (document.getElementById('txt_d_2').value == "no") {
        document.getElementById('txt_d_2').value = "yes";
        document.getElementById('btn_d_2').classList.remove("ri-check-fill");
        document.getElementById('btn_d_2').classList.add("ri-close-fill");
        document.getElementById('lbl_d_2').classList.add("bg-success");
    } else {
        document.getElementById('txt_d_2').value = "no";
        document.getElementById('btn_d_2').classList.remove("ri-close-fill");
        document.getElementById('btn_d_2').classList.add("ri-check-fill");
        document.getElementById('lbl_d_2').classList.remove("bg-success");
    }
}
/*********************************************************************
    Night
*********************************************************************/
function night1(){
    if (document.getElementById('txt_n_1').value == "no") {
        document.getElementById('txt_n_1').value = "yes";
        document.getElementById('btn_n_1').classList.remove("ri-check-fill");
        document.getElementById('btn_n_1').classList.add("ri-close-fill");
        document.getElementById('lbl_n_1').classList.add("bg-success");
    } else {
        document.getElementById('txt_n_1').value = "no";
        document.getElementById('btn_n_1').classList.remove("ri-close-fill");
        document.getElementById('btn_n_1').classList.add("ri-check-fill");
        document.getElementById('lbl_n_1').classList.remove("bg-success");
    }
}
function night2(){
    if (document.getElementById('txt_n_2').value == "no") {
        document.getElementById('txt_n_2').value = "yes";
        document.getElementById('btn_n_2').classList.remove("ri-check-fill");
        document.getElementById('btn_n_2').classList.add("ri-close-fill");
        document.getElementById('lbl_n_2').classList.add("bg-success");
    } else {
        document.getElementById('txt_n_2').value = "no";
        document.getElementById('btn_n_2').classList.remove("ri-close-fill");
        document.getElementById('btn_n_2').classList.add("ri-check-fill");
        document.getElementById('lbl_n_2').classList.remove("bg-success");
    }
}
function night3(){
    if (document.getElementById('txt_n_3').value == "no") {
        document.getElementById('txt_n_3').value = "yes";
        document.getElementById('btn_n_3').classList.remove("ri-check-fill");
        document.getElementById('btn_n_3').classList.add("ri-close-fill");
        document.getElementById('lbl_n_3').classList.add("bg-success");
    } else {
        document.getElementById('txt_n_3').value = "no";
        document.getElementById('btn_n_3').classList.remove("ri-close-fill");
        document.getElementById('btn_n_3').classList.add("ri-check-fill");
        document.getElementById('lbl_n_3').classList.remove("bg-success");
    }
}
function night4(){
    if (document.getElementById('txt_n_4').value == "no") {
        document.getElementById('txt_n_4').value = "yes";
        document.getElementById('btn_n_4').classList.remove("ri-check-fill");
        document.getElementById('btn_n_4').classList.add("ri-close-fill");
        document.getElementById('lbl_n_4').classList.add("bg-success");
    } else {
        document.getElementById('txt_n_4').value = "no";
        document.getElementById('btn_n_4').classList.remove("ri-close-fill");
        document.getElementById('btn_n_4').classList.add("ri-check-fill");
        document.getElementById('lbl_n_4').classList.remove("bg-success");
    }
}
function night5(){
    if (document.getElementById('txt_n_5').value == "no") {
        document.getElementById('txt_n_5').value = "yes";
        document.getElementById('btn_n_5').classList.remove("ri-check-fill");
        document.getElementById('btn_n_5').classList.add("ri-close-fill");
        document.getElementById('lbl_n_5').classList.add("bg-success");
    } else {
        document.getElementById('txt_n_5').value = "no";
        document.getElementById('btn_n_5').classList.remove("ri-close-fill");
        document.getElementById('btn_n_5').classList.add("ri-check-fill");
        document.getElementById('lbl_n_5').classList.remove("bg-success");
    }
}
</script>
