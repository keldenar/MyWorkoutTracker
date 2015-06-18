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
                                </div>
                                {!! Form::open(array('url' => url("/workout/exercise/"), 'method' => 'POST', 'name' => 'exerciseForm', 'id' => 'exerciseForm', 'class' => "form form-horizontal")) !!}
                                {!! Form::hidden("workout_id", $workout->id) !!}
                            @endif
                        @endif


                        <table class="col-md-12 table outlined table-hover" id="workoutTable">
                            <tr>
                                <th class="col-md-1"> </th>
                                <th class="col-md-3">Type</th>
                                <th class="col-md-5">Exercise</th>
                                <td class="col-md-3"> </td>
                            </tr>
                            @if(Auth::check())
                                @if (Auth::user()->id == $workout->user_id)
                                <tr style="display: none;" id="submitButtonTr">
                                    <td colspan="4" id="submitButtonTd"><button class="btn btn-default">Submit</button></td>
                                </tr>
                                @endif
                            @endif
                            @foreach($workout->workoutExercises as $workoutExercise)
                                <tr>
                                    <td></td>
                                    <td>{{$workoutExercise->exercise->exerciseType->name }}</td>
                                    <td>{{ $workoutExercise->exercise->name }}</td>
                                    <td>{{$workoutExercise->value}}</td>
                                </tr>
                            @endforeach
                        </table>
                        {!! Form::close() !!}
				    </div>
                @endif
			</div>

<div id="modal"> </div>


@endsection
