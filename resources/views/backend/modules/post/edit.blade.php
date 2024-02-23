@extends('backend.admin-layouts.app')

@section('page_title', 'Edit | Post')
@section('header', 'Post')

@push('css')
    <link rel="stylesheet" href="{{ asset('backend') }}/dropify/dist/css/dropify.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}//plugins/summernote/summernote-bs4.min.css">
@endpush

@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card ">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h1 class="card-title">Edit Post</h1>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('post.index') }}" class="btn btn-warning"> <i class="fas fa-arrow-circle-left"></i> Back</a>
                            </div>
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

                    <form action="{{ route('post.update', $post->id) }}" method="POST" class="p-4"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="post_title">Post Title <span class="text-danger">*</span></label>
                                    <input type="text" name="post_title" class="form-control" id="post_title"
                                        value="{{ $post->post_title }}">
                                </div>
                                <div class="form-group">
                                    <label for="{category_id}">Select Category <span class="text-danger">*</span></label>
                                    <select name="category_id" id="{category_id}" selected class="form-control">
                                        <option value=""  >Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" @if ($post->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="sub_category_id">Select Sub Category <span class="text-danger">*</span></label>
                                    <select name="sub_category_id" id="sub_category_id" class="form-control">
                                        <option value="" selected="selected">Select Sub Category</option>
                                        @foreach($sub_categories as $sub_category)
                                        <option value="{{$sub_category->id}}" @if ($post->sub_category_id == $sub_category->id) selected @endif>{{$sub_category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="description">Post Description <span class="text-danger">*</span></label>
                                    <textarea name="description" class="form-control" id="description" rows="2" cols="20">{{ $post->description }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{-- <div><img src="" width="200" height="90" alt=""></div> --}}
                                    <label for="image">Post Feature Image <span class="text-danger">*</span></label>
                                    <input type="file" data-default-file="{{ asset('uploads/post/' . $post->image) }}"
                                        name="image" data-max-file-size="2M"
                                        data-allowed-file-extensions="jpg png jpeg webp" class="form-control dropify"
                                        id="image">
                                        <input type="hidden" name="old_image" id="{{$post->image}}">
                                </div>
                                

                                <div class="form-group">
                                    {{-- <label for="tag_ids" class="">Select Tags <span
                                            class="text-danger">*</span></label>
                                    <select name="tag_ids[]" id="tag_ids" class="form-control select2" multiple>
                                        <option>Select Tags</option>
                                        @foreach ($tags as $tag)
                                        <option value="{{ $tag->id, in_array($tag->id, $selected_tags)}}">{{ $tag->name }}</option>
                                        @endforeach
                                    </select> --}}
                                    <label for="tag_ids" class="form-label">Select Tags <span
                                            class="text-danger ">*</span></label>
                                    <div class="border">
                                        <div class="row my-1 mx-1">
                                            @foreach ($tags as $tag)
                                            <div class="col-md-4">
                                                {!! Form::checkbox('tag_ids[]', $tag->id, Route::currentRouteName() == 'post.edit' ? in_array($tag->id, $selected_tags) : false) !!} <span> {{ $tag->name }}</span>
                                            </div>
                                            @endforeach
                                        </div>
                                    
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-primary btn-sm mt-2" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">
                                            <i class="fa fa-plus-circle"> </i> Add New Tag
                                        </button>
                                        <!-- Button trigger modal -->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control" id="status">
                                        <option name="status" value="status">
                                            {{ $post->status == 1 ? 'Published' : 'Published' }}</option>
                                        <option name="status" value="status">
                                            {{ $post->status == 0 ? 'Published' : 'Not Published' }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center mt-3">
                            <button type="submit" name="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Tag</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('tagstore.com', $tag->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="form-label">Tag Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Input Tag Name">
                            </div>
                            <div class="form-group text-right mt-3">
                                <input type="submit" name="submit" class="btn btn-primary" value="Update Now">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')


    <!-- page require js load here... -->
    <script src="{{ asset('backend') }}/dropify/dist/js/dropify.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/select2/js/select2.min.js"></script>



    {{-- for category to subcategory js --}}

    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
    <script>
        $('.dropify').dropify();
        $('#description').summernote({
            height: 300
        })

        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>

  {{-- @include('backend.modules.post.common_script') --}}



@endpush
