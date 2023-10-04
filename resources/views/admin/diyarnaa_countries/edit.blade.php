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
                    <h1>تعديل دولة</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحه التحكم
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.diyarnaa_countries-index') }}">
                                    <i class="fas fa-users-cog"></i>الدول
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
                                            action="{{ route('super_admin.diyarnaa_countries-update', isset($diyarnaa_country->id) ? $diyarnaa_country->id : -1) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-row">

                                                {{-- Country name --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="name_en">
                                                        الإسم بالإنجليزي:
                                                        <strong class="text-danger"> *
                                                            @error('name_en')
                                                                {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-format-title"
                                                                id="name_en"></span>
                                                        </div>
                                                        <input type="text" name="name_en"
                                                            class="form-control @error('name_en') is-invalid @enderror"
                                                            id="name_en" placeholder="اسم الدولة بالانجليزية"
                                                            value="{!! isset($diyarnaa_country->name_en) ? $diyarnaa_country->name_en : null !!}">
                                                    </div>
                                                </div>




                                                {{-- Country name --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="name_en">
                                                        الاسم بالعربي:
                                                        <strong class="text-danger"> *
                                                            @error('name_ar')
                                                                {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-format-title"
                                                                id="name_ar"></span>
                                                        </div>
                                                        <input type="text" name="name_ar"
                                                            class="form-control @error('name_ar') is-invalid @enderror"
                                                            id="name_ar" value="{!! isset($diyarnaa_country->name_ar) ? $diyarnaa_country->name_ar : null !!}">
                                                    </div>
                                                </div>
                                                 {{-- كود الدولة  --}}
                                                 <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="name_en">
                                                        كود الدولة  : 
                                                        <strong class="text-danger"> *
                                                            @error('country_code')
                                                                {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-format-title"
                                                                id="country_code"></span>
                                                        </div>
                                                        <input type="text" name="country_code"
                                                            class="form-control @error('country_code') is-invalid @enderror"
                                                            id="country_code" value="{!! isset($diyarnaa_country->country_code) ? $diyarnaa_country->country_code : null !!}">
                                                    </div>
                                                </div>



                                              

                                                {{-- العملة --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01">العملة: <strong class="text-danger">*
                                                            @error('public_currency_id')
                                                                {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <select name="public_currency_id" class="selectpicker"
                                                            data-live-search="true" data-width="88%"
                                                            data-actions-box="true" style="width: 100%">
                                                            <option value="" selected>اختر العملة ...</option>
                                                            @if (isset($public_currencies) && $public_currencies->count() > 0)
                                                                @foreach ($public_currencies as $public_currency)
                                                                    <option value="{{ $public_currency->id }}"
                                                                        @if (isset($diyarnaa_country->public_currency_id) &&
                                                                            $diyarnaa_country->public_currency_id == $public_currency->id) selected @endif>
                                                                        {{ isset($public_currency->name_en) ? $public_currency->name_en : '------' }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>

                                                {{-- Status --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="text-dark font-weight-medium mb-3" for="status">الحالة
                                                        :
                                                        <strong class="text-danger">
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
                                                            id="status">
                                                            <option value="" selected>اختر الحالة...</option>
                                                            <option value="1"
                                                                @if ($diyarnaa_country->status == 'Active') selected @endif>مفعل
                                                            </option>
                                                            <option value="2"
                                                                @if ($diyarnaa_country->status == 'Inactive') selected @endif>
                                                                غير مفعل
                                                            </option>

                                                        </select>
                                                    </div>
                                                </div>


                                                  {{-- Country Image --}}
                                                  <div class="col-md-6 mb-2">
                                                    <label class="text-dark font-weight-medium mb-3" for="name_en">الصورة
                                                        <strong class="text-danger"> *
                                                            @error('image')
                                                                {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>

                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-cloud-upload"></span>
                                                        </div>
                                                        <input type="file" name="image" class="form-control"
                                                            id="image" placeholder="image">
                                                    </div>


                                                    @if (isset($diyarnaa_country->image) &&
                                                        $diyarnaa_country->getRawOriginal('image') &&
                                                        file_exists($diyarnaa_country->getRawOriginal('image')))
                                                        <img src="{{ asset($diyarnaa_country->image) }}" width="100"
                                                            height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @else
                                                        <img src="{{ asset('images_default/default.png') }}" width="70"
                                                            height="70"
                                                            style="border-radius: 10px; border:solid 2px black;">
                                                    @endif


                                                    @error('image')
                                                        <h4 class="form-text text-danger"> - {{ $message }}</h4>
                                                    @enderror
                                                </div>

                                                {{-- العلم--}}
                                                <div class="col-md-6 mb-2">


                                                      <label class="text-dark font-weight-medium mb-3" for="name_en">العلم
                                                        <strong class="text-danger"> *
                                                            @error('flag')
                                                                {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-cloud-upload"></span>
                                                        </div>
                                                        <input type="file" name="flag" class="form-control"
                                                            id="flag" placeholder="flag">
                                                    </div>


                                                    @if (isset($diyarnaa_country->flag) &&
                                                        $diyarnaa_country->getRawOriginal('flag') &&
                                                        file_exists($diyarnaa_country->getRawOriginal('flag')))
                                                        <img src="{{ asset($diyarnaa_country->flag) }}" width="100"
                                                            height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @else
                                                        <img src="{{ asset('flags_default/default.png') }}" width="70"
                                                            height="70"
                                                            style="border-radius: 10px; border:solid 2px black;">
                                                    @endif


                                                    @error('flag')
                                                        <h4 class="form-text text-danger"> - {{ $message }}</h4>
                                                    @enderror
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
