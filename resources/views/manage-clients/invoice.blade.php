@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="left-side-content">
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
    <section>
        <hr />
        <div class="col-md-12 justify-content-start">
            <img class="logo-img2" src='{{ URL::asset($data->company_logo ?? '') }}' alt="{{ $data->company_name }}">
        </div>
        <hr />
        <div class="mt-5">
            @if ($invoices != 0)
                <div class='d-flex justify-content-center'>
                    <h1><u>Invoice</u></h1>
                </div>
            @endif

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

            @if ($invoices == 0)
                <form role="form" id="create-invoice" action="{{ route('company-save') }}" name="add-category"
                    method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Day started<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="start_date" name="start_date"
                                        value="{{ $started }}">
                                    <small class="text-danger">{{ $errors->first('start_date') }}</small>
                                </div>
                            </div>
                            <input type="hidden" id="clientId" name="client_id" value="{{ $clientId }}">
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Billing Date<span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="billing_date" name="billing_date">
                                    <small class="text-danger">{{ $errors->first('billing_date') }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Number of Day<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="no_of_day" name="no_of_day">
                                    <small class="text-danger">{{ $errors->first('no_of_day') }}</small>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Price Per Day<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="price_per_day" name="price_per_day">
                                    <small class="text-danger">{{ $errors->first('price_per_day') }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Total Price<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="tot" name="tot">
                                    <small class="text-danger">{{ $errors->first('tot') }}</small>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Payment<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="payment" name="payment">
                                    <small class="text-danger">{{ $errors->first('payment') }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Due Payment<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="due_payment" name="due_payment">
                                    <small class="text-danger">{{ $errors->first('due_payment') }}</small>
                                </div>
                            </div>
                            <div class="col-md-4 mt-4">
                                <div class="form-group">

                                    <button type="submit" class="btn btn-dark btn-lg" id="send_btn"> <i
                                            class="fa fa-plus"></i>&nbsp; Save</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @else
                <div class="card-body">

                    <table border="1" class="table table-bordered certificate-table" width="500">
                        <tbody>
                            <tr>
                                <th>Start date</th>
                                <td>{{ $invoice->start_date }}</td>
                            </tr>
                            <tr>
                                <th>Billing date</th>
                                <td>{{ $invoice->billing_date }}</td>
                            </tr>
                            <tr>
                                <th>No of Day</th>
                                <td>{{ $invoice->no_of_day }}</td>
                            </tr>
                            <tr>
                                <th>Price per day</th>
                                <td>{{ $invoice->price_per_day }}</td>
                            </tr>
                            <tr>
                                <th>Total Price</th>
                                <td>{{ $invoice->tot }}</td>
                            </tr>
                            <tr>
                                <th>Payment</th>
                                <td>{{ $invoice->payment }}</td>
                            </tr>
                            <tr>
                                <th>Due Payment</th>
                                <td class="text-red">{{ $invoice->due_payment }}</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <div class="form-row">
                    <div class="col-md-4 d-print-none">
                        <input class="btn btn-primary" type='button' id='print-data' value='Print'>
                    </div>
                    <div class="col-md-4 d-print-none">
                        <input class="btn btn-primary" type='button' data-toggle="modal"
                            data-target="#update-invoice-form" value='Edit'>
                    </div>
                </div>
            @endif
        </div>
        <div class="modal fade " id="update-invoice-form" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <h5 class="modal-title" id="exampleModalLabel">INVOICE FOR {{ $name }}</h5>
                        <hr />
                        <form role="form" id="update-invoice" action="{{ route('company-save') }}"
                            name="add-category" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="category_name">Day started<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="start_date2"
                                                name="start_date" value="{{ $invoice->start_date ?? '' }}">
                                            <small class="text-danger">{{ $errors->first('start_date') }}</small>
                                        </div>
                                    </div>
                                    <input type="hidden" id="invoice_id" name="invoice_id"
                                        value="{{ $invoice->id ?? '' }}">
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="category_name">Billing Date<span
                                                    class="text-danger">*</span></label>
                                            <input type="date" class="form-control" id="billing_date2"
                                                name="billing_date" value="{{ $invoice->billing_date ?? '' }}" <small
                                                class="text-danger">{{ $errors->first('billing_date') }}</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="category_name">Number of Day<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="no_of_day2" name="no_of_day"
                                                value="{{ $invoice->no_of_day ?? '' }}">
                                            <small class="text-danger">{{ $errors->first('no_of_day') }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="category_name">Price Per Day<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="price_per_day2"
                                                name="price_per_day" value="{{ $invoice->price_per_day ?? '' }}">
                                            <small class="text-danger">{{ $errors->first('price_per_day') }}</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="category_name">Total Price<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="tot2" name="tot"
                                                value="{{ $invoice->tot ?? '' }}">
                                            <small class="text-danger">{{ $errors->first('tot') }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="category_name">Payment<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="payment2" name="payment"
                                                value="{{ $invoice->payment ?? '' }}">
                                            <small class="text-danger">{{ $errors->first('payment') }}</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <div class="form-group">
                                            <label for="category_name">Due Payment<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="due_payment2"
                                                name="due_payment" value="{{ $invoice->due_payment ?? '' }}"> <small
                                                class="text-danger">{{ $errors->first('due_payment') }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-4">
                                        <div class="form-group">

                                            <button type="submit" class="btn btn-dark btn-lg" id="send_btn"> <i
                                                    class="fa fa-plus"></i>&nbsp; Save</button>

                                        </div>
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
@section('script')
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {


            $('#create-invoice').validate({
                rules: {
                    start_date: {
                        required: true,
                    },
                    billing_date: {
                        required: true,
                    },
                    no_of_day: {
                        required: true,
                    },

                    price_per_day: {
                        required: true,

                    },
                    tot: {
                        required: true,

                    },

                },
                messages: {
                    start_date: {
                        required: "Please apply started date ",
                    },
                    billing_date: {
                        required: "Please add billing date ",
                    },
                    no_of_day: {
                        required: "Please enter number of day",
                    },

                    price_per_day: {
                        required: "Please enter a price per day",
                    },
                    tot: {
                        minlength: "Please enter total of price",

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
                    $('#create-invoice input').each(function(i, e) {
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
                        url: "{{ route('add-invoice') }}",
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
                                "{{ route('invoice', ['id' => $clientId, 'date' => $started, 'birth' => $birth, 'name' => $name]) }}";
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


            $('#update-invoice').validate({
                rules: {
                    start_date: {
                        required: true,
                    },
                    billing_date: {
                        required: true,
                    },
                    no_of_day: {
                        required: true,
                    },

                    price_per_day: {
                        required: true,

                    },
                    tot: {
                        required: true,

                    },

                },
                messages: {
                    start_date: {
                        required: "Please apply started date ",
                    },
                    billing_date: {
                        required: "Please add billing date ",
                    },
                    no_of_day: {
                        required: "Please enter number of day",
                    },

                    price_per_day: {
                        required: "Please enter a price per day",
                    },
                    tot: {
                        minlength: "Please enter total of price",

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
                    $('#create-invoice input').each(function(i, e) {
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
                        url: "{{ route('update-invoice') }}",
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
                                "{{ route('invoice', ['id' => $clientId, 'date' => $started, 'birth' => $birth, 'name' => $name]) }}";
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
            $(document).on('change', '#billing_date', function() {
                var started = $("#start_date").val();
                var billing = $(this).val();

                var days = daysdifference(started, billing);
                var day = $("#no_of_day").val(days);


                $("#price_per_day").keyup(function() {
                    var price = $(this).val();
                    var tot = $("#tot").val(days * price)

                });
                $("#payment").keyup(function() {
                    var total = $("#tot").val();
                    var payment = $(this).val();
                    var due = $("#due_payment").val(total - payment)
                    console.log(total)
                });

                function daysdifference(started, billing) {
                    var startDay = new Date(started);
                    var endDay = new Date(billing);

                    // Determine the time difference between two dates     
                    var millisBetween = startDay.getTime() - endDay.getTime();

                    // Determine the number of days between two dates  
                    var days = millisBetween / (1000 * 3600 * 24);

                    // Show the final number of days between dates     
                    return Math.round(Math.abs(days));
                }
            });

        });

        $(document).ready(function() {
            $(document).on('change', '#billing_date2', function() {
                var started = $("#start_date2").val();
                var billing = $(this).val();

                var days = daysdifference(started, billing);
                var day = $("#no_of_day2").val(days);


                $("#price_per_day2").keyup(function() {
                    var price = $(this).val();
                    var tot = $("#tot2").val(days * price)

                });


                $("#payment2").keyup(function() {
                    var total = $("#tot2").val();
                    var payment = $(this).val();
                    var due = $("#due_payment2").val(total - payment)
                    alert(total)
                });

                function daysdifference(started, billing) {
                    var startDay = new Date(started);
                    var endDay = new Date(billing);

                    // Determine the time difference between two dates     
                    var millisBetween = startDay.getTime() - endDay.getTime();

                    // Determine the number of days between two dates  
                    var days = millisBetween / (1000 * 3600 * 24);

                    // Show the final number of days between dates     
                    return Math.round(Math.abs(days));
                }
            });

        });
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
