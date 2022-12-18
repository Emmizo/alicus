@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mt-5">
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
                            <div class="row col-12 d-print-none ">
                                <div class=" col-lg-3 col-md-4 col-sm-3">
                                    <div class="search">
                                        <i class="fa fa-search"></i>
                                        <input type="text" class="form-control" id="myInput"
                                            placeholder="Search Medication">
                                    </div>
                                </div>
                                {{-- <div class="row  col-8 justify-content-end">
                                    <div class='col-lg-3 col-md-4 col-sm-3'>
                                        <a href="#" class="btn btn-success" data-toggle="modal"
                                            data-target="#add-client">
                                            <i class="fa fa-plus-square"></i>&nbsp;{{ $add }}</a>
                                    </div>

                                </div> --}}
                            </div>
                            <br>
                            <br>
                            <div class="col-12 container">
                                <input class="btn btn-primary d-print-none" type='button' id='print-data' value='Print'>
                            </div>
                            <div class="col-md-12 mt-3 d-flex justify-content-center text-uppercase">
                                <h4>List of medical taken by <b>{{ $name }}</b></h4>
                            </div>
                            <section class="mt-5">
                                <div class="container2" id="printData">

                                    <div id="myDIV">


                                        @if ($medications->count() > 0)
                                            <table border="1" class="table table-bordered certificate-table tab-bc">
                                                <thead>

                                                    <tr>
                                                        <th class="w-10px pe-2">
                                                            No
                                                        </th>
                                                        <th class="min-w-125px hidde-responsive-j6">Medication
                                                        </th>
                                                        <th>Dose Units</th>
                                                        <th>Dose Quantity</th>

                                                        <th>Frequency</th>
                                                        <th>Prescriber</th>
                                                        <th>Start Date</th>

                                                        {{-- <th>Admitted by</th> --}}
                                                        <th>Admitted date</th>
                                                        <th>Updated at</th>
                                                        <th class="noprint d-print-none">Actions</th>
                                                    </tr>

                                                </thead>
                                                @foreach ($medications as $key => $client)
                                                    <tbody id="myTable">
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>
                                                                {{ $client->medication_name }}
                                                            </td>
                                                            <td>{{ $client->dose_units }}</td>
                                                            <td>{{ $client->dose_quantity }}</td>

                                                            <td>{{ $client->frequency }}</td>
                                                            <td>{{ $client->prescriber }}</td>

                                                            <td>{{ $client->date_start }}</td>
                                                            <td>{{ $client->created_at }}</td>
                                                            <td>{{ $client->updated_at }}</td>

                                                            <td class="noprint d-print-none">
                                                                <div class="dropdown">
                                                                    <button class=" dropdown-toggle" type="button"
                                                                        id="dropdownMenuButton" data-toggle="dropdown"
                                                                        aria-haspopup="true" aria-expanded="false">
                                                                        ...
                                                                    </button>

                                                                    <div class="dropdown-menu"
                                                                        aria-labelledby="dropdownMenuButton">

                                                                        <a class="dropdown-item"
                                                                            href="{{ route('medication-edit', [$client->id]) }}"><i
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
                        <h5>No Medical applied to {{ $name ?? '' }}<h5>
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
        <form role="form" id="add-medication" action="" name="add-client-m" method="POST"
            enctype="multipart/form-data">
            <div class="modal-dialog modal-xl" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">MEDICATION</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5 class="modal-title" id="exampleModalLabel">ADD MEDICATION</h5>
                        <hr />
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Medicaton Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="medication" name="medication_name">
                                    <small class="text-danger">{{ $errors->first('medication_name') }}</small>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Dose Units<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="dose_unit" name="dose_units">
                                    <small class="text-danger">{{ $errors->first('dose_units') }}</small>
                                </div>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Frequency<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="frequencies" name="frequency">
                                    <small class="text-danger">{{ $errors->first('frequency') }}</small>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Prescriber<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="prescribes" name="prescriber">
                                    <small class="text-danger">{{ $errors->first('prescriber') }}</small>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="client_id" id="client_id" value="{{ $client_id }}">
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Dose Quantity<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="dose_qty" name="dose_quantity">
                                    <small class="text-danger">{{ $errors->first('dose_quantity') }}</small>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Date Start<span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="date_started" name="date_start">
                                    <small class="text-danger">{{ $errors->first('date_start') }}</small>
                                </div>
                            </div>

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
            $('#add-medication').validate({
                rules: {
                    medication_name: {
                        required: true,
                    },
                    dose_units: {
                        required: true,
                    },
                    dose_quantity: {
                        required: true,
                    },

                    frequency: {
                        required: true,
                    },
                    prescriber: {
                        required: true,
                    },
                    date_start: {
                        required: true,
                    },

                },
                messages: {
                    mediction_name: {
                        required: "Please Enter Medication name",
                    },
                    dose_units: {
                        required: "Please Enter Dose Unit",
                    },
                    dose_quantity: {
                        required: "Please Enter Dose Quantity",
                    },
                    frequency: {
                        required: "Please enter frequency",

                    },
                    prescriber: {
                        required: "Please enter prescriber",
                    },
                    date_start: {
                        required: "Please Enter date start",
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
                    $('#add-medication input').each(function(i, e) {
                        var getID = $(this).attr('id');
                        var name = $(this).attr('name');
                        form_data.append(name, $("#" + getID).val());
                    });

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "{{ route('medication-save') }}",
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
                                '{{ route('medication-list', ['id' => $data->comp_id, 'client_id' => $client_id, 'name' => $name]) }}';
                            // $('#send_btn').html(" Submit");
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

        $(document).ready(function() {
            document.title = '{{ $data->company_name }}';

            function printData() {
                var divToPrint = document.getElementById("printData");

                newWin = window.print();
                // newWin = window.open('', '', 'height=700,width=900');
                // newWin.document.write(divToPrint.outerHTML);
                // newWin.document.write('<html><head><title></title>');


                // newWin.print();

                newWin
                    .close();


            }


            $('input#print-data').on('click', function() {
                printData();
            })
        })
    </script>
@endsection
