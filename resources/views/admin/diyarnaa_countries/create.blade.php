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
                    <h1>اضافة  دولة </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحة التحكم
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.diyarnaa_countries-index') }}">
                                    <span class="fa fa-th"></span> الدول
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">اضافة  دولة </li>
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
                                        <form id="createForm" action="{{ route('super_admin.diyarnaa_countries-store') }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-row">



                                                {{-- دولة --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="public_country_id">الدولة : <strong class="text-danger">
                                                            @error('public_country_id')
                                                                {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <select name="public_country_id" class="selectpicker"
                                                            data-live-search="true" data-width="88%" data-actions-box="true"
                                                            style="width: 100%">
                                                            <option value="" selected>اختر دولة ...</option>
                                                            @if (isset($public_countries) && $public_countries->count() > 0)
                                                                @foreach ($public_countries as $public_country)
                                                                    @if (isset($public_country->id) && !in_array($public_country->id, $public_country_ids))

                                                                        <option
                                                                            value="{{ isset($public_country->id) ? $public_country->id : null }}"
                                                                            @if (old('public_country_id') != null) @if (old('public_country_id') == $public_country->id) selected @endif
                                                                            @endif>
                                                                            {{ isset($public_country->name_en) ? $public_country->name_en : '------' }}
                                                                        </option>

                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </select>
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
                                                            id="country_code" value="{{ old('country_code') }}">
                                                    </div>
                                                </div>


                                                {{-- العملة --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for='public_currency_id'>العملة: <strong class="text-danger">
                                                            @error('public_currency_id')
                                                                {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <select name="public_currency_id" class="selectpicker"
                                                            data-live-search="true" data-width="88%" data-actions-box="true"
                                                            style="width: 100%">
                                                            <option value="" selected>اختر العملة ...</option>
                                                            @if (isset($public_currencies) && $public_currencies->count() > 0)
                                                                @foreach ($public_currencies as $public_currency)
                                                                    <option
                                                                        value="{{ isset($public_currency->id) ? $public_currency->id : null }}"
                                                                        @if (old('public_currency_id') != null) @if (old('public_currency_id') == $public_currency->id) selected @endif
                                                                        @endif>
                                                                        {{ isset($public_currency->name_en) ? $public_currency->name_en : '------' }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>


                                                {{--  العلم --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="text-dark font-weight-medium mb-3" for="flag"> العلم :
                                                        <strong class="text-danger">
                                                            * @error('flag')
                                                                {{ $message }}
                                                            @enderror
                                                        </strong></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-cloud-upload"></span>
                                                        </div>
                                                        <input type="file" name="flag" class="form-control"
                                                            id="flag">
                                                    </div>
                                                </div>


                                                {{--  Image --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="text-dark font-weight-medium mb-3" for="image"> صورة :
                                                        <strong class="text-danger">
                                                            * @error('image')
                                                                {{ $message }}
                                                            @enderror
                                                        </strong></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-cloud-upload"></span>
                                                        </div>
                                                        <input type="file" name="image" class="form-control"
                                                            id="image">
                                                    </div>
                                                </div>






                                                {{-- Status --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="text-dark font-weight-medium mb-3" for="status">الحالة :
                                                        <strong class="text-danger"> *
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
                                                            id="status">
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
