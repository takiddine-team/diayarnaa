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
                                <a href="{{ route('super_admin.premium_membership_pages-index') }}">
                                    <i class="fas fa-users-cog"></i> ديزاين صفحة العضويات المميزة
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
                                        <form
                                            action="{{ route('super_admin.premium_membership_pages-update', isset($premium_membership_page->id) ? $premium_membership_page->id : -1) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-row">

                                                {{-- وصف بالإنجليزي --}}
                                                <div class="col-12">
                                                    <label class="text-dark font-weight-medium mb-3" for="description_en">
                                                        الوصف بالإنجليزي <strong class="text-danger"> *
                                                            @error('description_en')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">

                                                        </div>
                                                        <textarea style="width: 90% !important" name="description_en" class="form-control ckeditor" rows="5"
                                                            id='description_en'>{{ isset($premium_membership_page->description_en) ? $premium_membership_page->description_en : '' }}</textarea>
                                                    </div>
                                                </div>
                                                {{--  الوصف بالعربي --}}
                                                <div class="col-12">
                                                    <label class="text-dark font-weight-medium mb-3" for="description_ar">
                                                        الوصف بالعربي <strong class="text-danger"> *
                                                            @error('description_ar')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">

                                                        </div>
                                                        <textarea style="width: 90% !important" name="description_ar" class="form-control ckeditor" rows="5"
                                                            id='description_ar'>{{ isset($premium_membership_page->description_ar) ? $premium_membership_page->description_ar : '' }}</textarea>
                                                    </div>
                                                </div>

                                                {{--  Image --}}
                                                <div class="col-md-6">
                                                    <h3 class="mb-3" for="validationServer01">صورة  العضويات المميزة :</h3>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-cloud-upload"></span>
                                                        </div>
                                                        <input type="file" name="image" class="form-control"
                                                            id="image" placeholder="image">
                                                    </div>
                                                    @if (isset($premium_membership_page->image) &&
                                                        $premium_membership_page->getRawOriginal('image') &&
                                                        file_exists($premium_membership_page->getRawOriginal('image')))
                                                        <img src="{{ asset($premium_membership_page->image) }}"
                                                            width="100" height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @else
                                                        <img src="{{ asset('images_default/default.png') }}" width="100"
                                                            height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @endif


                                                    @error('image')
                                                        <h4 class="form-text text-danger"> - {{ $message }}</h4>
                                                    @enderror
                                                </div>




                                            </div>
                                            <button class="btn btn-primary" type="submit">حفظ التعديلات</button>
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
