<div class="modal-content">
    <form id="formAction"
        action="{{ $question->id ? route('exam-questions.update', $question->id) : route('exam-questions.store', $examMaster->id) }}"
        method="post">
        @csrf
        @if ($question->id)
            @method('put')
        @endif
        <div class="modal-header">
            <h4 class="modal-title">Create Question</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Question</label>
                        <textarea class="form-control" rows="3" placeholder="Question" name="question_text"></textarea>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label>A</label>
                        <input type="text" value="{{ $question->name }}" name="choices[]" class="form-control"
                            placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>B</label>
                        <input type="text" value="{{ $question->name }}" name="choices[]" class="form-control"
                            placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>C</label>
                        <input type="text" value="{{ $question->name }}" name="choices[]" class="form-control"
                            placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>D</label>
                        <input type="text" value="{{ $question->name }}" name="choices[]" class="form-control"
                            placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Correct Answer</label>
                        <select class="form-control" name="is_correct">
                            <option value="1">A</option>
                            <option value="2">B</option>
                            <option value="3">C</option>
                            <option value="4">D</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
</div>
