@extends('admin.layouts.app')

@section('admin_css')
    <link href="{{ asset('resources/dashboard_files/assets/plugins/data-tables/datatables.bootstrap4.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('resources/dashboard_files/assets/css/sleek.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content">
            {{-- ============================================== --}}
            {{-- ================== Header ==================== --}}
            {{-- ============================================== --}}
            <div class="breadcrumb-wrapper breadcrumb-contacts">
                <div>
                    <h1>اضافة  FAQ Question </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحة التحكم
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.faqs-index') }}">
                                    <span class="fa fa-th"></span> FAQ
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">اضافة  FAQ </li>
                        </ol>
                    </nav>
                </div>

                <div class="content-wrapper">
                    <div class="content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card card-default">
                                    <div class="card-header justify-content-between " style="background-color: #4c84ff;">
                                    </div>
                                    <div class="card-body">
                                        <form id="createForm" action="{{ route('super_admin.faqs-store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-row">
                                                {{-- FAQ Question AR --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01">FAQ Question AR: <strong
                                                            class="text-danger"> *
                                                            @error('faq_question_ar')
                                                                -
                                                                {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-format-title"
                                                                id="inputGroupPrepend2"></span>
                                                        </div>
                                                        <input type="text" name="faq_question_ar"
                                                            class="form-control @error('faq_question_ar') is-invalid @enderror"
                                                            id="validationServer01" placeholder="FAQ Question AR"
                                                            value="{!! old('faq_question_ar') ? old('faq_question_ar') : null !!}">
                                                    </div>
                                                </div>

                                                {{-- FAQ Question EN --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01">FAQ Question EN: <strong
                                                            class="text-danger"> *
                                                            @error('faq_question_en')
                                                                -
                                                                {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-format-title"
                                                                id="inputGroupPrepend2"></span>
                                                        </div>
                                                        <input type="text" name="faq_question_en"
                                                            class="form-control @error('faq_question_en') is-invalid @enderror"
                                                            id="validationServer01" placeholder="FAQ Question EN"
                                                            value="{!! old('faq_question_en') ? old('faq_question_en') : null !!}">
                                                    </div>
                                                </div>


                                                {{-- FAQ Answer EN --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01">FAQ Answer EN: <strong class="text-danger">
                                                            *
                                                            @error('faq_answer_en')
                                                                -
                                                                {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-format-title"
                                                                id="inputGroupPrepend2"></span>
                                                        </div>
                                                        <input type="text" name="faq_answer_en"
                                                            class="form-control @error('faq_answer_en') is-invalid @enderror"
                                                            id="validationServer01" placeholder="FAQ Answer EN"
                                                            value="{!! old('faq_answer_en') ? old('faq_answer_en') : null !!}">
                                                    </div>
                                                </div>
                                                {{-- FAQ Answer AR --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01">FAQ Answer AR: <strong class="text-danger">
                                                            *
                                                            @error('faq_answer_ar')
                                                                -
                                                                {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-format-title"
                                                                id="inputGroupPrepend2"></span>
                                                        </div>
                                                        <input type="text" name="faq_answer_ar"
                                                            class="form-control @error('faq_answer_ar') is-invalid @enderror"
                                                            id="validationServer01" placeholder="FAQ Answer AR"
                                                            value="{!! old('faq_answer_ar') ? old('faq_answer_ar') : null !!}">
                                                    </div>
                                                </div>


                                                {{-- Status --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01">الحالة : <strong class="text-danger"> *
                                                            @error('status')
                                                                {{ $message }}
                                                            @enderror
                                                        </strong></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-account-check"></span>
                                                        </div>
                                                        <select name="status"
                                                            class="custom-select my-1 mr-sm-2 @error('status') is-invalid @enderror"
                                                            id="inlineFormCustomSelectPref">
                                                            <option value="" selected>اختر الحالة...</option>
                                                            <option value="1"
                                                                @if (old('status') == 1) selected @endif>Active
                                                            </option>
                                                            <option value="2"
                                                                @if (old('status') == 2) selected @endif>
                                                                Inactive
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <button class="mdi btn btn-primary" type="submit"><span
                                                            class="mdi mdi-plus"></span>إضافة</button>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
