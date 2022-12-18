@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="left-side-content">
            <div class="row mb-2">
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
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">{{ $title }}</h3>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div><br />
                    @endif
                    <form role="form" id="update-client" action="{{ route('company-update') }}" name="add-category"
                        method="POST" enctype="multipart/form-data">
                        @foreach ($clients as $client)
                            <div class="modal-dialog modal-xl" role="document">

                                <div class="modal-content">
                                    <div class="modal-header d-flex justify-content-center">
                                        <h5 class="modal-title fs-3" id="exampleModalLabel">FACESHEET</h5>

                                    </div>
                                    <div class="modal-body">
                                        <h5 class="modal-title" id="exampleModalLabel">CLIENT
                                            INFORMATION</h5>
                                        <hr />
                                        <div class="form-row">
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label for="category_name">Client
                                                        Name<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="client_name2"
                                                        name="client_name" value="{{ $client->client_name }}">
                                                    <small class="text-danger">{{ $errors->first('client_name') }}</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label for="category_name">Date
                                                        of Birth<span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control" id="DBO" name="BOD"
                                                        value="{{ $client->BOD }}">
                                                    <small class="text-danger">{{ $errors->first('email') }}</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label for="category_name">SSN</label>
                                                    <input type="text" class="form-control" id="ssn1" name="SSN"
                                                        value="{{ $client->SSN }}">
                                                    <small class="text-danger">{{ $errors->first('SSN') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label>Payor name<span class="text-danger">*</span></label>
                                                    <select name="insurance_ID"
                                                        class="form-control text-box select2size select2 size"
                                                        id="insurance-id">
                                                        <option value="">Please select</option>
                                                        @foreach ($insurances as $insurance)
                                                            <?php $selected = $insurance->id == $client->insurance_ID ? 'selected' : ''; ?>
                                                            <option value="{{ $insurance->id }}" <?= $selected ?>>
                                                                {{ $insurance->insurance_name }}
                                                            </option>
                                                        @endforeach
                                                        <option value="">Don't use Insurance</option>
                                                        {{-- <option value="Other">Other</option> --}}
                                                    </select>
                                                    <small
                                                        class="help-block text-danger">{{ $errors->first('insurance_ID') }}</small>
                                                    {{-- <label for="category_name">Insurance
                                                        ID<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="insurance_id2"
                                                        name="insurance_ID" value="{{ $client->insurance_ID }}">
                                                    <small class="text-danger">{{ $errors->first('insurance_ID') }}</small> --}}
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label for="category_name">Country<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="country1" name="country"
                                                        value="{{ $client->country }}">
                                                    <small class="text-danger">{{ $errors->first('country') }}</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label for="category_name">Address<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="address1" name="address"
                                                        value="{{ $client->address }}">
                                                    <small class="text-danger">{{ $errors->first('address') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label for="category_name">Telephone</label>
                                                    <input type="text" class="form-control" id="telephone1"
                                                        name="telephone" value="{{ $client->telephone }}">
                                                    <small class="text-danger">{{ $errors->first('telephone') }}</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label for="category_name">Email</label>
                                                    <input type="text" class="form-control" id="email1"
                                                        name="email" value="{{ $client->email }}">
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
                                                    {{-- <label for="category_name">Race<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="race2"
                                                        name="race" value="{{ $client->race }}"> --}}

                                                    <label>Race<span class="text-danger">*</span></label>
                                                    <select name="race"
                                                        class="form-control text-box select2size select2 " id="race2">
                                                        <option value="">Please select</option>
                                                        <option>American Indan or Alaska Native</option>
                                                        <option>Asian</option>
                                                        <option>Black or African-American</option>
                                                        <option>Native Hawaiian or Other Pacific Islander</option>
                                                        <option>White</option>
                                                        <option>Asian-Asian Indian</option>
                                                        <option>Asian-Chinese</option>
                                                        <option>Asian-Fillipino</option>
                                                        <option>Asian-Japanese</option>
                                                        <option>Asian-Korean</option>
                                                        <option>Asian-Vietnamese</option>
                                                        <option>Asian-Vietnamese</option>
                                                        <option>Asian-Other Asian</option>
                                                        <option>Asian-Unknown</option>
                                                        <option>Native Hawaiian or Other Pacific Islander - Chamorro
                                                        </option>
                                                        <option>Native Hawaiian or Other Pacific Islander - Guarmanian
                                                        </option>
                                                        <option>Native Hawaiian or Other Pacific Islander - Native Hawaiian
                                                        </option>
                                                        <option>Native Hawaiian or Other Pacific Islander - Samoan</option>
                                                        <option>Native Hawaiian or Other Pacific Islander - Unknown</option>
                                                        <option>Other</option>
                                                        <option>Unknown</option>
                                                        <option>Alaskan Native</option>
                                                        <option>Multi-Racial</option>

                                                    </select>
                                                    <small class="text-danger">{{ $errors->first('race') }}</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    {{-- <label for="category_name">Ethnicity<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="ethnicity1"
                                                        name="ethnicity" value="{{ $client->ethnicity }}"> --}}

                                                    <label>Ethnicity<span class="text-danger">*</span></label>
                                                    <select name="ethnicity"
                                                        class="form-control text-box select2size select2 "
                                                        id="ethnicity1">
                                                        <option value="">Please select</option>
                                                        <option>Hispanic or Latino</option>
                                                        <option>Ashkenazi Jewish</option>
                                                        <option>Not Hispanic or Latino</option>
                                                        <option>Hispanic or Latino - Central American</option>
                                                        <option>Hispanic or Latino - Cuban</option>
                                                        <option>Hispanic or Latino - Dominican</option>
                                                        <option>Hispanic or Latino - Mexican</option>
                                                        <option>Hispanic or Latino - Other Hispanic</option>
                                                        <option>Hispanic or Latino - Puerto Rican</option>
                                                        <option>Hispanic or Latino - South American</option>
                                                        <option>Haitian</option>
                                                        <option>Spanish/Latino</option>
                                                        <option>Mexican</option>
                                                        <option>Mexican American</option>
                                                        <option>None of the Above</option>
                                                    </select>
                                                    <small class="text-danger">{{ $errors->first('ethnicity') }}</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    {{-- <label for="category_name">Gender
                                                        at Birth<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="gender_at_birth"
                                                        name="gender_birth" value="{{ $client->gender_birth }}"> --}}
                                                    <label>Gender at Birth<span class="text-danger">*</span></label>
                                                    <select name="gender_birth"
                                                        class="form-control text-box select2size select2 "
                                                        id="gender_birth">
                                                        <option value="">Please select</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                        <option value="Unknown">Unknown</option>
                                                    </select>
                                                    <small
                                                        class="text-danger">{{ $errors->first('gender_birth') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label for="category_name">Martial
                                                        Status<span class="text-danger">*</span></label>
                                                    <select name="martial_status"
                                                        class="form-control text-box select2size select2 "
                                                        id="martial_status">
                                                        <option value="">Please select</option>
                                                        <option value="Married">Married</option>
                                                        <option value="Divorced">Divorced</option>
                                                        <option value="Single">Single</option>
                                                    </select>
                                                    {{-- <input type="text" class="form-control" id="martial_status1"
                                                        name="martial_status" value="{{ $client->martial_status }}"> --}}
                                                    <small
                                                        class="text-danger">{{ $errors->first('martial_status') }}</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label for="category_name">Household<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="household"
                                                        name="house_hold" value="{{ $client->house_hold }}">
                                                    <small class="text-danger">{{ $errors->first('house_hold') }}</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label for="category_name">Preferred
                                                        Language<span class="text-danger">*</span></label>

                                                    <select name="preferred_language"
                                                        class="form-control text-box select2size select2 "
                                                        id="preferred_language">
                                                        <option value="">Please select</option>
                                                        <option>English</option>
                                                        <option>Spanish</option>
                                                        <option>French</option>
                                                        <option>Swahili</option>
                                                        <option>Protuguese</option>
                                                        <option>Latin</option>
                                                    </select>
                                                    {{-- <input type="text" class="form-control" id="preffered_languages"
                                                        name="preferred_language"
                                                        value="{{ $client->preferred_language }}"> --}}
                                                    <small
                                                        class="text-danger">{{ $errors->first('preferred_language') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label for="category_name">Employment
                                                        Status<span class="text-danger">*</span></label>
                                                    <select name="employment_status"
                                                        class="form-control text-box select2size select2 "
                                                        id="employment1">
                                                        <option value="">Please select</option>
                                                        <option>Employed</option>
                                                        <option>Unemployed</option>

                                                    </select>
                                                    {{-- <input type="text" class="form-control" id="employment1"
                                                        name="employment_status"
                                                        value="{{ $client->employment_status }}"> --}}
                                                    <small
                                                        class="text-danger">{{ $errors->first('employment_status') }}</small>
                                                </div>
                                            </div>

                                        </div>
                                        {{-- Emergency contact --}}
                                        <h5 class="modal-title" id="exampleModalLabel">EMERGENCY
                                            CONTACT</h5>
                                        <hr />
                                        <div class="form-row">
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label for="category_name">names</label>
                                                    <input type="text" class="form-control" id="emergency_name2"
                                                        name="emergency_name" value="{{ $client->emergency_name }}">
                                                    <small
                                                        class="text-danger">{{ $errors->first('emergency_name') }}</small>
                                                </div>
                                            </div>
                                            <input type="hidden" id="ids" name="id"
                                                value="{{ $client->id ?? '' }}">
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label for="category_name">Phone</label>
                                                    <input type="text" class="form-control" id="emergency_phone1"
                                                        name="emergency_phone" value="{{ $client->emergency_phone }}">
                                                    <small
                                                        class="text-danger">{{ $errors->first('emergency_phone') }}</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label for="category_name">Email</label>
                                                    <input type="text" class="form-control" id="emergency_email"
                                                        name="emergency_email" value="{{ $client->emergency_email }}">
                                                    <small
                                                        class="text-danger">{{ $errors->first('emergency_email') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label for="category_name">Relationship</span></label>
                                                    <input type="text" class="form-control" id="relationship1"
                                                        name="relationship" value="{{ $client->relationship }}">
                                                    <small
                                                        class="text-danger">{{ $errors->first('relationship') }}</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label for="category_name">Address</label>
                                                    <input type="text" class="form-control" id="emergency_address2"
                                                        name="emergency_address"
                                                        value="{{ $client->emergency_address }}">
                                                    <small
                                                        class="text-danger">{{ $errors->first('emergency_address') }}</small>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label for="category_name">Primary
                                                        Care Provider</label>
                                                    <input type="text" class="form-control"
                                                        id="primary_care_provider1" name="primary_care_provider"
                                                        value="{{ $client->primary_care_provider }}">
                                                    <small
                                                        class="text-danger">{{ $errors->first('primary_care_provider') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group">
                                                    <label for="category_name">Client
                                                        PIN<span class="text-danger">*</span></label>
                                                    <input type="password" class="form-control" id="client_PIN1"
                                                        name="client_PIN" value="{{ $client->client_PIN }}">
                                                    <small class="text-danger">{{ $errors->first('client_PIN') }}</small>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{ route('client-list') }}" class="btn btn-secondary">Back</a>
                                        <button type="submit" class="btn btn-dark btn-lg" id="send_btn"> <i
                                                class="fa fa-plus"></i>&nbsp; Update</button>
                                        {{-- <button type="submit" class="btn btn-primary" id="send_btn">Save</button> --}}
                                    </div>
                                </div>
                            </div>


                </div>
                @endforeach
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('style')
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
@endsection
@section('script')
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#update-client').validate({
                rules: {
                    client_name: {
                        required: true,
                    },
                    BOD: {
                        required: true,
                    },
                    // SSN: {
                    //     required: true,
                    // },

                    // email: {
                    //     required: true,
                    //     email: true,
                    // },
                    // telephone: {
                    //     required: true,
                    //     minlength: 14,
                    // },
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
                    // emergency_name: {
                    //     required: true,
                    // },
                    // emergency_phone: {
                    //     required: true,
                    //     minlength: 14,
                    // },
                    // emergency_email: {
                    //     required: true,
                    //     email: true,
                    // },
                    // relationship: {
                    //     required: true,
                    // },
                    // emergency_address: {
                    //     required: true,
                    // },
                    // primary_care_provider: {
                    //     required: true,
                    // },
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
                    // SSN: {
                    //     required: "Please Enter SSN",
                    // },
                    // email: {
                    //     required: "Please enter a email address",
                    //     email: "Please enter a vaild email address"
                    // },
                    // telephone: {
                    //     minlength: "Please enter a valid phone number",
                    //     required: "Please enter a valid phone number",
                    // },
                    insurance_ID: {
                        required: "Please Select payor name",
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
                    // emergency_name: {
                    //     required: "Please enter emergency name",
                    // },
                    // emergency_phone: {
                    //     required: "Please enter emergency phone",
                    // },
                    // emergency_email: {
                    //     required: "Please enter a emergency email address",
                    //     email: "Please enter a vaild email address",
                    // },
                    // relationship: {
                    //     required: "Please enter relationship",
                    // },
                    // emergency_address: {
                    //     required: "Please enter emergency address",
                    // },
                    // primary_care_provider: {
                    //     required: "Please enter primary care provider",
                    // },
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
                    $('#update-client input').each(function(i, e) {
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
                        url: "{{ route('client-update') }}",
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
    </script>
@endsection
