@extends('backend.auth.layouts.master')
@section('admin_title', 'Reset Password')

@section('content')


@section('content')
    <div class="auth-section">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h2"><b>New</b>Password</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Please enter your new password</p>

                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- email -->
                    <div class="input-group mb-3">
                        <input type="email"
                            class="{{ $errors->has('email') ? 'is-invalid form-control' : 'form-control' }}" name="email"
                            id="email" value="{{ $request->email }}">
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                        </div>
                        @error('email')
                            <p class="text-danger">{{ $message }} </p>
                        @enderror
                    </div>
                    <!-- Password -->
                    <div class="input-group mb-3">
                        <input type="password"
                            class="{{ $errors->has('Password') ? 'is-invalid form-control' : 'form-control' }}"
                            name="password" id="password" placeholder="New Password">
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-lock"></span></div>
                        </div>
                        @error('password')
                            <p class="text-danger">{{ $message }} </p>
                        @enderror
                    </div>
                    <!-- confirm Password -->
                    <div class="input-group mb-3">
                        <input type="password"
                            class="{{ $errors->has('password_confirmation') ? 'is-invalid form-control' : 'form-control' }}"
                            id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-lock"></span></div>
                        </div>
                        @error('password_confirmation')
                            <p class="text-danger">{{ $message }} </p>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Update password</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
