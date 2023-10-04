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
                    <h1>اضافة  Region </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحة التحكم
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                {{isset($diyarnaa_city->country) ? $diyarnaa_city->country->name_ar : null }}
                            </li>


                            <li class="breadcrumb-item">
                                <a
                                    href="{{ route('super_admin.diyarnaa_countries-showCities', isset($diyarnaa_city->diyarnaa_country_id) ? $diyarnaa_city->diyarnaa_country_id : -1) }}">
                                    جميع المحافظات
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a>
                                    {{ isset($diyarnaa_city->name_ar) ? $diyarnaa_city->name_ar : '-----' }}
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a
                                    href="{{ route('super_admin.diyarnaa_cities-showRegions', isset($diyarnaa_city->id) ? $diyarnaa_city->id : -1) }}">
                                      جميع المناطق </a>
                            </li>

                            <li class="breadcrumb-item" aria-current="page">اضافة  منطقة </li>
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
                                        <form id="createForm" action="{{ route('super_admin.diyarnaa_regions-store') }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="diyarnaa_city_id" value="{{ $diyarnaa_city->id }}">
                                            <div class="form-row">
                                                <div id="buildyourform"></div>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <button class="mdi btn btn-primary" type="button" id='add'><span
                                                        class="mdi mdi-plus"></span>اضافة منطقة</button>

                                                <button class="mdi btn btn-primary" type="button" id='save'
                                                    onclick="allAreNull()"><span class="mdi mdi-plus"></span>حفظ</button>
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
                $("#add").click(function() {
                    var lastField = $("#buildyourform div:last"); //bring last div in this id
                    var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1; //counter
                    var fieldWrapper = $("<div class=\"input-group fieldwrapper  col-md-12 mb-3\" id=\"field" +
                        intId + "\"/>");
                    fieldWrapper.data("idx", intId);
                    var flabel = $(
                        "<label style=\"padding:9px\" class=\"text-dark font-weight-medium mb-3 \" >  الإسم بالإنجليزي" +
                        intId + "  : </label>");

                    var fType = $(
                        "<input placeholder=\"الإسم بالإنجليزي " + intId +
                        "\"   type=\"text\" name=\"name_en[]\" class=\"fieldname form-control\" />"
                    );
                    var flabelTwo = $(
                        "<label style=\"padding:9px\" class=\"text-dark font-weight-medium mb-3 \" > الاسم بالعربي " +
                        intId + " : </label>");


                    var fTypeTwo = $(
                        "<input placeholder=\"الاسم بالعربي" + intId +
                        "\"   type=\"text\" name=\"name_ar[]\" style=\"margin-right: 10px\" class=\"fieldname form-control\" />"
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
                var name_ar = document.getElementsByName('name_ar[]');
                var name_en = document.getElementsByName('name_en[]');
                var flag = 0;
                for (var i = 0; i < name_ar.length; i++) {
                    if (name_ar[i].value == '' || name_en[i].value == '') {
                        flag = 1;
                    }
                }
                if (flag == 1) {

                    swal({
                        icon: 'error',
                        title: 'Oops...',
                        text: " Please fill all fields or remove empty fields",
                        width: 400,
                    });

                } else {
                    document.getElementById('createForm').submit();
                }
            }
        </script>
    @endsection
