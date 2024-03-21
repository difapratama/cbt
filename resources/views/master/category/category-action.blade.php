<div class="modal-content">
    <form id="formAction" action="{{ $category->id ? route('roles.update', $category->id) : route('roles.store') }}"
        method="post">
        @csrf
        @if ($category->id)
            @method('put')
        @endif
        <div class="modal-header">
            @if ($category->id)
                <h4 class="modal-title">Update Category</h4>
            @endif
            <h4 class="modal-title">Create Category</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <div class="row">
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" value="{{ $category->name }}" name="name" class="form-control"
                            placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Status</label>
                        <input type="text" value="{{ $category->guard_name }}" name="guard_name" class="form-control"
                            placeholder="Enter ...">
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
