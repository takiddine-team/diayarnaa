@extends('admin.layouts.app')


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
                    <h1 >التصنيفات الفرعية</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحه التحكم
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                <i class="fas fa-users-cog"></i>جميع التصنيفات الفرعية
                            </li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="{{ route('super_admin.sub_categories-create') }}" class="mb-1 btn btn-primary"><i
                            class="mdi mdi-playlist-plus"></i>اضافة </a>
                    <a href="{{ route('super_admin.sub_categories-showSoftDelete') }}" class="mb-1 btn btn-danger"><i
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
                                <th style="text-align: center"> العنوان بالانجليزي </th>
                                <th style="text-align: center">العنوان بالعربي </th>
                                <th style="text-align: center"> التصنيف الرئيسي</th>
                                <th style="text-align: center"> الحالة</th>
                                <th style="text-align: center"><i class="mdi mdi-clock-outline mdi-spin"></i> الوقت </th>
                                <th style="text-align: center"><i class="mdi mdi-settings mdi-spin"></i> التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($subCategories) && $subCategories->count() > 0)
                                @foreach ($subCategories as $subCategory)
                                    <tr>
                                        <td style="text-align: center">{!! isset($subCategory->name_en) ? $subCategory->name_en : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($subCategory->name_ar) ? $subCategory->name_ar : "<span style='color:blue;'>----------</span>" !!} </td>

                                        <td style="text-align: center">{!! isset($subCategory->mainCategory->name_ar) ? $subCategory->mainCategory->name_ar : "<span style='color:blue;'>----------</span>" !!} </td>

                                        <td style="text-align: center">{!! isset($subCategory->status) ? $subCategory->status : "<span style='color:red;'>Undefined</span>" !!} </td>
                                        <td style="text-align: center">
                                            {!! isset($subCategory->created_at) ? $subCategory->created_at : "<span style='color:red;'>Undefined</span>" !!}
                                        </td>
                                        <td style="text-align: center">
                                            <a href="{{ route('super_admin.sub_categories-edit', isset($subCategory->id) ? $subCategory->id : -1) }}"
                                                class="mb-1 btn btn-sm btn-success"><i
                                                    class="mdi mdi-playlist-edit"></i></a>
                                            <a href="{{ route('super_admin.sub_categories-softDelete', [isset($subCategory->id) ? $subCategory->id : '----------']) }}"
                                                class="confirm mb-1 btn btn-sm btn-danger" title="Delete"><i
                                                    class="mdi mdi-delete"></i></a>
                                            <a href="{{ route('super_admin.sub_categories-activeInactiveSingle', [isset($subCategory->id) ? $subCategory->id : '----------']) }}"
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
                            [3, "desc"]
                        ]
                    });
                });
            </script>
            <script src="{{ asset('style_files/backend/plugins/data-tables/jquery.datatables.min.js') }}"></script>
            <script src="{{ asset('style_files/backend/plugins/data-tables/datatables.bootstrap4.min.js') }}"></script>
        @endsection
