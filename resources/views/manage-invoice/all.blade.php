@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="left-side-content">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                        {{-- <li class="breadcrumb-item"><a href="{{ route('invoice', ['id' => $id]) }}">Manager
                                Invoice</a></li> --}}
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->

    </section>
    <section>
        <div class="form-row">
            <div class="col-md-11 d-print-none">
                <input class="btn btn-primary float-right" type='button' id='print-data' value='Print'>
            </div>
        </div>
        <div class="mt-5" id="printData">




            <div class="card-body ">
                @foreach ($invoices as $key => $invoice)
                    <fieldset class="border p-2">
                        <legend class="float-none w-auto">Invoice</legend>
                        <div id="print-invoice" class="mb-5">
                            <table class=" table table-bordered certificate-table" border="1">
                                <tbody>

                                    <tr>
                                        <td>Client Name: {{ $invoice->client_name ?? '' }}</td>

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
                                        <td>Date of Birth: {{ $invoice->BOD ?? '' }}</td>

                                        <td>Phone: {{ $data->phone ?? '' }}</td>

                                    </tr>
                                    <tr>
                                        <td>Admitted Date: {{ $invoice->admitted ?? '' }}</td>

                                        <td>Email: {{ $data->email ?? '' }}</td>

                                    </tr>

                                </tbody>

                            </table>

                            <div class='d-flex justify-content-center'>
                                <h3><u>Invoice</u></h3>
                            </div>

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
                                        <td>{{ $invoice->price_per_day }}$</td>
                                    </tr>
                                    <tr>
                                        <th>Total Price</th>
                                        <td>{{ $invoice->tot }}$</td>
                                    </tr>
                                    <tr>
                                        <th>Payment</th>
                                        <td>{{ $invoice->payment }}$</td>
                                    </tr>
                                    <tr>
                                        <th>Due Payment</th>
                                        <td class="text-red">{{ $invoice->due_payment }}$</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </fieldset>
                @endforeach
            </div>

            <footer class=" print">
                <strong>
                    <div class="float-right">Logged Into As {{ Auth::user()->first_name . '  ' . Auth::user()->last_name }}
                        on
                        {{ date('Y-m-d H:i:s') }}</div>
                </strong>

            </footer>

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
                var contents = document.getElementById("printData").innerHTML;
                var frame1 = document.createElement('iframe');
                frame1.name = "printData";
                frame1.style.position = "absolute";
                frame1.style.top = "-1000000px";
                document.body.appendChild(frame1);
                var frameDoc = (frame1.contentWindow) ? frame1.contentWindow : (frame1.contentDocument.document) ?
                    frame1.contentDocument.document : frame1.contentDocument;
                frameDoc.document.open();
                frameDoc.document.write('<html><head><title></title>');


                frameDoc.document.write(
                    ' <link href = "{{ asset('/dist/css/adminlte.min.css') }}"rel = "stylesheet" / >'
                );
                frameDoc.document.write(
                    '<link href = "{{ asset('assets/css/style.css') }}"rel = "stylesheet" / > '
                );
                frameDoc.document.write(
                    '<link rel="stylesheet" type="text/css" href="{{ asset('custom/sweetalert2/css/sweetalert2.min.css') }}" />'
                );
                frameDoc.document.write(
                    '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">'


                );
                frameDoc.document.write(
                    '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">'
                );
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
