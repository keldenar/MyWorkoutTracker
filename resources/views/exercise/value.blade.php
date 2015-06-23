@section("tr")
    <?php $count = 0 ?>
        <td id="exerciseValueTD">
            @if (null !== $fields)
                @foreach($fields as $value)
                    {!! Form::text("value_id[$id][$count]", null, array("class"=>"form-control", "placeholder"=> $value->internalType->name)) !!}
                    <?php $count = $count + 1 ?>
                @endforeach
            @endif
        </td>
@show



