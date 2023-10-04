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
            <h1><i class="mdi mdi-information"></i> البريد الصادر</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('super_admin.dashboard') }}">
                            <i class="mdi mdi-home"></i> لوحه التحكم
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('super_admin.internal_mails-outgoing') }}">
                            <i class="mdi mdi-format-list-bulleted"></i> البريد الصادر
                        </a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page"><i class="mdi mdi-information"></i> تفاصيل البريد
                    </li>
                </ol>
            </nav>
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
                                {{-- ============== Main Information ============== --}}
                                {{-- ============================================== --}}
                                <div class="media mt-3 profile-timeline-media col--12">
                                    <div class="media-body">
                                        <h3 class="py-3 text-dark"><i class="mdi mdi-information"></i> تفاصيل البريد :
                                        </h3>
                                        <table id="hoverable-data-table" class="table table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>الاسم : <span style="color:blue;">
                                                            {!! isset($mail->userReceiver->name) ? $mail->userReceiver->name : '<span style="color:blue;">----------</span>' !!}
                                                        </span> </th>
                                                    <th>
                                                        الايميل : <span style="color:blue;">
                                                            {!! isset($mail->userReceiver->email) ? $mail->userReceiver->email : '<span style="color:blue;">----------</span>' !!}
                                                        </span>
                                                    </th>
                                                    <th>
                                                        المرفق : <span style="color:blue;">
                                                            @if (isset($mail->file) && $mail->getRawOriginal('file') && file_exists($mail->getRawOriginal('file')))
                                                            <a href="{{ asset($mail->file) }}" target="_blank">ملف <i
                                                                    class="mdi mdi-eye"></i></a>
                                                        @else
                                                            <span style="color:blue;">لا يوجد ملف</span>
                                                        @endif
                                                        </span>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th colspan="3">
                                                        <div
                                                            style="border:solid 1px black; border-radius:10px; padding:10px;">
                                                            الرسالة : <br>
                                                            <hr>
                                                            <span style="color:blue;">{!! isset($mail->details) ? $mail->details : "<span class='mainColor'>----------</span>" !!}</span>
                                                        </div>
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
