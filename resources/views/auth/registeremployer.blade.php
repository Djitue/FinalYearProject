@extends('layouts.app')

@section('content')

<!-- ======================= Start Page Title ===================== -->
<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2>Create Employer Account</h2>
      <p><a href="{{url('/')}}" title="Home">Home</a> <i class="ti-angle-double-right"></i> SignUp</p>
    </div>
  </div>
</div>
<!-- ======================= End Page Title ===================== --> 

<!-- ====================== Start Signup Form ============= -->
<section class="padd-top-80 padd-bot-80">
  <div class="container">
      <div class="log-box">
        <form class="log-form" action="{{ route ('registeremployer')}}" method="POST">
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
                <button type="submit" class="btn theme-btn btn-m full-width">Sign Up</button>
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

{{-- <section class="newsletter theme-bg" style="background-image:url(assets/img/bg-new.png)">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="heading light">
          <h2>Subscribe Our Newsletter!</h2>
          <p>Lorem Ipsum is simply dummy text printing and type setting industry Lorem Ipsum been industry standard dummy text ever since when unknown printer took a galley.</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-3">
        <div class="newsletter-box text-center">
          <div class="input-group"> <span class="input-group-addon"><span class="ti-email theme-cl"></span></span>
            <input type="text" class="form-control" placeholder="Enter your Email...">
          </div>
          <button type="button" class="btn theme-btn btn-radius btn-m">Subscribe</button>
        </div>
      </div>
    </div>
  </div>
</section> --}}

@endsection