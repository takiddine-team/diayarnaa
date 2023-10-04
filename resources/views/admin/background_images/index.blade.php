@extends('admin.layouts.app')

@section('admin_css')
    {{-- <link href="{{ asset('dashboard_files/assets/plugins/data-tables/datatables.bootstrap4.min.css') }}"
        rel="stylesheet"> --}}
    {{-- <link href="{{ asset('dashboard_files/assets/css/sleek.min.css') }}"> --}}
    {{-- <link href="{{ asset('dashboard_files/assets/css/sleek.css') }}"> --}}
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content">
            {{-- =========================================================== --}}
            {{-- ====================== Sweet Alert ======================== --}}
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
                    <h1> صور ترويسة الصفحات </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحة التحكم
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <i class="fas fa-users-cog"></i> صور ترويسة الصفحات
                            </li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="{{ route('super_admin.background_images-edit', isset($background_image->id) ? $background_image->id : -1) }}"
                        class="mb-1 btn btn-primary"><i class="mdi mdi-playlist-edit"></i> تعديل </a>
                </div>
            </div>
            {{-- ============================================== --}}
            {{-- =================== Body ===================== --}}
            {{-- ============================================== --}}



            {{-- صفحة وساطة الموقع --}}
            <div class="card card-default">
                <div class="card-header card-header-border-bottom" style="background-color: #4c84ff"></div>




                {{-- صفحة وساطة الموقع   --}}
                <div class="card-body" style="text-align: center">
                    <h4>صفحة وساطة الموقع :</h4>
                    <hr>
                    @if (isset($background_image->website_broker) &&
                            $background_image->getRawOriginal('website_broker') &&
                            file_exists($background_image->getRawOriginal('website_broker')))
                        <img src="{{ asset($background_image->getRawOriginal('website_broker')) }}"
                            style="border-radius: 10px; border:solid 1px black;width: 250px;
                        height: 200px;">
                    @else
                        <img src="{{ asset('images_default/default.png') }}"
                            style="border-radius: 10px; border:solid 2px black;width: 250px;
                            height: 200px;">
                    @endif

                </div>


            </div>

            {{-- صفحة شكاوى --}}
            <div class="card card-default">
                <div class="card-header card-header-border-bottom" style="background-color: #4c84ff"></div>




                {{-- صفحة شكاوى  --}}
                <div class="card-body" style="text-align: center">
                    <h4>صفحة شكاوى :</h4>
                    <hr>
                    @if (isset($background_image->complaint) &&
                            $background_image->getRawOriginal('complaint') &&
                            file_exists($background_image->getRawOriginal('complaint')))
                        <img src="{{ asset($background_image->getRawOriginal('complaint')) }}"
                            style="border-radius: 10px; border:solid 1px black;width: 250px;
                        height: 200px;">
                    @else
                        <img src="{{ asset('images_default/default.png') }}"
                            style="border-radius: 10px; border:solid 2px black;width: 250px;
                            height: 200px;">
                    @endif

                </div>


            </div>

            {{-- صفحة الوظائف --}}
            <div class="card card-default">
                <div class="card-header card-header-border-bottom" style="background-color: #4c84ff"></div>




                {{--  صفحة الوظائف --}}
                <div class="card-body" style="text-align: center">
                    <h4> صفحة الوظائف :</h4>
                    <hr>
                    @if (isset($background_image->job) &&
                            $background_image->getRawOriginal('job') &&
                            file_exists($background_image->getRawOriginal('job')))
                        <img src="{{ asset($background_image->getRawOriginal('job')) }}"
                            style="border-radius: 10px; border:solid 1px black;width: 250px;
                        height: 200px;">
                    @else
                        <img src="{{ asset('images_default/default.png') }}"
                            style="border-radius: 10px; border:solid 2px black;width: 250px;
                            height: 200px;">
                    @endif

                </div>


            </div>

            {{-- صفحة  الاحكام والشروط --}}
            <div class="card card-default">
                <div class="card-header card-header-border-bottom" style="background-color: #4c84ff"></div>




                {{-- صفحة  الاحكام والشروط   --}}
                <div class="card-body" style="text-align: center">
                    <h4> صفحة الاحكام والشروط :</h4>
                    <hr>
                    @if (isset($background_image->term_condition) &&
                            $background_image->getRawOriginal('term_condition') &&
                            file_exists($background_image->getRawOriginal('term_condition')))
                        <img src="{{ asset($background_image->getRawOriginal('term_condition')) }}"
                            style="border-radius: 10px; border:solid 1px black;width: 250px;
                        height: 200px;">
                    @else
                        <img src="{{ asset('images_default/default.png') }}"
                            style="border-radius: 10px; border:solid 2px black;width: 250px;
                            height: 200px;">
                    @endif

                </div>


            </div>

            {{--  صفحة سياسة الخصوصية --}}
            <div class="card card-default">
                <div class="card-header card-header-border-bottom" style="background-color: #4c84ff"></div>




                {{-- صفحة سياسة الخصوصية  --}}
                <div class="card-body" style="text-align: center">
                    <h4>صفحة سياسة الخصوصية :</h4>
                    <hr>
                    @if (isset($background_image->privacy_policy) &&
                            $background_image->getRawOriginal('privacy_policy') &&
                            file_exists($background_image->getRawOriginal('privacy_policy')))
                        <img src="{{ asset($background_image->getRawOriginal('privacy_policy')) }}"
                            style="border-radius: 10px; border:solid 1px black;width: 250px;
                        height: 200px;">
                    @else
                        <img src="{{ asset('images_default/default.png') }}"
                            style="border-radius: 10px; border:solid 2px black;width: 250px;
                            height: 200px;">
                    @endif

                </div>


            </div>

            {{-- صفحة تفاصيل العقار --}}
            <div class="card card-default">
                <div class="card-header card-header-border-bottom" style="background-color: #4c84ff"></div>




                {{-- صفحة تفاصيل العقار   --}}
                <div class="card-body" style="text-align: center">
                    <h4> صفحة تفاصيل العقار :</h4>
                    <hr>
                    @if (isset($background_image->advertisement_details) &&
                            $background_image->getRawOriginal('advertisement_details') &&
                            file_exists($background_image->getRawOriginal('advertisement_details')))
                        <img src="{{ asset($background_image->getRawOriginal('advertisement_details')) }}"
                            style="border-radius: 10px; border:solid 1px black;width: 250px;
                        height: 200px;">
                    @else
                        <img src="{{ asset('images_default/default.png') }}"
                            style="border-radius: 10px; border:solid 2px black;width: 250px;
                            height: 200px;">
                    @endif

                </div>


            </div>
            {{-- صفحة حساب المستخدم  --}}
            <div class="card card-default">
                <div class="card-header card-header-border-bottom" style="background-color: #4c84ff"></div>




                {{--  صفحة حساب المستخدم   --}}
                <div class="card-body" style="text-align: center">
                    <h4> صفحة حساب المستخدم :</h4>
                    <hr>
                    @if (isset($background_image->user_dashboard) &&
                            $background_image->getRawOriginal('user_dashboard') &&
                            file_exists($background_image->getRawOriginal('user_dashboard')))
                        <img src="{{ asset($background_image->getRawOriginal('user_dashboard')) }}"
                            style="border-radius: 10px; border:solid 1px black;width: 250px;
                        height: 200px;">
                    @else
                        <img src="{{ asset('images_default/default.png') }}"
                            style="border-radius: 10px; border:solid 2px black;width: 250px;
                            height: 200px;">
                    @endif

                </div>


            </div>


            {{-- صفحة إنشاء حساب --}}
            <div class="card card-default">
                <div class="card-header card-header-border-bottom" style="background-color: #4c84ff"></div>




                {{-- صفحة إنشاء حساب   --}}
                <div class="card-body" style="text-align: center">
                    <h4> صفحة إنشاء حساب :</h4>
                    <hr>
                    @if (isset($background_image->user_signup) &&
                            $background_image->getRawOriginal('user_signup') &&
                            file_exists($background_image->getRawOriginal('user_signup')))
                        <img src="{{ asset($background_image->getRawOriginal('user_signup')) }}"
                            style="border-radius: 10px; border:solid 1px black;width: 250px;
                        height: 200px;">
                    @else
                        <img src="{{ asset('images_default/default.png') }}"
                            style="border-radius: 10px; border:solid 2px black;width: 250px;
                            height: 200px;">
                    @endif

                </div>


            </div>

            {{-- صفحة تسجيل الدخول --}}
            <div class="card card-default">
                <div class="card-header card-header-border-bottom" style="background-color: #4c84ff"></div>




                {{-- صفحة تسجيل الدخول  --}}
                <div class="card-body" style="text-align: center">
                    <h4> صفحة تسجيل الدخول :</h4>
                    <hr>
                    @if (isset($background_image->user_login) &&
                            $background_image->getRawOriginal('user_login') &&
                            file_exists($background_image->getRawOriginal('user_login')))
                        <img src="{{ asset($background_image->getRawOriginal('user_login')) }}"
                            style="border-radius: 10px; border:solid 1px black;width: 250px;
                        height: 200px;">
                    @else
                        <img src="{{ asset('images_default/default.png') }}"
                            style="border-radius: 10px; border:solid 2px black;width: 250px;
                            height: 200px;">
                    @endif
                </div>
            </div>




            {{-- قسم اراء العملاء  --}}
            <div class="card card-default">
                <div class="card-header card-header-border-bottom" style="background-color: #4c84ff"></div>




                {{-- قسم اراء العملاء  --}}
                <div class="card-body" style="text-align: center">
                    <h4> قسم اراء العملاء :</h4>
                    <hr>
                    @if (isset($background_image->customer_opinion) &&
                            $background_image->getRawOriginal('customer_opinion') &&
                            file_exists($background_image->getRawOriginal('customer_opinion')))
                        <img src="{{ asset($background_image->getRawOriginal('customer_opinion')) }}"
                            style="border-radius: 10px; border:solid 1px black;width: 250px;
                        height: 200px;">
                    @else
                        <img src="{{ asset('images_default/default.png') }}"
                            style="border-radius: 10px; border:solid 2px black;width: 250px;
                            height: 200px;">
                    @endif

                </div>

            </div>
        @endsection

        @section('admin_javascript')
            <script>
                jQuery(document).ready(function() {
                    jQuery('#hoverable-data-table').DataTable({
                        "aLengthMenu": [
                            [20, 30, 50, 75, -1],
                            [20, 30, 50, 75, "All"],
                        ],
                        "pageLength": 20,
                        "dom": '<"row justify-content-between top-information"lf>rt<"row justify-content-between bottom-information"ip><"clear">',
                        "order": [
                            [3, "desc"]
                        ]
                    });
                });
            </script>
            <script src="{{ asset('style_files/backend/plugins/data-tables/jquery.datatables.min.js') }}"></script>
            <script src="{{ asset('style_files/backend/plugins/data-tables/datatables.bootstrap4.min.js') }}"></script>
        @endsection
