@extends('layouts.app')

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
    <div class="card-body">
        <fieldset class="border p-2 mt-3">
            <legend class="float-none w-auto">Progress Notes</legend>
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
                    <div class="modal-body">
                        <h5 class="modal-title text-uppercase" id="exampleModalLabel">Progress Note</h5>
                        <hr />

                        <div class="form-row">
                            <div class="col-md-8 mb-3">
                                <div class="view-tiny ">
                                    <label for="category_name">Progress Note<span class="text-danger">*</span></label>
                                    <textarea class="tinymce-editor" id="group_note" name="progress_note" rows="6" readonly>{!! $group->progress_note ?? '' !!}</textarea>

                                </div>
                            </div>

                        </div>



                        <h5 class="modal-title" id="exampleModalLabel">Level of participation</h5>
                        <hr />
                        <div class="form-row">
                            <?php $level = json_decode($group->level_participation, true); ?>

                            <div class="col-md- mb-3">
                                <input type="checkbox" id="level_participation" name="level_participation[]" value="High"
                                    <?= in_array('High', $level ?? []) ? 'checked' : '' ?>>
                                <label for="vehicle1"> High</label><br>




                            </div>
                            <div class="col-md- mb-3">
                                <input type="checkbox" id="level_participation" name="level_participation[]" value="Medium"
                                    <?= in_array('Medium', $level ?? []) ? 'checked' : '' ?>>
                                <label for="vehicle1"> Medium</label><br>




                            </div>
                            <div class="col-md- mb-3">
                                <input type="checkbox" id="level_participation" name="level_participation[]" value="Low"
                                    <?= in_array('Low', $level ?? []) ? 'checked' : '' ?>>
                                <label for="vehicle1"> Low</label><br>


                            </div>
                            <div class="col-md- mb-3">
                                <input type="checkbox" id="level_participation" name="level_participation[]" value="Neutral"
                                    <?= in_array('Neutral', $level ?? []) ? 'checked' : '' ?>>
                                <label for="vehicle2"> Neutral</label><br>




                            </div>
                            {{-- @endforeach --}}

                        </div>


                    </div>
                @endforeach
                {{-- @foreach ($groups as $group)
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
        @endforeach --}}
            </table>
        </fieldset>
    </div>
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
