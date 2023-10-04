@extends('admin.layouts.app')

{{-- @section('admin_css')
    <link href="{{ asset('resources/dashboard_files/assets/plugins/data-tables/datatables.bootstrap4.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('resources/dashboard_files/assets/css/sleek.min.css') }}">
@endsection --}}

@section('content')
    {{-- =========================================================== --}}
    {{-- ================== Sweet Alert Section ==================== --}}
    {{-- =========================================================== --}}
    <div>
        @if (session()->has('success'))
            <script>
                swal("Great Job !!!", "{!! Session::get('success') !!}", "success", {
                    button: "OK",
                });
            </script>
        @endif
        @if (session()->has('danger'))
            <script>
                swal("Oops !!!", "{!! Session::get('danger') !!}", "error", {
                    button: "Close",
                });
            </script>
        @endif
    </div>

    {{-- ============================================== --}}
    {{-- ================== Header ==================== --}}
    {{-- ============================================== --}}
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1><i class="mdi mdi-information"></i> معلومات السلايدر</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('super_admin.dashboard') }}">
                            <i class="mdi mdi-home"></i> لوحه التحكم
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('super_admin.home_sliders-index') }}">
                            <i class="mdi mdi-format-list-bulleted"></i> السلايدرات
                        </a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page"><i class="mdi mdi-information"></i> معلومات السلايدر
                    </li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('super_admin.home_sliders-edit', [isset($home_slider->id) ? $home_slider->id : 'Undefined']) }}"
                class="mb-1 btn btn-primary" title="Edit"><i class="mdi mdi-playlist-edit"></i></i> تعديل </a>
            @if (isset($home_slider->status) && $home_slider->status == 'Pending')
                <a href="{{ route('super_admin.home_sliders-reject', [isset($home_slider->id) ? $home_slider->id : '----------']) }}"
                    class="process mb-1 btn  btn-danger" title=" Reject"><i class="fas fa-ban"></i> رفض </a>
                <a href="{{ route('super_admin.home_sliders-accept', [isset($home_slider->id) ? $home_slider->id : '----------']) }}"
                    class="process mb-1 btn  btn-success" title="Accept"><i class="fas fa-check-circle"> قبول </i></a>
            @endif


        </div>
    </div>

    <div class="bg-white border rounded">
        <div class="row no-gutters">


            {{-- ================================================================================================= --}}
            {{-- ========================================== Left Section ========================================= --}}
            {{-- ================================================================================================= --}}
            <div class="col-lg-12 col-xl-12">
                <div class="profile-content-right py-5">
                    {{-- ================================================================================================= --}}
                    {{-- ================================ Tabs Titles (Headers) Section ================================== --}}
                    {{-- ================================================================================================= --}}
                    <ul class="nav nav-tabs px-3 px-xl-5 nav-style-border" id="myTab" role="tablist">
                        {{-- Tab 1 --}}
                        <li class="nav-item">
                            <a class="nav-link active" id="timeline-tab" data-toggle="tab" href="#tab_1" role="tab"
                                aria-controls="tab_1" aria-selected="true"><i class="mdi mdi-information"></i> Main Info</a>
                        </li>



                        {{-- ================================================================================================= --}}
                        {{-- ================================= Tabs Details (Bodies) Section ================================= --}}
                        {{-- ================================================================================================= --}}
                        <div class="tab-content px-3 px-xl-5 col-12" id="myTabContent">
                            {{-- ============================================================================== --}}
                            {{-- ================================= Tab 1 Body ================================= --}}
                            {{-- ============================================================================== --}}
                            <div class="tab-pane fade show active" id="tab_1" role="tabpanel"
                                aria-labelledby="timeline-tab">
                                {{-- ============================================== --}}
                                {{-- ============= All Error Messages ============= --}}
                                {{-- ============================================== --}}
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

                                {{-- ============================================== --}}
                                {{-- ============== Main Information ============== --}}
                                {{-- ============================================== --}}
                                <div class="media mt-3 profile-timeline-media col--12">
                                    <div class="media-body">
                                        <h3 class="py-3 text-dark"><i class="mdi mdi-information"></i> المعلومات الرئيسية :
                                        </h3>
                                        <table id="hoverable-data-table" class="table table-hover table-striped">
                                            <thead>



                                                <tr>
                                                    <th>نوع المستخدم : <span style="color:blue;">
                                                            {!! isset($home_slider->user_type) ? $home_slider->user_type : '<span style="color:blue;">----------</span>' !!}

                                                </tr>
                                                <tr>
                                                    <th>اسم الشركة بالعربي : <span style="color:blue;">
                                                            {!! isset($home_slider->company_name_ar)
                                                                ? $home_slider->company_name_ar
                                                                : '<span style="color:blue;">----------</span>' !!}
                                                        </span> </th>
                                                    <th>اسم الشركة بالانجليزي : <span style="color:blue;">
                                                            {!! isset($home_slider->company_name_en)
                                                                ? $home_slider->company_name_en
                                                                : '<span style="color:blue;">----------</span>' !!}
                                                        </span>
                                                    </th>
                                                </tr>



                                                <tr>
                                                    <th>الايميل: <span style="color:blue;">{!! isset($home_slider->email) ? $home_slider->email : '<span style="color:blue;">----------</span>' !!}</span>
                                                    <th>رقم الهاتف : <span
                                                            style="color:blue;">{!! isset($home_slider->phone) ? $home_slider->phone : '<span style="color:blue;">----------</span>' !!}</span>
                                                    </th>

                                                </tr>

                                                <tr>
                                                    <th>الدولة : <span style="color:blue;">{!! isset($home_slider->diyarnaaCountry->name_en)
                                                        ? $home_slider->diyarnaaCountry->name_en
                                                        : '<span style="color:blue;">----------</span>' !!}</span>
                                                    <th>المدينة : <span style="color:blue;">{!! isset($home_slider->diyarnaaCity->name_en)
                                                        ? $home_slider->diyarnaaCity->name_en
                                                        : '<span style="color:blue;">----------</span>' !!}</span>

                                                </tr>
                                                <tr>
                                                    <th>العنوان بالانجليزي : <span
                                                            style="color:blue;">{!! isset($home_slider->title_en) ? $home_slider->title_en : '<span style="color:blue;">----------</span>' !!}</span>
                                                    </th>
                                                    <th>العنوان بالعربي : <span
                                                            style="color:blue;">{!! isset($home_slider->title_ar) ? $home_slider->title_ar : '<span style="color:blue;">----------</span>' !!}</span>
                                                    </th>

                                                </tr>
                                                <tr>
                                                    <th>الحالة : <span style="color:blue;">{!! isset($home_slider->status) ? $home_slider->status : '<span style="color:blue;">----------</span>' !!}</span>
                                                    </th>

                                                    <th><i class="mdi mdi-clock-outline mdi-spin"></i> تاريخ الانتهاء :
                                                        <span style="color:blue;">{!! isset($home_slider->expire_date)
                                                            ? date('Y / F (m) / d', strtotime($home_slider->expire_date))
                                                            : '<span style="color:blue;">----------</span>' !!}</span>
                                                    </th>
                                                </tr>



                                                <tr>
                                                    <th colspan="2">
                                                        <div
                                                            style="border:solid 1px black; border-radius:10px; padding:10px;">
                                                            الوصف بالعربي : <br>
                                                            <hr>
                                                            <span style="color:blue;">{!! isset($home_slider->description_ar)
                                                                ? $home_slider->description_ar
                                                                : "<span class='mainColor'>----------</span>" !!}</span>
                                                        </div>
                                                    </th>

                                                </tr>
                                                <tr>
                                                    <th colspan="2">
                                                        <div
                                                            style="border:solid 1px black; border-radius:10px; padding:10px;">
                                                            الوصف بالانجليزي : <br>
                                                            <hr>
                                                            <span style="color:blue;">{!! isset($home_slider->description_en)
                                                                ? $home_slider->description_en
                                                                : "<span class='mainColor'>----------</span>" !!}</span>
                                                        </div>
                                                    </th>

                                                </tr>

                                                <tr>
                                                    <th colspan="2" style="text-align: center">
                                                        <h4 style="padding-bottom: 10px">صوره الملف الشخصي</h4>
                                                        @if (isset($home_slider->image) &&
                                                            $home_slider->getRawOriginal('image') &&
                                                            file_exists($home_slider->getRawOriginal('image')))
                                                            <img src="{{ asset($home_slider->image) }}"
                                                                style="border-radius: 10px; border:solid 1px black;width: 300px;
                                                                height: 200px;">
                                                        @else
                                                            <img src="{{ asset('images_default/default.png') }}"
                                                                style="border-radius: 10px; border:solid 2px black; width: 300px; height: 200px;">
                                                        @endif
                                                    </th>

                                                </tr>

                                                <tr>
                                                    <th colspan="2" style="text-align: center">
                                                        <h4 style="padding-bottom: 10px">صوره الترخيص </h4>
                                                        @if (isset($home_slider->license_image) &&
                                                            $home_slider->getRawOriginal('license_image') &&
                                                            file_exists($home_slider->getRawOriginal('license_image')))
                                                            <img src="{{ asset($home_slider->license_image) }}"
                                                                style="border-radius: 10px; border:solid 1px black; width: 300px; height: 200px;">
                                                        @else
                                                            <img src="{{ asset('images_default/default.png') }}"
                                                                style="border-radius: 10px; border:solid 2px black; width: 300px; height: 200px;">
                                                        @endif
                                                    </th>

                                                </tr>







                                            </thead>
                                        </table>
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
    <script src="{{ asset('style_files/backend/plugins/data-tables/jquery.datatables.min.js') }}"></script>
    <script src="{{ asset('style_files/backend/plugins/data-tables/datatables.bootstrap4.min.js') }}"></script>
@endsection
