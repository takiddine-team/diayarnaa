@extends('layouts.app')
@section('content')
    {{-- =========================================================== --}}
    {{-- ================== Sweet Alert Section ==================== --}}
    {{-- =========================================================== --}}
    <div>
        @if (session()->has('success'))
            <script>
                swal("@lang('front.Thank')", "{!! Session::get('success') !!}", "success", {
                    button: "OK",
                });
            </script>
        @endif
        @if (session()->has('danger'))
            <script>
                swal("@lang('front.Sorry')", "{!! Session::get('danger') !!}", "error", {
                    button: "Close",
                });
            </script>
        @endif
    </div>

    <div class="innerPage">
        {{-- =========================================================== --}}
        {{-- =================== Breadcrumb Section ==================== --}}
        {{-- =========================================================== --}}
        <section class="innerImage aboutUs">

            @if (isset($background_image->term_condition) &&
                    $background_image->getRawOriginal('term_condition') &&
                    file_exists($background_image->getRawOriginal('term_condition')))
                <img src="{{ asset($background_image->term_condition) }}" alt="img">
            @else
                <img src="{{ asset('style_files/frontend/img/inner1.png') }}" alt="img">
            @endif
            <div class="pageTitle">
                <h2>
                    @if (Config::get('app.locale') == 'ar')
                        الشروط والأحكام
                    @elseif (Config::get('app.locale') == 'en')
                        Terms and Conditions
                    @endif
                </h2>
            </div>
        </section>


        {{-- =========================================================== --}}
        {{-- =================== page wrapper =============== --}}
        {{-- =========================================================== --}}
        <div class="page_wrapper">
            <div class="bredCramb">
                <a href="{{ route('welcome') }}">
                    @if (Config::get('app.locale') == 'ar')
                        الرئيسية
                    @elseif (Config::get('app.locale') == 'en')
                        Welcome
                    @endif
                </a>
                <span class="enflip"> >> </span> <span>
                    @if (Config::get('app.locale') == 'ar')
                        الشروط والأحكام
                    @elseif (Config::get('app.locale') == 'en')
                        Terms and Conditions
                    @endif
                </span>
            </div>

            {{-- =========================================================== --}}
            {{-- =================== terms and condition  section =============== --}}
            {{-- =========================================================== --}}
            <section class="termCondition">
                <div class="container">
                    <div class="row">
                        @if (isset($terms_and_conditions) && $terms_and_conditions->count() > 0)
                            @foreach ($terms_and_conditions as $terms_and_condition)
                                <div class="col-12 mb-5 bShadow">
                                    <h2>
                                        @if (Config::get('app.locale') == 'ar')
                                            {!! isset($terms_and_condition->term_title_ar) ? $terms_and_condition->term_title_ar : null !!}
                                        @elseif (Config::get('app.locale') == 'en')
                                            {!! isset($terms_and_condition->term_title_en) ? $terms_and_condition->term_title_en : null !!}
                                        @endif
                                    </h2>
                                    <div class="termConditionList">
                                        @if (Config::get('app.locale') == 'ar')
                                            {!! isset($terms_and_condition->term_description_ar) ? $terms_and_condition->term_description_ar : null !!}
                                        @elseif (Config::get('app.locale') == 'en')
                                            {!! isset($terms_and_condition->term_description_en) ? $terms_and_condition->term_description_en : null !!}
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-12 mb-5 bShadow">
                                <h2>

                                    @lang('front.Acceptance')

                                </h2>
                                <ul class="termConditionList">
                                    <li>@lang('front.TermsPart1')</li>
                                    <li>@lang('front.FeesForSubScription') </li>
                                    <li>@lang('front.FeesForUs')</li>
                                    <li> @lang('front.acceptTermAndCondition') </li>
                                    <li>@lang('front.responsabilityTerms') </li>
                                    <li>@lang('front.AcceptanceSite') </li>
                                    <li>@lang('front.SiteChangesTermsOnIt')</li>
                                </ul>
                            </div>
                            <div class="col-12 mb-5 bShadow">
                                <h2>@lang('front.DescriptionOfTheServiceForThePropertyOwner')</h2>
                                <ul class="termConditionList">
                                    <li>@lang('front.SiteStore')</li>
                                    <li>@lang('front.OwnerInfoForTermAndConditions')</li>
                                </ul>
                            </div>
                            <div class="col-12 mb-5 bShadow">
                                <h2> @lang('front.termsAndConitionEsateService')</h2>
                                <ul class="termConditionList">
                                    <li>@lang('front.EstateTermsOFconditionsList')</li>
                                </ul>
                            </div>
                            <div class="col-12 mb-5 bShadow">
                                <h2>@lang('front.DescriptionSearcherTermsAndConditioins')</h2>
                                <ul class="termConditionList">
                                    <li>@lang('front.SearcherTermsAndConditionsOnly')</li>
                                    <li>@lang('front.TermsConRules')</li>
                                </ul>
                            </div>
                            <div class="col-12 mb-5 bShadow">
                                <h2>@lang('front.ContentPolicy') </h2>
                                <ul class="termConditionList">
                                    <li>@lang('front.KnowledgmentTermsAndConditions')</li>
                                    <li>@lang('front.CheckYourContent')</li>
                                    <li>@lang('fornt.YouAcknowledgeAndAgree')</li>
                                    <li>@lang('front.YouGrantEachUser')</li>
                                    <li> @lang('front.TheSiteIsNotResponsible')</li>
                                    <li>@lang('front.InfringementsOrInTheEvent')</li>
                                </ul>
                            </div>
                            <div class="col-12 mb-5 bShadow">
                                <h2>@lang('front.SliderAds')</h2>
                                <ul class="termConditionList">
                                    <li>@lang('front.SliderAds2')</li>
                                    <li>@lang('front.SldierAds3')</li>
                                </ul>
                            </div>
                            <div class="col-12 mb-5 bShadow">
                                <h2> @lang('front.YourResponsibility') </h2>
                                <ul class="termConditionList">
                                    <li>@lang('front.TermsServiceProvider')</li>
                                    <li>@lang('front.WeDontShare')</li>
                                    <li>@lang('front.ShareResponsabilityTerms')</li>
                                    <li>@lang('front.IllegalContentAcknowledgement')</li>
                                    <li>@lang('front.ResponsibleForCheckingAndConfirming')</li>
                                    <li>@lang('front.UpdatingRealEstateAdsToComply')</li>
                                    <li>@lang('front.TermsOfUseInSoAllModifications')</li>
                                    <li>@lang('front.LawConditions')</li>
                                </ul>
                            </div>
                            <div class="col-12 mb-5 bShadow">
                                <h2>@lang('front.EditTermsAndConditions')</h2>
                                <ul class="termConditionList">
                                    <li>@lang('front.ByUsingThisWebsite')</li>
                                </ul>
                            </div>
                            <div class="col-12 mb-5 bShadow">
                                <h2> @lang('front.intellectualProperty') </h2>
                                <ul class="termConditionList">
                                    <li>@lang('front.UnlessExpresslyStatedOtherwise')</li>
                                    <li>@lang('front.WeAndOurLicensorsReserve')</li>
                                    <li>@lang('front.AnyUseOfThisSite')</li>
                                    <li>@lang('front.TheNamesLogosAndAll')</li>
                                </ul>
                            </div>

                            <div class="col-12 mb-5 bShadow">
                                <h2> @lang('front.SpamTermsAndConditions')</h2>
                                <ul class="termConditionList">
                                    <li>@lang('front.SpamTermsAndConditions2')</li>
                                </ul>
                            </div>

                            <div class="col-12 mb-5 bShadow">
                                <h2>@lang('front.warrantyDisclaimer')</h2>
                                <ul class="termConditionList">
                                    <li>@lang('front.warrantyDisclaimer2')</li>

                                </ul>
                            </div>
                            <div class="col-12 mb-5 bShadow">
                                <h2>@lang('front.limitOfLiability')</h2>
                                <ul class="termConditionList">
                                    <li>@lang('front.limitOfLiability2')</li>
                                </ul>
                            </div>
                            <div class="col-12 mb-5 bShadow">
                                <h2> @lang('front.ViolationOfTermsAndCompensation') </h2>
                                <ul class="termConditionList">
                                    <li>@lang('front.ViolationOfTermsAndCompensation2')</li>
                                </ul>
                            </div>
                        @endif

                    </div>
                </div>
            </section>
        </div>

    </div>
@endsection
