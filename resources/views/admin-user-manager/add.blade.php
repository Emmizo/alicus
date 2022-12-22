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
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div><br />
                    @endif
                    <form role="form" id="add-user" action="{{ route('manage-user-saveAdmin') }}" name="add-category"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="category_name">First Name(Owner)<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="first_name2" name="first_name">
                                        <small class="text-danger">{{ $errors->first('first_name') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="category_name">Last Name(Owner)<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="last_name2" name="last_name">
                                        <small class="text-danger">{{ $errors->first('last_name') }}</small>
                                    </div>
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="category_name">Email Id<span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email2" name="email">
                                        <small class="text-danger">{{ $errors->first('email') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="role">Roles<span class="text-danger">*</span></label>
                                        <select class="form-control" name="role" id="role2">
                                            <option value="">Roles</option>
                                            @foreach ($roles as $key => $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                @if (Auth::user()->role == 1)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="role">Company<span class="text-danger">*</span></label>
                                            <select class="form-control" name="company_id" id="role2">
                                                <option value="">Company</option>
                                                @foreach ($company as $key => $company)
                                                    <option value="{{ $company->id }}">
                                                        {{ $company->company_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-4 mb-3 form-group">
                                    <label for="profile_pic">Profile Pic</label>
                                    <div class="custom-file">
                                        <input type="file" name="profile_pic" class="custom-file-input" id="profile_pic"
                                            accept="image/*">
                                        <img id="blah" />
                                        <p style="color:red;">(File size upto 5MB & allowed png, jpg & jpeg)</p>
                                        <label class="custom-file-label" for="profile_pic">Choose file</label>
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
                        </div>

                        <div class="float-right">
                            <button type="submit" class="btn btn-dark btn-lg" id="send_btn2"> <i
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
            profile_pic.onchange = evt => {
                const [file] = profile_pic.files
                if (file) {
                    blah.src = URL.createObjectURL(file)
                }
            }

            $('#add-user').validate({
                rules: {
                    first_name: {
                        required: true,
                    },
                    last_name: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    phone: {
                        minlength: 14,
                    },
                    profile_pic: {
                        extension: "jpeg,jpg,png",
                        maxsize: 5242880 // <- 5 MB
                    },
                    role: {
                        required: true,
                    },
                    plant_head: {
                        required: true,
                    },
                    plant_name: {
                        required: true
                    },
                    department_name: {
                        required: true,
                    },
                    department_head: {
                        required: true,
                    },
                    is_platform_user: {
                        required: true,
                    },
                    management_rep: {
                        required: true,
                    },
                    customer_complaints_rep: {
                        required: true,
                    },
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
                    },
                    plant_head: {
                        required: "Please select plant head",
                    },
                    plant_head: {
                        required: "Plase select plant name"
                    },
                    department_name: {
                        required: "Please select department name",
                    },
                    department_head: {
                        required: "Please select department head",
                    },
                    is_platform_user: {
                        required: "Please select platform user ",
                    },
                    management_rep: {
                        required: "Please select management Representative",
                    },
                    customer_complaints_rep: {
                        required: "Please select customer",
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
