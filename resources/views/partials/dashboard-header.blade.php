<!DOCTYPE html>
<html class="no-js" lang="zxx">

<!-- Mirrored from utouchdesign.com/themes/envato/escort/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 14 May 2025 13:22:52 GMT -->
<head>
<meta name="author" content="">
<meta name="description" content="">
<meta http-equiv="Content-Type"content="text/html;charset=UTF-8"/>
<meta name="viewport"content="width=device-width, initial-scale=1.0">
<title>JobSphere 237</title>

<!-- Favicon Icon -->
<link rel="shortcut icon" href="assets/img/favicon.png" />

<!-- CSS -->
<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/icons/css/icons.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/animate/animate.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/aos-master/aos.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootsnav.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/nice-select/css/nice-select.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/date-dropper/datedropper.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&amp;display=swap" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600&amp;display=swap" rel="stylesheet"> 

<style>
.logout-btn {
    padding: 8px 15px;
    background-color: #dc3545;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
    margin-left: 15px;
}
.logout-btn:hover {
    background-color: #c82333;
    color: white;
    text-decoration: none;
}
.user-info {
    display: flex;
    align-items: center;
    gap: 15px;
    color: #333;
    padding: 10px 0;
}
.user-details {
    display: flex;
    align-items: center;
    gap: 10px;
}
.user-text {
    text-align: left;
}
.user-role {
    font-size: 12px;
    color: #666;
    display: block;
    margin-top: -3px;
}
.user-name {
    font-weight: 600;
    display: block;
    line-height: 1.2;
    font-size: 14px;
}
.profile-image {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #28a745;
}
.nav-user-container {
    display: flex;
    align-items: center;
    padding: 0 15px;
    margin-left: auto;
}
/* Ensure the right side menu items are properly aligned */
.navbar-right {
    float: right !important;
    margin-right: -15px;
}
@media (max-width: 767px) {
    .nav-user-container {
        width: 100%;
        justify-content: center;
        margin: 10px 0;
    }
    .navbar-right {
        float: none !important;
        margin-right: 0;
    }
}
</style>
</head>
<body class="utf_skin_area">
<div class="page_preloader"></div>
<!-- ======================= Start Navigation ===================== -->
<nav class="navbar navbar-default navbar-mobile navbar-fixed light bootsnav">
  <div class="container"> 
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu"> <i class="fa fa-bars"></i> </button>
       <a href="{{url('/')}}"><h2 style="color: #28a745;">JOBSPHERE237</h2></a>
	</div>
    <div class="collapse navbar-collapse" id="navbar-menu">
      <ul class="nav navbar-nav" data-in="fadeInDown" data-out="fadeOutUp">
        <li class="dropdown"> <a href="{{url('/')}}">Home</a> </li>
        @if(Auth::guard('employer')->check())
        <li><a href="{{ route('employer.dashboard') }}">Dashboard</a></li>
        <li><a href="{{ route('employer.manage-job') }}">Manage Jobs</a></li>
        @elseif(Auth::guard('web')->check())
        <li><a href="{{ route('jobseeker.dashboard') }}">Dashboard</a></li>
        <li><a href="{{ route('jobseeker.jobs') }}">Browse Jobs</a></li>
        @elseif(Auth::guard('admin')->check())
        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        @endif
      </ul>
      
      <!-- Right Side User Info and Logout -->
      <ul class="nav navbar-nav navbar-right">
        @if(Auth::guard('employer')->check())
            <li class="nav-user-container">
                <div class="user-info">
                    <div class="user-details">
                        <img src="{{ Auth::guard('employer')->user()->logo ? asset('storage/' . Auth::guard('employer')->user()->logo) : asset('assets/img/user-profile.png') }}" 
                             alt="Profile" class="profile-image">
                        <div class="user-text">
                            <span class="user-name">{{ Auth::guard('employer')->user()->name }}</span>
                            <span class="user-role">Employer</span>
                        </div>
                    </div>
                    <form action="{{ route('employer.logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="ti-power-off"></i> Logout
                        </button>
                    </form>
                </div>
            </li>
        @elseif(Auth::guard('web')->check())
            <li class="nav-user-container">
                <div class="user-info">
                    <div class="user-details">
                        <img src="{{ Auth::guard('web')->user()->profile_picture ? asset('storage/' . Auth::guard('web')->user()->profile_picture) : asset('assets/img/user-profile.png') }}" 
                             alt="Profile" class="profile-image">
                        <div class="user-text">
                            <span class="user-name">{{ Auth::guard('web')->user()->name }}</span>
                            <span class="user-role">Job Seeker</span>
                        </div>
                    </div>
                    <form action="{{ route('jobseeker.logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="ti-power-off"></i> Logout
                        </button>
                    </form>
                </div>
            </li>
        @elseif(Auth::guard('admin')->check())
            <li class="nav-user-container">
                <div class="user-info">
                    <div class="user-details">
                        <img src="{{ Auth::guard('admin')->user()->profile_picture ? asset('storage/' . Auth::guard('admin')->user()->profile_picture) : asset('assets/img/user-profile.png') }}" 
                             alt="Profile" class="profile-image">
                        <div class="user-text">
                            <span class="user-name">{{ Auth::guard('admin')->user()->name }}</span>
                            <span class="user-role">Administrator</span>
                        </div>
                    </div>
                    <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <i class="ti-power-off"></i> Logout
                        </button>
                    </form>
                </div>
            </li>
        @endif
      </ul>
    </div>
  </div>
</nav>
<!-- ======================= End Navigation ===================== --> 