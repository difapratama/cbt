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
                                <button type="button" class="btn btn-primary float-left btn-add"><i
                                        class="fas fa-plus"></i>
                                    Add Questionn</button>
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
    {{ $dataTable->scripts() }}
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
