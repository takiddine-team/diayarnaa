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
                    <h1>من نحن </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحة القيادة
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <i class="fas fa-users-cog"></i> من نحن
                            </li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="{{ route('super_admin.abouts-edit', isset($about->id) ? $about->id : -1) }}"
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
                    <h4>وصف من نحن بالإنجليزي : </h4>
                    <hr>
                    <p style="color: black">
                        {!! isset($about->about_description_en) ? $about->about_description_en : '----------' !!}</p>
                    </hr>
                </div>
                <div class="card-body">
                    <h4>وصف من نحن بالعربي : </h4>
                    <hr>
                    <p style="color: black">

                        {!! isset($about->about_description_ar) ? $about->about_description_ar : '----------' !!}
                    </p>
                    </hr>

                </div>
                <div class="card-body">
                    <h4>صورة من نحن: </h4>
                    <hr>

                    @if (isset($about->about_image) &&
                        $about->getRawOriginal('about_image') &&
                        file_exists($about->getRawOriginal('about_image')))
                        <img src="{{ asset($about->getRawOriginal('about_image')) }}" width="70" height="70"
                            style="border-radius: 10px; border:solid 1px black;">
                    @else
                        <img src="{{ asset('images_default/default.png') }}" width="70" height="70"
                            style="border-radius: 10px; border:solid 2px black;">
                    @endif



                </div>
            </div>

            {{-- رساالتنا --}}
            <div class="card card-default">
                <div class="card-header card-header-border-bottom" style="background-color: #4c84ff"></div>
                <div class="card-body">
                    <h4>رسالتنا بالإنجليزي :</h4>
                    <hr>
                    <p style="color: black">{!! isset($about->our_message_en) ? $about->our_message_en : '----------' !!}</p>
                    </hr>

                </div>
                <div class="card-body">
                    <h4>رسالتنا بالعربي :</h4>
                    <hr>
                    <p style="color: black">{!! isset($about->our_message_ar) ? $about->our_message_ar : '----------' !!}</p>
                    </hr>

                </div>
                <div class="card-body">
                    <h4> صورة رساالتنا:</h4>
                    <hr>
                    @if (isset($about->our_message_image) &&
                        $about->getRawOriginal('our_message_image') &&
                        file_exists($about->getRawOriginal('our_message_image')))
                        <img src="{{ asset($about->getRawOriginal('our_message_image')) }}" width="70" height="70"
                            style="border-radius: 10px; border:solid 1px black;">
                    @else
                        <img src="{{ asset('images_default/default.png') }}" width="70" height="70"
                            style="border-radius: 10px; border:solid 2px black;">
                    @endif


                    </hr>

                </div>
            </div>


            {{-- رؤيتنا --}}
            <div class="card card-default">
                <div class="card-header card-header-border-bottom" style="background-color: #4c84ff"></div>
                <div class="card-body">
                    <h4>رؤيتنا بالإنجليزي :</h4>
                    <hr>
                    <p style="color: black">{!! isset($about->our_vission_en) ? $about->our_vission_en : '----------' !!}</p>
                    </hr>

                </div>
                <div class="card-body">
                    <h4>رؤيتنا بالعربي :</h4>
                    <hr>
                    <p style="color: black">{!! isset($about->our_vission_ar) ? $about->our_vission_ar : '----------' !!}</p>
                    </hr>

                </div>
                <div class="card-body">
                    <h4> صورة رؤيتنا:</h4>
                    <hr>
                    @if (isset($about->our_vission_image) &&
                        $about->getRawOriginal('our_vission_image') &&
                        file_exists($about->getRawOriginal('our_vission_image')))
                        <img src="{{ asset($about->getRawOriginal('our_vission_image')) }}" width="70" height="70"
                            style="border-radius: 10px; border:solid 1px black;">
                    @else
                        <img src="{{ asset('images_default/default.png') }}" width="70" height="70"
                            style="border-radius: 10px; border:solid 2px black;">
                    @endif


                    </hr>

                </div>
            </div>

            {{-- قيمنا --}}
            <div class="card card-default">
                <div class="card-header card-header-border-bottom" style="background-color: #4c84ff"></div>

                {{-- قيمنا بالانجليزي --}}
                <div class="card-body">
                    <h4>قيمنا بالانجليزي :</h4>
                    <hr>
                    <p style="color: black">{!! isset($about->our_value_en) ? $about->our_value_en : '----------' !!}</p>
                </div>

                {{-- قيمنا بالعربي --}}
                <div class="card-body">
                    <h4>قيمنا بالعربي :</h4>
                    <hr>
                    <p style="color: black">{!! isset($about->our_value_ar) ? $about->our_value_ar : '----------' !!}</p>
                </div>

                {{--  صورة قيمنا --}}
                <div class="card-body">
                    <h4> صورة قيمنا :</h4>
                    <hr>
                    @if (isset($about->our_value_image) &&
                        $about->getRawOriginal('our_value_image') &&
                        file_exists($about->getRawOriginal('our_value_image')))
                        <img src="{{ asset($about->getRawOriginal('our_value_image')) }}" width="70" height="70"
                            style="border-radius: 10px; border:solid 1px black;">
                    @else
                        <img src="{{ asset('images_default/default.png') }}" width="70" height="70"
                            style="border-radius: 10px; border:solid 2px black;">
                    @endif

                </div>



            </div>


            {{--  صورة خلفية من نحن  --}}
            <div class="card card-default">
                <div class="card-header card-header-border-bottom" style="background-color: #4c84ff"></div>



                {{--  صورة خلفية من نحن --}}
                <div class="card-body" style="text-align: center">
                    <h4> صورة خلفية من نحن :</h4>
                    <hr>
                    @if (isset($about->background_aboutus_image) &&
                        $about->getRawOriginal('background_aboutus_image') &&
                        file_exists($about->getRawOriginal('background_aboutus_image')))
                        <img src="{{ asset($about->getRawOriginal('background_aboutus_image')) }}" style="border-radius: 10px; border:solid 1px black;width: 250px;
                        height: 200px;">
                    @else
                        <img src="{{ asset('images_default/default.png') }}" 
                            style="border-radius: 10px; border:solid 2px black;width: 250px;
                            height: 200px;">
                    @endif

                </div>



            </div>




            {{-- صورة خلفية عن الشركة  --}}
            <div class="card card-default">
                <div class="card-header card-header-border-bottom" style="background-color: #4c84ff"></div>




                {{--  صورة خلفية عن الشركة --}}
                <div class="card-body" style="text-align: center">
                    <h4> صورة خلفية عن الشركة :</h4>
                    <hr>
                    @if (isset($about->background_company_image) &&
                        $about->getRawOriginal('background_company_image') &&
                        file_exists($about->getRawOriginal('background_company_image')))
                        <img src="{{ asset($about->getRawOriginal('background_company_image')) }}" style="border-radius: 10px; border:solid 1px black;width: 250px;
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
