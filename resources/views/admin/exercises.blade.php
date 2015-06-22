@extends("admin.admin")

@section("adminContent")
<div class="panel panel-default">
    <div class="panel-heading">Role Admin</div>
    <div class="panel-body">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="form-horizontal" method="POST" action="{{ url("/admin/exercises") }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label class="col-md-4 control-label">Exercise Category</label>
                <div class="col-md-6">
                    {!!  Form::select('exercise_category_id', $categories->lists("name","id"), null,array("class"=>"form-control")) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Exercise</label>
                <div class="col-md-6">
                    {!! Form::text('name',null,array("class"=>"form-control")) !!}
                </div>
            </div>
            <div class="form-group" id="formgroup_0">
                <label class="col-md-4 control-label">Value Type</label>
                <div class="col-md-6">
                    {!!  Form::select('internal_type_id[0]', $internalType->lists("name","id"), null,array("class"=>"form-control")) !!}

                </div>
            </div>
            <a onclick="addSelect();"><span class="glyphicon glyphicon-plus-sign"></span>Add additional Type</a>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">Add Exercise</button>
                </div>
            </div>
        </form>
        @if (null !== $exercises)
            <hr>
            <table class="table">
                <thead>
                <tr>
                    <th class="col-md-3">Type</th>
                    <th class="col-md-3">Exercise</th>
                    <th class="col-md-3">Values</th>
                    <th class="col-md-2">Action</th>
                </tr>
                </thead>
                <tbody>
            @foreach($categories as $category)
                <?php $count = 0 ?>
                @foreach($category->Exercises->sortBy("name") as $exercise)
                        <tr>
                            @if ($count == 0)
                                <td rowspan="{{ $category->Exercises->count() }}">
                                    {{ $category->name }}
                                </td>
                                <?php $count = $count + 1 ?>
                            @endif
                            <td>

                                {{ $exercise->name }}
                            </td>
                            <td>
                                @foreach($exercise->exerciseValueTypes as $valueType)
                                    {{$valueType->internalType->name}}
                                @endforeach
                            </td>
                            <td>
                                <!-- TODO Edit should handle being able to add descriptions and links and remove / add value types -->
                                {!! Form::open(array( 'url'=> url("/admin/exercises"), 'method' => 'POST', 'class'=>'form-horizontal')) !!}
                                {!! Form::button("Edit", array("class" => "btn btn-success", "onclick" => "showModal('" . url('/admin/exercises/' . $exercise->id . '/edit') ."' , '#modal')")) !!}
                                {!! Form::button("Delete", array("class" => "btn btn-danger", "onclick" => "showModal('" . url('/admin/exercises/' . $exercise->id . '/delete') ."' , '#modal')")) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
            @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
<div id="modal"> </div>
@endsection