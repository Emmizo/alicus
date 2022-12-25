@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="left-side-content">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                        {{-- <li class="breadcrumb-item"><a href="{{ route('invoice', ['id' => $invoices[0]->id]) }}">Manager
                                Invoice</a></li> --}}
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->

    </section>
    <section>

        <div class="mt-5">



            <fieldset class="border p-2 mt-3">
                <legend class="float-none w-auto">Invoice</legend>
                <div class="card-body">
                    @foreach ($invoices as $key => $invoice)
                        <div class="col-12 container font-weight-bold row">

                            <div class="col-md-4 fs-6">
                                <div class="col-md-12 row">
                                    <div class="col-md-3 mb-3 ">Company:</div>
                                    <div class="col-md-8 mb-3 ">{{ $data->company_name ?? '' }}</div>
                                </div>
                                <div class="col-md-12 row">
                                    <div class="col-md-3 mb-3 ">Phone:</div>
                                    <div class="col-md-8 mb-3 ">{{ $data->phone ?? '' }}</div>
                                </div>
                                <div class="col-md-12 row">
                                    <div class="col-md-3 mb-3  ">Email:</div>
                                    <div class="col-md-8 mb-3 ">{{ $data->email ?? '' }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12 ">
                                    <img class="logo-img2 float-right"
                                        src='{{ URL::asset($data->company_logo ?? 'companies_logo/no-logo.png') }}'
                                        alt="{{ $data->company_name ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mt-3 mb-3">
                            <table border="1" class="table table-bordered certificate-table">
                                <tr>
                                    <th colspan="2">BILL TO</th>
                                </tr>
                                <tr>
                                    <td colspan="2"><b>{{ $invoice->client_name ?? '' }}</b></td>
                                </tr>
                                <tr>
                                    <td>Date of birth</td>
                                    <td>{{ $invoice->BOD ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>Admitted</td>
                                    <td>{{ $invoice->admitted ?? '' }}</td>
                                </tr>
                                <tr>

                                    <td colspan="2">{{ $invoice->address ?? '' }}</td>
                                </tr>

                            </table>
                        </div>


                        <div class='d-flex justify-content-center mt-4'>
                            {{-- <h3><u>Invoice</u></h3> --}}
                        </div>

                        <table border="1" class="table table-bordered certificate-table">
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
                    @endforeach
                </div>
            </fieldset>
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
            document.title = '{{ $data->company_name ?? '' }}';

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
