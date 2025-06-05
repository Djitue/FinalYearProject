@extends('layouts.dashboard')

@section('content')

<!-- ======================= Start Page Title ===================== -->
<div class="page-title">
<div class="container">
    <div class="page-caption text-center">
    <h2>Application Form</h2>
    <p>
        <a href="{{url('/')}}" title="Home">Home</a>
            <i class="ti-angle-double-right"></i>
        <a href="{{route('jobseeker.dashboard')}}" title="Dashboard">Dashboard</a>
            <i class="ti-angle-double-right"></i>
        <a href="{{route('jobseeker.jobs')}}" title="View Job">View Job</a>
            <i class="ti-angle-double-right"></i>
        Application
    </p>
    </div>
</div>
</div>
<!-- ======================= End Page Title ===================== --> 

<section class="padd-top-80 padd-bot-80">
  <div class="container">
      <div class="log-box">
            <div class="text-center mrg-bot-20"> 
                <h4 class="mrg-0">{{ $job->job_title }}</h4>
            </div>
            <form method="POST" action="{{ route('job.apply.submit', $job->id) }}" enctype="multipart/form-data">
            @csrf
                <input type="hidden" name="job_id" value="{{ $job->id }}">
                <div class="col-md-6 col-sm-6">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Name">
                </div>
                <div class="col-md-6 col-sm-6">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Email">
                </div>
                <div class="col-md-6 col-sm-6">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control" placeholder="Phone">
                </div>
                <div class="col-md-6 col-sm-6">
                    <label>Upload CV</label>
                    <div class="custom-file-upload">
                    <input type="file" id="file" name="cv" multiple />
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn theme-btn btn-m full-width">Apply</button>
                </div>
                <div class="clearfix"></div>
                <!-- validation errors -->

                @if ($errors->any())
                <ul class="px-4 py-2 bg-red-100">
                    @foreach($errors->all() as $error)
                    <li class="my-2 text-red-500">{{ $error }}</li>  
                    @endforeach
                </ul>
                @endif
            </form>
        </div>
    </div>
</section>

<!-- Apply Job Popup --> 
@endsection