@extends('layouts.dashboard')

<style>
    .chart-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 30px;
    }

    .chart-container {
        width: 100%;
        max-width: 200px;
        height: 100px;
    }

    #overviewChart {
        width: 100% !important;
        height: 100% !important;
    }
</style>

@section('content')
<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2>Analytics</h2>
      <p>
        <a href="{{ url('/') }}" title="Home">Home</a>
        <i class="ti-angle-double-right"></i>
        <a href="{{ route('admin.dashboard') }}" title="Dashboard">Dashboard</a> 
        <i class="ti-angle-double-right"></i>
        <span>View Analytics</span>
      </p>
    </div>
  </div>
</div>

<div class="container mt-5">

    <!-- User Counts (Cards) -->
    <div class="row text-center mb-4">
        <div class="col-md-3">
            <div class="card p-3 shadow">
                <h5>Total Users</h5>
                <p>{{ $totalUsers }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow">
                <h5>Job Seekers</h5>
                <p>{{ $totalJobseekers }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow">
                <h5>Employers</h5>
                <p>{{ $totalEmployers }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow">
                <h5>Admins</h5>
                <p>{{ $totalAdmins }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow">
                <h5>Jobs</h5>
                <p>{{ $totalJobs }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow">
                <h5>Applications</h5>
                <p>{{ $totalApplications }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 shadow">
                <h5>Expired Jobs</h5>
                <p>{{ $expiredJobs }}</p>
            </div>
        </div>
    </div>

    <!-- Chart Visualization -->
    <div class="card shadow p-4 mb-5">
        <h5 class="text-center mb-4">Overview Chart</h5>
        <canvas id="overviewChart" height="100"></canvas>
    </div>

</div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('overviewChart').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    'Total Users', 'Job Seekers', 'Employers', 'Admins',
                    'Jobs', 'Applications', 'Expired Jobs'
                ],
                datasets: [{
                    label: 'System Analytics',
                    data: [
                        {{ $totalUsers }},
                        {{ $totalJobseekers }},
                        {{ $totalEmployers }},
                        {{ $totalAdmins }},
                        {{ $totalJobs }},
                        {{ $totalApplications }},
                        {{ $expiredJobs }}
                    ],
                    backgroundColor: [
                        '#007bff', '#28a745', '#ffc107', '#6c757d',
                        '#17a2b8', '#6610f2', '#dc3545'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    }
                }
            }
        });
    </script>
@endsection
