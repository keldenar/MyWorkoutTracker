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
        <form class="form-horizontal" method="POST" action="{{ url("/admin/roleroutes") }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label class="col-md-4 control-label">Role</label>
                <div class="col-md-6">
                    <select name="id" class="form-control">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Method</label>
                <div class="col-md-6">
                    <select class="form-control" name="method" value="{{ old('method') }}">
                        <option value="GET">GET</option>
                        <option value="POST">POST</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Role Route</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="route" placeholder="Route" value="{{ old('route') }}">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">Add Role Route</button>
                </div>
            </div>
        </form>
        @if (null !== $roles)
            <hr>
            <table class="table">
                <thead>
                <tr>
                    <th>Role</th>
                    <th>Method: Route</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
            @foreach($roles as $role)
                <?php $count = 0 ?>
                @foreach($role->RoleRoutes as $roleRoute)

                        <tr>
                            @if ($count == 0)
                                <td rowspan="{{ $role->RoleRoutes->count() }}">
                                    {{ $role->name }}
                                </td>
                                <?php $count = $count + 1 ?>
                            @endif
                            <td>
                                {{ $roleRoute->method }}: {{ $roleRoute->route }}
                            </td>
                            <td>
                                <form class="form-inline" method="POST" action=" {{url("/admin/roleroutes")}}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="delete" value="delete">
                                    <input type="hidden" name="id" value="{{ $roleRoute->id }}">
                                    <div class="col-md-2 form-group">
                                        <button class="btn btn-primary" type="submit" >Delete</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
            @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection