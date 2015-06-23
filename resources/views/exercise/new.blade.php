@section("tr")
        <tr id="tableRow{{$id}}">

            <td class="text-center">
                <a onclick="removeExercise( '{{ "#tableRow" . $id }}' );"
                <span class="glyphicon glyphicon-remove form-control-static"></span>
            </td>
            <td>
                {!! Form::select("exercise_category_id[$id]", $categories, null, array("id"=>"exerciseCategories", "class" => "form-control", "onchange"=> "getExercises(this, $id, '" . url("/workout/exerciseselect/") . "')" )) !!}                {!! Form::close() !!}
            </td>
            <td id="exercise{{$id}}"></td>
            <td id="value{{$id}}"></td>
        </tr>
@show

