@extends('admin.layouts.app')



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
            <h1><i class="mdi mdi-information"></i> معلومات الاعلان</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('super_admin.dashboard') }}">
                            <i class="mdi mdi-home"></i> لوحه التحكم
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('super_admin.searches-index') }}">
                            <i class="mdi mdi-format-list-bulleted"></i> الابحاث المضافة
                        </a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page"><i class="mdi mdi-information"></i> معلومات الاعلان
                    </li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('super_admin.searches-edit', [isset($searche->id) ? $searche->id : 'Undefined']) }}"
                class="mb-1 btn btn-primary" title="Edit"><i class="mdi mdi-playlist-edit"></i></i> تعديل </a>


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
                                                    <th>الرمز : <span style="color:blue;">
                                                            {!! isset($searche->code) ? $searche->code : '<span style="color:blue;">----------</span>' !!}
                                                        </span> </th>
                                                    <th>صلاحية الاعلان : <span style="color:blue;">
                                                            {!! isset($searche->expiry_date) ? $searche->expiry_date : '<span style="color:blue;">----------</span>' !!}
                                                        </span> </th>

                                                </tr>
                                                <tr>
                                                    <th>الاسم : <span style="color:blue;">
                                                            {!! isset($searche->user->name) ? $searche->user->name : '<span style="color:blue;">----------</span>' !!}
                                                        </span> </th>
                                                    <th> العنوان : <span style="color:blue;">
                                                            {!! isset($searche->title) ? $searche->title : '<span style="color:blue;">----------</span>' !!}
                                                        </span>
                                                    </th>
                                                </tr>



                                                <tr>
                                                    <th>الدولة : <span style="color:blue;">{!! isset($searche->diyarnaaCountry->name_ar)
                                                        ? $searche->diyarnaaCountry->name_ar
                                                        : '<span style="color:blue;">----------</span>' !!}</span>
                                                    <th>المدينة : <span style="color:blue;">{!! isset($searche->diyarnaaCity->name_ar)
                                                        ? $searche->diyarnaaCity->name_ar
                                                        : '<span style="color:blue;">----------</span>' !!}</span>

                                                </tr>
                                                <tr>
                                                    <th>المنطقة : <span style="color:blue;">{!! isset($searche->diyarnaaRegion->name_ar)
                                                        ? $searche->diyarnaaRegion->name_ar
                                                        : '<span style="color:blue;">----------</span>' !!}</span>
                                                    </th>

                                                    <th>التصنيف الرئيسي : <span
                                                            style="color:blue;">{!! isset($searche->mainCategory->name_ar)
                                                                ? $searche->mainCategory->name_ar
                                                                : '<span style="color:blue;">----------</span>' !!}</span>


                                                </tr>



                                                <tr>

                                                    <th>التصنيف الفرعي : <span
                                                            style="color:blue;">{!! isset($searche->subCategory->name_ar)
                                                                ? $searche->subCategory->name_ar
                                                                : '<span style="color:blue;">----------</span>' !!}</span>

                                                    <th>الحالة : <span style="color:blue;">{!! isset($searche->status) ? $searche->status : '<span style="color:blue;">----------</span>' !!}</span>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>السعر من: 
                                                        <span style="color:blue;">{!! isset($searche->price_from) ?number_format(round($searche->price_from ))  : '<span style="color:blue;">----------</span>' !!}
                                                       $
                                                    </span>
                                                    <th>السعر الى: 
                                                        <span style="color:blue;">{!! isset($searche->price_to) ?number_format(round($searche->price_to ))  : '<span style="color:blue;">----------</span>' !!}
                                                        $
                                                    </span>

                                                </tr>
                                                <tr>
                                                    <th> المساحة من: <span style="color:blue;">
                                                        {!! isset($searche->area_from) ? $searche->area_from : '<span style="color:blue;">----------</span>' !!}
                                                        {!! isset($searche->feature->name_en) ? $searche->feature->name_ar : '<span style="color:blue;">----------</span>' !!}
                                                    </span>
                                                    <th>المساحة الى: <span style="color:blue;">
                                                        {!! isset($searche->area_to) ? $searche->area_to : '<span style="color:blue;">----------</span>' !!}
                                                        {!! isset($searche->feature->name_en) ? $searche->feature->name_ar : '<span style="color:blue;">----------</span>' !!}
                                                    </span>


                                                </tr>
                                                <tr>






                                                </tr>


                                                <tr>
                                                    <th colspan="2">
                                                        <div
                                                            style="border:solid 1px black; border-radius:10px; padding:10px;text-align: center">
                                                            <h3 style="text-align: center">
                                                                الميزات
                                                            </h3>
                                                            <hr>
                                                            @if (isset($searche->construction_age))
                                                                عمر البناء :
                                                                <span style="color:blue; padding-left:10px">
                                                                    {!! isset($searche->construction_age) ? $searche->constructionAge->name_ar : 'غير محدد' !!}
                                                                </span>
                                                                <span>/</span>
                                                            @endif

                                                            @if (isset($searche->land_area))
                                                                مساحة الارض :
                                                                <span style="color:blue; padding-left:10px">
                                                                    {!! isset($searche->land_area) ? $searche->landArea->name_ar : 'غير محدد' !!}
                                                                </span>
                                                                <span>/</span>
                                                            @endif

                                                            @if (isset($searche->real_estate_status))
                                                                حالة العقار :
                                                                <span style="color:blue; padding-left:10px">
                                                                    {!! isset($searche->real_estate_status) ? $searche->realestateStatus->name_ar : 'غير محدد' !!}
                                                                </span>
                                                                <span>/</span>
                                                            @endif

                                                            @if (isset($searche->number_of_rooms))
                                                                عدد الغرف :
                                                                <span style="color:blue; padding-left:10px">
                                                                    {!! isset($searche->number_of_rooms) ? $searche->numberOfRoom->name_ar : 'غير محدد' !!}
                                                                </span>
                                                                <span>/</span>
                                                            @endif

                                                            @if (isset($searche->number_of_bathrooms))
                                                                عدد الحمامات :
                                                                <span style="color:blue; padding-left:10px">
                                                                    {!! isset($searche->number_of_bathrooms) ? $searche->numberOfBathroom->name_ar : 'غير محدد' !!}
                                                                </span>
                                                            @endif

                                                        </div>
                                                    </th>

                                                </tr>
                                                <tr>
                                                    @if (isset($searche->extraFeatures) && count($searche->extraFeatures) > 0)
                                                        <th colspan="2">
                                                            <div
                                                                style="border:solid 1px black; border-radius:10px; padding:10px;text-align: center">
                                                                <h3 style="text-align: center">
                                                                    الميزات الاضافية
                                                                </h3>
                                                                <hr>
                                                                @foreach ($searche->extraFeatures as $extraFeature)
                                                                    <span style="color:blue; padding-left:10px">
                                                                        {!! isset($extraFeature->title_ar) ? $extraFeature->title_ar : 'لايوجد' !!}
                                                                    </span>

                                                                    <span>/</span>
                                                                @endforeach


                                                            </div>
                                                        </th>

                                                </tr>
                                                @endif










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
