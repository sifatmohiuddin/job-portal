<?php

 namespace App\Http\Controllers;

 use Illuminate\Http\Request;
 use App\Models\JobApplication;
 use App\Models\Employer;
 use App\Models\User;


 class MyJobApplicationController extends Controller
 {
     public function index()
     {
         return view(
             'my_job_application.index',
             [
                 'applications' => auth()->user()->jobApplications()
                 ->with([
                    'job' => fn($query) => $query->withCount('jobApplications')
                    ->withAvg('jobApplications', 'expected_salary')
                    ->withTrashed(),
                    'job.employer'
                ])
                     ->latest()->get()
             ]
         );
     }

     public function destroy(JobApplication $myJobApplication)
     {
         //
         $myJobApplication->delete();

         return redirect()->back()->with(
             'success',
             'Job application removed.'
         );
     }
 }
