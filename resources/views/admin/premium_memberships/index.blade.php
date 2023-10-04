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
                    <h1>العضويات المميزة</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحه التحكم
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                <i class="fas fa-users-cog"></i> العضويات المميزة
                            </li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="{{ route('super_admin.premiumMemberships-create') }}" class="mb-1 btn btn-primary"><i
                            class="mdi mdi-playlist-plus"></i>اضافة </a>
                    <a href="{{ route('super_admin.premiumMemberships-showSoftDelete') }}" class="mb-1 btn btn-danger"><i
                            class="mdi mdi-delete"></i> الارشيف</a>
                    <a href="{{ route('super_admin.premiumMemberships-activeAll') }}" class="mb-1 btn btn-success"> تنشيط الجميع  </a> 
                    <a href="{{ route('super_admin.premiumMemberships-inactiveAll') }}" class="mb-1 btn btn-danger">الغاء تنشيط الجميع</a> 
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

                                <th style="text-align: center"> السعر</th>
                                <th style="text-align: center"> عدد المستخدمين</th> 
                                <th style="text-align: center"> صلاحية الاعلان</th>
                                <th style="text-align: center"> صلاحية العضوية
                                </th>
                                <th style="text-align: center"> عدد الاعلانات</th> 
                                <th style="text-align: center"> الحالة</th>
                                <th style="text-align: center"><i class="mdi mdi-settings mdi-spin"></i> التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($memberships) && $memberships->count() > 0)
                                @foreach ($memberships as $membership)
                                    <tr>
                                        <td style="text-align: center">{!! isset($membership->name_en) ? $membership->name_en : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($membership->name_ar) ? $membership->name_ar : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($membership->price) ? $membership->price . ' $' : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($membership->userMemberships)
                                            ? $membership->userMemberships->count()
                                            : "<span style='color:blue;'>----------</span>" !!} </td>

                                        <td style="text-align: center">{!! isset($membership->number_days_ad)
                                            ? $membership->number_days_ad
                                            : "<span style='color:blue;'>----------</span>" !!} يوم </td>
                                        <td style="text-align: center">{!! isset($membership->number_days_membership)
                                            ? $membership->number_days_membership
                                            : "<span style='color:blue;'>----------</span>" !!} يوم

                                        </td>
                                        <td style="text-align: center">{!! isset($membership->number_of_ads)
                                            ? $membership->number_of_ads
                                            : "<span style='color:blue;'>غير محدود</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($membership->status) ? $membership->status : "<span style='color:red;'>Undefined</span>" !!} </td>
                                        <td style="text-align: center">
                                            <a href="{{ route('super_admin.premiumMemberships-edit', isset($membership->id) ? $membership->id : -1) }}"
                                                class="mb-1 btn btn-sm btn-success"><i
                                                    class="mdi mdi-playlist-edit"></i></a>
                                            <a href="{{ route('super_admin.premiumMemberships-softDelete', isset($membership->id) ? $membership->id : -1) }}"
                                                class="confirm mb-1 btn btn-sm btn-danger"><i
                                                    class="mdi mdi-delete"></i></a>
                                            <a href="{{ route('super_admin.premiumMemberships-activeInactiveSingle', [isset($membership->id) ? $membership->id : '----------']) }}"
                                                class="process mb-1 btn btn-sm btn-warning" title="Active / Inactive"><i
                                                    class="mdi mdi-stop"></i></a>
                                            <a href="{{ route('super_admin.premiumMemberships-show', [isset($membership->id) ? $membership->id : '----------']) }}"
                                                class=" mb-1 btn btn-sm btn-success" title="show"><i
                                                    class="fas fa-eye"></i></a>
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
