<!DOCTYPE html>
<html>
<head>
    <title>Application Status Update</title>
</head>
<body>
    <p>Dear {{ $name }},</p>
    <p>We are writing to inform you about the status of your application for the position of <strong>{{ $job->job_title }}</strong> at <strong>{{ $job->company_name }}</strong>.</p>
    {{-- <p>Your application status has been updated to: <strong>{{ $status }}</strong>.</p> --}}

    @if($status == 'Accepted')
        <p>Congratulations! You have been <b>Accepted</b> for the position. Please await further instructions from our team.</p>
    @elseif($status == 'Rejected')
        <p>We regret to inform you that your application has been <b>Rejected</b>. Thank you for your interest.</p>
    @endif

    <p>Best regards,</p>
    <p>The {{ $job->company_name }} Team</p>
</body>
</html>
