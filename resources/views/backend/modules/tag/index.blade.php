@extends('backend.admin-layouts.app')

@section('page_title', 'Tag')
@section('header', 'All Tag')


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
                            <div class="d-grid">
                                {{-- <h1 class="card-title"><a href="{{ route('slider.index')}}" class="btn btn-primary">All Sliders</a></h1> --}}
                            </div>
                            <div class="float-right d-none d-sm-inline-block">
                                <a href="{{ route('tag.create') }}" class="btn btn-primary"><i
                                        class="fa fa-plus-circle"></i> Add Tag</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            {{-- @if (session()->has('msg'))
                                <div class="alert alert-{{ session()->get('cls') }}">
                                    {{ session()->get('msg') }}
                                </div>
                            @endif --}}

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
                                    @foreach ($tags as $key => $tag)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $tag->name }}</td>
                                            <td>{{ $tag->slug }}</td>
                                            <td>{{ $tag->order_by }}</td>
                                            <td>
                                                @if ($tag->status == 1)
                                                    <span class="badge badge-success">Active</span>
                                                @endif
                                                @if ($tag->status == 0)
                                                    <span class="badge badge-warning">Inactive</span>
                                                @endif
                                            <td>{{ $tag->created_at->toDayDateTimeString() }}</td>
                                            <td>{{ $tag->updated_at != $tag->updated_at ? $tag->updated_at->toDayDateTimeString : 'Not Updated' }}
                                            </td>
                                            <td>
                                                @if ($tag->status == 0)
                                                <form id="status-form-{{ $tag->id }}" method="POST" action="{{ route('tag.status', $tag->id) }}">
                                                 @csrf
                                                </form>
                                                <button type="button" class="btn btn-primary btn-sm mx-1" onclick="if(confirm('Are you verify request by phone?')){event.preventDefault();document.getElementById('status-form-{{ $tag->id }}').submit();}else{event.preventDefault();}"><i class="fas fa-check"></i>
                                                </button>
                                                @endif

                                                <a href="{{ route('tag.show', $tag->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> </a>
                                                <a href="{{ route('tag.edit', $tag->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> </a>
                                                <a href="{{ route('tag.destroy', $tag->id) }}" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i> </a>

                                            
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

    <script>
        $(function() {
            var Toast = Swal.mixin({
                // toast: true,
                // position: 'top-end',
                // showConfirmButton: false,
                // timer: 3000,
                // progressbar: true,

                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
           });

            // $('.swalDefaultSuccess').click(function() {
            //     Toast.fire({
            //         icon: 'success',
            //         title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            //     })
            // });
            // $('.swalDefaultInfo').click(function() {
            //     Toast.fire({
            //         icon: 'info',
            //         title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            //     })
            // });
            // $('.swalDefaultError').click(function() {
            //     Toast.fire({
            //         icon: 'error',
            //         title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            //     })
            // });
            // $('.swalDefaultWarning').click(function() {
            //     Toast.fire({
            //         icon: 'warning',
            //         title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            //     })
            // });
            // $('.swalDefaultQuestion').click(function() {
            //     Toast.fire({
            //         icon: 'question',
            //         title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            //     })
            // });

            // $('.toastrDefaultSuccess').click(function() {
            //     toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
            // });
            // $('.toastrDefaultInfo').click(function() {
            //     toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
            // });
            // $('.toastrDefaultError').click(function() {
            //     toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
            // });
            // $('.toastrDefaultWarning').click(function() {
            //     toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
            // });

            // $('.toastsDefaultDefault').click(function() {
            //     $(document).Toasts('create', {
            //         title: 'Toast Title',
            //         body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            //     })
            // });
            // $('.toastsDefaultTopLeft').click(function() {
            //     $(document).Toasts('create', {
            //         title: 'Toast Title',
            //         position: 'topLeft',
            //         body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            //     })
            // });
            // $('.toastsDefaultBottomRight').click(function() {
            //     $(document).Toasts('create', {
            //         title: 'Toast Title',
            //         position: 'bottomRight',
            //         body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            //     })
            // });
            // $('.toastsDefaultBottomLeft').click(function() {
            //     $(document).Toasts('create', {
            //         title: 'Toast Title',
            //         position: 'bottomLeft',
            //         body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            //     })
            // });
            // $('.toastsDefaultAutohide').click(function() {
            //     $(document).Toasts('create', {
            //         title: 'Toast Title',
            //         autohide: true,
            //         delay: 750,
            //         body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            //     })
            // });
            // $('.toastsDefaultNotFixed').click(function() {
            //     $(document).Toasts('create', {
            //         title: 'Toast Title',
            //         fixed: false,
            //         body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            //     })
            // });
            // $('.toastsDefaultFull').click(function() {
            //     $(document).Toasts('create', {
            //         body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
            //         title: 'Toast Title',
            //         subtitle: 'Subtitle',
            //         icon: 'fas fa-envelope fa-lg',
            //     })
            // });
            // $('.toastsDefaultFullImage').click(function() {
            //     $(document).Toasts('create', {
            //         body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
            //         title: 'Toast Title',
            //         subtitle: 'Subtitle',
            //         image: '../../dist/img/user3-128x128.jpg',
            //         imageAlt: 'User Picture',
            //     })
            // });
            // $('.toastsDefaultSuccess').click(function() {
            //     $(document).Toasts('create', {
            //         class: 'bg-success',
            //         title: 'Toast Title',
            //         subtitle: 'Subtitle',
            //         body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            //     })
            // });
            // $('.toastsDefaultInfo').click(function() {
            //     $(document).Toasts('create', {
            //         class: 'bg-info',
            //         title: 'Toast Title',
            //         subtitle: 'Subtitle',
            //         body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            //     })
            // });
            // $('.toastsDefaultWarning').click(function() {
            //     $(document).Toasts('create', {
            //         class: 'bg-warning',
            //         title: 'Toast Title',
            //         subtitle: 'Subtitle',
            //         body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            //     })
            // });
            // $('.toastsDefaultDanger').click(function() {
            //     $(document).Toasts('create', {
            //         class: 'bg-danger',
            //         title: 'Toast Title',
            //         subtitle: 'Subtitle',
            //         body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            //     })
            // });
            // $('.toastsDefaultMaroon').click(function() {
            //     $(document).Toasts('create', {
            //         class: 'bg-maroon',
            //         title: 'Toast Title',
            //         subtitle: 'Subtitle',
            //         body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            //     })
            // });
        });
    </script>

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
