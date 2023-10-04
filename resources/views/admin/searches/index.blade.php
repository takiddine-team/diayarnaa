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
                    <h1>الابحاث المضافة</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحه التحكم
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                <i class="fas fa-users-cog"></i> الابحاث المضافة
                            </li>
                        </ol>
                    </nav>
                </div>
                <div>
                   
                    <a href="{{ route('super_admin.searches-showSoftDelete') }}" class="mb-1 btn btn-danger"><i
                            class="mdi mdi-delete"></i> الارشيف</a>

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
                                <th style="text-align: center"> الاسم </th>
                                <th style="text-align: center"> العنوان </th>
                                <th style="text-align: center"> كود البحث</th>

                                <th style="text-align: center"> التصنيف</th>

                                <th style="text-align: center"> التصنيف الفرعي </th>
                                <th style="text-align: center"> الدولة </th>

                                <th style="text-align: center"> الحالة</th>
                                <th style="text-align: center"><i class="mdi mdi-clock-outline mdi-spin"></i> الوقت </th>
                                <th style="text-align: center"><i class="mdi mdi-settings mdi-spin"></i> التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($searches) && $searches->count() > 0)
                                @foreach ($searches as $searche)
                                    <tr>
                                        <td style="text-align: center">{!! isset($searche->user->name)
                                            ? $searche->user->name
                                            : "<span style='color:blue;'>----------</span>" !!} </td>
                                              <td style="text-align: center">{!! isset($searche->title)
                                                ? $searche->title
                                                : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($searche->code) ? $searche->code : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($searche->mainCategory->name_ar)
                                            ? $searche->mainCategory->name_ar
                                            : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($searche->subCategory->name_ar)
                                            ? $searche->subCategory->name_ar
                                            : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($searche->diyarnaaCountry->name_ar)
                                            ? $searche->diyarnaaCountry->name_ar
                                            : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($searche->status) ? $searche->status : "<span style='color:red;'>Undefined</span>" !!} </td>



                                        <td style="text-align: center">
                                            {!! isset($searche->created_at) ? $searche->created_at : "<span style='color:red;'>Undefined</span>" !!}
                                        </td>
                                        <td style="text-align: center">

                                            <a href="{{ route('super_admin.searches-show', [isset($searche->id) ? $searche->id : -1]) }}"
                                                class="mb-1 btn btn-sm btn-primary"><i class="mdi mdi-eye"></i></a>
                                            <a href="{{ route('super_admin.searches-edit', [isset($searche->id) ? $searche->id : -1]) }}"
                                                class="mb-1 btn btn-sm btn-success"><i
                                                    class="mdi mdi-playlist-edit"></i></a>
                                            <a href="{{ route('super_admin.searches-softDelete', [isset($searche->id) ? $searche->id : -1]) }}"
                                                class="confirm mb-1 btn btn-sm btn-danger"><i
                                                    class="mdi mdi-delete"></i></a>
                                         
                                                <a href="{{ route('super_admin.searches-activeInactiveSingle', [isset($searche->id) ? $searche->id : -1]) }}"
                                                    class="process mb-1 btn btn-sm btn-warning" title="Active / Inactive"><i
                                                        class="mdi mdi-stop"></i></a>
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
                            [7, "desc"]
                        ]
                    });
                });
            </script>
            <script src="{{ asset('style_files/backend/plugins/data-tables/jquery.datatables.min.js') }}"></script>
            <script src="{{ asset('style_files/backend/plugins/data-tables/datatables.bootstrap4.min.js') }}"></script>
        @endsection
