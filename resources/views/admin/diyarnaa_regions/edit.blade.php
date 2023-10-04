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
                                    <span class="mdi mdi-home"></span> لوحة التحكم
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                {{isset($diyarnaa_region->city->country) ? $diyarnaa_region->city->country->name_ar : null }}
                            </li>


                            <li class="breadcrumb-item">
                                <a
                                    href="{{ route('super_admin.diyarnaa_countries-showCities', isset($diyarnaa_region->city->country->id) ? $diyarnaa_region->city->country->id : -1) }}">
                                    جميع المحافظات
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a>
                                    {{ isset($diyarnaa_region->city->name_ar) ? $diyarnaa_region->city->name_ar : '-----' }}
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a
                                    href="{{ route('super_admin.diyarnaa_cities-showRegions', isset($diyarnaa_region->city->id) ? $diyarnaa_region->city->id : -1) }}">
                                      جميع المناطق </a>
                            </li>

                              <li class="breadcrumb-item">
                                {{isset($diyarnaa_region->name_ar) ? $diyarnaa_region->name_ar : null }}
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
                                            action="{{ route('super_admin.diyarnaa_regions-update', isset($diyarnaa_region->id) ? $diyarnaa_region->id : -1) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-row">
                                                <input type="hidden" name="diyarnaa_city_id"
                                                    value="{{ $diyarnaa_region->diyarnaa_city_id }}">
                                                {{-- Region name --}}
                                                <div class="col-md-12">
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
                                                            id="name_en" placeholder="Region الإسم بالإنجليزي"
                                                            value="{!! isset($diyarnaa_region->name_en) ? $diyarnaa_region->name_en : null !!}">
                                                    </div>
                                                </div>

                                                {{-- Region name --}}
                                                <div class="col-md-12">
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
                                                        <input type="text" name="name_ar" placeholder="الاسم بالعربي"
                                                            class="form-control @error('name_ar') is-invalid @enderror"
                                                            id="name_ar" value="{!! isset($diyarnaa_region->name_ar) ? $diyarnaa_region->name_ar : null !!}">
                                                    </div>
                                                </div>



                                                {{-- Status --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="text-dark font-weight-medium mb-3" for="status">الحالة :
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
                                                                @if ($diyarnaa_region->status == 'Active') selected @endif>Active
                                                            </option>
                                                            <option value="2"
                                                                @if ($diyarnaa_region->status == 'Inactive') selected @endif>
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
