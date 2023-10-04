@extends('admin.layouts.app')

@section('content')
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
    <div class="row">
        {{-- المستخدمين --}}
        <div class="col-md-4">
            <div class="card card-mini mb-4">
                <div class="card-body text-center">
                    <div class="col-md-12">
                        <div class="row"
                            style="border:solid 1px black; border-radius:10px; background-color:rgb(243, 243, 243);">
                            <div class="col-md-12 p-2">
                                <h2 class="mb-1">
                                    ( {{ isset($users) ? $users->count() : 0 }} )
                                </h2>
                                <br>
                                <h5 class="mb-2">
                                    <a href="{{ route('super_admin.users-index') }}" style="color:blue;">
                                        المستخدمين</a>
                                </h5>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- الاعلانات --}}
        <div class="col-md-4">
            <div class="card card-mini mb-4">
                <div class="card-body text-center">
                    <div class="col-md-12">
                        <div class="row"
                            style="border:solid 1px black; border-radius:10px; background-color:rgb(243, 243, 243);">
                            <div class="col-md-12 p-2">
                                <h2 class="mb-1">
                                    ( {{ isset($advertisements) ? $advertisements->count() : 0 }} )
                                </h2>
                                <br>
                                <h5 class="mb-2">
                                    <a href="{{ route('super_admin.advertisements-index') }}" style="color:blue;">
                                        الاعلانات</a>
                                </h5>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
         {{--  عمليات الدفع  --}}
         <div class="col-md-4">
            <div class="card card-mini mb-4">
                <div class="card-body text-center">
                    <div class="col-md-12">
                        <div class="row"
                            style="border:solid 1px black; border-radius:10px; background-color:rgb(243, 243, 243);">
                            <div class="col-md-12 p-2">
                                <h2 class="mb-1">
                                    ( {{ isset($payment_transactions) ? $payment_transactions->count() : 0 }} )
                                </h2>
                                <br>
                                <h5 class="mb-2">
                                    <a href="{{ route('super_admin.payment_transactions-index') }}" style="color:blue;">
                                        عمليات الدفع </a>
                                </h5>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- البريد الوارد  --}}
        <div class="col-md-4">
            <div class="card card-mini mb-4">
                <div class="card-body text-center">
                    <div class="col-md-12">
                        <div class="row"
                            style="border:solid 1px black; border-radius:10px; background-color:rgb(243, 243, 243);">
                            <div class="col-md-12 p-2">
                                <h2 class="mb-1">
                                    (
                                    {{ isset(Auth::guard('super_admin')->user()->mailReceiver)? Auth::guard('super_admin')->user()->mailReceiver->count(): 0 }}
                                    )
                                </h2>
                                <br>
                                <h5 class="mb-2">
                                    <a href="{{ route('super_admin.internal_mails-inbox') }}" style="color:blue;">
                                        البريد الوارد </a>
                                </h5>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- البريد الصادر  --}}
        <div class="col-md-4">
            <div class="card card-mini mb-4">
                <div class="card-body text-center">
                    <div class="col-md-12">
                        <div class="row"
                            style="border:solid 1px black; border-radius:10px; background-color:rgb(243, 243, 243);">
                            <div class="col-md-12 p-2">
                                <h2 class="mb-1">
                                    (
                                    {{ isset(Auth::guard('super_admin')->user()->mailSender)? Auth::guard('super_admin')->user()->mailSender->count(): 0 }}
                                    )
                                </h2>
                                <br>
                                <h5 class="mb-2">
                                    <a href="{{ route('super_admin.internal_mails-outgoing') }}" style="color:blue;">
                                        البريد الصادر </a>
                                </h5>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- الوظائف --}}
        <div class="col-md-4">
            <div class="card card-mini mb-4">
                <div class="card-body text-center">
                    <div class="col-md-12">
                        <div class="row"
                            style="border:solid 1px black; border-radius:10px; background-color:rgb(243, 243, 243);">
                            <div class="col-md-12 p-2">
                                <h2 class="mb-1">
                                    ( {{ isset($jobs) ? $jobs->count() : 0 }} )
                                </h2>
                                <br>
                                <h5 class="mb-2">
                                    <a href="{{ route('super_admin.jobs-index') }}" style="color:blue;">
                                        الوظائف</a>
                                </h5>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- العضويات المميزة  --}}
        <div class="col-md-4">
            <div class="card card-mini mb-4">
                <div class="card-body text-center">
                    <div class="col-md-12">
                        <div class="row"
                            style="border:solid 1px black; border-radius:10px; background-color:rgb(243, 243, 243);">
                            <div class="col-md-12 p-2">
                                <h2 class="mb-1">
                                    ( {{ isset($memberships) ? $memberships->count() : 0 }} )
                                </h2>
                                <br>
                                <h5 class="mb-2">
                                    <a href="{{ route('super_admin.premiumMemberships-index') }}" style="color:blue;">
                                        العضويات المميزة </a>
                                </h5>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--  مستخدمين العضويات المميزة   --}}
        <div class="col-md-4">
            <div class="card card-mini mb-4">
                <div class="card-body text-center">
                    <div class="col-md-12">
                        <div class="row"
                            style="border:solid 1px black; border-radius:10px; background-color:rgb(243, 243, 243);">
                            <div class="col-md-12 p-2">
                                <h2 class="mb-1">
                                    ( {{ isset($user_memberships) ? $user_memberships->count() : 0 }} )
                                </h2>
                                <br>
                                <h5 class="mb-2">
                                    <a href="{{ route('super_admin.user_membership-index') }}" style="color:blue;">
                                        مستخدمين العضويات المميزة </a>
                                </h5>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{--  التصنيفات الرئيسية  --}}
        <div class="col-md-4">
            <div class="card card-mini mb-4">
                <div class="card-body text-center">
                    <div class="col-md-12">
                        <div class="row"
                            style="border:solid 1px black; border-radius:10px; background-color:rgb(243, 243, 243);">
                            <div class="col-md-12 p-2">
                                <h2 class="mb-1">
                                    ( {{ isset($categories) ? $categories->count() : 0 }} )
                                </h2>
                                <br>
                                <h5 class="mb-2">
                                    <a href="{{ route('super_admin.categories-index') }}" style="color:blue;">
                                        التصنيفات الرئيسية </a>
                                </h5>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>



        {{--  التصنيفات الفرعية  --}}
        <div class="col-md-4">
            <div class="card card-mini mb-4">
                <div class="card-body text-center">
                    <div class="col-md-12">
                        <div class="row"
                            style="border:solid 1px black; border-radius:10px; background-color:rgb(243, 243, 243);">
                            <div class="col-md-12 p-2">
                                <h2 class="mb-1">
                                    ( {{ isset($subCategories) ? $subCategories->count() : 0 }} )
                                </h2>
                                <br>
                                <h5 class="mb-2">
                                    <a href="{{ route('super_admin.sub_categories-index') }}" style="color:blue;">
                                        التصنيفات الفرعية </a>
                                </h5>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- المميزات --}}
        <div class="col-md-4">
            <div class="card card-mini mb-4">
                <div class="card-body text-center">
                    <div class="col-md-12">
                        <div class="row"
                            style="border:solid 1px black; border-radius:10px; background-color:rgb(243, 243, 243);">
                            <div class="col-md-12 p-2">
                                <h2 class="mb-1">
                                    ( {{ isset($features) ? $features->count() : 0 }} )
                                </h2>
                                <br>
                                <h5 class="mb-2">
                                    <a href="{{ route('super_admin.features-index') }}" style="color:blue;">
                                        المميزات</a>
                                </h5>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


         {{-- الدول --}}
         <div class="col-md-4">
            <div class="card card-mini mb-4">
                <div class="card-body text-center">
                    <div class="col-md-12">
                        <div class="row"
                            style="border:solid 1px black; border-radius:10px; background-color:rgb(243, 243, 243);">
                            <div class="col-md-12 p-2">
                                <h2 class="mb-1">
                                    ( {{ isset($diyarnaa_countries) ? $diyarnaa_countries->count() : 0 }} )
                                </h2>
                                <br>
                                <h5 class="mb-2">
                                    <a href="{{ route('super_admin.diyarnaa_countries-index') }}" style="color:blue;">
                                        الدول</a>
                                </h5>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
