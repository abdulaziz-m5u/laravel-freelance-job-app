@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex">
                <h6 class="m-0 font-weight-bold text-primary">
                    {{ $country->name }}
                </h6>
                <div class="ml-auto">
                    <a href="{{ route('admin.countries.index') }}" class="btn btn-primary">
                        <span class="text">Back to countries</span>
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Short Code</th>
                        <th>Created at</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $country->name }}</td>
                        <td>{{ $country->short_code ?? '' }}</td>
                        <td>{{ $country->created_at }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
