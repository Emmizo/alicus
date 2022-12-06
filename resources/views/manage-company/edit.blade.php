@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="left-side-content">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('company-list') }}">Manager companies</a></li>
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
                    <form role="form" id="add-user" action="{{ route('company-update') }}" name="add-category"
                        method="POST" enctype="multipart/form-data">

                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="category_name">First Name(Owner)<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="first_name2" name="first_name"
                                            value="{{ $company->first_name }}">
                                        <small class="text-danger">{{ $errors->first('first_name') }}</small>
                                    </div>
                                </div>
                                <input type="hidden" name="company_id" value="{{ $company->id }}" id="ids">
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="category_name">Last Name(Owner)<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="last_name2" name="last_name"
                                            value="{{ $company->last_name }}">
                                        <small class="text-danger">{{ $errors->first('last_name') }}</small>
                                    </div>
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="category_name">Phone company<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            value="{{ $company->phone }}">
                                        <small class="text-danger">{{ $errors->first('phone') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="category_name">Company name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="company_name" name="company_name"
                                            value="{{ $company->company_name }}">
                                        <small class="text-danger">{{ $errors->first('company_name') }}</small>
                                    </div>
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="category_name">Email company<span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email2" name="email"
                                            value="{{ $company->email }}">
                                        <small class="text-danger">{{ $errors->first('email') }}</small>
                                    </div>
                                </div>




                            </div>
                            <br>
                            <div class="col-md-4 mb-3 form-group clearfix">
                                <label for="profile_pic">Status</label><br><br>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary1" name="status" checked="" value="1">
                                    <label for="radioPrimary1">Active</label>
                                </div>
                                <div class="icheck-danger d-inline">
                                    <input type="radio" id="radioPrimary2" name="status" value="0">
                                    <label for="radioPrimary2">Inactive</label>
                                </div>
                            </div>


                            <div class="float-left">
                                <button type="submit" class="btn btn-dark btn-lg" id="send_btn"> <i
                                        class="fa fa-plus"></i>&nbsp; Save</button>
                                <a href="{{ route('manage-user') }}"
                                    class="btn border border-dark btn-lg employeesclosee btn-cancel">Cancel</a>

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


            $('#add-user').validate({
                rules: {
                    first_name: {
                        required: true,
                    },
                    last_name: {
                        required: true,
                    },
                    company_name: {
                        required: true,
                    },

                    email: {
                        required: true,
                        email: true,
                    },
                    phone: {
                        required: true,
                        minlength: 14,
                    },


                },
                messages: {
                    first_name: {
                        required: "Please add first name ",
                    },
                    last_name: {
                        required: "Please add last name ",
                    },
                    company_name: {
                        required: "Please enter a first name",
                    },

                    email: {
                        required: "Please enter a email address",
                        email: "Please enter a vaild email address"
                    },
                    phone: {
                        minlength: "Please enter a valid phone number",
                        required: "Please enter a valid phone number",
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
                    $('#add-user input').each(function(i, e) {
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
                        url: "{{ route('company-update') }}",
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
                            window.location.href = "{{ route('company-list') }}";
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
            $('#phone').mask('(000) 000-0000');
        });

        function resetForm() {
            document.getElementById("add-user").reset();
        }
    </script>
@endsection
