@extends('layouts.limitless')
@section('title','Edit Location')
@section('content')
<div class="page-content">
    <div class="content-wrapper">
        <div class="content">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="mb-0">Edit Location</h5>
                    <a href="{{ route('locations.index') }}" class="btn btn-outline-secondary">Back</a>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="form-vertical" method="post" action="{{ route('locations.update', $location) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $location->name) }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" value="{{ old('address', $location->address) }}">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Latitude</label>
                                <input type="number" step="0.0000001" name="latitude" class="form-control" value="{{ old('latitude', $location->latitude) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Longitude</label>
                                <input type="number" step="0.0000001" name="longitude" class="form-control" value="{{ old('longitude', $location->longitude) }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Type</label>
                            <input type="text" name="type" class="form-control" value="{{ old('type', $location->type) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="1" {{ old('status', (string)$location->status) == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status', (string)$location->status) == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
