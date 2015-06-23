@section("tr")
        <td id="exerciseSelectTD">
            @if(null !== $exercises)
                {!! Form::select("exercise_id[$id]", $exercises, null, array("id"=>"exercises", "class" => "form-control", "onchange"=> "getExerciseValues(this, $id, '" . url("/workout/exercisevalues/") . "')")) !!}
            @endif
        </td>
        <td id="exerciseValueTD">

        </td>
@show



