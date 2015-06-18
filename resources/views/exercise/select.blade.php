@section("tr")
        <td id="exerciseSelectTD">
            {!! Form::select("exercise_id[$id]", $exercises->sortBy("name")->lists("name","id"), null, array("id"=>"exercises", "class" => "form-control")) !!}
        </td>
        <td id="exerciseValueTD">
            {!! Form::text("value[$id]",null,array("class"=>"form-control" , "placeholder" => $inputDesc)) !!}
        </td>
@show



