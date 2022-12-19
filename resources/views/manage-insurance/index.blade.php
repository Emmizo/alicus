@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-5">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('insurance') }}">Manager Payor</a></li>
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
                                            placeholder="Search Payor">
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

                                        @if ($insurances->count() > 0)
                                            <table class="table table-bordered certificate-table tab-bc">
                                                <thead>

                                                    <tr>
                                                        <th class="w-10px pe-2">
                                                            No
                                                        </th>
                                                        <th class="min-w-125px hidde-responsive-j6">Payor or Company
                                                        </th>
                                                        <th>Payor name</th>
                                                        <th>Telephone</th>
                                                        <th>Address</th>
                                                        <th>Price per Day</th>
                                                        <th>Admitted date</th>
                                                        <th>Updated at</th>
                                                        <th style="">Actions</th>
                                                    </tr>

                                                </thead>
                                                @foreach ($insurances as $key => $client)
                                                    <tbody id="myTable">
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>
                                                                {{ $client->insurance_company }}
                                                            </td>
                                                            <td>{{ $client->insurance_name }}</td>

                                                            <td>{{ $client->phone }}</td>
                                                            <td>{{ $client->address }}</td>

                                                            <td>{{ $client->percentage }}
                                                            </td>
                                                            <td>{{ $client->created_at }}</td>
                                                            <td>{{ $client->updated_at }}</td>

                                                            <td>
                                                                <div class="dropdown">
                                                                    <button class=" dropdown-toggle" type="button"
                                                                        id="dropdownMenuButton" data-toggle="dropdown"
                                                                        aria-haspopup="true" aria-expanded="false">
                                                                        ...
                                                                    </button>

                                                                    <div class="dropdown-menu"
                                                                        aria-labelledby="dropdownMenuButton">

                                                                        <a class="dropdown-item"
                                                                            href="{{ route('edit-insurance', [$client->id]) }}"><i
                                                                                class="fa fa-edit fa-fw"></i>Edit</a>
                                                                        <a class="dropdown-item" href="#contact"><i
                                                                                class="fa fa-trash fa-fw"></i>Delete
                                                                        </a>

                                                                    </div>

                                                                </div>
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
                        <h3>No Payor in {{ $data->company_name }}<h3>
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
        <form role="form" id="add-insurance" action="" name="add-client-m" method="POST"
            enctype="multipart/form-data">
            <div class="modal-dialog modal-xl" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">PAYOR</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5 class="modal-title" id="exampleModalLabel">ADD PAYOR</h5>
                        <hr />
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name">PAYOR COMPANY<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="insurance_company"
                                        name="insurance_company">
                                    <small class="text-danger">{{ $errors->first('insurance_company') }}</small>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name">PAYOR NAME<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="insurance_name"
                                        name="insurance_name">
                                    <small class="text-danger">{{ $errors->first('insurance_name') }}</small>
                                </div>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name" class="text-uppercase">Telephone<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="phone" name="phone">
                                    <small class="text-danger">{{ $errors->first('phone') }}</small>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name" class="text-uppercase">Address<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="address" name="address">
                                    <small class="text-danger">{{ $errors->first('address') }}</small>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="company_id" id="comp_id" value="{{ $data->comp_id }}">
                        <div class="form-row">
                            <div class="col-md-8 mb-3">
                                <div class="form-group">
                                    <label for="category_name" class="text-uppercase">Price per day <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="percentage" name="percentage">
                                    <small class="text-danger">{{ $errors->first('percentage') }}</small>
                                </div>
                            </div>
                            {{-- <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Date Start<span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="date_started" name="date_start">
                                    <small class="text-danger">{{ $errors->first('date_start') }}</small>
                                </div>
                            </div> --}}

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark btn-lg" id="send_btn"> <i
                                class="fa fa-plus"></i>&nbsp; Save</button>
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
                                $('#manage-components').DataTable().draw();
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
            $('#add-insurance').validate({
                rules: {
                    insurance_name: {
                        required: true,
                        maxlength: 50,
                    },
                    insurance_company: {
                        required: true,
                    },
                    phone: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                    percentage: {
                        required: true,
                    }
                },
                messages: {
                    insurance_name: {
                        require: "Please enter insurance company name",
                    },
                    insurance_name: {
                        required: "Please enter insurance",
                    },
                    phone: {
                        required: "Please enter phone number",
                    },
                    address: {
                        required: "Please enter address",
                    },
                    percentage: {
                        required: "Please enter percentage coverd",
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
                    var insuranceCompany = $('#insurance_company').val();
                    form_data.append('insurance_company', insuranceCompany);

                    var insurance = $('#insurance_name').val();
                    form_data.append('insurance_name', insurance);
                    var phone = $('#phone').val();
                    form_data.append('phone', phone);
                    var percentage = $('#percentage').val();
                    form_data.append('percentage', percentage);
                    var address = $('#address').val();
                    form_data.append('address', address);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "{{ route('save-insurance') }}",
                        type: "POST",
                        dataType: "json",
                        data: form_data,
                        cache: false,
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            $('#close-size').html(
                                "<i class='fa fa-spin fa-spinner'></i> Submit");
                            $('#close-size').prop('disabled', true);
                        },
                        success: function(result) {
                            console.log(result.status);
                            if (result.status == 200) {
                                window.location.href = '{{ route('insurance') }}';
                                // $('#insurance-id').empty();
                                // for (var i = 0; i < result.data.insurances.length; i++) {

                                //     $('#insurance-id').append("<option value=" + result.data
                                //         .insurances[i]
                                //         .id + ">" + result.data.insurances[i]
                                //         .insurance_name +
                                //         "</option>");
                                // }
                                // $('#insurance-id').append("<option>Other</option>");

                                // $('#myModalSize').modal('hide');

                            } else if (result.status == 401) {
                                var msg = result.message != null ?
                                    "Please select this Insurance already available" : "";
                                $(`<span id="insurance-error2" class="error invalid-feedback">` +
                                    msg +
                                    `</span>`).insertAfter($('#insurance'));
                                $('#insurance').attr('class',
                                    'form-control text-box is-invalid');
                            }


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
            $('#phone').mask('(000) 000-0000');

        });

        function resetForm() {
            document.getElementById("add-user").reset();
        }
    </script>
@endsection
