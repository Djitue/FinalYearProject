@extends('layouts.dashboard')

@section('content')

<!-- ======================= Page Title ===================== -->
<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2>Change Password</h2>
      <p><a href="{url('/')}}" title="Home">Home</a> <i class="ti-angle-double-right"></i> Change Password</p>
    </div>
  </div>
</div>
<!-- ======================= End Page Title ===================== --> 

<!-- ================ Profile Settings ======================= -->
<section class="padd-top-80 padd-bot-80">
  <div class="container">
    <div class="row"> 
      <div class="col-md-3">
        <div id="leftcol_item">
          <div class="user_dashboard_pic"> 
            <img src="{{ asset('storage/' . $employer->profile_picture) }}" width="100" class="mb-2 mt-2 rounded"> 
            <span class="user-photo-action">{{ Auth::guard('employer')->user()->name }}</span>
          </div>
        </div>
        <div class="dashboard_nav_item">
          <ul>
            <li><a href="{{ route('employer.dashboard') }}"><i class="login-icon ti-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('employer.edit-profile') }}"><i class="login-icon ti-user"></i> Edit Profile</a></li>
            <li class="active"><a href="{{ route('employer.change-password') }}"><i class="login-icon ti-key"></i> Change Password</a></li>
            <li><a href="{{ route('employer.logout') }}"><i class="login-icon ti-power-off"></i> Logout</a></li>
          </ul>
        </div>
      </div>

      <div class="col-md-9">
        <form method="POST" action="{{ route('employer.update-password') }}">
          @csrf
          <div class="profile_detail_block">
            @if(session('success'))
              <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
              <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="form-group">
                <label>Current Password</label>
                <input type="password" name="current_password" class="form-control" placeholder="Enter current password" required>
              </div>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="form-group">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control" placeholder="Enter new password" required>
              </div>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="form-group">
                <label>Confirm New Password</label>
                <input type="password" name="new_password_confirmation" class="form-control" placeholder="Confirm new password" required>
              </div>
            </div>

            <div class="clearfix"></div>
            <div class="col-md-12 padd-top-10 text-center">
              <button type="submit" class="btn btn-m theme-btn full-width">Update Password</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<!-- ================ End Profile Settings ======================= --> 

@endsection