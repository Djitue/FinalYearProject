<!DOCTYPE html>
<html class="" lang="zxx">

<!-- Mirrored from utouchdesign.com/themes/envato/escort/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 14 May 2025 13:18:57 GMT -->
<head>
<meta name="author" content="">
<meta name="description" content="">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>JobSphere237</title>

<!-- Favicon Icon -->
<link rel="shortcut icon" href="assets/img/favicon.png" />

<!-- CSS -->
<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap-select.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/icons/css/icons.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/animate/animate.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootsnav.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/nice-select/css/nice-select.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/aos-master/aos.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&amp;display=swap" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600&amp;display=swap" rel="stylesheet"> 
</head>
<body class="utf_skin_area">
<div class="page_preloader"></div>
<!-- ======================= Start Navigation ===================== -->
<nav class="navbar navbar-default navbar-mobile navbar-fixed white no-background bootsnav">
  <div class="container"> 
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu"> <i class="fa fa-bars"></i> </button>
      <a class="navbar-brand" href="{{url('/')}}"> <h2 style="color: #28a745;">JOBSPHERE237</h2></a> 
	</div>
    <div class="collapse navbar-collapse" id="navbar-menu">
      <ul class="nav navbar-nav navbar-left" data-in="fadeInDown" data-out="fadeOutUp">
        <li class="dropdown active"> <a href="{{url('/')}}">Home</a> </li>
        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">Employer</a>
          <ul class="dropdown-menu animated fadeOutUp">
            {{-- <li><a href="employer.html">Employer</a></li> --}}
            <li><a href="{{route('loginemployer')}}">Employer Login</a></li>
            <li><a href="{{route('registeremployer')}}">Employer Register</a></li>
            {{-- <li><a href="manage-resume.html">Manage Resume</a></li> --}}
            <li><a href="loginemployer">Add Job</a></li>
            {{-- <li><a href="resume-detail.html">Resume Detail</a></li> --}}
          </ul>
        </li>
        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">Job Seeker</a>
          <ul class="dropdown-menu animated fadeOutUp">
            <li><a href="{{route('registerjobseeker')}}">Job Seeker Register</a></li>
            <li><a href="{{route('loginjobseeker')}}">Job Seeker Login</a></li>
            {{-- <li><a href="manage-job.html">Manage Jobs</a></li>
            <li><a href="browse-category.html">Browse Categories</a></li> --}}
          </ul>
        </li>
        {{-- <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pages</a>
          <ul class="dropdown-menu animated fadeOutUp">
            <li><a href="profile-settings.html">Profile Settings</a></li>
            <li><a href="job-detail.html">Job Detail</a></li>
            <li><a href="job-layout-one.html">Job Layout One</a></li>
            <li><a href="404.html">404</a></li>
          </ul>
        </li> --}}
        <li class="dropdown"> <a href="contact.html">Contact</a> </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" class="btn-signup red-btn dropdown-toggle" data-toggle="dropdown">
                <i class="login-icon ti-user"></i> Login
            </a>
            <ul class="dropdown-menu">
                <li><a href="{{ route ('show.loginjobseeker') }}">Login as Job Seeker</a></li>
                <li><a href="{{ route ('show.loginemployer') }}">Login as Employer</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="btn-signup red-btn dropdown-toggle" data-toggle="dropdown">
                <span class="ti-briefcase"></span> Register
            </a>
            <ul class="dropdown-menu">
                <li><a href="{{ route ('show.registerjobseeker') }}">Register as Job Seeker</a></li>
                <li><a href="{{ route ('show.registeremployer') }}">Register as Employer</a></li>
            </ul>
        </li>
    </ul>
    </div>
  </div>
</nav>
<!-- ======================= End Navigation ===================== --> 