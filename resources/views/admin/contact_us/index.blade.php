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
                    <h1>اتصل بنا</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحه التحكم
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <i class="fas fa-users-cog"></i> اتصل بنا
                            </li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="{{ route('super_admin.contact_us-edit', isset($contact->id) ? $contact->id : -1) }}"
                        class="mb-1 btn btn-primary"><i class="mdi mdi-playlist-edit"></i> تعديل </a>
                </div>
            </div>
            {{-- ============================================== --}}
            {{-- =================== Body ===================== --}}
            {{-- ============================================== --}}

            {{-- Phone --}}
            <div class="card card-default">
                <div class="card-header card-header-border-bottom" style="background-color: #4c84ff"></div>
                <div class="card-body">
                    <h4>رقم الهاتف : </h4>
                    <hr>
                    <p style="color: black">
                        {!! isset($contact->phone) ? $contact->phone : '----------' !!}</p>
                    </hr>
                </div>

            </div>


             {{-- Phone Two --}}
            <div class="card card-default">
                <div class="card-header card-header-border-bottom" style="background-color: #4c84ff"></div>
                <div class="card-body">
                    <h4>رقم هاتف فرعي : </h4>
                    <hr>
                    <p style="color: black">
                        {!! isset($contact->phone_two) ? $contact->phone_two : '----------' !!}</p>
                    </hr>
                </div>

            </div>
            {{-- Email --}}
            <div class="card card-default">
                <div class="card-header card-header-border-bottom" style="background-color: #4c84ff"></div>
                <div class="card-body">
                    <h4>البريد الالكتروني : </h4>
                    <hr>
                    <p style="color: black">
                        {!! isset($contact->email) ? $contact->email : '----------' !!}</p>
                    </hr>
                </div>

            </div>


            {{-- Facebook --}}
            <div class="card card-default">
                <div class="card-header card-header-border-bottom" style="background-color: #4c84ff"></div>
                <div class="card-body">
                    <h4>فيسبوك : </h4>
                    <hr>
                    <p style="color: black">
                        {!! isset($contact->facebook) ? $contact->facebook : '----------' !!}</p>
                    </hr>
                </div>

            </div>


            {{-- Instagram --}}
            <div class="card card-default">
                <div class="card-header card-header-border-bottom" style="background-color: #4c84ff"></div>
                <div class="card-body">
                    <h4>انستاغرام : </h4>
                    <hr>
                    <p style="color: black">
                        {!! isset($contact->instagram) ? $contact->instagram : '----------' !!}</p>
                    </hr>
                </div>

            </div>

            {{-- Twitter --}}
            <div class="card card-default">
                <div class="card-header card-header-border-bottom" style="background-color: #4c84ff"></div>
                <div class="card-body">
                    <h4>تويتر : </h4>
                    <hr>
                    <p style="color: black">
                        {!! isset($contact->twitter) ? $contact->twitter : '----------' !!}</p>
                    </hr>
                </div>

            </div>

             {{-- Linked in --}}
            <div class="card card-default">
                <div class="card-header card-header-border-bottom" style="background-color: #4c84ff"></div>
                <div class="card-body">
                    <h4>لينكد إن: </h4>
                    <hr>
                    <p style="color: black">
                        {!! isset($contact->linkedin) ? $contact->linkedin : '----------' !!}</p>
                    </hr>
                </div>

            </div>
             {{-- Messanger --}}
            <div class="card card-default">
                <div class="card-header card-header-border-bottom" style="background-color: #4c84ff"></div>
                <div class="card-body">
                    <h4>ماسنجر : </h4>
                    <hr>
                    <p style="color: black">
                        {!! isset($contact->messanger) ? $contact->messanger : '----------' !!}</p>
                    <hr>
                </div>

            </div>
             {{-- youtube --}}
            <div class="card card-default">
                <div class="card-header card-header-border-bottom" style="background-color: #4c84ff"></div>
                <div class="card-body">
                    <h4>يوتيوب : </h4>
                    <hr>
                    <p style="color: black">
                        {!! isset($contact->youtube) ? $contact->youtube : '----------' !!}</p>
                    <hr>
                </div>

            </div>

             {{--  صورة خلفية اتصل بنا  --}}

              <div class="card card-default" style="text-align: center">
                <div class="card-header card-header-border-bottom" style="background-color: #4c84ff"></div>
                <div class="card-body">
                    <h4>صورة خلفية اتصل بنا  : </h4>
                    <hr>
                    @if (isset($contact->background_image) &&
                    $contact->getRawOriginal('background_image') &&
                    file_exists($contact->getRawOriginal('background_image')))
                    <img src="{{ asset($contact->getRawOriginal('background_image')) }}" 
                        style="border-radius: 10px; border:solid 1px black;width: 250px;
                        height: 200px;">
                @else
                    <img src="{{ asset('images_default/default.png') }}" 
                        style="border-radius: 10px; border:solid 2px black;width: 250px;
                        height: 200px;">
                @endif
                    <hr>
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
