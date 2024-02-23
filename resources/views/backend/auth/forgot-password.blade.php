@extends('backend.auth.layouts.master')
@section('admin_title', 'Reset Password')

@section('content')

    <div class="auth-section">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h2"><b>Change</b>Password</a>
            </div>
            <div class="card-body">

                <p class="login-box-msg">Recover your password now.</p>

                <!-- Email Address -->
                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email"
                            class="{{ $errors->has('email') ? 'is-invalid form-control' : 'form-control' }}"
                            placeholder="Email" name="email" id="email" :value="old('email')">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    @error('email')
                        <p class="text-danger">{{ $message }} </p>
                    @enderror
                    <div class="row">
                        <div class="col-12">
                            <button type="submit"
                                class="btn btn-primary btn-block float-right">{{ __('Email Password Reset Link') }}</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
