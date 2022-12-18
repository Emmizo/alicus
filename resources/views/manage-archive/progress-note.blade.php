@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
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
                            <div class="row col-12 noprint">
                                <div class=" col-lg-3 col-md-4 col-sm-3">
                                    <div class="search">
                                        <i class="fa fa-search"></i>
                                        <input type="text" class="form-control" id="myInput"
                                            placeholder="Search Progress Note">
                                    </div>
                                </div>
                                <div class="row  col-8 justify-content-end">
                                    {{-- <div class='col-lg-3 col-md-4 col-sm-3'>
                                        <a href="#" class="btn btn-success" data-toggle="modal"
                                            data-target="#add-client">
                                            <i class="fa fa-plus-square"></i>&nbsp;{{ $add }}</a>
                                    </div> --}}
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <input class="btn btn-primary" type='button' id='print-data' value='Print'>
                                    </div>

                                </div>
                            </div>
                            <br>
                            <br>
                            <div id="printData">
                                <div class="col-12 container">
                                    <div class="col-md-12 row">

                                        <div class="col-md-6 fs-6 font-weight-bold">
                                            <div class="col-md-12 ">
                                                <div class="col-md-12 row">
                                                    <div class="col-md-5">
                                                        Client Name:
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <b>{{ $client->client_name ?? '' }}</b>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-12 row">
                                                    <div class="col-md-5 mb-3">
                                                        Date of Birth:
                                                    </div>
                                                    <div class="col-md-7 mb-3">
                                                        <b>{{ $client->BOD }}</b>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-12 row">
                                                    <div class="col-md-5 mb-3">
                                                        Admitted Date:
                                                    </div>
                                                    <div class="col-md-7">
                                                        <b>{{ $client->created_at }}</b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 fs-6 font-weight-bold print">
                                            <div class="col-md-12 row">
                                                <div class="col-md-5 mb-3">Company:</div>
                                                <div class="col-md-7 mb-3">{{ $data->company_name }}</div>
                                            </div>
                                            <div class="col-md-12 row">
                                                <div class="col-md-5 mb-3">Phone:</div>
                                                <div class="col-md-7 mb-3">{{ $data->phone }}</div>
                                            </div>
                                            <div class="col-md-12 row">
                                                <div class="col-md-5 mb-3">Email:</div>
                                                <div class="col-md-7 mb-3">{{ $data->email }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <section class="mt-5">
                                        <div class="container2">
                                            <div id="myDIV">

                                                @if ($groups->count() > 0)
                                                    <table class="table table-bordered certificate-table" border="1">
                                                        <thead>

                                                            <tr>
                                                                <th class="w-10px pe-2">
                                                                    No
                                                                </th>

                                                                <th>Progress Note</th>

                                                                <th>Level Of Participation</th>
                                                                {{-- <th>SSN</th> --}}
                                                                <th>Admitted by</th>
                                                                <th>Admitted date</th>

                                                                <th class="noprint">Actions</th>
                                                            </tr>

                                                        </thead>
                                                        @foreach ($groups as $key => $client)
                                                            <tbody id="myTable">
                                                                <tr>
                                                                    <td>{{ $key + 1 }}</td>

                                                                    <td>{{ $client->progress_note }}</td>

                                                                    <td>{{ preg_replace('/[^A-Za-z0-9\-\(,) ]/', ' ', $client->level_participation) }}
                                                                    </td>
                                                                    {{-- <td>{{ $client->SSN }}</td> --}}
                                                                    <td>{{ $client->first_name . ' ' . $client->last_name }}
                                                                    </td>
                                                                    <td>{{ $client->created_at }}</td>


                                                                    <td class="noprint">
                                                                        <div class="dropdown">
                                                                            <button class=" dropdown-toggle" type="button"
                                                                                id="dropdownMenuButton"
                                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                                aria-expanded="false">
                                                                                ...
                                                                            </button>

                                                                            <div class="dropdown-menu"
                                                                                aria-labelledby="dropdownMenuButton">
                                                                                <a class="dropdown-item"
                                                                                    href="{{ route('view-progress-note-list', ['id' => $client->id, 'name' => $client->client_name, 'birth' => $client->BOD, 'created' => $client->created_at]) }}"><i
                                                                                        class="fa fa-eye fa-fw"></i>
                                                                                    View Notes</a>


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
                                <h3>No Progress Notes found</h3>
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
    </div>
    <!-- Modal -->
    <div class="modal fade " id="add-client" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <form role="form" id="adding-group" action="{{ route('save-group-note') }}" name="add-client-m" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-xl" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title col-md-6" id="exampleModalLabel">

                            <div class="col-12 fs-5 font-weight-bold container">
                                <div class="col-md-12 row">
                                    <div class="col-md-6 mb-3">
                                        Client Name:
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <b>{{ $client->client_name ?? '' }}</b>
                                    </div>
                                </div>
                                <div class="col-md-12 row">
                                    <div class="col-md-6 mb-3">
                                        Date of Birth:
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <b>{{ $client->BOD }}</b>
                                    </div>
                                </div>
                                <div class="col-md-12  row">
                                    <div class="col-md-5 mb-3">
                                        Admitted Date:
                                    </div>
                                    <div class="col-md-7">
                                        <b>{{ $client->created_at }}</b>

                                    </div>
                                </div>
                            </div>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5 class="modal-title text-uppercase" id="exampleModalLabel">Progress Note</h5>
                        <hr />

                        <div class="form-row">
                            <div class="col-md-8 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Progress Note<span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="group_note" name="progress_note" rows="6"></textarea>
                                    <small class="text-danger">{{ $errors->first('progress') }}</small>
                                </div>
                            </div>

                        </div>
                        <input type="hidden" id="client_id" name="client_id" value="{{ $clientID }}">


                        <h5 class="modal-title" id="exampleModalLabel">Level of participation</h5>
                        <hr />
                        <div class="form-row">
                            <div class="col-md- mb-3">
                                <input type="checkbox" id="level_participation" name="level_participation[]"
                                    value="High">
                                <label for="vehicle1"> High</label><br>




                            </div>
                            <div class="col-md- mb-3">
                                <input type="checkbox" id="level_participation" name="level_participation[]"
                                    value="Medium">
                                <label for="vehicle1"> Medium</label><br>




                            </div>
                            <div class="col-md- mb-3">
                                <input type="checkbox" id="level_participation" name="level_participation[]"
                                    value="Low">
                                <label for="vehicle1"> Low</label><br>


                            </div>
                            <div class="col-md- mb-3">
                                <input type="checkbox" id="level_participation" name="level_participation[]"
                                    value="Neutral">
                                <label for="vehicle2"> Neutral</label><br>




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
        $("input:checkbox[name=type]:checked").each(function() {
            Array.push($(this).val());
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
            $('#adding-group').validate({
                rules: {

                    progress_note: {
                        required: true,
                    },


                },
                messages: {

                    progress_note: {
                        required: "Please Group note required",
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
                    // $('#adding-group input').each(function(i, e) {
                    //     var getID = $(this).attr('id');
                    //     var name = $(this).attr('name');
                    //     form_data.append(name, $("#" + getID).val());
                    // });

                    var client = $('#client_id').val();
                    form_data.append('client_id', client);

                    var group = $('#group_note').val();
                    form_data.append('progress_note', group);
                    // $("#send_btn").click(function() {


                    // $("#send_btn").click(function() {
                    var selectedLanguage1 = new Array();
                    $('input[name="level_participation[]"]:checked').each(function() {
                        var level = $(this).val();
                        form_data.append('level_participation[]', level);
                    });

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "{{ route('save-progress-note') }}",
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
                            window.location.href =
                                '{{ route('progress', ['id' => $data->comp_id, 'client' => $clientID, 'name' => $client->client_name]) }}';
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

                newWin.close();

            }


            $('input#print-data').on('click', function() {
                printData();
            })
        })
    </script>
@endsection
