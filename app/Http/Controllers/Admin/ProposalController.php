<?php

namespace App\Http\Controllers\Admin;

use App\Models\Proposal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProposalRequest;
use App\Http\Controllers\Traits\MediaUploading;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProposalController extends Controller
{
    use MediaUploading;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proposals = Proposal::with('job','candidate')->where('candidate_id', auth()->id())->paginate(5);

        return view('admin.proposals.index', compact('proposals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.proposals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProposalRequest $request)
    {
        $proposal = Proposal::create($request->validated() + ['candidate_id' => auth()->id()]);
        
        foreach ($request->input('attachments', []) as $file) {
            $proposal->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('attachments');
        }

        return redirect()->route('admin.proposals.index')->with([
            'message' => 'success created !',
            'alert-type' => 'success'
        ]);;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Proposal $proposal)
    {
        $proposal->load('job', 'candidate');

        return view('admin.proposals.show', compact('proposal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Proposal $proposal)
    {
        return view('admin.proposals.edit', compact('proposal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProposalRequest $request, Proposal $proposal)
    {
        $proposal->update($request->validated() + ['candidate_id' => auth()->id()]);

        return redirect()->route('admin.proposals.index')->with([
            'message' => 'success updated !',
            'alert-type' => 'info'
        ]);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proposal $proposal)
    {
        $proposal->delete();

        return back()->with([
            'message' => 'success deleted !',
            'alert-type' => 'danger'
        ]);;;
    }

    public function downloadMedia(Media $mediaItem)
    {
        return $mediaItem;
    }
}
