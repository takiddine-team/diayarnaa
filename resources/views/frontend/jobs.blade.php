@extends('layouts.app')
@section('content')
    {{-- =========================================================== --}}
    {{-- ================== Sweet Alert Section ==================== --}}
    {{-- =========================================================== --}}
    <div>
        @if (session()->has('success'))
            <script>
                swal("@lang('front.Thank')", "{!! Session::get('success') !!}", "success", {
                    button: "OK",
                });
            </script>
        @endif
        @if (session()->has('danger'))
            <script>
                swal("@lang('front.Sorry')", "{!! Session::get('danger') !!}", "error", {
                    button: "Close",
                });
            </script>
        @endif
    </div>

    <div class="innerPage">
        {{-- =========================================================== --}}
        {{-- =================== Breadcrumb Section ==================== --}}
        {{-- =========================================================== --}}
        <section class="innerImage aboutUs">
            @if (isset($background_image->job) &&
                    $background_image->getRawOriginal('job') &&
                    file_exists($background_image->getRawOriginal('job')))
                <img src="{{ asset($background_image->job) }}" alt="img">
            @else
                <img src="{{ asset('style_files/frontend/img/inner1.png') }}" alt="img">
            @endif
            <div class="pageTitle">
                <h2>@lang('front.Jobs')</h2>
            </div>
        </section>



        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">@lang('front.Homepage')</a>
                >> <span>@lang('front.Jobs')</span>
            </div>

            {{-- =========================================================== --}}
            {{-- =================== العقارات section =============== --}}
            {{-- =========================================================== --}}

            <!-- filter -->
            <section class="realState mt-5 pt-5">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <form action="{{ route('jobs') }}" class="realStateFilter  signUp" id="createForm"
                                style="text-align: initial">
                                @csrf

                                <div class="row my-5">
                                    <!-- real state 1 -->
                                    @if (isset($jobs) && $jobs->count() > 0)
                                        @foreach ($jobs as $job)
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <div class="realStateItem">

                                                    <div class="top">
                                                        @if (isset($job->image) && $job->image && file_exists($job->image))
                                                            <img src="{{ asset($job->image) }}" class="img-fluid"
                                                                alt="img" style="width: 100%;height: 175px;">
                                                        @else
                                                            <img src="{{ asset('style_files/frontend/img/job.jpg') }}"
                                                                class="img-fluid" alt="img"
                                                                style="width: 100%;height: 175px;">
                                                        @endif

                                                        <div class="text">
                                                            <a
                                                                href="{{ route('jobDetails', isset($job->id) ? $job->id : -1) }}">
                                                                <i class="fa-solid fa-circle-plus"></i>
                                                                @if (Config::get('app.locale') == 'ar')
                                                                    <span class="realState_Location">
                                                                        تفاصيل الوظيفه </span>
                                                                @elseif (Config::get('app.locale') == 'en')
                                                                    <span class="realState_Location">
                                                                        Job Details </span>
                                                                    </span>
                                                                @endif
                                                            </a>
                                                            <div class="topBottom">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bottom">
                                                        <p style="font-size: 20px;">
                                                            @if (Config::get('app.locale') == 'ar')
                                                                <span class="realState_Location">
                                                                    {!! isset($job->title_ar) ? $job->title_ar : '------' !!}
                                                                </span>
                                                            @elseif (Config::get('app.locale') == 'en')
                                                                <span class="realState_Location">
                                                                    {!! isset($job->title_en) ? $job->title_en : '------' !!}
                                                                </span>
                                                            @endif
                                                        </p>
                                                        <div class="">
                                                            <span class=""> </span>
                                                            <span>
                                                                @lang('front.DeadlineForSubmission') :
                                                                {{ isset($job->expiry_date) ? $job->expiry_date : '------' }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="col-md-12">
                                            <div class="alert alert-danger">
                                                <h3>
                                                    @if (Config::get('app.locale') == 'ar')
                                                        <span class="realState_Location">
                                                            لا يوجد وظائف </span>
                                                    @elseif (Config::get('app.locale') == 'en')
                                                        <span class="realState_Location">
                                                            No Jobs
                                                        </span>
                                                    @endif
                                                </h3>
                                            </div>
                                    @endif


                                </div>
                        </div>
            </section>
        </div>

    </div>
@endsection

@section('javascript')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            getDiyarnaaCities();

            setTimeout(() => {
                getDiyarnaaRegions();

            }, 1000);
            getSubCategories();


        });

        function getDiyarnaaCities() {
            var formData = new FormData($('#createForm')[0]);
            $.ajax({
                type: 'POST',
                url: "{{ route('getDiyarnaaCities') }}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function(data) {
                    if (data.status == true) {
                       // var selectCity = '<option value="">اختر المحافظة... </option>';
                        var selectCity = '<option value="">@lang('front.StateSelect')</option>';
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
                                            .name + '</option>';
                                    } else {
                                        selectCity += '<option value="' + obj.id + '">' + obj.name +
                                            '</option>';
                                    }
                                } else {
                                    selectCity += '<option value="' + obj.id + '">' + obj.name +
                                        '</option>';
                                }
                                break;
                            }
                        }
                        $('#diyarnaa_city_id').html(selectCity);
                    } else {
                       // $('#diyarnaa_city_id').html('<option value="">لا يوجد محافظات... </option>');
                        $('#diyarnaa_city_id').html('<option value="">@lang('front.NoState') </option>');
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
        function getDiyarnaaRegions() {
            var formData = new FormData($('#createForm')[0]);
            $.ajax({
                type: 'POST',
                url: "{{ route('getDiyarnaaRegions') }}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function(data) {
                    if (data.status == true) {
                        // var selectRegion = '<option value="">اختر منطقة ... </option>';
                        var selectRegion = '<option value="">@lang('front.SelectRegion') </option>';
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
                                            .name + '</option>';
                                    } else {
                                        selectRegion += '<option value="' + obj.id + '">' + obj.name +
                                            '</option>';
                                    }
                                } else {
                                    selectRegion += '<option value="' + obj.id + '">' + obj.name +
                                        '</option>';
                                }
                                break;
                            }
                        }
                        $('#diyarnaa_region_id').html(selectRegion);
                    } else {
                        //  var selectRegion = '<option value="">اختر منطقة ... </option>';
                        var selectRegion = '<option value="">@lang('front.SelectRegion') </option>';
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
    <script>
        function getSubCategories() {
            var formData = new FormData($('#createForm')[0]);
            $.ajax({
                type: 'POST',
                url: "{{ route('getSubCategories') }}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function(data) {
                    if (data.status == true) {
                        //  var selectCity = '<option value="">اختر تصنيف فرعي... </option>';
                        var selectCity = '<option value="">@lang('front.SelectSubCategory'). </option>';
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
                                            .name + '</option>';
                                    } else {
                                        selectCity += '<option value="' + obj.id + '">' + obj.name +
                                            '</option>';
                                    }
                                } else {
                                    selectCity += '<option value="' + obj.id + '">' + obj.name +
                                        '</option>';
                                }
                                break;
                            }
                        }
                        $('#sub_category_id').html(selectCity);
                    } else {
                        // var selectCity = '<option value="">اختر تصنيف فرعي... </option>';
                        var selectCity = '<option value="">@lang('front.SelectSubCategory')</option>';
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
