@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="content">

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
                                        approved at
                                    </th>
                                    <td>
                                        {{ $proposal->approved_at ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                    rejected at
                                    </th>
                                    <td>
                                        {{ $proposal->rejected_at ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        job
                                    </th>
                                    <td>
                                        {{ $proposal->job->title ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        candidate
                                    </th>
                                    <td>
                                        {{ $proposal->candidate->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        proposal text
                                    </th>
                                    <td>
                                        {!! $proposal->proposal_text !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        budget
                                    </th>
                                    <td>
                                        {{ $proposal->budget }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        delivery time
                                    </th>
                                    <td>
                                        {{ $proposal->delivery_time }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        attachments
                                    </th>
                                    <td>
                                        {{ $proposal->attachments }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection