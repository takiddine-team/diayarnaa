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
                    <h1> تعديل ربط التصنيفات الفرعية بأنواع الميزات</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحه التحكم
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.feature_type_sub_categories-index') }}">
                                    <i class="fas fa-users-cog"></i> قائمة الميزات
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
                                            action="{{ route('super_admin.feature_type_sub_categories-update', isset($feature_type->id) ? $feature_type->id : -1) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-row">
                                                {{-- >التصنيف الرئيسي --}}
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label for="category_id">التصنيف الرئيسي
                                                            <strong class="text-danger">* @error('category_id')
                                                                    ( {{ $message }} )
                                                                @enderror
                                                            </strong>
                                                        </label>
                                                        <select name="category_id" id="category_id"
                                                            class="category_id custom-select my-1 mr-sm-2 @error('category_id') is-invalid @enderror form-control"
                                                            data-live-search="true" data-width="88%" data-actions-box="true"
                                                            style="width: 100%">
                                                            <option value="" selected>التصنيف الرئيسي ...
                                                            </option>
                                                            @if (isset($categories) && $categories->count() > 0)
                                                                @foreach ($categories as $category)
                                                                    <option value="{{ $category->id }}"
                                                                        @if (old('category_id') != null) @if (old('category_id') == $category->id) selected @endif
                                                                    @else
                                                                        @if ($sub_category->category_id == $category->id) selected @endif
                                                                        @endif>

                                                                        {{ isset($category->name_ar) ? $category->name_ar : '------' }}

                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>

                                                {{-- التصنيف الفرعي --}}
                                                <div class="col-md-6 mb-3" id="sub_category_id_box">

                                                    <label for="sub_category_id">
                                                        التصنيف الفرعي :
                                                        <strong class="text-danger">* @error('sub_category_id')
                                                                ( {{ $message }} )
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <input type="hidden" value="{{ $sub_category->id }}"
                                                        id="sub_category_id_old_value">
                                                    <select name="sub_category_id" id="sub_category_id"
                                                        onchange="getSubCategories()"
                                                        class=" sub_category_id custom-select my-1 mr-sm-2 @error('sub_category_id') is-invalid @enderror form-control"
                                                        data-live-search="true" data-width="88%" data-actions-box="true"
                                                        style="width: 100%">
                                                        <option value="">التصنيف الفرعي ..</option>
                                                    </select>
                                                </div>


                                            </div>

                                            {{--  نوع الميزة --}}
                                            <div class="col-md-12 mb-3">
                                                <label class="text-dark font-weight-medium mb-3" for="name_en"> نوع
                                                    الميزة: <strong class="text-danger">
                                                        *
                                                        @error('feature_type_ids')
                                                            -
                                                            ( {{ $message }} )
                                                        @enderror
                                                    </strong>
                                                </label>
                                                @if (isset($feature_types))
                                                    <ul>
                                                        @foreach ($feature_types as $key => $feature_type)
                                                            <li
                                                                style="display: inline-block; width: 15%;  list-style: outside none none;  ">
                                                                <input class="single-checkbox " type="checkbox"
                                                                    name="feature_type_ids[]"
                                                                    value="{{ $feature_type->id }}"
                                                                    @if (isset($feature_type->id) && in_array($feature_type->id, $feature_type_array)) checked @endif
                                                                    id="feature_type_{{ $key }}">


                                                                <label for="feature_type{{ $key + 1 }}">
                                                                    {{ $feature_type->name_ar }}
                                                                </label>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
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

@section('admin_javascript')
    <script>
        $(document).ready(function() {
            getSubCategories();

        });

        function getSubCategories() {
            var formData = new FormData($('#createForm')[0]);
            $.ajax({
                type: 'POST',
                url: "{{ route('super_admin.feature_type_sub_categories-getSubCategories') }}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function(data) {
                    if (data.status == true) {
                        var selectCity = '<option value="">اختر تصنيف فرعي... </option>';
                        for (var key in data.sub_category) {
                            // skip loop if the property is from prototype
                            if (!data.sub_category.hasOwnProperty(key)) continue;

                            var obj = data.sub_category[key];
                            for (var prop in obj) {
                                // skip loop if the property is from prototype
                                if (!obj.hasOwnProperty(prop)) continue;
                                // your code
                                var sub_category_id_old_value = $("#sub_category_id_old_value").val();
                                if (sub_category_id_old_value) {
                                    if (obj.id == sub_category_id_old_value) {
                                        selectCity += '<option value="' + obj.id + '" selected>' + obj
                                            .name_ar + '</option>';
                                    } else {
                                        selectCity += '<option value="' + obj.id + '">' + obj.name_ar +
                                            '</option>';
                                    }
                                } else {
                                    selectCity += '<option value="' + obj.id + '">' + obj.name_ar +
                                        '</option>';
                                }
                                break;
                            }
                        }
                        $('#sub_category_id').html(selectCity);
                    }else{
                        var selectCity = '<option value="">اختر تصنيف فرعي... </option>';
                        $('#sub_category_id').html(selectCity);
                    }

                },
                error: function(reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function(key, val) {
                        $("#" + key + "_error").text(val[0]);
                    });
                }
            });


        }
    </script>
@endsection
