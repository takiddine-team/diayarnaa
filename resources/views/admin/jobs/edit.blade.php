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
                                <a href="{{ route('super_admin.jobs-index') }}">
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
                                            action="{{ route('super_admin.jobs-update', isset($job->id) ? $job->id : -1) }}"
                                            method="POST" enctype="multipart/form-data">
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
                                                            value="{!! isset($job->title_ar) ? $job->title_ar : null !!}">
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
                                                            value="{!! isset($job->title_en) ? $job->title_en : null !!}">
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
                                                            id='description_ar'>{!! isset($job->description_ar) ? $job->description_ar : null !!}</textarea>
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
                                                            id='description_en'>{!! isset($job->description_en) ? $job->description_en : null !!}</textarea>
                                                    </div>
                                                </div>


                                                {{-- الصورة   --}}
                                                <div class="col-md-6 mb-3" id="office">
                                                    <label class="text-dark font-weight-medium mb-3" for="image">
                                                        حمّل صورة :<strong class="text-danger">
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
                                                        حمّل ملف :<strong class="text-danger">
                                                            @error('file')
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
                                                {{--  صلاحية الحساب  --}}
                                                <div class="col-md-6" id="expiry_date_div">
                                                    <label class="text-dark font-weight-medium mb-3" for="expiry_date">
                                                        صلاحية الحساب :
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
                                                            id="expiry_date"
                                                            value="{{ isset($job->expiry_date) ? $job->expiry_date : null }}">
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
                                                                @if ($job->status == 'Active') selected @endif>Active
                                                            </option>
                                                            <option value="2"
                                                                @if ($job->status == 'Inactive') selected @endif>
                                                                Inactive
                                                            </option>

                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                    </div>

                                    <div class="col-md-12 mb-3">

                                        <button class="btn btn-primary" type="submit">حفظ التعديلات</button>
                                    </div>
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
