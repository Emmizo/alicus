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

                        <form role="form" id="adding-client" action="" name="add-client-m" method="POST"
                            enctype="multipart/form-data">
                            <div class="modal-dialog modal-xl" role="document">

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">FACESHEET</h5>

                                    </div>
                                    <div class="modal-body">
                                        <h5 class="modal-title" id="exampleModalLabel">CLIENT INFORMATION</h5>
                                        <hr />
                                        <div class="form-row">
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label for="category_name">Client Name<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="client_name2"
                                                        name="client_name">
                                                    <small class="text-danger">{{ $errors->first('client_name') }}</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label for="category_name">Date of Birth<span
                                                            class="text-danger">*</span></label>
                                                    <input type="date" class="form-control" id="DBO"
                                                        name="BOD">
                                                    <small class="text-danger">{{ $errors->first('email') }}</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label for="category_name">SSN<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="ssn1"
                                                        name="SSN">
                                                    <small class="text-danger">{{ $errors->first('SSN') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Insurance name<span class="text-danger">*</span></label>
                                                    <select name="insurance_ID"
                                                        class="form-control text-box select2size select2 size"
                                                        id="insurance-id">
                                                        <option value="">Please select</option>
                                                        @foreach ($insurances as $insurance)
                                                            <option value="{{ $insurance->id }}">
                                                                {{ $insurance->insurance_name }}
                                                            </option>
                                                        @endforeach
                                                        <option value="">Don't use Insurance</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                    <small
                                                        class="help-block text-danger">{{ $errors->first('insurance_ID') }}</small>
                                                </div>
                                                {{-- <div class="form-group">
                                    <label for="category_name">Insurance ID<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="insurance_id2" name="insurance_ID">
                                    <small class="text-danger">{{ $errors->first('insurance_ID') }}</small>
                                </div> --}}
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label for="category_name">Country<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="country1"
                                                        name="country">
                                                    <small class="text-danger">{{ $errors->first('country') }}</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label for="category_name">Address<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="address1"
                                                        name="address">
                                                    <small class="text-danger">{{ $errors->first('address') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label for="category_name">Telephone<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="telephone1"
                                                        name="telephone">
                                                    <small class="text-danger">{{ $errors->first('telephone') }}</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label for="category_name">Email<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="email1"
                                                        name="email">
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
                                                    <label for="category_name">Race<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="race2"
                                                        name="race">
                                                    <small class="text-danger">{{ $errors->first('race') }}</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label for="category_name">Ethnicity<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="ethnicity1"
                                                        name="ethnicity">
                                                    <small class="text-danger">{{ $errors->first('ethnicity') }}</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Gender at Birth<span class="text-danger">*</span></label>
                                                    <select name="gender_birth"
                                                        class="form-control text-box select2size select2 "
                                                        id="gender_birth">
                                                        <option value="">Please select</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                    <small
                                                        class="help-block text-danger">{{ $errors->first('gender_birth') }}</small>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Martial Status<span class="text-danger">*</span></label>
                                                    <select name="martial_status"
                                                        class="form-control text-box select2size select2 "
                                                        id="martial_status">
                                                        <option value="">Please select</option>
                                                        <option value="Married">Married</option>
                                                        <option value="Divorced">Divorced</option>
                                                        <option value="Single">Single</option>
                                                    </select>
                                                    <small
                                                        class="help-block text-danger">{{ $errors->first('martial_status') }}</small>
                                                </div>
                                                {{-- <div class="form-group">
                                                    <label for="category_name">Martial Status<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="martial_status1"
                                                        name="martial_status">
                                                    <small
                                                        class="text-danger">{{ $errors->first('martial_status') }}</small>
                                                </div> --}}
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label for="category_name">Household<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="household"
                                                        name="house_hold">
                                                    <small class="text-danger">{{ $errors->first('house_hold') }}</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label for="category_name">Preferred Language<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="preffered_languages"
                                                        name="preferred_language">
                                                    <small
                                                        class="text-danger">{{ $errors->first('preferred_language') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label for="category_name">Employment Status<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="employment1"
                                                        name="employment_status">
                                                    <small
                                                        class="text-danger">{{ $errors->first('employment_status') }}</small>
                                                </div>
                                            </div>

                                        </div>
                                        {{-- Emergency contact --}}
                                        <h5 class="modal-title" id="exampleModalLabel">EMERGENCY CONTACT</h5>
                                        <hr />
                                        <div class="form-row">
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label for="category_name">names<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="emergency_name2"
                                                        name="emergency_name">
                                                    <small
                                                        class="text-danger">{{ $errors->first('emergency_name') }}</small>
                                                </div>
                                            </div>
                                            <input type="hidden" id="comp_id" name="comp_id"
                                                value="{{ $data->comp_id ?? '' }}">
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label for="category_name">Phone<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="emergency_phone1"
                                                        name="emergency_phone">
                                                    <small
                                                        class="text-danger">{{ $errors->first('emergency_phone') }}</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label for="category_name">Email<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="emergency_email"
                                                        name="emergency_email">
                                                    <small
                                                        class="text-danger">{{ $errors->first('emergency_email') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label for="category_name">Relationship<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="relationship1"
                                                        name="relationship">
                                                    <small
                                                        class="text-danger">{{ $errors->first('relationship') }}</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label for="category_name">Address<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="emergency_address2"
                                                        name="emergency_address">
                                                    <small
                                                        class="text-danger">{{ $errors->first('emergency_address') }}</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label for="category_name">Primary Care Provider<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control"
                                                        id="primary_care_provider1" name="primary_care_provider">
                                                    <small
                                                        class="text-danger">{{ $errors->first('primary_care_provider') }}</small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-4 mb-3" id="insurance_codes">
                                                <div class="form-group">
                                                    <label for="category_name">Insurance Code<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="insurance_code"
                                                        name="insurance_code">
                                                    <small
                                                        class="text-danger">{{ $errors->first('insurance_code') }}</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label for="category_name">Client PIN<span
                                                            class="text-danger">*</span></label>
                                                    <input type="password" class="form-control" id="client_PIN1"
                                                        name="client_PIN">
                                                    <small class="text-danger">{{ $errors->first('client_PIN') }}</small>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-dark btn-lg" id="send_btn"> <i
                                                class="fa fa-plus"></i>&nbsp; Save</button>

                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <!-- The Modal for size-->
            <div class="modal other-size-modal" id="myModalSize">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Other Insurance</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div id="response"></div>
                            <form method="POST" action="" id="add-insurance">
                                @csrf
                                <div class="form-group">
                                    <label>Add new insurance</label>
                                    <input type="text" name="insurance_name" class="form-control text-box"
                                        id="insurance" value="">
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" id="close-size">Ok</button>
                                    <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
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
                        $('#adding-client select').each(function() {
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
            $(document).on("change", ".select2size", function() {
                var select = $(this).val();
                if (select == "Other") {
                    $("#myModalSize").modal("show");
                } else {
                    $("#myModalSize").modal("hide");
                }
            });
            $(document).ready(function() {
                $('#add-insurance').validate({
                    rules: {
                        insurance_name: {
                            required: true,
                            maxlength: 50,
                        },
                    },
                    messages: {
                        insurance_name: {
                            required: "Please enter insurance",
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

                        var insurance = $('#insurance').val();


                        form_data.append('insurance_name', insurance);

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
                                    $('#insurance-id').empty();
                                    for (var i = 0; i < result.data.insurances.length; i++) {

                                        $('#insurance-id').append("<option value=" + result.data
                                            .insurances[i]
                                            .id + ">" + result.data.insurances[i]
                                            .insurance_name +
                                            "</option>");
                                    }
                                    $('#insurance-id').append("<option>Other</option>");

                                    $('#myModalSize').modal('hide');

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
                $(document).on('change', '#insurance-id', function() {
                    var val = $(this).val();
                    // alert(val);
                    if (!val) {
                        $('#insurance_codes').removeClass('insurance_codes');
                        $('#insurance_codes').hide();
                    } else {
                        $('#insurance_codes').attr('class', 'col-md-4 mb-3 insurance_codes');
                        $('#insurance_codes').show();
                    }
                })
            });
        </script>
    @endsection
