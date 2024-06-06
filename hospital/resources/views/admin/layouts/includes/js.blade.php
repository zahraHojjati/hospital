<!-- Back to top -->
<a href="#top" id="back-to-top"><span class="feather feather-chevrons-up"></span></a>

<!-- Jquery js-->
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>

<!--Moment js-->
<script src="{{asset('assets/plugins/moment/moment.js')}}"></script>

<!-- Bootstrap4 js-->
<script src="{{asset('assets/plugins/bootstrap/popper.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

<!--Othercharts js-->
<script src="{{asset('assets/plugins/othercharts/jquery.sparkline.min.js')}}"></script>

<!--Sidemenu js-->
<script src="{{asset('assets/plugins/sidemenu/sidemenu.js')}}"></script>

<!-- P-scroll js-->
<script src="{{asset('assets/plugins/p-scrollbar/p-scrollbar.js')}}"></script>
<script src="{{asset('assets/plugins/p-scrollbar/p-scroll1.js')}}"></script>

<!--Sidebar js-->
<script src="{{asset('assets/plugins/sidebar/sidebar.js')}}"></script>

<!-- Select2 js -->
<script src="{{asset('assets/plugins/select2/select2.full.min.js')}}"></script>

<!-- INTERNAL Peitychart js-->
<script src="{{asset('assets/plugins/peitychart/jquery.peity.min.js')}}"></script>
<script src="{{asset('assets/plugins/peitychart/peitychart.init.js')}}"></script>

<!-- INTERNAL Apexchart js-->
<script src="{{asset('assets/plugins/apexchart/apexcharts.js')}}"></script>

<!-- INTERNAL Vertical-scroll js-->
<script src="{{asset('assets/plugins/vertical-scroll/jquery.bootstrap.newsbox.js')}}"></script>
<script src="{{asset('assets/plugins/vertical-scroll/vertical-scroll.js')}}"></script>

<!-- INTERNAL  Datepicker js -->
<script src="{{asset('assets/plugins/date-picker/jquery-ui.js')}}"></script>

<!-- INTERNAL Chart js -->
<script src="{{asset('assets/plugins/chart/chart.bundle.js')}}"></script>
<script src="{{asset('assets/plugins/chart/utils.js')}}"></script>

<!-- INTERNAL Timepicker js -->
<script src="{{asset('assets/plugins/time-picker/jquery.timepicker.js')}}"></script>
<script src="{{asset('assets/plugins/time-picker/toggles.min.js')}}"></script>

<!-- INTERNAL Chartjs rounded-barchart -->
<script src="{{asset('assets/plugins/chart.min/chart.min.js')}}"></script>
<script src="{{asset('assets/plugins/chart.min/rounded-barchart.js')}}"></script>

<!-- INTERNAL jQuery-countdowntimer js -->
<script src="{{asset('assets/plugins/jQuery-countdowntimer/jQuery.countdownTimer.js')}}"></script>

<!-- INTERNAL Index js-->
<script src="{{asset('assets/js/index1.js')}}"></script>

<!-- Custom js-->
<script src="{{asset('assets/js/custom.js')}}"></script>

<!-- PersianDateTimePicker js -->
<script
    src="{{ asset('assets/MD.BootstrapPersianDateTimePicker-master-bs4/src/jquery.md.bootstrap.datetimepicker.js') }}"
    type="text/javascript"></script>

<!--select2-->
{{--<link href="{{ asset('assets/plugins/select2/select2.full.min.js') }}" rel="stylesheet"/>--}}

<!--select2-->
        <script src="{{asset('dist/select2.min.js')}}"></script>

<!--select2 by cdn-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

{{--sweet alert--}}
<script src="{{ asset('assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>

{{--sortable--}}
<script src="{{ asset('assets/js/sortable.js') }}"></script>


<!-- INTERNAL Notifications js -->
{{--                <script src="{{asset('assets/plugins/notify/js/rainbow.js')}}"></script>--}}
{{--                <script src="{{asset('assets/plugins/notify/js/sample.js')}}"></script>--}}
{{--                <script src="{{asset('assets/plugins/notify/js/jquery.growl.js')}}"></script>--}}
{{--                <script src="{{asset('assets/plugins/notify/js/notifIt-rtl.js')}}"></script>--}}

{{--               <script https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js></script>--}}


@yield('scripts')

<script src="{{asset('assets/js/main.js')}}"></script>
