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
                    <form role="form" id="update-medication" action="" name="add-client-m" method="POST"
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
                                    <h5 class="modal-title" id="exampleModalLabel">{{ $add }}</h5>
                                    <hr />
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <div class="form-group">
                                                <label for="category_name">Medicaton Name<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="medication"
                                                    name="medication_name" value="{{ $medicals->medication_name }}" <small
                                                    class="text-danger">{{ $errors->first('medication_name') }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="form-group">
                                                <label for="category_name">Dose Units<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="dose_unit" name="dose_units"
                                                    value="{{ $medicals->dose_units }}">
                                                <small class="text-danger">{{ $errors->first('dose_units') }}</small>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <div class="form-group">
                                                <label for="category_name">Frequency<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="frequencies" name="frequency"
                                                    value="{{ $medicals->frequency }}">
                                                <small class="text-danger">{{ $errors->first('frequency') }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="form-group">
                                                <label for="category_name">Prescriber<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="prescribes" name="prescriber"
                                                    value="{{ $medicals->prescriber }}">
                                                <small class="text-danger">{{ $errors->first('prescriber') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" id="ids" value="{{ $medicals->id }}">
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <div class="form-group">
                                                <label for="category_name">Dose Quantity<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="dose_qty"
                                                    name="dose_quantity" value="{{ $medicals->dose_quantity }}">
                                                <small class="text-danger">{{ $errors->first('dose_quantity') }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="form-group">
                                                <label for="category_name">Date Start<span
                                                        class="text-danger">*</span></label>
                                                <input type="date" class="form-control" id="date_started"
                                                    name="date_start" value="{{ $medicals->date_start }}">
                                                <small class="text-danger">{{ $errors->first('date_start') }}</small>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer float-left">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-dark btn-lg" id="send_btn"> <i
                                            class="fa fa-plus"></i>&nbsp; Save</button>
                                </div>
                            </div>
                        </div>
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
            $('#update-medication').validate({
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
                    $('#update-medication input').each(function(i, e) {
                        var getID = $(this).attr('id');
                        var name = $(this).attr('name');
                        form_data.append(name, $("#" + getID).val());
                    });

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr(
                                'content')
                        }
                    });

                    $.ajax({
                        url: "{{ route('medication-update') }}",
                        type: "POST",
                        dataType: "json",
                        data: form_data,
                        cache: false,
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            $('#send_btn').html(
                                "<i class='fa fa-spin fa-spinner'></i> Submit"
                            );
                        },
                        success: function(result) {
                            // window.location.href = "{{ route('client-list') }}";
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
