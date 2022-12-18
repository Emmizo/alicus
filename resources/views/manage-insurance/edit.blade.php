@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
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

                        <div>
                            <form role="form" id="update-insurance" action="" name="add-client-m" method="POST"
                                enctype="multipart/form-data">
                                <div class="modal-dialog modal-xl" role="document">

                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">PAYOR</h5>
                                            {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> --}}
                                        </div>
                                        <div class="modal-body">
                                            <h5 class="modal-title" id="exampleModalLabel">EDIT PAYOR</h5>
                                            <hr />
                                            <div class="form-row">
                                                <div class="col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="category_name">PAYOR COMPANY<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="insurance_company"
                                                            name="insurance_company"
                                                            value="{{ $insurances->insurance_company }}" <small
                                                            class="text-danger">{{ $errors->first('insurance_company') }}</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="category_name" class="text-uppercase">PAYOR NAME<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="insurance_name"
                                                            name="insurance_name" value="{{ $insurances->insurance_name }}"
                                                            <small
                                                            class="text-danger">{{ $errors->first('insurance_name') }}</small>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="category_name" class="text-uppercase">Telephone<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="phone"
                                                            name="phone" value="{{ $insurances->phone }}"> <small
                                                            class="text-danger">{{ $errors->first('phone') }}</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="category_name" class="text-uppercase">Address<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="address"
                                                            name="address" value="{{ $insurances->address }}"> <small
                                                            class="text-danger">{{ $errors->first('address') }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="id" id="id"
                                                value="{{ $insurances->id }}">
                                            <div class="form-row">
                                                <div class="col-md-8 mb-3">
                                                    <div class="form-group">
                                                        <label for="category_name" class="text-uppercase">Price per day<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="percentage"
                                                            name="percentage" value="{{ $insurances->percentage }}"> <small
                                                            class="text-danger">{{ $errors->first('percentage') }}</small>
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
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-dark btn-lg" id="send_btn"> <i
                                                    class="fa fa-edit"></i>&nbsp; Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
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
                $('#update-insurance').validate({
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
                        var id = $('#id').val();
                        form_data.append('id', id);

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url: "{{ route('update-insurance') }}",
                            type: "POST",
                            dataType: "json",
                            data: form_data,
                            cache: false,
                            contentType: false,
                            processData: false,
                            beforeSend: function() {
                                $('#send_btn').html(
                                    "<i class='fa fa-spin fa-spinner'></i> Submit");
                                $('#send_btn').prop('disabled', true);
                            },
                            success: function(result) {
                                console.log(result);
                                if (result.status == 200) {
                                    $('#insurance-id').empty();

                                    window.location.href = '{{ route('insurance') }}';
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
