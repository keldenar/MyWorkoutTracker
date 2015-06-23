@section('modal')
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="ModalLabel">Delete - {{$workout->name}}</h3>
                </div>
                <div class="modal-body">
                    <form id="modalform" class="form-horizontal" method="POST" action="{{ url("/workout/delete") }}">
                        {!! Form::token() !!}
                        {!! Form::hidden("id", $id) !!}
                            <div class="text-danger">
                                <p>Are you sure you want to delete this workout - {{ $workout->name }}.</p>
                                <p><strong>This is not reversible!</strong></p>
                            </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button form="modalform" class="btn btn-danger" type=submit>Submit</button>
                    <button class="btn btn-success" data-dismiss="modal" aria-hidden="true">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
@show