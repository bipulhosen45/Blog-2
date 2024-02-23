@extends('backend.admin-layouts.app')

@section('page_title', 'Post')
@section('header', 'All Post')


@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/custom/style.css">

  </head>
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
    <section class="content mt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header ">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h1 class="card-title">Post</h1>
                                </div>
                                <div class=" col-sm-6 text-right d-none d-sm-inline-block">
                                    <a href="{{ route('post.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add New Post</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if (session()->has('msg'))
                                <div class="alert alert-{{ session()->get('cls') }}">
                                    {{ session()->get('msg') }}
                                </div>
                            @endif

                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th>Status</th>
                                        <th>Approved by</th>
                                        <th>Iamge</th>
                                        <th>Tag</th>
                                        <th>Create At</th>
                                        <th>Updated At</th>
                                        <th>Create By</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $key => $post)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $post->post_title }}</td>
                                            <td>
                                                <a href="{{ route('category.show', $post->category_id) }}">{{ $post->category->name }}</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('sub-category.show', $post->sub_category) }}">{{$post->sub_category->name }} </a>
                                            </td>
                                            <td>
                                                @if ($post->status == 1)
                                                    <span class="badge badge-success">Published</span>
                                                @endif
                                                @if ($post->status == 0)
                                                    <span class="badge badge-warning">Not published</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($post->is_approved == 1)
                                                    <span class="badge badge-success">Approved</span>
                                                @endif
                                                @if ($post->is_approved == 0)
                                                    <span class="badge badge-warning">Not approved</span>
                                                @endif
                                            </td>
                                            <td>
                                                <img data-src="{{asset($post->image)}}" src="{{asset($post->image)}}" class="img-thumbnail image_show">
                                            </td>
                                            <td>
                                                @php
                                                    $classes = ['badge-success', 'badge-warning', 'badge-danger', 'badge-info', 'badge-dark', 'badge-secondary'];
                                                @endphp
                                                @foreach ($post->tags as $tag)
                                                    <a href="{{ route('tag.show', $tag->id) }}"><button class="badge {{ $classes[random_int(0, 5)] }} badge-sm mb-1">{{ $tag->name }}</button></a>
                                                @endforeach
                                            </td>
                                            <td>{{ $post->created_at->toDayDateTimeString() }}</td>
                                            <td>{{ $post->updated_at != $post->updated_at ? $post->updated_at->toDayDateTimeString : 'Not Updated' }}
                                            </td>
                                            <td>{{ $post->user->name }}</td>
                                            <td>
                                                @if ($post->status == 0)
                                                    <form id="status-form-{{ $post->id }}" method="POST" action="{{route('post.status', $post->id)}}">
                                                        @csrf
                                                    </form>

                                                    <button type="button" class="btn btn-primary btn-sm mx-1"
                                                        onclick="if(confirm('Are you sure published this post?')){event.preventDefault();document.getElementById('status-form-{{ $post->id }}').submit();}else{event.preventDefault();}"><i
                                                            class="fas fa-check"></i> </button>
                                                @endif

                                                <a href="{{ route('post.show', $post->id) }}"
                                                    class="btn btn-info btn-sm m-1"><i class="fas fa-eye"></i> </a>
                                                <a href="{{ route('post.edit', $post->id) }}" class="btn btn-warning btn-sm m-1"><i class="fas fa-edit"></i> </a>

                                                <a href="{{route('post.destroy', $post->id)}}" class="btn btn-danger btn-sm mx-1 my-1" id="delete"><i class="fa-sharp fa-solid fa-trash"></i></a>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th>Status</th>
                                        <th>Approved by</th>
                                        <th>Iamge</th>
                                        <th>Tag</th>
                                        <th>Create At</th>
                                        <th>Updated At</th>
                                        <th>Create By</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <!--pagination next page-->
                            <div class="mt-2">
                                {{ $posts->links() }}
                            </div>
                        </div>

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- Modal for image dropdown-->
        <!-- Button trigger modal -->
            <button type="button" id="image_show_button" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#image_show">
            </button>
            <!-- Modal -->
            <div class="modal fade" id="image_show" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Blog Image</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body justify-content-center">
                    <img src="" class="img-thumbnail justify-content-center" id="display_image" alt="">
                    </div>
                </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection

@push('js')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('backend') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/jszip/jszip.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <!-- Page specific script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
        // image zoom modal
    </script>
    <script>
        $('.image_show').on('click', function() {
            let img = $(this).attr('data-src')
            $('#display_image').attr('src', img)
            $('#image_show_button').trigger('click')

        })
    </script>
@endpush
