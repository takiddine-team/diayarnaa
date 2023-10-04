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
                    <h1>الاعلانات</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحه التحكم
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                <i class="fas fa-users-cog"></i> الاعلانات
                            </li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="{{ route('super_admin.advertisements-create') }}" class="mb-1 btn btn-primary"><i
                            class="mdi mdi-playlist-plus"></i>اضافة </a>
                    <a href="{{ route('super_admin.advertisements-showSoftDelete') }}" class="mb-1 btn btn-danger"><i
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
                                <th style="text-align: center"> كود الاعلان</th>

                                <th style="text-align: center"> التصنيف</th>

                                <th style="text-align: center"> التصنيف الفرعي </th>
                                <th style="text-align: center"> الدولة </th>

                                <th style="text-align: center"> الحالة</th>
                                <th style="text-align: center"><i class="mdi mdi-clock-outline mdi-spin"></i> الوقت </th>
                                <th style="text-align: center"><i class="mdi mdi-settings mdi-spin"></i> التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($advertisements) && $advertisements->count() > 0)
                                @foreach ($advertisements as $advertisement)
                                    <tr>
                                        <td style="text-align: center">{!! isset($advertisement->user->name)
                                            ? $advertisement->user->name
                                            : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($advertisement->code) ? $advertisement->code : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($advertisement->mainCategory->name_ar)
                                            ? $advertisement->mainCategory->name_ar
                                            : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($advertisement->subCategory->name_ar)
                                            ? $advertisement->subCategory->name_ar
                                            : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($advertisement->diyarnaaCountry->name_ar)
                                            ? $advertisement->diyarnaaCountry->name_ar
                                            : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($advertisement->status) ? $advertisement->status : "<span style='color:red;'>Undefined</span>" !!} </td>



                                        <td style="text-align: center">
                                            {!! isset($advertisement->created_at) ? $advertisement->created_at : "<span style='color:red;'>Undefined</span>" !!}
                                        </td>
                                        <td style="text-align: center">

                                            <a href="{{ route('super_admin.advertisements-show', [isset($advertisement->id) ? $advertisement->id : -1]) }}"
                                                class="mb-1 btn btn-sm btn-primary"><i class="mdi mdi-eye"></i></a>
                                            <a href="{{ route('super_admin.advertisements-edit', [isset($advertisement->id) ? $advertisement->id : -1]) }}"
                                                class="mb-1 btn btn-sm btn-success"><i
                                                    class="mdi mdi-playlist-edit"></i></a>
                                            <a href="{{ route('super_admin.advertisements-softDelete', [isset($advertisement->id) ? $advertisement->id : -1]) }}"
                                                class="confirm mb-1 btn btn-sm btn-danger"><i
                                                    class="mdi mdi-delete"></i></a>
                                            @if (isset($advertisement->status) && $advertisement->status == 'Pending')
                                                <a href="{{ route('super_admin.advertisements-reject', [isset($advertisement->id) ? $advertisement->id : -1]) }}"
                                                    class="process mb-1 btn btn-sm btn-danger" title=" Reject"><i
                                                        class="fas fa-ban"></i></a>
                                                <a href="{{ route('super_admin.advertisements-accept', [isset($advertisement->id) ? $advertisement->id : -1]) }}"
                                                    class="process mb-1 btn btn-sm btn-success" title="Accept"><i
                                                        class="fas fa-check-circle"></i></a>
                                                <a href="{{ route('super_admin.advertisements-acceptWithCondition', [isset($advertisement->id) ? $advertisement->id : -1]) }}"
                                                    class="process mb-1 btn btn-sm btn-success">الموافقه مع شرط التعديل</a>
                                            @else
                                                <a href="{{ route('super_admin.advertisements-activeInactiveSingle', [isset($advertisement->id) ? $advertisement->id : -1]) }}"
                                                    class="process mb-1 btn btn-sm btn-warning" title="Active / Inactive"><i
                                                        class="mdi mdi-stop"></i></a>
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
                            [6, "desc"]
                        ]
                    });
                });
            </script>
            <script src="{{ asset('style_files/backend/plugins/data-tables/jquery.datatables.min.js') }}"></script>
            <script src="{{ asset('style_files/backend/plugins/data-tables/datatables.bootstrap4.min.js') }}"></script>
        @endsection
