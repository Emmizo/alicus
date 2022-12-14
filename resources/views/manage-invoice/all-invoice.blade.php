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

                <fieldset class="border p-2">
                    <legend class="float-none w-auto">Invoice</legend>
                    <div id="print-invoice" class="mb-5">
                        <div class="col-12 container font-weight-bold row">
                            {{-- <div class="col-md-5 fs-6">
                                    <div class="col-md-12 row">
                                        <div class="col-md-5 mb-3">
                                            Client Name:
                                        </div>
                                        <div class="col-md-7 ">
                                            <b>{{ $invoice->client_name ?? '' }}</b>
                                        </div>
                                    </div>
                                    <div class="col-md-12 row">
                                        <div class="col-md-5 mb-3">
                                            Date of Birth:
                                        </div>
                                        <div class="col-md-7 ">
                                            <b>{{ $invoice->BOD ?? '' }}</b>
                                        </div>
                                    </div>
                                    <div class="col-md-12  row">
                                        <div class="col-md-5 mb-3">
                                            Admitted Date:
                                        </div>
                                        <div class="col-md-7">
                                            <b>{{ $invoice->admitted ?? '' }}</b>
                                        </div>
                                    </div>
                                </div> --}}
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

                        <div class='d-flex justify-content-center'>
                            <h3><u>Invoice</u></h3>
                        </div>

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
                                    <tr>
                                        <td>{{ $invoice->client_name }}</td>
                                        <td>{{ $invoice->start_date }}</td>
                                        <td>{{ $invoice->billing_date }}</td>
                                        <td>{{ $invoice->no_of_day }}</td>
                                        <td>{{ $invoice->price_per_day }}</td>
                                        <td>{{ $invoice->tot }}</td>
                                        <?= $sum += $invoice->tot ?>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td style="text-align:right;" colspan="5">Grand Total:</td>
                                    <td>{{ $sum }}</td>
                                </tr>
                                <tr>
                                    <td style="text-align:right;" colspan="5">Payment:</td>
                                    <td>{{ $invoices[0]->due_payment ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td style="text-align:right;" colspan="5">Due Balance:</td>
                                    <td class="text-red">{{ $invoices[0]->due_payment ?? '' }}</td>
                                </tr>
                            </tbody>
                        </table>
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
    </script>
@endsection
