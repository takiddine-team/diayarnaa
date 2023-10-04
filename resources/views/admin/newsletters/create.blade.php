@extends('admin.layouts.app')

@section('admin_css')
    <link href="{{ asset('resources/dashboard_files/assets/plugins/data-tables/datatables.bootstrap4.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('resources/dashboard_files/assets/css/sleek.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper"a>
        <div class="content">
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
                    <h1> اضافة نشرة اخبار </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.newsletters-newsletterSubscribers') }}">
                                    <span class="fa fa-th"></span> المتابعين
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">  اضافة نشرة اخبار </li>
                        </ol>
                    </nav>
                </div>

                <div class="content-wrapper">
                    <div class="content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card card-default">
                                    <div class="card-header justify-content-between " style="background-color: #4c84ff;">
                                    </div>
                                    <div class="card-body">
                                        <form id="createForm" action="{{ route('super_admin.newsletters-sendNewsletter') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-row">
                                                
                                               
                                               

                                                {{-- Title --}}
                                                <div class="col-md-12">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="link"> Title: <strong class="text-danger">
                                                           
                                                            @error('title')
                                                                -
                                                                {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-format-title"
                                                                id="inputGroupPrepend2"></span>
                                                        </div>
                                                        <input type="text" name="title"
                                                            class="form-control @error('title') is-invalid @enderror"
                                                            id="title" placeholder="Title"
                                                            value="{!! old('title') ? old('title') : null !!}">
                                                    </div>
                                                </div>
                                               
                                                {{-- Link --}}
                                                <div class="col-md-12">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="link"> Link: <strong class="text-danger">
                                                           
                                                            @error('link')
                                                                -
                                                                {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-format-title"
                                                                id="inputGroupPrepend2"></span>
                                                        </div>
                                                        <input type="url" name="link"
                                                            class="form-control @error('link') is-invalid @enderror"
                                                            id="link" placeholder="Link"
                                                            value="{!! old('link') ? old('link') : null !!}">
                                                    </div>
                                                </div>
                                               
                                                
                                                 {{-- Newsletter --}}
                                                <div class="col-md-12">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01"> Newsletter: <strong
                                                            class="text-danger">
                                                            *
                                                            @error('newsletter')
                                                                -
                                                                {{ $message }}
                                                            @enderror
                                                        </strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                           
                                                        </div>
                                                        <textarea name="newsletter" placeholder="Write Newsletter" class="ckeditor form-control" rows="10">{!! old('newsletter') ? old('newsletter') : null !!}</textarea>


                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <button class="mdi btn btn-primary" type="submit"><span
                                                            class="mdi mdi-plus"></span>Add</button>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

        <script>
            $(document).ready(function() {
                getSystems();
            });

            $('#standard_plan').on('change', function() {
                getSystems();
            });

            function getSystems() {
                if ($('#standard_plan').val() == 1) {
                    $("#system_id_div").css("display", "block");
                } else {
                    $("#system_id_div").css("display", "none");
                }
            }
        </script>


    @endsection
