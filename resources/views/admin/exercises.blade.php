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
                <label class="col-md-4 control-label">Exercise Type</label>
                <div class="col-md-6">
                    {!!  Form::select('exercise_type_id', $formTypes, null,array("class"=>"form-control")) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Exercise</label>
                <div class="col-md-6">
                    {!! Form::text('name',null,array("class"=>"form-control")) !!}
                </div>
            </div>
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
                    <th>Type</th>
                    <th>Exercise</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
            @foreach($types as $type)
                <?php $count = 0 ?>
                @foreach($type->Exercises->sortBy("name") as $exercise)
                        <tr>
                            @if ($count == 0)
                                <td rowspan="{{ $type->Exercises->count() }}">
                                    {{ $type->name }}
                                </td>
                                <?php $count = $count + 1 ?>
                            @endif
                            <td>
                                {{ $exercise->name }}
                            </td>
                            <td>
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