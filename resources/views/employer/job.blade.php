@extends('layouts.dashboard')

@section('content')

<!-- ======================= Page Title ===================== -->
<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2>Manage Jobs</h2>
      <p><a href="{{url('/')}}" title="Home">Home</a> <i class="ti-angle-double-right"></i><a href="{{route('employer.dashboard')}}" title="Home">Dashboard</a> <i class="ti-angle-double-right"></i> Manage Job</p>
    </div>
  </div>
</div>
<!-- ======================= End Page Title ===================== --> 

<!-- ======================== Manage Job ========================= -->
<section class="utf_manage_jobs_area padd-top-80 padd-bot-80">
  <div class="container">
    <div class="table-responsive">
      <table class="table table-lg table-hover">
        <thead>
          <tr>
            <th>Title</th>
            <th>Type</th>
            <th>Town</th>
            <th>Posted</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($jobs as $job)
          <tr>
            <td><a href="{{ route('employer.job-detail', ['id' => $job->id]) }}"> {{ $job->job_title }} </a></td>
            <td><a href="{{ route('employer.job-detail', ['id' => $job->id]) }}"> {{ $job->job_type ?? 'Not specified'}} </a></td>
            <td><a href="{{ route('employer.job-detail', ['id' => $job->id]) }}"> {{ $job->town ?? 'Not specified' }} </a></td>
            <td><a href="{{ route('employer.job-detail', ['id' => $job->id]) }}"> {{ $job->created_at->format('d M Y') }} </a></td>
            <td><a href="{{route('jobs.edit', $job->id)}}" class="cl-success mrg-5" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></a> 
            <a href="#" class="cl-danger mrg-5" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5" class="text-center">You have not posted any jobs yet.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
      <div class="utf_flexbox_area padd-10">
        {{ $jobs->links() }}
      </div>
    </div>
  </div>
</section>
<!-- ====================== End Manage Company ================ --> 
@endsection