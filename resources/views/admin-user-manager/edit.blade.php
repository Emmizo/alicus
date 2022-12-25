@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="left-side-content">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('manage-user') }}">Manager user</a></li>
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
                    @if (session()->has('success'))
                        <div class="alert alert-success"> {!! session('success') !!} </div>
                        @endif @if (session()->has('error'))
                            <div class="alert alert-danger"> {!! session('error') !!} </div>
                        @endif


                        <form role="form" id="update-employee33" action="{{ route('manage-user-updateAdmin') }}"
                            name="add-user" name="update-employee" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="category_name">First Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="first_name" name="first_name"
                                                value="{{ $info->first_name }}">
                                            <small class="help-block text-danger">{{ $errors->first('first_name') }}</small>
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" value="{{ $info->id }}">
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="category_name">Last Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="last_name" name="last_name"
                                                value="{{ $info->last_name }}">
                                            <small
                                                class="help-block text-danger">{{ $errors->first('employee_last_name') }}</small>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="role">Roles<span class="text-danger">*</span></label>
                                            <select class="form-control" name="role" id="role2">
                                                <option value="">Roles</option>
                                                @foreach ($roles as $key => $role)
                                                    <?php $selected = $role->id == $info->role ? 'selected' : ''; ?>
                                                    <option value="{{ $role->id }}"<?= $selected ?>>
                                                        {{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" name="user_id" id="user_id2" value="{{ $info->user_id }}">

                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="category_name">Email Id<span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="email_id" name="email"
                                                value="{{ $info->email }}">
                                            <small class="help-block text-danger">{{ $errors->first('email') }}</small>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-row">
                                    @if (Auth::user()->role == 1 && Auth::user()->company_id == null)
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="role">Company<span class="text-danger">*</span></label>
                                                <select class="form-control" name="company_id" id="company_id">
                                                    <option value="">Company</option>
                                                    @foreach ($company as $key => $company)
                                                        <?php $selected = $company->id == $info->company_id ? 'selected' : ''; ?>
                                                        <option value="{{ $company->id }}"<?= $selected ?>>
                                                            {{ $company->company_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group col-md-4 mb-3">
                                        <div class="col-xs-12 col-sm-18">
                                            <label for="profile_pic">Profile Pic</label>
                                            <div class="custom-file">
                                                <input type="file" name="profile_pic" class="custom-file-input"
                                                    id="profile_pic">
                                                <p style="color:red;">(File size upto 5MB & allowed png, jpg & jpeg)</p>
                                                <label class="custom-file-label" for="profile_pic">Choose file</label>
                                                <input type="hidden" name="hidden_image" id="hidden_image"
                                                    value="{{ $info->profile_picture }}">
                                                <input type="hidden" name="status" value="{{ $info->status }}">
                                            </div>
                                        </div>

                                        @if ($info->profile_picture)
                                            @if (File::exists(public_path($info->profile_picture)))
                                                <div class="row" id="delimg">
                                                    <div class="col-sm-6"><a href="" style="color:#007bff;"
                                                            onclick="window.open('{{ asset($info->profile_picture) }}','targetWindow', 'toolbar=no, location=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1090px, height=550px, top=25px left=120px'); return false;">
                                                            View Profile Picture </a></div>
                                                    <div class="col-sm-6">
                                                        <a href="#" class="delete-place"
                                                            style="color:#007bff;">Delete</a>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary1" name="status" value="1"
                                            {{ $info->status == 1 ? 'checked' : '' }}>
                                        <label for="radioPrimary1">Active</label>
                                    </div>
                                    <div class="icheck-danger d-inline">
                                        <input type="radio" id="radioPrimary2" name="status" value="0"
                                            {{ $info->status == 0 ? 'checked' : '' }}>
                                        <label for="radioPrimary2">Inactive</label>
                                    </div>
                                </div>
                            </div>


                            <div class="float-right">
                                <button type="submit" class="btn btn-dark btn-lg" id="send_btn2"> <i
                                        class="fa fa-edit"></i>&nbsp; Update</button>
                                <a href="{{ route('manage-user') }}"
                                    class="btn border border-dark btn-lg btn-cancel">Cancel</a>

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
    <script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#add-user').validate({
                rules: {
                    fname: {
                        required: true,
                    },
                    lname: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    phone: {
                        minlength: 14,
                    },
                    chapter: {
                        required: true,
                    },
                    profile_pic: {
                        extension: "jpeg,jpg,png",
                        maxsize: 5242880 // <- 5 MB
                    },
                    role: {
                        required: true,
                    }
                },
                messages: {
                    fname: {
                        required: "Please enter a first name",
                    },
                    lname: {
                        required: "Please enter a last name",
                    },
                    email: {
                        required: "Please enter a email address",
                        email: "Please enter a vaild email address"
                    },
                    phone: {
                        minlength: "Please enter a valid phone number"
                    },
                    profile_pic: {
                        extension: "Please upload file in these format only (jpg, jpeg, png).",
                        maxsize: "File size must be less than 5 mb."
                    },
                    role: {
                        required: "Please select role"
                    }
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
                }
            });
        });

        $(document).ready(function() {
            $('#phone').mask('(000) 000-0000');
        });
    </script>
@endsection
