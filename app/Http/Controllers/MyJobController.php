<?php

 namespace App\Http\Controllers;

 use Illuminate\Http\Request;
 use App\Models\Job;
 use App\Models\JobApplication;
 use App\Models\User;
 use App\Http\Requests\JobRequest;
 use Illuminate\Support\Facades\Storage;


 class MyJobController extends Controller
 {
     /**
      * Display a listing of the resource.
      */
     public function index()
     {
        $this->authorize('viewAnyEmployer', Job::class);
        return view(
            'my_job.index',
            [
                'jobs' => auth()->user()->employer
                    ->jobs()
                    ->with(['employer', 'jobApplications', 'jobApplications.user'])
                    ->withTrashed()
                    ->get()
            ]
        );
     }

     /**
      * Show the form for creating a new resource.
      */
     public function create()
     {
        $this->authorize('create', Job::class);
        return view('my_job.create');
     }

     /**
      * Store a newly created resource in storage.
      */
      public function store(JobRequest $request)
     {

        $this->authorize('create', Job::class);
        auth()->user()->employer->jobs()->create($request->validated());

        return redirect()->route('my-jobs.index')
            ->with('success', 'Job created successfully.');
     }


      public function edit(Job $myJob)
     {
        $this->authorize('update', $myJob);
        return view('my_job.edit', ['job' => $myJob]);
     }

     /**
      * Update the specified resource in storage.
      */
      public function update(JobRequest $request, Job $myJob)
     {
        $this->authorize('update', $myJob);
        $myJob->update($request->validated());

        return redirect()->route('my-jobs.index')
            ->with('success', 'Job updated successfully.');
     }


     public function destroy(Job $myJob)
     {
        $myJob->delete();

        return redirect()->route('my-jobs.index')
            ->with('success', 'Job deleted.');
     }




    }
