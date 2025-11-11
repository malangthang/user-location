@extends('layouts.limitless')
@section('title','Register')
@section('content')
    <div class="content d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 136px);">
        <form class="login-form" method="POST" action="{{ route('register') }}" style="min-width:360px">
            @csrf
            <div class="card mb-0">
                <div class="card-body">
                    <div class="text-center mb-3">
                        <h5 class="mb-0">Create your account</h5>
                        <span class="d-block text-muted">Fill the information below</span>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus autocomplete="name">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required autocomplete="username">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input id="password" type="password" name="password" class="form-control" required autocomplete="new-password">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required autocomplete="new-password">
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary w-100">Register</button>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('login') }}">Already have an account? Sign in</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
