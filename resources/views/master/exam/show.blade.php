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
                    <h1 class="m-0">Exam Details</h1>
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

        <div class="card">
            <div class="card-header">
                <a href="{{ route('exam-masters.index') }}" class="btn btn-primary btn-sm">back</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                        <div class="row mt-3">
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Jumlah Soal</span>
                                        <span
                                            class="info-box-number text-center text-muted mb-0">{{ $examMaster->questions()->count() }}</span>
                                    </div>
                                </div>
                                <a href="{{ route('exam-questions.index', $examMaster->id) }}"
                                    class="btn btn-info btn-sm">Question List</a>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Total Siswa</span>
                                        <span class="info-box-number text-center text-muted mb-0">30</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Author</span>
                                        <span class="info-box-number text-center text-muted mb-0">Octavarium</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <b>Registerd Student</b>
                </div>
                <table id="table-question" class="table table-bordered table-striped dataTable dtr-inline">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($registeredStudents as $student)
                            <tr>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>085777007002</td>
                                <td>Approved</td>
                                @if ($student->is_approved == 1)
                                    <td><button class="btn btn-success btn-sm">Approve</button></td>
                                @else
                                    <td><button class="btn btn-danger btn-sm">Decline</button></td>
                                @endif
                            </tr>
                        @endforeach

                    </tbody>
                </table>
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
    <script>
        $(document).ready(function() {
            console.log($this.data);
            $('.btn-add').on('click', function() {
                $.ajax({
                    method: 'GET',
                    url: "{{ url('master/exam-masters/') }}" + '/' + id + '/questions/create',
                    success: function(res) {
                        $('#modal-default').find('.modal-dialog').html(res);
                        $('#modal-default').modal('show');
                        store();
                    }
                });
            })
        })
    </script>
@endpush
