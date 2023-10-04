@extends('admin.layouts.app')

@section('admin_css')
    <link href="{{ asset('dashboard_files/assets/plugins/data-tables/datatables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard_files/assets/css/sleek.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content">
            {{-- ============================================== --}}
            {{-- ================== Header ==================== --}}
            {{-- ============================================== --}}
            <div class="breadcrumb-wrapper breadcrumb-contacts">
                <div class="col-md-12">
                    <h1>تعديل</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحه التحكم
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.faqs-index') }}">
                                    <i class="fas fa-users-cog"></i> List FQAs
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">تعديل</li>
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
                                        <form id="createForm"
                                            action="{{ route('super_admin.faqs-update', isset($faq->id) ? $faq->id : -1) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-row">

                                                {{-- FQAs Question  AR --}}
                                                <div class="col-md-12">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01">FQAs Question AR: <strong
                                                            class="text-danger">
                                                            *
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
                                                            id="validationServer01" placeholder="Question AR"
                                                            value="{!! isset($faq->faq_question_ar) ? $faq->faq_question_ar : 'FAQ One' !!}">
                                                    </div>
                                                </div>

                                                {{-- FAQ Question  EN --}}
                                                <div class="col-md-12">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01">FQAs Question EN: <strong
                                                            class="text-danger">
                                                            *
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
                                                            id="validationServer01" placeholder="Question EN"
                                                            value="{!! isset($faq->faq_question_en) ? $faq->faq_question_en : 'FAQ 2' !!}">
                                                    </div>
                                                </div>

                                                <div class="form-row">

                                                    {{-- FQAs Answer  AR --}}
                                                    <div class="col-md-12">
                                                        <label class="text-dark font-weight-medium mb-3"
                                                            for="validationServer01">FQAs Answer AR: <strong
                                                                class="text-danger">
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
                                                                id="validationServer01" placeholder="Answer AR"
                                                                value="{!! isset($faq->faq_answer_ar) ? $faq->faq_answer_ar : 'FAQ Answer AR' !!}">
                                                        </div>
                                                    </div>

                                                    {{-- Answer  EN --}}
                                                    <div class="col-md-12">
                                                        <label class="text-dark font-weight-medium mb-3"
                                                            for="validationServer01">FQAs Answer EN: <strong
                                                                class="text-danger">
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
                                                                id="validationServer01" placeholder="Answer EN"
                                                                value="{!! isset($faq->faq_answer_en) ? $faq->faq_answer_en : 'FAQ Answer EN' !!}">
                                                        </div>
                                                    </div>




                                                    {{-- Status --}}
                                                    <div class="col-md-6 mb-3">
                                                        <label class="text-dark font-weight-medium mb-3"
                                                            for="validationServer01">الحالة : <strong class="text-danger">
                                                                * @error('status')
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
                                                                    @if ($faq->status == 'Active') selected @endif>Active
                                                                </option>
                                                                <option value="2"
                                                                    @if ($faq->status == 'Inactive') selected @endif>
                                                                    Inactive
                                                                </option>

                                                            </select>
                                                        </div>
                                                    </div>




                                                </div>


                                                {{-- Status --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01">الحالة : <strong class="text-danger">
                                                            * @error('status')
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
                                                                @if ($faq->status == 'Active') selected @endif>Active
                                                            </option>
                                                            <option value="2"
                                                                @if ($faq->status == 'Inactive') selected @endif>Inactive
                                                            </option>

                                                        </select>
                                                    </div>
                                                </div>




                                            </div>



                                    </div>
                                    <div class="col-md-12 mb-3">

                                        <button class="btn btn-primary" type="submit">حفظ التعديلات</button>
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
