@extends('backend.admin-layouts.app')

@section('page_title', 'Create | POST')
@section('header', 'Create Post')

@push('css')
<link rel="stylesheet" href="{{ asset('backend')}}/dropify/dist/css/dropify.min.css">
<link rel="stylesheet" href="{{ asset('backend')}}/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{ asset('backend')}}//plugins/summernote/summernote-bs4.min.css">
@endpush

@section('admin_content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <h1 class="card-title">Create Post</h1>
                            </div>
                            <div class=" col-sm-6 text-right d-none d-sm-inline-block">
                                <a href="{{ route('post.index') }}" class="btn btn-warning"><i class="fas fa-arrow-circle-left"></i> Back</a>
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
                    <form action="{{route('post.store')}}" method="POST" class="p-4" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="post_title">Post Title <span class="text-danger">*</span></label>
                                    <input type="text" name="post_title" class="form-control {{$errors->has('post_title') ? 'is invalid' : null}}" id="post_title" placeholder="Input your post title">
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Select Category <span class="text-danger">*</span></label>
                                    <select name="category_id" id="category_id" class="form-control {{$errors->has('category_id') ? 'is invalid' : null}}">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="sub_category_id">Select Sub Category <span class="text-danger">*</span></label>
                                    <select name="sub_category_id" id="sub_category_id" class="form-control">
                                        <option value="">Select Sub Category</option>
                                        {{-- @foreach($sub_categories as $sub_category)
                                        <option value="{{$sub_category->id}}">{{$sub_category->name}}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="description">Post Description <span class="text-danger">*</span></label>
                                    <textarea name="description" class="form-control" id="description"></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="image">Post Feature Image <span class="text-danger">*</span></label>
                                    <input type="file" name="image" data-max-file-size="2M"
                                        data-allowed-file-extensions="jpg png jpeg webp" class="form-control dropify"
                                        id="image">
                                </div>
                                <div class="form-group">
                                    <label for="image">Post Video <span class="text-danger">*</span></label>
                                    <input type="file" name="video" class="form-control" id="video">
                                </div>
                                <div class="form-group">
                                    <label for="tag_ids" class="">Select Tags <span class="text-danger">*</span></label>
                                    <select name="tag_ids[]" id="tag_ids" class="form-control select2" multiple>
                                        <option>Select Tags</option>
                                        @foreach ($tags as $tag)
                                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="float-right">
                                    @if(Auth::user()->role==1)
                                    <button type="button" class="btn btn-primary btn-sm mt-2" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        <i class="fa fa-plus-circle"></i> Add New Tag
                                    </button>
                                    @endif
                                    <!-- Button trigger modal -->
                                </div>
                                <div class="form-group mt-5">
                                    <label>Status</label>
                                    <br>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline1" name="status" value="1"
                                            class="custom-control-input">
                                        <label class="custom-control-label" for="customRadioInline1">Published</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline2" checked name="status" value="0"
                                            class="custom-control-input">
                                        <label class="custom-control-label" for="customRadioInline2">Draft</label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center mt-3">
                            <button type="submit" name="submit" class="btn btn-primary btn-lg">Submit</button>
                        </div>
                    </form>

                </div>
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
                                <input type="submit" name="submit" class="btn btn-primary" value="Add Now">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- bs-custom-file-input -->
    <script src="{{ asset('backend') }}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<!-- page require js load here... -->
<script src="{{ asset('backend') }}/dropify/dist/js/dropify.min.js"></script>
<script src="{{ asset('backend') }}/plugins/summernote/summernote-bs4.min.js"></script>
<script src="{{ asset('backend') }}/plugins/select2/js/select2.min.js"></script>
<!--Freeze -->
<script>
    $('.dropify').dropify();
    $('#description').summernote({
        height:300
    })

    $(document).ready(function() {
    $('.select2').select2();
});
</script>

    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>

    @include('backend.modules.post.common_script')
    
    <!-- Api link for category to sybCategory -->
    {{-- <script>
    // Make a request for a user with a given ID
    $('#category_id').on('change',function () {
    // handle success
    let category_id = $(this).val();
    let sub_category_element = $('#sub_category_id')
    
    sub_category_element.empty();
    sub_category_element.append('<option selected="selected">Select Sub Category</option>');
    axios.get(window.location.origin+'/admin/get-subcategory/'+category_id).then(res=>{
        let sub_categories = res.data

           sub_categories.map((sub_category, index)=>(
            sub_category_element.append(`<option value="${sub_category.id}"> ${sub_category.name}</option>`)
           ))
    })
  })
    </script> --}}
    <!-- Api link for category to sybCategory end-->
@endpush

