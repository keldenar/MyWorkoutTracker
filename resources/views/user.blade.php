@extends('home')

@section('display')

			<div class="panel panel-default">
                @if (null == $user)
                    <div class="panel-heading">User not found.</div>
                @else
				    <div class="panel-heading">{{ $user->name() }}</div>

				    <div class="panel-body">
					    @if(null !== Auth::user())
                            @if ($user->id == Auth::user()->id)
                                <button class="btn btn-default" onclick="showModal( '{{ url('/workout') }}', '#modal')">Log a new workout.</button>
                            @endif
                        @endif
                        @if(null !== $workouts)
                            <table id="workouts" class="table table-hover" style="margin-top: 10px">
                                <tr>
                                    <th class="col-md-3">Date</th><th class="col-md-8">Workout</th>
                                </tr>
                                @foreach($workouts as $workout)
                                    <tr>
                                        <td><a href="{{url("/workout/edit/" . $workout->id)}}">{{ $workout->workout_date }}</a></td>
                                        <td><a href="{{url("/workout/edit/" . $workout->id)}}">{{ $workout->name }}</a></td>
                                    </tr>
                                @endforeach
                            </table>
                        @endif
				    </div>
                @endif
			</div>


<div id="modal"> </div>
@endsection
