@extends('layouts\appManager')

@section('title') Feedbacks @endsection

@section('content')
<script>document.getElementById('feedbacks').style.color = "#ffc451";</script>

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
      <div class="bi bi-chat-dots-fill page-icon" style=""></div>
      <label class="page_title" style="margin-top: -5px;">Feedbacks</label>
    </div>
    <div class=" " style="width: 200px;">
        <div class="pt-1 search-box">
            <input class="ml-3" id="search" type="text" placeholder="Search.." name="search" value="{{$input}}">
            <button class="rounded-circle search-btn p-2" onclick="search()" title="Search" type="submit"><i class="fa fa-search"></i></button>
          </div>
    </div>
  </div>
    <div style="color: white; height: 10px;">1</div>
  <table class="table table-borderless table-hover table-sm "
            style="text-align: center;">
        @if ($Fcount == 0)
            <tr style="text-align: center;"><td class="not-found" ><h6>No Feedback Found</h6></td></tr>
        @endif

        @foreach ($feedbacks as $feedback)
            @if (Auth::user()->role == 'admin')
            <tr style="height: 35px; background-color: #f1f4f9;" class="message-box">
                <td rowspan="2" style="font-size: 19px; background-color: #fff">
                    <div style="text-align: center; padding-top: 10px; @if ($feedback->status == '')
                        font-weight: 700;"
                    @endif>
                        <a href="#" data-bs-toggle="modal"
                            style="font-size: 19px;"
                            data-bs-target="#viewFeedback{{$feedback->id}}"
                            onclick="changeStatus({{$feedback->id}});">{{$feedback->id}}</a>
                    </div>
                </td>
                <td style="min-width: 20px; width: 100%; background-color: #fff;" class="d-flex" scope="col">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#viewFeedback{{$feedback->id}}"
                        onclick="changeStatus({{$feedback->id}});"
                        style="font-size: 16px; color: #333;
                            @if ($feedback->status == '')
                                font-weight: 700;
                            @else
                                font-weight: 500;
                            @endif
                            width: fit-content;"><img class="rounded-circle" style="width: 35px; height: 35px; margin-right: 5px;" src="../image/profile/{{$feedback->profile}}" alt="">{{$feedback->username}}</a>
                    <label style="color: #787878; font-weight: 500; font-size: 13px; margin-top: 7px;" class="ml-3">{{$feedback->email}}</label>
                </td>
            </tr>

            <tr style="border-bottom: 2px solid #ccc; padding-left: 10px; text-align: left;"><td><label>{{ $feedback->message }}</label></td></tr>
            @endif

            <script>
                function changeStatus(feedback_id){
                    var xhttp_feedback;
                    xhttp_feedback = new XMLHttpRequest();
                    xhttp_feedback.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            feedback = JSON.parse(this.responseText);
                        }

                    };
                    var location_feedback = "/readFeedback/"+feedback_id;
                    xhttp_feedback.open("GET", location_feedback, true);
                    xhttp_feedback.send();
                }
            </script>
        @endforeach
        <tfoot>
            <tr>

            </tr>
            <tr></tr>
                <td colspan="4">
                    {{ $feedbacks->onEachSide(1)->links()}}
              </td>
            </tr>
        </tfoot>
        </tbody>
    </table>
</div>

{{-- feedback modal start--}}
@foreach ($feedbacks as $feedback)
<div style="height: 100%; width: 100%; margin: auto; display: none;"
    class="modal fade" id="viewFeedback{{$feedback->id}}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="min-width: 50%;">
        <div class="modal-content" style="overflow: auto; height: 50%;">
            <div class="modal-header d-flex" style="height: 40px;">
                <?php $team_logo = ''; ?>

                <div class="modal-title page_title" id="staticBackdropLabel">
                    <img class="rounded-circle " style="width: 35px; height: 35px; margin-right: 5px;" src="../image/profile/{{$feedback->profile}}" alt="">  {{$feedback->username}}
                </div>
                <span style="margin-left: 10px; margin-top: 2px;"> {{$feedback->email}}</span>

                <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <?php $i=1; ?>
            <div class="modal-body p-3" style=" height: 80%; margin-top: 15px;">
                <textarea id="" style="width: 100%; height: 94%;" disabled>{{$feedback->message}}</textarea>
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
        location.replace("/searchFeedback/"+input);
    }
  function myFunction() {
      if(!confirm("Are You Sure to delete this"))
      event.preventDefault();
  }
 </script>

