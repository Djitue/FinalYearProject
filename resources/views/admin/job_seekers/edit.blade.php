@extends('layouts.dashboard')

@section('content')

<!-- ======================= Start Page Title ===================== -->
<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2> Edit Job Seeker Profile </h2>
        <p>
            <a href="{{url('/')}}" title="Home">Home</a>
            <i class="ti-angle-double-right"></i>
            <a href="{{route('admin.dashboard')}}" title="Dashboard">Dashboard</a> 
            <i class="ti-angle-double-right"></i>
            <a href="{{route('job-seekers.index')}}" title="Job seeker">View Job seeker</a> 
          <i class="ti-angle-double-right"></i>
            <a> Job Seeker Profile</a>
        </p>
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
				@if ($jobseeker->profile_picture)
				<img alt="user photo" src="{{ Storage::url($jobseeker->profile_picture) }}"> 
				@else
				<img alt="user photo" src="{{ asset('assets/img/user-profile.png') }}">
				@endif
				<span class="user-photo-action">{{ $jobseeker->name  }}</span>
			</div>
		</div>
		<div class="dashboard_nav_item">
		  
		</div>
	  </div>

	  <div class="col-md-9">
	  	<form  action="{{ route('job-seekers.update',  $jobseeker->id) }}" enctype="multipart/form-data" method="POST">
        	@csrf
            @method('PUT')
			<div class="profile_detail_block">
				<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label>Name</label>
					<input type="text" class="form-control" name="name" value="{{ old('name', $jobseeker->name) }}" placeholder="Your Name">
				</div>
				</div>

				<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label>Email</label>
					<input type="text" class="form-control" name="email" value="{{ old('email', $jobseeker->email) }}" placeholder="mail@example.com">
				</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label>Phone</label>
					<input type="text" class="form-control" name="phone" value="{{ old('phone', $jobseeker->phone) }}" placeholder="6********">
				</div>
				</div>

				<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label>Address</label>
					<input type="text" class="form-control"  name="address" value="{{ old('address', $jobseeker->address) }}" placeholder="Address">
				</div>
				</div>

				<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label>Gender</label>
					<select name="gender" class="wide form-control">
					<option data-display="Gender">Gender</option>
					<option  value="Male" {{ old('gender', $jobseeker->gender) == 'Male' ? 'selected' : '' }}>Male</option>
					<option value="Female" {{ old('gender', $jobseeker->gender) == 'Female' ? 'selected' : '' }}>Female</option>
					</select>
				</div>
				</div>

				<div class="col-md-6 col-sm-6 col-xs-12">
					<label>User Profile</label>
					<div class="custom-file-upload">
						<input type="file" id="file" name="profile_picture" />
					</div>
					@if ($jobseeker->profile_picture)
						<img src="{{ asset('storage/' . $jobseeker->profile_picture) }}" width="100" class="mb-2 mt-2 rounded">
					@endif
				</div>

				<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label>Skil(separate with commas)</label>
					<input type="text" name="skill" class="form-control" value="{{ old('skill', $jobseeker->skill) }}" placeholder="skill">
				</div>
				</div>

				<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label>Age</label>
					<input type="text" name="age" class="form-control" value="{{ old('age', $jobseeker->age) }}" placeholder="age">
				</div>
				</div>

				<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<label>Language</label>
					<input type="text" name="language" class="form-control" value="{{ old('language', $jobseeker->language) }}" placeholder="language">
				</div>
				</div>

				<div class="col-md-6 col-sm-6 col-xs-12">
					<label>User CV (PDF, Word)</label>
					<div class="custom-file-upload">
						<input type="file" id="cv" name="cv" />
					</div>

					@if ($jobseeker->cv)
						<a href="{{ asset('storage/' . $jobseeker->cv) }}" target="_blank" class="btn btn-sm btn-primary mt-2">
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