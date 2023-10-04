@extends('admin.layouts.app')


@section('content')
    <div class="content-wrapper">
        <div class="content">
            {{-- ============================================== --}}
            {{-- ================== Header ==================== --}}
            {{-- ============================================== --}}
            <div class="breadcrumb-wrapper breadcrumb-contacts">
                <div>
                    <h1>اضافة </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحة التحكم
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.employees-index') }}">
                                    <span class="fa fa-th"></span> الموظفين
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">اضافة </li>
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
                                        <form id="createForm" action="{{ route('super_admin.employees-store') }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-row">


                                                {{-- الاسم  --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="username"> الاسم :
                                                        <strong class="text-danger">
                                                            *
                                                            @error('name')
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
                                                        <input type="text" name="name"
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            id="username" placeholder="الاسم"
                                                            value="{!! old('name') ? old('name') : null !!}">
                                                    </div>
                                                </div>




                                                {{-- البريد الالكتروني --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="email"> البريد
                                                        الالكتروني:
                                                        <strong class="text-danger">
                                                            *
                                                            @error('email')
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
                                                        <input type="email" name="email"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            id="email" placeholder="البريد الالكتروني"
                                                            value="{!! old('email') ? old('email') : null !!}">
                                                    </div>
                                                </div>

                                                {{-- Phone --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="phone"> رقم
                                                        هاتف :
                                                        <strong class="text-danger">
                                                            *
                                                            @error('phone')
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
                                                        <input type="phone" name="phone"
                                                            class="form-control @error('phone') is-invalid @enderror"
                                                            id="phone" placeholder="رقم هاتف"
                                                            value="{!! old('phone') ? old('phone') : null !!}">
                                                    </div>
                                                </div>

                                                {{-- Type --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01">النوع : <strong class="text-danger"> *
                                                            @error('type')
                                                                {{ $message }}
                                                            @enderror
                                                        </strong></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-account-check"></span>
                                                        </div>
                                                        <select name="type"
                                                            class="custom-select my-1 mr-sm-2 @error('type') is-invalid @enderror"
                                                            id="inlineFormCustomSelectPref">
                                                            <option value="" selected>اختر النوع...</option>
                                                            <option value="1"
                                                                @if (old('type') == 1) selected @endif>Admin
                                                            </option>
                                                            <option value="2"
                                                                @if (old('type') == 2) selected @endif>
                                                                Employee
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>



                                                {{-- الرقم السري  --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="password">
                                                        الرقم السري : <strong class="text-danger">
                                                            *
                                                            @error('password')
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
                                                        <input type="password" name="password"
                                                            class="form-control @error('password') is-invalid @enderror"
                                                            id="password" placeholder="الرقم السري">
                                                    </div>
                                                </div>


                                                {{-- تأكيد الرقم لسري  --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="Rpassword">تأكيد
                                                        الرقم السري : <strong class="text-danger">
                                                            @error('password_confirmation')
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
                                                        <input type="password" name="password_confirmation"
                                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                                            id="Rpassword" placeholder="تأكيد الرقم السري">
                                                    </div>
                                                </div>




                                                <div class="col-md-12 mb-3">
                                                    <button class="mdi btn btn-primary" type="submit"><span
                                                            class="mdi mdi-plus"></span>إضافة</button>
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
                getType();
            });

            $('#user_type').on('change', function() {
                getType();
            });

            function getType() {
                if ($('#user_type').val() == 1) {

                    $("#expire_date_div").css("display", "block");
                    $("#office_phone").css("display", "block");
                    $("#last_name_div").css("display", "none");
                    $("#street_div").css("display", "none");
                    $("#license_image_div").css("display", "block");

                } else {

                    $("#expire_date_div").css("display", "none");
                    $("#office_phone").css("display", "none");
                    $("#last_name_div").css("display", "block");
                    $("#street_div").css("display", "block");
                    $("#license_image_div").css("display", "none");
                }
            }
        </script>
    @endsection

    @section('admin_javascript')
    @endsection
