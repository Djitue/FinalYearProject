@extends('layouts.dashboard')

@section('content')

<!-- ======================= Page Title ===================== -->
<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2>Job Detail</h2>
      <p><a href="{{url('/')}}" title="Home">Home</a> <i class="ti-angle-double-right"></i><a href="{{route('employer.dashboard')}}" title="Home">Dashboard</a> <i class="ti-angle-double-right"></i> <a href="{{route('employer.manage-job')}}" title="Home">Manage Job<i class="ti-angle-double-right"></i> Job Detail</p>
    </div>
  </div>
</div>
<!-- ======================= End Page Title ===================== --> 

<!-- ====================== Start Job Detail 2 ================ -->
<section class="padd-top-80 padd-bot-60">
  <div class="container"> 
    <!-- row -->
    <div class="row">
      <div class="col-md-8 col-sm-7">
        <div class="detail-wrapper">
          <div class="detail-wrapper-body">
			<div class="row">
				<div class="col-md-4 text-center user_profile_img"><h4>{{ $job->company_name ?? 'No Company name' }} </h4>  <img src="{{ $job->company_logo ? asset('storage/' . $job->company_logo) : asset('assets/img/company_logo_1.png') }}" class="width-100"  alt=""/>
				  <h4 class="meg-0">{{ $job->job_title }} </h4>
				  <span>{{ $job->address ?? 'No address' }} </span> 
				</div>
                
				<div class="col-md-8 user_job_detail">
				  <div class="col-sm-12 mrg-bot-10"> <i class="ti-credit-card padd-r-10"></i>{{ $job->salary ?? 'No Salary' }} </div>
				  <div class="col-sm-12 mrg-bot-10"> <i class="ti-mobile padd-r-10"></i>{{ $job->phone ?? 'No phone' }}  </div>
				  <div class="col-sm-12 mrg-bot-10"> <i class="ti-email padd-r-10"></i>{{ $job->email }}  </div>
				  <div class="col-sm-12 mrg-bot-10"> <i class="ti-calendar padd-r-10"></i><span class="full-type">{{ $job->job_type ?? 'No job type'  }} </span> </div>
				  <div class="col-sm-12 mrg-bot-10"> <i class="ti-user padd-r-10"></i><span class="cl-danger">{{ $job->vacancy ?? 'Vacancy not Specified' }} Open Position </span> </div>
				  <div class="col-sm-12 mrg-bot-10"> <i class="ti-shield padd-r-10"></i>{{ $job->experience ?? 'Experience not specified'  }} Year Exp.  </div>
				  <div class="col-sm-12 mrg-bot-10"> <i class="ti-pencil-alt padd-r-10"></i>{{ $job->category ?? 'Uncategorized' }} </div>
				  <div class="col-sm-12 mrg-bot-10"> <i class="ti-location-pin padd-r-10"></i>{{ $job->town ?? 'Town not specified' }} </div>
				</div>
			</div>
          </div>
        </div>
        <div class="detail-wrapper">
          <div class="detail-wrapper-header">
            <h4>Job Description</h4>
          </div>
          <div class="detail-wrapper-body">
            <p>{{ $job->description }} </p>
          </div>
        </div>
		<div class="detail-wrapper">
          <div class="detail-wrapper-header">
            <h4>Job Skill</h4>
          </div>
          <div class="detail-wrapper-body">
            <ul class="detail-list">
              <li>{{ $job->skill ?? 'Skill not specified' }} </li>
              
            </ul>
          </div>
        </div>
        <div class="detail-wrapper">
          <div class="detail-wrapper-header">
            <h4>Requirements</h4>
          </div>
          <div class="detail-wrapper-body">
            <ul class="detail-list">
              <li>{{ $job->requirement ?? 'No Requirements'  }} </li>
            </ul>
          </div>
        </div>
      </div>
      
      <!-- Sidebar -->
      <div class="col-md-4 col-sm-5">
        <div class="sidebar"> 
          <!-- Start: Job Overview -->
          <div class="widget-boxed">
            <div class="widget-boxed-header">
              <h4>Social Media</h4>
            </div>
            <div class="widget-boxed-body">
              <div class="side-list no-border">
                <ul>
                    <li>{{ $job->website ?? 'No Website Link'  }} </li>
                    <li>{{ $job->facebook ?? 'No Facebook Link'  }} </li>
                    <li>{{ $job->linkedin ?? 'No Linkedin Link'  }} </li>
                    <li>{{ $job->instagram?? 'No Instagram Link'  }} </li>
                </ul>                
              </div>
            </div>
          </div>
          <!-- End: Job Overview --> 

          <div class="widget-boxed">
            <div class="widget-boxed-header">
              <h4>Action</h4>
            </div>
            <div class="widget-boxed-body">
              <div class="side-list">
                <div class="text-center">
					<button type="button"  class="btn-job theme-btn job-apply">Edit Job</button>
                    <button type="button" data-toggle="modal" data-target="#signin" class="btn btn-danger job-apply">DELETE JOB</button>
				  </div>
              </div>
            </div>
          </div>
</section>
<!-- ====================== End Job Detail 2 ================ --> 
@endsection