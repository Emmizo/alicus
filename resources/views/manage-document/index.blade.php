@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('client-list') }}">Manager Clients</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>

                    </ol>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show"> <button type="button" class="close"
                data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button> {!! session('success') !!} </div>
        @endif @if (session()->has('error'))
            <div class="alert alert-danger"> {!! session('error') !!} </div>
        @endif
        <section class="content">
            <div class="row">
                <div class="col-lg">
                    <div class="card2">
                        <br>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row col-12">
                                <div class=" col-lg-3 col-md-4 col-sm-3">
                                    <div class="search">
                                        <i class="fa fa-search"></i>
                                        <input type="text" class="form-control" id="myInput"
                                            placeholder="Search Document">
                                    </div>
                                </div>
                                <div class="row  col-8 justify-content-end">
                                    <div class='col-lg-3 col-md-4 col-sm-3'>
                                        <a href="#" class="btn btn-success" data-toggle="modal"
                                            data-target="#add-client">
                                            <i class="fa fa-plus-square"></i>&nbsp;{{ $add }}</a>
                                    </div>

                                </div>
                            </div>
                            <br>
                            <br>

                            <section class="mt-5">
                                <div class="container2">
                                    <div id="myDIV">

                                        @if ($documents->count() > 0)
                                            <table class="table table-bordered certificate-table">
                                                <thead>

                                                    <tr>
                                                        <th class="w-10px pe-2">
                                                            No
                                                        </th>
                                                        <th class="min-w-125px hidde-responsive-j6">Title
                                                        </th>
                                                        <th>View Document</th>


                                                        <th>Admitted by</th>
                                                        <th>Admitted date</th>
                                                        <th>Updated at</th>
                                                        <th style="">Actions</th>
                                                    </tr>

                                                </thead>
                                                @foreach ($documents as $key => $client)
                                                    <tbody id="myTable">
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>
                                                                {{ $client->title }}
                                                            </td>
                                                            <td>
                                                                <button type="button"
                                                                    class="btn btn-primary btn-block document"
                                                                    data-toggle="modal" data-target="#view-doc"
                                                                    data-url="{{ URL::asset('/documents/' . $client->doc_name) }}">View
                                                                    Document</button>

                                                            </td>

                                                            <td>{{ $client->first_name }}</td>
                                                            <td>{{ $client->created_at }}</td>
                                                            <td>{{ $client->updated_at }}</td>

                                                            <td>

                                                                <button type="button"
                                                                    class="btn btn-primary delete-category"
                                                                    data-id="{{ $client->id }}"
                                                                    data-url="{{ route('document-delete', $client->id) }}">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>

                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                @endforeach
                                            </table>

                                    </div>
                                </div>
                        </div>


                    </div>
                </div>
            @else
                <div class="d-flex justify-content-center">
                    <b>
                        <h3>No Document available to {{ $name ?? '' }}</h3>
                    </b>
                </div>
    @endif
    </div>
    </div>

    </section>
    </div>
    </div>
    </div>
    </div>

    <!-- Modal -->
    <div class="modal fade " id="add-client" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <form role="form" id="add-doc" action="" name="add-client-m" method="POST" enctype="multipart/form-data">
            <div class="modal-dialog modal-md" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">UPLOAD DOCUMENT</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5 class="modal-title" id="exampleModalLabel">{{ $name . '\'s documents' }}</h5>
                        <hr />
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Title<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title">
                                    <small class="text-danger">{{ $errors->first('title') }}</small>
                                </div>
                            </div>
                            <input type="hidden" name="company_name" id="company_name"
                                value="{{ $data->company_name }}" />
                            <input type="hidden" name="client_id" id="client_id2" value="{{ $client_id }}">
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Upload document<span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="doc_names" name="doc_name">
                                    <small class="text-danger">{{ $errors->first('doc_name') }}</small>
                                </div>
                            </div>



                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark btn-lg" id="send_btn"> <i
                                class="fa fa-plus"></i>&nbsp; Save</button>
                        {{-- <button type="submit" class="btn btn-primary" id="send_btn">Save</button> --}}
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Modal -->
    <div class="modal fade " id="view-doc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <form role="form" id="add-doc" action="" name="add-client-m" method="POST"
            enctype="multipart/form-data">
            <div class="modal-dialog modal-lg" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">UPLOAD DOCUMENT</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5 class="modal-title" id="exampleModalLabel">{{ $name . '\'s documents' }}</h5>
                        <hr />
                        <div id="doc">

                        </div>

                    </div>

                </div>
            </div>
        </form>
    </div>
    </section>
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
@endsection
@section('script')
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script type="text/javascript">
        /* When the user clicks on the button, 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        toggle between hiding and showing the dropdown content */
        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }


        $(document).on('click', '.delete-category', function() {
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
                                window.location.reload();
                            }
                        },
                        error: function(data) {
                            console.log(data);
                        }
                    });
                }
            });
        });

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
                        success: function(data) {
                            if (data) {
                                swal({
                                    title: "Success",
                                    text: "Status Updated Successfully.",
                                    type: "success",
                                    confirmButtonColor: '#E1261C',
                                });
                                $('#manage-components').DataTable().draw();
                            }
                        },
                        error: function(data) {
                            console.log(data);
                        }
                    });
                } else {
                    $("#manage-components").DataTable().draw();
                }
            });
        });
        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
            //                 $("#myInput").on("keyup", function() {
            //     var value = $(this).val().toLowerCase();
            //     $("#myDIV .accordion-button .accordion-collapse").filter(function() {
            //       $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            //     });
            //   });
        });
        $(document).ready(function() {
            $('#add-doc').validate({
                rules: {
                    title: {
                        required: true,
                    },
                    doc_name: {
                        required: true,
                        extension: "pdf",
                        maxsize: 10485760,
                    },


                },
                messages: {
                    title: {
                        required: "Please Enter Title of document",
                    },
                    doc_name: {
                        required: "Please upload document",
                        extension: "Accepts only pdf file!",
                        maxsize: "File size must be less than 10 mb."
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
                    $('#add-doc input').each(function(i, e) {
                        var getID = $(this).attr('id');
                        var name = $(this).attr('name');
                        form_data.append(name, $("#" + getID).val());
                    });
                    var files = $('#doc_names')[0].files[0];
                    form_data.append('doc_name', files);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "{{ route('document-save') }}",
                        type: "POST",
                        dataType: "json",
                        data: form_data,
                        cache: false,
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            $('#send_btn').html(
                                "<i class='fa fa-spin fa-spinner'></i> Submit");
                        },
                        success: function(result) {
                            window.location.href =
                                "{{ route('document-list', ['id' => $client_id, 'name' => $name]) }}";
                            $('#send_btn').html(" Submit");
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                    return false;
                }
            });
        });
        $(document).ready(function() {
            $('#telephone1').mask('(000) 000-0000');
            $('#emergency_phone1').mask('(000) 000-0000');
        });

        function resetForm() {
            document.getElementById("add-user").reset();
        }
        $(document).on('click', '.document', function() {
            var url = $(this).attr('data-url');

            $('#doc').empty();

            $('#doc').append(
                ' <iframe src="' + url + '" width="100%" height="900px" frameborder="0"></iframe>');
        });
    </script>
@endsection
