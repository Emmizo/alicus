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
                                                        <div class="col-md-6">
                                                            <div class="col-md-12 row">
                                                                <div class="col-md-3 mb-3">
                                                                    Cleint Name:
                                                                </div>
                                                                <div class="col-md-4 ">
                                                                    <b>{{ $name ?? '' }}</b>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 row">
                                                                <div class="col-md-3 mb-3">
                                                                    Date of Birth:
                                                                </div>
                                                                <div class="col-md-3 ">
                                                                    <b>{{ $birth ?? '' }}</b>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12  row">
                                                                <div class="col-md-3 mb-3">
                                                                    Admitted Date:
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <b>{{ $started ?? '' }}</b>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 ">
                                                            <div class="col-md-12 row">
                                                                <div class="col-md-3 mb-3">Company:</div>
                                                                <div class="col-md-3 mb-3">{{ $data->company_name }}</div>
                                                            </div>
                                                            <div class="col-md-12 row">
                                                                <div class="col-md-3 mb-3">Phone:</div>
                                                                <div class="col-md-3 mb-3">{{ $data->phone }}</div>
                                                            </div>
                                                            <div class="col-md-12 row">
                                                                <div class="col-md-3 mb-3">Email:</div>
                                                                <div class="col-md-3 mb-3">{{ $data->email }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <section class="mt-5">
                                                        <div class="container2">
                                                            <div id="myDIV">
                                                                <div
                                                                    class="col-md-12 mt-3 d-flex justify-content-center text-uppercase">
                                                                    <h4><u>Report of how medicine taken</u></h4>
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
                                                                                <th>Dose Quantity</th>
                                                                                <th>action</th>
                                                                                {{-- <th>Email</th> --}}
                                                                                <th>Quantity</th>
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
                                                                                    <td>{{ $client->dose_quantity }}</td>
                                                                                    <td>{{ $client->action }}
                                                                                    </td>
                                                                                    <td>{{ $client->qty }}</td>
                                                                                    <td>{{ $client->recorded_at }}
                                                                                    </td>
                                                                                    <td>{{ $client->comment }}
                                                                                    </td>
                                                                                    {{-- <td>{{ $client->SSN }}</td> --}}
                                                                                    <td><img src='{{ $client->client_pin }}'
                                                                                            height="40" />
                                                                                    </td>

                                                                                    <td><img src='{{ $client->staff_signature }}'
                                                                                            height="40" />
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
                                <h5 class="modal-title" id="exampleModalLabel">ECHAT FOR {{ $name }}</h5>
                                <hr />
                                <section class="mt-5">
                                    @if ($medications->count() > 0)
                                        <div class="container2 col-md-12">
                                            <div id="myDIV" class="">
                                                <form role="form" id="echat-medical"
                                                    action="{{ route('echat-medicals') }}" name="add-category"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
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

                                                                    @foreach ($medications as $key => $med)
                                                                        <div class="form-row">
                                                                            <div class="col-md-2 ">
                                                                                <div class="form-group">
                                                                                    <label
                                                                                        class="">{{ $med->medication_name }}
                                                                                        <input type="checkbox"
                                                                                            name="medical_id[]"
                                                                                            value="{{ $med->id }}"
                                                                                            checked>
                                                                                        <span class="checkmark"></span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                {{ $med->dose_units }}</div>
                                                                            {{-- <div class="col-md-1">
                                                                                {{ $med->dose_quantity }}</div> --}}
                                                                            {{-- <input type="hidden" name="client_id" id="client_id"
                                                                    value="{{ $client }}"> --}}
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
                                                                                <canvas id="signature" class="signature"
                                                                                    height="90"
                                                                                    style="border: 1px solid #ddd;"></canvas>
                                                                                <br>

                                                                                <div class="col-md-12 row">
                                                                                    <div class="col-md-3">
                                                                                        <input type="button"
                                                                                            value="Clear"
                                                                                            id="clear-signature"></input>
                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <input type="button"
                                                                                            value="Confirm"
                                                                                            id="confirm"></input>
                                                                                    </div>
                                                                                </div>

                                                                                <img src='' id='sign_prev'
                                                                                    style='display: block;' />
                                                                                <input type="hidden" class="form-control"
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
                        'client_pin': {
                            required: true,
                        },


                    },
                    messages: {
                        'client_pin': {
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
                    // submitHandler: function(form, e) {
                    //     e.preventDefault();
                    //     console.log('Form submitted');

                    //     var form_data = new FormData();


                    //     var client = $("#client_pin").val();
                    //     form_data.append("client_pin", client);
                    //     var staff = $('#staff_id').val();
                    //     form_data.append("staff_id", staff);
                    //     var action = $('#action').val();
                    //     form_data.append("action", action);
                    //     var qty = $('#qty').val();
                    //     form_data.append("qty", qty);
                    //     var comment = $('#comments').val();
                    //     form_data.append("comment", comment);
                    //     var chk = $("input[type='checkbox']:checked").each(function() {

                    //         form_data.append('medical_id[]', this.value)
                    //     });

                    //     // $(".addChk").click(function() {
                    //     //     var selectedLanguage = new Array();
                    //     //     $('input[name="medical_id"]:checked').each(function() {
                    //     //         selectedLanguage.push(this.value);
                    //     //     });
                    //     //     alert("Number of selected Languages: " + selectedLanguage);
                    //     // });
                    //     $.ajaxSetup({
                    //         headers: {
                    //             'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    //         }
                    //     });

                    //     $.ajax({
                    //         url: "{{ route('echat-medicals') }}",
                    //         type: "POST",
                    //         dataType: "json",
                    //         data: form_data,
                    //         cache: false,
                    //         contentType: false,
                    //         processData: false,
                    //         beforeSend: function() {
                    //             $('#send_btn').html(
                    //                 "<i class='fa fa-spin fa-spinner'></i> Submit");
                    //         },
                    //         success: function(result) {
                    //             // window.location.href = "{{ route('client-list') }}";
                    //             // $('#send_btn').html(" Submit");
                    //         },
                    //         error: function(error) {
                    //             console.log(error);
                    //         }
                    //     });
                    //     return false;
                    // }
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

                var min = $('#action' + keyVal).val();
                if (input == "refused") {
                    $('#qty' + keyVal).val(0);
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
            $(document).ready(function() {
                $('#telephone1').mask('(000) 000-0000');
                $('#emergency_phone1').mask('(000) 000-0000');
            });

            function resetForm() {
                document.getElementById("add-user").reset();
            }
            $(document).ready(function() {

                $('#echat-medical').validate();
                $('input[type="text"]').each(function() {
                    $(this).rules('add', {
                        required: true
                    });

                });
                $('select').each(function() {
                    $(this).rules('add', {
                        required: true
                    });

                });

            });
            jQuery(document).ready(function($) {

                var canvas = document.getElementById("signature");
                var signaturePad = new SignaturePad(canvas);
                $('#confirm').click(function() {
                    var data = signaturePad.toDataURL('image/png');
                    $('#client_pin').val(data);

                    $("#sign_prev").show();
                    $("#sign_prev").attr("src", data);
                    // Open image in the browser
                    //window.open(data);
                });
                $('#clear-signature').on('click', function() {
                    signaturePad.clear();
                });
                var canvas = document.getElementById("signature1");
                var signaturePad1 = new SignaturePad(canvas);
                $('#confirm1').click(function() {
                    var data = signaturePad1.toDataURL('image/png');
                    $('#staff_signature').val(data);

                    $("#sign_prev1").show();
                    $("#sign_prev1").attr("src", data);
                    // Open image in the browser
                    //window.open(data);
                });
                $('#clear-signature1').on('click', function() {
                    signaturePad1.clear();
                });

            });
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
            })
        </script>
    @endsection