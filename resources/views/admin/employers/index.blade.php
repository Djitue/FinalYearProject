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
        <a> View Employer</a>
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
          <a href="{{ route('employers.create') }}" class="btn btn-primary">
              <i class="fa fa-plus"></i> Create New Employer
          </a>
      </div>
      @forelse($employers as $employer)
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="contact-box">
            <div class="contact-img">
              <img src="{{ Storage::url($employer->profile_picture ?? 'default.jpg') }}" class="img-responsive" alt="{{ $employer->name }}">
                {{-- <img alt="user photo" src="{{ Storage::url($admin->profile_picture) }}">  --}}
            </div>
            <div class="contact-caption">
              <a href="{{route('employers.show', ['id' => $employer->id])}}">{{ $employer->name }}</a>
              <span>{{ $employer->address ?? 'No address' }}</span>
              <p>{{ $employer->email }}</p>
            </div>
          </div>
        </div>
        @empty
            <p class="text-center">No Employer found.</p>
        @endforelse
    </div>
  </div>
</section>
<!-- ====================== End All Employee ================ --> 
@endsection