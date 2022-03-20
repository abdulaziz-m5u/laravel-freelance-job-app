@extends('layouts.admin')
@section('content')
<div class="container">
<div class="card">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-header">
                    show title
                </div>
                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>
                                employer
                                </th>
                                <td>
                                    {{ $job->employer->name ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    candidate
                                </th>
                                <td>
                                    {{ $job->candidate->name ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    title
                                </th>
                                <td>
                                    {{ $job->title }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    description
                                </th>
                                <td>
                                    {!! $job->description !!}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    budget
                                </th>
                                <td>
                                    {{ $job->budget }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    delivery date
                                </th>
                                <td>
                                    {{ $job->delivery_date }}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="card card">
                <div class="card-header">
                    title
                </div>
                <div class="card-body">

                    <table class=" table table-bordered table-striped table-hover datatable">
                        <thead>
                        <tr>
                            <th>
                                candidate
                            </th>
                            <th>
                                proposal text
                            </th>
                            <th>
                                budget
                            </th>
                            <th>
                                delivery time
                            </th>
                            <th>
                                attachments
                            </th>
                            <th>
                                action
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($job->proposals as $key => $proposal)
                            <tr data-entry-id="{{ $proposal->id }}">
                                <td>
                                    {{ $proposal->candidate->name ?? '' }}
                                </td>
                                <td>
                                    {{ $proposal->proposal_text ?? '' }}
                                </td>
                                <td>
                                    {{ $proposal->budget ?? '' }}
                                </td>
                                <td>
                                    {{ $proposal->delivery_time ?? '' }}
                                </td>
                                <td>
                                    @if($proposal->attachments)
                                        @foreach($proposal->attachments as $key => $media)
                                            <a class="badge badge-success" href="{{ route('admin.proposals.downloadMedia', $media) }}" target="_blank">
                                                view file
                                            </a>
                                        @endforeach
                                    @endif
                                </td>
                                
                                @if(!$proposal->approved_at && !$proposal->rejected_at)
                                <td>
                                    @can('job_create')
                                        <form action="{{ route('admin.jobs.update', $job->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="candidate_id" value="{{ $proposal->candidate_id }}" />
                                            <input type="submit" class="btn btn-xs btn-primary"
                                                value="hire this candidate" />
                                        </form>
                                    @endcan
                                </td>
                                @elseif(!$proposal->approved_at)
                                <td>
                                    <span class="badge badge-danger">rejected</span>
                                </td>
                                @else
                                <td>
                                    <span class="badge badge-success">selected</span>
                                </td>
                                @endif                       

                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>


        </div>
    </div>
</div>  
</div>
@endsection