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
                    <h1> اضافةتصنيفات فرعية</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحة التحكم
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.sub_categories-index') }}">
                                    <span class="fa fa-th"></span> تصنيفات فرعية
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">اضافة تصنيفات فرعية</li>
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
                                        <form id="createForm" action="{{ route('super_admin.sub_categories-store') }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-row">
                                                {{-- العنوان بالعربي --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="name_ar">العنوان
                                                        بالعربي: <strong class="text-danger"> *
                                                            @error('name_ar')
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
                                                        <input type="text" name="name_ar"
                                                            class="form-control @error('name_ar') is-invalid @enderror"
                                                            id="name_ar" placeholder="العنوان بالعربي"
                                                            value="{!! old('name_ar') ? old('name_ar') : null !!}">
                                                    </div>
                                                </div>

                                                {{-- العنوان بالانجليزي --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01">العنوان بالانجليزي: <strong
                                                            class="text-danger"> *
                                                            @error('name_en')
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
                                                        <input type="text" name="name_en"
                                                            class="form-control @error('name_en') is-invalid @enderror"
                                                            id="validationServer01" placeholder="العنوان بالانجليزي"
                                                            value="{!! old('name_en') ? old('name_en') : null !!}">
                                                    </div>
                                                </div>

                                                {{-- التصنيفات الرئيسية --}}
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label for="category_id">التصنيف الرئيسي
                                                            <strong class="text-danger">* @error('category_id')
                                                                    ( {{ $message }} )
                                                                @enderror
                                                            </strong>
                                                        </label>
                                                        <select name="category_id" id="category_id"
                                                            class="category_id custom-select my-1 mr-sm-2 @error('category_id') is-invalid @enderror form-control"
                                                            data-live-search="true" data-width="88%" data-actions-box="true"
                                                            style="width: 100%">
                                                            <option value="" selected>التصنيف الرئيسي ...
                                                            </option>
                                                            @if (isset($categories) && $categories->count() > 0)
                                                                @foreach ($categories as $category)
                                                                    <option value="{{ $category->id }}"
                                                                        @if (old('category_id') != null) @if (old('category_id') == $category->id) selected @endif
                                                                    @else
                                                                        @if ($category->category_id == $category->id) selected @endif
                                                                        @endif>

                                                                        {{ isset($category->name_ar) ? $category->name_ar : '------' }}

                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
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
