@extends("admin.admin")

@section("adminContent")
<div class="panel panel-default">
    <div class="panel-heading">Exercise Type Admin</div>
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
        <form class="form-horizontal" method="POST" action="{{ url("/admin/exercisecategories") }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label class="col-md-4 control-label">Exercise Category</label>
                <div class="col-md-6">
                    {!! Form::text('name',null,array("class"=>"form-control")) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">Add Exercise Type</button>
                </div>
            </div>
        </form>
        @if (null !== $categories)
            <hr>
            <table class="table">
                <thead>
                <tr>
                    <th>Exercise Category</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{$category->name}}</td>
                    <td>
                        {!! Form::open(array( 'url'=> url("/admin/exercisecategories"), 'method' => 'POST', 'class'=>'form-horizontal')) !!}
                        {!! Form::button("Edit", array("class" => "btn btn-success", "onclick" => "showModal('" . url('/admin/exercisecategories/' . $category->id . '/edit') ."' , '#modal')")) !!}
                        {!! Form::button("Delete", array("class" => "btn btn-danger", "onclick" => "showModal('" . url('/admin/exercisecategories/' . $category->id . '/delete') ."' , '#modal')")) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
    <div id="modal"> </div>
@endsection