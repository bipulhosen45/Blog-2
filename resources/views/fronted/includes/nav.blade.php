<header class="">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('front.index') }}">
                <h2 class=""><img src="{{ asset($setting?->main_logo) }}" height="60px" alt=""></h2>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('front.index') }}">{{ __('Home') }}
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">{{ __('About Us') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.all_post') }}">{{ __('Blog Entries') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.all_post') }}">{{ __('Post Details') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.contact') }}">{{ __('Contact Us') }}</a>
                    </li>

                    <!--
                    <ul class="float-end" style="">
                        <li class="nav-item">
                            {{-- <a href="" class="dropdown nav-link">Auth <i class="fas fa-arrow-down"></i></a> 
                <a class="nav-link" type="button" class="btn btn-success btn-sm" href="{{route('login')}}">Login</a> --}}

                            <div class="dropdown">
                                <a class="dropdown-toggle nav-link btn btn-secondary btn-sm" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ __('Profile') }}
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="nav-link btn btn-secondary btn-sm" href="{{ route('login') }}"> {{ __('Login') }} <i
                                                class="fas fa-right-to-bracket"></i></a></li>
                                    <li><a class="nav-link" href="{{ route('register') }}"> {{ __('Sign Up') }} <i
                                                class="fas fa-user-plus"></i></a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                -->
                </ul>
            
                @if(Auth::check())
                <div class="dropdown">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                        {{ Auth::user()->name }}
                    </button>
                    <div class="dropdown-menu p-4">
                      <div class="mb-3">
                        <label for="exampleDropdownFormEmail2" class="form-label"><a href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-user"></i> Profile</a></label>
                        
                      </div>
                      <div class="mb-3">
                        <li><a href="{{ route('logout') }}" class="text-danger" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa-solid fa-right-from-bracket"></i> Sign Out</a></li>
                            <form action="{{ route('logout') }}" id="logout-form" method="POST" style="display: none">
                                @csrf
                            </form>
                      </div>
                    </div>
                  </div>
                @endif
                @guest
                <div style="">
                    <div class="dropdown">
                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown"
                            aria-expanded="false" data-bs-auto-close="outside">
                            Login
                        </button>
                        <form action="{{ route('login') }}" method="POST" class="dropdown-menu p-4"
                            style="width: 250px; margin-left: -100%">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Email">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="password"
                                    placeholder="Password">
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="remember">
                                    <label class="form-check-label" for="remember">
                                        Remember me
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">{{ __('Login') }}</button>
                            <button type="submit" class="btn btn-info btn-sm" style="margin-left: 40px;">{{ __('Register Now') }}</button>

                            <a href="{{ route('password.email') }}" type=""
                                class="ml-5 mt-3 d-block justify-content-center text-center text-danger">{{ __('Forgot Password') }}</a>
                        </form>
                    </div>
                </div>
                @endguest
            </div>
        </div>
        <div class="switch-language" style="margin-right: 5px;">
            <form action="" method="GET" id="switch_language_form">
                <select name="lang" class="form-select form-select-sm" id="switch_language">
                    <option value="en">EN</option>
                    <option value="bn">BN</option>
                </select>
            </form>
        </div>
    </nav>

     <!-- Modal -->
     <div class="modal fade" id="exampleModal" tabindex="1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header bg-primary">
                 <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                 <button type="button" class="btn-close" data-bs-dismiss="modal"
                     aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <form action="{{ route('register') }}" method="POST">
                     @csrf
                     <!-- Name -->
                     <div class="input-group mb-3">
                      <input type="text" class="{{ $errors->has('name') ? 'is-invalid form-control' : 'form-control' }}" placeholder="Full name" name="name" required>
                      <span class="input-group-text " id="basic-addon2"><i class="fas fa-user"></i></span>
                      @error('name')
                        <p class="text-danger">{{ $message }} </p>
                      @enderror
                  </div>
                     <!-- Email Address -->
                     <div class="input-group mb-3">
                      <input type="text" class="{{ $errors->has('email') ? 'is-invalid form-control' : 'form-control' }}" placeholder="Email" name="email" required>
                      <span class="input-group-text " id="basic-addon2"><i class="fas fa-envelope"></i></span>
                      @error('email')
                        <p class="text-danger">{{ $message }} </p>
                      @enderror
                  </div>
                     <!-- Password Address -->
                  <div class="input-group mb-3">
                      <input type="text" class="{{ $errors->has('password') ? 'is-invalid form-control' : 'form-control' }}" placeholder="Password" name="password" required>
                      <span class="input-group-text " id="basic-addon2"><i class="fas fa-lock"></i></span>
                      @error('password')
                        <p class="text-danger">{{ $message }} </p>
                      @enderror
                  </div>
                     <!-- Confirm Password Address -->
                     <div class="input-group mb-3">
                      <input type="text" class="{{ $errors->has('password_confirmation') ? 'is-invalid form-control' : 'form-control' }}" placeholder="Confirmation password" name="password_confirmation" required>
                      <span class="input-group-text " id="basic-addon2"><i class="fas fa-lock"></i></span>
                      @error('password_confirmation')
                        <p class="text-danger">{{ $message }} </p>
                      @enderror
                  </div>

                     <div class="row">
                         <div class="col-8 mb-2">
                             <div class="icheck-primary">
                                 <input type="checkbox" id="agreeTerms" name="terms"
                                     value="agree">
                                 <label for="agreeTerms">
                                     I agree to the <a href="#">terms</a>
                                 </label>
                             </div>
                         </div>
                         <!-- /.col -->
                         <!-- /.col -->
                     </div>
                     <div class="modal-footer">
                         <button type="submit" class="btn btn-primary">Register</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
 {{-- sign up modal end --}}
</header>




@push('js')
    <script>
        if (localStorage.lang == 'bn') {
            $('#switch_language').val('bn')
        } else {
            $('#switch_language').val('en')
        }
        $('#switch_language').on('change', function(e) {
            e.preventDefault();
            localStorage.lang = $(this).val();
            $('#switch_language_form').submit()
        })
    </script>
@endpush
