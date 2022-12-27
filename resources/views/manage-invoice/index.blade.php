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

        <div class="mt-5">
            <div class="col-12 container font-weight-bold row">
                <div class="col-md-6 fs-6">
                    <div class="col-md-12 row mb-3">
                        <div class="col-md-3 ">
                            Client Name:
                        </div>
                        <div class="col-md-7 ">
                            <b>{{ $client->client_name ?? '' }}</b>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3 row">
                        <div class="col-md-3 ">
                            Date of Birth:
                        </div>
                        <div class="col-md-7 ">
                            <b>{{ $client->BOD ?? '' }}</b>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3 row">
                        <div class="col-md-3 ">
                            Admitted Date:
                        </div>
                        <div class="col-md-7">
                            <b>{{ $client->created_at ?? '' }}</b>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 fs-6 ">
                    <div class="col-md-12 row">
                        <div class="col-md-3 mb-3">Company:</div>
                        <div class="col-md-8 mb-3">{{ $data->company_name ?? '' }}</div>
                    </div>
                    <div class="col-md-12 row">
                        <div class="col-md-3 mb-3">Phone:</div>
                        <div class="col-md-8 mb-3">{{ $data->phone ?? '' }}</div>
                    </div>
                    <div class="col-md-12 row">
                        <div class="col-md-3 mb-3 ">Email:</div>
                        <div class="col-md-8 mb-3">{{ $data->email ?? '' }}</div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="col-md-12 justify-content-start">
                        <img class="logo-img2" src='{{ URL::asset($data->company_logo ?? 'companies_logo/no-logo.png') }}'
                            alt="{{ $data->company_name ?? '' }}">
                    </div>
                </div>
            </div>
        </div>
        <div class='d-flex justify-content-center'>
            <h3>Invoice</h3>
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
                                <input type="text" class="form-control" id="price_per_day" name="price_per_day"
                                    placeholder="$">
                                <small class="text-danger">{{ $errors->first('price_per_day') }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="category_name">Total Price<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="tot" name="tot" placeholder="$">
                                <small class="text-danger">{{ $errors->first('tot') }}</small>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="category_name">Payment<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="payment" name="payment"
                                    placeholder="$">
                                <small class="text-danger">{{ $errors->first('payment') }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="category_name">Due Payment<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="due_payment" name="due_payment"
                                    placeholder="$">
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
            <table border="1" class="table table-bordered certificate-table" width="500">
                <thead>
                    <tr>
                        <th>Day started</th>
                        <th>Billing Date</th>
                        <th>Number of Day</th>
                        <th>Price per Day</th>
                        <th>Paid</th>
                        <th>Total payment</th>

                        <th>Due Payment</th>
                        <th>Admitted at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @foreach ($invoicess as $key => $invoice)
                    <tbody>
                        <tr>
                            <td>{{ $invoice->start_date }}</td>

                            <td>{{ $invoice->billing_date }}</td>

                            <td>{{ $invoice->no_of_day }}</td>

                            <td>{{ $invoice->price_per_day }}$</td>
                            <th>{{ $invoice->payment }}$</th>
                            <td>{{ $invoice->tot }}$</td>
                            <td class="text-red">{{ $invoice->due_payment }}$ </td>
                            <td>{{ $invoice->created_at }}</td>
                            <td>
                                @if ($key == 0)
                                    <a href="{{ route('view-invoice', ['id' => $invoice->id]) }}">View</a>|<a
                                        href="{{ route('edit-invoice', ['id' => $invoice->id]) }}">Edit</a>|<a
                                        href="{{ route('all-invoice', ['id' => $invoice->clientId]) }}">All</a>
                                @else
                                    <a href="{{ route('view-invoice', ['id' => $invoice->id]) }}">View</a>

                            </td>
                @endif
                </tr>
                </tbody>
        @endforeach
        </table>
        @endif
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
                                    "{{ route('invoice', ['id' => $clientId]) }}";
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
        </script>
    @endsection
