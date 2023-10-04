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
                    <h1>اضافة وظيفة</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحة التحكم
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.jobs-index') }}">
                                    <span class="fa fa-th"></span> الوظائف
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">اضافة وظيفة </li>
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
                                        <form id="createForm" action="{{ route('super_admin.jobs-store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-row">
                                                {{-- العنوان بالعربي --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="title_ar">العنوان
                                                        بالعربي: <strong class="text-danger"> *
                                                            @error('title_ar')
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
                                                        <input type="text" name="title_ar"
                                                            class="form-control @error('title_ar') is-invalid @enderror"
                                                            id="title_ar" placeholder="العنوان بالعربي"
                                                            value="{!! old('title_ar') ? old('title_ar') : null !!}">
                                                    </div>
                                                </div>

                                                {{-- العنوان بالانجليزي --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="title_en">العنوان
                                                        بالانجليزي: <strong class="text-danger"> *
                                                            @error('title_en')
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
                                                        <input type="text" name="title_en"
                                                            class="form-control @error('title_en') is-invalid @enderror"
                                                            id="title_en" placeholder="العنوان بالانجليزي"
                                                            value="{!! old('title_en') ? old('title_en') : null !!}">
                                                    </div>
                                                </div>


                                                {{--  تفاصيل الاعلان بالعربي --}}
                                                <div class="col-12">
                                                    <label class="text-dark font-weight-medium mb-3" for="description_ar">
                                                        تفاصيل الاعلان بالعربي: <strong class="text-danger">
                                                            * @error('description_ar')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">

                                                        </div>
                                                        <textarea style="width: 90% !important" name="description_ar" class="form-control ckeditor" rows="5"
                                                            id='description_ar'>{{ old('description_ar') ? old('description_ar') : null }}</textarea>
                                                    </div>
                                                </div>


                                                {{--  تفاصيل الاعلان بالانجليزي --}}
                                                <div class="col-12">
                                                    <label class="text-dark font-weight-medium mb-3" for="description_en">
                                                        تفاصيل الاعلان بالانجليزي <strong class="text-danger">
                                                            * @error('description_en')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">

                                                        </div>
                                                        <textarea style="width: 90% !important" name="description_en" class="form-control ckeditor" rows="5"
                                                            id='description_en'>{{ old('description_en') ? old('description_en') : null }}</textarea>
                                                    </div>
                                                </div>


                                                {{-- الصورة   --}}
                                                <div class="col-md-6 mb-3" id="office">
                                                    <label class="text-dark font-weight-medium mb-3" for="image">
                                                        حمّل صورة :
                                                        <strong class="text-danger">
                                                             @error('image')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>

                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text mdi mdi-cloud-upload"></span>
                                                            </div>
                                                            <input type="file" name="image" class="form-control"
                                                                id="image">
                                                        </div>
                                                </div>
                                                {{-- ملف   --}}
                                                <div class="col-md-6 mb-3" id="office">
                                                    <label class="text-dark font-weight-medium mb-3" for="file">
                                                        حمّل ملف : <strong class="text-danger">
                                                             @error('image')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>

                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text mdi mdi-cloud-upload"></span>
                                                            </div>
                                                            <input type="file" name="file" class="form-control"
                                                                id="file">
                                                        </div>
                                                </div>
                                                {{--  صلاحية الاعلان  --}}
                                                <div class="col-md-6" id="expiry_date_div">
                                                    <label class="text-dark font-weight-medium mb-3" for="expiry_date">
                                                        صلاحية الاعلان :
                                                        <strong class="text-danger">
                                                            *
                                                            @error('expiry_date')
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
                                                        <input type="date" name="expiry_date"
                                                            class="form-control @error('expiry_date') is-invalid @enderror"
                                                            id="expiry_date" value="{!! old('expiry_date') ? old('expiry_date') : null !!}">
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
