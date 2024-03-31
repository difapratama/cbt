@extends('layouts.master')

@push('css')
@endpush

@section('main_content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @foreach ($exams as $exam) 
                <div class="col-md-3 col-sm-6 col-12 mt-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">{{ $exam->name }}</span>
                            <span class="info-box-number">{{ \Carbon\Carbon::parse($exam->exam_date)->format('d F Y') }}</span>
                            <button class="btn btn-info btn-sm mt-1">Kerjakan</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@push('js')
@endpush
