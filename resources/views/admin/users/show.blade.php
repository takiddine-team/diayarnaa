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
            <h1><i class="mdi mdi-information"></i> معلومات المستخدم</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('super_admin.dashboard') }}">
                            <i class="mdi mdi-home"></i> لوحه التحكم
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('super_admin.users-index') }}">
                            <i class="mdi mdi-format-list-bulleted"></i> المستخدمين
                        </a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page"><i class="mdi mdi-information"></i> معلومات المستخدم
                    </li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('super_admin.users-edit', [isset($user->id) ? $user->id : 'Undefined']) }}"
                class="mb-1 btn btn-primary" title="Edit"><i class="mdi mdi-playlist-edit"></i></i> تعديل </a>

            @if (isset($user->status) && $user->status == 'Pending')
                <a href="{{ route('super_admin.users-reject', [isset($user->id) ? $user->id : -1]) }}"
                    class=" mb-1 btn btn-danger" title=" Reject"><i class="fas fa-ban"></i> رفض </a>
                <a href="{{ route('super_admin.users-accept', [isset($user->id) ? $user->id : -1]) }}"
                    class=" mb-1 btn  btn-success" title="Accept"><i class="fas fa-check-circle"></i> قبول </a>
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
                                aria-controls="tab_1" aria-selected="true"><i class="mdi mdi-information"></i> المعلومات الرئيسية</a>
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
                                                            {!! isset($user->code) ? $user->code : '<span style="color:blue;">----------</span>' !!}
                                                        </span> </th>
                                                    <th>

                                                    </th>
                                                </tr>

                                                <tr>
                                                    <th>الاسم : <span style="color:blue;">
                                                            {!! isset($user->name) ? $user->name : '<span style="color:blue;">----------</span>' !!}
                                                        </span> </th>
                                                        
                                                    <th>
                                                       @if( isset($user->user_type) && $user->user_type != 'Real Estate Office')
                                                        الاسم الاخير : <span style="color:blue;">
                                                            {!! isset($user->last_name) ? $user->last_name : '<span style="color:blue;">----------</span>' !!}
                                                        </span>
                                                        @endif
                                                    </th>
                                                </tr>



                                                <tr>
                                                    <th>الايميل: <span style="color:blue;">{!! isset($user->email) ? $user->email : '<span style="color:blue;">----------</span>' !!}</span>
                                                    <th>رقم الهاتف : <span
                                                            style="color:blue;">{!! isset($user->phone) ? $user->phone : '<span style="color:blue;">----------</span>' !!}</span>
                                                    </th>

                                                </tr>

                                                <tr>
                                                    <th>الدولة : <span style="color:blue;">{!! isset($user->diyarnaCountry->name_ar)
                                                        ? $user->diyarnaCountry->name_ar
                                                        : '<span style="color:blue;">----------</span>' !!}</span>
                                                    <th>المدينة : <span style="color:blue;">{!! isset($user->diyarnaCity->name_ar)
                                                        ? $user->diyarnaCity->name_ar
                                                        : '<span style="color:blue;">----------</span>' !!}</span>

                                                </tr>
                                                <tr>
                                                    <th>المنطقة : <span style="color:blue;">{!! isset($user->diyarnaRegion->name_ar)
                                                        ? $user->diyarnaRegion->name_ar
                                                        : '<span style="color:blue;">----------</span>' !!}</span>
                                                    </th>

                                                    <th>الحالة : <span style="color:blue;">{!! isset($user->status) ? $user->status : '<span style="color:blue;">----------</span>' !!}</span>
                                                    </th>



                                                </tr>
                                                <tr>
                                                    <th>الشارع : <span style="color:blue;">{!! isset($user->street) ? $user->street : '<span style="color:blue;">----------</span>' !!}</span>
                                                    </th>

                                                    <th><i class="mdi mdi-clock-outline mdi-spin"></i> تاريخ الاضافة : <span
                                                            style="color:blue;">{!! isset($user->created_at)
                                                                ? date('Y / F (m) / d', strtotime($user->created_at))
                                                                : '<span style="color:blue;">----------</span>' !!}</span></th>
                                                </tr>
                                                @if (isset($user->user_type) && $user->user_type == 'Real Estate Office')
                                                    <tr>


                                                        <th>هاتف المكتب : <span
                                                                style="color:blue;">{!! isset($user->office_phone) ? $user->office_phone : '<span style="color:blue;">----------</span>' !!}</span>
                                                        </th>
                                                        <th>صلاحية الحساب : <span
                                                                style="color:blue;">{!! isset($user->expire_date) ? $user->expire_date : '<span style="color:blue;">----------</span>' !!}</span>
                                                        </th>

                                                    </tr>
                                                @endif


                                                <tr>
                                                    <th colspan="2">
                                                        <div
                                                            style="border:solid 1px black; border-radius:10px; padding:10px;">
                                                            معلومات اضافية : <br>
                                                            <hr>
                                                            <span style="color:blue;">{!! isset($user->additional_information)
                                                                ? $user->additional_information
                                                                : "<span class='mainColor'>----------</span>" !!}</span>
                                                        </div>
                                                    </th>

                                                </tr>

                                                <tr>
                                                    <th colspan="2" style="text-align: center">
                                                        <h4 style="padding-bottom: 10px">صوره الملف الشخصي</h4>
                                                        @if (isset($user->profile_image) &&
                                                            $user->getRawOriginal('profile_image') &&
                                                            file_exists($user->getRawOriginal('profile_image')))
                                                            <img src="{{ asset($user->profile_image) }}"
                                                                style="border-radius: 10px; border:solid 1px black;width: 300px;
                                                                height: 200px;">
                                                        @else
                                                            <img src="{{ asset('images_default/default.png') }}"
                                                                style="border-radius: 10px; border:solid 2px black; width: 300px; height: 200px;">
                                                        @endif
                                                    </th>

                                                </tr>

                                                @if (isset($user->user_type) && $user->user_type == 'Real Estate Office')
                                                    <tr>
                                                        <th colspan="2" style="text-align: center">
                                                            <h4 style="padding-bottom: 10px">صوره الترخيص التجاري</h4>
                                                            @if (isset($user->license_image) &&
                                                                $user->getRawOriginal('license_image') &&
                                                                file_exists($user->getRawOriginal('license_image')))
                                                                <img src="{{ asset($user->license_image) }}"
                                                                    style="border-radius: 10px; border:solid 1px black; width: 300px; height: 200px;">
                                                            @else
                                                                <img src="{{ asset('images_default/default.png') }}"
                                                                    style="border-radius: 10px; border:solid 2px black; width: 300px; height: 200px;">
                                                            @endif
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
