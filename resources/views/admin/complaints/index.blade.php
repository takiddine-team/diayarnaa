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
                    <h1>طلبات الشكاوى</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحه التحكم
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                <i class="fas fa-users-cog"></i> جميع الشكاوى
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
                                {{-- <th style="text-align: center"><i class="mdi mdi-format-title"></i> الاسم الاول</th>
                                <th style="text-align: center"><i class="mdi mdi-format-title"></i> الاسم الاخير</th> --}}
                                <th style="text-align: center"><i class="mdi mdi-format-title"></i> الرسالة </th>
                                <th style="text-align: center"><i class="mdi mdi-clock-outline mdi-spin"></i> الوقت </th>
                                <th style="text-align: center"><i class="mdi mdi-settings mdi-spin"></i> التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($complaints) && $complaints->count() > 0)
                                @foreach ($complaints as $complaint)
                                    <tr>
                                        {{-- <td style="text-align: center">{!! isset($complaint->first_name) ? $complaint->first_name : "<span style='color:blue;'>----------</span>" !!} </td> --}}
                                        {{-- <td style="text-align: center">{!! isset($complaint->last_name) ? $complaint->last_name : "<span style='color:blue;'>----------</span>" !!} </td> --}}

                                        <td style="text-align: center">{!! isset($complaint->description) ? Str::limit(  $complaint->description, 50) : "<span style='color:blue;'>----------</span>" !!} </td>



                                        <td style="text-align: center">
                                            {!! isset($complaint->created_at) ? $complaint->created_at : "<span style='color:red;'>Undefined</span>" !!}
                                        </td>
                                        <td style="text-align: center">
                                            <a href="{{ route('super_admin.complaints-show', [isset($complaint->id) ? $complaint->id : '----------']) }}"
                                                class=" mb-1 btn btn-sm btn-success" title="show"><i
                                                    class="fas fa-eye"></i></a>

                                            <a href="{{ route('super_admin.complaints-destroy', [isset($complaint->id) ? $complaint->id : '----------']) }}"
                                                class="confirm mb-1 btn btn-sm btn-danger"><i
                                                    class="mdi mdi-delete"></i></a>

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
