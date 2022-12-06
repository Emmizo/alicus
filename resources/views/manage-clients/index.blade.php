@extends('layouts.app')

@section('content')
    <style>

    </style>
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
                            <div class="row col-12 d-print-none">
                                <div class=" col-lg-3 col-md-4 col-sm-3">
                                    <div class="search">
                                        <i class="fa fa-search"></i>
                                        <input type="text" class="form-control" id="myInput"
                                            placeholder="Search Client">
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
                            <div class="col-12 container d-print-none">
                                <input class="btn btn-primary" type='button' id='print-data' value='Print'>
                            </div>
                            <div class="col-md-12 mt-3 d-flex justify-content-center text-uppercase">
                                <h4><u>List of client available in <b>{{ $data->company_name }}</b> company</u></h4>
                            </div>
                            <section class="mt-5">
                                <div class="container2">
                                    <div id="myDIV">

                                        @if ($clients->count() > 0)
                                            <table border="1" class="table table-bordered certificate-table "
                                                id="printData">
                                                <thead>

                                                    <tr>
                                                        <th class="w-10px pe-2">
                                                            No
                                                        </th>
                                                        <th class="min-w-125px hidde-responsive-j6">Client Name
                                                        </th>
                                                        <th>Address</th>
                                                        <th>Phone</th>
                                                        {{-- <th>Email</th> --}}
                                                        <th>Date of birth</th>
                                                        <th>Country</th>
                                                        {{-- <th>SSN</th> --}}
                                                        <th>Admitted by</th>
                                                        <th>Admitted date</th>
                                                        <th>Updated at</th>
                                                        <th class="noprint d-print-none" style="">Actions</th>
                                                    </tr>

                                                </thead>
                                                @foreach ($clients as $key => $client)
                                                    <tbody id="myTable">
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>
                                                                {{ $client->client_name }}
                                                            </td>
                                                            <td>{{ $client->address }}</td>
                                                            <td>{{ $client->telephone }}</td>
                                                            {{-- <td>{{ $client->email }}</td> --}}
                                                            <td>{{ $client->BOD }}</td>
                                                            <td>{{ $client->country }}</td>
                                                            {{-- <td>{{ $client->SSN }}</td> --}}
                                                            <td>{{ $client->first_name }}</td>
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
                                                                            href="{{ route('client-view', [$client->id]) }}"><i
                                                                                class="fa fa-eye fa-fw"></i>
                                                                            View for mor info</a>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('client-edit', [$client->id]) }}"><i
                                                                                class="fa fa-edit fa-fw"></i>Edit</a>

                                                                        <a class="dropdown-item"
                                                                            href='{{ route('medication-list', ['id' => $client->company_id, 'client_id' => $client->id, 'name' => $client->client_name]) }}'><i
                                                                                class="fa fa-plus fa-fw"></i>Assign
                                                                            Medical
                                                                        </a>

                                                                        <a class="dropdown-item"
                                                                            href='{{ route('apply-medication-view', ['id' => $client->company_id, 'client' => $client->id, 'name' => $client->client_name]) }}'><i
                                                                                class="fa fa-history fa-fw"></i>Echat
                                                                        </a>

                                                                        <a class="dropdown-item"
                                                                            href="{{ route('document-list', ['id' => $client->id, 'name' => $client->client_name]) }}"><i
                                                                                class="fa fa-file fa-fw"></i>Manage
                                                                            Document</a>

                                                                        <a class="dropdown-item"
                                                                            href="{{ route('group-note-list', ['id' => $client->company_id, 'client' => $client->id, 'name' => $client->client_name]) }}"><i
                                                                                class="fa fa-file fa-fw"></i>Manage Group
                                                                            Notes</a>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('invoice', ['id' => $client->id, 'date' => $client->created_at, 'birth' => $client->BOD, 'name' => $client->client_name,]) }}"><i
                                                                                class="fa fa-file fa-fw"></i>Generate
                                                                            Invoice</a>
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
                        <h3>No client found</h3>
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
        <form role="form" id="adding-client" action="" name="add-client-m" method="POST"
            enctype="multipart/form-data">
            <div class="modal-dialog modal-xl" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">FACESHEET</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5 class="modal-title" id="exampleModalLabel">CLIENT INFORMATION</h5>
                        <hr />
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Client Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="client_name2" name="client_name">
                                    <small class="text-danger">{{ $errors->first('client_name') }}</small>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Date of Birth<span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="DBO" name="BOD">
                                    <small class="text-danger">{{ $errors->first('email') }}</small>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name">SSN<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="ssn1" name="SSN">
                                    <small class="text-danger">{{ $errors->first('SSN') }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Insurance ID<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="insurance_id2" name="insurance_ID">
                                    <small class="text-danger">{{ $errors->first('insurance_ID') }}</small>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Country<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="country1" name="country">
                                    <small class="text-danger">{{ $errors->first('country') }}</small>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Address<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="address1" name="address">
                                    <small class="text-danger">{{ $errors->first('address') }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Telephone<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="telephone1" name="telephone">
                                    <small class="text-danger">{{ $errors->first('telephone') }}</small>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Email<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="email1" name="email">
                                    <small class="text-danger">{{ $errors->first('email') }}</small>
                                </div>
                            </div>

                        </div>
                        {{-- Demograph --}}
                        <h5 class="modal-title" id="exampleModalLabel">DEMOGRAPHIC</h5>
                        <hr />
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Race<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="race2" name="race">
                                    <small class="text-danger">{{ $errors->first('race') }}</small>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Ethnicity<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="ethnicity1" name="ethnicity">
                                    <small class="text-danger">{{ $errors->first('ethnicity') }}</small>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Gender at Birth<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="gender_at_birth" name="gender_birth">
                                    <small class="text-danger">{{ $errors->first('gender_birth') }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Martial Status<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="martial_status1"
                                        name="martial_status">
                                    <small class="text-danger">{{ $errors->first('martial_status') }}</small>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Household<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="household" name="house_hold">
                                    <small class="text-danger">{{ $errors->first('house_hold') }}</small>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Preferred Language<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="preffered_languages"
                                        name="preferred_language">
                                    <small class="text-danger">{{ $errors->first('preferred_language') }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Employment Status<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="employment1"
                                        name="employment_status">
                                    <small class="text-danger">{{ $errors->first('employment_status') }}</small>
                                </div>
                            </div>

                        </div>
                        {{-- Emergency contact --}}
                        <h5 class="modal-title" id="exampleModalLabel">EMERGENCY CONTACT</h5>
                        <hr />
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name">names<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="emergency_name2"
                                        name="emergency_name">
                                    <small class="text-danger">{{ $errors->first('emergency_name') }}</small>
                                </div>
                            </div>
                            <input type="hidden" id="comp_id" name="comp_id" value="{{ $data->comp_id ?? '' }}">
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Phone<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="emergency_phone1"
                                        name="emergency_phone">
                                    <small class="text-danger">{{ $errors->first('emergency_phone') }}</small>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Email<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="emergency_email"
                                        name="emergency_email">
                                    <small class="text-danger">{{ $errors->first('emergency_email') }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Relationship<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="relationship1" name="relationship">
                                    <small class="text-danger">{{ $errors->first('relationship') }}</small>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Address<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="emergency_address2"
                                        name="emergency_address">
                                    <small class="text-danger">{{ $errors->first('emergency_address') }}</small>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Primary Care Provider<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="primary_care_provider1"
                                        name="primary_care_provider">
                                    <small class="text-danger">{{ $errors->first('primary_care_provider') }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Client PIN<span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="client_PIN1" name="client_PIN">
                                    <small class="text-danger">{{ $errors->first('client_PIN') }}</small>
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
            $('#adding-client').validate({
                rules: {
                    client_name: {
                        required: true,
                    },
                    BOD: {
                        required: true,
                    },
                    SSN: {
                        required: true,
                    },

                    email: {
                        required: true,
                        email: true,
                    },
                    telephone: {
                        required: true,
                        minlength: 14,
                    },
                    insurance_ID: {
                        required: true,
                    },
                    country: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                    race: {
                        required: true,
                    },
                    ethnicity: {
                        required: true,
                    },
                    gender_birth: {
                        required: true,
                    },
                    martial_status: {
                        required: true,
                    },
                    house_hold: {
                        required: true,
                    },
                    preferred_language: {
                        required: true,
                    },
                    employment_status: {
                        required: true,
                    },
                    emergency_name: {
                        required: true,
                    },
                    emergency_phone: {
                        required: true,
                        minlength: 14,
                    },
                    emergency_email: {
                        required: true,
                        email: true,
                    },
                    relationship: {
                        required: true,
                    },
                    emergency_address: {
                        required: true,
                    },
                    primary_care_provider: {
                        required: true,
                    },
                    client_PIN: {
                        required: true,
                    },
                },
                messages: {
                    client_name: {
                        required: "Please Enter Client Name",
                    },
                    BOD: {
                        required: "Please Enter Date of Birth",
                    },
                    SSN: {
                        required: "Please Enter SSN",
                    },
                    email: {
                        required: "Please enter a email address",
                        email: "Please enter a vaild email address"
                    },
                    telephone: {
                        minlength: "Please enter a valid phone number",
                        required: "Please enter a valid phone number",
                    },
                    insurance_ID: {
                        required: "Please Enter insurance ID",
                    },
                    country: {
                        required: "Please Enter  Country",
                    },
                    address: {
                        required: "Please enter  address",
                    },
                    race: {
                        required: "Please enter Race",
                    },
                    ethnicity: {
                        required: "Please enter Ethnicity",
                    },
                    gender_birth: {
                        required: "Please enter Gender Birth",
                    },
                    martial_status: {
                        required: "Please enter martial status",
                    },
                    house_hold: {
                        required: "Please enter Household",
                    },
                    preferred_language: {
                        required: "Please enter Preferred Language",
                    },
                    employment_status: {
                        required: "Please enter employment Status",
                    },
                    emergency_name: {
                        required: "Please enter emergency name",
                    },
                    emergency_phone: {
                        required: "Please enter emergency phone",
                    },
                    emergency_email: {
                        required: "Please enter a emergency email address",
                        email: "Please enter a vaild email address",
                    },
                    relationship: {
                        required: "Please enter relationship",
                    },
                    emergency_address: {
                        required: "Please enter emergency address",
                    },
                    primary_care_provider: {
                        required: "Please enter primary care provider",
                    },
                    client_PIN: {
                        required: "Please enter client PIN",
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
                    $('#adding-client input').each(function(i, e) {
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
                        url: "{{ route('client-save') }}",
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
                            window.location.href = "{{ route('client-list') }}";
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

                newWin
                    .close();

            }


            $('input#print-data').on('click', function() {
                printData();
            })
        })
    </script>
@endsection
