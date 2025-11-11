@extends('layouts.limitless')
@section('title', 'Users')
@section('content')
    <div class="content">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Create Location</h5>
                <small class="text-muted">Vertical form layout</small>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('locations.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input id="name" name="name" value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Enter location name.</div>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input id="address" name="address" value="{{ old('address') }}"
                            class="form-control @error('address') is-invalid @enderror">
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Street, building, etc.</div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="latitude" class="form-label">Latitude</label>
                            <input id="latitude" name="latitude" value="{{ old('latitude') }}"
                                class="form-control @error('latitude') is-invalid @enderror">
                            @error('latitude')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">e.g. 10.762622</div>
                        </div>

                        <div class="col-md-6">
                            <label for="longitude" class="form-label">Longitude</label>
                            <input id="longitude" name="longitude" value="{{ old('longitude') }}"
                                class="form-control @error('longitude') is-invalid @enderror">
                            @error('longitude')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">e.g. 106.660172</div>
                        </div>
                    </div>

                    <div class="mb-3 mt-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" name="description" rows="4"
                            class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a href="{{ route('locations.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Create Location</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
