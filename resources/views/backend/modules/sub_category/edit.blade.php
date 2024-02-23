@extends('backend.admin-layouts.app')

@section('page_title', 'Edit | Sub Category')
@section('header', 'Sub Category')

@push('css')
@endpush

@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h1 class="card-title">Edit Sub Category</h1>

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

                    <form action="{{route('sub-category.update', $sub_category->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Sub Category Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{$sub_category->name}}">
                            </div>
                            <div class="form-group">
                                <label for="category_id">Select Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}" @if ($sub_category->category_id == $category->id) selected @endif>{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="order_by">Category Serial</label>
                                <input type="number" class="form-control" name="order_by" id="order_by" value="{{$sub_category->order_by}}">
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control" id="status" >
                                  <option name="status" value="status">{{$sub_category->status == 1? 'Active': 'Inactive'}}</option>
                                  <option name="status" value="status">{{$sub_category->status == 0? 'Active': 'Inactive'}}</option>
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
                            <a href="{{ route('sub-category.index') }}" class="btn btn-warning float-right mx-2"><i
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

