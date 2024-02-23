

@extends('backend.admin-layouts.app')

@section('admin_content')
<body class="hold-transition login-page">
    <div class="login-box mt-5" style="margin-left: 560px;">
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <a href="{{route('admin.dashboard')}}" class="h1"><b>Admin</b>BLOG</a>
        </div>
        <div class="card-body">
          <p class="login-box-msg">This is a secure area of the application. Please confirm your password before continuing.</p>

          <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
           
    <!-- Email Address -->
          <form action="{{ route('password.confirm') }}" method="POST">
            @csrf
           <!-- Password Address -->
           <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" id="password" required autocomplete="current-password" >
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block float-right">Confirm Password</button>
              </div>
              <!-- /.col -->
            </div>
          </form>

        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->
    
    </body>
@endsection

