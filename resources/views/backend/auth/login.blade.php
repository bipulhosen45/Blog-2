@extends('backend.auth.layouts.master')
@section('admin_title', 'Login')

@section('content')

    <div class="auth-section">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h2"><b>Admin</b>MediTips</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email"
                            class="{{ $errors->has('email') ? 'is-invalid form-control' : 'form-control' }}" name="email"
                            id="email" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    @error('email')
                        <p class="text-danger">{{ $message }} </p>
                    @enderror
                    <div class="input-group mb-3">
                        <input type="password"
                            class="{{ $errors->has('password') ? 'is-invalid form-control' : 'form-control' }}"
                            name="password" id="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @error('password')
                        <p class="text-danger">{{ $message }} </p>
                    @enderror
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <!-- /.col -->
                    </div>
                    <div class="d-grid mt-3">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                </form>

                <p class="mb-1 mt-2 text-center">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-danger">Forgot password</a>
                    @endif
                </p>
                <p class="mb-0 text-center">
                    <a href="{{ route('register') }}" class="text-center fa fa-sign-in">New Register</a>
                </p>
            </div>
        </div>
    </div>
@endsection
