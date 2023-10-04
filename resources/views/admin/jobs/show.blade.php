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
                        <a href="{{ route('super_admin.jobs-index') }}">
                            <i class="mdi mdi-format-list-bulleted"></i> الوظيفه
                        </a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page"><i class="mdi mdi-information"></i> معلومات الوظيفه
                    </li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('super_admin.jobs-edit', [isset($job->id) ? $job->id : 'Undefined']) }}"
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


                                                    <th>الحالة : <span style="color:blue;">{!! isset($job->status) ? $job->status : '<span style="color:blue;">----------</span>' !!}</span>
                                                    </th>
                                                    <th>تاريخ انتهاء التقديم : <span style="color:blue;">{!! isset($job->expiry_date) ? $job->expiry_date : '<span style="color:blue;">----------</span>' !!}</span>
                                                    </th>



                                                </tr>


                                                <tr>
                                                    <th>العنوان بالعربي : <span style="color:blue;">
                                                            {!! isset($job->title_ar) ? $job->title_ar : '<span style="color:blue;">----------</span>' !!}
                                                        </span> </th>
                                                    <th>العنوان بالانجليزي : <span style="color:blue;">
                                                            {!! isset($job->title_en) ? $job->title_en : '<span style="color:blue;">----------</span>' !!}
                                                        </span> </th>

                                                </tr>








                                                <tr>
                                                    <th colspan="2">
                                                        <div
                                                            style="border:solid 1px black; border-radius:10px; padding:10px;text-align: center">


                                                            <h3 style="text-align: center">
                                                                الوصف بالعربي
                                                            </h3>
                                                            <hr>

                                                            <span style="color:blue;">{!! isset($job->description_ar) ? $job->description_ar : "<span class='mainColor'>----------</span>" !!}</span>
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

                                                            <span style="color:blue;">{!! isset($job->description_en) ? $job->description_en : "<span class='mainColor'>----------</span>" !!}</span>
                                                        </div>
                                                    </th>

                                                </tr>



                                                @if (isset($job->image) && $job->getRawOriginal('image') && file_exists($job->getRawOriginal('image')))
                                                    <tr>
                                                        <th colspan="2" style="text-align: center">
                                                            <h4 style="padding-bottom: 10px">الصورة الرئيسية </h4>
                                                            @if (isset($job->image) && $job->getRawOriginal('image') && file_exists($job->getRawOriginal('image')))
                                                                <img src="{{ asset($job->image) }}"
                                                                    style="border-radius: 10px; border:solid 1px black;width: 300px;
                                                                height: 200px;">
                                                            @else
                                                                <img src="{{ asset('images_default/default.png') }}"
                                                                    style="border-radius: 10px; border:solid 2px black; width: 300px; height: 200px;">
                                                            @endif
                                                        </th>

                                                    </tr>
                                                @endif

                                                @if (isset($job->file) && $job->getRawOriginal('file') && file_exists($job->getRawOriginal('file')))
                                                    <tr>

                                                        <th>
                                                            <span style="color:blue;">
                                                                <a href="{{ asset($job->file) }}" target="_blank"
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
