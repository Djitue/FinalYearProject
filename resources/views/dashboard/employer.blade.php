@extends('layouts.app')

@section('content')

<!-- ======================= Page Title ===================== -->
<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2>Employer Profile Settings</h2>
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
		  <div class="user_dashboard_pic"> <img alt="user photo" src="assets/img/user-profile.png"> <span class="user-photo-action">{{ Auth::guard('employer')->user()->name }}</span> </div>
		</div>
		<div class="dashboard_nav_item">
		  <ul>
		    <li class="active"><a href="{{route('employer.dashboard')}}"><i class="login-icon ti-dashboard"></i> Dashboard</a></li>
			<li><a href="#"><i class="login-icon ti-user"></i> Edit Profile</a></li>
			<li><a href="#"><i class="login-icon ti-key"></i> Change Password</a></li>
			<li><a href="#"><i class="login-icon ti-power-off"></i> Logout</a></li>
		  </ul>
		</div>
	  </div>
	  <div class="col-md-9">
        <div id="dashboard_listing_blcok">
		  <div class="col-md-4 col-sm-4">
			<div class="statusbox">
			  <h3>Balance Credit</h3>
			  <div class="statusbox-content">
				<p class="ic_status_item ic_col_one"><i class="fa fa-balance-scale"></i></p>
				<h2>$215,00</h2>
				<span>Updated 02 Jan 2021</span> 
			  </div>
			</div>
		  </div>
		  <div class="col-md-4 col-sm-4">
			<div class="statusbox">
			  <h3>View Progress</h3>
			  <div class="statusbox-content">
				<p class="ic_status_item ic_col_two"><i class="fa fa-line-chart"></i></p>
				<h2>$280,00</h2>
				<span>Updated 02 Jan 2021</span> 
			  </div>
			</div>
		  </div>
		  <div class="col-md-4 col-sm-4">
			<div class="statusbox">
			  <h3>View Payments</h3>
			  <div class="statusbox-content">
				<p class="ic_status_item ic_col_three"><i class="fa fa-cc-paypal"></i></p>
				<h2>$350,00</h2>
				<span>Updated 02 Jan 2021</span> 
			  </div>
			</div>
		  </div>
		</div>
      </div>	  
    </div>
  </div>
</section>
<!-- ================ End Profile Settings ======================= --> 
@endsection