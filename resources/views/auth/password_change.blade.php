@extends('backend.admin-layouts.app')

@section('admin_content')

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Admin Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/') }}">Home</a>
                            </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                <!-- Info boxes -->
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Change Your Password</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{route('admin.password.update')}}" method="post" >
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Old Password</label>
                                        <input type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" id="exampleInputEmail1" placeholder="old password">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword2">New Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="exampleInputPassword2" placeholder="new Password">
                                    </div>
                                    @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group">
                                        <label for="exampleInputPassword3">Confirm Password</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" id="exampleInputPassword3" placeholder="confirm Password">
                                    </div>
                                    
                                   
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update Password</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->

                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
