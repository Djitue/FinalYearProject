@extends('layouts.dashboard')

@section('content')
    <!-- ======================= Start Page Title ===================== -->
    <div class="page-title">
    <div class="container">
        <div class="page-caption text-center">
            <h2>Search Results</h2>
            <p>
                <a href="{{url('/')}}" title="Home">Home</a>
                    <i class="ti-angle-double-right"></i>
                <a title="Result of Search">Result of Search</a>
            </p>
        </div>
    </div>
    </div>
    <!-- ======================= End Page Title ===================== --> 

    <section class="padd-top-80 padd-bot-80">
        <div class="container"> 
            <div class="row">
                @forelse($jobs as $job)
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="utf_grid_job_widget_area"> 
                            <span class="job-type full-type">{{ $job->job_type ?? 'N/A' }}</span>
                            <div class="utf_job_like">
                                <label class="toggler toggler-danger">
                                <input type="checkbox" checked>
                                <i class="fa fa-heart"></i> 
                                </label>
                            </div>
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
                            </div>
                            <div class="utf_apply_job_btn_item">
                                <a href="{{route('loginjobseeker')}}" class="btn-job theme-btn job-apply">
                                    Apply Now
                                </a>
                                <a href="{{ route('job.details', ['id' => $job->id]) }}" title="" class="btn-job light-gray-btn">View Job</a>
                            </div>
                        </div>
                    </div>
                    @empty
                        <p class="text-center">No jobs available at the moment.</p>
                @endforelse
            </div>
        </div>
   </section> 
  
@endsection

