<div class="modal-content">
    <form id="formAction" action="{{ $category->id ? route('categories.update', $category->id) : route('categories.store') }}"
        method="post">
        @csrf
        @if ($category->id)
            @method('put')
        @endif
        <div class="modal-header">
            <h4 class="modal-title">{{ $category->id ? 'Update exam' : 'Create exam' }}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" value="{{ $category->name }}" name="name" class="form-control"
                            placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" rows="3" placeholder="Description here ..">{{ $category->description }}</textarea>
                    </div>
                </div>
                <input type="hidden" name="is_active" value="{{ 1 }}">
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
</div>
