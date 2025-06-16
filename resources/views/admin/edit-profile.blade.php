@extends('layouts.dashboard')

@section('content')

<!-- ======================= Page Title ===================== -->
<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2>Profile Settings</h2>
      <p><a href="{{url('/')}}" title="Home">Home</a> <i class="ti-angle-double-right"></i> Profile Settings</p>
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
				@if ($admin->profile_picture)
				<img alt="user photo" src="{{ Storage::url($admin->profile_picture) }}"> 
				@else
				<img alt="user photo" src="{{ asset('assets/img/user-profile.png') }}">
				@endif
				<span class="user-photo-action">{{ Auth::guard('admin')->user()->name }}</span>
			</div>
		</div>
		<div class="dashboard_nav_item">
		  <ul>
		    <li><a href="{{route('admin.dashboard')}}"><i class="login-icon ti-dashboard"></i> Dashboard</a></li>
			<li class="active"><a href="{{route('admin.update-profile')}}"><i class="login-icon ti-user"></i> Edit Profile</a></li>
			<li><a href="{{route('admin.update-password')}}"><i class="login-icon ti-key"></i> Change Password</a></li>
			<li>
				<form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
				@csrf
					<button type="submit" style="background: none; border: none; padding: 10px 0; height: 50px; width: 100%; text-align: lest; color: inherit;">
						<i class="login-icon ti-power-off"></i> Logout
					</button>
				</form>
			</li>
			<li>
				<form action="{{ route('admin.delete-account') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete your account? This action is irreversible.');">
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
	  	<form method="POST" action="{{ route('admin.update-profile') }}" enctype="multipart/form-data">
        	@csrf
			<div class="profile_detail_block">
				<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label>Name</label>
					<input type="text" class="form-control" name="name" value="{{ old('name', $admin->name) }}" placeholder="Your Name">
				</div>
				</div>

				<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label>Email</label>
					<input type="text" class="form-control" name="email" value="{{ old('email', $admin->email) }}" placeholder="mail@example.com">
				</div>
				</div>

				{{-- <div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label>Password</label>
					<input type="text" class="form-control" placeholder="***********">
				</div>
				</div> --}}

				<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label>Phone</label>
					<input type="text" class="form-control" name="phone" value="{{ old('phone', $admin->phone) }}" placeholder="123 214 13247">
				</div>
				</div>

				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label>Address</label>
						<input type="text" class="form-control"  name="address" value="{{ old('address', $admin->address) }}" placeholder="Address">
					</div>
				</div>

				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<label>Education Level</label>
						<input type="text" class="form-control"  name="education" value="{{ old('education', $admin->education) }}" placeholder="Address">
					</div>
				</div>

				<div class="col-md-6 col-sm-6 col-xs-12">
					<label>User Profile</label>
					<div class="custom-file-upload">
						<input type="file" id="file" name="profile_picture" />
					</div>
					@if ($admin->profile_picture)
						<img src="{{ asset('storage/' . $admin->profile_picture) }}" width="100" class="mb-2 mt-2 rounded">
					@endif
				</div>

				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="clearfix"></div>
						<div class="col-md-12 padd-top-10 text-center"> 
							<button type="submit" class="btn btn-m theme-btn full-width">Update</button>
						</div>
      				</div>	  
    			</div>
			</div>
  		</form>	
	</div>
</section>
<!-- ================ End Profile Settings ======================= --> 
@endsection

