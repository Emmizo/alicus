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
        <div class="col-12 container">
            <input class="btn btn-primary" type='button' id='print-data' value='Print'>
        </div>
    </section>
    <div class="col-md-12 mt-3 d-flex justify-content-center text-uppercase">
        <h4><u>INFORMATION DETAIL</u></h4>
    </div>
    <table border="1" class="table table-bordered certificate-table" width="500">

        @foreach ($clients as $client)
            <tr>
                <td colspan="2">
                    <h5>FACESHEET</h5>
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
                <td>INSURANCE ID</td>
                <td>{{ $client->insurance_ID }}</td>
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
