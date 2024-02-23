@extends('backend.admin-layouts.app')
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/custom/style.css">

    <style>
        td img {
            width: 100px !important;
            height: 40px !important;
            cursor: pointer !important;
        }
    </style>
@endpush

@section('admin_content')
    <!-- Main content -->
    <div class="row mb-2">
      <div class="col-sm-6" style="margin-top: -5%">
        <h1 class="m-0" >Website Setting</h1>
      </div><!-- /.col -->
    </div>
    
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row justify-content-center">
          <div class="col-10">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Website Setting</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{route('website.setting.update',$setting?->id)}}" method="Post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Currency</label>
                         <select class="form-control" name="currency">
                            <option value="৳" {{ ($setting->currency == '৳') ? 'selected': '' }} >Taka (৳)</option>
                            <option value="$" {{ ($setting->currency == '$') ? 'selected': '' }}>USD ($)</option>
                           <option value="₹" {{ ($setting->currency == '₹') ? 'selected': '' }}>Rupee (₹)</option>
                         </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Phone One</label>
                        <input type="text" class="form-control" name="phone_one" value="{{$setting->phone_one}}" required="">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Phone Two</label>
                        <input type="text" class="form-control" name="phone_two" value="{{$setting->phone_two}}" required="">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Main Email</label>
                        <input type="email" class="form-control" name="main_email" value="{{$setting->main_email}}" >
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Support Email</label>
                        <input type="email" class="form-control" name="support_email" value="{{$setting->support_email}}" >
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">   
                        <label for="exampleInputEmail1">Address</label>
                        <input type="text" class="form-control" name="address" value="{{$setting->address}}" >
                      </div>
                    </div>
                    <strong class="text-danger justify-content-center text-center d-flex my-3">-----------------Social Link-----------------</strong>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Facebook</label>
                        <input type="text" class="form-control" name="facebook" value="{{$setting->facebook}}" >
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Twitter</label>
                        <input type="text" class="form-control" name="twitter" value="{{$setting->twitter}}" >
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Instagram</label>
                        <input type="text" class="form-control" name="instagram" value="{{$setting->instagram}}" >
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Linkedin</label>
                        <input type="text" class="form-control" name="linkedin" value="{{$setting->linkedin}}" >
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Youtube</label>
                        <input type="text" class="form-control" name="youtube" value="{{$setting->youtube}}" >
                      </div>
                    </div>
                    <strong class="text-danger justify-content-center text-center d-flex my-3">-----------------Logo & Favicon-----------------</strong>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Main Logo</label>
                        <div><img src="{{asset($setting->main_logo)}}" width="280" height="60" alt=""></div>
                        <input type="file" class="form-control" name="main_logo" >
                        <input type="hidden" name="old_logo" value="{{$setting->main_logo}}">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Favicon</label>
                        <div><img src="{{asset($setting->favicon)}}" width="120" height="60" alt=""></div>
                        <input type="file" class="form-control" name="favicon">
                        <input type="hidden" name="old_favicon" value="{{$setting->favicon}}">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer justify-content-center text-center">
                  <button type="submit" class="btn btn-primary btn-lg">Update Website</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
@endsection
