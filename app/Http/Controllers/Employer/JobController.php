<?php

namespace App\Http\Controllers\Employer;

use App\Models\JobPosting;
use App\Models\Application;
use App\Models\User;
use App\Classes\SendSMS;
use Illuminate\Support\Facades\Mail;
use App\Mail\Usermail;
use Illuminate\Support\Facades\Stroage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{

    public function index()
    {
        $jobs = JobPosting::where('employer_id', auth()->id())->paginate(10); //  Use paginate
        return view('employer.job', compact('jobs'));
    }

    /**
     * Show the form for creating a new job.
     */
    public function create()
    {
        return view('employer.add-job');
    }

    public function store(Request $request)
    {

        $employerId = auth()->id(); //Get the authenticated employer's user ID


        $request->validate([
            'job_title' => 'required|string',
            'company_name' => 'nullable|string',
            'category' => 'nullable|string',
            'description' => 'required|string',
            'salary' => 'nullable|string',
            'vacancy' => 'nullable|integer',
            'experience' => 'nullable|string',
            'logo' => 'nullable|image',
            'job_type' => 'nullable|string',
            'requirement' => 'nullable|string',
            'skill' => 'nullable|string',
            'proof' => 'nullable|file',
            'deadline' => 'nullable|date',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'website' => 'nullable|string',
            'address' => 'nullable|string',
            'town' => 'nullable|string',
            'facebook' => 'nullable|string',
            'X' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'instagram' => 'nullable|string',
        ]);
        $data = $request->except(['logo', 'proof']);
        $data['employer_id'] = Auth::guard('employer')->id();

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/logos'), $filename);
            $data['logo'] = 'uploads/logos/' . $filename;
        }

        // Handle proof upload
        if ($request->hasFile('proof')) {
            $file = $request->file('proof');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/proofs'), $filename);
            $data['proof'] = 'uploads/proofs/' . $filename;
        }

        JobPosting::create($data);
        
        return redirect()->route('employer.dashboard')->with('success', 'Job posted successfully.');
    }
    
    public function show($id)
    {
        $job = JobPosting::findOrFail($id); // Assuming your model is JobPosting

        return view('employer.job-detail', compact('job'));
    }


    public function edit($id)
    {
        $job = JobPosting::findOrFail($id);
        return view('employer.edit-job', compact('job'));
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'job_title' => 'required|string',
            'company_name' => 'nullable|string',
            'category' => 'nullable|string',
            'description' => 'required|string',
            'salary' => 'nullable|string',
            'vacancy' => 'nullable|integer',
            'experience' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'job_type' => 'nullable|string',
            'requirement' => 'nullable|string',
            'skill' => 'nullable|string',
            'proof' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:2048',
            'deadline' => 'nullable|date',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'website' => 'nullable|string',
            'address' => 'nullable|string',
            'town' => 'nullable|string',
            'facebook' => 'nullable|string',
            'X' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'instagram' => 'nullable|string',
        ]);

        $job = JobPosting::findOrFail($id);

        $data = $request->all();

         // Handle logo upload if present
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $data['logo'] = $logoPath;
        }

        // Handle proof upload if present
        if ($request->hasFile('proof')) {
            $proofPath = $request->file('proof')->store('proofs', 'public');
            $data['proof'] = $proofPath;
        }

        $job->update($data);

        return redirect()->route('employer.dashboard')->with('success', 'Job updated successfully.');
    }

    public function destroy($id)
    {
        $job = JobPosting::findOrFail($id);
        $job->delete();

        return redirect()->back()->with('success', 'Job deleted successfully.');
    }

    public function viewPostedJobs()
    {
        // Get jobs posted by the logged-in employer
        $jobs = JobPosting::where('employer_id', auth()->id())->get();

        return view('employer.job-application', compact('jobs'));
    }

    public function viewApplicants($jobId)
    {
        $job = JobPosting::where('id', $jobId)
            ->where('employer_id', auth()->id()) // Ensure security
            ->with(['applications' => function ($query) {
                $query->where('deleted_by_user', false)
                    ->with('user'); // Explicitly eager load the user inside the constraint
            }])
            ->firstOrFail();

        return view('employer.applicants', compact('job'));
    }


    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Accepted,Rejected',
        ]);

        $applicant = Application::findOrFail($id);
        $applicant->status = $request->status;
        // $applicant->email = $request->email;
        //      $applicant->phone = $request->phone;

        $applicant->save();
            $job = $applicant->jobposting;
 
            // $sendMail = new Usermail($applicant->name, $job, $request->status);
            $sendMail = new Usermail($applicant->name, $applicant->email, $job, $request->status);
    
          Mail::to($applicant->email)->send($sendMail);

        // $message = "Hello ". $applicant->name.'.Welcome to our  platform'.'.your '. $applicant->status. ' account has been created successfully '. 'and your credentials will be available to your email.  Thank you';
        // $sms = new SendSMS();

        // $sms->sendSMS('237'.$applicant->user->phone, $message);                        


        return redirect()->back()->with('success', 'Applicant status updated successfully.');
    }

    public function destroyapplication($id)
    {
        $application = Application::findOrFail($id);

        // If you stored the CV file and want to delete it too
        if ($application->cv && \Storage::disk('public')->exists($application->cv)) {
            \Storage::disk('public')->delete($application->cv);
        }

        $application->delete();

        return redirect()->back()->with('success', 'Application deleted successfully.');
    }

    // public function getMatchingJobSeekers($id)
    //  {
    //     $job = JobPosting::findOrFail($id);

    //     // Process required skills and education
    //     $requiredSkills = collect(explode(',', $job->skill))
    //                         ->map(fn($s) => strtolower(trim($s)))
    //                         ->filter();
    //     $requiredEducation = strtolower(trim($job->requirement));

    //     // Fetch all users (or use where if you're sure of format)
    //     $jobSeekers = User::all();

    //     $matchedSeekers = $jobSeekers->filter(function ($seeker) use ($requiredSkills, $requiredEducation) {
    //         $seekerSkills = collect(explode(',', $seeker->skill))
    //                             ->map(fn($s) => strtolower(trim($s)))
    //                             ->filter();

    //         $matchedSkills = $seekerSkills->intersect($requiredSkills);

    //         // Match only if at least one skill and education matches
    //         return $matchedSkills->count() > 0 && str_contains(strtolower($seeker->education), $requiredEducation);
    //     })->map(function ($seeker) use ($requiredSkills) {
    //         $seekerSkills = collect(explode(',', $seeker->skill))
    //                             ->map(fn($s) => strtolower(trim($s)))
    //                             ->filter();

    //         $seeker->matched_skills = $seekerSkills->intersect($requiredSkills);
    //         $seeker->matched_count = $seeker->matched_skills->count();
    //         return $seeker;
    //     })->sortByDesc('matched_count')->values();

    //     return view('employer.matched_job_seeker', compact('matchedSeekers', 'job'));
    // }

    public function getMatchingJobSeekers($id)
    {
        $job = JobPosting::findOrFail($id);

        // Process required skills and education
        $requiredSkills = collect(explode(',', $job->skill))
                        ->map(fn($s) => strtolower(trim($s)))
                        ->filter();
        $requiredEducation = strtolower(trim($job->requirement));

        // Get user IDs of job seekers who applied to this job
        $appliedUserIds = Application::where('job_posting_id', $id)
                                ->pluck('user_id')
                                ->toArray();

        // Get all users who have applied
        $jobSeekers = User::whereIn('id', $appliedUserIds)->get();

        // Matching logic with percentage calculation
        $matchedSeekers = $jobSeekers->map(function ($seeker) use ($requiredSkills, $requiredEducation) {
            $seekerSkills = collect(explode(',', $seeker->skill ?? ''))
                            ->map(fn($s) => strtolower(trim($s)))
                            ->filter();

            $matchedSkills = $seekerSkills->intersect($requiredSkills);
            $matchedSkillsCount = $matchedSkills->count();
            $totalRequiredSkills = $requiredSkills->count();

            // Calculate skill match percentage
            $skillMatchPercentage = $totalRequiredSkills > 0 
                ? ($matchedSkillsCount / $totalRequiredSkills) * 100 
                : 0;

            // Calculate education match (basic text matching)
            $educationMatchScore = str_contains(strtolower($seeker->education ?? ''), $requiredEducation) ? 100 : 0;

            // Calculate overall match percentage (70% skills, 30% education)
            $overallMatchPercentage = ($skillMatchPercentage * 0.7) + ($educationMatchScore * 0.3);

            $seeker->matched_skills = $matchedSkills;
            $seeker->matched_count = $matchedSkillsCount;
            $seeker->match_percentage = round($overallMatchPercentage);
            
            return $seeker;
        })->filter(function ($seeker) {
            // Filter out candidates with 0% match
            return $seeker->match_percentage > 0;
        })->sortByDesc('match_percentage')
        ->values();

        return view('employer.matched_job_seeker', compact('matchedSeekers', 'job'));
    }

}
