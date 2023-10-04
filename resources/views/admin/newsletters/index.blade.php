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
                    <h1>جميع المتابعين</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> Dashboard
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                <i class="fas fa-users-cog"></i> جميع المتابعين
                            </li>
                        </ol>
                    </nav>
                </div>
                <div>

                    <div>
                        <a href="{{ route('super_admin.newsletters-newsletterForm') }}" class="mb-1 btn btn-primary"><i
                                class="mdi mdi-playlist-plus"></i> ارسال نشرة اخبار </a>


                    </div>

                </div>
            </div>
            {{-- ============================================== --}}
            {{-- =================== Body ===================== --}}
            {{-- ============================================== --}}
            <div class="card card-default">
                <div class="card-header justify-content-between " style="background-color: #4c84ff;"></div>
                <div class="card-body">
                    <table id="hoverable-data-table" class="table table-hover table-striped">
                        <thead>
                            <tr>

                                <th style="text-align: center"><i class="mdi mdi-format-title"></i> البريدي الالكتروني </th>
                                <th style="text-align: center"><i class="mdi mdi-format-title"></i>  الحالة </th>
                                <th style="text-align: center"><i class="mdi mdi-clock-outline mdi-spin"></i> التاريخ /اليوم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($subscribers) && $subscribers->count() > 0)
                                @foreach ($subscribers as $subscriber)
                                    <tr>
                                        <td style="text-align: center">{!! isset($subscriber->email) ? $subscriber->email : "<span style='color:blue;'>----------</span>" !!} </td>


                                        <td style="text-align: center">
                                            @if ($subscriber->is_verified == 'Verified')
                            
                                                <span style="color: green">({{ @trans("front.Verified")}})</span>
                                            @else
                                                <span style="color: red">({{ @trans("front.NotVerified")}})</span>
                                            @endif
                                        </td>

                                        <td style="text-align: center">
                                            {!! isset($subscriber->created_at) ? $subscriber->created_at : "<span style='color:red;'>Undefined</span>" !!}
                                        </td>

                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
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
