@php
// get theme color
$setting = App\Models\Utility::colorset();

$settings = Utility::settings();
$color = 'theme-3';
if (!empty($setting['color'])) {
    $color = $setting['color'];
}
$users = \Auth::user();
$currantLang = $users->currentLanguages();
$languages = \App\Models\Utility::languages();
$footer_text = isset(\App\Models\Utility::settings()['footer_text']) ? \App\Models\Utility::settings()['footer_text'] : '';
@endphp

<!DOCTYPE html>
<html lang="en" dir="{{isset($settings['SITE_RTL']) && $settings['SITE_RTL'] == 'on' ? 'rtl' : '' }}">
<meta name="csrf-token" content="{{ csrf_token() }}">

@include('partials.admin.head')
<body class="{{ $color }}">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>

    <!-- [ navigation menu ] start -->
    @include('partials.admin.menu')
    <!-- [ Header ] start -->
    @include('partials.admin.header')
    <!-- [ Main Content ] start -->
    <div class="page-content">
        <div class="dash-container">
            <div class="dash-content">
                <!-- [ breadcrumb ] start -->
                <div class="page-header">
                    <div class="page-block">
                        <div class="row align-items-center">
                            <div class="col-md-6 mb-3">
                                {{-- <div class="d-flex d-sm-flex align-items-center justify-content-between">
                                    <div> --}}
                                <div class="page-header-title">
                                    <h4 class="m-b-10">@yield('page-title')</h4>
                                </div>
                                <ul class="breadcrumb">
                                    @yield('breadcrumb')
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <div class="col-12">
                                    @yield('filter')
                                </div>
                                <div class="col-12 text-end">
                                    @yield('action-btn')
                                </div>
                            </div>
                                {{-- </div> --}}
                            {{-- </div> --}}
                        </div>
                    </div>
                </div>
                <!-- [ breadcrumb ] end -->
                <!-- [ Main Content ] start -->
                @yield('content')
            </div>
        </div>
    </div>

    <div class="modal fade" id="commonModal" tabindex="-1" role="dialog" aria-labelledby="commonModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="commonModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

    @include('partials.admin.footer')
</body>

</html>
