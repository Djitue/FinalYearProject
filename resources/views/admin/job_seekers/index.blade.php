@extends('layouts.dashboard')

@section('content')

<!-- ======================= Start Page Title ===================== -->
<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2>Employer</h2>
      <p>
        <a href="{{url('/')}}" title="Home">Home</a>
        <i class="ti-angle-double-right"></i>
        <a href="{{route('admin.dashboard')}}" title="Home">Dashboard</a> 
        <i class="ti-angle-double-right"></i>
        <a> View Job Seeker</a>
      </p>
    </div>
  </div>
</div>
<!-- ======================= End Page Title ===================== --> 

<!-- ======================= Start All Employee ===================== -->
<section class="padd-top-80 padd-bot-80">
  <div class="container"> 
    <div class="row">
      <div class="mb-3 text-right">
          <a href="{{ route('job-seekers.create') }}" class="btn btn-primary">
              <i class="fa fa-plus"></i> Create New Job Seeker
          </a>
      </div>
      @forelse($jobSeekers as $jobSeeker)
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="contact-box">
            <div class="contact-img">
              <img src="{{ Storage::url($jobSeeker->profile_picture ?? 'default.jpg') }}" class="img-responsive" alt="{{ $jobSeeker->name }}">
                {{-- <img alt="user photo" src="{{ Storage::url($admin->profile_picture) }}">  --}}
            </div>
            <div class="contact-caption">
              <a href="#">{{ $jobSeeker->name }}</a>
              <span>{{ $jobSeeker->address ?? 'No address' }}</span>
              <p>{{ $jobSeeker->email }}</p>
            </div>
          </div>
        </div>
        @empty
            <p class="text-center">No job seekers found.</p>
        @endforelse
    </div>
  </div>
</section>
<!-- ====================== End All Employee ================ --> 
@endsection