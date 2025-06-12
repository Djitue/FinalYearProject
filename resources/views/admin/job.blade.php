@extends('layouts.dashboard')

@section('content')

<!-- ======================= Page Title ===================== -->
<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2>Manage Job</h2>
        <p> 
            <a href="{{url('/')}}" title="Home">Home</a>
            <i class="ti-angle-double-right"></i>
            <a href="{{route('admin.dashboard')}}" title="Dashboard">Dashboard</a>
            <i class="ti-angle-double-right"></i>
            <a title="Manage Job">Manage Job</a>
          </p>
    </div>
  </div>
</div>
<!-- ======================= End Page Title ===================== --> 
<!-- ======================== Manage Job ========================= -->
<section class="utf_manage_jobs_area padd-top-80 padd-bot-80">
  <div class="container">
    <div class="table-responsive">
        <div class="mb-3 text-right">
            <a href="{{ route('admin.jobs.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> Create New Job
            </a>
        </div>
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
            <td><a href="{{ route('admin.job-detail', ['id' => $job->id]) }}"> {{ $job->job_title }} </a></td>
            <td><a href="{{ route('admin.job-detail', ['id' => $job->id]) }}"> {{ $job->job_type ?? 'Not specified'}} </a></td>
            <td><a href="{{ route('admin.job-detail', ['id' => $job->id]) }}"> {{ $job->town ?? 'Not specified' }} </a></td>
            <td><a href="{{ route('admin.job-detail', ['id' => $job->id]) }}"> {{ $job->created_at->format('d M Y') }} </a></td>
            <td><a href="{{route('admin.jobs.edit', $job->id)}}" class="cl-success mrg-5" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></a> 
            <form action="{{ route('admin.jobs.destroy', $job->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this job?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="cl-danger mrg-5" data-toggle="tooltip" data-original-title="Delete" style="background: none; border: none; padding: 0;">
                  <i class="fa fa-trash-o"></i>
              </button>
            </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5" class="text-center">No jobs available yet.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
      <div class="utf_flexbox_area padd-10">
        {{-- {{ $jobs->links() }} --}}
      </div>
    </div>
  </div>
</section>
<!-- ====================== End Manage Company ================ --> 
@endsection