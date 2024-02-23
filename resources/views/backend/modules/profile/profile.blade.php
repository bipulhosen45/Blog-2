@extends('backend.admin-layouts.app')

@section('page_title', 'Create & Update | Profile')
@section('header', 'Profile')

@push('css')
    <link rel="stylesheet" href="{{ asset('backend') }}/dropify/dist/css/dropify.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
@endpush

@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h1 class="card-title">Profile</h1>

                        <div class="float-right d-none d-sm-inline-block">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-info">Home</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('profile.store') }}" method="POST" model="{{ $profile }}" enctype="multipart/form-data">
                        {!! Form::model($profile, ['method'=>'post', 'route'=>'profile.store']) !!}
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Input phone" value="{{$profile->phone}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea name="address" id="address" class="form-control" placeholder="Input Address">{{$profile->address}}</textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="division_id">Division</label>
                                                {!! Form::select('division_id', $divisions, null, ['id' => 'division_id', 'class' => 'form-control',
                                                    'placeholder' => 'Select Division',
                                                ]) !!}
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="district_id">District</label>
                                                <select name="district_id" id="district_id" disabled class="form-control">
                                                    <option value="">Select District</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="thana_id">Upazilla</label>
                                                <select name="thana_id" class="form-control" disabled id="thana_id">
                                                    <option value="">Select Thana</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="gender" class="d-block" style="margin-right: 20px!important;">Gender: </label>
                                            <div class="form-check form-check-inline mt-2">
                                                <input class="form-check-input" type="radio" name="gender" id="male" value="male" @if ($profile->gender=='male') selected @endif>
                                                <label class="form-check-label" for="male">Male</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="female" value="female" @if ($profile->gender=='female') selected @endif>
                                                <label class="form-check-label" for="female">Female</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" id="others" value="others" @if ($profile->gender=='others') selected @endif>
                                                <label class="form-check-label" for="others">Others</label>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="image">Upload Profile Image <span class="text-danger">*</span></label>
                                        <p id="error_message" class="text-danger"></p>
                                        <input type="file" name="image" data-max-file-size="2M" data-allowed-file-extensions="jpg png jpeg webp" class="form-control dropify" id="image_input">
                                        <button class="btn btn-success mt-2" id="image_upload_button">Upload Image</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- /.card-body -->

                        <div class="card-footer">
                            <input type="submit" class="btn btn-primary float-right" value="Submit">
                            <a href="{{ route('profile.index') }}" class="btn btn-warning float-right mx-2"><i
                                    class="fas fa-arrow-circle-left"> </i> Back</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    @php
        if ($profile) {
            $profile_exists = 1;
        } else {
            $profile_exists = 0;
        }
    @endphp
@endsection

@push('js')
    <!-- page require js load here... -->
    <script src="{{ asset('backend') }}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script src="{{ asset('backend') }}/dropify/dist/js/dropify.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/select2/js/select2.min.js"></script>

    <script>
         let photo
        $('#image_input').on('change', function(e) {
            let file = e.target.files[0]
            let reader = new FileReader()
            reader.onloadend = () => {
                photo = reader.result
                $('$image_preview').attr('src', photo)
            }
            reader.readAsDataURL(file)
            
        })
        $('#image_upload_button').on('click', function() {
            if (photo != undefined) {
                $('#error_message').text('')

                axios.post(`${window.location.origin}/dashboard/upload-photo`, {photo: photo}).then(res => {
                    console.log(res.data)
                })

            } else {
                $('#error_message').text('Please Select a Image')
            }
        })
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
        // profile for previous data show
        if ('{{ $profile_exists }}' == 1) {
            getDistricts('{{ $profile?->division_id }}', {{ $profile?->district_id }})
            getThanas('{{ $profile?->district_id }}', {{ $profile?->thana_id }})
        }
    </script>


    // profile image uploaded require
 

    // dpopify & select 
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
            $('.select2').select2();
        });
    
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
@endpush
