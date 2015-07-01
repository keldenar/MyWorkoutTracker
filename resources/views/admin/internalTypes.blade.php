@extends("admin.admin")

@section("adminContent")
<div class="panel panel-default">
    <div class="panel-heading">Internal Type Admin</div>
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
        <form class="form-horizontal" method="POST" action="{{ url("/admin/internaltypes") }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label class="col-md-4 control-label">Internal Type</label>
                <div class="col-md-6">
                    {!! Form::text('name',null,array("class"=>"form-control")) !!}
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">Add Internal Type</button>
                </div>
            </div>
        </form>
        @if (null !== $internalType)
            <hr>
            <table class="table">
                <thead>
                <tr>
                    <th class="col-md-3">Type</th>
                    <th class="col-md-2">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($internalType as $type)
                    <tr>
                        <td>
                            {{ $type->name }}
                        </td>
                        <td>
                            <!-- TODO Edit should handle being able to add descriptions and links and remove / add value types -->
                            {!! Form::open(array( 'url'=> url("/admin/internaltypes"), 'method' => 'POST', 'class'=>'form-horizontal')) !!}
                            {!! Form::button("Edit", array("class" => "btn btn-success", "onclick" => "showModal('" . url('/admin/internaltypes/' . $type->id . '/edit') ."' , '#modal')")) !!}
                            {!! Form::button("Delete", array("class" => "btn btn-danger", "onclick" => "showModal('" . url('/admin/internaltypes/' . $type->id . '/delete') ."' , '#modal')")) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection