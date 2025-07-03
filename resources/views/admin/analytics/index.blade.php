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
    </div>

    <div class="row text-center mb-4">
        <div class="col-md-4">
            <div class="card p-3 shadow">
                <h5>Total Jobs</h5>
                <p>{{ $totalJobs }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3 shadow">
                <h5>Applications</h5>
                <p>{{ $totalApplications }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3 shadow">
                <h5>Expired Jobs</h5>
                <p>{{ $expiredJobs }}</p>
            </div>
        </div>
    </div>

    <!-- Chart Visualization -->
    <div class="card shadow p-4 mb-5">
        <h5 class="text-center mb-4">Platform Overview</h5>
        <div style="height: 400px;">
            <canvas id="overviewChart"></canvas>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('overviewChart').getContext('2d');
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                'Job Seekers', 'Employers', 'Admins',
                'Active Jobs', 'Applications', 'Expired Jobs'
            ],
            datasets: [{
                label: 'Platform Statistics',
                data: [
                    {{ $totalJobseekers }},
                    {{ $totalEmployers }},
                    {{ $totalAdmins }},
                    {{ $totalJobs - $expiredJobs }},
                    {{ $totalApplications }},
                    {{ $expiredJobs }}
                ],
                backgroundColor: [
                    '#28a745', // Job Seekers - Green
                    '#007bff', // Employers - Blue
                    '#6c757d', // Admins - Gray
                    '#17a2b8', // Active Jobs - Cyan
                    '#ffc107', // Applications - Yellow
                    '#dc3545'  // Expired Jobs - Red
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
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Platform Statistics Overview',
                    font: {
                        size: 16
                    }
                }
            }
        }
    });
});
</script>
@endpush
