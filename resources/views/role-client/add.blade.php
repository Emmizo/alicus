@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('role-list-client') }}">Manage Role</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ol>
                </div>
                <!-- <div class="col-sm-6">
                                            <h1>{{ $title }}</h1>
                                        </div> -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-6">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">{{ $title }}</h3>
                    </div>
                    @if (session()->has('success'))
                        <div class="alert alert-success"> {!! session('success') !!} </div>
                        @endif @if (session()->has('error'))
                            <div class="alert alert-danger"> {!! session('error') !!} </div>
                        @endif
                        <form id="add-role-form" action="{{ route('role-save-client') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Enter name" value="{{ old('name') }}">
                                            <small class="help-block text-danger">{{ $errors->first('name') }}</small>
                                        </div>
                                    </div>

                                </div>
                                <input type="hidden" name="company_name" value="{{ $data->company_name }}">

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="role">Permissions</label>
                                            <select class="form-control" name="Permissions[]" id="Permissions"
                                                multiple="multiple">
                                                @foreach ($permissions as $key => $permission)
                                                    <option value="{{ $permission->id }}">{{ $permission->name }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer ">
                                <div class="">
                                    <button type="submit" class="btn btn-dark btn-lg">Save</button>
                                    <a href="{{ route('role-list') }}"
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
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            //Bootstrap Duallistbox
            $('#Permissions').bootstrapDualListbox({
                nonSelectedListLabel: 'Non-selected',
                selectedListLabel: 'Selected',
                preserveSelectionOnMove: 'moved',
                moveOnSelect: false
            });
        });
        $('#add-role-form').bootstrapValidator({
            fields: {
                name: {
                    validators: {
                        notEmpty: {
                            message: 'Name field is required'
                        },
                        stringLength: {
                            max: 50,
                            message: 'Name must be less than 50 characters'
                        }
                    }
                }

            }
        });

        function resetForm() {
            document.getElementById("add-role-form").reset();
            $('#Permissions').bootstrapDualListbox('destroy');
        }
    </script>
@endsection
