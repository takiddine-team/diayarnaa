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
                    <h1>اضافة سياسة خصوصية </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحة التحكم
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.privacy_policy-index') }}">
                                    <span class="fa fa-th"></span> سياسة الخصوصية
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">اضافة سياسة خصوصية </li>
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
                                        <form id="createForm" action="{{ route('super_admin.privacy_policy-store') }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-row">


                                                {{-- Title EN --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01">العنوان بالانجليزي: <strong
                                                            class="text-danger"> *
                                                            @error('privacy_title_en')
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
                                                        <input type="text" name="privacy_title_en"
                                                            class="form-control @error('privacy_title_en') is-invalid @enderror"
                                                            id="validationServer01" placeholder="العنوان بالانجليزي"
                                                            value="{!! old('privacy_title_en') ? old('privacy_title_en') : null !!}">
                                                    </div>
                                                </div>
                                                {{-- Title AR --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01">العنوان بالعربي: <strong
                                                            class="text-danger"> *
                                                            @error('privacy_title_ar')
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
                                                        <input type="text" name="privacy_title_ar"
                                                            class="form-control @error('privacy_title_ar') is-invalid @enderror"
                                                            id="validationServer01" placeholder="العنوان بالعربي"
                                                            value="{!! old('privacy_title_ar') ? old('privacy_title_ar') : null !!}">
                                                    </div>
                                                </div>



                                                {{-- Policy desciption EN --}}
                                                <div class="col-md-12">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01"> الوصف بالانجليزي : <strong
                                                            class="text-danger"> *
                                                            @error('privacy_description_en')
                                                                -
                                                                {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">

                                                        </div>

                                                        <textarea style="width: 90% !important" name="privacy_description_en" maxlength="1600" class="form-control ckeditor"
                                                            rows="20">{!! old('privacy_description_en') ? old('privacy_description_en') : null !!}</textarea>

                                                    </div>
                                                </div>


                                                {{--  الوصف بالعربي  --}}
                                                <div class="col-md-12">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01"> الوصف بالعربي : <strong
                                                            class="text-danger"> *
                                                            @error('privacy_description_ar')
                                                                -
                                                                {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">

                                                        </div>
                                                        <textarea style="width: 90% !important" name="privacy_description_ar" maxlength="1600" class="form-control ckeditor"
                                                            rows="20">{!! old('privacy_description_ar') ? old('privacy_description_ar') : null !!}</textarea>


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
                                                                @if (old('status') == 1) selected @endif>مفعل
                                                            </option>
                                                            <option value="2"
                                                                @if (old('status') == 2) selected @endif>
                                                                غير مفعل
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
