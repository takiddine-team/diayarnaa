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
                    <h1><i class="mdi mdi-settings"></i> Technical problems</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <i class="mdi mdi-home"></i> لوحه التحكم
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page"><i class="mdi mdi-settings"></i> Technical problems</li>
                        </ol>
                    </nav>
                </div>
                {{-- <div>
                    <a href="{{ route('users-create') }}" class="mb-1 btn btn-primary"><i
                            class="mdi mdi-playlist-plus"></i>اضافة  </a>
                </div> --}}
            </div>
            {{-- ============================================== --}}
            {{-- =================== Body ===================== --}}
            {{-- ============================================== --}}
            <div class="card card-default">
                <div class="card-header justify-content-between " style="background-color: #4c84ff;">
                    {{-- <h2 style="color:white;"><i class="mdi mdi-star mdi-spin"></i> طلبات سحب الرصيد : </h2> --}}
                </div>
                <div class="card-body">
                    <table id="hoverable-data-table" class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                {{-- <th>Error Location</th> --}}
                                <th>Error Description</th>
                                <th>Function Name</th>
                                {{-- <th>Error Line</th> --}}
                                <th>Error Date</th>
                                <th>Control</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($support_tickets->count() > 0)
                                @foreach ($support_tickets as $index => $support_ticket)
                                    <tr>
                                        <td>{{ $support_ticket->id }}</td>
                                        {{-- <td>{{ $support_ticket->error_location }}</td> --}}
                                        <td>{{ $support_ticket->error_description }}</td>
                                        <td>{{ $support_ticket->function_name }}</td>
                                        {{-- <td>{{ $support_ticket->error_line }}</th> --}}
                                        <td>{{ $support_ticket->created_at }}</th>
                                        <td>
                                            <a href="{{ route('super_admin.support_tickets-destroy', $support_ticket->id) }}" class="confirm mb-1 btn btn-sm btn-danger"><i
                                                class="mdi mdi-delete"></i></a>
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
                "order": [[ 3, "desc" ]]
            });
        });

    </script>
    <script src="{{ asset('style_files/backend/plugins/data-tables/jquery.datatables.min.js') }}">
    </script>
    <script
        src="{{ asset('style_files/backend/plugins/data-tables/datatables.bootstrap4.min.js') }}">
    </script>

@endsection
