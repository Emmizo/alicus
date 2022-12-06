@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="left-side-content">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
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
                                <div class="col-md-8 m-5">

                                    <a href="{{ route('company-add') }}" class="btn btn-success">
                                        <i class="fa fa-plus"></i>&nbsp;Create Company</a>
                                </div>

                                <table id="manage-users" class="table table-bordered">
                                    <thead>
                                        <tr class="table-row">
                                            <th>id</th>
                                            <th>Owner</th>
                                            <th>COMPANY NAME </th>
                                            <th>PHONE</th>
                                            <th>Email</th>
                                            <th>CREATED</th>
                                            <th>MODIFIED</th>
                                            <th>STATUS</th>
                                            <th>ACTION</th>

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
        <div class="modal fade" id="reset" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel"> </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p id="msg"></p>
                        <form id="sent-link" method="POST" action="{{ route('reset-post') }}">
                            @csrf
                            {{-- @foreach ($users as $user) --}}
                            <div class="form-group">

                                <div class="form-group-field">
                                    <input id="email-data" type="hidden"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value=" " required autocomplete="email" autofocus>
                                </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="modal-footer">
                                <button id="send-link" type="submit"
                                    class="btn btn-primary btn-block">{{ __('Send Reset Link') }}</button>

                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!-- /.content -->
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
                    "order": [
                        [0, "desc"]
                    ],

                    "ajax": "{{ route('company-datatable') }}",
                    "fnDrawCallback": function() {
                        $('.toggle-class').bootstrapToggle();
                    },
                    "columns": [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: "fullname",
                            name: "fullname"
                        },
                        {
                            data: 'company_name',
                            name: 'company_name'
                        },
                        {
                            data: "phone",
                            name: "phone"
                        },

                        {
                            data: 'email',
                            name: "email"
                        },


                        {
                            data: 'created_at',
                            name: 'created_at',
                            "render": function(data) {
                                var nData = (data != null) ? moment(data).format('DD/MM/YYYY') : '';
                                return nData;
                            }
                        },
                        {
                            data: 'updated_at',
                            name: 'updated_at',
                            "render": function(data) {
                                var nData = (data != null) ? moment(data).format('DD/MM/YYYY') : '';
                                return nData;
                            }
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            sortable: false
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

                $(document).on('click', '.delete-user', function() {
                    var id = $(this).attr('data-id');
                    var del_url = $(this).attr('data-url');
                    swal({
                        title: 'Are you sure?',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#E1261C',
                        cancelButtonColor: '#EBEBEB',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'No, cancel!',
                        confirmButtonClass: 'btn',
                        cancelButtonClass: 'btn',
                    }).then(function(result) {
                        if (result.value) {
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                type: "DELETE",
                                dataType: 'json',
                                url: del_url,
                                success: function(data) {
                                    if (data) {
                                        swal({
                                            title: "Success",
                                            text: "Deleted Successfully.",
                                            type: "success",
                                            confirmButtonColor: '#E1261C',
                                        });
                                        $('#manage-users').DataTable().draw();
                                    }
                                }
                            });
                        }
                    });
                });
            });
            //activate or inactive user
            $(document).on('change', '.toggle-class', function() {
                var id = $(this).attr('data-id');
                var status_url = $(this).attr('data-url');
                if ($(this).is(":checked")) {
                    var status = 1;
                    var statusname = "Activate";
                } else {
                    var status = 0;
                    var statusname = "De-activate";
                }
                swal({
                    title: 'Are you sure want to ' + statusname + '?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#E1261C',
                    cancelButtonColor: '#EBEBEB',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                    confirmButtonClass: 'btn',
                    cancelButtonClass: 'btn',
                }).then(function(result) {
                    if (result.value) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            dataType: 'json',
                            url: status_url,
                            data: {
                                id: id,
                                status: status
                            },
                            beforeSend: function() {
                                $('.loader1').show();
                            },
                            success: function(data) {
                                $('.loader1').hide();
                                if (data) {
                                    swal({
                                        title: "Success",
                                        text: "Status Updated Successfully.",
                                        type: "success",
                                        confirmButtonColor: '#E1261C',
                                    });
                                    $('#manage-users').DataTable().draw();
                                }
                            }
                        });
                    } else {
                        $("#manage-users").DataTable().draw();
                    }
                });
            });
            $(document).on('click', '.reset-pass', function() {
                var id = $(this).attr('data-id');
                var name = $(this).attr('data-id2');
                $('#exampleModalToggleLabel').empty();
                // $('#send-link').empty();
                // $('#sent-link').append(
                //     '<button id="send-link" type="submit" class="btn btn-primary btn-block">{{ __('Send Reset Link') }}</button>'
                // )
                $('#msg').empty();
                $('#email-data').empty();
                $('#email-data').val(id);
                $('#msg').append('<p>Do you want to send email link to <b>' + id +
                    '</b>?</p>')
                $('#exampleModalToggleLabel').append(
                    '<h5 class="modal-title" style="text-transform:uppercase">SEND EMAIL LINK TO ' + name + '</h5>');
            });

            $('#sent-link').validate({
                rules: {
                    email: {
                        required: true,

                    },
                },
                messages: {
                    email: {
                        required: "Please enter email",
                    },

                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function(form, e) {
                    e.preventDefault();
                    console.log('Form submitted');

                    var form_data = new FormData();

                    var className = $('#email-data').val();
                    form_data.append('email', className);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "{{ route('reset-post') }}",
                        type: "POST",
                        dataType: "json",
                        data: form_data,
                        cache: false,
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            $('#send-link').html(
                                "<i class='fa fa-spin fa-spinner'></i>");
                            $('#send-link').prop('disabled', true);
                        },
                        success: function(result) {

                            if (result.status == 200) {
                                $('#send-link').append(
                                    '<div id="send-link2"  class="btn btn-success btn-block"> email link sent to ' +
                                    result.data.first_name + ' ' + result.data.last_name +
                                    '</d>');
                                setTimeout(function() {
                                    $(".fa-spinner").fadeOut().empty();
                                    $('div#send-link2').empty();
                                    $('#send-link').prop('disabled', false);
                                    $('#send-link').append(
                                        '<button id="" type="submit" class="btn btn-primary btn-block">{{ __('Send Reset Link') }}</button>'
                                    )
                                }, 2000);


                            }
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                    return false;
                }
            });
        </script>
    @endsection
