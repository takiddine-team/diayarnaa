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
                    <h1> صفحة العضوية المميزة </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحة القيادة
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <i class="fas fa-users-cog"></i>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="{{ route('super_admin.premium_membership_pages-edit', isset($premium_membership_page->id) ? $premium_membership_page->id : -1) }}"
                        class="mb-1 btn btn-primary"><i class="mdi mdi-playlist-edit"></i> تعديل </a>
                </div>
            </div>
            {{-- ============================================== --}}
            {{-- =================== Body ===================== --}}
            {{-- ============================================== --}}

            {{-- About Description --}}
            <div class="card card-default">
                <div class="card-header card-header-border-bottom" style="background-color: #4c84ff"></div>
                <div class="card-body">
                    <h4>وصف بالإنجليزي : </h4>
                    <hr>
                    <p style="color: black">
                        {!! isset($premium_membership_page->description_en)
                            ? $premium_membership_page->description_en
                            : '----------' !!}</p>
                    </hr>
                </div>
                <div class="card-body">
                    <h4>وصف بالعربي : </h4>
                    <hr>
                    <p style="color: black">

                        {!! isset($premium_membership_page->description_ar)
                            ? $premium_membership_page->description_ar
                            : '----------' !!}
                    </p>
                    </hr>

                </div>
                <div class="card-body">
                    <h4>صورة خلفية العضوية المميزة: </h4>
                    <hr>

                    @if (isset($premium_membership_page->image) &&
                        $premium_membership_page->getRawOriginal('image') &&
                        file_exists($premium_membership_page->getRawOriginal('image')))
                        <img src="{{ asset($premium_membership_page->getRawOriginal('image')) }}" width="70"
                            height="70" style="border-radius: 10px; border:solid 1px black;">
                    @else
                        <img src="{{ asset('images_default/default.png') }}" width="70" height="70"
                            style="border-radius: 10px; border:solid 2px black;">
                    @endif



                </div>
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
