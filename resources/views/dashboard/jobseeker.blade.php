@extends('layouts.dashboard')

@section('content')

<!-- ======================= Page Title ===================== -->
<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2> Job Seeker Dashboard</h2>
      <p><a href="{{url('/')}}" title="Home">Home</a> <i class="ti-angle-double-right"></i> Dashboard</p>
  </div>
</div>
<!-- ======================= End Page Title ===================== --> 

<!-- ================ Profile Settings ======================= -->
<section class="padd-top-80 padd-bot-80">
  <div class="container">
    <div class="row"> 
      <div class="col-md-3">
		<div id="leftcol_item">
		<div class="user_dashboard_pic"><img src="{{ asset('storage/' . Auth::guard('web')->user()->profile_picture) }}" width="100" alt=""> 
		<span class="user-photo-action">{{ Auth::guard('web')->user()->name }}</span> </div>
		</div>
		<div class="dashboard_nav_item">
		  <ul>
		    <li class="active"><a href="{{route('jobseeker.dashboard')}}"><i class="login-icon ti-dashboard"></i> Dashboard</a></li>
			<li><a href="{{ route('jobseeker.edit-profile') }}"><i class="login-icon ti-user"></i> Edit Profile</a></li>
			<li><a href="{{ route('jobseeker.update-password') }}"><i class="login-icon ti-key"></i> Change Password</a></li>
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
        <div id="dashboard_listing_blcok">
		  
		  <!-- View Job -->
			<div class="col-md-4 col-sm-4">
				<a href="{{route('jobseeker.jobs')}}" style="text-decoration: none;">
					<div class="statusbox">
						<h3>View Job</h3>
						<div class="statusbox-content">
							<p class="ic_status_item ic_col_one">
								<i class="fa fa-folder-open"></i>
							</p>
						</div>
					</div>
				</a>
			</div>
			
			<!-- Track Application -->
			<div class="col-md-4 col-sm-4">
				<a href="{{route('jobseeker.applications')}}" style="text-decoration: none;">
					<div class="statusbox">
						<h3>Track Application</h3>
						<div class="statusbox-content">
							<p class="ic_status_item ic_col_three">
								<i class="fa fa-briefcase"></i>
							</p>
						</div>
					</div>
				</a>
			</div> 

			<!-- Create CV -->
			<div class="col-md-4 col-sm-4">
				<a href="#" style="text-decoration: none;">
					<div class="statusbox">
						<h3>Create CV</h3>
						<div class="statusbox-content">
							<p class="ic_status_item ic_col_two">
								<i class="fa fa-file"></i>
							</p>
						</div>
					</div>
				</a>
			</div>

			<!-- Saved Job -->
			<div class="col-md-4 col-sm-4">
				<a href="{{ route ('saved-jobs.index') }}" style="text-decoration: none;">
					<div class="statusbox">
						<h3>Saved Job</h3>
						<div class="statusbox-content">
							<p class="ic_status_item ic_col_three">
								<i class="fa fa-bookmark"></i>
							</p>
						</div>
					</div>
				</a>
			</div> 

			<!-- Recommendation -->
			<div class="col-md-4 col-sm-4">
				<a href="{{route('jobseeker.recommended.jobs')}}" style="text-decoration: none;">
					<div class="statusbox">
						<h3>recommended Jobs</h3>
						<div class="statusbox-content">
							<p class="ic_status_item ic_col_three">
								<i class="fa fa-folder-open"></i>
							</p>
						</div>
					</div>
				</a>
			</div> 

			<!-- Transaction Details -->
			<div class="col-md-4 col-sm-4">
				<a href="#" style="text-decoration: none;">
					<div class="statusbox">
						<h3>Transaction Details</h3>
						<div class="statusbox-content">
							<p class="ic_status_item ic_col_three">
								<i class="fa fa-credit-card"></i>
							</p>
						</div>
					</div>
				</a>
			</div> 

		</div>
      </div>	  
    </div>
  </div>
</section>
<!-- ================ End Profile Settings ======================= --> 

@endsection