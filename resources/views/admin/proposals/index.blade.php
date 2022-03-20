@extends('layouts.admin')

@section('content')
   <div class="container">
    <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex">
                <h6 class="m-0 font-weight-bold text-primary">
                    {{ __('Proposals') }}
                </h6>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>
                            job
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
                            Proposal 
                        </th>
                        <th class="text-center" style="width: 30px;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($proposals as $key => $proposal)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ $proposal->job->title ?? '' }}
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
                                        <a class="badge badge-info" href="{{ $media->getUrl() }}" target="_blank">
                                            view file
                                        </a>
                                    @endforeach
                                @endif
                            </td>
                            @if(!$proposal->rejected_at && !$proposal->approved_at )
                                <td>
                                    <span class="badge badge-warning">waiting...</span>
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
                            <td>
                                <div class="btn-group btn-group-sm">
                                    @can('proposal_show')
                                        <a href="{{ route('admin.proposals.show', $proposal) }}" class="btn btn-sm btn-success">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    @endcan
                                    @can('proposal_edit')
                                        <a href="{{ route('admin.proposals.edit', $proposal) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endcan
                                    @can('proposal_delete')
                                        <form onclick="return confirm('are you sure !')" action="{{ route('admin.proposals.destroy', $proposal) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                                    </form>
                                    @endcan
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
                                    {!! $proposals->appends(request()->all())->links() !!}
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
   </div>
@endsection
