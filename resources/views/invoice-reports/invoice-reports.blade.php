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

            <div class="card-body " id="printData">
                <div class=" col-lg-12 col-md-4 col-sm-3 d-print-none">
                    {{-- <div class="search">
                        <i class="fa fa-search"></i>
                        <input type="text" class="form-control" id="myInput2" placeholder="Search Insurance"
                            name="insurance_id" value="{{ request('search') }}">
                    </div> --}}
                    <form action="{{ route('report-invoices') }}" method="post">
                        @csrf
                        <div class="search col-md-12 row">
                            {{-- <div class="col-md-3">
                                <select class="form-control col-md-12" type="text" name="search" required>
                                    <option>--Select Payor--</option>
                                    @foreach ($insurancess as $insurance)
                                        <option value="{{ $insurance->id }}">{{ $insurance->insurance_name }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <div class="col-md-3">
                                <input type="date" class="form-control col-md-12" name="from">
                            </div>
                            <div class="col-md-3">
                                <input type="date" class="form-control col-md-12" name="to">
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>

                            <div class="col-md-3 d-print-none">
                                <input class="btn btn-primary" type='button' id='print-data' value='Print'>
                            </div>
                        </div>

                    </form>
                </div>

                <fieldset class="border p-2 mt-3">
                    <legend class="float-none w-auto">Invoice</legend>
                    {{-- <div id="print-invoice33" class="mb-2">
                        <div class="col-12 container font-weight-bold row">

                            <div class="col-md-6 ">
                                <div class="col-md-12 fs-6 row">
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
                            <div class="col-md-6 ">
                                <img class="logo-img2 float-md-right"
                                    src='{{ URL::asset($data->company_logo ?? 'companies_logo/no-logo.png') }}'
                                    alt="{{ $data->company_name ?? '' }}">
                            </div>
                        </div>

                    </div> --}}
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

                    @if ($invoices->count() > 0)
                        <div class="container mb-4 fs-5">
                            {{ $from
                                ? ' from ' .
                                    $from .
                                    ' to ' .
                                    $to .
                                    " Invoice available
                                                                                                                are bellow"
                                : 'All invoices' }}
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
                </fieldset>
                <footer class=" print">
                    <strong>
                        <div class="float-right">Logged Into As
                            {{ Auth::user()->first_name . '  ' . Auth::user()->last_name }} on
                            {{ date('Y-m-d H:i:s') }}</div>
                    </strong>

                </footer>
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
