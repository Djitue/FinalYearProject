@extends('layouts.app')

@section('content')

<!-- ======================= Start Page Title ===================== -->
<div class="page-title">
<div class="container">
    <div class="page-caption text-center">
        <h2>Saved Job</h2>
        <p>
            <a href="{{url('/')}}" title="Home">Home</a>
                <i class="ti-angle-double-right"></i>
            <a href="{{route('jobseeker.dashboard')}}" title="Dashboard">Dashboard</a>
                <i class="ti-angle-double-right"></i>
            <a title="View Job" href="{{route('jobseeker.jobs')}}">View Job</a>
                <i class="ti-angle-double-right"></i>
            <a title="View Job">Saved Job</a>
        </p>
    </div>
</div>
</div>
<!-- ======================= End Page Title ===================== --> 


<div class="container">
    <h2>Your Saved Jobs</h2>
    
    @if($savedJobs->count() > 0)
        <div class="row">
            @foreach($savedJobs as $job)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $job->title }}</h5>
                            <p class="card-text">{{ $job->company_name }}</p>
                            <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-primary">View Job</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">You haven't saved any jobs yet.</div>
    @endif
</div>
@endsection