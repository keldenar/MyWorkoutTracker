@section('modal')
    <div class="modal fade" id="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="ModalLabel">{{ $type }} - {{$title}}</h3>
                </div>
                <div class="modal-body">
                    <div class="text-center text-danger"><strong>Are you sure you want to delete this entry?</strong></div>
                    <div class="text-center text-danger"><strong>This is not reversible!</strong></div>
                    <form id="modalform" class="form-horizontal" method="POST" action="{{ $target }}">
                        {!! Form::token() !!}
                        @foreach($hiddens as $key => $value)
                            {!! Form::hidden($key, $value) !!}
                        @endforeach
                        @foreach($elements as $key =>$value)
                            <div class="form-group">
                                <label class="col-md-4 control-label">{{ $key }}</label>
                                <div class="col-md-8">
                                    {!! $value !!}
                                </div>
                            </div>
                        @endforeach
                    </form>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-danger" onclick="post_call(
                        {   uri : '{{ url("/workout/deleteexercise") }}',
                            form_data : $('form#modalform'),
                            action : function(data) {
                                $( '#workoutExerciseRow' + {{ $id }}).remove();
                                $( '#modal' ).modal('hide');
                            }
                        })">
                        Delete
                    </button>
                    <button class="btn" data-dismiss="modal" aria-hidden="true">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
@show
