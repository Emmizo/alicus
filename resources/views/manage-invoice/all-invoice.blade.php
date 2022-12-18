@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="left-side-content">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>

                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->

    </section>
    <section>

        <div class="mt-5">




            <div class="card-body ">
                <div class=" col-lg-12 col-md-4 col-sm-3 d-print-none">
                    {{-- <div class="search">
                        <i class="fa fa-search"></i>
                        <input type="text" class="form-control" id="myInput2" placeholder="Search Insurance"
                            name="insurance_id" value="{{ request('search') }}">
                    </div> --}}
                    <form action="{{ route('all-invoices') }}" method="post">
                        @csrf
                        <div class="search col-md-12 row">
                            <div class="col-md-3">
                                <select class="form-control col-md-12" type="text" name="search" required>
                                    <option>--Select insurance--</option>
                                    @foreach ($insurancess as $insurance)
                                        <option value="{{ $insurance->id }}">{{ $insurance->insurance_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="date" class="form-control col-md-12" name="from">
                            </div>
                            <div class="col-md-3">
                                <input type="date" class="form-control col-md-12" name="to">
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                        </div>

                    </form>
                </div>

                <fieldset class="border p-2 mt-3">
                    <legend class="float-none w-auto">Invoice</legend>
                    <div id="print-invoice" class="mb-5">
                        <div class="col-12 container font-weight-bold row">

                            <div class="col-md-6 ">
                                <div class="col-md-12 fs-6 row">
                                    <div class="col-md-3 mb-3 ">Company:</div>
                                    <div class="col-md-8 mb-3 ">{{ $data->company_name }}</div>
                                </div>
                                <div class="col-md-12 row">
                                    <div class="col-md-3 mb-3 ">Phone:</div>
                                    <div class="col-md-8 mb-3 ">{{ $data->phone }}</div>
                                </div>
                                <div class="col-md-12 row">
                                    <div class="col-md-3 mb-3  ">Email:</div>
                                    <div class="col-md-8 mb-3 ">{{ $data->email }}</div>
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <img class="logo-img2 float-md-right" src='{{ URL::asset($data->company_logo ?? '') }}'
                                    alt="{{ $data->company_name }}">
                            </div>
                        </div>
                        @if ($insurances->count() > 0)
                            <div class="col-md-4 mt-5">
                                <table border="1" class="table table-bordered certificate-table">
                                    <tr>
                                        <th colspan="2">BILL TO</th>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><b>{{ $insurances[0]->insurance_company ?? '' }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>Insurance name</td>
                                        <td>{{ $insurances[0]->insurance_name ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td>{{ $insurances[0]->phone ?? '' }}</td>
                                    </tr>
                                    <tr>

                                        <td colspan="2">{{ $insurances[0]->address ?? '' }}</td>
                                    </tr>

                                </table>
                            </div>
                        @endif
                    </div>

                    @if ($invoices->count() > 0)
                        <table border="1" class="table table-bordered certificate-table" width="500">
                            <tbody>
                                <tr>
                                    <th>Client name</th>
                                    <th>Start date</th>
                                    <th>Billing date</th>
                                    <th>No ofDay</th>
                                    <th>Price per day</th>
                                    <th>Amount</th>

                                </tr>

                                <?php $sum = 0; ?>

                                @foreach ($invoices as $key => $invoice)
                            <tbody id="myTable">
                                <tr>
                                    <td>{{ $invoice->client_name }}</td>
                                    <td>{{ $invoice->start_date }}</td>
                                    <td>{{ $invoice->billing_date }}</td>
                                    <td>{{ $invoice->no_of_day }}</td>
                                    <td>{{ $invoice->price_per_day }}</td>
                                    <td>{{ $invoice->tot }}</td>

                                    <?php $sum += $invoice->tot; ?>

                                </tr>
                            </tbody>
                    @endforeach
                    <tr>
                        <td style="text-align:right;" colspan="5">Grand Total:</td>
                        <td>{{ $sum }}</td>
                    </tr>
                    <tr>
                        <td style="text-align:right;" colspan="5">Payment:</td>
                        <td>{{ $paid ?? '' }}</td>
                    </tr>
                    <tr>
                        <td style="text-align:right;" colspan="5">Due Balance:</td>
                        <td class="text-red">{{ $sum - $paid ?? '' }}</td>
                    </tr>
                    </tbody>
                    </table>
                @else
                    <div class="d-flex justify-content-center">From <b>{{ ' ' . $from ?? '' }}</b> to
                        <b>{{ $to . ' ' ?? '' }}</b> No Invoice
                        available
                    </div>
                    @endif
            </div>
            </fieldset>

        </div>
        <div class="form-row">
            <div class="col-md-4 d-print-none">
                <input class="btn btn-primary" type='button' id='print-data' value='Print'>
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
            document.title = '{{ $data->company_name }}';

            function printData() {

                var divToPrint = document.getElementById("printData");

                newWin = window.print('#print-invoice');

                newWin.close();

            }


            $('input#print-data').on('click', function() {
                printData();
            })
        })
        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

        });
    </script>
@endsection
