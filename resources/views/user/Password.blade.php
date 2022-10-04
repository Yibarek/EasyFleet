@extends('layouts\appManager')

@section('title') change Password @endsection

@section('content')
<form onsubmit="return validate()" action="/changePassword" id="change_password-form" method="POST">
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
            <div class="ri ri-lock-password-fill page-icon" style="margin-top: -15px;"></div>
            <label class="page_title" style="margin-top: -15px;">Change Password</label>
          </div>
          <div class=" " style="width: 200px;">

          </div>
        </div>
            <div style="border: 1px solid #eee;
                        border-radius: 5px;
                        margin-bottom: -10px;
                        padding-bottom: 10px;
                        box-shadow: 1px 5px 10px 1px rgba(180, 225, 180, 0.7);
                        padding-top: 20px;
                        padding-left: 20px;
                        width: 100%; margin: auto;">


                    <!-- Change Password Form -->
                        <div class="row mb-3">
                        <label for="currentPassword" class="col-md-8 col-lg-5 col-form-label">Current Password</label>
                        <div class="col-md-8 col-lg-6">
                            <input name="currentPassword" type="password" class="form-control" id="currentPassword" required="true">
                        </div>
                        </div>

                        <div class="row mb-3">
                        <label for="newPassword" class="col-md-8 col-lg-5 col-form-label">New Password</label>
                        <div class="col-md-8 col-lg-6">
                            <input name="newPassword" type="password" class="form-control" id="newPassword" required="true">
                        </div>
                        </div>

                        <div class="row mb-3">
                        <label for="renewPassword" class="col-md-8 col-lg-5 col-form-label">Re-enter New Password</label>
                        <div class="col-md-8 col-lg-6">
                            <input name="renewPassword" type="password" class="form-control" id="renewPassword" required="true">
                        </div>
                        </div>

                        <div class="text-center">
                        <input type="submit" class="add-new p-2" value="Change Password">
                        </div>
                    </form>
                    <!-- End Change Password Form -->
                </div>
            </div>
            </div>
            <div class="div" style="margin-bottom: 50px; "></div>
        </div>

@endsection

<script>
    function validate() {
        var p = document.getElementById('newPassword').value;
        var cp = document.getElementById('renewPassword').value;
        if(p == cp)
            return true;
        else
            alert("Password doesn't much, Please confirm with correct password.");
            return false;
    }

    function myFunction() {
        if(!confirm("Are You Sure to delete your Profile"))
        event.preventDefault();
    }
</script>

