@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mt-5">
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
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show"> <button type="button"
                                    class="close" data-dismiss="alert" aria-label="Close">
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
                                                                placeholder="Search echat">
                                                        </div>
                                                    </div>
                                                    <div class="row  col-md-12 justify-content-end">
                                                        <div class='col-lg-3 col-md-8 col-sm-3'>
                                                            <a href="#" class="btn btn-success" data-toggle="modal"
                                                                data-target="#add-client">
                                                                <i
                                                                    class="fa fa-plus-square"></i>&nbsp;{{ $add }}</a>
                                                        </div>
                                                        <div class="col-lg-3 col-md-4 col-sm-3">
                                                            <input class="btn btn-primary" type='button' id='print-data'
                                                                value='Print'>
                                                        </div>

                                                    </div>
                                                </div>
                                                <br>
                                                <br>
                                                <div id="printData">
                                                    <div class="col-12 container row">

                                                        <table class=" table table-bordered certificate-table"
                                                            border="1">
                                                            <tbody>

                                                                <tr>
                                                                    <td>Client Name: {{ $name ?? '' }}</td>

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
                                                                    <td>Date of Birth: {{ $birth ?? '' }}</td>

                                                                    <td>Phone: {{ $data->phone ?? '' }}</td>

                                                                </tr>
                                                                <tr>
                                                                    <td>Admitted Date: {{ $admitted ?? '' }}</td>

                                                                    <td>Email: {{ $data->email ?? '' }}</td>

                                                                </tr>

                                                            </tbody>

                                                        </table>
                                                    </div>
                                                    <section class="mt-5">
                                                        <div class="container2">
                                                            <div id="myDIV">
                                                                <div
                                                                    class="col-md-12 mt-3 d-flex justify-content-center text-uppercase">
                                                                    <h4>Medication Administration Record</h4>
                                                                </div>
                                                                @if ($echats->count() > 0)
                                                                    <table class="table table-bordered certificate-table"
                                                                        border="1">
                                                                        <thead>

                                                                            <tr>
                                                                                <th class="w-10px pe-2">
                                                                                    No
                                                                                </th>
                                                                                <th class="min-w-125px hidde-responsive-j6">
                                                                                    Medication
                                                                                </th>

                                                                                <th>Dose Unit</th>
                                                                                <th>Frequency</th>
                                                                                <th>Dose Qty</th>
                                                                                <th>action</th>

                                                                                <th>recorded at</th>
                                                                                {{-- <th>SSN</th> --}}
                                                                                <th>comment</th>
                                                                                <th>client signature</th>
                                                                                <th>Staff signature</th>

                                                                                {{-- <th class="noprint">Actions</th> --}}
                                                                            </tr>

                                                                        </thead>
                                                                        @foreach ($echats as $key => $client)
                                                                            <tbody id="myTable">
                                                                                <tr>
                                                                                    <td>{{ $key + 1 }}</td>
                                                                                    <td>
                                                                                        {{ $client->medication_name }}
                                                                                    </td>
                                                                                    <td>{{ $client->dose_units }}</td>


                                                                                    <td>{{ $client->frequency }}</td>
                                                                                    <td>{{ $client->qty }}</td>
                                                                                    <td>{{ $client->action }}
                                                                                    </td>

                                                                                    <td>{{ $client->recorded_at }}
                                                                                    </td>
                                                                                    <td>{{ $client->comment }}
                                                                                    </td>
                                                                                    {{-- <td>{{ $client->SSN }}</td> --}}
                                                                                    <td><b><i>{{ $client->client_name }}</i></b>
                                                                                    </td>

                                                                                    <td>
                                                                                        <b><i>{{ $client->first_name . ' ' . $client->last_name }}</i></b>
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
                                                <h3>No report found</h3>
                                            </b>
                                        </div>
                        @endif
                    </div>
                </div>

                <br>
                <div class="modal fade " id="add-client" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title col-md-6" id="exampleModalLabel">
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h5 class="modal-title" id="exampleModalLabel">E-CHAT FOR {{ $name }}</h5>
                                <hr />
                                <section class="mt-5">
                                    @if ($medications->count() > 0)
                                        <div class="container2 col-md-12">
                                            <div id="myDIV" class="">
                                                <form role="form" id="echat-medical"
                                                    action="{{ route('echat-medicals') }}" name="add-category"
                                                    method="POST" enctype="multipart/form-data">
                                                    {{-- @csrf --}}
                                                    <div class="mt-4">
                                                        <div class="form-row">
                                                            <div class="col-md-12 mb-3">
                                                                <div class="form-group">
                                                                    <div class="form-row">
                                                                        <div class="col-md-2 mb-3">
                                                                            <label for="category_name">Medication<span
                                                                                    class="text-danger">*</span></label>
                                                                        </div>
                                                                        <div class="col-md-1 mb-3">
                                                                            <label for="category_name">Dose Unit<span
                                                                                    class="text-danger">*</span></label>
                                                                        </div>
                                                                        <div class="col-md-2 mb-3">
                                                                            <label for="category_name">Dose Qty<span
                                                                                    class="text-danger">*</span></label>
                                                                        </div>
                                                                        <div class="col-md-2 mb-3">
                                                                            <label for="category_name">Action<span
                                                                                    class="text-danger">*</span></label>
                                                                        </div>


                                                                        <div class="col-md-3 mb-3">
                                                                            <label for="category_name">Comment</label>
                                                                        </div>

                                                                    </div>
                                                                    </hr>
                                                                    <input type="hidden" name="clientID"
                                                                        value="{{ $medications[0]->client_id ?? '' }}"
                                                                        id="idss">
                                                                    @foreach ($medications as $key => $med)
                                                                        <div class="form-row">
                                                                            <div class="col-md-2 ">
                                                                                <div class="form-group">
                                                                                    <label
                                                                                        class="">{{ $med->medication_name }}
                                                                                        <input type="hidden"
                                                                                            name="medical_id[]"
                                                                                            value="{{ $med->id }}"
                                                                                            id="medical<?= $key ?>">

                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                {{ $med->dose_units }}</div>

                                                                            <div class="col-md-2 ">
                                                                                <div class="form-group">

                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="qty<?= $key ?>" name="qty[]"
                                                                                        onKeyUp="qty(<?= $key ?>)"
                                                                                        value="{{ $med->dose_quantity }}">
                                                                                    <small
                                                                                        class="text-danger">{{ $errors->first('qty') }}</small>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-2 ">
                                                                                <div class="form-group">

                                                                                    <select class="form-control"
                                                                                        name="action[]"
                                                                                        id="action<?= $key ?>"
                                                                                        onChange="actions(<?= $key ?>)">
                                                                                        <option value="">
                                                                                            Please Select
                                                                                        </option>
                                                                                        <option value="refused">
                                                                                            Refused
                                                                                        </option>
                                                                                        <option value="Missed">
                                                                                            Missed
                                                                                        </option>
                                                                                        <option value="Taken">
                                                                                            Taken
                                                                                        </option>
                                                                                    </select>

                                                                                    {{-- <input type="text" class="form-control"
                                                                                    id="ssn1" name="action[]"> --}}
                                                                                    <small
                                                                                        class="text-danger">{{ $errors->first('action') }}</small>
                                                                                </div>
                                                                            </div>


                                                                            <div class="col-md-3 ">
                                                                                <div class="form-group">

                                                                                    <textarea class="form-control" id="comments<?= $key ?>" name="comment[]" row="4">
                                                                                </textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <hr />
                                                                    @endforeach
                                                                    <div class="form-row float-md-right col-12">

                                                                        <div class="col-md-3 mb-3">
                                                                            <div class="form-group">
                                                                                <label for="category_name">Client
                                                                                    Signature<span
                                                                                        class="text-danger">*</span></label>

                                                                                <input type="password"
                                                                                    class="form-control ignore"
                                                                                    id="client_pin" name="client_pin">
                                                                                <small
                                                                                    class="text-danger">{{ $errors->first('client_pin') }}</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="float-right">
                                                        <button type="submit" class="btn btn-primary mr-5 mb-5 addChk"
                                                            id="send_btn">Submit</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    @else
                                        <div class="d-flex justify-content-center ">
                                            <b>
                                                <h5>No Medical applied to {{ $name }} please apply them via <a
                                                        href="{{ route('medication-list', ['id' => $company_id, 'client_id' => $client, 'name' => $name]) }}">here</a>
                                                </h5>
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
                $('#echat-medical').validate({
                    rules: {
                        'client_pin3': {
                            required: true,
                        },


                    },
                    messages: {
                        'client_pin3': {
                            required: "Please client pin required",
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

                        $('#echat-medical input').each(function(i, e) {
                            var getID = $(this).attr('id');
                            var name = $(this).attr('name');
                            form_data.append(name, $("#" + getID).val());
                        });
                        $('#echat-medical select').each(function() {
                            var getID = $(this).attr('id');
                            var name = $(this).attr('name');

                            form_data.append(name, $("#" + getID).val());
                        });
                        $('#echat-medical textarea').each(function() {
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
                            url: "{{ route('echat-medicals') }}",
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
                                console.log(result.status);
                                if (result.status == 201) {
                                    window.location.reload();
                                    // window.location.href = "{{ route('client-list') }}";
                                } else if (result.status == 401) {
                                    var msg = result.message != null ?
                                        'You add wrong pin realy one is ' + result.data : "";
                                    $(`<span id="client_pin-error" class="error invalid-feedback">` +
                                        msg +
                                        `</span>`).insertAfter($('#client_pin'));
                                    $('#client_pin').attr('class',
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

            function qty(keyVal) {
                var input = parseFloat(event.target.value) == '' ? 0 : parseFloat(event.target.value);
                console.log(input);
                var min = $('#qty' + keyVal).val();

                if (input) {
                    $('#qty' + keyVal).attr('class', 'form-control text-box is-valid');
                    $(':input[type="submit"]').prop('disabled', false);
                    $('#send_btn' + keyVal).prop('checked', true);
                } else {
                    $('#qty' + keyVal).attr('class', 'form-control text-box  is-invalid');
                    $('#send_btn' + keyVal).prop('checked', false);
                    $(':input[type="submit"]').prop('disabled', true);

                }
            }

            function actions(keyVal) {
                var input = event.target.value;
                // alert(input)
                var min = $('#action' + keyVal).val();
                // alert(input)
                if (input == "refused" || input == "Missed") {
                    $('#qty' + keyVal).val(0);
                }
                if (input == "Missed") {

                    $("#echat-medical").validate({
                        ignore: "#client_pin",

                    });
                    $('#client_pin').attr('class', 'form-control text-box  is-valid');
                } else {
                    $('#client_pin').attr('class', 'form-control text-box  is-invalid');
                }
                if (input) {
                    $('#action' + keyVal).attr('class', 'form-control text-box is-valid');
                    $(':input[type="submit"]').prop('disabled', false);
                    $('#send_btn' + keyVal).prop('checked', true);
                } else {
                    $('#action' + keyVal).attr('class', 'form-control text-box  is-invalid');
                    $('#send_btn' + keyVal).prop('checked', false);
                    $(':input[type="submit"]').prop('disabled', true);

                }
            }

            // function actions(keyVal) {
            //     var missed = $('#action' + keyVal).val();
            // if (missed == "Missed") {

            //     $("#echat-medical").validate({
            //         ignore: "#client_pin",

            //     });
            //     $('#client_pin').attr('class', 'form-control text-box  is-valid');
            // }

            // }
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
                    var contents = document.getElementById("printData").innerHTML;
                    var frame1 = document.createElement('iframe');
                    frame1.name = "printData";
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
                        '</head><body >'
                    );
                    frameDoc.document.write(contents);
                    frameDoc.document.write(
                        ' </body></html>'
                    );
                    frameDoc.document.close();
                    setTimeout(function() {
                        window.frames["printData"].focus();
                        window.frames["printData"].print();
                        document.body.removeChild(frame1);
                    }, 100);
                    return false;
                }



                $('input#print-data').on('click', function() {
                    printData();
                })
            })
        </script>
    @endsection
