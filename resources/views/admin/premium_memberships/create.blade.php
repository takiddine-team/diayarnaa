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
                    <h1>اضافة </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحة التحكم
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.premiumMemberships-index') }}">
                                    <span class="fa fa-th"></span> العضويات المميزة
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">اضافة </li>
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
                                        <form id="createForm" action="{{ route('super_admin.premiumMemberships-store') }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-row">
                                                {{-- نوع المستخدم --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="text-dark font-weight-medium mb-3" for="user_type">نوع
                                                        المستخدم : <strong class="text-danger"> *
                                                            @error('user_type')
                                                                {{ $message }}
                                                            @enderror
                                                        </strong></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-account-check"></span>
                                                        </div>
                                                        <select name="user_type"
                                                            class="custom-select my-1 mr-sm-2 content-creator @error('user_type') is-invalid @enderror"
                                                            id="user_type">
                                                            <option value="" selected>نوع المستخدم...</option>
                                                            <option value="1"
                                                                @if (old('user_type') == 1) selected @endif>مكتب عقاري
                                                            </option>
                                                            <option value="2"
                                                                @if (old('user_type') == 2) selected @endif>مالك عقار
                                                            </option>
                                                            <option value="3"
                                                                @if (old('user_type') == 3) selected @endif>باحث مميز
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                {{-- Feature Type --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01">مميز : <strong class="text-danger"> *
                                                            @error('featured_type')
                                                                {{ $message }}
                                                            @enderror
                                                        </strong></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-account-check"></span>
                                                        </div>
                                                        <select name="featured_type"
                                                            class="custom-select my-1 mr-sm-2 @error('featured_type') is-invalid @enderror"
                                                            id="inlineFormCustomSelectPref">
                                                            <option value="" selected>اختر الحالة...</option>
                                                            <option value="1"
                                                                @if (old('featured_type') == 1) selected @endif>مميز
                                                            </option>
                                                            <option value="2"
                                                                @if (old('featured_type') == 2) selected @endif>غير مميز
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                {{-- اعلانات غير محدودة  --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="unlimited_status">اعلانات غير محدودة : <strong
                                                            class="text-danger"> *
                                                            @error('unlimited_status')
                                                                {{ $message }}
                                                            @enderror
                                                        </strong></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-account-check"></span>
                                                        </div>
                                                        <select name="unlimited_status"
                                                            class="custom-select my-1 mr-sm-2 @error('unlimited_status') is-invalid @enderror"
                                                            id="unlimited_status">
                                                            <option value="" selected>اختر الحالة...</option>
                                                            <option value="1"
                                                                @if (old('unlimited_status') == 1) selected @endif>نعم
                                                            </option>
                                                            <option value="2"
                                                                @if (old('unlimited_status') == 2) selected @endif> لا
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                {{-- الاسم بالعربي --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="name_ar">
                                                        الإسم بالعربي<strong class="text-danger">
                                                            *
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
                                                            id="name_ar" placeholder="الاسم بالعربي"
                                                            value="{!! old('name_ar') ? old('name_ar') : null !!}">
                                                    </div>
                                                </div>

                                                {{--  الإسم بالإنجليزي --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="name_en">
                                                        الإسم بالإنجليزي: <strong class="text-danger">
                                                            *
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
                                                            id="name_en" placeholder=" الإسم بالإنجليزي"
                                                            value="{!! old('name_en') ? old('name_en') : null !!}">
                                                    </div>
                                                </div>



                                                {{-- Price --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="price">السعر:
                                                        <strong class="text-danger">
                                                            *
                                                            @error('price')
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
                                                        <input type="number" min="0" name="price" step="any"
                                                            class="form-control @error('price') is-invalid @enderror"
                                                            id="price" placeholder="السعر" 
                                                            value="{!! old('price') ? old('price') : null !!}">
                                                    </div>
                                                </div>
                                                {{-- no. Ad Days --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="number_days_ad">
                                                        مدة الاعلان: <strong class="text-danger">
                                                            *
                                                            @error('number_days_ad')
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
                                                        <input type="number" min="0" name="number_days_ad"
                                                            class="form-control @error('number_days_ad') is-invalid @enderror"
                                                            id="number_days_ad" placeholder="عدد ايام الاعلان "
                                                            value="{!! old('number_days_ad') ? old('number_days_ad') : null !!}">
                                                    </div>
                                                </div>

                                                {{-- عدد ايام العضوية  --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="number_days_membership"> عدد أيام العضوية: <strong
                                                            class="text-danger">
                                                            *
                                                            @error('number_days_membership')
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
                                                        <input type="number" min="0" name="number_days_membership"
                                                            class="form-control @error('number_days_membership') is-invalid @enderror"
                                                            id="number_days_membership" placeholder="عدد أيام العضوية "
                                                            value="{!! old('number_days_membership') ? old('number_days_membership') : null !!}">
                                                    </div>
                                                </div>

                                                {{-- Number of Ads --}}
                                                <div class="col-md-6" id="num_ads">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="number_of_ads">عدد الاعلانات: <strong class="text-danger">
                                                            *
                                                            @error('number_of_ads')
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
                                                        <input type="number" min="0" name="number_of_ads"
                                                            class="form-control @error('number_of_ads') is-invalid @enderror"
                                                            id="number_of_ads" placeholder="عدد الاعلانات"
                                                            value="{!! old('number_of_ads') ? old('number_of_ads') : null !!}">
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
                                                                @if (old('status') == 2) selected @endif>غير مفعل
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>



                                                {{--  Description EN --}}
                                                <div class="col-md-12">
                                                    <label class="text-dark font-weight-medium mb-3" for="description_en">
                                                        الوصف بالانجليزي : <strong class="text-danger">
                                                            *
                                                            @error('description_en')
                                                                -
                                                                {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-format-title"
                                                                id="description_en"></span>
                                                        </div>
                                                        <textarea name="description_en" id="message_area" placeholder="  الوصف بالانجليزي " class="form-control"
                                                            rows="10" maxlength="50">{!! old('description_en') ? old('description_en') : null !!}</textarea>

                                                        <span class="hint" id="textarea_message"></span>
                                                    </div>
                                                </div>
                                                {{--   الوصف بالعربي --}}
                                                <div class="col-md-12">
                                                    <label class="text-dark font-weight-medium mb-3" for="description_ar">
                                                        الوصف بالعربي : <strong class="text-danger">
                                                            *
                                                            @error('description_ar')
                                                                -
                                                                {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-format-title"
                                                                id="description_ar"></span>
                                                        </div>
                                                        <textarea name="description_ar" id="message_area" placeholder=" الوصف بالعربي " class="form-control"
                                                            rows="10" maxlength="50">{!! old('description_ar') ? old('description_ar') : null !!}</textarea>
                                                        <span class="hint" id="textarea_message"></span>

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



    </div>
@endsection
@section('admin_javascript')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            getType();
        });

        $('#unlimited_status').on('change', function() {
            getType();
            $('#number_of_ads').val('');
        });

        function getType() {
            if ($('#unlimited_status').val() == 1) {
                $('#num_ads').css("display", "none");
                $('#number_of_ads').val('');
            } else {
                $('#num_ads').css("display", "block");
            }

        }
    </script>
    
@endsection
