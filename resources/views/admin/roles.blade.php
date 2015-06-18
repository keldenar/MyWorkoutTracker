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
        <form class="form-horizontal" method="POST" action="{{ url("/admin/roles") }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label class="col-md-4 control-label">Role Name</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name') }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Role Description</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="description" placeholder="Description" value="{{ old('description') }}">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">Add Role</button>
                </div>
            </div>
        </form>
        @if (null !== $roles)
            <hr>
            @foreach($roles as $role)
                <form class="form-inline" method="POST" action=" {{url("/admin/roles")}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="delete" value="delete">
                    <input type="hidden" name="id" value="{{ $role->id }}">
                    <div class="row" style="border: #ddd solid 1px; margin: 10px; padding: 5px">
                        <div class="col-md-3 form-group">
                            {{ $role->name }}
                        </div>
                        <div class="col-md-7 form-group">
                            {{ $role->description }}
                        </div>
                        <div class="col-md-2 form-group">
                            <button class="btn btn-primary" type="submit" formmethod="POST" formaction="{{ url("/admin/roles") }}">Delete</button>
                        </div>
                    </div>
                </form>
            @endforeach
        @endif
    </div>
</div>
@endsection