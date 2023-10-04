<script src="{{ asset('style_files/backend/plugins/jquery/jquery.js') }}"></script>
<script src="{{ asset('style_files/backend/plugins/slimscrollbar/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('style_files/backend/plugins/jekyll-search.min.js') }}"></script>



{{-- <script src="{{ asset('resources/style_files/backend/plugins/ladda/spin.min.js') }}"></script>
<script src="{{ asset('resources/style_files/backend/plugins/ladda/ladda.min.js') }}"></script> --}}

<script src="{{ asset('style_files/backend/plugins/ckeditor/ckeditor.js') }}"></script>

<script src="{{ asset('style_files/backend/plugins/charts/Chart.min.js') }}"></script>

{{-- ================================================================== --}}
{{-- =============== Start Code Mirror (Editor) Section =============== --}}
{{-- ================================================================== --}}
<script src="{{ asset('style_files/shared/plugin/codemirror-5.62.2/lib/codemirror.js') }}"></script>
<script src="{{ asset('style_files/shared/plugin/codemirror-5.62.2/mode/xml/xml.js') }}"></script>
<script src="{{ asset('style_files/shared/plugin/codemirror-5.62.2/addon/display/fullscreen.js') }}"></script>
{{-- ================================================================== --}}
{{-- ================ End Code Mirror (Editor) Section ================ --}}
{{-- ================================================================== --}}

<script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
{{-- <script src="{{ asset('resources/style_files/backend/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js') }}"></script> --}}
{{-- <script src="{{ asset('resources/style_files/backend/plugins/jvectormap/jquery-jvectormap-world-mill.js') }}"></script> --}}



{{-- <script src="{{ asset('resources/style_files/backend/plugins/daterangepicker/moment.min.js') }}"></script> --}}
{{-- <script src="{{ asset('resources/style_files/backend/plugins/daterangepicker/daterangepicker.js') }}"></script> --}}
{{-- <script>
    jQuery(document).ready(function() {
        jQuery('input[name="dateRange"]').daterangepicker({
            autoUpdateInput: false,
            singleDatePicker: true,
            locale: {
                cancelLabel: 'Clear'
            }
        });
        jQuery('input[name="dateRange"]').on('apply.daterangepicker', function(ev, picker) {
            jQuery(this).val(picker.startDate.format('MM/DD/YYYY'));
        });
        jQuery('input[name="dateRange"]').on('cancel.daterangepicker', function(ev, picker) {
            jQuery(this).val('');
        });
    });

</script> --}}



{{-- <script src="{{ asset('resources/style_files/backend/plugins/toastr/toastr.min.js') }}"></script> --}}

{{-- Extra JS : --}}
@yield('admin_javascript')
{{-- ========================================================== --}}
{{-- =============== Live Select Search Section =============== --}}
{{-- ========================================================== --}}
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<!-- (Optional) Latest compiled and minified JavaScript translation files -->
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script> --}}
{{-- ========================================================== --}}
{{-- =============== Live Select Search Section =============== --}}
{{-- ========================================================== --}}



<script src="{{ asset('style_files/shared/js/custom.js') }}"></script>

<script src="{{ asset('style_files/backend/js/sleek.bundle.js') }}"></script>

{{-- ========================================================== --}}
{{-- =============== Live Select Search Section =============== --}}
{{-- ========================================================== --}}
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<!-- (Optional) Latest compiled and minified JavaScript translation files -->
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script> --}}
{{-- ========================================================== --}}
{{-- =============== Live Select Search Section =============== --}}
{{-- ========================================================== --}}

</body>

</html>
