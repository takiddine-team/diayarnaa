@extends('admin.layouts.app')

@section('admin_css')
    <link href="{{ asset('dashboard_files/assets/plugins/data-tables/datatables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard_files/assets/css/sleek.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content">
            {{-- ============================================== --}}
            {{-- ================== Header ==================== --}}
            {{-- ============================================== --}}
            <div class="breadcrumb-wrapper breadcrumb-contacts">
                <div class="col-md-12">
                    <h1>تعديل</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> لوحه التحكم
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.background_images-index') }}">
                                    <i class="fas fa-users-cog"></i> صور ترويسة الصفحات
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">تعديل</li>
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
                                        <form
                                            action="{{ route('super_admin.background_images-update', isset($background_image->id) ? $background_image->id : -1) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-row">


                                                {{--صفحة وساطة الموقع --}}
                                                <div class="col-md-6 mb-6">
                                                    <h3 class="mb-3" for="website_broker">صفحة وساطة الموقع  : ( 1519 × 440 )</h3>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-cloud-upload"></span>
                                                        </div>
                                                        <input type="file" name="website_broker"
                                                            class="form-control" id="website_broker"
                                                            placeholder="website_broker">
                                                    </div>

                                                    @error('website_broker')
                                                        <h4 class="form-text text-danger"> - {{ $message }}</h4>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-6">
                                                    @if (isset($background_image->website_broker) &&
                                                            $background_image->getRawOriginal('website_broker') &&
                                                            file_exists($background_image->getRawOriginal('website_broker')))
                                                        <img src="{{ asset($background_image->website_broker) }}"
                                                            width="100" height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @else
                                                        <img src="{{ asset('images_default/default.png') }}" width="100"
                                                            height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @endif

                                                </div>

                                                {{--   صفحة شكاوى     --}}
                                                <div class="col-md-6 mb-6">
                                                    <h3 class="mb-3" for="complaint"> صفحة شكاوى  : ( 1519 × 440 )</h3>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-cloud-upload"></span>
                                                        </div>
                                                        <input type="file" name="complaint"
                                                            class="form-control" id="complaint"
                                                            placeholder="complaint">
                                                    </div>

                                                    @error('complaint')
                                                        <h4 class="form-text text-danger"> - {{ $message }}</h4>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-6">
                                                    @if (isset($background_image->complaint) &&
                                                            $background_image->getRawOriginal('complaint') &&
                                                            file_exists($background_image->getRawOriginal('complaint')))
                                                        <img src="{{ asset($background_image->complaint) }}"
                                                            width="100" height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @else
                                                        <img src="{{ asset('images_default/default.png') }}" width="100"
                                                            height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @endif

                                                </div>



                                                {{--   صفحة الوظائف    --}}
                                                <div class="col-md-6 mb-6">
                                                    <h3 class="mb-3" for="job">صفحة الوظائف  : ( 1519 × 440 )</h3>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-cloud-upload"></span>
                                                        </div>
                                                        <input type="file" name="job"
                                                            class="form-control" id="job"
                                                            placeholder="job">
                                                    </div>

                                                    @error('job')
                                                        <h4 class="form-text text-danger"> - {{ $message }}</h4>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-6">
                                                    @if (isset($background_image->job) &&
                                                            $background_image->getRawOriginal('job') &&
                                                            file_exists($background_image->getRawOriginal('job')))
                                                        <img src="{{ asset($background_image->job) }}"
                                                            width="100" height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @else
                                                        <img src="{{ asset('images_default/default.png') }}" width="100"
                                                            height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @endif

                                                </div>



                                                {{--   صفحة  الاحكام والشروط    --}}
                                                <div class="col-md-6 mb-6">
                                                    <h3 class="mb-3" for="job">صفحة  الاحكام والشروط  : ( 1519 × 440 ) </h3>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-cloud-upload"></span>
                                                        </div>
                                                        <input type="file" name="term_condition"
                                                            class="form-control" id="term_condition"
                                                            placeholder="term_condition">
                                                    </div>

                                                    @error('job')
                                                        <h4 class="form-text text-danger"> - {{ $message }}</h4>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-6">
                                                    @if (isset($background_image->term_condition) &&
                                                            $background_image->getRawOriginal('term_condition') &&
                                                            file_exists($background_image->getRawOriginal('term_condition')))
                                                        <img src="{{ asset($background_image->term_condition) }}"
                                                            width="100" height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @else
                                                        <img src="{{ asset('images_default/default.png') }}"
                                                            width="100" height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @endif

                                                </div>




                                                {{--   صفحة سياسة الخصوصية    --}}
                                                <div class="col-md-6 mb-6">
                                                    <h3 class="mb-3" for="privacy_policy"> صفحة سياسة الخصوصية : ( 1519 × 440 ) </h3>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-cloud-upload"></span>
                                                        </div>
                                                        <input type="file" name="privacy_policy"
                                                            class="form-control" id="privacy_policy"
                                                            placeholder="privacy_policy">
                                                    </div>

                                                    @error('privacy_policy')
                                                        <h4 class="form-text text-danger"> - {{ $message }}</h4>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-6">
                                                    @if (isset($background_image->privacy_policy) &&
                                                            $background_image->getRawOriginal('privacy_policy') &&
                                                            file_exists($background_image->getRawOriginal('privacy_policy')))
                                                        <img src="{{ asset($background_image->privacy_policy) }}"
                                                            width="100" height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @else
                                                        <img src="{{ asset('images_default/default.png') }}"
                                                            width="100" height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @endif

                                                </div>




                                                {{--   صفحة تفاصيل العقار    --}}
                                                <div class="col-md-6 mb-6">
                                                    <h3 class="mb-3" for="advertisement_details">صفحة تفاصيل العقار  : ( 1519 × 440 ) </h3>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-cloud-upload"></span>
                                                        </div>
                                                        <input type="file" name="advertisement_details"
                                                            class="form-control" id="advertisement_details"
                                                            placeholder="advertisement_details">
                                                    </div>

                                                    @error('advertisement_details')
                                                        <h4 class="form-text text-danger"> - {{ $message }}</h4>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-6">
                                                    @if (isset($background_image->advertisement_details) &&
                                                            $background_image->getRawOriginal('advertisement_details') &&
                                                            file_exists($background_image->getRawOriginal('advertisement_details')))
                                                        <img src="{{ asset($background_image->advertisement_details) }}"
                                                            width="100" height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @else
                                                        <img src="{{ asset('images_default/default.png') }}"
                                                            width="100" height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @endif

                                                </div>



                                                {{--    صفحة حساب المستخدم   --}}
                                                <div class="col-md-6 mb-6">
                                                    <h3 class="mb-3" for="user_dashboard"> صفحة حساب المستخدم : ( 1519 × 440 ) </h3>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-cloud-upload"></span>
                                                        </div>
                                                        <input type="file" name="user_dashboard"
                                                            class="form-control" id="user_dashboard"
                                                            placeholder="user_dashboard">
                                                    </div>

                                                    @error('user_dashboard')
                                                        <h4 class="form-text text-danger"> - {{ $message }}</h4>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-6">
                                                    @if (isset($background_image->user_dashboard) &&
                                                            $background_image->getRawOriginal('user_dashboard') &&
                                                            file_exists($background_image->getRawOriginal('user_dashboard')))
                                                        <img src="{{ asset($background_image->user_dashboard) }}"
                                                            width="100" height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @else
                                                        <img src="{{ asset('images_default/default.png') }}"
                                                            width="100" height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @endif

                                                </div>



                                                {{--   صفحة إنشاء حساب    --}}
                                                <div class="col-md-6 mb-6">
                                                    <h3 class="mb-3" for="user_signup">صفحة إنشاء حساب  : ( 1519 × 440 ) </h3>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-cloud-upload"></span>
                                                        </div>
                                                        <input type="file" name="user_signup"
                                                            class="form-control" id="user_signup"
                                                            placeholder="user_signup">
                                                    </div>

                                                    @error('user_signup')
                                                        <h4 class="form-text text-danger"> - {{ $message }}</h4>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-6">
                                                    @if (isset($background_image->user_signup) &&
                                                            $background_image->getRawOriginal('user_signup') &&
                                                            file_exists($background_image->getRawOriginal('user_signup')))
                                                        <img src="{{ asset($background_image->user_signup) }}"
                                                            width="100" height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @else
                                                        <img src="{{ asset('images_default/default.png') }}"
                                                            width="100" height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @endif

                                                </div>




                                                {{--   صفحة تسجيل الدخول    --}}
                                                <div class="col-md-6 mb-6">
                                                    <h3 class="mb-3" for="user_login">صفحة تسجيل الدخول  : ( 1519 × 440 ) </h3>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-cloud-upload"></span>
                                                        </div>
                                                        
                                                        <input type="file" name="user_login"
                                                            class="form-control" id="user_login"
                                                            placeholder="user_login">
                                                    </div>

                                                    @error('user_login')
                                                        <h4 class="form-text text-danger"> - {{ $message }}</h4>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-6">
                                                    @if (isset($background_image->user_login) &&
                                                            $background_image->getRawOriginal('user_login') &&
                                                            file_exists($background_image->getRawOriginal('user_login')))
                                                        <img src="{{ asset($background_image->user_login) }}"
                                                            width="100" height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @else
                                                        <img src="{{ asset('images_default/default.png') }}"
                                                            width="100" height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @endif

                                                </div>









                                                  {{--  قسم اراء العملاء    --}}
                                                  <div class="col-md-6 mb-6">
                                                    <h3 class="mb-3" for="customer_opinion">  قسم اراء العملاء   : ( 1519 × 440 ) </h3>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-cloud-upload"></span>
                                                        </div>
                                                        
                                                        <input type="file" name="customer_opinion"
                                                            class="form-control" id="customer_opinion"
                                                            placeholder="customer_opinion">
                                                    </div>

                                                    @error('customer_opinion')
                                                        <h4 class="form-text text-danger"> - {{ $message }}</h4>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 mb-6">
                                                    @if (isset($background_image->customer_opinion) &&
                                                            $background_image->getRawOriginal('customer_opinion') &&
                                                            file_exists($background_image->getRawOriginal('customer_opinion')))
                                                        <img src="{{ asset($background_image->customer_opinion) }}"
                                                            width="100" height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @else
                                                        <img src="{{ asset('images_default/default.png') }}"
                                                            width="100" height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @endif

                                                </div>











                                            </div>
                                            <button class="btn btn-primary" type="submit">حفظ التعديلات</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
