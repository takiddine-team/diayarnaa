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
                    <h1>السلايدرات</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحه التحكم
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                <i class="fas fa-users-cog"></i> السلايدرات
                            </li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="{{ route('super_admin.home_sliders-create') }}" class="mb-1 btn btn-primary"><i
                            class="mdi mdi-playlist-plus"></i>اضافة </a>
                    <a href="{{ route('super_admin.home_sliders-showSoftDelete') }}" class="mb-1 btn btn-danger"><i
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
                                <th style="text-align: center"><i class="mdi mdi-format-title"></i> اسم الشركة بالانجليزي
                                </th>
                                <th style="text-align: center"><i class="mdi mdi-format-title"></i> اسم الشركة بالعربي</th>
                                <th style="text-align: center"><i class="mdi mdi-format-title"></i> الدولة</th>
                                <th style="text-align: center"><i class="mdi mdi-format-title"></i> المدينة</th>
                                <th style="text-align: center"><i class="mdi mdi-format-title"></i> نوع المستخدم</th>
                                <th style="text-align: center"><i class="mdi mdi-format-title"></i> الحالة</th>
                                <th style="text-align: center"><i class="mdi mdi-clock-outline mdi-spin"></i> الوقت </th>
                                <th style="text-align: center"><i class="mdi mdi-settings mdi-spin"></i> التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($home_sliders) && $home_sliders->count() > 0)
                                @foreach ($home_sliders as $home_slider)
                                    <tr>
                                        <td style="text-align: center">{!! isset($home_slider->company_name_en)
                                            ? $home_slider->company_name_en
                                            : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($home_slider->company_name_ar)
                                            ? $home_slider->company_name_ar
                                            : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($home_slider->diyarnaaCountry->name_en)
                                            ? $home_slider->diyarnaaCountry->name_en
                                            : "<span style='color:blue;'>----------</span>" !!} </td>

                                        <td style="text-align: center">{!! isset($home_slider->diyarnaaCity->name_en)
                                            ? $home_slider->diyarnaaCity->name_en
                                            : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($home_slider->user_type) ? $home_slider->user_type : "<span style='color:blue;'>----------</span>" !!} </td>

                                        <td style="text-align: center">
                                            {!! isset($home_slider->status) ? $home_slider->status : "<span style='color:red;'>Undefined</span>" !!}
                                        </td>



                                        <td style="text-align: center">
                                            {!! isset($home_slider->created_at) ? $home_slider->created_at : "<span style='color:red;'>Undefined</span>" !!}
                                        </td>
                                        <td style="text-align: center">
                                            <a href="{{ route('super_admin.home_sliders-show', isset($home_slider->id) ? $home_slider->id : -1) }}"
                                                class="mb-1 btn btn-sm btn-primary"><i class="mdi mdi-eye"></i></a>
                                            <a href="{{ route('super_admin.home_sliders-edit', isset($home_slider->id) ? $home_slider->id : -1) }}"
                                                class="mb-1 btn btn-sm btn-success"><i
                                                    class="mdi mdi-playlist-edit"></i></a>
                                            <a href="{{ route('super_admin.home_sliders-softDelete', isset($home_slider->id) ? $home_slider->id : -1) }}"
                                                class="confirm mb-1 btn btn-sm btn-danger"><i
                                                    class="mdi mdi-delete"></i></a>
                                            @if (isset($home_slider->status) && $home_slider->status == 'Pending')
                                                <a href="{{ route('super_admin.home_sliders-reject', [isset($home_slider->id) ? $home_slider->id : '----------']) }}"
                                                    class="process mb-1 btn btn-sm btn-danger" title=" Reject"><i
                                                        class="fas fa-ban"></i></a>
                                                <a href="{{ route('super_admin.home_sliders-accept', [isset($home_slider->id) ? $home_slider->id : '----------']) }}"
                                                    class="process mb-1 btn btn-sm btn-success" title="Accept"><i
                                                        class="fas fa-check-circle"></i></a>
                                            @else
                                                <a href="{{ route('super_admin.home_sliders-activeInactiveSingle', [isset($home_slider->id) ? $home_slider->id : '----------']) }}"
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
