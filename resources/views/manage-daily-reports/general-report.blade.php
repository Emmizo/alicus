@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="left-side-content">
            <div class="row mt-5">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('report-today-list') }}">Home</a></li>

                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @if (session()->has('success'))
        <div class="alert msg alert-success"> {!! session('success') !!} </div>
        @endif @if (session()->has('error'))
            <div class="alert msg alert-danger"> {!! session('error') !!} </div>
        @endif
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <div class="row">
                                <div class="col-md-8">

                                </div>
                                <div class="col-md-4">

                                </div>
                                <table id="manage-users" class="table table-bordered">
                                    <thead>
                                        <tr class="table-row">
                                            <th>id</th>
                                            <th>CLIENT NAME</th>
                                            <th>PHONE NUMBER</th>
                                            <th>email</th>
                                            <th>address</th>
                                            <th>Gender</th>
                                            <th>Martial status</th>
                                            <th>ADMITTED AT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    @endsection
    @section('style')
        <link rel="stylesheet" type="text/css" href="{{ asset('custom/datatables/css/dataTables.bootstrap4.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('custom/datatables_custom.css') }}">
    @endsection
    @section('script')
        <script type="text/javascript" src="{{ asset('custom/datatables/js/jquery.dataTables.js') }}"></script>
        <script type="text/javascript" src="{{ asset('custom/datatables/js/dataTables.bootstrap4.js') }}"></script>
        <script type="text/javascript" src="{{ asset('custom/datatables/js/dataTables.rowReorder.js') }}"></script>
        <script type="text/javascript" src="{{ asset('custom/datatables/js/dataTables.scroller.js') }}"></script>
        <script type="text/javascript" src="{{ asset('custom/datatables_custom.js') }}"></script>
        {{-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script> --}}
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css"></script>

        <script type="text/javascript">
            $(document).ready(function() {

                $('#manage-users').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "dom": '<"pull-left"f><"pull-right"l>tip',
                    "pageLength": 25,
                    "searching": true,
                    "bPaginate": true,
                    "bLengthChange": true,
                    "bInfo": true,
                    "aaSorting": [],
                    dom: 'Bfrtip',
                    'buttons': [
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5'
                    ],
                    "order": [
                        [0, "desc"]
                    ],

                    "ajax": "{{ route('today-client-ajax') }}",
                    "fnDrawCallback": function() {
                        $('.toggle-class').bootstrapToggle();
                    },
                    "columns": [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'client_name',
                            name: 'client_name'
                        },

                        {
                            data: 'telephone',
                            name: 'telephone'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'address',
                            name: 'address'
                        },
                        {
                            data: 'gender_birth',
                            name: 'gender_birth'
                        },
                        {
                            data: 'martial_status',
                            name: 'martial_status'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at',
                            "render": function(data) {
                                var nData = (data != null) ? moment(data).format('DD/MM/YYYY') : '';
                                return nData;
                            }
                        },


                    ],
                    'columnDefs': [{
                            responsivePriority: 1,
                            targets: 0
                        },
                        {
                            responsivePriority: 2,
                            targets: 5
                        },
                        {
                            'visible': false,
                            'targets': [0]
                        }
                    ],
                    'order': [
                        [0, 'desc']
                    ]
                });

            });
            $('#extend').on('click', function() {
                $('.activate').addClass('active');
            });
        </script>
    @endsection
