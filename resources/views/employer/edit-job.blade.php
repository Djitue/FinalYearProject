@extends('layouts.dashboard')

@section('content')

<!-- ======================= Start Page Title ===================== -->
<div class="page-title">
  <div class="container">
    <div class="page-caption">
      <h2>Add Job</h2>
      <p><a href="{{url('/')}}" title="Home">Home</a> <i class="ti-angle-double-right"></i><a href="{{route('employer.dashboard')}}" title="Home">Dashboard</a> <i class="ti-angle-double-right"></i> Edit Job</p>
    </div>
  </div>
</div>
<!-- ======================= End Page Title ===================== --> 

<!-- ======================= Create Job ===================== -->
<section class="create-job padd-top-80 padd-bot-80">
  <div class="container" data-aos="fade-up">
    <form class="c-form" action="{{ route('jobs.update', $job->id) }}" method="POST" enctype="multipart/form-data">
       @csrf
       @method('PUT')
      <!-- General Information -->
      <div class="box">
        <div class="box-header">
          <h4>General Information</h4>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
              <label>Job Title</label>
              <input type="text" class="form-control" value="{{ old('job_title', $job->job_title) }}" name="job_title" placeholder="Job Title" required>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
              <label>Company Name</label>
              <input type="text" class="form-control" name="company_name" value="{{ old('company_name', $job->company_name) }}" placeholder="Company Name">
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
              <label>Category</label>
              <select name="category" value="{{ old('job_title', $job->category) }}" class="wide form-control">
                <option data-display="Information Of Technology">Information Of Technology</option>
                <option value="1">Hardware</option>
                <option value="2">Machanical</option>
              </select>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 m-clear">
              <label>Description</label>
              <input type="text" class="form-control" value="{{ old('description', $job->description) }}" name=" description" placeholder="Description" required>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
              <label>Salary Range</label>
               <input type="text" class="form-control" name=" salary" value="{{ old('salary', $job->salary) }}" placeholder="100000XAF-150000XAF" required>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 m-clear">
              <label>No. Of Vacancy</label>
              <input type="text" class="form-control" name="vacancy" value="{{ old('vacancy', $job->vacancy) }}" placeholder="No. Of Vacancy">
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 m-clear">
              <label>Experience</label>
              <input type="text" class="form-control" value="{{ old('experience', $job->experience) }}" name="Experience" placeholder="Years of experience">
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 m-clear">
              <label>Company Logo</label>
              <div class="custom-file-upload">
                <input type="file" id="file" name="logo" value="{{ old('logo', $job->logo) }}" multiple />
              </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 m-clear">
              <label>Job Type</label>
              <select name="job_type" value="{{ old('job_title', $job->job_type) }}" class="wide form-control">
                <option data-display="Full Time">Full Time</option>
                <option value="Part Time">Part Time</option>
                <option value="Freelancer">Freelancer</option>
                <option value="Contract">Contract</option>
                <option value="Internship">Internship</option>
                <option value="Others5">Others</option>
              </select>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 m-clear">
              <label>Requirement</label>
              <input type="text" class="form-control" name="requirement" value="{{ old('requirement', $job->requirement) }}" placeholder="Requirement">
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label>Skills(Seperate with Comma)</label>
              <input type="text" class="form-control" name="skill" value="{{ old('skill', $job->skill) }}" placeholder="Skills">
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12 m-clear">
              <label>Proof of Business Existence</label>
              <div class="custom-file-upload">
                <input type="file" id="file" name="proof" value="{{ old('proof', $job->proof) }}" multiple />
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label>Deadline</label>
              <input type="date" class="form-control" name="deadline" value="{{ old('deadline', $job->deadline) }}" placeholder="Date">
            </div>
          </div>
        </div>
      </div>
      
      <!-- Company Address -->
      <div class="box">
        <div class="box-header">
          <h4>Company Address</h4>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
              <label>Email</label>
              <input type="email" class="form-control" name="email" value="{{ old('email', $job->email) }}" placeholder="Email">
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
              <label>Phone Number</label>
              <input type="text" class="form-control" name="phone" value="{{ old('phone', $job->phone) }}" placeholder="Phone Number">
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
              <label>Website Link</label>
              <input type="text" class="form-control" name="website" value="{{ old('website', $job->website) }}" placeholder="Website Link">
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
              <label>Address</label>
              <input type="text" class="form-control" name="address" value="{{ old('address', $job->address) }}" placeholder="Address">
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
              <label>Town</label>
              <input type="text" class="form-control" name="town" value="{{ old('town', $job->town) }}" placeholder="Address">
            </div>
          </div>
        </div>
      </div>
      
      <!-- Social Accounts -->
      <div class="box">
        <div class="box-header">
          <h4>Social Accounts</h4>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
              <label>Facebook</label>
              <input type="text" class="form-control" name="facebook" value="{{ old('facebook', $job->facebook) }}"placeholder="https://www.facebook.com/">
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
              <label>X</label>
              <input type="text" class="form-control" name="X" value="{{ old('x', $job->x) }}" placeholder="https://X.com/">
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
              <label>LinkedIn</label>
              <input type="text" class="form-control" name="linkedin" value="{{ old('linkedin', $job->linkedin) }}" placeholder="https://www.linkedin.com/">
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
              <label>Instagram</label>
              <input type="text" class="form-control" name="instagram" value="{{ old('instagram', $job->instagram) }}" placeholder="http://instagram.com/">
            </div>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="liabilityCheck" name="liability_check" required>
            <label class="form-check-label" for="liabilityCheck">
            I understand that if this job posting is found to be fraudulent or misleading, I may be held legally accountable and sued in a court of law.
            </label>
        </div>
      </div>
      <div class="text-center">
        <button type="submit" class="btn btn-m theme-btn full-width">Update</button>
      </div>
    </form>
  </div>
</section>
<!-- ====================== End Create Job ================ --> 

@endsection