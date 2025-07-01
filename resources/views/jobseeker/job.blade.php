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
                <a title="View Job">View Job</a>
            </p>
        </div>
    </div>
    </div>
    <!-- ======================= End Page Title ===================== --> 

    <!-- ======================= Search Filter ===================== -->
    <section class="padd-0 padd-top-20 jov_search_block_inner">
    <div class="row">
        <div class="container">
        <form method="GET" action="{{ route('jobseeker.jobs') }}">
            <fieldset class="search-form">
            <div class="col-md-4 col-sm-4">
                <input type="text" name="keyword" class="form-control" placeholder="Job Title, Keywords or Company Name..." value="{{ request('keyword') }}" />
            </div>
            <div class="col-md-3 col-sm-3">
                <input type="text" name="town" class="form-control" placeholder="Town" value="{{ request('town') }}" />
            </div>
            <div class="col-md-3 col-sm-3">
                <select name="job_type" class="wide form-control">
                <option value="">Show All</option>
                <option value="Full Time" {{ request('job_type') == 'Full Time' ? 'selected' : '' }}>Full Time</option>
                <option value="Part Time" {{ request('job_type') == 'Part Time' ? 'selected' : '' }}>Part Time</option>
                <option value="Internship" {{ request('job_type') == 'Internship' ? 'selected' : '' }}>Internship</option>
                <option value="Freelance" {{ request('job_type') == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                <option value="Contract" {{ request('job_type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                </select>
            </div>
            <div class="col-md-2 col-sm-2 m-clear">
                <button type="submit" class="btn theme-btn full-width height-50 radius-0">Search</button>
            </div>
            </fieldset>
        </form>
        </div>
    </div>
    </section>
    <!-- ======================= Search Filter ===================== --> 
    <section class="padd-top-80 padd-bot-80">
        <div class="container"> 
            <div class="row">
                @forelse($jobs as $job)
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="utf_grid_job_widget_area"> 
                            <span class="job-type full-type">{{ $job->job_type ?? 'N/A' }}</span>
                            @auth
                                <div class="utf_job_like">
                                    <label class="toggler toggler-danger">
                                        <input type="checkbox" class="save-job-checkbox" data-job-id="{{ $job->id }}"
                                            {{ auth()->user()->savedJobs->contains($job->id) ? 'checked' : '' }}>
                                        <i class="fa fa-heart"></i>
                                    </label>
                                </div>
                            @endauth
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
                                <a href="{{ route('job.apply.form', $job->id) }}" class="btn-job theme-btn job-apply">
                                    Apply Now
                                </a>
                                <a href="{{ route('jobs.show', $job->id) }}" title="" class="btn-job light-gray-btn">View Job</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <div class="alert alert-info text-center">
                            No jobs available at the moment.
                        </div>
                    </div>
                @endforelse
            </div>
            
            <!-- Pagination -->
            <div class="row">
                <div class="col-md-12 text-center">
                    {{ $jobs->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
   </section> 
  
@endsection

@section('scripts')
<script>
   document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.save-job-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const jobId = this.dataset.jobId;
                const icon = this.nextElementSibling;
                
                fetch(`/jobs/${jobId}/save`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({})
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'added') {
                        icon.style.color = 'red';
                    } else {
                        icon.style.color = '';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    this.checked = !this.checked;
                });
            });
        });
    });
</script>
@endsection


