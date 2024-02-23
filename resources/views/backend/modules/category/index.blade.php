@extends('backend.admin-layouts.app')

@section('page_title', 'Category')
@section('header', 'All Category')


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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <div class="d-grid ">
                                {{-- <h1 class="card-title"><a href="{{ route('slider.index')}}" class="btn btn-primary">All Sliders</a></h1> --}}
                            </div>
                            <div class="float-right d-none d-sm-inline-block">
                                <a href="{{ route('category.create') }}" class="btn btn-primary"><i
                                        class="fa fa-plus-circle"></i> Add Category</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if(session()->has('msg'))
                            <div class="alert alert-{{session()->get('cls')}}">
                            {{ session()->get('msg') }}
                            </div>
                            @endif

                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Order By</th>
                                        <th>Status</th>
                                        <th>Create At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $key => $category)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->slug }}</td>
                                            <td>{{ $category->order_by }}</td>
                                            <td>
                                                @if ($category->status == 1)
                                                    <span class="badge badge-success">Confirmed</span>
                                                @endif
                                                @if ($category->status == 0)
                                                    <span class="badge badge-warning">Waiting</span>
                                                @endif
                                            <td>{{ $category->created_at->toDayDateTimeString() }}</td>
                                            <td>{{ $category->updated_at != $category->updated_at ? $category->updated_at->toDayDateTimeString : 'Not Updated' }}
                                            </td>
                                            <td>

                                                @if ($category->status == 0)
                                                    <form id="status-form-{{ $category->id }}" method="POST"
                                                        action="{{ route('category.status', $category->id) }}">
                                                        @csrf
                                                    </form>

                                                    <button type="button" class="btn btn-primary btn-sm mx-1"
                                                        onclick="if(confirm('Are you verify request by phone?')){event.preventDefault();document.getElementById('status-form-{{ $category->id }}').submit();}
                                          else{event.preventDefault();}"><i
                                                            class="fas fa-check"></i> </button>
                                                @endif

                                                <a href="{{ route('category.show', $category->id) }}"
                                                    class="btn btn-info btn-sm"><i class="fas fa-eye"></i> </a>
                                                <a href="{{ route('category.edit', $category->id) }}"
                                                    class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> </a>

                                                    <a href="{{route('category.destroy', $category->id)}}" class="btn btn-danger btn-sm mx-1 my-1" id="delete"><i class="fa-sharp fa-solid fa-trash"></i></a>

                                                <form id="" method="POST" action="">
                                                    @csrf @method('DELETE')
                                                </form>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Order By</th>
                                        <th>Status</th>
                                        <th>Create At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
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
