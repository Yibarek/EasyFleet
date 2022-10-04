@extends('layouts\appManager')

@section('title') Add New Schedule @endsection

@section('content')
<script>document.getElementById('schedules').style.color = "#ffc451";</script>
    <form action="/addNewSchedule" method="POST" enctype="multipart/form-data">
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
            <label class="page_title" style="margin-top: -15px;">Add new Schedule</label>
          </div>
          <div class=" " style="width: 200px;">
              @if (Auth::user()->role == "Vehicle_Manager")
               <input href="" type="submit"
                  class="add-new p-2" value="Add Schedule">
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
                                <td class="p-2" style="width: 55%;" >
                                    <input class="form-control"  type="date" name ="s_date" id ="s_date" required>
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
                                        <option value="ቁጠባ" style="color: #333;">ቁጠባ</option>
                                        <option value="ሽሻበር" >ሽሻበር</option>
                                        <option value="ቶታል" >ቶታል</option>
                                        <option value="ደሴ" >ደሴ</option>
                                        <option value="በወንዝ" >በወንዝ</option>
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
                                            <option value="{{$vehicle->type}} {{$vehicle->plate_no}}" >{{$vehicle->type}} {{$vehicle->plate_no}}</option>
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
                                    <select required name="driver" id="driver" style=" color: #333; width: 100%; height: 40px; border: 1px solid #e1e1e1;">
                                        @foreach ($drivers as $driver)
                                            <option value="{{$driver->username}}" >{{$driver->username}}</option>
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
                                    <input class="form-control"  type="textarea" name ="remark" id ="remark">
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
                                        <label class="form-control" name ="lbl_m_1" id ="lbl_m_1" style="color: #fff; width: 50px; height: 35px; margin-bottom: -4px;"></label>
                                            <a class="form-control ml-5 ri ri-check-fill btn-sm" name ="btn_m_1" id ="btn_m_1"
                                                    style="width: 50px; font-weight: 800; font-size: 18px;"
                                                    onclick="morning1()"></a>
                                            <input class="form-control ml-2"  type="text" name ="txt_m_1" id ="txt_m_1" value="no" style="display: none;">
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
                                        <label class="form-control" name ="lbl_m_2" id ="lbl_m_2" style="color: #fff; width: 50px; height: 35px; margin-bottom: -4px;"></label>
                                            <a class="form-control ml-5 ri ri-check-fill btn-sm" name ="btn_m_2" id ="btn_m_2"
                                                    style="width: 50px; font-weight: 800; font-size: 18px;"
                                                    onclick="morning2()"></a>
                                            <input class="form-control ml-2"  type="text" name ="txt_m_2" id ="txt_m_2" value="no" style="display: none;">
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
                                        <label class="form-control" name ="lbl_m_3" id ="lbl_m_3" style="color: #fff; width: 50px; height: 35px; margin-bottom: -4px;"></label>
                                            <a class="form-control ml-5 ri ri-check-fill btn-sm" name ="btn_m_3" id ="btn_m_3"
                                                    style="width: 50px; font-weight: 800; font-size: 18px;"
                                                    onclick="morning3()"></a>
                                            <input class="form-control ml-2"  type="text" name ="txt_m_3" id ="txt_m_3" value="no" style="display: none;">
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
                                        <label class="form-control" name ="lbl_m_4" id ="lbl_m_4" style="color: #fff; width: 50px; height: 35px; margin-bottom: -4px;"></label>
                                            <a class="form-control ml-5 ri ri-check-fill btn-sm" name ="btn_m_4" id ="btn_m_4"
                                                    style="width: 50px; font-weight: 800; font-size: 18px;"
                                                    onclick="morning4()"></a>
                                            <input class="form-control ml-2"  type="text" name ="txt_m_4" id ="txt_m_4" value="no" style="display: none;">
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
                                        <label class="form-control" name ="lbl_d_1" id ="lbl_d_1" style="color: #fff; width: 50px; height: 35px; margin-bottom: -4px;"></label>
                                            <a class="form-control ml-5 ri ri-check-fill btn-sm" name ="btn_d_1" id ="btn_d_1"
                                                    style="width: 50px; font-weight: 800; font-size: 18px;"
                                                    onclick="day1()"></a>
                                            <input class="form-control ml-2"  type="text" name ="txt_d_1" id ="txt_d_1" value="no" style="display: none;">
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
                                        <label class="form-control" name ="lbl_d_2" id ="lbl_d_2" style="color: #fff; width: 50px; height: 35px; margin-bottom: -4px;"></label>
                                            <a class="form-control ml-5 ri ri-check-fill btn-sm" name ="btn_d_2" id ="btn_d_2"
                                                    style="width: 50px; font-weight: 800; font-size: 18px;"
                                                    onclick="day2()"></a>
                                            <input class="form-control ml-2"  type="text" name ="txt_d_2" id ="txt_d_2" value="no" style="display: none;">
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
                                        <label class="form-control" name ="lbl_n_1" id ="lbl_n_1" style="color: #fff; width: 50px; height: 35px; margin-bottom: -4px;"></label>
                                            <a class="form-control ml-5 ri ri-check-fill btn-sm" name ="btn_n_1" id ="btn_n_1"
                                                    style="width: 50px; font-weight: 800; font-size: 18px;"
                                                    onclick="night1()"></a>
                                            <input class="form-control ml-2"  type="text" name ="txt_n_1" id ="txt_n_1" value="no" style="display: none;">
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
                                        <label class="form-control" name ="lbl_n_2" id ="lbl_n_2" style="color: #fff; width: 50px; height: 35px; margin-bottom: -4px;"></label>
                                            <a class="form-control ml-5 ri ri-check-fill btn-sm" name ="btn_n_2" id ="btn_n_2"
                                                    style="width: 50px; font-weight: 800; font-size: 18px;"
                                                    onclick="night2()"></a>
                                            <input class="form-control ml-2"  type="text" name ="txt_n_2" id ="txt_n_2" value="no" style="display: none;">
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
                                        <label class="form-control" name ="lbl_n_3" id ="lbl_n_3" style="color: #fff; width: 50px; height: 35px; margin-bottom: -4px;"></label>
                                            <a class="form-control ml-5 ri ri-check-fill btn-sm" name ="btn_n_3" id ="btn_n_3"
                                                    style="width: 50px; font-weight: 800; font-size: 18px;"
                                                    onclick="night3()"></a>
                                            <input class="form-control ml-2"  type="text" name ="txt_n_3" id ="txt_n_3" value="no" style="display: none;">
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
                                        <label class="form-control" name ="lbl_n_4" id ="lbl_n_4" style="color: #fff; width: 50px; height: 35px; margin-bottom: -4px;"></label>
                                            <a class="form-control ml-5 ri ri-check-fill btn-sm" name ="btn_n_4" id ="btn_n_4"
                                                    style="width: 50px; font-weight: 800; font-size: 18px;"
                                                    onclick="night4()"></a>
                                            <input class="form-control ml-2"  type="text" name ="txt_n_4" id ="txt_n_4" value="no" style="display: none;">
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
                                        <label class="form-control" name ="lbl_n_5" id ="lbl_n_5" style="color: #fff; width: 50px; height: 35px; margin-bottom: -4px;"></label>
                                            <a class="form-control ml-5 ri ri-check-fill btn-sm" name ="btn_n_5" id ="btn_n_5"
                                                    style="width: 50px; font-weight: 800; font-size: 18px;"
                                                    onclick="night5()"></a>
                                            <input class="form-control ml-2"  type="text" name ="txt_n_5" id ="txt_n_5" value="no" style="display: none;">
                                    </div>
                                </td>

                            </div>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="div" style="margin-bottom: 50px; "></div>
        </div>
    </form>
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
