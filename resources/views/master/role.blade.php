@extends('layouts.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/datatables-responsive/css/responsive.bootstrap4.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('vendor/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
@endpush

@section('main_content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Role</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Master</a></li>
                        <li class="breadcrumb-item active">Role</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                @if (request()->user()->can('create role'))
                                    <button type="button" class="btn btn-primary float-left btn-add"><i
                                            class="fas fa-plus"></i>
                                        Add Role</button>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            {!! $dataTable->table(['class' => 'table table-bordered table-striped']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('vendor/jquery/jquery.min.js') }} "></script>
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.min.js') }}"></script>
    {{ $dataTable->scripts() }}
    <script>
        $(document).ready(function() {
            $('.btn-add').on('click', function() {
                $.ajax({
                    method: 'GET',
                    url: `{{ url('master/roles/create') }}`,
                    success: function(res) {
                        $('#modal-default').find('.modal-dialog').html(res);
                        $('#modal-default').modal('show');
                        store()
                    }
                });
            })

            function store() {
                $('#formAction').on('submit', function(e) {
                    e.preventDefault()
                    const _form = this
                    const formData = new FormData(_form);
                    const url = this.getAttribute('action')

                    $.ajax({
                        method: 'POST',
                        url: url,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content')
                        },
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(res) {
                            window.LaravelDataTables["role-table"].ajax.reload();
                            $('#modal-default').modal('hide');
                        },
                        error: function(res) {
                            let errors = res.responseJSON?.errors
                            $(_form).find('.text-danger.text-small').remove()
                            if (errors) {
                                for (const [key, value] of Object.entries(errors)) {
                                    $(`[name='${key}']`).parent().append(
                                        `<span class="text-danger text-small">${ value }</span>`
                                    )
                                }
                            }
                        }
                    })
                })
            }

            $('#role-table').on('click', '.action', function() {
                let data = $(this).data();
                let id = data.id;
                let button_type = $(this).attr('button-type');

                if (button_type == 'delete') {
                    Swal.fire({
                        title: "Are you sure?",
                        text: "The action cannot be undone",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                method: 'DELETE',
                                url: `{{ url('master/roles/') }}/${id}`,
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content')
                                },
                                success: function(res) {
                                    window.LaravelDataTables["role-table"].ajax
                                        .reload();
                                    Swal.fire(
                                        'Deleted!',
                                        res.mesage,
                                        res.status
                                    )
                                }
                            });
                            console.log('Deleting item with ID:', id);
                        }
                    });
                } else {
                    $.ajax({
                        method: 'GET',
                        url: `{{ url('master/roles/') }}/${id}/edit`,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content')
                        },
                        success: function(res) {
                            $('#modal-default').find('.modal-dialog').html(res);
                            $('#modal-default').modal('show');
                            store()
                        }
                    });
                }




            });
        });
    </script>
@endpush
