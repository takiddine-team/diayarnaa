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
            <h1><i class="mdi mdi-information"></i> معلومات الاعلان</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('super_admin.dashboard') }}">
                            <i class="mdi mdi-home"></i> لوحه التحكم
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('super_admin.advertisements-index') }}">
                            <i class="mdi mdi-format-list-bulleted"></i> الاعلانات
                        </a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page"><i class="mdi mdi-information"></i> معلومات الاعلان
                    </li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('super_admin.advertisements-edit', [isset($advertisement->id) ? $advertisement->id : 'Undefined']) }}"
                class="mb-1 btn btn-primary" title="Edit"><i class="mdi mdi-playlist-edit"></i></i> تعديل </a>
            @if (isset($advertisement->status) && $advertisement->status == 'Pending')
                <a href="{{ route('super_admin.advertisements-reject', [isset($advertisement->id) ? $advertisement->id : -1]) }}"
                    class=" mb-1 btn btn-danger" title=" Reject"><i class="fas fa-ban"></i> رفض </a>
                <a href="{{ route('super_admin.advertisements-accept', [isset($advertisement->id) ? $advertisement->id : -1]) }}"
                    class=" mb-1 btn  btn-success" title="Accept"><i class="fas fa-check-circle"></i> قبول </a>
                <a href="{{ route('super_admin.advertisements-acceptWithCondition', [isset($advertisement->id) ? $advertisement->id : -1]) }}"
                    class=" mb-1 btn  btn-success" title="Accept"> الموافقه مع شرط التعديل </a>
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
                                                    <th>الرمز : <span style="color:blue;">
                                                            {!! isset($advertisement->code) ? $advertisement->code : '<span style="color:blue;">----------</span>' !!}
                                                        </span> </th>
                                                    <th>صلاحية الاعلان : <span style="color:blue;">
                                                            {!! isset($advertisement->expiry_date)
                                                                ? $advertisement->expiry_date
                                                                : '<span style="color:blue;">----------</span>' !!}
                                                        </span> </th>

                                                </tr>
                                                <tr>
                                                    <th>الاسم : <span style="color:blue;">
                                                            {!! isset($advertisement->user->name)
                                                                ? $advertisement->user->name
                                                                : '<span style="color:blue;">----------</span>' !!}
                                                        </span> </th>
                                                    <th> الغرض : <span style="color:blue;">
                                                            {!! isset($advertisement->target->name_ar)
                                                                ? $advertisement->target->name_ar
                                                                : '<span style="color:blue;">----------</span>' !!}
                                                        </span>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>العنوان بالعربي : <span style="color:blue;">
                                                            {!! isset($advertisement->title_ar) ? $advertisement->title_ar : '<span style="color:blue;">----------</span>' !!}
                                                        </span> </th>
                                                    <th> العنوان بالانجليزي : <span style="color:blue;">
                                                            {!! isset($advertisement->title_ar) ? $advertisement->title_ar : '<span style="color:blue;">----------</span>' !!}
                                                        </span>
                                                    </th>
                                                </tr>


                                                <tr>
                                                    <th>الدولة : <span style="color:blue;">{!! isset($advertisement->diyarnaaCountry->name_ar)
                                                        ? $advertisement->diyarnaaCountry->name_ar
                                                        : '<span style="color:blue;">----------</span>' !!}</span>
                                                    <th>المدينة : <span style="color:blue;">{!! isset($advertisement->diyarnaaCity->name_ar)
                                                        ? $advertisement->diyarnaaCity->name_ar
                                                        : '<span style="color:blue;">----------</span>' !!}</span>

                                                </tr>
                                                <tr>
                                                    <th>المنطقة : <span style="color:blue;">{!! isset($advertisement->diyarnaaRegion->name_ar)
                                                        ? $advertisement->diyarnaaRegion->name_ar
                                                        : '<span style="color:blue;">----------</span>' !!}</span>
                                                    </th>

                                                    <th>الشارع : <span style="color:blue;">{!! isset($advertisement->street) ? $advertisement->street : '<span style="color:blue;">----------</span>' !!}</span>
                                                    </th>


                                                </tr>



                                                <tr>
                                                    <th>التصنيف الرئيسي : <span
                                                            style="color:blue;">{!! isset($advertisement->mainCategory->name_ar)
                                                                ? $advertisement->mainCategory->name_ar
                                                                : '<span style="color:blue;">----------</span>' !!}</span>
                                                    <th>التصنيف الفرعي : <span
                                                            style="color:blue;">{!! isset($advertisement->subCategory->name_ar)
                                                                ? $advertisement->subCategory->name_ar
                                                                : '<span style="color:blue;">----------</span>' !!}</span>

                                                </tr>
                                                <tr>
                                                    <th>الخريطة: <span style="color:blue;">{!! isset($advertisement->url_map) ? $advertisement->url_map : '<span style="color:blue;">----------</span>' !!}</span>
                                                    <th>السعر : <span style="color:blue;">{!! isset($advertisement->price) ? $advertisement->price : '<span style="color:blue;">----------</span>' !!}</span>

                                                </tr>
                                                <tr>
                                                    <th>المساحة: 
                                                        <span style="color:blue;">
                                                            {!! isset($advertisement->area) ? $advertisement->area : '<span style="color:blue;">----------</span>' !!}
                                                            {!! isset($advertisement->feature->name_en) ? $advertisement->feature->name_ar : '<span style="color:blue;">----------</span>' !!}
                                                            
                                                        </span>
                                                    <th> مرجع الاعلان : <span
                                                            style="color:blue;">{!! isset($advertisement->ad_reference)
                                                                ? $advertisement->ad_reference
                                                                : '<span style="color:blue;">----------</span>' !!}</span>

                                                </tr>
                                                <tr>
                                                    <th>الحالة : <span style="color:blue;">{!! isset($advertisement->status) ? $advertisement->status : '<span style="color:blue;">----------</span>' !!}</span>
                                                    </th>
                                                    @if (isset($advertisement->contact_method))
                                                        
                                                    <th>   @lang("front.ContactMethod")  : <span style="color:blue;">{!! isset($advertisement->contact_method) ? $advertisement->contact_method : '<span style="color:blue;">----------</span>' !!}</span>
                                                    </th>
                                                    @endif
                                                    




                                                </tr>


                                                <tr>
                                                    <th colspan="2">
                                                        <div
                                                            style="border:solid 1px black; border-radius:10px; padding:10px;text-align: center">
                                                            <h3 style="text-align: center">
                                                                الميزات
                                                            </h3>
                                                            <hr>
                                                            @if (isset($advertisement->construction_age))
                                                                عمر البناء :
                                                                <span style="color:blue; padding-left:10px">
                                                                    {!! isset($advertisement->construction_age) ? $advertisement->constructionAge->name_ar : 'غير محدد' !!}
                                                                </span>
                                                                <span>/</span>
                                                            @endif

                                                            @if (isset($advertisement->land_area))
                                                                مساحة الارض :
                                                                <span style="color:blue; padding-left:10px">
                                                                    {!! isset($advertisement->land_area) ? $advertisement->landArea->name_ar : 'غير محدد' !!}
                                                                </span>
                                                                <span>/</span>
                                                            @endif

                                                            @if (isset($advertisement->real_estate_status))
                                                                حالة العقار :
                                                                <span style="color:blue; padding-left:10px">
                                                                    {!! isset($advertisement->real_estate_status) ? $advertisement->realestateStatus->name_ar : 'غير محدد' !!}
                                                                </span>
                                                                <span>/</span>
                                                            @endif

                                                            @if (isset($advertisement->number_of_rooms))
                                                                عدد الغرف :
                                                                <span style="color:blue; padding-left:10px">
                                                                    {!! isset($advertisement->number_of_rooms) ? $advertisement->numberOfRoom->name_ar : 'غير محدد' !!}
                                                                </span>
                                                                <span>/</span>
                                                            @endif

                                                            @if (isset($advertisement->number_of_bathrooms))
                                                                عدد الحمامات :
                                                                <span style="color:blue; padding-left:10px">
                                                                    {!! isset($advertisement->number_of_bathrooms) ? $advertisement->numberOfBathroom->name_ar : 'غير محدد' !!}
                                                                </span>
                                                            @endif

                                                        </div>
                                                    </th>

                                                </tr>
                                                <tr>
                                                    @if (isset($advertisement->extraFeatures) && count($advertisement->extraFeatures) > 0)
                                                        <th colspan="2">
                                                            <div
                                                                style="border:solid 1px black; border-radius:10px; padding:10px;text-align: center">
                                                                <h3 style="text-align: center">
                                                                    الميزات الاضافية
                                                                </h3>
                                                                <hr>
                                                                @foreach ($advertisement->extraFeatures as $extraFeature)
                                                                    <span style="color:blue; padding-left:10px">
                                                                        {!! isset($extraFeature->title_ar) ? $extraFeature->title_ar : 'لايوجد' !!}
                                                                    </span>

                                                                    <span>/</span>
                                                                @endforeach


                                                            </div>
                                                        </th>

                                                </tr>
                                                @endif


                                                <tr>
                                                    <th colspan="2">
                                                        <div
                                                            style="border:solid 1px black; border-radius:10px; padding:10px;text-align: center">

                                                            <h3 style="text-align: center">
                                                                الموقع
                                                            </h3>
                                                            <hr>

                                                            <span style="color:blue;">{!! isset($advertisement->address) ? $advertisement->address : "<span class='mainColor'>----------</span>" !!}</span>
                                                        </div>
                                                    </th>

                                                </tr>
                                                <tr>
                                                    <th colspan="2">
                                                        <div
                                                            style="border:solid 1px black; border-radius:10px; padding:10px;text-align: center">


                                                            <h3 style="text-align: center">
                                                                صيغة العقار
                                                            </h3>
                                                            <hr>

                                                            <span style="color:blue;">{!! isset($advertisement->real_estate_formula)
                                                                ? $advertisement->real_estate_formula
                                                                : "<span class='mainColor'>----------</span>" !!}</span>
                                                        </div>
                                                    </th>

                                                </tr>
                                                <tr>
                                                    <th colspan="2">
                                                        <div
                                                            style="border:solid 1px black; border-radius:10px; padding:10px;text-align: center">


                                                            <h3 style="text-align: center">
                                                                الوصف بالعربي
                                                            </h3>
                                                            <hr>

                                                            <span style="color:blue;">{!! isset($advertisement->description_ar)
                                                                ? $advertisement->description_ar
                                                                : "<span class='mainColor'>----------</span>" !!}</span>
                                                        </div>
                                                    </th>

                                                </tr>
                                                <tr>
                                                    <th colspan="2">
                                                        <div
                                                            style="border:solid 1px black; border-radius:10px; padding:10px;text-align: center">


                                                            <h3 style="text-align: center">
                                                                الوصف بالانجليزي
                                                            </h3>
                                                            <hr>

                                                            <span style="color:blue;">{!! isset($advertisement->description_en)
                                                                ? $advertisement->description_en
                                                                : "<span class='mainColor'>----------</span>" !!}</span>
                                                        </div>
                                                    </th>

                                                </tr>




                                                <tr>
                                                    <th colspan="2" style="text-align: center">
                                                        <h4 style="padding-bottom: 10px">الصورة الرئيسية </h4>
                                                        @if (isset($advertisement->main_image) &&
                                                            $advertisement->getRawOriginal('main_image') &&
                                                            file_exists($advertisement->getRawOriginal('main_image')))
                                                            <img src="{{ asset($advertisement->main_image) }}"
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
                                                        <h4 style="padding-bottom: 10px">الصور الاضافية </h4>
                                                        @if (isset($advertisement->advertisementImage) && $advertisement->advertisementImage->count() > 0)
                                                            <div class="row">
                                                                @foreach ($advertisement->advertisementImage as $advertisement_image)
                                                                    @if (isset($advertisement_image->image) &&
                                                                        $advertisement_image->image &&
                                                                        file_exists($advertisement_image->image))
                                                                        <div class="col-md-4">
                                                                            <img src="{{ asset($advertisement_image->image) }}"
                                                                                class="img-thumbnail image-preview"
                                                                                alt="Topic Other Image"
                                                                                style="border:double 3px black; margin-bottom:5px; margin-top:5px;    height: 350px;
                                                                                width: 250px;">
                                                                            <a href="{{ route('super_admin.advertisements-deleteImages', $advertisement_image->id) }}"
                                                                                class="confirm btn btn-danger btn-sm"><i
                                                                                    class="fa fa-trash"></i>
                                                                                Delete
                                                                                image</a>
                                                                        </div>
                                                                    @else
                                                                        <div class="col-md-4">
                                                                            <img src="{{ asset('front_end_style/images/default.png') }}"
                                                                                class="img-thumbnail image-preview"
                                                                                alt="Topic Other Image"
                                                                                style="border:double 3px black; margin-bottom:5px; margin-top:5px;    height: 350px;
                                                                                width: 250px;">
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        @else
                                                            <h3 style="color:red;">No images uploaded</h3>
                                                        @endif
                                                    </th>
                                                <tr>
                                                    <th colspan="2" style="text-align: center">
                                                        <h4 style="padding-bottom: 10px">فيديو </h4>
                                                        @if (isset($advertisement->video) &&
                                                            $advertisement->getRawOriginal('video') &&
                                                            file_exists($advertisement->getRawOriginal('video')))
                                                            <video width="320" height="240" controls>
                                                                <source src="{{ URL::asset($advertisement->video) }}"
                                                                    type="video/mp4">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        @else
                                                            لا يوجد فيديو
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
