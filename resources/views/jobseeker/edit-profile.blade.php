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
				@if ($user->profile_picture)
				<img alt="user photo" src="{{ Storage::url($user->profile_picture) }}"> 
				@else
				<img alt="user photo" src="{{ asset('assets/img/user-profile.png') }}">
				@endif
				<span class="user-photo-action">{{ Auth::guard('web')->user()->name }}</span>
			</div>
		</div>
		<div class="dashboard_nav_item">
		  <ul>
		    <li><a href="{{route('jobseeker.dashboard')}}"><i class="login-icon ti-dashboard"></i> Dashboard</a></li>
			<li class="active"><a href="{{route('jobseeker.update-profile')}}"><i class="login-icon ti-user"></i> Edit Profile</a></li>
			<li><a href="{{route('jobseeker.update-password')}}"><i class="login-icon ti-key"></i> Change Password</a></li>
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
	  	<form method="POST" action="{{ route('jobseeker.update-profile') }}" enctype="multipart/form-data">
        	@csrf
			<div class="profile_detail_block">
				<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label>Name</label>
					<input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" placeholder="Your Name">
				</div>
				</div>

				<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label>Email</label>
					<input type="text" class="form-control" name="email" value="{{ old('email', $user->email) }}" placeholder="mail@example.com">
				</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label>Phone</label>
					<input type="text" class="form-control" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="6********">
				</div>
				</div>

				<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label>Address</label>
					<input type="text" class="form-control"  name="address" value="{{ old('address', $user->address) }}" placeholder="Address">
				</div>
				</div>

				<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label>Gender</label>
					<select name="gender" class="wide form-control">
					<option data-display="Gender">Gender</option>
					<option  value="Male" {{ old('gender', $user->gender) == 'Male' ? 'selected' : '' }}>Male</option>
					<option value="Female" {{ old('gender', $user->gender) == 'Female' ? 'selected' : '' }}>Female</option>
					</select>
				</div>
				</div>

				<div class="col-md-6 col-sm-6 col-xs-12">
					<label>User Profile</label>
					<div class="custom-file-upload">
						<input type="file" id="file" name="profile_picture" />
					</div>
					@if ($user->profile_picture)
						<img src="{{ asset('storage/' . $user->profile_picture) }}" width="100" class="mb-2 mt-2 rounded">
					@endif
				</div>

				<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label>Skil(separate with commas)</label>
					<input type="text" name="skill" class="form-control" value="{{ old('skill', $user->skill) }}" placeholder="skill">
				</div>
				</div>

				<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label>Age</label>
					<input type="text" name="age" class="form-control" value="{{ old('age', $user->age) }}" placeholder="age">
				</div>
				</div>

				<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label>Language</label>
					<input type="text" name="language" class="form-control" value="{{ old('language', $user->language) }}" placeholder="language">
				</div>
				</div>

				<div class="col-md-6 col-sm-6 col-xs-12">
					<label>User CV (PDF, Word)</label>
					<div class="custom-file-upload">
						<input type="file" id="cv" name="cv" />
					</div>

					@if ($user->cv)
						<a href="{{ asset('storage/' . $user->cv) }}" target="_blank" class="btn btn-sm btn-primary mt-2">
							View/Download CV
						</a>
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

