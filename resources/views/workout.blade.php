@extends('home')

@section('display')


			<div class="panel panel-default">

                @if (null == $workout)
                    <div class="panel-heading">Workout not found.</div>
                @else
				    <div class="panel-heading">{{ $workout->user->first_name }} {{ $workout->user->last_name}} : {{ $workout->name }} - {{ $workout->workout_date }}</div>

				    <div class="panel-body">

                        @if(Auth::check())

                            @if (Auth::user()->id == $workout->user_id)
                                <div class="col-md-12">
                                    <a onclick="addExercise( '{{ url("/workout/form/") }}' );">
                                    <span class="glyphicon glyphicon-plus-sign"></span>
                                        Add Exercise
                                    </a>
                                    <a class="pull-right text-danger" onclick="showModal( '{{ url("/workout/delete/" . $workout->id) }}', '#deleteModal' );">
                                        <span class="glyphicon glyphicon-remove"></span>
                                        Delete this workout.
                                    </a>
                                    <div id="deleteModal"></div>
                                </div>
                                {!! Form::open(array('url' => url("/workout/exercise/"), 'method' => 'POST', 'name' => 'exerciseForm', 'id' => 'exerciseForm', 'class' => "form form-horizontal")) !!}
                                {!! Form::hidden("workout_id", $workout->id) !!}
                            @endif
                        @endif


                        <table class="col-md-12 table outlined table-hover" id="workoutTable">
                            <tr>
                                <th class="col-md-1"> </th>
                                <th class="col-md-3">Category</th>
                                <th class="col-md-3">Exercise</th>
                                <th class="col-md-5">Information</th>
                            </tr>
                            @if(Auth::check())
                                @if (Auth::user()->id == $workout->user_id)
                                <tr style="display: none;" id="submitButtonTr">
                                    <td colspan="4" id="submitButtonTd"><button class="btn btn-default">Submit</button></td>
                                </tr>
                                @endif
                            @endif
                            @foreach($workout->workoutExercises as $workoutExercise)
                                <tr id='{{ "workoutExerciseRow" . $workoutExercise->id  }}'>
                                    <td>
                                        @if(Auth::check())
                                            @if (Auth::user()->id == $workout->user_id)
                                                <div class="text-center">
                                                    <a class="text-success" style="padding-right: 20px;" onclick="showModal('{{ url("/workout/editexercise/" . $workoutExercise->id) }}', '#modal') "><span class="glyphicon glyphicon-pencil"></span></a>
                                                    <a class="text-danger" onclick="showModal('{{ url("/workout/deleteexercise/" . $workoutExercise->id) }}', '#modal') "><span class="glyphicon glyphicon-remove text-denger"></span></a>
                                                </div>
                                            @endif
                                        @endif
                                    </td>
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
                        {!! Form::close() !!}
				    </div>
                @endif
			</div>
@endsection
