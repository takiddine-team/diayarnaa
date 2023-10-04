@extends('admin.layouts.app')

@section('admin_css')
    <link href="{{ asset('resources/dashboard_files/assets/plugins/data-tables/datatables.bootstrap4.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('resources/dashboard_files/assets/css/sleek.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content">
            {{-- ============================================== --}}
            {{-- ================== Header ==================== --}}
            {{-- ============================================== --}}
            <div class="breadcrumb-wrapper breadcrumb-contacts">
                <div>
                    <h1> اضافة رصيد </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحة التحكم
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.users-index') }}">
                                    <span class="fa fa-th"></span> المستخدمين
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page"> اضافة رصيد </li>
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
                                        <form id="createForm" action="{{ route('super_admin.users-addMembershipRequest',$user->id) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-row">

                                                {{-- اسم المستخدم --}}
                                                <div class="col-md-6">
                                                    <label class="text-dark font-weight-medium mb-3" for="number_days_ad">
                                                        اسم المستخدم : <strong class="text-danger">

                                                            @error('number_days_ad')
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
                                                        <input type="text" min="0" readonly class="form-control"
                                                            value="{{ $user->name }}">
                                                    </div>
                                                </div>



                                                {{-- نوع العضويه --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="premium_membership_id">نوع
                                                        العضويه : <strong class="text-danger"> *
                                                            @error('premium_membership_id')
                                                                {{ $message }}
                                                            @enderror
                                                        </strong></label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-account-check"></span>
                                                        </div>
                                                        <select name="premium_membership_id"
                                                            class="custom-select my-1 mr-sm-2 content-creator @error('premium_membership_id') is-invalid @enderror"
                                                            id="user_type">
                                                            <option value="" selected>نوع العضويه...</option>

                                                            @if (isset($premium_memberships) && $premium_memberships->count() > 0)
                                                                @foreach ($premium_memberships as $premium_membership)
                                                                    <option value="{{ $premium_membership->id }}"
                                                                        @if (old('premium_membership_id') != null) @if (old('premium_membership_id') == $premium_membership->id) selected @endif
                                                                        @endif>

                                                                        {{ isset($premium_membership->name_ar) ? $premium_membership->name_ar : '------' }}

                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
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



    </div>
@endsection
@section('admin_javascript')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
@endsection
