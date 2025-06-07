@extends('layouts.dashboard')

@section('content')
    <!-- ======================= Start Page Title ===================== -->
    <div class="page-title">
    <div class="container">
        <div class="page-caption text-center">
            <h2>Job In Grid</h2>
            <p>
                <a href="{{url('/')}}" title="Home">Home</a>
                    <i class="ti-angle-double-right"></i>
                <a href="{{route('jobseeker.dashboard')}}" title="Dashboard">Dashboard</a>
                    <i class="ti-angle-double-right"></i>
                <a title="View Job">View Candidate</a>
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
                            {{-- <div class="utf_job_like">
                                <label class="toggler toggler-danger">
                                    <input type="checkbox">
                                    <i class="fa fa-heart"></i> 
                                </label>
                            </div> --}}
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
                            </div>
                            <div class="utf_apply_job_btn_item">
                                <a href="{{route('employer.jobs.applicants', $job->id)}}" class="btn-job theme-btn job-apply">
                                    View Applicant
                                </a>
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
