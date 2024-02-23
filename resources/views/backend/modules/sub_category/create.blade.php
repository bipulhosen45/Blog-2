@extends('backend.admin-layouts.app')

@section('page_title', 'Create | Sub category')
@section('header', 'Sub category')

@push('css')
@endpush

@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h1 class="card-title">Create Sub category</h1>

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

                    <form action="{{route('sub-category.store')}}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Sub Category Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Input your sub category">
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="text" class="form-control" name="slug" id="slug">
                            </div>
                            <div class="form-group">
                                <label for="category_id">Select Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="order_by">Sub category Serial</label>
                                <input type="number" class="form-control" name="order_by" id="order_by" placeholder="Enter sub-category serial">
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                {!! Form::select('status', [1=>'Active', 0=>'Inactive'], null, ['class'=>'form-select', 'placeholder'=>'Select Sub-category status'] ) !!}
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <input type="submit" class="btn btn-primary float-right" value="Create">
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
    <script>
        $('#name').on('change', function(){
            let name = $(this).val();
            let slug = name.replaceAll(' ', '-')
            $('#slug').val(slug.toLowerCase());
        })
    </script>
@endpush

