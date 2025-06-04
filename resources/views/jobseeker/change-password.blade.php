@extends('layouts.dashboard')

@section('content')

<!-- ======================= Page Title ===================== -->
<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2>Change Password</h2>
      <p><a href="{{url('/')}}" title="Home">Home</a> <i class="ti-angle-double-right"></i> Change Password</p>
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
            <img src="{{ asset('storage/' . Auth::guard('web')->user()->profile_picture) }}">

            <span class="user-photo-action">{{ Auth::guard('web')->user()->name }}</span>
          </div>
        </div>
        <div class="dashboard_nav_item">
          <ul>
            <li><a href="{{ route('jobseeker.dashboard') }}"><i class="login-icon ti-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ route('jobseeker.edit-profile') }}"><i class="login-icon ti-user"></i> Edit Profile</a></li>
            <li class="active"><a href="{{ route('jobseeker.change-password') }}"><i class="login-icon ti-key"></i> Change Password</a></li>
            <li>
              <form action="{{ route('jobseeker.logout') }}" method="POST" style="display: inline;">
              @csrf
                <button type="submit" style="background: none; border: none; padding: 10px 0; height: 50px; width: 100%; text-align: lest; color: inherit;">
                  <i class="login-icon ti-power-off"></i> Logout
                </button>
              </form>
            </li>
            <li>
              <form action="{{ route('jobseeker.delete-account') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete your account? This action is irreversible.');">
                @csrf
                @method('DELETE')
                <button type="submit"
                    style="background-color: #dc3545; border: none; padding: 10px 20px; height: 45px; width: 100%; text-align: right; font-size: 16px; color: white; border-radius: 4px; transition: background-color 0.3s;">
                <i class="login-icon ti-trash" style="float: left;"></i> Delete Account
                </button>
              </form>
				    </li>
          </ul>
        </div>
      </div>

      <div class="col-md-9">
        <form method="POST" action="{{ route('jobseeker.update-password') }}">
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