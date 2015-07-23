@section('modal')
    <div class="modal" id="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="ModalLabel">Suggest a new Exercise</h3>
                </div>
                <div class="modal-body">
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
                    <form id="modalform" class="form-horizontal" method="POST" action="{{ url("/suggest/exercise") }}">
                        {!! Form::token() !!}
                        <div class="form-group">
                            <label class="col-md-4 control-label">Exercise Category</label>
                            <div class="col-md-6">
                                {!!  Form::select('exercise_category_id', $categories->lists("name","id"), null,array("class"=>"form-control")) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">New Exercise</label>
                            <div class="col-md-6">
                                {!! Form::text('name',null,array("class"=>"form-control")) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Description</label>
                            <div class="col-md-6">
                                {!! Form::text('description',null,array("class"=>"form-control")) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Link</label>
                            <div class="col-md-6">
                                {!! Form::text('link',null,array("class"=>"form-control")) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Video</label>
                            <div class="col-md-6">
                                {!! Form::text('video_link',null,array("class"=>"form-control")) !!}
                            </div>
                        </div>
                        <div class="form-group" id="formgroup_0">
                            <label class="col-md-4 control-label">Value Type</label>
                            <div class="col-md-6">
                                {!!  Form::select('internal_type_id[0]', $internalType->lists("name","id"), null,array("class"=>"form-control")) !!}
                            </div>
                        </div>
                        <a onclick="addSelect();"><span class="glyphicon glyphicon-plus-sign"></span>Add additional Type</a>
                    </form>
                    <div class="clearfix"> </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" onclick="suggestExercise('{{url("/suggest/exercise")}}')">
                        Make Suggestion
                    </button>
                    <button class="btn" data-dismiss="modal" aria-hidden="true">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
@show
