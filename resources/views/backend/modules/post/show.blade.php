@extends('backend.admin-layouts.app')

@section('page_title', 'Post')
@section('header', 'Post')


@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush

@section('admin_content')


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <div class="d-grid">
                                <h1 class="card-title">Post Details</h1>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-sm">
                                <thead>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $post->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Title</th>
                                        <td>{{ $post->post_title }}</td>
                                    </tr>
                                    <tr>
                                        <th>Slug</th>
                                        <td>{{ $post->slug }}</td>
                                    </tr>
                                    <tr>
                                        <th>Category</th>
                                        <td>{{ $post->category->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Sub Category</th>
                                        <td>{{ $post->sub_category->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tags</th>
                                        {{-- <td>{{ $post->tags->name }}</td> --}}
                                    </tr>
                                    <tr>
                                        <th>Description</th>
                                        <td>{{ $post->description }}</td>
                                    </tr>
                                    <tr>
                                        <th>Admin Comment</th>
                                        <td>{{ $post->admin_comment }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>{{ $post->status == 1 ? 'Published' : 'Not Published' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Approved By</th>
                                        <td>{{ $post->is_approved == 1 ? 'Approved' : 'Not Approved' }}</td>
                                    </tr>

                                    <tr>
                                        <th>Create At</th>
                                        <td>{{ $post->created_at->toDayDateTimeString() }}</td>
                                    </tr>
                                    <tr>
                                        <th>Updated At</th>
                                        <td>{{ $post->updated_at != $post->updated_at ? $post->updated_at->toDayDateTimeString : 'Not Updated' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Updated By</th>
                                        <td>{{ $post->user->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Delete At</th>
                                        <td>{{ $post->deleted_at }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Post Image</th>
                                        <td>
                                            <img src="{{$post->image}}" class=""  width="200" height="90" alt="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tags</th>
                                        <td>
                                            @php
                                            $classes = ['badge-success', 'badge-warning', 'badge-danger', 'badge-info', 'badge-dark', 'badge-secondary']    
                                        @endphp
                                        @foreach($post->tags as $tag)
                                           <a href="{{route('tag.show', $tag->id)}}"><button class="badge {{$classes[random_int(0, 5)]}} badge-sm mb-1"> {{ $tag->name}}</button></a>
                                        @endforeach
                                    </tr>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                            <a href="{{route('post.index')}}" class="btn btn-warning mt-3"><i class="fas fa-arrow-circle-left"></i> Back</a>
                        </div>

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-10 mx-2">
                            <div class="card">
                                <div class="card-header bg-info">
                                    <div class="d-grid">
                                        <h1 class="card-title">Category Details</h1>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped table-sm">
                                        <thead>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>ID</th>
                                                <td>{{ $post->category->id }}</td>
                                            </tr>
                                            <tr>
                                                <th>Name</th>
                                                <td>{{ $post->category->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Slug</th>
                                                <td>{{ $post->category->slug }}</td>
                                            </tr>
                                            <tr>
                                                <th>Order By</th>
                                                <td>{{ $post->category->order_by == 1 ? 'Active' : 'Not Active' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td>{{ $post->category->status == 1 ? 'Active' : 'Not Active' }}</td>
                                            </tr>

                                            <tr>
                                                <th>Create At</th>
                                                <td>{{ $post->created_at->toDayDateTimeString() }}</td>
                                            </tr>
                                            <tr>
                                                <th>Updated At</th>
                                                <td>{{ $post->updated_at != $post->updated_at ? $post->updated_at->toDayDateTimeString : 'Not Updated' }}
                                                </td>
                                            </tr>


                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                    <a href="{{ route('category.show', $post->category->id) }}"
                                        class="btn btn-success btn-sm mt-3">Details</a>
                                </div>

                                <!-- /.card-body -->
                            </div>
                        </div>
                        <div class="col-10 mx-2">
                            <div class="card">
                                <div class="card-header bg-info">
                                    <div class="d-grid">
                                        <h1 class="card-title">Sub Category Details</h1>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped table-sm">
                                        <thead>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>ID</th>
                                                <td>{{ $post->sub_category->id }}</td>
                                            </tr>
                                            <tr>
                                                <th>Name</th>
                                                <td>{{ $post->sub_category->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Slug</th>
                                                <td>{{ $post->sub_category->slug }}</td>
                                            </tr>
                                            <tr>
                                                <th>Order By</th>
                                                <td>{{ $post->sub_category->order_by == 1 ? 'Active' : 'Not Active' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td>{{ $post->sub_category->status == 1 ? 'Active' : 'Not Active' }}</td>
                                            </tr>

                                            <tr>
                                                <th>Create At</th>
                                                <td>{{ $post->created_at->toDayDateTimeString() }}</td>
                                            </tr>
                                            <tr>
                                                <th>Updated At</th>
                                                <td>{{ $post->updated_at != $post->updated_at ? $post->updated_at->toDayDateTimeString : 'Not Updated' }}
                                                </td>
                                            </tr>


                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                    <a href="{{ route('sub-category.show', $post->sub_category->id) }}"
                                        class="btn btn-success btn-sm mt-3">Details</a>
                                </div>

                                <!-- /.card-body -->
                            </div>
                        </div>
                        <div class="col-10 mx-2">
                            <div class="card">
                                <div class="card-header bg-info">
                                    <div class="d-grid">
                                        <h1 class="card-title">User Details</h1>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped table-sm">
                                        <thead>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>ID</th>
                                                <td>{{ $post->user->id }}</td>
                                            </tr>
                                            <tr>
                                                <th>Name</th>
                                                <td>{{ $post->user->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td>{{ $post->user->email }}</td>
                                            </tr>
                                            <tr>
                                                <th>Create At</th>
                                                <td>{{ $post->created_at->toDayDateTimeString() }}</td>
                                            </tr>
                                            <tr>
                                                <th>Updated At</th>
                                                <td>{{ $post->updated_at != $post->updated_at ? $post->updated_at->toDayDateTimeString : 'Not Updated' }}
                                                </td>
                                            </tr>


                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                </div>

                                <!-- /.card-body -->
                            </div>
                        </div>
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
    </script>
@endpush
