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
                    <h1>المستخدمين</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحه التحكم
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                <i class="fas fa-users-cog"></i> المستخدمين
                            </li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="{{ route('super_admin.users-create') }}" class="mb-1 btn btn-primary"><i
                            class="mdi mdi-playlist-plus"></i>اضافة </a>

                             <a href="{{ route('super_admin.users-export') }}" class="mb-1 btn btn-success">export </a>


                    <a href="{{ route('super_admin.users-showSoftDelete') }}" class="mb-1 btn btn-danger"><i
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
                                <th style="text-align: center"><i class="mdi mdi-format-title"></i> اسم المستخدم</th>
                                <th style="text-align: center"><i class="mdi mdi-format-title"></i>  الرمز</th>
                                <th style="text-align: center"><i class="mdi mdi-format-title"></i> البريد</th>

                                <th style="text-align: center"><i class="mdi mdi-format-title"></i> رقم الهاتف</th>
                                <th style="text-align: center"><i class="mdi mdi-format-title"></i> نوع المستخدم </th>

                                <th style="text-align: center"><i class="mdi mdi-format-title"></i> الحالة</th>
                                <th style="text-align: center"><i class="mdi mdi-clock-outline mdi-spin"></i> الوقت </th>
                                <th style="text-align: center"><i class="mdi mdi-settings mdi-spin"></i> التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($users) && $users->count() > 0)
                                @foreach ($users as $user)
                                    <tr>
                                        <td style="text-align: center">{!! isset($user->name) ? $user->name : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($user->code) ? $user->code : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">
                                            {!! isset($user->email) ? $user->email : "<span style='color:blue;'>----------</span>" !!} 
                                            <br>
                                            @if ($user->is_verified == 'Verified')
                            
                                                <span style="color: green">({{ @trans("front.Verified")}})</span>
                                            @else
                                                <span style="color: red">({{ @trans("front.NotVerified")}})</span>
                                            @endif
                                        </td>
                                        <td style="text-align: center">{!! isset($user->phone) ? $user->phone : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($user->user_type) ? $user->user_type : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($user->status) ? $user->status : "<span style='color:red;'>Undefined</span>" !!} </td>



                                        <td style="text-align: center">
                                            {!! isset($user->created_at) ? $user->created_at : "<span style='color:red;'>Undefined</span>" !!}
                                        </td>
                                        <td style="text-align: center">


                                      



                                            <a href="{{ route('super_admin.users-show', [isset($user->id) ? $user->id : -1]) }}"
                                                class="mb-1 btn btn-sm btn-primary"><i class="mdi mdi-eye"></i></a>
                                            <a href="{{ route('super_admin.users-edit', [isset($user->id) ? $user->id : -1]) }}"
                                                class="mb-1 btn btn-sm btn-success"><i
                                                    class="mdi mdi-playlist-edit"></i></a>
                                            <a href="{{ route('super_admin.users-softDelete', [isset($user->id) ? $user->id : -1]) }}"
                                                class="confirm mb-1 btn btn-sm btn-danger"><i
                                                    class="mdi mdi-delete"></i></a>
                                            @if (isset($user->status) && $user->status == 'Pending' && $user->user_type == 'Real Estate Office')
                                                <a href="{{ route('super_admin.users-reject', [isset($user->id) ? $user->id : -1]) }}"
                                                    class="process mb-1 btn btn-sm btn-danger" title=" Reject"><i
                                                        class="fas fa-ban"></i></a>
                                                <a href="{{ route('super_admin.users-accept', [isset($user->id) ? $user->id : -1]) }}"
                                                    class="process mb-1 btn btn-sm btn-success" title="Accept"><i
                                                        class="fas fa-check-circle"></i></a>
                                            @else
                                                <a href="{{ route('super_admin.users-activeInactiveSingle', [isset($user->id) ? $user->id : -1]) }}"
                                                    class="process mb-1 btn btn-sm btn-warning" title="Active / Inactive"><i
                                                        class="mdi mdi-stop"></i></a>
                                            @endif


                                            <a href="{{ route('super_admin.users-addMembership', [isset($user->id) ? $user->id : -1]) }}"
                                                class="mb-1 btn btn-sm btn-primary" >اضافة رصيد </a>



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
