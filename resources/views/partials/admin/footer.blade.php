<footer class="dash-footer">
    <div class="footer-wrapper">
        <div class="py-1">
            <span class="text-muted">{{__('Copyright')}} &copy; {{ (App\Models\Utility::getValByName('footer_text')) ? App\Models\Utility::getValByName('footer_text') :config('app.name', 'WorkGo') }} {{date('Y')}}</span>
        </div>
    </div>
</footer>

<script src="{{asset('custom/js/jquery.min.js')}}"></script>

<script src="{{asset('assets/js/plugins/popper.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/feather.min.js')}}"></script>
<script src="{{asset('assets/js/dash.js')}}"></script>

<!-- Page JS -->
<script src="{{ asset('custom/libs/dropzone/dist/min/dropzone.min.js')}}"></script>
<script src="{{ asset('custom/libs/progressbar.js/dist/progressbar.min.js')}}"></script>

<script src="{{ asset('assets/js/plugins/apexcharts.min.js')}}"></script>

<script src="{{ asset('custom/libs/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
<script src="{{ asset('custom/libs/select2/dist/js/select2.min.js')}}"></script>
<script src="{{ asset('custom/libs/moment/min/moment.min.js')}}"></script>
<script src="{{ asset('custom/libs/@fancyapps/fancybox/dist/jquery.fancybox.min.js')}}"></script>
<script src="{{ asset('custom/libs/fullcalendar/dist/fullcalendar.min.js')}}"></script>
<script src="{{ asset('custom/libs/flatpickr/dist/flatpickr.min.js')}}"></script>
<script src="{{ asset('custom/libs/quill/dist/quill.min.js')}}"></script>
<script src="{{ asset('custom/libs/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>
<script src="{{ asset('custom/libs/autosize/dist/autosize.min.js')}}"></script>

<!-- Site JS -->
<script src="{{asset('assets/js/plugins/choices.min.js')}}"></script>
<!-- datatable -->
<script src="{{ asset('assets/js/plugins/simple-datatables.js')}}"></script>
<!-- sweet alert Js -->
<script src="{{ asset('assets/js/plugins/sweetalert2.all.min.js') }}"></script>

<script src="{{asset('assets/js/plugins/bootstrap-switch-button.min.js')}}"></script>

<script src="{{ asset('custom/js/letter.avatar.js')}}"></script>

<script type="text/javascript" src="{{ asset('custom/js/custom.js') }}"></script>
@if(Session::has('success'))
    <script>
        show_toastr('{{__('Success')}}', '{!! session('success') !!}', 'success');
    </script>
    {{ Session::forget('success') }}
@endif
@if(Session::has('error'))
    <script>
        show_toastr('{{__('Error')}}', '{!! session('error') !!}', 'error');
    </script>
    {{ Session::forget('error') }}
@endif
@if(App\Models\Utility::getValByName('gdpr_cookie') == 'on')
    <script type="text/javascript">

        var defaults = {
            'messageLocales': {
                /*'en': 'We use cookies to make sure you can have the best experience on our website. If you continue to use this site we assume that you will be happy with it.'*/
                'en': "{{App\Models\Utility::getValByName('cookie_text')}}"
            },
            'buttonLocales': {
                'en': 'Ok'
            },
            'cookieNoticePosition': 'bottom',
            'learnMoreLinkEnabled': false,
            'learnMoreLinkHref': '/cookie-banner-information.html',
            'learnMoreLinkText': {
                'it': 'Saperne di più',
                'en': 'Learn more',
                'de': 'Mehr erfahren',
                'fr': 'En savoir plus'
            },
            'buttonLocales': {
                'en': 'Ok'
            },
            'expiresIn': 30,
            'buttonBgColor': '#d35400',
            'buttonTextColor': '#fff',
            'noticeBgColor': '#000',
            'noticeTextColor': '#fff',
            'linkColor': '#009fdd'
        };
    </script>
    <script src="{{ asset('custom/js/cookie.notice.js') }}"></script>
@endif

@stack('script-page')
