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
                    <h1><i class="mdi mdi-delete"></i> الارشيف</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <i class="mdi  mdi-home"></i> لوحه التحكم
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.website_brokers-index') }}">
                                    <i class="mdi  mdi-home"></i> 
                                     وسطاء الموقع
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page"><i class="mdi mdi-delete"></i> الارشيف

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
                    {{-- <h2 style="color:white;"><i class="mdi mdi-star mdi-spin"></i> طلبات سحب الرصيد : </h2> --}}
                </div>
                <div class="card-body">
                    <table id="hoverable-data-table" class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th style="text-align: center"><i class="mdi mdi-format-title"></i>الاسم</th>
                                <th style="text-align: center"><i class="mdi mdi-format-title"></i> الدولة </th>
                                <th style="text-align: center"><i class="mdi mdi-format-title"></i> الحالة</th>
                                <th style="text-align: center"><i class="mdi mdi-format-title"></i> الصورة</th>
                                <th style="text-align: center"><i class="mdi mdi-format-title"></i> الملف</th>
                                <th style="text-align: center"><i class="mdi mdi-settings mdi-spin"></i> التحكم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($website_brokers) && $website_brokers->count() > 0)
                                @foreach ($website_brokers as $website_broker)
                                    <tr>
                                        <td style="text-align: center">{!! isset($website_broker->name) ? $website_broker->name : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($website_broker->diyarnaaCountry->name_ar)
                                            ? $website_broker->diyarnaaCountry->name_ar
                                            : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($website_broker->status) ? $website_broker->status : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">
                                            @if (isset($website_broker->image) &&
                                                $website_broker->getRawOriginal('image') &&
                                                file_exists($website_broker->getRawOriginal('image')))
                                                <img src="{{ asset($website_broker->image) }}"
                                                    style="border-radius: 10px; border:solid 1px black;width: 100px;
                                                                height: 100px;">
                                            @else
                                                <img src="{{ asset('images_default/default.png') }}"
                                                    style="border-radius: 10px; border:solid 2px black; width: 100px; height: 210px;">
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

                                        <td>
                                            <a href="{{ route('super_admin.website_brokers-softDeleteRestore', [isset($website_broker->id) ? $website_broker->id : '----------']) }}"
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
