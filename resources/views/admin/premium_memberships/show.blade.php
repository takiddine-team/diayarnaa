@extends('admin.layouts.app')

{{-- @section('admin_css')
    <link href="{{ asset('resources/dashboard_files/assets/plugins/data-tables/datatables.bootstrap4.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('resources/dashboard_files/assets/css/sleek.min.css') }}">
@endsection --}}

@section('content')

    {{-- ============================================== --}}
    {{-- ================== Header ==================== --}}
    {{-- ============================================== --}}
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1><i class="mdi mdi-account-multiple"></i> تفاصيل العضوية</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('super_admin.dashboard') }}">
                            <i class="mdi  mdi-home"></i> لوحه التحكم
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('super_admin.premiumMemberships-index') }}">
                            <i class="mdi  mdi-account-multiple"></i> العضويات المميزة
                        </a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page"><i class="mdi  mdi-account-multiple"></i> تفاصيل العضوية
                    </li>
                </ol>
            </nav>
        </div>

    </div>

    <div class="bg-white border rounded">
        <div class="row no-gutters">

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



            {{-- ================================================================================================= --}}
            {{-- ========================================== Right Section ========================================= --}}
            {{-- ================================================================================================= --}}
            <div class="col-md-12">
                <div class="profile-content-right py-5">


                    {{-- ================================================================================================= --}}
                    {{-- ===================================== Tabs Bodies Section ======================================= --}}
                    {{-- ================================================================================================= --}}
                    <div class="tab-content px-3 px-xl-5" id="myTabContent">

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

                        {{-- ============================================================================== --}}
                        {{-- =========================== MemberShip Info Tab Body ============================ --}}
                        {{-- ============================================================================== --}}
                        <div class="tab-pane fade show active" id="tab_1" role="tabpanel"
                            aria-labelledby="timeline-tab">




                            {{-- ================================================= --}}
                            {{-- =========== Main MemberShip Information ============ --}}
                            {{-- ================================================= --}}
                            <div class="media mt-3 profile-timeline-media">
                                <div class="media-body">
                                    <h3 class="py-3 text-dark"><i class="mdi mdi-information"></i> المعلومات الرئيسية
                                        :</h3>
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>


                                                <th> الحالة : <span style="color:blue;">{!! isset($membership->status) ? $membership->status : "<span style='color:blue;'>--------</span>" !!}</span></th>

                                                <th>نوع المستخدم : <span style="color:blue;">{!! isset($membership->user_type) ? $membership->user_type : "<span style='color:blue;'>--------</span>" !!}</span>
                                                </th>
                                            </tr>
                                            <tr>

                                                <th>الإسم بالإنجليزي : <span
                                                        style="color:blue;">{!! isset($membership->name_en) ? $membership->name_en : "<span style='color:blue;'>--------</span>" !!}</span></th>

                                                <th>الاسم بالعربي : <span style="color:blue;">{!! isset($membership->name_ar) ? $membership->name_ar : "<span style='color:blue;'>--------</span>" !!}</span>
                                                </th>
                                            </tr>


                                            <tr>

                                                <th>السعر : <span style="color:blue;">{!! isset($membership->price) ? $membership->price : "<span style='color:blue;'>--------</span>" !!}</span></th>

                                                <th> عدد الايام : <span style="color:blue;">{!! isset($membership->number_of_ads)
                                                    ? $membership->number_of_ads
                                                    : "<span style='color:blue;'>غير محدود</span>" !!}</span>
                                                </th>
                                            </tr>


                                            <tr>

                                                <th>مدة الاعلان : <span style="color:blue;">{!! isset($membership->number_days_ad)
                                                    ? $membership->number_days_ad
                                                    : "<span style='color:blue;'>--------</span>" !!}</span>
                                                </th>
                                                <th>عدد ايام العضوية : <span
                                                        style="color:blue;">{!! isset($membership->number_days_membership)
                                                            ? $membership->number_days_membership
                                                            : "<span style='color:blue;'>--------</span>" !!}</span></th>

                                            </tr>


                                            <tr>
                                                <th> عضوية مميزة : <span style="color:blue;">{!! isset($membership->featured_type) ? $membership->featured_type : "<span style='color:blue;'>--------</span>" !!}</span>
                                                </th>
                                                <th> اعلانات غير محدودة : <span
                                                        style="color:blue;">{!! isset($membership->unlimited_status)
                                                            ? $membership->unlimited_status
                                                            : "<span style='color:blue;'>--------</span>" !!}</span></th>
                                            </tr>

                                        </thead>
                                    </table>
                                    {{-- ================================================= --}}
                                    {{-- ============== MemberShip Description One ============== --}}
                                    {{-- ================================================= --}}
                                    <h3 class="py-3 text-dark"><i class="mdi mdi-information"></i>الوصف بالعربي:</h3>
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th><span style="color:blue;">{!! isset($membership->description_ar)
                                                    ? $membership->description_ar
                                                    : "<span style='color:blue;'>--------</span>" !!}</th>
                                            </tr>

                                        </thead>
                                    </table>
                                    <h3 class="py-3 text-dark"><i class="mdi mdi-information"></i>الوصف بالانجليزي:</h3>
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th><span style="color:blue;">{!! isset($membership->description_en)
                                                    ? $membership->description_en
                                                    : "<span style='color:blue;'>--------</span>" !!}</th>
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
    <script>
        jQuery(document).ready(function() {
            jQuery('#hoverable-data-table_1').DataTable({
                "aLengthMenu": [
                    [20, 30, 50, 75, -1],
                    [20, 30, 50, 75, "All"]
                ],
                "pageLength": 20,
                "dom": '<"row justify-content-between top-information"lf>rt<"row justify-content-between bottom-information"ip><"clear">',
                "order": [
                    [2, "desc"]
                ]
            });
            jQuery('#hoverable-data-table_2').DataTable({
                "aLengthMenu": [
                    [20, 30, 50, 75, -1],
                    [20, 30, 50, 75, "All"]
                ],
                "pageLength": 20,
                "dom": '<"row justify-content-between top-information"lf>rt<"row justify-content-between bottom-information"ip><"clear">',
                "order": [
                    [2, "desc"]
                ]
            });
        });
    </script>
    <script src="{{ asset('dashboard_files/assets/plugins/data-tables/jquery.datatables.min.js') }}"></script>
    <script src="{{ asset('dashboard_files/assets/plugins/data-tables/datatables.bootstrap4.min.js') }}"></script>
@endsection
