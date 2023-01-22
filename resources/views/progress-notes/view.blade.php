@extends('layouts.app')
@inject('carbon', 'Carbon\Carbon')
@section('content')
    <section class="content-header">
        <div class="left-side-content">
            <div class="row mt-5">
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
            <input class="btn btn-primary float-right" type='button' id='print-data' value='Print'>
        </div>
    </section>
    <div class="card-body" id="card-body">
        <fieldset class="border p-2 mt-3">
            <legend class="float-none w-auto">Progress Notes</legend>
            <table class=" table table-bordered certificate-table" border="1">
                <tbody>

                    <tr>
                        <td>Client Name: {{ $name ?? '' }}</td>

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
                        <td>Date of Birth: {{ $birth ?? '' }}</td>

                        <td>Phone: {{ $data->phone ?? '' }}</td>

                    </tr>
                    <tr>
                        <td>Admitted Date: {{ $created ?? '' }}</td>

                        <td>Email: {{ $data->email ?? '' }}</td>

                    </tr>
                </tbody>

            </table>
            <table border="1" class="table table-bordered certificate-table" width="400">

                @foreach ($groups as $group)
                    <tr>
                        <th colspan="2">PROGRESS NOTE</th>
                    </tr>

                    <tr>

                        <td>
                            <b>PROGRESS NOTE</b><br /><br />
                            <div class="group-content">{!! $group->progress_note !!}</div>
                        </td>
                    </tr>

                    <tr>

                        <td>
                            <b>LEVEL OF PARTICIPATION</b><br /><br />
                            <div class="form-row">
                                <?php $level = json_decode($group->level_participation, true); ?>

                                <div class="col-md- mb-3">
                                    <input type="checkbox" id="level_participation" name="level_participation[]"
                                        value="High" <?= in_array('High', $level ?? []) ? 'checked' : '' ?>>
                                    <label for="vehicle1"> High</label><br>




                                </div>
                                <div class="col-md- mb-3">
                                    <input type="checkbox" id="level_participation" name="level_participation[]"
                                        value="Medium" <?= in_array('Medium', $level ?? []) ? 'checked' : '' ?>>
                                    <label for="vehicle1"> Medium</label><br>




                                </div>
                                <div class="col-md- mb-3">
                                    <input type="checkbox" id="level_participation" name="level_participation[]"
                                        value="Low" <?= in_array('Low', $level ?? []) ? 'checked' : '' ?>>
                                    <label for="vehicle1"> Low</label><br>


                                </div>
                                <div class="col-md- mb-3">
                                    <input type="checkbox" id="level_participation" name="level_participation[]"
                                        value="Neutral" <?= in_array('Neutral', $level ?? []) ? 'checked' : '' ?>>
                                    <label for="vehicle2"> Neutral</label><br>




                                </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Addmitted at</b><br /><br />
                            <div class="group-content">{{ $group->created_at ?? '' }}</div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </fieldset>
        <footer class=" print">
            <strong>
                <div class="float-right">Logged Into As {{ Auth::user()->first_name . '  ' . Auth::user()->last_name }} on
                    {{ $carbon::now()->format('Y-m-d H:i:s') }}</div>
            </strong>

        </footer>
    </div>
@endsection
@section('script')
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            //document.title = '{{ $data->company_name ?? '' }}';

            // function printData() {
            //     var divToPrint = document.getElementById("printData");

            //     newWin = window.print();

            //     newWin.close();

            // }
            function printData() {
                var contents = document.getElementById("card-body").innerHTML;
                var frame1 = document.createElement('iframe');
                frame1.name = "card-body";
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
                    ' </body></html>'
                );
                frameDoc.document.close();
                setTimeout(function() {
                    window.frames["card-body"].focus();
                    window.frames["card-body"].print();
                    document.body.removeChild(frame1);
                }, 100);
                return false;
            }

            $('input#print-data').on('click', function() {
                printData();
            })
            $('input#print-data').click(function() {
                $("#card-body").print();
            });
        })
    </script>
@endsection
