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
                    <h1><i class="mdi mdi-delete"></i> Archived Countries</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <i class="mdi  mdi-home"></i> لوحه التحكم
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.diyarnaa_countries-index') }}">
                                    <i class="mdi  mdi-home"></i> جميع الدول
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page"><i class="mdi mdi-delete"></i> Archived
                                Questions
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
                                <th style="text-align: center"> الاسم بالانجليزي</th>
                                <th style="text-align: center"> الاسم بالعربي</th>
                                <th style="text-align: center"> العلم </th>
                                <th style="text-align: center"> الصورة</th>
                                <th style="text-align: center"> الحالة</th>
                                <th style="text-align: center"><i class="mdi mdi-clock-outline mdi-spin"></i>  الوقت </th>
                                <th style="text-align: center"><i class="mdi mdi-settings mdi-spin"></i>  التحكم</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (isset($diyarna_countries) && $diyarna_countries->count() > 0)
                                @foreach ($diyarna_countries as $country)
                                    <tr>
                                        <td style="text-align: center">{!! isset($country->name_en)
                                            ? $country->name_en
                                            : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">{!! isset($country->name_ar)
                                            ? $country->name_ar
                                            : "<span style='color:blue;'>----------</span>" !!} </td>
                                        <td style="text-align: center">
                                            @if (isset($country->flag) && $country->getRawOriginal('flag') && file_exists($country->getRawOriginal('flag')))
                                                <img src="{{ asset($country->getRawOriginal('flag')) }}" width="70"
                                                    height="70" style="border-radius: 10px; border:solid 1px black;">
                                            @else
                                                <img src="{{ asset('images_default/default.png') }}" width="70"
                                                    height="70" style="border-radius: 10px; border:solid 2px black;">
                                            @endif
                                        </td>
                                        <td style="text-align: center">
                                            @if (isset($country->image) &&
                                                $country->getRawOriginal('image') &&
                                                file_exists($country->getRawOriginal('image')))
                                                <img src="{{ asset($country->getRawOriginal('image')) }}" width="70"
                                                    height="70" style="border-radius: 10px; border:solid 1px black;">
                                            @else
                                                <img src="{{ asset('images_default/default.png') }}" width="70"
                                                    height="70" style="border-radius: 10px; border:solid 2px black;">
                                            @endif
                                        </td>

                                        <td style="text-align: center">{!! isset($country->status) ? $country->status : "<span style='color:red;'>Undefined</span>" !!} </td>
                                        <td style="text-align: center">
                                            {!! isset($country->created_at) ? $country->created_at : "<span style='color:red;'>Undefined</span>" !!}
                                        </td>
                                        <td style="text-align: center">
                                            <a href="{{ route('super_admin.diyarnaa_countries-softDeleteRestore', [isset($country->id) ? $country->id : '----------']) }}"
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
