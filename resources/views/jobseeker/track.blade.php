@extends('layouts.dashboard')

@section('content')

<!-- ======================= Page Title ===================== -->
<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2>Job Detail</h2>
        <p> 
            <a href="{{url('/')}}" title="Home">Home</a>
            <i class="ti-angle-double-right"></i>
            <a href="{{route('jobseeker.dashboard')}}" title="Dashboard">Dashboard</a>
            <i class="ti-angle-double-right"></i>
            <a title="View Job">Track Application</a>
          </p>
    </div>
  </div>
</div>
<!-- ======================= End Page Title ===================== --> 

<!-- ======================= Manage Resume ======================== -->
<section class="utf_create_company_area padd-top-80 padd-bot-80">
    <div class="container">
        <div class="table-responsive">
            @if ($applications->isEmpty())
                <p>No applicantion yet.</p>
                @else
                <table class="table table-lg table-hover">
                    <thead>
                        <tr>
                            <th>Job Title</th>
                            <th>Posted</th>
                            <th>Resume</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applications as $application)
                            <tr>
                                <td>{{ $application->jobposting->job_title ?? 'Job not found' }}</td>

                                <td>{{ $application->created_at->format('d M Y') }}</td> 
                                <td>
                                    <a href="{{ asset('storage/' . $application->cv) }}" target="_blank">View Resume</a>
                                </td>
                                <td>{{ $application->status }}</td>
                                <td>
                                    <!-- Delete Icon -->
                                    <form action="{{ route('jobseeker.application.delete', $application->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure?')" 
                                                class="btn btn-link cl-danger mrg-5 p-0" data-toggle="tooltip" title="Delete">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</section>
<!-- ====================== End Manage Resume ================ --> 
@endsection