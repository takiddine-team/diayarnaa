@extends('admin.layouts.app')


@section('content')
    <div class="content-wrapper">
        <div class="content">
            {{-- ============================================== --}}
            {{-- ================== Header ==================== --}}
            {{-- ============================================== --}}
            <div class="breadcrumb-wrapper breadcrumb-contacts">
                <div>
                    <h1>اضافة شرط تعديل</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحة التحكم
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.advertisements-index') }}">
                                    <span class="fa fa-th"></span> الاعلانات
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">اضافة شرط تعديل </li>
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
                                            action="{{ route('super_admin.advertisements-acceptWithConditionRequest', isset($advertisement->id) ? $advertisement->id : -1) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-row">

                                                {{-- اسم الناشر --}}
                                                <div class="col-md-6 mb-3" id="office">
                                                    <label class="text-dark font-weight-medium mb-3" for="file">
                                                        اسم الناشر:

                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                        </div>
                                                        <label>
                                                            <strong class="text-danger">
                                                                {{ isset($advertisement->user->name) ? $advertisement->user->name : '' }}
                                                            </strong>
                                                        </label>
                                                    </div>
                                                </div>


                                                {{--  نوع المستخدم  --}}
                                                <div class="col-md-6 mb-3" id="office">
                                                    <label class="text-dark font-weight-medium mb-3" for="file">
                                                        نوع المستخدم :

                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">

                                                        </div>
                                                        <label>
                                                            <strong class="text-danger">
                                                                {{ isset($advertisement->user->user_type) ? $advertisement->user->user_type : '' }}
                                                            </strong>
                                                        </label>
                                                    </div>
                                                </div>


                                                {{--   كود الاعلان  --}}
                                                <div class="col-md-6 mb-3" id="office">
                                                    <label class="text-dark font-weight-medium mb-3" for="file">
                                                        كود الاعلان :

                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">

                                                        </div>
                                                        <label>
                                                            <strong class="text-danger">
                                                                {{ isset($advertisement->code) ? $advertisement->code : '' }}
                                                            </strong>
                                                        </label>
                                                    </div>
                                                </div>


                                                {{--   عنوان الاعلان  --}}
                                                <div class="col-md-6 mb-3" id="office">
                                                    <label class="text-dark font-weight-medium mb-3" for="file">
                                                        عنوان الاعلان :

                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">

                                                        </div>
                                                        <label>
                                                            <strong class="text-danger">
                                                                {{ isset($advertisement->title_ar) ? $advertisement->title_ar : '' }}
                                                            </strong>
                                                        </label>
                                                    </div>
                                                </div>




                                                {{-- مرفق --}}
                                                <div class="col-md-6 mb-3" id="office">
                                                    <label class="text-dark font-weight-medium mb-3" for="file">
                                                        مرفق:
                                                        <strong class="text-danger">
                                                            * @error('file')
                                                                {{ $message }}
                                                            @enderror
                                                        </strong></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-cloud-upload"></span>
                                                        </div>
                                                        <input type="file" name="file" class="form-control"
                                                            id="file">
                                                    </div>
                                                </div>

                                                {{--  التفاصيل --}}
                                                <div class="col-12">
                                                    <label class="text-dark font-weight-medium mb-3" for="details">
                                                        التفاصيل: <strong class="text-danger">
                                                            * @error('details')
                                                                - {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">

                                                        </div>
                                                        <textarea style="width: 90% !important" name="details" class="form-control ckeditor" rows="5" id='details'>{{ old('details') ? old('details') : null }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <button class="mdi btn btn-primary" type="submit"><span
                                                            class="mdi mdi-plus"></span>ارسال
                                                    </button>
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

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    @endsection

    @section('admin_javascript')
        <script>
            $(document).ready(function() {
                getCountry();
                getUsers();
                getDiyarnaaCities();
                setTimeout(() => {
                    getDiyarnaaRegions();
                    getSubCategories();
                    getFeatureType();
                }, 500);
            });







            $('#user_type').on('change', function() {
                getCountry();
            });

            function getCountry() {
                if ($('#user_type').val() == 1) {
                    $("#diyarnaa_country_id_box").css("display", "none");

                } else if ($('#user_type').val() == 3 || $('#user_type').val() == 2) {
                    $("#diyarnaa_country_id_box").css("display", "block");
                }
            }
        </script>
        <script>
            $('#user_type').on('change', function() {
                getCountry();
            });
        </script>
        {{-- //=========================================================================================
        //========================================= getDiyarnaaCities==============================
        //========================================================================================= --}}
        <script>
            //=========================================================================================
            //========================================= getuser()==============================
            //=========================================================================================
            function getUsers() {
                if ($('#user_type').val() != 1) {
                    $('#diyarnaa_city_id').html('<option value="">المدينة  </option>');

                }
                var formData = new FormData($('#createForm')[0]);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('super_admin.advertisements-getUsers') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(data) {
                        if (data.status == true) {
                            var selectUser = '<option value="">اختر صاحب الاعلان... </option>';
                            for (var key in data.user) {
                                // skip loop if the property is from prototype
                                if (!data.user.hasOwnProperty(key)) continue;

                                var obj = data.user[key];
                                for (var prop in obj) {
                                    // skip loop if the property is from prototype
                                    if (!obj.hasOwnProperty(prop)) continue;
                                    // your code
                                    var user_id_old_value = $("#user_id_old_value").val();
                                    if (user_id_old_value) {
                                        if (obj.id == user_id_old_value) {
                                            selectUser += '<option value="' + obj.id + '" selected>' + obj
                                                .name + '</option>';
                                        } else {
                                            selectUser += '<option value="' + obj.id + '">' + obj.name +
                                                '</option>';
                                        }
                                    } else {
                                        selectUser += '<option value="' + obj.id + '">' + obj.name +
                                            '</option>';
                                    }
                                    break;
                                }
                            }
                            $('#user_id').html(selectUser);
                        } else {
                            $('#user_id').html('<option value="">لا يوجد مستخدمين</option>');
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
        {{-- //=========================================================================================
        //========================================= getDiyarnaaCities==============================
        //========================================================================================= --}}
        <script>
            function getDiyarnaaCities() {
                $('#diyarnaa_region_id').html('<option value="">المدينة  </option>');

                var formData = new FormData($('#createForm')[0]);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('super_admin.advertisements-getDiyarnaaCities') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(data) {
                        if (data.status == true) {

                            var selectCity = '<option value="">اختر مدينة... </option>';
                            for (var key in data.diyarnaa_cities) {
                                // skip loop if the property is from prototype
                                if (!data.diyarnaa_cities.hasOwnProperty(key)) continue;

                                var obj = data.diyarnaa_cities[key];
                                for (var prop in obj) {
                                    // skip loop if the property is from prototype
                                    if (!obj.hasOwnProperty(prop)) continue;
                                    // your code
                                    var diyarnaa_city_id_old_value = $("#diyarnaa_city_id_old_value").val();
                                    if (diyarnaa_city_id_old_value) {
                                        if (obj.id == diyarnaa_city_id_old_value) {
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
                            $('#diyarnaa_city_id').html(selectCity);
                        } else {
                            $('#diyarnaa_city_id').html('<option value="">لا يوجد مدن</option>');
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
        {{-- //=========================================================================================
        //========================================= getDiyarnaaRegions==============================
        //========================================================================================= --}}
        <script>
            function getDiyarnaaRegions() {
                var formData = new FormData($('#createForm')[0]);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('super_admin.advertisements-getDiyarnaaRegions') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(data) {
                        if (data.status == true) {
                            var selectRegion = '<option value="">اختر منطقة ... </option>';
                            for (var key in data.diyarnaa_regions) {
                                // skip loop if the property is from prototype
                                if (!data.diyarnaa_regions.hasOwnProperty(key)) continue;

                                var obj = data.diyarnaa_regions[key];
                                for (var prop in obj) {
                                    // skip loop if the property is from prototype
                                    if (!obj.hasOwnProperty(prop)) continue;
                                    // your code
                                    var diyarnaa_region_id_old_value = $("#diyarnaa_region_id_old_value").val();
                                    if (diyarnaa_region_id_old_value) {
                                        if (obj.id == diyarnaa_region_id_old_value) {
                                            selectRegion += '<option value="' + obj.id + '" selected>' + obj
                                                .name_ar + '</option>';
                                        } else {
                                            selectRegion += '<option value="' + obj.id + '">' + obj.name_ar +
                                                '</option>';
                                        }
                                    } else {
                                        selectRegion += '<option value="' + obj.id + '">' + obj.name_ar +
                                            '</option>';
                                    }
                                    break;
                                }
                            }
                            $('#diyarnaa_region_id').html(selectRegion);
                        } else {
                            var selectRegion = '<option value="">اختر منطقة ... </option>';
                            $('#diyarnaa_region_id').html(selectRegion);
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
        {{-- //=========================================================================================
        //========================================= getSubCategories==============================
        //========================================================================================= --}}
        <script>
            function getSubCategories() {
                var formData = new FormData($('#createForm')[0]);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('super_admin.advertisements-getSubCategories') }}",
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
                        } else {
                            $('#sub_category_id').html('<option value="">لا يوجد تصنيفات فرعية</option>');
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
        {{-- //=========================================================================================
        //========================================= getFeatureType==============================
        //========================================================================================= --}}
        <script>
            function getFeatureType() {
                var formData = new FormData($('#createForm')[0]);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('super_admin.advertisements-getFeatureType') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(data) {
                        if (data.status == true) {
                            if (data.feature_type.includes(1)) {
                                $('#construction_age_box').css('display', 'block');
                            } else {
                                $('#construction_age_box').css('display', 'none');
                            }
                            if (data.feature_type.includes(2)) {
                                $('#land_area_box').css('display', 'block');
                            } else {
                                $('#land_area_box').css('display', 'none');
                            }
                            if (data.feature_type.includes(3)) {
                                $('#real_estate_status_box').css('display', 'block');
                            } else {
                                $('#real_estate_status_box').css('display', 'none');
                            }
                            if (data.feature_type.includes(4)) {
                                $('#number_of_rooms_box').css('display', 'block');
                            } else {
                                $('#number_of_rooms_box').css('display', 'none');
                            }
                            if (data.feature_type.includes(5)) {
                                $('#number_of_bathrooms_box').css('display', 'block');
                            } else {
                                $('#number_of_bathrooms_box').css('display', 'none');
                            }
                            if (data.feature_type.includes(6)) {
                                $('#number_of_floors_box').css('display', 'block');
                            } else {
                                $('#number_of_floors_box').css('display', 'none');
                            }
                        } else {
                            $('#construction_age_box').css('display', 'none');
                            $('#land_area_box').css('display', 'none');
                            $('#real_estate_status_box').css('display', 'none');
                            $('#number_of_rooms_box').css('display', 'none');
                            $('#number_of_bathrooms_box').css('display', 'none');
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

        <script>
            $(document).ready(function() {
                $("#add").click(function() {
                    var lastField = $("#buildyourform div:last"); //bring last div in this id
                    var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1; //counter
                    var fieldWrapper = $("<div class=\"input-group fieldwrapper  col-md-12 mb-3\" id=\"field" +
                        intId + "\"/>");
                    fieldWrapper.data("idx", intId);
                    var flabel = $(
                        "<label style=\"padding:9px\" class=\"text-dark font-weight-medium mb-3 \" >  الميزة بالإنجليزي" +
                        intId + "  : </label>");

                    var fType = $(
                        "<input placeholder=\"الميزة بالإنجليزي " + intId +
                        "\"   type=\"text\" name=\"feature_en[]\" class=\"fieldname form-control\" />"
                    );
                    var flabelTwo = $(
                        "<label style=\"padding:9px\" class=\"text-dark font-weight-medium mb-3 \" > الميزة بالعربي " +
                        intId + " : </label>");


                    var fTypeTwo = $(
                        "<input placeholder=\"الميزة بالعربي" + intId +
                        "\"   type=\"text\" name=\"feature_ar[]\" style=\"margin-right: 10px\" class=\"fieldname form-control\" />"
                    );
                    var removeButton = $(
                        "<input  type=\"button\" class=\"remove mdi btn btn-primary\" value=\"-\" />");
                    removeButton.click(function() {
                        $(this).parent().remove();
                    });
                    // fieldWrapper.append(fName);

                    fieldWrapper.append(flabel);
                    fieldWrapper.append(fType);
                    fieldWrapper.append(flabelTwo);
                    fieldWrapper.append(fTypeTwo);
                    fieldWrapper.append(removeButton);
                    fieldWrapper.append("<br>");
                    $("#buildyourform").append(fieldWrapper);
                });

            });
        </script>
        <script>
            function allAreNull() {
                var feature_ar = document.getElementsByName('feature_ar[]');
                var feature_en = document.getElementsByName('feature_en[]');
                var flag = 0;
                for (var i = 0; i < feature_ar.length; i++) {
                    if (feature_ar[i].value == '' || feature_en[i].value == '') {
                        flag = 1;
                    }
                }
                if (flag == 1) {

                    swal({
                        icon: 'error',
                        title: 'Oops...',
                        text: " الرجاء ملئ جميع حقول الميزات الاضافيه ",
                        width: 400,
                    });

                } else {
                    document.getElementById('createForm').submit();
                }
            }
        </script>
    @endsection
