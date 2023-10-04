<aside class="left-sidebar bg-sidebar">
    <div id="sidebar" class="sidebar">
        <!-- Aplication Brand -->
        <div class="app-brand">
            <a href="{{ route('super_admin.dashboard') }}" title="لوحه التحكم">
                <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" width="30"
                    height="33" viewBox="0 0 30 33">
                    <g fill="none" fill-rule="evenodd">
                        <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />
                        <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                    </g>
                </svg>
                <span class="brand-name text-truncate">diyarnaa </span>
            </a>
        </div>
        <!-- begin sidebar scrollbar -->
        <div class="sidebar-scrollbar">
            <ul class="nav sidebar-inner" id="sidebar-menu">
                {{-- =================================================== --}}
                {{-- ==================== لوحه التحكم ==================== --}}
                {{-- =================================================== --}}
                <li class="active">
                    <a class="sidenav-item-link" href="{{ route('super_admin.dashboard') }}">
                        <span class="nav-text" style="font-size: 10pt;">لوحه التحكم</span>
                    </a>
                </li>


                @if (Auth::guard('super_admin')->user()->type == 'Admin')
                    {{-- =================================================== --}}
                    {{-- ==================== الموظفين ==================== --}}
                    {{-- =================================================== --}}
                    <li class="active">
                        <a class="sidenav-item-link" href="{{ route('super_admin.employees-index') }}">
                            <span class="nav-text" style="font-size: 10pt;">الموظفين</span>
                        </a>
                    </li>
                @endif
                {{-- =================================================== --}}
                {{-- ==================== المستخدمين ==================== --}}
                {{-- =================================================== --}}
                <li class="active">
                    <a class="sidenav-item-link" href="{{ route('super_admin.users-index') }}">
                        <span class="nav-text" style="font-size: 10pt;">المستخدمين</span>
                    </a>
                </li>

                {{-- =================================================== --}}
                {{-- ==================== عمليات الدفع ==================== --}}
                {{-- =================================================== --}}
                <li class="active">
                    <a class="sidenav-item-link" href="{{ route('super_admin.payment_transactions-index') }}">
                        <span class="nav-text" style="font-size: 10pt;"> عمليات الدفع </span>
                    </a>
                </li>
                {{-- =================================================== --}}
                {{-- ==================== الاعلانات ==================== --}}
                {{-- =================================================== --}}
                <li class="active">
                    <a class="sidenav-item-link" href="{{ route('super_admin.advertisements-index') }}">
                        <span class="nav-text" style="font-size: 10pt;">الاعلانات</span>
                    </a>
                </li>
                {{-- =================================================== --}}
                {{-- ==================== الابحاث المضافة ==================== --}}
                {{-- =================================================== --}}
                <li class="active">
                    <a class="sidenav-item-link" href="{{ route('super_admin.searches-index') }}">
                        <span class="nav-text" style="font-size: 10pt;">الابحاث المضافة </span>
                    </a>
                </li>
                {{-- =================================================== --}}
                {{-- ==================== البريد ==================== --}}
                {{-- =================================================== --}}


                <li class="has-sub active expand">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                        data-target="#internal_mails" aria-expanded="false" aria-controls="internal_mails">
                        <span class="nav-text" style="font-size: 10pt;"> البريد الداخلي</span> <b class="caret"></b>

                    </a>

                    <ul class="collapse" id="internal_mails" data-parent="#sidebar-menu">
                        <div class="sub-menu">

                            {{-- ================================================== --}}
                            {{-- =====================   ارسال بريد  ==================== --}}
                            {{-- =================================================== --}}
                            <li class="active">
                                <a class="sidenav-item-link" href="{{ route('super_admin.internal_mails-sendEmail') }}">
                                    <span class="nav-text" style="font-size: 10pt;">ارسال بريد </span>
                                </a>
                            </li>
                            {{-- ================================================== --}}
                            {{-- =====================  البريد الوارد  ==================== --}}
                            {{-- =================================================== --}}
                            <li class="active">
                                <a class="sidenav-item-link" href="{{ route('super_admin.internal_mails-inbox') }}">
                                    <span class="nav-text" style="font-size: 10pt;">البريد الوارد</span>
                                </a>
                            </li>
                            {{-- ================================================== --}}
                            {{-- =====================  البريد الصادر  ==================== --}}
                            {{-- =================================================== --}}
                            <li class="active">
                                <a class="sidenav-item-link" href="{{ route('super_admin.internal_mails-outgoing') }}">
                                    <span class="nav-text" style="font-size: 10pt;"> البريد الصادر</span>
                                </a>
                            </li>


                        </div>
                    </ul>
                </li>

                {{-- =================================================== --}}
                {{-- ================= الوظائف ================= --}}
                {{-- =================================================== --}}
                <li class="has-sub active expand">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#jobs"
                        aria-expanded="false" aria-controls="jobs">
                        <span class="nav-text" style="font-size: 10pt;"> الوظائف </span> <b class="caret"></b>

                    </a>
                    <ul class="collapse" id="jobs" data-parent="#sidebar-menu">
                        <div class="sub-menu">
                            {{-- =================================================== --}}
                            {{-- ===================== الوظائف ==================== --}}
                            {{-- =================================================== --}}
                            <li class="active">
                                <a class="sidenav-item-link" href="{{ route('super_admin.jobs-index') }}">
                                    <span class="nav-text" style="font-size: 10pt;">الوظائف</span>
                                </a>
                            </li>

                            {{-- ================================================== --}}
                            {{-- =====================  طلبات التوظيف ==================== --}}
                            {{-- =================================================== --}}
                            <li class="active">
                                <a class="sidenav-item-link" href="{{ route('super_admin.job_requests-index') }}">
                                    <span class="nav-text" style="font-size: 10pt;">طلبات التوظيف</span>
                                </a>
                            </li>

                        </div>
                    </ul>
                </li>

                {{-- =================================================== --}}
                {{-- ================>العضويات المميزة    ================= --}}
                {{-- =================================================== --}}
                <li class="has-sub active expand">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                        data-target="#premiumMemberships" aria-expanded="false" aria-controls="premiumMemberships">
                        <span class="nav-text" style="font-size: 10pt;"> العضويات المميزة </span> <b
                            class="caret"></b>
                    </a>
                    <ul class="collapse" id="premiumMemberships" data-parent="#sidebar-menu">
                        <div class="sub-menu">



                            {{-- =================================================== --}}
                            {{-- ================= العضويات المميزة  ================= --}}
                            {{-- =================================================== --}}
                            <li class="active">
                                <a class="sidenav-item-link"
                                    href="{{ route('super_admin.premiumMemberships-index') }}">
                                    <span class="nav-text" style="font-size: 9pt;">العضويات المميزة </span>
                                </a>
                            </li>
                            {{-- =================================================== --}}
                            {{-- ================= ديزاين العضويات المميزة  ================= --}}
                            {{-- =================================================== --}}
                            <li class="active">
                                <a class="sidenav-item-link"
                                    href="{{ route('super_admin.premium_membership_pages-index') }}">
                                    <span class="nav-text" style="font-size: 9pt;">ديزاين العضويات المميزة </span>
                                </a>
                            </li>

                            {{-- =================================================== --}}
                            {{-- =================>مستخدمين العضويات المميزة ================= --}}
                            {{-- =================================================== --}}
                            <li class="active">
                                <a class="sidenav-item-link" href="{{ route('super_admin.user_membership-index') }}">
                                    <span class="nav-text" style="font-size: 9pt;">مستخدمين العضويات المميزة </span>
                                </a>
                            </li>


                        </div>
                    </ul>
                </li>
                {{-- ================================================== --}}
                {{-- ================> التصنيفات و الميزات    ================= --}}
                {{-- =================================================== --}}
                <li class="has-sub active expand">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                        data-target="#categories" aria-expanded="false" aria-controls="categories">
                        <span class="nav-text" style="font-size: 10pt;"> التصنيفات و المميزات </span> <b
                            class="caret"></b>
                    </a>
                    <ul class="collapse" id="categories" data-parent="#sidebar-menu">
                        <div class="sub-menu">

                            {{-- =================================================== --}}
                            {{-- ================= التصنيفات الرئيسية ================= --}}
                            {{-- =================================================== --}}
                            <li class="active">
                                <a class="sidenav-item-link" href="{{ route('super_admin.categories-index') }}">
                                    <span class="nav-text" style="font-size: 9pt;"> التصنيفات الرئيسية</span>
                                </a>
                            </li>
                            {{-- =================================================== --}}
                            {{-- =================  التصنيفات   الفرعية ================= --}}
                            {{-- =================================================== --}}
                            <li class="active">
                                <a class="sidenav-item-link" href="{{ route('super_admin.sub_categories-index') }}">
                                    <span class="nav-text" style="font-size: 9pt;"> التصنيفات الفرعية</span>
                                </a>
                            </li>



                            {{-- =================================================== --}}
                            {{-- ================= المميزات ================= --}}
                            {{-- =================================================== --}}
                            <li class="active">
                                <a class="sidenav-item-link" href="{{ route('super_admin.features-index') }}">
                                    <span class="nav-text" style="font-size: 9pt;"> المميزات</span>
                                </a>
                            </li>
                            {{-- =================================================== --}}
                            {{-- ================= ربط التصنيفات الفرعية والمميزات ================= --}}
                            {{-- =================================================== --}}
                            <li class="active">
                                <a class="sidenav-item-link"
                                    href="{{ route('super_admin.feature_type_sub_categories-index') }}">
                                    <span class="nav-text" style="font-size: 9pt;">ربط التصنيفات الفرعية والمميزات
                                    </span>
                                </a>
                            </li>




                        </div>
                    </ul>
                </li>
                {{-- =================================================== --}}
                {{-- ================إعدادات موقع الويب ================= --}}
                {{-- =================================================== --}}
                <li class="has-sub active expand">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                        data-target="#website_setting" aria-expanded="false" aria-controls="website_setting">
                        <span class="nav-text" style="font-size: 10pt;">إعدادات موقع الويب </span> <b
                            class="caret"></b>
                    </a>
                    <ul class="collapse" id="website_setting" data-parent="#sidebar-menu">
                        <div class="sub-menu">

                            {{-- =================================================== --}}
                            {{-- ================= Country ================= --}}
                            {{-- =================================================== --}}
                            <li class="active">
                                <a class="sidenav-item-link"
                                    href="{{ route('super_admin.diyarnaa_countries-index') }}">
                                    <span class="nav-text" style="font-size: 9pt;"> الدول</span>
                                </a>
                            </li>

                            {{-- =================================================== --}}
                            {{-- ================= Target ================= --}}
                            {{-- =================================================== --}}
                            <li class="active">
                                <a class="sidenav-item-link" href="{{ route('super_admin.targets-index') }}">
                                    <span class="nav-text" style="font-size: 9pt;"> الغرض</span>
                                </a>
                            </li>


                            {{-- =================================================== --}}
                            {{-- =================   سلايدر ================= --}}
                            {{-- =================================================== --}}
                            <li class="active">
                                <a class="sidenav-item-link" href="{{ route('super_admin.home_sliders-index') }}">
                                    <span class="nav-text" style="font-size: 9pt;"> سلايدر </span>
                                </a>
                            </li>
                            {{-- =================================================== --}}
                            {{-- =================   وسطاء المواقع ================= --}}
                            {{-- =================================================== --}}
                            <li class="active">
                                <a class="sidenav-item-link" href="{{ route('super_admin.website_brokers-index') }}">
                                    <span class="nav-text" style="font-size: 9pt;"> وسطاء الموقع </span>
                                </a>
                            </li>


                        </div>
                    </ul>
                </li>
                {{-- =================================================== --}}
                {{-- ================= تصميم موقع الويب================== --}}
                {{-- =================================================== --}}
                <li class="has-sub active expand">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                        data-target="#website_layout" aria-expanded="false" aria-controls="website_layout">
                        <span class="nav-text" style="font-size: 10pt;">تصميم موقع الويب</span> <b
                            class="caret"></b>
                    </a>
                    <ul class="collapse" id="website_layout" data-parent="#sidebar-menu">
                        <div class="sub-menu">

                            {{-- =================================================== --}}
                            {{-- ===================== Background Image ==================== --}}
                            {{-- =================================================== --}}
                            <li class="active">
                                <a class="sidenav-item-link"
                                    href="{{ route('super_admin.background_images-index') }}">
                                    <span class="nav-text" style="font-size: 10pt;"> صور ترويسة الصفحات </span>
                                </a>
                            </li>

                            {{-- =================================================== --}}
                            {{-- ===================== Abouts ==================== --}}
                            {{-- =================================================== --}}
                            <li class="active">
                                <a class="sidenav-item-link" href="{{ route('super_admin.abouts-index') }}">
                                    <span class="nav-text" style="font-size: 10pt;">من نحن </span>
                                </a>
                            </li>



                            {{-- =================================================== --}}
                            {{-- ===================== Contact Us ==================== --}}
                            {{-- =================================================== --}}
                            <li class="active">
                                <a class="sidenav-item-link" href="{{ route('super_admin.contact_us-index') }}">
                                    <span class="nav-text" style="font-size: 10pt;">اتصل بنا</span>
                                </a>
                            </li>


                            {{-- =================================================== --}}
                            {{-- ===================== Privacy Policy ==================== --}}
                            {{-- =================================================== --}}
                            <li class="active">
                                <a class="sidenav-item-link" href="{{ route('super_admin.privacy_policy-index') }}">
                                    <span class="nav-text" style="font-size: 10pt;"> سياسة الخصوصية</span>
                                </a>
                            </li>
                            {{-- =================================================== --}}
                            {{-- ===================== Terms and Conditions ==================== --}}
                            {{-- =================================================== --}}
                            <li class="active">
                                <a class="sidenav-item-link"
                                    href="{{ route('super_admin.terms_conditions-index') }}">
                                    <span class="nav-text" style="font-size: 10pt;"> الأحكام والشروط </span>
                                </a>
                            </li>

                            {{-- =================================================== --}}
                            {{-- ===================== NewsletterSubscribers ================== --}}
                            {{-- =================================================== --}}
                            <li class="active">
                                <a class="sidenav-item-link"
                                    href="{{ route('super_admin.newsletters-newsletterSubscribers') }}">
                                    <span class="nav-text" style="font-size: 9pt;">Newsletter Subscribers</span>
                                </a>
                            </li>


                        </div>
                    </ul>
                </li>
                {{-- =================================================== --}}
                {{-- ================= الطلبات ================= --}}
                {{-- =================================================== --}}
                <li class="has-sub active expand">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                        data-target="#Request" aria-expanded="false" aria-controls="Request">
                        <span class="nav-text" style="font-size: 10pt;"> الطلبات </span> <b class="caret"></b>

                    </a>
                    <ul class="collapse" id="Request" data-parent="#sidebar-menu">
                        <div class="sub-menu">
                            {{-- ================================================== --}}
                            {{-- ===================== Contact Us Request ==================== --}}
                            {{-- =================================================== --}}
                            <li class="active">
                                <a class="sidenav-item-link"
                                    href="{{ route('super_admin.contact_us_request-index') }}">
                                    <span class="nav-text" style="font-size: 10pt;">رسائل التواصل</span>
                                </a>
                            </li>

                            {{-- ================================================== --}}
                            {{-- ===================== طلبات تعديل الاعلان==================== --}}
                            {{-- =================================================== --}}
                            <li class="active">
                                <a class="sidenav-item-link"
                                    href="{{ route('super_admin.advertisement_edit_request-index') }}">
                                    <span class="nav-text" style="font-size: 10pt;"> طلبات تعديل الاعلان</span>
                                </a>
                            </li>
                            {{-- ================================================== --}}
                            {{-- =====================  الشكاوى ==================== --}}
                            {{-- =================================================== --}}
                            <li class="active">
                                <a class="sidenav-item-link" href="{{ route('super_admin.complaints-index') }}">
                                    <span class="nav-text" style="font-size: 10pt;">الشكاوى</span>
                                </a>
                            </li>
                            {{-- ================================================== --}}
                            {{-- =====================  اراء العملاء ==================== --}}
                            {{-- =================================================== --}}
                            <li class="active">
                                <a class="sidenav-item-link" href="{{ route('super_admin.opinions-index') }}">
                                    <span class="nav-text" style="font-size: 10pt;">اراء العملاء</span>
                                </a>
                            </li>


                        </div>
                    </ul>
                </li>
                {{-- =================================================== --}}
                {{-- ================  Admin Settings ================= --}}
                {{-- =================================================== --}}
                <li class="has-sub active expand">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                        data-target="#Admin_setting" aria-expanded="false" aria-controls="Admin_setting">
                        <span class="nav-text" style="font-size: 10pt;">إعدادات النظام </span> <b class="caret"></b>
                    </a>
                    <ul class="collapse" id="Admin_setting" data-parent="#sidebar-menu">
                        <div class="sub-menu">

                            {{-- =================================================== --}}
                            {{-- ================= Support Tickets ================= --}}
                            {{-- =================================================== --}}
                            <li class="active">
                                <a class="sidenav-item-link" href="{{ route('super_admin.support_tickets-index') }}">
                                    <span class="nav-text" style="font-size: 9pt;"> تذاكر الدعم الفني</span>
                                </a>
                            </li>

                            {{-- =================================================== --}}
                            {{-- ===================== Logout ====================== --}}
                            {{-- =================================================== --}}
                            <li class="active">
                                <a class="sidenav-item-link" href="{{ route('super_admin.support_tickets-index') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <span class="nav-text" style="font-size: 9pt;"> تسجيل خروج</span>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </a>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>

    </div>
</aside>
