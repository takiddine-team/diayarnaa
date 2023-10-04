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
                    <h1>تعديل العضوية المميزة</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحه التحكم
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.premiumMemberships-index') }}">
                                    <i class="fas fa-users-cog"></i>قائمة العضويات المميزة
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
                                            action="{{ route('super_admin.premiumMemberships-update', isset($membership->id) ? $membership->id : -1) }}"
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
                                                            @if (old('user_type'))
                                                                <option value="1"
                                                                    @if (old('user_type') && old('user_type') == 1) selected @endif>مكتب
                                                                    عقاري
                                                                </option>
                                                                <option value="2"
                                                                    @if (old('user_type') && old('user_type') == 2) selected @endif>مالك
                                                                    عقار
                                                                </option>
                                                                <option value="3"
                                                                    @if (old('user_type') && old('user_type') == 3) selected @endif>باحث
                                                                    مميز
                                                                </option>
                                                            @else
                                                                <option value="1"
                                                                    @if (isset($membership->user_type) && $membership->user_type == 'Real Estate Office') selected @endif>مكتب
                                                                    عقاري
                                                                </option>
                                                                <option value="2"
                                                                    @if (isset($membership->user_type) && $membership->user_type == 'Real Estate Owner') selected @endif>مالك
                                                                    عقار
                                                                </option>
                                                                <option value="3"
                                                                    @if (isset($membership->user_type) && $membership->user_type == 'Real Estate Seeker') selected @endif>باحث
                                                                    مميز
                                                                </option>
                                                            @endif

                                                        </select>
                                                    </div>
                                                </div>
                                                {{-- Feature Type --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01">مميز : <strong class="text-danger">
                                                            * @error('featured_type')
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
                                                            <option value="" selected>اختر الحالة..</option>

                                                            @if (old('featured_type'))
                                                                <option value="1"
                                                                    @if (old('featured_type') == 1) selected @endif>مميز
                                                                </option>
                                                                <option value="2"
                                                                    @if (old('featured_type') == 2) selected @endif>غير
                                                                    مميز
                                                                </option>
                                                            @else
                                                                <option value="1"
                                                                    @if ($membership->featured_type == 'True') selected @endif>مميز
                                                                </option>
                                                                <option value="2"
                                                                    @if ($membership->featured_type == 'False') selected @endif>غير
                                                                    مميز
                                                                </option>
                                                            @endif


                                                        </select>
                                                    </div>
                                                </div>
                                                {{-- اعلانات غير محدودة --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="unlimited_status">اعلانات غير محدودة : <strong
                                                            class="text-danger">
                                                            * @error('unlimited_status')
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
                                                            <option value="" selected>اختر الحالة..</option>

                                                            @if (old('unlimited_status'))
                                                            <option value="1"
                                                            @if (old('unlimited_status') == 1) selected @endif>نعم
                                                        </option>
                                                        <option value="2"
                                                            @if (old('unlimited_status') == 2) selected @endif>لا
                                                        </option>
                                                            @else
                                                            <option value="1"
                                                            @if ($membership->unlimited_status == 'True') selected @endif>نعم
                                                        </option>
                                                        <option value="2"
                                                            @if ($membership->unlimited_status == 'False') selected @endif>لا
                                                        </option>
                                                            @endif
                                                          

                                                        </select>
                                                    </div>
                                                </div>

                                                {{-- الاسم بالعربي --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="name_ar">العنوان
                                                        بالعربي: <strong class="text-danger">
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
                                                            id="name_ar" placeholder="العنوان بالعربي"
                                                            value="{!! $membership->name_ar ? $membership->name_ar : null !!}">
                                                    </div>
                                                </div>

                                                {{-- premiumMemberships الإسم بالإنجليزي --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="name_en">العنوان
                                                        بالانجليزي : <strong class="text-danger">
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
                                                            id="name_en" placeholder="العنوان بالانجليزي"
                                                            value="{!! $membership->name_en ? $membership->name_en : null !!}">
                                                    </div>
                                                </div>





                                                {{--  Price --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="price">
                                                        السعر: <strong class="text-danger">
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
                                                        <input type="number" min="0" name="price"  step="any"
                                                            class="form-control @error('price') is-invalid @enderror"
                                                            id="price" placeholder="Price"
                                                            value="{!! $membership->price ? $membership->price : null !!}">
                                                    </div>
                                                </div>

                                                {{--  Ad's Expiry Days --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="number_days_ad">
                                                        مدة الاعلان : <strong class="text-danger">
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
                                                            id="number_days_ad" placeholder="Ad's Expiry Days "
                                                            value="{!! $membership->number_days_ad ? $membership->number_days_ad : null !!}">
                                                    </div>
                                                </div>

                                                {{--  Membership Expiry Days --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="number_days_membership">
                                                        عدد ايام العضوية : <strong class="text-danger">
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
                                                            id="number_days_membership"
                                                            placeholder="Membership Expiry Days "
                                                            value="{!! $membership->number_days_membership ? $membership->number_days_membership : null !!}">
                                                    </div>
                                                </div>

                                                {{--  Number of Ads --}}
                                                <div class="col-md-6" id="num_ads">
                                                    <label class="text-dark font-weight-medium mb-3" for="number_of_ads">
                                                        عدد الاعلانات: <strong class="text-danger">
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
                                                            id="number_of_ads" placeholder="number of ads"
                                                            value="{!! $membership->number_of_ads ? $membership->number_of_ads : null !!}">
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
                                                                @if ($membership->status == 'Active') selected @endif>مفعل
                                                            </option>
                                                            <option value="2"
                                                                @if ($membership->status == 'Inactive') selected @endif>غير مفعل
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
                                                                id="inputGroupPrepend2"></span>
                                                        </div>

                                                        <textarea maxlength="50" name="description_en" placeholder="  الوصف بالانجليزي " class=" form-control" rows="10">{!! $membership->description_en ? $membership->description_en : null !!}</textarea>


                                                    </div>
                                                </div>
                                                {{--  Description EN --}}
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
                                                                id="inputGroupPrepend2"></span>
                                                        </div>

                                                        <textarea maxlength="50" name="description_ar" placeholder="  الوصف بالعربي " class=" form-control" rows="10">{!! $membership->description_ar ? $membership->description_ar : null !!}</textarea>


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
