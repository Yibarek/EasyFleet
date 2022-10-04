@extends('layouts\appManager')

@section('title') Users @endsection

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

  <div class="row">
    <div class="col-xxl-4 col-md-4 container3 d-flex p-4 page-header">
      <div class="ri ri-user-fill page-icon" style=""></div>
      <label class="page_title" style="margin-top: -5px;">Users</label>
    </div>
    <div class="col-xxl-4 col-md-4 p-1 search-box" style="max-width: 222px">
        <input class="ml-3" id="search" type="text" placeholder="Search.." name="search" value="{{$input}}">
        <button class="rounded-circle search-btn p-2" onclick="search()" title="Search" type="submit"><i class="fa fa-search"></i></button>
    </div>
    <div class="col-xxl-4 col-md-4 p-2 up_button" style="width: 200px;">
        @if (Auth::user()->role == "admin")
         <a href="/addUser"
            class="add-new p-2"> Add new User</a>
        @endif
    </div>
  </div>
    <div style="color: white; height: 10px;">1</div>
  <table class="table table-borderless datatable table-hover table-sm all-tables">
      <thead>
        <tr style="height: 35px; background-color: #f1f4f9;">
          <th style="width: 5%" scope="col">NO</th>
          <th style="width: 25%" scope="col">Username</th>

          <th class="hide" style="width: 15%" scope="col">Email</th>
          <th class="hide" style="width: 12%" scope="col">Phone</th>
          <th style="width: 5%"scope="col">Role</th>
          @if (Auth::user()->role == "admin" || Auth::user()->role == "admin")
            <th style="width: 8%" scope="col">Action</th>
          @endif

        </tr>
      </thead>
      <tbody class="allData">

      <?php
        $no = 0;
      ?>
        @if ($Ucount == 0)
            <tr style="text-align: center;"><td class="not-found" colspan="7"><h6>No User Found</h6></td></tr>
        @endif
        @foreach ($users as $user)

        @if (Auth::user()->role == 'admin')
          <tr>
            <th scope="row">{{++$no}}</th>
            <td><a href="/userProfile/{{$user->id}}" style="text-decoration: none;"><img src="../image/profile/{{$user->profile_image}}" width="35" height="35" class="rounded-circle" style="margin-right: 4px;"> {{ $user->username }}</a></td>
            <td class="hide">{{ $user->email }}</td>
            <td class="hide">+251 {{ $user->phone_no }}</td>
            <td>{{ $user->role }}</td>
            <td>
              @if (Auth::user()->role == "admin" && $user->role != 'admin')
              <a href="/editUser/{{$user->id}}" title="Edit User"
                style="border:none; border-radius:4px; text-decoration: none; height: 25px; margin-right: 8px;"
                class="btn btn-success btn-sm pr-2 pl-2 ri ri-edit-2-fill"></a>

                <a href="deleteUser/{{$user->id}}" title="Delete User"
                    class="btn btn-danger btn-sm bi bi-trash-fill"
                    style="height: 25px;"
                    onclick="return myFunction();"></a>
              @endif

              </td>
            </tr>
        @endif
        @endforeach
    </tbody>
    <tbody class="searchData"></tbody>
        <tfoot>
            <tr>

            </tr>
            <tr></tr>
                <td colspan="4">
                    {{ $users->onEachSide(1)->links()}}
              </td>
            </tr>
        </tfoot>
    </table>
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

