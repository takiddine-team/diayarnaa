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
                    <h1>وسطاء الموقع</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحه التحكم
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                <i class="fas fa-users-cog"></i> وسطاء الموقع
                            </li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="{{ route('super_admin.website_brokers-create') }}" class="mb-1 btn btn-primary"><i
                            class="mdi mdi-playlist-plus"></i>اضافة </a>
                             <a href="{{ route('super_admin.website_brokers-showSoftDelete') }}" class="mb-1 btn btn-danger"><i
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
                                <th style="text-align: center"></i>الاسم</th>
                                <th style="text-align: center"></i>الاسم الاخير</th>
                                <th style="text-align: center"></i> الدولة </th>
                                <th style="text-align: center"></i> المدينه </th>
                                <th style="text-align: center"></i> الحالة</th>
                                <th style="text-align: center"></i> الصورة</th>
                                <th style="text-align: center"></i> الملف</th>
                                <th style="text-align: center"><i class="mdi mdi-clock-outline mdi-spin"></i> الوقت </th>
                                <th style="text-align: center"><i class="mdi mdi-settings mdi-spin"></i> التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($website_brokers) && $website_brokers->count() > 0)
                                @foreach ($website_brokers as $website_broker)
                                    <tr>
                                        <td style="text-align: center">{!! isset($website_broker->name) ? $website_broker->name : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($website_broker->last_name) ? $website_broker->last_name : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($website_broker->diyarnaaCountry->name_ar)
                                            ? $website_broker->diyarnaaCountry->name_ar
                                            : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($website_broker->diyarnaaCity->name_ar)
                                            ? $website_broker->diyarnaaCity->name_ar
                                            : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($website_broker->status) ? $website_broker->status : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">
                                            @if (isset($website_broker->image) &&
                                                $website_broker->getRawOriginal('image') &&
                                                file_exists($website_broker->getRawOriginal('image')))
                                                <img src="{{ asset($website_broker->image) }}"
                                                    style="border-radius: 10px; border:solid 1px black;width: 50px;
                                                                height: 50px;">
                                            @else
                                                <img src="{{ asset('images_default/default.png') }}"
                                                    style="border-radius: 10px; border:solid 2px black; width: 50px; height: 50px;">
                                            @endif
                                        </td>
                                        <td style="text-align: center">
                                            @if (isset($website_broker->file) &&
                                                $website_broker->getRawOriginal('file') &&
                                                file_exists($website_broker->getRawOriginal('file')))
                                                <a href="{{ asset($website_broker->file) }}" target="_blank">ملف <i class="mdi mdi-eye"></i></a>
                                            @else
                                                <span style="color:blue;">لا يوجد ملف</span>
                                            
                                            @endif
                                        </td>


                                        <td style="text-align: center">
                                            {!! isset($website_broker->created_at) ? $website_broker->created_at : "<span style='color:red;'>Undefined</span>" !!}
                                        </td>
                                        <td style="text-align: center">
                                             <a href="{{ route('super_admin.website_brokers-edit', $website_broker->id) }}"
                                                class="mb-1 btn btn-sm btn-success"><i
                                                    class="mdi mdi-playlist-edit"></i></a>
                                            <a href="{{ route('super_admin.website_brokers-softDelete', [isset($website_broker->id) ? $website_broker->id : '----------']) }}"
                                                class="confirm mb-1 btn btn-sm btn-danger" title="Delete"><i
                                                    class="mdi mdi-delete"></i></a>
                                            @if (isset($website_broker->status) && $website_broker->status == 'Pending')
                                                <a href="{{ route('super_admin.website_brokers-reject', [isset($website_broker->id) ? $website_broker->id : '----------']) }}"
                                                    class="process mb-1 btn btn-sm btn-danger" title=" Reject"><i
                                                        class="fas fa-ban"></i></a>
                                                <a href="{{ route('super_admin.website_brokers-accept', [isset($website_broker->id) ? $website_broker->id : '----------']) }}"
                                                    class="process mb-1 btn btn-sm btn-success" title="Accept"><i
                                                        class="fas fa-check-circle"></i></a>
                                            @else
                                                <a href="{{ route('super_admin.website_brokers-activeInactiveSingle', [isset($website_broker->id) ? $website_broker->id : '----------']) }}"
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
                            [3, "desc"]
                        ]
                    });
                });
            </script>
            <script src="{{ asset('style_files/backend/plugins/data-tables/jquery.datatables.min.js') }}"></script>
            <script src="{{ asset('style_files/backend/plugins/data-tables/datatables.bootstrap4.min.js') }}"></script>
        @endsection
