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
				@if ($employer->profile_picture)
				<img alt="user photo" src="{{ Storage::url($employer->profile_picture) }}"> 
				@else
				<img alt="user photo" src="{{ asset('assets/img/user-profile.png') }}">
				@endif
				<span class="user-photo-action">{{ Auth::guard('employer')->user()->name }}</span>
			</div>
		</div>
		<div class="dashboard_nav_item">
		  <ul>
		    <li><a href="{{route('employer.dashboard')}}"><i class="login-icon ti-dashboard"></i> Dashboard</a></li>
			<li class="active"><a href="{{route('employer.update-profile')}}"><i class="login-icon ti-user"></i> Edit Profile</a></li>
			<li><a href="{{route('employer.update-password')}}"><i class="login-icon ti-key"></i> Change Password</a></li>
			<li><a href="#"><i class="login-icon ti-power-off"></i> Logout</a></li>
		  </ul>
		</div>
	  </div>

	  <div class="col-md-9">
	  	<form method="POST" action="{{ route('employer.update-profile') }}" enctype="multipart/form-data">
        	@csrf
			<div class="profile_detail_block">
				<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label>Name</label>
					<input type="text" class="form-control" name="name" value="{{ old('name', $employer->name) }}" placeholder="Your Name">
				</div>
				</div>

				<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label>Email</label>
					<input type="text" class="form-control" name="email" value="{{ old('email', $employer->email) }}" placeholder="mail@example.com">
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
					<input type="text" class="form-control" name="phone" value="{{ old('phone', $employer->phone) }}" placeholder="123 214 13247">
				</div>
				</div>

				<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label>Address</label>
					<input type="text" class="form-control"  name="address" value="{{ old('address', $employer->address) }}" placeholder="Address">
				</div>
				</div>

				<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label>Gender</label>
					<select name="gender" class="wide form-control">
					<option data-display="Gender">Gender</option>
					<option  value="Male" {{ old('gender', $employer->gender) == 'Male' ? 'selected' : '' }}>Male</option>
					<option value="Female" {{ old('gender', $employer->gender) == 'Female' ? 'selected' : '' }}>Female</option>
					</select>
				</div>
				</div>

				<div class="col-md-6 col-sm-6 col-xs-12">
					<label>User Profile</label>
					<div class="custom-file-upload">
						<input type="file" id="file" name="profile_picture" />
					</div>
					@if ($employer->profile_picture)
						<img src="{{ asset('storage/' . $employer->profile_picture) }}" width="100" class="mb-2 mt-2 rounded">
					@endif
				</div>

				<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label>Facebook</label>
					<input type="text" name="facebook" class="form-control" value="{{ old('facebook', $employer->facebook) }}" placeholder="https://facebook.com/">
				</div>
				</div>

				<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label>Linkedin</label>
					<input type="text" name="linkedin" class="form-control" value="{{ old('twitter', $employer->twitter) }}" placeholder="https://linkedin.com/">
				</div>
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

