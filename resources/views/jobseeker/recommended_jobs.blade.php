@extends('layouts.dashboard')

@section('content')

<!-- ======================= Page Title ===================== -->
<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2>Recommended Jobs Based on Your Skills</h2>
        <p>
            <a href="{{url('/')}}" title="Home">Home</a>
            <i class="ti-angle-double-right"></i>
            <a href="{{route('jobseeker.dashboard')}}" title="Dashboard">Dashboard</a>
            <i class="ti-angle-double-right"></i>
            <a title="Recommended Job">Recommended Jobs</a>
        </p>
    </div>
  </div>
</div>
<!-- ======================= End Page Title ===================== --> 

<section class="padd-top-80 padd-bot-80">
    <div class="container"> 
        <div class="row">
            @if($jobs->isEmpty())
                <div class="col-md-12">
                    <p class="text-center text-muted">No matching jobs found based on your skills.</p>
                </div>
            @else
                @foreach ($jobs as $job)
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="utf_grid_job_widget_area"> 
                            <span class="job-type full-type">{{ $job->job_type ?? 'N/A' }}</span>
                            <div class="u-content">
                                <h5>
                                    <a href="{{ route('jobs.show', $job->id) }}">
                                        {{ $job->company_name ?? 'Company Name' }}
                                    </a>
                                </h5>
                                <div class="avatar box-80"> 
                                    <a href="{{ route('jobs.show', $job->id) }}">
                                        <img class="img-responsive" 
                                        src="{{ optional($job->employer)->logo ? asset('storage/' . $job->employer->logo) : asset('assets/img/company_logo_1.png') }}" 
                                        alt=""> 
                                    </a>
                                </div>
                                <h5>
                                    <a href="{{ route('jobs.show', $job->id) }}">
                                        {{ $job->job_title }}
                                    </a>
                                </h5>
                                <p class="text-muted"><i class="ti-credit-card padd-r-10"></i>{{ $job->salary ?? 'Salary not provided' }}</p>
                                <p class="text-muted"><i class="ti-location-pin padd-r-10"></i>{{ $job->town ?? 'Location not specified' }}</p>
                                <p class="text-muted"><i class="ti-check-box padd-r-10"></i>Match: {{ $job->match_percentage }}%</p>
                                <p class="text-muted"><i class="ti-tag padd-r-10"></i>Matched Skills: {{ implode(', ', $job->matched_skills) }}</p>
                            </div>
                            <div class="utf_apply_job_btn_item">
                                <a href="{{ route('job.apply.form', $job->id) }}" class="btn-job theme-btn job-apply">Apply Now</a>
                                <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-primary btn-sm">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
@endsection