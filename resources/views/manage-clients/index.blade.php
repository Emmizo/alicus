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
                        <div class="card-body" id="card-body">
                            <div class="row col-12 d-print-none">
                                <div class=" col-lg-3 col-md-4 col-sm-3">
                                    <div class="search">
                                        <i class="fa fa-search"></i>
                                        <input type="text" class="form-control" id="myInput"
                                            placeholder="Search Client">
                                    </div>
                                </div>
                                <div class="row  col-8 justify-content-end">
                                    <div class='col-lg-3 col-md-4 col-sm-3'>
                                        <a href="{{ route('client-add') }}" class="btn btn-success" d>
                                            <i class="fa fa-plus-square"></i>&nbsp;{{ $add }}</a>
                                    </div>
                                    <div class="col-md-2  d-print-none">
                                        <input class="btn btn-primary float-right" type='button' id='print-data'
                                            value='Print'>
                                    </div>

                                </div>
                            </div>
                            <br>
                            <br>

                            <table class=" table table-bordered certificate-table" border="1">
                                <tbody>

                                    <tr>

                                        <td>Company: {{ $data->company_name ?? '' }}</td>
                                        <td rowspan="3">
                                            <div class="col-md-12 ">
                                                <img class="logo-img2 float-md-right"
                                                    src='{{ URL::asset($data->company_logo ?? 'companies_logo/no-logo.png') }}'
                                                    alt="{{ $data->company_name ?? '' }}">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>


                                        <td>Phone: {{ $data->phone ?? '' }}</td>

                                    </tr>
                                    <tr>

                                        <td>Email: {{ $data->email ?? '' }}</td>

                                    </tr>
                                </tbody>

                            </table>
                            <div class="col-md-12 mt-3 d-flex justify-content-center text-uppercase">
                                <h4> <b>{{ $data->company_name ?? '' }}</b> clients list</h4>
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
                                                        {{-- <th>Discharged date</th> --}}
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
                                                            {{-- <td>{{ $client->updated_at }}</td> --}}

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
                                                                            href="{{ route('client-view', [$client->id]) }}"><i
                                                                                class="fa fa-eye fa-fw"></i>
                                                                            View for mor info</a>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('client-edit', [$client->id]) }}"><i
                                                                                class="fa fa-edit fa-fw"></i>Edit</a>

                                                                        <a class="dropdown-item"
                                                                            href='{{ route('medication-list', ['id' => $client->company_id, 'client_id' => $client->id, 'name' => $client->client_name]) }}'><i
                                                                                class="fa fa-plus fa-fw"></i>Assign
                                                                            Medical
                                                                        </a>

                                                                        <a class="dropdown-item"
                                                                            href='{{ route('apply-medication-view', ['id' => $client->company_id, 'client' => $client->id, 'name' => $client->client_name]) }}'><i
                                                                                class="fa fa-history fa-fw"></i>E-chat
                                                                        </a>

                                                                        <a class="dropdown-item"
                                                                            href="{{ route('document-list', ['id' => $client->id, 'name' => $client->client_name]) }}"><i
                                                                                class="fa fa-paperclip fa-fw"></i>Attachments</a>

                                                                        <a class="dropdown-item"
                                                                            href="{{ route('group-note-list', ['id' => $client->company_id, 'client' => $client->id, 'name' => $client->client_name]) }}"><i
                                                                                class="fa fa-file fa-fw"></i>Group Therapy
                                                                            Notes</a>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('individual', ['id' => $client->company_id, 'client' => $client->id, 'name' => $client->client_name]) }}"><i
                                                                                class="fa fa-file fa-fw"></i>Individual
                                                                            Therapy
                                                                            Notes</a>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('progress', ['id' => $client->company_id, 'client' => $client->id, 'name' => $client->client_name]) }}"><i
                                                                                class="fa fa-file fa-fw"></i>Progress
                                                                            Notes</a>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('invoice', ['id' => $client->id]) }}"><i
                                                                                class="fa fa-file fa-fw"></i>Generate
                                                                            Invoice</a>
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('discharging', ['id' => $client->id, 'name' => $client->client_name]) }}"><i
                                                                                class="fa fa-close fa-fw"></i>Discharge</a>
                                                                    </div>

                                                                </div>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                @endforeach
                                            </table>

                                    </div>
                                </div>
                                <footer class=" print">
                                    <strong>
                                        <div class="float-right">Logged Into As
                                            {{ Auth::user()->first_name . '  ' . Auth::user()->last_name }} on
                                            {{ date('Y-m-d H:i:s') }}</div>
                                    </strong>

                                </footer>
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
            document.title = '{{ $data->company_name ?? '' }}';

            function printData() {
                var contents = document.getElementById("card-body").innerHTML;
                var frame1 = document.createElement('iframe');
                frame1.name = "card-body";
                frame1.style.position = "absolute";
                frame1.style.top = "-1000000px";
                document.body.appendChild(frame1);
                var frameDoc = (frame1.contentWindow) ? frame1.contentWindow : (frame1.contentDocument.document) ?
                    frame1.contentDocument.document : frame1.contentDocument;
                frameDoc.document.open();
                frameDoc.document.write('<html><head><title>{{ $data->company_name }}</title>');


                frameDoc.document.write(
                    ' <link href = "{{ asset('/dist/css/adminlte.min.css') }}"rel = "stylesheet" / >'
                );
                frameDoc.document.write(
                    '<link href = "{{ asset('assets/css/style.css') }}"rel = "stylesheet" / > '
                );
                frameDoc.document.write(
                    '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">'


                );
                // frameDoc.document.write(
                //     '<img class="logo-img2 float-md-right" src="{{ URL::asset($data->company_logo ?? 'companies_logo/no-logo.png') }}" alt="{{ $data->company_name ?? '' }}">'
                // );
                frameDoc.document.write(
                    '</head><body ><div>'
                );
                frameDoc.document.write(contents);
                frameDoc.document.write(
                    '</div></body></html>'
                );
                frameDoc.document.close();
                setTimeout(function() {
                    window.frames["card-body"].focus();
                    window.frames["card-body"].print();
                    document.body.removeChild(frame1);
                }, 100);
                return false;
            }



            $('input#print-data').on('click', function() {
                printData();
            })
        });
    </script>
@endsection
