@extends('layouts.dashboard')

@section('content')

<!-- ======================= Start Page Title ===================== -->
<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2> Employer </h2>
        <p>
            <a href="{{url('/')}}" title="Home">Home</a>
            <i class="ti-angle-double-right"></i>
            <a href="{{route('admin.dashboard')}}" title="Dashboard">Dashboard</a> 
            <i class="ti-angle-double-right"></i>
            <a href="{{route('employers.index')}}" title="Employer">View Employer</a> 
            <i class="ti-angle-double-right"></i>
            <a> Employer Detail</a>
        </p>
    </div>
  </div>
</div>
<!-- ======================= End Page Title ===================== --> 

<!-- ================ Employer Profile ======================= -->
<section class="padd-top-80 padd-bot-50"> 
  <div class="container">
    <div class="user_acount_info row">
      
      <!-- Profile Picture -->
      <div class="col-md-3 col-sm-5">
        <div class="emp-pic">
          <img class="img-responsive width-270" src="{{ Storage::url( $employer->profile_picture ?? 'default.jpg') }}" alt="Profile Picture">
        </div>
      </div>

      <!-- Job Seeker Info -->
      <div class="col-md-9 col-sm-7">
        <div class="emp-des">
          <h2>{{ $employer->name }}</h2>
          <span class="theme-cl">{{ $employer->skill ?? 'No skill specified' }}</span>
          <ul class="employer_detail_item">
            <li><i class="ti-credit-card padd-r-10"></i>Address: {{ $employer->address ?? 'No address specified' }}</li>
            <li><i class="ti-mobile padd-r-10"></i>Phone: {{ $employer->phone ?? 'No phone specified'}}</li>
            <li><i class="ti-email padd-r-10"></i>Email: {{ $employer->email ?? 'No email specified'}}</li>
            <li><i class="ti-user padd-r-10"></i>Gender: {{ ucfirst($employer->gender ?? 'No gender specified') }}</li>
            <li><i class="ti-world padd-r-10"></i>linkedin: {{ $employer->linkedin ?? 'No linkedin specified'}}</li>
            <li><i class="ti-world padd-r-10"></i>facebook: {{ $employer->facebook ?? 'No facebook specified'}}</li>
            <li>
              <a href="{{route('employers.edit', $employer->id)}}">
                <button type="button"  class="btn-job theme-btn job-apply">Edit Employer</button>
              </a>
            </li>
            <li>
              <form action="{{route('employers.destroy', $employer->id)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this employer?');" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger job-apply">DELETE EMPLOYER</button>
              </form>
            </li>
          </ul>
        </div>      
      </div>

    </div> 	
  </div>
</section>
<!-- ================ End Employer Profile ======================= --> 