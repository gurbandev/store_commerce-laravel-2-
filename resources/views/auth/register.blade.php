@extends('layouts.app')
@section('title')
    @lang('app.register')
@endsection
@section('content')
    <div class="container-lg py-3">
        <div class="row justify-content-center">
            <div class="col-10 col-sm-9 col-md-8 col-lg-7 col-xl-6 col-xxl-5">
                <div class="h3 text-center mb-3">
                    @lang('app.register')
                </div>

                <form action="{{ route('register') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">
                            @lang('app.name')
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" required autofocus>
                        @error('name')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label fw-semibold">
                            @lang('app.username')
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" required>
                        @error('username')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">
                            @lang('app.password')
                            <span class="text-danger">*</span>
                        </label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" required>
                        @error('password')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label fw-semibold">
                            @lang('app.passwordConfirmation')
                            <span class="text-danger">*</span>
                        </label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" required>
                        @error('password_confirmation')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        @lang('app.register')
                    </button>
                </form>

                <div class="text-center mt-3">
                    <a href="{{ route('login') }}">@lang('app.alreadyRegistered')</a>
                </div>
            </div>
        </div>
    </div>
@endsection