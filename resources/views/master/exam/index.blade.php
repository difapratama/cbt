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
                    <h1 class="m-0">Exam Lists</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Master</a></li>
                        <li class="breadcrumb-item active">Exam</li>
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
                                <button type="button" class="btn btn-primary float-left btn-add btn-sm"><i
                                        class="fas fa-plus"></i>
                                    Add New Exam</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="table-question" class="table table-bordered table-striped dataTable dtr-inline">
                                <thead>
                                    <tr>
                                        <th>Exam ID</th>
                                        <th>Category</th>
                                        <th>Name</th>
                                        <th>Exam Date</th>
                                        <th>Exam Duration(minutes)</th>
                                        <th>Attendant</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
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
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

    <script>
        var table;
        var table = $('.dataTable').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            responsive: true,
            ajax: "{{ url('master/exam-masters') }}",
            columns: [{
                    data: 'exam_id',
                    name: 'exam_id'
                },
                {
                    data: 'category',
                    name: 'category'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'exam_date',
                    name: 'exam_date'
                },
                {
                    data: 'exam_duration',
                    name: 'exam_duration'
                },
                {
                    data: 'attendant',
                    name: 'attendant'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        function deleteData(id) {
            if (confirm('Delete data?')) {
                $.post(`{{ url('mailing-lists') }}/` + id, {
                    _method: 'delete'
                }, function(res) {
                    if (res.success) {
                        table.ajax.reload();
                        toastr.success(res.message);
                    } else {
                        toastr.error(res.message);
                    }
                }, 'json');
            }
        }
    </script>
    {{-- END  --}}
    <script>
        $(document).ready(function() {
            $('.btn-add').on('click', function() {
                $.ajax({
                    method: 'GET',
                    url: `{{ url('master/exam-masters/create') }}`,
                    success: function(res) {
                        $('#modal-default').find('.modal-dialog').html(res);
                        $('#modal-default').modal('show');
                        store()
                    }
                });
            })

            $('.btn-edit').on('click', function() {
                var examId = $(this).data('id');
                $.ajax({
                    method: 'GET',
                    url: '{{ url('master/exam-masters') }}/' + examId + '/edit',
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
                            table.ajax.reload();
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

            $('#exammasters-table').on('click', '.action', function() {
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
                                url: `{{ url('master/exam-masters/') }}/${id}`,
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content')
                                },
                                success: function(res) {
                                    window.LaravelDataTables["exammasters-table"].ajax
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
                        url: `{{ url('master/exam-masters/') }}/${id}/edit`,
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
        })
    </script>
@endpush
