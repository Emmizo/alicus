@extends('layouts.app')

@section('content')
    <section>
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
            <div class="col-12 container">
                <input class="btn btn-primary float-right" type='button' id='print-data' value='Print'><br><br>
            </div>
        </section>
        {{-- <div class="col-md-12 mt-3 d-flex justify-content-center text-uppercase">
        <h4><u>INFORMATION DETAIL</u></h4>
    </div> --}}
        <div id="printData">
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
            <table border="1" class="table table-bordered certificate-table" width="500">

                @foreach ($clients as $client)
                    <tr>
                        <td colspan="2">
                            <div class="col-md-12 mt-3 d-flex justify-content-center text-uppercase">
                                <h4>FACESHEET</h4>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2">
                            CLIENT INFORMATION
                        </th>
                    </tr>
                    <tr>
                        <td>CLIENT NAME</td>
                        <td>{{ $client->client_name }}</td>
                    </tr>
                    <tr>
                        <td>DATE OF BIRTH</td>
                        <td>{{ $client->BOD }}</td>
                    </tr>
                    <tr>
                        <td>SSN</td>
                        <td>{{ $client->SSN }}</td>
                    </tr>
                    <tr>
                        <td>PAYOR NAME</td>
                        <td>{{ $client->insurance_name ?? 'No Payor name' }}</td>
                    </tr>
                    <tr>
                        <td>COUNTRY</td>
                        <td>{{ $client->country }}</td>
                    </tr>
                    <tr>
                        <td>ADDRESS</td>
                        <td>{{ $client->address }}</td>
                    </tr>
                    <tr>
                        <td>TELEPHONE</td>
                        <td>{{ $client->telephone }}</td>
                    </tr>
                    <tr>
                        <td>EMAIL</td>
                        <td>{{ $client->email }}</td>
                    </tr>
                    <tr>
                        <th colspan="2">
                            DEMOGRAPHIC
                        </th>
                    </tr>
                    <tr>
                        <td>RACE</td>
                        <td>{{ $client->race }}</td>
                    </tr>
                    <tr>
                        <td>ETHNICITY</td>
                        <td>{{ $client->ethnicity }}</td>
                    </tr>
                    <tr>
                        <td>GENDER AT BIRTH</td>
                        <td>{{ $client->gender_birth }}</td>
                    </tr>
                    <tr>
                        <td>MARTIAL STATUS</td>
                        <td>{{ $client->martial_status }}</td>
                    </tr>
                    <tr>
                        <td>HOUSEHOLD</td>
                        <td>{{ $client->house_hold }}</td>
                    </tr>
                    <tr>
                        <td>PREFERRED LANGUAGE</td>
                        <td>{{ $client->preferred_language }}</td>
                    </tr>
                    <tr>
                        <td>EMPLOYMENT STATUS</td>
                        <td>{{ $client->employment_status }}</td>
                    </tr>
                    <tr>
                        <th colspan="2">
                            EMERGENCY CONTACT
                        </th>
                    </tr>
                    <tr>
                        <td>NAMES</td>
                        <td>{{ $client->emegency_name }}</td>
                    </tr>
                    <tr>
                        <td>PHONE</td>
                        <td>{{ $client->emergency_phone }}</td>
                    </tr>
                    <tr>
                        <td>EMAIL</td>
                        <td>{{ $client->emergency_email }}</td>
                    </tr>
                    <tr>
                        <td>RELATIONSHIP</td>
                        <td>{{ $client->relationship }}</td>
                    </tr>
                    <tr>
                        <td>ADDRESS</td>
                        <td>{{ $client->emergency_address }}</td>
                    </tr>
                @endforeach
        </div>
        </table>
        <footer class=" print">
            <strong>
                <div class="float-right">Logged Into As {{ Auth::user()->first_name . '  ' . Auth::user()->last_name }} on
                    {{ date('Y-m-d H:i:s') }}</div>
            </strong>

        </footer>
        </div>
    </section>
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
@endsection
@section('script')
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>


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
                    '</body></html>'
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
