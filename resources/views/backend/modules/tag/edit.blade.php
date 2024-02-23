@extends('backend.admin-layouts.app')

@section('page_title', 'Edit | Tag')
@section('header', 'Tag')

@push('css')
@endpush

@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h1 class="card-title">Edit Tag</h1>

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

                    <form action="{{route('tag.update', $tag->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Tag Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{$tag->name}}">
                            </div>
                            <div class="form-group">
                                <label for="order_by">Tag Serial</label>
                                <input type="number" class="form-control" name="order_by" id="order_by" value="{{$tag->order_by}}">
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control" id="status" >
                                  <option name="status" value="status">{{$tag->status == 1? 'Active': 'Inactive'}}</option>
                                  <option name="status" value="status">{{$tag->status == 0? 'Active': 'Inactive'}}</option>
                                </select>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <input type="submit" class="btn btn-primary float-right" value="Update">
                            <a href="{{ route('tag.index') }}" class="btn btn-warning float-right mx-2"><i
                                    class="fas fa-arrow-circle-left"></i></a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- bs-custom-file-input -->
    <script src="{{ asset('backend') }}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>


    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
@endpush

