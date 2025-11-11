@extends('layouts.limitless')
@section('title', 'Users')
@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">User list</h5>
                </div>
                <div class="card-body">
                    @if ($users->count() === 0)
                        <div class="text-muted">No users found.</div>
                    @else
                        <div class="row g-3">
                            @foreach ($users as $user)
                                <div class="col-12 col-md-6 col-xl-4">
                                    <div class="card h-100">
                                        <div class="card-body d-flex">
                                            <div class="me-3">
                                                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center"
                                                    style="width:48px;height:48px;">
                                                    <i class="ph-user fs-4"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">{{ $user->name }}</h6>
                                                <div class="text-muted small">{{ $user->email }}</div>
                                                <div class="d-flex align-items-center mt-2 small">
                                                    <span class="me-3">Joined:
                                                        {{ $user->created_at->format('d M Y') }}</span>
                                                    @if ($user->email_verified_at)
                                                        <span
                                                            class="badge bg-success bg-opacity-10 text-success">Verified</span>
                                                    @else
                                                        <span
                                                            class="badge bg-warning bg-opacity-10 text-warning">Unverified</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-3">
                            {{ $users->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
