@extends('layouts.dashboard')

@section('content')

<!-- ======================= Start Page Title ===================== -->
<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2> Add Job Seeker </h2>
        <p>
            <a href="{{url('/')}}" title="Home">Home</a>
            <i class="ti-angle-double-right"></i>
            <a href="{{route('admin.dashboard')}}" title="Dashboard">Dashboard</a> 
            <i class="ti-angle-double-right"></i>
            <a href="{{route('job-seekers.index')}}" title="Job seeker">View Job seeker</a> 
          <i class="ti-angle-double-right"></i>
            <a> Create Job Seeker</a>
        </p>
    </div>
  </div>
</div>
<!-- ======================= End Page Title ===================== --> 

<!-- ====================== Start Signup Form ============= -->
<section class="padd-top-80 padd-bot-80">
  <div class="container">
      <div class="log-box">
        
        <form class="log-form" action="{{ route ('job-seekers.store')}}" method="POST">
        @csrf
            <div class="col-md-6">
              <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name')}}" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email')}}" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="********" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="********" required>
              </div>
            </div>          
            <div class="col-md-4">
              <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" placeholder="Phone Number" value="{{ old('phone')}}" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group text-center mrg-top-15">
                <button type="submit" class="btn theme-btn btn-m full-width">Add</button>
              </div>
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
<!-- ====================== End Signup Form ============= --> 
@endsection
