<?php

namespace App\Http\Controllers\Admin;

use App\Models\Job;
use App\Models\Proposal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\JobRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Traits\MediaUploading;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class JobController extends Controller
{
    use MediaUploading;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Media $mediaItem)
    {
        abort_if(Gate::denies('job_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if (auth()->user()->isEmployer()) {
            $jobs = Job::where('employer_id', auth()->id())->paginate(5);
        } else {
            $jobs = Job::whereNull('candidate_id')->paginate(5);
        }

        return view('admin.jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobRequest $request)
    {
        $job = Job::create($request->validated() + ['employer_id' => auth()->id()]);

        foreach ($request->input('attachments', []) as $file) {
            $job->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('attachments');
        }

        return redirect()->route('admin.jobs.index')->with([
            'message' => 'success created !',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        if ($job->employer_id != auth()->id()) {
            abort(404);
        }

        $job->load(['employer', 'candidate', 'proposals']);

        return view('admin.jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        return view('admin.jobs.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Job $job)
    {
        if ($job->employer_id != auth()->id()) {
            abort(404);
        }
        
        $job->update($request->all());

        if (isset($request->candidate_id)) {
            Proposal::where('job_id', $job->id)->where('candidate_id', $request->candidate_id)
                ->update(['approved_at' => now()]);
            Proposal::where('job_id', $job->id)->where('candidate_id', '!=', $request->candidate_id)
                ->update(['rejected_at' => now()]);
        }

        return redirect()->route('admin.jobs.index')->with([
            'message' => 'success updated !',
            'alert-type' => 'info'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        $job->delete();

        return back()->with([
            'message' => 'success deleted !',
            'alert-type' => 'danger'
        ]);;
    }

    public function downloadMedia(Media $mediaItem)
    {
        return $mediaItem;
    }
}
