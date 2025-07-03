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
.logout-container {
    display: flex;
    align-items: center;
    height: 100%;
    padding-right: 15px;
    margin-left: auto;
}

.logout-btn {
    background: none;
    border: none;
    color: #333;
    padding: 8px 15px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 5px;
    transition: color 0.3s ease;
}

.logout-btn:hover {
    color: #28a745;
}

.navbar-right {
    display: flex;
    align-items: center;
    height: 100%;
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
        @if(Auth::guard('web')->check())
        <li><a href="{{ route('jobseeker.dashboard') }}">Dashboard</a></li>
        <li><a href="{{ route('jobseeker.jobs') }}">Browse Jobs</a></li>
        @elseif(Auth::guard('employer')->check())
        <li><a href="{{ route('employer.dashboard') }}">Dashboard</a></li>
        <li><a href="{{ route('employer.manage-job') }}">Manage Jobs</a></li>
        @elseif(Auth::guard('admin')->check())
        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        @endif
      </ul>
      
      <!-- Right Side User Info and Logout -->
      <ul class="nav navbar-nav navbar-right">
        @if(Auth::guard('web')->check())
            <li class="logout-container">
                <form action="{{ route('jobseeker.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="ti-power-off"></i> Logout
                    </button>
                </form>
            </li>
        @elseif(Auth::guard('employer')->check())
            <li class="logout-container">
                <form action="{{ route('employer.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="ti-power-off"></i> Logout
                    </button>
                </form>
            </li>
        @elseif(Auth::guard('admin')->check())
            <li class="logout-container">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="ti-power-off"></i> Logout
                    </button>
                </form>
            </li>
        @endif
      </ul>
    </div>
  </div>
</nav>
<!-- ======================= End Navigation ===================== --> 