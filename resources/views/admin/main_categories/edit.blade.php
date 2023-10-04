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
                    <h1>  تعديل التصنيف</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحه التحكم
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.categories-index') }}">
                                    <i class="fas fa-users-cog"></i> قائمة التصنيفات
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
                                            action="{{ route('super_admin.categories-update', isset($category->id) ? $category->id : -1) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-row">

                                              {{-- العنوان بالعربي --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="name_ar">العنوان بالعربي: <strong
                                                            class="text-danger"> *
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
                                                            value="{{ isset($category->name_ar)?$category->name_ar:null }}">
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
                                                            value="{{ isset($category->name_en)?$category->name_en:null }}">
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
                                                                    @if ($category->status == 'Active') selected @endif>مفعل
                                                                </option>
                                                                <option value="2"
                                                                    @if ($category->status == 'Inactive') selected @endif>
                                                                    غير مفعل
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
