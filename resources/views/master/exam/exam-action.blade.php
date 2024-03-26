@push('css')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" />
@endpush

<div class="modal-content">
    <form id="formAction"
        action="{{ $examMaster->id ? route('exam-masters.update', $examMaster->id) : route('exam-masters.store') }}"
        method="post">
        @csrf
        @if ($examMaster->id)
            @method('put')
        @endif
        <div class="modal-header">
            <h4 class="modal-title">
                {{ $examMaster->id ? 'Update exam' : 'Create exam' }}
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Category</label>
                        <select class="custom-select rounded-0" name="category_id">
                            @foreach ($categories as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Exam Title</label>
                        <input type="text" value="{{ $examMaster->name }}" class="form-control" name="name"
                            placeholder="Please insert name here">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Exam Date</label>
                        <input type="date" value="{{ $examMaster->exam_date }}" name="exam_date" id="exam_date"
                            class="form-control">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Exam Duration</label>
                        <input type="text" value="{{ $examMaster->exam_duration }}" class="form-control"
                            name="exam_duration" placeholder="Duration">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1">
                            <label class="form-check-label">is active?</label>
                        </div>
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
