@extends('backend.admin-layouts.app')

@section('page_title', 'User List')
@section('header', 'User List')

@include('backend.includes.topbar')
@include('backend.includes.sidebar')

@section('admin_content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Profile Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <div class="d-grid ">
                                <h1 class="card-title">Profile</h1>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('user.profile.update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ Auth::user()->name }}" name="name" id="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="division_id">Division</label>
                                            {{-- <select name="division_id" class="form-control" null id="division_id">
                                                <option value="">Select Division</option>
                                                @foreach ($divisions as $row)
                                                 <option value="division_id">{{ $row }}</option>
                                                @endforeach
                                            </select> --}}
                                            
                                            {!! Form::select('division_id', $divisions, null, ['id' => 'division_id', 'class' => 'form-control',
                                            'placeholder' => 'Select Division',
                                        ]) !!}
                                        </div>
                                        <div class="form-group">
                                            <label for="district_id">District</label>
                                            <select name="district_id" id="district_id" class="form-control" disabled>
                                                <option value="{{Auth::user()->district_id}}">Select District</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="thana_id">State</label>
                                                <select name="thana_id" class="form-control" disabled id="thana_id">
                                                    <option value="{{Auth::user()->thanas_id}}">Select State</option>
                                                </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <textarea type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address">{{ Auth::user()->address }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ Auth::user()->phone }}" name="phone" id="phone">
                                        </div>
                                        <div class="form-group">
                                            <label for="gender" class="d-block" style="margin-right: 20px!important;">Gender: </label>
                                            <div class="form-check form-check-inline mt-2">
                                                <input class="form-check-input" type="radio" name="gender" id="male" value="1" @if (Auth::user()->gender == '1') checked @endif>
                                                <label class="form-check-label" for="male">Male</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="female"
                                                    value="2" @if (Auth::user()->gender == '2') checked @endif>
                                                <label class="form-check-label" for="female">Female</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="others"
                                                    value="3" @if (Auth::user()->gender == '3') checked @endif>
                                                <label class="form-check-label" for="others">Others</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            <div><img src="{{asset(Auth::user()->image)}}" width="90" height="90" alt=""></div>
                                            <input type="file" class="form-control @error('image') is-invalid @enderror" value="{{ Auth::user()->image }}" name="image" id="image">
                                             <input type="hidden" name="old_image" id="{{Auth::user()->image}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>


                        </div>

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@php
if ($data) {
    $user_exists = 1;
} else {
    $user_exists = 0;
}
@endphp

@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
           // get district
           const getDistricts = (division_id, selected = null) => {
            axios.get(`${window.location.origin}/get-districts/${division_id}`).then(res => {
                let districts = res.data
                let element = $('#district_id')
                let thana_element = $('#thana_id').empty().append(`<option>Select Thana</option>`).attr('disabled', 'disabled')
                element.removeAttr('disabled')
                element.empty()
                element.append(`<option>Select District</option>`)
                districts.map((district, index) => {
                    element.append(`<option value="${district.id}" ${selected == district.id ? 'selected' : '' }>${district.name}</option>`)
                })

            })
        }
        // get thana
        const getThanas = (district_id, selected = null) => {
            axios.get(`${window.location.origin}/get-thanas/${district_id}`).then(res => {
                let thanas = res.data
                let element = $('#thana_id')
                element.removeAttr('disabled')
                element.empty()
                element.append(`<option>Select Thana</option>`)
                thanas.map((thana, index) => {
                    element.append(`<option value="${thana.id}" ${selected == thana.id ? 'selected' : '' }>${thana.name}</option>`)
                })

            })
        }

        $('#division_id').on('change', function() {
            getDistricts($(this).val());
        })
        $('#district_id').on('change', function() {
            getThanas($(this).val());
        })

        if ('{{ $user_exists }}' == 1) {
            getDistricts('{{ $data?->division_id }}', {{ $data?->district_id }})
            getThanas('{{ $data?->district_id }}', {{ $data?->thana_id }})
        }
    </script>
@endpush