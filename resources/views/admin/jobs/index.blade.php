@extends('layouts.admin')

@section('content')
   <div class="container">
    <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex">
                <h6 class="m-0 font-weight-bold text-primary">
                    {{ __('Jobs') }}
                </h6>
                <div class="ml-auto">
                @can('job_create')
                    <a href="{{ route('admin.jobs.create') }}" class="btn btn-primary">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus"></i>
                        </span>
                        <span class="text">{{ __('New job') }}</span>
                    </a>
                @endcan
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        </th>
                            @if (!auth()->user()->isEmployer())
                            <th>
                                employer
                            </th>
                            @endif
                        @if (!auth()->user()->isCandidate())
                            <th>
                                candidate
                            </th>
                        @endif
                        <th>
                            title
                        </th>
                        <th>
                            description
                        </th>
                        <th>
                            budget
                        </th>
                        <th>
                            attachments
                        </th>
                        <th>
                            delivery_date
                        </th>
                        <th class="text-center" style="width: 30px;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($jobs as $job)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            </td>
                            @if (!auth()->user()->isEmployer())
                                <td>
                                    {{ $job->employer->name ?? '' }}
                                </td>
                            @endif
                            @if (!auth()->user()->isCandidate())
                                <td>
                                    {{ $job->candidate->name ?? '' }}
                                </td>
                            @endif
                            <td>
                                {{ $job->title ?? '' }}
                            </td>
                            <td>
                                {{ $job->description ?? '' }}
                            </td>
                            <td>
                                {{ $job->budget ?? '' }}
                            </td>
                            <td>
                            @if($job->attachments)
                                @foreach($job->attachments as $key => $media)
                                    <a class="badge badge-success" href="{{ route('admin.jobs.downloadMedia', $media) }}" target="_blank">
                                        view file
                                    </a>
                                @endforeach
                            @endif
                            </td>
                            <td>
                                {{ $job->delivery_date ?? '' }}
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    @can('job_show')
                                        <a class="btn btn-xs btn-success" href="{{ route('admin.jobs.show', $job->id) }}">
                                        pro({{ $job->proposals->count() }})
                                        </a>
                                    @endcan
                                    @can('job_edit')
                                    <a href="{{ route('admin.jobs.edit', $job) }}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    @endcan
                                    @can('job_delete')
                                    <form onclick="return confirm('are you sure !')" action="{{ route('admin.jobs.destroy', $job) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                                    </form>
                                    @endcan
                                    @if (auth()->user()->isCandidate())
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.proposals.create') }}?job_id={{ $job->id }}">
                                            create proposal
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="9">No categories found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="9">
                                <div class="float-right">
                                    {!! $jobs->appends(request()->all())->links() !!}
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
   </div>
@endsection
