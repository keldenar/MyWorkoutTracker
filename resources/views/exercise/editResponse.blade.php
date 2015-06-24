<tr id='{{ "workoutExerciseRow" . $workoutExercise->id  }}'>
    <td>
        @if(Auth::check())
            @if (Auth::user()->id == $workoutExercise->workout->user_id)
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