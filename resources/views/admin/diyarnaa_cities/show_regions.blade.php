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
                    <h1>Regions</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحه التحكم
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                {{isset($diyarnaa_city->country) ? $diyarnaa_city->country->name_ar : null }}
                            </li>



                            <li class="breadcrumb-item">
                                <a
                                    href="{{ route('super_admin.diyarnaa_countries-showCities', isset($diyarnaa_city->diyarnaa_country_id) ? $diyarnaa_city->diyarnaa_country_id : -1) }}">
                                  جميع المحافظات
                                </a>
                            </li>


                            <li class="breadcrumb-item">
                                {{ $diyarnaa_city->name_ar }}
                            </li>
                            <li class="breadcrumb-item">
                                جميع المناطق
                            </li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="{{ route('super_admin.diyarnaa_regions-create', isset($diyarnaa_city->id) ? $diyarnaa_city->id : -1) }}"
                        class="mb-1 btn btn-primary"><i class="mdi mdi-playlist-plus"></i>اضافة  </a>
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
                                <th style="text-align: center"> الإسم بالإنجليزي </th>
                                <th style="text-align: center">الاسم بالعربي </th>
                                <th style="text-align: center"> الحالة</th>

                                <th style="text-align: center"><i class="mdi mdi-settings mdi-spin"></i>  التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($diyarnaa_city->diyarnaaRegions) && $diyarnaa_city->diyarnaaRegions->count() > 0)
                                @foreach ($diyarnaa_city->diyarnaaRegions as $region)
                                    <tr>
                                        <td style="text-align: center">{!! isset($region->name_en) ? $region->name_en : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($region->name_ar) ? $region->name_ar : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($region->status) ? $region->status : "<span style='color:blue;'>----------</span>" !!} </td>




                                        <td style="text-align: center">
                                            <a href="{{ route('super_admin.diyarnaa_regions-edit', isset($region->id) ? $region->id : -1) }}"
                                                class="mb-1 btn btn-sm btn-success">تعديل</a>
                                            <a href="{{ route('super_admin.diyarnaa_regions-activeInactiveSingle', [isset($region->id) ? $region->id : '----------']) }}"
                                                class="process mb-1 btn btn-sm btn-warning" title="Active / Inactive"><i
                                                    class="mdi mdi-stop"></i></a>
                                            {{-- <a href="{{ route('super_admin.diyarnaa_countries-showCities', [isset($city->id) ? $city->id : '----------']) }}"
                                                class=" mb-1 btn btn-sm btn-success" title="show">رؤيه المناطق</a>
                                            <a href="{{ route('super_admin.diyarnaa_regions-create', isset($city->id) ? $city->id : -1) }}"
                                                class="mb-1 btn btn-sm btn-success">اضافة منطقة</a>
                                           
                                             --}}
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
