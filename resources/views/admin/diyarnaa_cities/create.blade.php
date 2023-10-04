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
                <div class="col-md-12">
                    <h1>اضافة  محافظة </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحة التحكم
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                {{ $diyarnaa_country->name_ar }}
                            </li>
                            <li class="breadcrumb-item">
                                <a
                                    href="{{ route('super_admin.diyarnaa_countries-showCities', isset($diyarnaa_country->id) ? $diyarnaa_country->id : -1) }}">
                                    <span class="mdi mdi-home"></span> جميع المحافظات
                                </a>
                            </li>

                            <li class="breadcrumb-item" aria-current="page">اضافة  محافظة </li>
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
                                        <div class="mt-3">
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <h3>Please correct the following errors : </h3>
                                                    <hr>
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>- {{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                        <form id="createForm" action="{{ route('super_admin.diyarnaa_cities-store') }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="diyarnaa_country_id"
                                                value="{{ $diyarnaa_country->id }}">
                                            <div class="form-row">
                                                {{--  الإسم بالإنجليزي --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="name_en">  الإسم بالإنجليزي:
                                                     <strong class="text-danger">
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

                                                {{-- الاسم بالعربي --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="name_ar">  الإسم بالعربي:
                                                         <strong class="text-danger">
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
                                                            id="name_ar" placeholder="الإسم بالعربي"
                                                            value="{!! old('name_ar') ? old('name_ar') : null !!}">
                                                    </div>
                                                </div>

                                                <button class="mdi btn btn-primary" type="submit"><span
                                                        class="mdi mdi-plus"></span> حفظ </button>
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
@endsection
