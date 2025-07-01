@extends('layouts.dashboard')

@section('content')

<!-- ======================= Page Title ===================== -->
<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2>Matching Job Seekers for: {{ $job->job_title }}</h2>
      <p>
        <a href="{{ url('/') }}" title="Home">Home</a>
        <i class="ti-angle-double-right"></i>
        <a href="{{ route('employer.dashboard') }}" title="Dashboard">Dashboard</a>
        <i class="ti-angle-double-right"></i>
        <a href="{{ route('employer.manage-job') }}" title="Manage Job">Manage Job</a>
        <i class="ti-angle-double-right"></i>
        <span>Job Matching</span>
      </p>
    </div>
  </div>
</div>
<!-- ======================= End Page Title ===================== --> 

@if($matchedSeekers->isEmpty())
    <div class="container mt-4 mb-4">
        <div class="alert alert-warning text-center">
            No matching job seekers found.
        </div>
    </div>
@else
<section class="utf_manage_jobs_area padd-top-80 padd-bot-80">
  <div class="container">
    <div class="table-responsive">
      <table class="table table-lg table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Education</th>
            <th>Match %</th>
            <th>Matched Skills</th>
          </tr>
        </thead>
        <tbody>
          @foreach($matchedSeekers as $index => $seeker)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $seeker->name }}</td>
              <td>{{ $seeker->email }}</td>
              <td>{{ $seeker->education }}</td>
              <td>
                <div class="progress" style="height: 20px;">
                  <div class="progress-bar @if($seeker->match_percentage >= 75) bg-success 
                                        @elseif($seeker->match_percentage >= 50) bg-info 
                                        @elseif($seeker->match_percentage >= 25) bg-warning 
                                        @else bg-danger @endif" 
                       role="progressbar" 
                       style="width: {{ $seeker->match_percentage }}%;" 
                       aria-valuenow="{{ $seeker->match_percentage }}" 
                       aria-valuemin="0" 
                       aria-valuemax="100">
                    {{ $seeker->match_percentage }}%
                  </div>
                </div>
              </td>
              <td>
                @foreach($seeker->matched_skills as $skill)
                  <span class="badge bg-success">{{ $skill }}</span>
                @endforeach
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</section>
@endif

@endsection
