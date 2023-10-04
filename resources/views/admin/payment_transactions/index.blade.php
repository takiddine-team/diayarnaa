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
                    <h1>عمليات الدفع </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحه التحكم
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                <i class="fas fa-users-cog"></i>  عمليات الدفع 
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
                                <th style="text-align: center"> المستخدم </th>
                                <th style="text-align: center"> العضوية المميزة </th>
                                <th style="text-align: center"> المبلغ </th>
                                <th style="text-align: center"> رقم الدفع</th>
                                <th style="text-align: center"> حالة الدفع</th>
                                <th style="text-align: center"><i class="mdi mdi-clock-outline mdi-spin"></i> الوقت </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($payment_transactions) && $payment_transactions->count() > 0)
                                @foreach ($payment_transactions as $payment_transaction)
                                    <tr>
                                        <td style="text-align: center">
                                            <a href="{{ route('super_admin.users-show', [isset($payment_transaction->user) ? $payment_transaction->user->id : -1]) }}"
                                                class="mb-1 btn btn-sm btn-primary">
                                                {!! isset($payment_transaction->user->name) ? $payment_transaction->user->name : "<span style='color:blue;'>----------</span>" !!} 
                                            </a>

                                           
                                        </td>
                                        <td style="text-align: center">
                                            <a href="{{ route('super_admin.premiumMemberships-show', [isset($payment_transaction->premiumMembership->id) ? $payment_transaction->premiumMembership->id : '----------']) }}"
                                                class=" mb-1 btn btn-sm btn-success" title="show">
                                                {!! isset($payment_transaction->premiumMembership->name_ar) ? $payment_transaction->premiumMembership->name_ar : "<span style='color:blue;'>----------</span>" !!} 
                                            </a>


                                          
                                        </td>
                                        <td style="text-align: center">{!! isset($payment_transaction->amount) ? $payment_transaction->amount : "<span style='color:red;'>Undefined</span>" !!} </td>

                                        <td style="text-align: center">{!! isset($payment_transaction->payment_id) ? $payment_transaction->payment_id : "<span style='color:red;'>Undefined</span>" !!} </td>
                                        <td style="text-align: center">
                                            @if (isset($payment_transaction->payment_status))
                                                @if ($payment_transaction->payment_status == 'مكتمل')
                                                <span style='color:green;'>{{ $payment_transaction->payment_status }}</span>
                                                @elseif ($payment_transaction->payment_status == 'تم الانشاء')
                                                <span style='color:blue;'>{{ $payment_transaction->payment_status }}</span>
                                                @else
                                                <span style='color:red;'>{{ $payment_transaction->payment_status }}</span>
                                                @endif
                                            @else
                                            <span style='color:red;'>Undefined</span>
                                            @endif
                                        </td>
                                        <td style="text-align: center">
                                            {!! isset($payment_transaction->created_at) ? $payment_transaction->created_at : "<span style='color:red;'>Undefined</span>" !!}
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
