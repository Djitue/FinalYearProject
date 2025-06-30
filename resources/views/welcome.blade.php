@extends('layouts.app')

@section('content')

    <!-- ======================= Start Banner ===================== -->
    <div class="utf_main_banner_area" style="background-image:url(assets/img/slider_bg2.jpg);" data-overlay="8">
    <div class="container">
        <div class="col-md-8 col-sm-10">
        <div class="caption cl-white home_two_slid">
            <h2>Connecting Talent With Opportunity </h2>
            <h3 style="color: white;">Unlock New Career Paths and Discover the Best Talent.</h3>
        </div>
        <form action="{{ route('jobs.search') }}" method="GET" id="searchForm">
            <fieldset class="utf_home_form_one">
            <div class="col-md-4 col-sm-4 padd-0">
                <input type="text" 
                       name="keyword" 
                       id="searchKeyword"
                       class="form-control br-1" 
                       placeholder="Job title, skills or keywords..." 
                       autocomplete="off"
                       list="search-suggestions" />
                <datalist id="search-suggestions">
                    <!-- Will be populated via JavaScript -->
                </datalist>
            </div>
            <div class="col-md-3 col-sm-3 padd-0">
                 <input type="text" 
                        name="town" 
                        class="form-control br-1" 
                        style="border-radius: 0;" 
                        placeholder="Location" />
            </div>
            <div class="col-md-3 col-sm-3 padd-0">
               <select name="job_type" class="wide form-control">
                    <option value="">All Job Types</option>
                    <option value="Full Time">Full Time</option>
                    <option value="Part Time">Part Time</option>
                    <option value="Internship">Internship</option>
                    <option value="Freelance">Freelance</option>
                    <option value="Contract">Contract</option>
                </select>
            </div>
            <div class="col-md-2 col-sm-2 padd-0 m-clear">
                <button type="submit" class="btn theme-btn cl-white seub-btn">Search</button>
            </div>
            </fieldset>
        </form>
        </div>
    </div>
    </div>
    <!-- ======================= End Banner ===================== --> 

    <!-- ================= Job start ========================= -->
    <section class="padd-top-80 padd-bot-80">
    <div class="container"> 
       <h2 style="text-align: center;">AVAILABLE JOBS</h2>
        <div class="tab-content"> 
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
                                        <a href="{{ route('job.details', $job->id) }}" title="" class="btn-job light-gray-btn">View Job</a>
                                    </div>
                                </div>
                            </div>
                            @empty
                                <p>No jobs available at the moment.</p>
                        @endforelse
                    </div>
                </div>
                <div class="col-md-12 mrg-top-20 text-center">
                    <a href="{{route('browse.job')}}" class="btn theme-btn btn-m">Browse All Jobs</a>
                </div>
        </section> 
    </div>
    </section>

    <!-- ================= Category start ========================= -->
    {{-- <section class="utf_job_category_area">
    <div class="container">
        <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="heading">
            <h2>Job Categories</h2>  
            <p>Lorem Ipsum is simply dummy text printing and type setting industry Lorem Ipsum been industry standard dummy text ever since when unknown printer took a galley.</p>	
            </div>
        </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            <div class="col-md-3 col-sm-6">
                <a href="browse-job.html" title="">
                    <div class="utf_category_box_area">
                    <div class="utf_category_desc">
                        <div class="utf_category_icon"> <i class="icon-bargraph" aria-hidden="true"></i> </div>
                        <div class="category-detail utf_category_desc_text"> 
                        <h4>Web & Software Dev</h4>
                        <p>122 Jobs</p>	
                        </div>
                    </div>			
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6">
                <a href="browse-job.html" title="">
                    <div class="utf_category_box_area">
                    <div class="utf_category_desc">
                        <div class="utf_category_icon"> <i class="icon-tools" aria-hidden="true"></i> </div>
                        <div class="category-detail utf_category_desc_text"> 
                        <h4>Data Science & Analitycs</h4>
                        <p>155 Jobs</p>
                        </div>
                    </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6">
                <a href="browse-job.html" title="">
                    <div class="utf_category_box_area">
                    <div class="utf_category_desc">
                        <div class="utf_category_icon"> <i class="ti-briefcase" aria-hidden="true"></i> </div>
                        <div class="category-detail utf_category_desc_text">
                        <h4>Accounting & Consulting</h4>
                        <p>300 Jobs</p>
                        </div>
                    </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6">
                <a href="browse-job.html" title="">
                    <div class="utf_category_box_area">
                    <div class="utf_category_desc">
                        <div class="utf_category_icon"> <i class="ti-ruler-pencil" aria-hidden="true"></i> </div>
                        <div class="category-detail utf_category_desc_text"> 
                        <h4>Writing & Translations</h4>
                        <p>80 Jobs</p>
                        </div>
                    </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6">
                <a href="browse-job.html" title="">
                    <div class="utf_category_box_area">
                    <div class="utf_category_desc">
                        <div class="utf_category_icon"> <i class="icon-briefcase" aria-hidden="true"></i> </div>
                        <div class="category-detail utf_category_desc_text"> 
                        <h4>Sales & Marketing</h4>
                        <p>120 Jobs</p>
                        </div>
                    </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6">
                <a href="browse-job.html" title="">
                    <div class="utf_category_box_area">
                    <div class="utf_category_desc">
                        <div class="utf_category_icon"> <i class="icon-wine" aria-hidden="true"></i> </div>
                        <div class="category-detail utf_category_desc_text">
                        <h4>Graphics & Design</h4>
                        <p>78 Jobs</p>
                        </div>
                    </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6">
                <a href="browse-job.html" title="">
                    <div class="utf_category_box_area">
                    <div class="utf_category_desc">
                        <div class="utf_category_icon"> <i class="ti-world" aria-hidden="true"></i> </div>
                        <div class="category-detail utf_category_desc_text">
                        <h4>Digital Marketing</h4>
                        <p>90 Jobs</p>
                        </div>
                    </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6">
                <a href="browse-job.html" title="">
                    <div class="utf_category_box_area">
                    <div class="utf_category_desc">
                        <div class="utf_category_icon"> <i class="ti-desktop" aria-hidden="true"></i> </div>
                        <div class="category-detail utf_category_desc_text"> 
                        <h4>Education & Training</h4>
                        <p>210 Jobs</p>
                        </div>
                    </div>
                    </div>
                </a>
            </div>
            <div class="col-md-12 mrg-top-20 text-center">
                <a href="browse-category.html" class="btn theme-btn btn-m">View All Categories</a>
            </div>
        </div>
        </div>
    </div>
    </section> --}}

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchKeyword');
            const datalist = document.getElementById('search-suggestions');
            let typingTimer;

            searchInput.addEventListener('input', function() {
                clearTimeout(typingTimer);
                
                // Wait for user to stop typing for 300ms
                typingTimer = setTimeout(function() {
                    const keyword = searchInput.value;
                    if (keyword.length >= 2) { // Only search if 2 or more characters
                        fetch(`/api/search-suggestions?keyword=${encodeURIComponent(keyword)}`)
                            .then(response => response.json())
                            .then(data => {
                                // Clear existing options
                                datalist.innerHTML = '';
                                
                                // Add new options
                                data.forEach(suggestion => {
                                    const option = document.createElement('option');
                                    option.value = suggestion;
                                    datalist.appendChild(option);
                                });
                            });
                    }
                }, 300);
            });

            // Clear suggestions when input is cleared
            searchInput.addEventListener('change', function() {
                if (!this.value) {
                    datalist.innerHTML = '';
                }
            });
        });
    </script>
    @endpush

@endsection

