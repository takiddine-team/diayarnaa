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
            <h1><i class="mdi mdi-information"></i> معلومات الوظيفه</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('super_admin.dashboard') }}">
                            <i class="mdi mdi-home"></i> لوحه التحكم
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('super_admin.job_requests-index') }}">
                            <i class="mdi mdi-format-list-bulleted"></i> طلبات التوظيف
                        </a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page"><i class="mdi mdi-information"></i> معلومات الوظيفه
                    </li>
                </ol>
            </nav>
        </div>
        <div>


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



                                                    <th>تاريخ التقديم : <span
                                                            style="color:blue;">{!! isset($job_request->created_at) ? $job_request->created_at : '<span style="color:blue;">----------</span>' !!}</span>
                                                    </th>



                                                </tr>


                                                <tr>
                                                    <th>العنوان بالعربي : <span style="color:blue;">
                                                            {!! isset($job_request->job->title_ar) ? $job_request->job->title_ar : '<span style="color:blue;">----------</span>' !!}
                                                        </span> </th>
                                                    <th>العنوان بالانجليزي : <span style="color:blue;">
                                                            {!! isset($job_request->job->title_en)
                                                                ? $job_request->job->title_en
                                                                : '<span style="color:blue;">----------</span>' !!}
                                                        </span> </th>

                                                </tr>
                                                <tr>
                                                    <th> الاسم الاول : <span style="color:blue;">
                                                            {!! isset($job_request->first_name) ? $job_request->first_name : '<span style="color:blue;">----------</span>' !!}
                                                        </span> </th>
                                                    <th> الاسم الثاني : <span style="color:blue;">
                                                            {!! isset($job_request->last_name) ? $job_request->last_name : '<span style="color:blue;">----------</span>' !!}
                                                        </span> </th>

                                                </tr>


                                                <tr>
                                                    <th> الايميل : <span style="color:blue;">
                                                            {!! isset($job_request->email) ? $job_request->email : '<span style="color:blue;">----------</span>' !!}
                                                        </span> </th>
                                                    <th> الهاتف : <span style="color:blue;">
                                                            {!! isset($job_request->phone) ? $job_request->phone : '<span style="color:blue;">----------</span>' !!}
                                                        </span> </th>

                                                </tr>







                                                @if (isset($job_request->file) &&
                                                    $job_request->getRawOriginal('file') &&
                                                    file_exists($job_request->getRawOriginal('file')))
                                                    <tr>

                                                        <th>
                                                            <span style="color:blue;">
                                                                <a href="{{ asset($job_request->file) }}" target="_blank"
                                                                    data-fancybox="gallery" style="padding-bottom: 10px">
                                                                    <i class="fas fa-file fa-2x"></i> <span
                                                                        style="color: #6598ca">عرض المرفق </span>

                                                                </a>
                                                            </span>
                                                        </th>

                                                        <th></th>
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
