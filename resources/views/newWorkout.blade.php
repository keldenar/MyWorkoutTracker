@section('modal')
    <div class="modal fade" id="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="myModalLabel">New Workout</h3>
                </div>

                <div class="modal-body">
                    {!! Form::open(array( 'id' => 'modalform', 'url'=> url("/workout/"), 'method' => 'POST', 'class'=>'form-horizontal')) !!}
                    <div class="form-group">
                        {!! Form::label("name", "Workout Name",array("class"=>"control-label col-md-4")) !!}
                        <div class="col-md-6">
                            {!! Form::text('name',null,array("class"=>"form-control")) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label("name", "Date",array("class"=>"control-label col-md-4")) !!}
                        <div class='col-md-6'>
                            <input type='text' class="form-control" id='datetimepicker4' name="date" value="{{ old("date") }}"/>
                        </div>
                        <script type="text/javascript">
                            $(function () {
                                $('#datetimepicker4').datetimepicker();
                            });
                        </script>
                    </div>
                    {!! Form::close() !!}
                </div>

                <div class="modal-footer">
                    <button form="modalform" class="btn btn-success" type=submit>Submit</button>
                    <button class="btn" data-dismiss="modal" aria-hidden="true">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
@show


