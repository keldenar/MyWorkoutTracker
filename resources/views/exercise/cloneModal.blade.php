@section('modal')
    <div class="modal fade" id="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="ModalLabel">Clone - {{$workout->name}}</h3>
                </div>
                <div class="modal-body">
                    <form id="modalform" class="form-horizontal" method="POST" action="{{ url("/workout/clone") }}">
                        {!! Form::token() !!}
                        {!! Form::hidden("id", $workout->id) !!}
                    </form>
                    <table class="col-md-12 table outlined table-hover" id="workoutTable">
                        <tr>
                            <th class="col-md-3">Category</th>
                            <th class="col-md-3">Exercise</th>
                            <th class="col-md-5">Information</th>
                        </tr>
                        @foreach($workout->workoutExercises as $workoutExercise)
                            <tr id='{{ "workoutExerciseRow" . $workoutExercise->id  }}'>
                                <td>{{$workoutExercise->exercise->exerciseCategory->name }}</td>
                                <td>{{ $workoutExercise->exercise->name }}</td>
                                <td>
                                    @foreach($workoutExercise->workoutValues as $workoutValue)
                                        <p>{{ $workoutValue->internalType->name }}: {{ $workoutValue->value }}</p>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="clearfix"> </div>
                </div>
                <div class="modal-footer">
                    <button form="modalform" class="btn btn-success" type="submit">
                        Clone
                    </button>
                    <button class="btn" data-dismiss="modal" aria-hidden="true">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
@show
