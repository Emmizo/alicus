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
    <div class="col-md-12 fs-6 font-weight-bold mt-3 ">
        <div class="col-md-6">
            <div class="col-md-12 row">
                <div class="col-md-6">
                    Client Name:
                </div>
                <div class="col-md-6 mb-3">
                    <b>{{ $name ?? '' }}</b>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="col-md-12 row">
                <div class="col-md-6 mb-3">
                    Date of Birth:
                </div>
                <div class="col-md-6 mb-3">
                    <b>{{ $birth }}</b>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="col-md-12 row">
                <div class="col-md-6 mb-3">
                    Admitted Date:
                </div>
                <div class="col-md-6">
                    <b>{{ $created }}</b>
                </div>
            </div>
        </div>
    </div>
    <table border="1" class="table table-bordered certificate-table" width="400">
        @foreach ($groups as $group)
            <tr>
                <th colspan="2">PROGRESS NOTE</th>
            </tr>

            <tr>
                <th>PROGRESS NOTE</th>
                <td>{{ $group->progress_note }}</td>
            </tr>

            <tr>
                <th>LEVEL OF PARTICIPATION</th>
                <td>{{ preg_replace('/[^A-Za-z0-9\-\(,) ]/', ' ', $group->level_participation) }}
                </td>
            </tr>
        @endforeach
    </table>
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
                newWin = window.print();

                newWin.close();

            }


            $('input#print-data').on('click', function() {
                printData();
            })
        })
    </script>
@endsection
