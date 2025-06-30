<!DOCTYPE html>
<html>
<head>
    <title>New Job Application</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #26ae61;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 0 0 5px 5px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #26ae61;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Job Application Received</h2>
        </div>
        
        <div class="content">
            <p>Dear {{ $jobPosting->employer->name }},</p>
            
            <p>You have received a new application for the position of <strong>{{ $jobPosting->job_title }}</strong>.</p>
            
            <h3>Applicant Details:</h3>
            <ul>
                <li><strong>Name:</strong> {{ $application->name }}</li>
                <li><strong>Email:</strong> {{ $application->email }}</li>
                <li><strong>Phone:</strong> {{ $application->phone }}</li>
                <li><strong>Application Date:</strong> {{ $application->created_at->format('F j, Y, g:i a') }}</li>
            </ul>

            <h3>Job Details:</h3>
            <ul>
                <li><strong>Job Title:</strong> {{ $jobPosting->job_title }}</li>
                <li><strong>Job Type:</strong> {{ $jobPosting->job_type }}</li>
                <li><strong>Location:</strong> {{ $jobPosting->town }}</li>
            </ul>

            <p>
                You can view the full application and download the candidate's CV by clicking the button below:
            </p>

            <a href="{{ route('employer.jobs.applicants', $jobPosting->id) }}" class="button" style="color: white;">
                View Application
            </a>

            <p style="margin-top: 20px;">
                Best regards,<br>
                JobSphere237 Team
            </p>
        </div>

        <div class="footer">
            <p>This is an automated email, please do not reply directly to this message.</p>
        </div>
    </div>
</body>
</html> 