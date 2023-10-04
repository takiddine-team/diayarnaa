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
                    <h1>طلبات التعديل</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحه التحكم
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                <i class="fas fa-users-cog"></i> طلبات التعديل
                            </li>
                        </ol>
                    </nav>
                </div>
                <div>


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
                                <th style="text-align: center"><i class="mdi mdi-format-title"></i> اسم المستخدم</th>
                                <th style="text-align: center"><i class="mdi mdi-format-title"></i> كود الاعلان</th>
                                <th style="text-align: center"><i class="mdi mdi-format-title"></i> الحالة</th>
                                <th style="text-align: center"><i class="mdi mdi-clock-outline mdi-spin"></i> الوقت </th>
                                <th style="text-align: center"><i class="mdi mdi-settings mdi-spin"></i> التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($advertisement_edit_requests) && $advertisement_edit_requests->count() > 0)
                                @foreach ($advertisement_edit_requests as $advertisement_edit_request)
                                    <tr>
                                        <td style="text-align: center">{!! isset($advertisement_edit_request->user->name)
                                            ? $advertisement_edit_request->user->name
                                            : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($advertisement_edit_request->advertisement->code)
                                            ? $advertisement_edit_request->advertisement->code
                                            : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($advertisement_edit_request->status)
                                            ? $advertisement_edit_request->status
                                            : "<span style='color:red;'>Undefined</span>" !!} </td>



                                        <td style="text-align: center">
                                            {!! isset($advertisement_edit_request->created_at)
                                                ? $advertisement_edit_request->created_at
                                                : "<span style='color:red;'>Undefined</span>" !!}
                                        </td>
                                        <td style="text-align: center">


                                            @if (isset($advertisement_edit_request->status) && $advertisement_edit_request->status == 'Pending')
                                                <a href="{{ route('super_admin.advertisement_edit_request-reject', [isset($advertisement_edit_request->id) ? $advertisement_edit_request->id : -1]) }}"
                                                    class="process mb-1 btn btn-sm btn-danger" title=" Reject"><i
                                                        class="fas fa-ban"></i></a>
                                                <a href="{{ route('super_admin.advertisement_edit_request-accept', [isset($advertisement_edit_request->id) ? $advertisement_edit_request->id : -1]) }}"
                                                    class="process mb-1 btn btn-sm btn-success" title="Accept"><i
                                                        class="fas fa-check-circle"></i></a>
                                            @endif
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
