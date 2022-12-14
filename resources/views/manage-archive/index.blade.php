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
                                {{-- <div class="row  col-8 justify-content-end">
                                    <div class='col-lg-3 col-md-4 col-sm-3'>
                                        <a href="{{ route('client-add') }}" class="btn btn-success" d>
                                            <i class="fa fa-plus-square"></i>&nbsp;{{ $add }}</a>
                                    </div>

                                </div> --}}
                            </div>
                            <br>
                            <br>
                            <div class="col-11 container d-print-none">
                                <input class="btn btn-primary float-right" type='button' id='print-data' value='Print'>
                            </div>
                            <div class="col-12 container row">

                                <div class="col-md-6 fs-6 font-weight-bold print">
                                    <div class="col-md-12 row">
                                        <div class="col-md-6 mb-3">Company:</div>
                                        <div class="col-md-6 mb-3">{{ $data->company_name }}</div>
                                    </div>
                                    <div class="col-md-12 row">
                                        <div class="col-md-6 mb-3">Phone:</div>
                                        <div class="col-md-6 mb-3">{{ $data->phone }}</div>
                                    </div>
                                    <div class="col-md-12 row">
                                        <div class="col-md-6 mb-3">Email:</div>
                                        <div class="col-md-6 mb-3">{{ $data->email }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3 d-flex justify-content-center text-uppercase">
                                <h4> <b>{{ $data->company_name }}</b> clients list</h4>
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
                                                        <th>Discharged date</th>
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
                                                            <td>{{ $client->discharged_at }}</td>

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
                                                                            href="{{ route('dis-client-view', [$client->id]) }}"><i
                                                                                class="fa fa-eye fa-fw"></i>
                                                                            View</a>
                                                                        {{-- <a class="dropdown-item"
                                                                            href="{{ route('client-edit', [$client->id]) }}"><i
                                                                                class="fa fa-edit fa-fw"></i>Edit</a> --}}

                                                                        <a class="dropdown-item"
                                                                            href='{{ route('dis-medication-list', ['id' => $client->company_id, 'client_id' => $client->id, 'name' => $client->client_name]) }}'><i
                                                                                class="fa fa-plus fa-fw"></i>Assign
                                                                            Medical
                                                                        </a>

                                                                        <a class="dropdown-item"
                                                                            href='{{ route('dis-apply-medication-view', ['id' => $client->company_id, 'client' => $client->id, 'name' => $client->client_name]) }}'><i
                                                                                class="fa fa-history fa-fw"></i>Echat
                                                                        </a>

                                                                        <a class="dropdown-item"
                                                                            href="{{ route('dis-document-list', ['id' => $client->id, 'name' => $client->client_name]) }}"><i
                                                                                class="fa fa-paperclip fa-fw"></i>Attachments</a>

                                                                        <a class="dropdown-item"
                                                                            href="{{ route('dis-group-note-list', ['id' => $client->company_id, 'client' => $client->id, 'name' => $client->client_name]) }}"><i
                                                                                class="fa fa-file fa-fw"></i>Group Therapy
                                                                            Notes</a>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('dis-individual', ['id' => $client->company_id, 'client' => $client->id, 'name' => $client->client_name]) }}"><i
                                                                                class="fa fa-file fa-fw"></i>Individual
                                                                            Therapy
                                                                            Notes</a>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('dis-progress', ['id' => $client->company_id, 'client' => $client->id, 'name' => $client->client_name]) }}"><i
                                                                                class="fa fa-file fa-fw"></i>Progress
                                                                            Notes</a>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('dis-invoice', ['id' => $client->id]) }}"><i
                                                                                class="fa fa-file fa-fw"></i>Generate
                                                                            Invoice</a>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('redischarging', ['id' => $client->id]) }}"><i
                                                                                class="fa fa-undo fa-fw"></i>Readmission</a>
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
        });
    </script>
@endsection
