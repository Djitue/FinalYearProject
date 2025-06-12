@extends('layouts.dashboard')

@section('content')

<!-- ======================= Start Page Title ===================== -->
<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2> Job Seeker </h2>
        <p>
            <a href="{{url('/')}}" title="Home">Home</a>
            <i class="ti-angle-double-right"></i>
            <a href="{{route('admin.dashboard')}}" title="Dashboard">Dashboard</a> 
            <i class="ti-angle-double-right"></i>
            <a href="{{route('job-seekers.index')}}" title="Job seeker">View Job seeker</a> 
          <i class="ti-angle-double-right"></i>
            <a> Job Seeker Detail</a>
        </p>
    </div>
  </div>
</div>
<!-- ======================= End Page Title ===================== --> 

<!-- ================ Employer Profile ======================= -->
<section class="padd-top-80 padd-bot-50"> 
  <div class="container">
    <div class="user_acount_info row">
      
      <!-- Profile Picture -->
      <div class="col-md-3 col-sm-5">
        <div class="emp-pic">
          <img class="img-responsive width-270" src="{{ Storage::url( $jobSeeker->profile_picture ?? 'default.jpg') }}" alt="Profile Picture">
        </div>
      </div>

      <!-- Job Seeker Info -->
      <div class="col-md-9 col-sm-7">
        <div class="emp-des">
          <h2>{{ $jobSeeker->name }}</h2>
          <span class="theme-cl">{{ $jobSeeker->skill ?? 'No skill specified' }}</span>
          <ul class="employer_detail_item">
            <li><i class="ti-credit-card padd-r-10"></i>Address: {{ $jobSeeker->address ?? 'No address specified' }}</li>
            <li><i class="ti-mobile padd-r-10"></i>Phone: {{ $jobSeeker->phone ?? 'No phone specified'}}</li>
            <li><i class="ti-email padd-r-10"></i>Email: {{ $jobSeeker->email ?? 'No email specified'}}</li>
            <li><i class="ti-user padd-r-10"></i>Gender: {{ ucfirst($jobSeeker->gender ?? 'No gender specified') }}</li>
            <li><i class="ti-timer padd-r-10"></i>Age: {{ $jobSeeker->age ?? 'No age specified'}} years</li>
            <li><i class="ti-world padd-r-10"></i>Language: {{ $jobSeeker->language ?? 'No language specified'}}</li>
            <li><i class="ti-briefcase padd-r-10"></i>CV: 
              @if($jobSeeker->cv)
                <a href="{{ asset('storage/cvs/' . $jobSeeker->cv) }}" target="_blank">View CV</a>
              @else
                Not uploaded
              @endif
            </li>
            <li>
              <a href="{{route('job-seekers.edit', $jobSeeker->id)}}">
                <button type="button"  class="btn-job theme-btn job-apply">Edit Job Seeker</button>
              </a>
            </li>
            <li>
              <form action="{{route('job-seekers.destroy', $jobSeeker->id)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this job seeker?');" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger job-apply">DELETE JOB SEEKER</button>
              </form>
            </li>
          </ul>
        </div>      
      </div>

    </div> 	
  </div>
</section>
<!-- ================ End Employer Profile ======================= --> 