@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="left-side-content">
            <div class="row mt-2">
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
        <fieldset class="border p-2 mt-3 ">
            <legend class="float-none w-auto">Group Therapy Note</legend>

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
                            <b>{{ $birth ?? '' }}</b>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-12 row">
                        <div class="col-md-6 mb-3">
                            Admitted Date:
                        </div>
                        <div class="col-md-6">
                            <b>{{ $created ?? '' }}</b>
                        </div>
                    </div>
                </div>
            </div>
            <table border="1" class="table table-bordered certificate-table" width="500">
                @foreach ($groups as $group)
                    <div class="modal-body">
                        <h5 class="modal-title" id="exampleModalLabel">GROUP SESSION NOTES</h5>
                        <hr />
                        <div class="form-row">
                            <div class="col-md-8 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Topic<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="topic" name="topic"
                                        value="{{ $group->topic }}" readonly>
                                    <small class="text-danger">{{ $errors->first('topic') }}</small>
                                </div>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-8 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Group note<span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="group_note" name="group_note" rows="6" readonly>{{ $group->group_note }}</textarea>
                                    <small class="text-danger">{{ $errors->first('group_note') }}</small>
                                </div>
                            </div>

                        </div>
                        {{-- <input type="hidden" id="client_id" name="client_id" value="{{ $clientID }}"> --}}
                        {{-- Demograph --}}
                        <h5 class="modal-title" id="exampleModalLabel">MOOD</h5>
                        <hr />
                        <div class="form-row">
                            <?php
                            $moods = json_decode($group->mood, true);
                            
                            ?>


                            <div class="col-md- mb-3">
                                @if (in_array('Appropriate', $moods))
                                    <input type="checkbox" id="moods" name="mood[]" value="Appropriate" checked>
                                @else
                                    <input type="checkbox" id="moods" name="mood[]" value="Appropriate">
                                @endif
                                <label for="vehicle1"> Propriate</label><br>
                                @if (in_array('Conflicted', $moods))
                                    <input type="checkbox" id="moods" name="mood[]" value="Conflicted" checked>
                                @else
                                    <input type="checkbox" id="moods" name="mood[]" value="Conflicted">
                                @endif
                                <label for="vehicle2"> Conflicted</label><br>
                                @if (in_array('Annoyed', $moods))
                                    <input type="checkbox" id="moods" name="mood[]" value="Annoyed" checked>
                                @else
                                    <input type="checkbox" id="moods" name="mood[]" value="Annoyed">
                                @endif
                                <label for="vehicle3"> Annoyed</label><br>
                                @if (in_array('Anxious', $moods))
                                    <input type="checkbox" id="moods" name="mood[]" value="Anxious" checked>
                                @else
                                    <input type="checkbox" id="moods" name="mood[]" value="Anxious">
                                @endif
                                <label for="vehicle1"> Anxious</label><br>
                                @if (in_array('Restless', $moods))
                                    <input type="checkbox" id="moods" name="mood[]" value="Restless" checked>
                                @else
                                    <input type="checkbox" id="moods" name="mood[]" value="Restless">
                                @endif
                                <label for="vehicle2"> Restless</label><br>
                                @if (in_array('Energetic', $moods))
                                    <input type="checkbox" id="moods" name="mood[]" value="Energetic" checked>
                                @else
                                    <input type="checkbox" id="moods" name="mood[]" value="Energetic">
                                @endif
                                <label for="vehicle3"> Energetic</label><br><br>
                            </div>

                            <div class="col-md- mb-3">
                                @if (in_array('Inappropriate', $moods))
                                    <input type="checkbox" id="moods" name="mood[]" value="Inappropriate" checked>
                                @else
                                    <input type="checkbox" id="moods" name="mood[]" value="Inappropriate">
                                @endif
                                <label for="vehicle1"> Inappropriate</label><br>
                                @if (in_array('Fearful', $moods))
                                    <input type="checkbox" id="moods" name="mood[]" value="Fearful" checked>
                                @else
                                    <input type="checkbox" id="moods" name="mood[]" value="Fearful">
                                @endif
                                <label for="vehicle2"> Fearful</label><br>
                                @if (in_array('Depressed', $moods))
                                    <input type="checkbox" id="vehicle3" name="mood[]" value="Depressed" checked>
                                @else
                                    <input type="checkbox" id="vehicle3" name="mood[]" value="Depressed">
                                @endif
                                <label for="vehicle3"> Depressed</label><br>
                                @if (in_array('Envious', $moods))
                                    <input type="checkbox" id="moods" name="mood[]" value="Envious" checked>
                                @else
                                    <input type="checkbox" id="moods" name="mood[]" value="Envious">
                                @endif

                                <label for="vehicle1"> Envious</label><br>
                                @if (in_array('Hopeful', $moods))
                                    <input type="checkbox" id="moods" name="mood[]" value="Hopeful" checked>
                                @else
                                    <input type="checkbox" id="moods" name="mood[]" value="Hopeful">
                                @endif
                                <label for="vehicle2"> Hopeful</label><br>
                                @if (in_array('Excited', $moods))
                                    <input type="checkbox" id="moods" name="mood[]" value="Excited" checked>
                                @else
                                    <input type="checkbox" id="moods" name="mood[]" value="Excited">
                                @endif
                                <label for="vehicle3"> Excited</label><br><br>


                            </div>
                            <div class="col-md- mb-3">
                                @if (in_array('Neutral', $moods))
                                    <input type="checkbox" id="moods" name="mood[]" value="Neutral" checked>
                                @else
                                    <input type="checkbox" id="moods" name="mood[]" value="Neutral">
                                @endif
                                <label for="vehicle1"> Neutral</label><br>
                                @if (in_array('Hopeless', $moods))
                                    <input type="checkbox" id="moods" name="mood[]" value="Hopeless" checked>
                                @else
                                    <input type="checkbox" id="moods" name="mood[]" value="Hopeless">
                                @endif
                                <label for="vehicle2"> Hopeless</label><br>
                                @if (in_array('Quilty', $moods))
                                    <input type="checkbox" id="moods" name="mood[]" value="Guilty" checked>
                                @else
                                    <input type="checkbox" id="moods" name="mood[]" value="Guilty" checked>
                                @endif
                                <label for="vehicle3"> Guilty</label><br>
                                @if (in_array('Bored', $moods))
                                    <input type="checkbox" id="moods" name="mood[]" value="Bored" checked>
                                @else
                                    <input type="checkbox" id="moods" name="mood[]" value="Bored">
                                @endif
                                <label for="vehicle1"> Bored</label><br>
                                @if (in_array('Optimistic', $moods))
                                    <input type="checkbox" id="moods" name="mood[]" value="Optimistic" checked>
                                @else
                                    <input type="checkbox" id="moods" name="mood[]" value="Optimistic">
                                @endif
                                <label for="vehicle2"> Optimistic</label><br>
                                @if (in_array('Uninterested', $moods))
                                    <input type="checkbox" id="moods" name="mood[]" value="Uninterested" checked>
                                @else
                                    <input type="checkbox" id="moods" name="mood[]" value="Uninterested">
                                @endif
                                <label for="vehicle3"> Uninterested</label><br><br>


                            </div>
                            <div class="col-md- mb-3">
                                @if (in_array('Cheerful', $moods))
                                    <input type="checkbox" id="moods" name="mood[]" value="Cheerful" checked>
                                @else
                                    <input type="checkbox" id="moods" name="mood[]" value="Cheerful">
                                @endif
                                <label for="vehicle2"> Cheeful</label><br>
                                @if (in_array('Helpless', $moods))
                                    <input type="checkbox" id="moods" name="mood[]" value="Helpless" checked>
                                @else
                                    <input type="checkbox" id="moods" name="mood[]" value="Helpless">
                                @endif
                                <label for="vehicle2"> Helpless</label><br>

                                <input type="checkbox" id="moods" name="mood[]" value="Lonely"
                                    <?= in_array('Lonely', $moods) ? 'checked' : '' ?>>
                                <label for="vehicle3"> Lonely</label><br>

                                <input type="checkbox" id="moods" name="mood[]" value="Regretful"
                                    <?= in_array('Regretful', $moods) ? 'checked' : '' ?>>
                                <label for="vehicle1"> Regretful</label><br>

                                <input type="checkbox" id="moods" name="mood[]" value="Relaxed"
                                    <?= in_array('Relaxed', $moods) ? 'checked' : '' ?>>
                                <label for="vehicle2"> Relaxed</label><br>

                                <input type="checkbox" id="moods" name="mood[]" value="Interested"
                                    <?= in_array('Interested', $moods) ? 'checked' : '' ?>>
                                <label for="vehicle3"> Interested</label><br><br>


                            </div>

                            <div class="col-md- mb-3">
                                <input type="checkbox" id="mood" name="mood[]" value="Angry"
                                    <?= in_array('Angry', $moods) ? 'checked' : '' ?>>
                                <label for="vehicle2"> Angry</label><br>
                                <input type="checkbox" id="moods" name="mood[]" value="Jealous"
                                    <?= in_array('Jealous', $moods) ? 'checked' : '' ?>>
                                <label for="vehicle2"> Jealous</label><br>
                                <input type="checkbox" id="moods" name="mood[]" value="Panicky"
                                    <?= in_array('Panicky', $moods) ? 'checked' : '' ?>>
                                <label for="vehicle3"> Panicky</label><br>
                                <input type="checkbox" id="moods" name="mood[]" value="Tensed"
                                    <?= in_array('Tensed', $moods) ? 'checked' : '' ?>>
                                <label for="vehicle1"> Tensed</label><br>
                                <input type="checkbox" id="moods" name="mood[]" value="Happy"
                                    <?= in_array('Happy', $moods) ? 'checked' : '' ?>>
                                <label for="vehicle2"> Happy</label><br>



                            </div>

                        </div>

                        <h5 class="modal-title" id="exampleModalLabel">Effect</h5>
                        <hr />
                        <?php
                        $effect = json_decode($group->effect, true);
                        ?>
                        <div class="form-row">
                            <div class="col-md- mb-3">
                                <input type="checkbox" id="effects" name="effect[]" value="Motivated"
                                    <?= in_array('Motivated', $effect) ? 'checked' : '' ?>>
                                <label for="vehicle1"> Motivated</label><br>
                                <input type="checkbox" id="effect" name="effect[]" value="Restricted"
                                    <?= in_array('Restricted', $effect) ? 'checked' : '' ?>>
                                <label for="vehicle2"> Restricted</label><br>



                            </div>
                            <div class="col-md- mb-3">
                                <input type="checkbox" id="effect" name="effect[]" value="Angry"
                                    <?= in_array('Angry', $effect) ? 'checked' : '' ?>>
                                <label for="vehicle1"> Angry</label><br>
                                <input type="checkbox" id="effect" name="effect[]" value="Inappropriate"
                                    <?= in_array('Inappropriate', $effect) ? 'checked' : '' ?>>
                                <label for="vehicle2"> Inappropriate</label><br>



                            </div>
                            <div class="col-md- mb-3">
                                <input type="checkbox" id="effect" name="effect[]" value="Anxious"
                                    <?= in_array('Anxious', $effect) ? 'checked' : '' ?>>
                                <label for="vehicle1"> Anxious</label><br>
                                <input type="checkbox" id="effect" name="effect[]" value="Sad"
                                    <?= in_array('Sad', $effect) ? 'checked' : '' ?>>
                                <label for="vehicle2"> Sad</label><br>

                            </div>
                            <div class="col-md- mb-3">
                                <input type="checkbox" id="effect" name="effect[]" value="Appropriate"
                                    <?= in_array('Appropriate', $effect) ? 'checked' : '' ?>>
                                <label for="vehicle2"> Appropriate</label><br>
                                <input type="checkbox" id="vehicle2" name="effect[]" value="Happy"
                                    <?= in_array('Happy', $effect) ? 'checked' : '' ?>>
                                <label for="vehicle2"> Happy</label><br>



                            </div>
                            <div class="col-md- mb-3">
                                <input type="checkbox" id="effect" name="effect[]" value="Fearful"
                                    <?= in_array('Fearful', $effect) ? 'checked' : '' ?>>
                                <label for="vehicle2"> Fearful</label><br>
                                <input type="checkbox" id="vehicle2" name="effect[]" value="Motivated"
                                    <?= in_array('Motivated', $effect) ? 'checked' : '' ?>>
                                <label for="vehicle2"> Motivated</label><br>




                            </div>

                        </div>
                        <h5 class="modal-title" id="exampleModalLabel">Level of participation</h5>
                        <hr />
                        <?php
                        $level = json_decode($group->level_participation, true);
                        ?>
                        <div class="form-row">
                            <div class="col-md- mb-3">
                                <input type="checkbox" id="level_participation" name="level_participation[]"
                                    value="High" <?= in_array('High', $level) ? 'checked' : '' ?>>
                                <label for="vehicle1"> High</label><br>




                            </div>
                            <div class="col-md- mb-3">
                                <input type="checkbox" id="level_participation" name="level_participation[]"
                                    value="Medium" <?= in_array('Medium', $level) ? 'checked' : '' ?>>
                                <label for="vehicle1"> Medium</label><br>




                            </div>
                            <div class="col-md- mb-3">
                                <input type="checkbox" id="level_participation" name="level_participation[]"
                                    value="Low" <?= in_array('Low', $level) ? 'checked' : '' ?>>
                                <label for="vehicle1"> Low</label><br>


                            </div>
                            <div class="col-md- mb-3">
                                <input type="checkbox" id="level_participation" name="level_participation[]"
                                    value="Neutral" <?= in_array('Neutral', $level) ? 'checked' : '' ?>>
                                <label for="vehicle2"> Neutral</label><br>




                            </div>


                        </div>
                        <hr />
                        <div class="form-row">
                            <div class="col-md-8 mb-3">
                                <div class="form-group">
                                    <label for="category_name">Comment if any<span class="text-danger"></span></label>
                                    <textarea class="form-control" id="comments" name="comments" rows="6" readonly>{{ $group->comments ? $group->comments : 'No comment' }}</textarea>

                                </div>
                            </div>

                        </div>

                    </div>
                    {{-- <tr>
                <th colspan="2">GROUP SESSION NOTES</th>
            </tr>
            <tr>
                <th>Topic</th>
                <td>{{ $group->topic }}</td>
            </tr>
            <tr>
                <th>GROUP NOTE</th>
                <td>{{ $group->group_note }}</td>
            </tr>
            <tr>
                <th>MOOD</th>
                <td>{{ preg_replace('/[^A-Za-z0-9\-\(,) ]/', ' ', $group->mood) }}
            </tr>
            <tr>
                <th>EFFECT</th>
                <td>{{ preg_replace('/[^A-Za-z0-9\-\(,) ]/', ' ', $group->effect) }}
            </tr>
            <tr>
                <th>LEVEL OF PARTICIPATION</th>
                <td>{{ preg_replace('/[^A-Za-z0-9\-\(,) ]/', ' ', $group->level_participation) }}
                </td>
            </tr> --}}
                @endforeach
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
