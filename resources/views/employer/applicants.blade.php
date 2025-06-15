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
            <a href="{{route('employer.dashboard')}}" title="Dashboard">Dashboard</a>
            <i class="ti-angle-double-right"></i>
             <a href="{{route('employer.jobs.candidates')}}" title="Dashboard">View Jobs</a>
            <i class="ti-angle-double-right"></i>
            <a title="View Job">Applicants</a>
          </p>
    </div>
  </div>
</div>
<!-- ======================= End Page Title ===================== --> 

<!-- ======================= Manage Resume ======================== -->
<section class="utf_create_company_area padd-top-80 padd-bot-80">
    <div class="container">
        <div class="table-responsive">
            <h2>Applicants for: {{ $job->job_title }}</h2>

            @if ($job->applications->isEmpty())
                <p>No applicants yet.</p>
                @else
                <table class="table table-lg table-hover">
                    <thead>
                        <tr>
                            <th>Applicant Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Posted</th>
                            <th>Resume</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($job->applications as $application)
                            <tr>

                                <td>{{ $application->name }}</td>
                                <td>{{ $application->email }}</td>
                                <td>{{ $application->phone }}</td>
                                <td>{{ $application->created_at->format('d M Y') }}</td> 
                                <td>
                                    <a href="{{ asset('storage/' . $application->cv) }}" target="_blank">View Resume</a>
                                </td>
                                <td>
                                    <form action="{{ route('applicants.update.status', $application->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                        <select name="status" class="form-control">
                                            <option value="Pending" {{ $application->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="Accepted" {{ $application->status == 'Accepted' ? 'selected' : '' }}>Accepted</option>
                                            <option value="Rejected" {{ $application->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                        </select>
                                        <button type="submit" class="btn btn-link cl-success mrg-5 p-0" data-toggle="tooltip" title="Update Status">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <!-- Delete Icon -->
                                    <form action="{{ route('applicants.destroy', $application->id) }}" method="POST" style="display: inline;">
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