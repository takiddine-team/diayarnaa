@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="content">
            {{-- =========================================================== --}}
            {{-- ================== Sweet Alert Section ==================== --}}
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
                    <h1><i class="mdi mdi-delete"></i> ارشيف الموظفين</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <i class="mdi  mdi-home"></i> لوحه التحكم
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.employees-index') }}">
                                    <i class="mdi  mdi-home"></i> الموظفين
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page"><i class="mdi mdi-delete"></i> أرشيف الموظفين
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

            {{-- ============================================== --}}
            {{-- =================== Body ===================== --}}
            {{-- ============================================== --}}
            <div class="card card-default">
                <div class="card-header justify-content-between " style="background-color: #4c84ff;">
                </div>
                <div class="card-body">
                    <table id="hoverable-data-table" class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th style="text-align: center"><i class="mdi mdi-format-title"></i> اسم المستخدم</th>
                                <th style="text-align: center"><i class="mdi mdi-format-title"></i> النوع </th>
                                <th style="text-align: center"><i class="mdi mdi-format-title"></i> البريد</th>
                                <th style="text-align: center"><i class="mdi mdi-format-title"></i> رقم الهاتف</th>
                                <th style="text-align: center"><i class="mdi mdi-clock-outline mdi-spin"></i> الوقت </th>
                                <th style="text-align: center"><i class="mdi mdi-settings mdi-spin"></i> التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($employees) && $employees->count() > 0)
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td style="text-align: center">{!! isset($employee->name) ? $employee->name : "<span style='color:blue;'>----------</span>" !!} </td>

                                        <td style="text-align: center">{!! isset($employee->type) ? $employee->type : "<span style='color:blue;'>----------</span>" !!} </td>



                                        <td style="text-align: center">
                                            {!! isset($employee->email) ? $employee->email : "<span style='color:blue;'>----------</span>" !!}
                                        </td>
                                        <td style="text-align: center">{!! isset($employee->phone) ? $employee->phone : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">
                                            {!! isset($employee->created_at) ? $employee->created_at : "<span style='color:red;'>Undefined</span>" !!}
                                        </td>
                                        <td>
                                            <a href="{{ route('super_admin.employees-softDeleteRestore', [isset($employee->id) ? $employee->id : '----------']) }}"
                                                class="unarchive mb-1 btn btn-sm btn-success" title="Restore"><i
                                                    class="mdi mdi-redo-variant"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('admin_javascript')
    <script>
        jQuery(document).ready(function() {
            jQuery('#hoverable-data-table').DataTable({
                "aLengthMenu": [
                    [20, 30, 50, 75, -1],
                    [20, 30, 50, 75, "All"]
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
