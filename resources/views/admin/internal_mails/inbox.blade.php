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
                    <h1>البريد الوارد</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحه التحكم
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                <i class="fas fa-users-cog"></i> البريد الوارد
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
                                <th style="text-align: center"><i class="mdi mdi-format-title"></i> المرسل
                                </th>
                                <th style="text-align: center"><i class="mdi mdi-format-title"></i> الرسالة </th>
                                <th style="text-align: center"><i class="mdi mdi-format-title"></i> المرفق </th>

                                <th style="text-align: center"><i class="mdi mdi-clock-outline mdi-spin"></i> الوقت </th>
                                <th style="text-align: center"><i class="mdi mdi-settings mdi-spin"></i> التحكم</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (isset(Auth::guard('super_admin')->user()->mailReceiver) &&
                                Auth::guard('super_admin')->user()->mailReceiver->count() > 0)
                                @foreach (Auth::guard('super_admin')->user()->mailReceiver as $mail)
                                    {{-- @if ($mail->deleter_type != 2) --}}

                                    <tr>
                                        <td style="text-align: center">{!! isset($mail->userSender->name) ? $mail->userSender->name : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($mail->details) ? Str::limit($mail->details, 50) : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">
                                            @if (isset($mail->file) && $mail->getRawOriginal('file') && file_exists($mail->getRawOriginal('file')))
                                                <a href="{{ asset($mail->file) }}" target="_blank">ملف <i
                                                        class="mdi mdi-eye"></i></a>
                                            @else
                                                <span style="color:blue;">لا يوجد ملف</span>
                                            @endif
                                        </td>

                                        <td style="text-align: center">
                                            {!! isset($mail->created_at) ? $mail->created_at : "<span style='color:red;'>Undefined</span>" !!}
                                        </td>
                                        <td style="text-align: center">
                                            <a href="{{ route('super_admin.internal_mails-showInbox', isset($mail->id) ? $mail->id : -1) }}"
                                                class="mb-1 btn btn-sm btn-success"><i class="mdi mdi-eye"></i></a>

                                            <a href="{{ route('super_admin.internal_mails-destroy', isset($mail->id) ? $mail->id : -1) }}"
                                                class="confirm mb-1 btn btn-sm btn-danger"><i
                                                    class="mdi mdi-delete"></i></a>

                                                    <a href="{{ route('super_admin.internal_mails-sendEmail', ['email'=>isset($mail->userSender->email) ? $mail->userSender->email : null]) }}"
                                                        class=" mb-1 btn btn-sm btn-primary">رد</a>
                                        </td>
                                    </tr>
                                    {{-- @endif --}}
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
