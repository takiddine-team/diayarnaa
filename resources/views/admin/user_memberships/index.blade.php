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
                    <h1>مستخدمين العضويات المميزة </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحه التحكم
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                <i class="fas fa-users-cog"></i> مستخدمين العضويات المميزة
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
                                <th style="text-align: center"><i class="mdi mdi-format-title"></i> العضوية المميزة </th>
                                <th style="text-align: center"><i class="mdi mdi-format-title"></i> رصيد الاعلانات </th>
                                <th style="text-align: center"><i class="mdi mdi-format-title"></i> تاريخ الصلاحية </th>
                                <th style="text-align: center"><i class="mdi mdi-format-title"></i> الحالة</th>
                                <th style="text-align: center"><i class="mdi mdi-clock-outline mdi-spin"></i> الوقت </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($user_memberships) && $user_memberships->count() > 0)
                                @foreach ($user_memberships as $user)
                                    <tr>
                                        <td style="text-align: center">{!! isset($user->user->name) ? $user->user->name : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($user->premiumMembership->name_en)
                                            ? $user->premiumMembership->name_en
                                            : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($user->number_of_ads) ? $user->number_of_ads : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($user->expiry_date) ? $user->expiry_date : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($user->status) ? $user->status : "<span style='color:red;'>Undefined</span>" !!} </td>



                                        <td style="text-align: center">
                                            {!! isset($user->created_at) ? $user->created_at : "<span style='color:red;'>Undefined</span>" !!}
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
                            [5, "desc"]
                        ]
                    });
                });
            </script>
            <script src="{{ asset('style_files/backend/plugins/data-tables/jquery.datatables.min.js') }}"></script>
            <script src="{{ asset('style_files/backend/plugins/data-tables/datatables.bootstrap4.min.js') }}"></script>
        @endsection
