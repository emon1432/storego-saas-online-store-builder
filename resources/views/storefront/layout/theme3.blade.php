<!DOCTYPE html>
<html lang="en" dir="{{ env('SITE_RTL') == 'on' ? 'rtl' : '' }}">
@php
$userstore = \App\Models\UserStore::where('store_id', $store->id)->first();
$setting = \DB::table('settings')
    ->where('name', 'company_favicon')
    ->where('created_by', $store->id)
    ->first();
$settings = Utility::settings();
$getStoreThemeSetting = Utility::getStoreThemeSetting($store->id, $store->theme_dir);
$getStoreThemeSetting1 = [];

if (!empty($getStoreThemeSetting['dashboard'])) {
    $getStoreThemeSetting = json_decode($getStoreThemeSetting['dashboard'], true);
    $getStoreThemeSetting1 = Utility::getStoreThemeSetting($store->id, $store->theme_dir);
}

if (empty($getStoreThemeSetting)) {
    $path = storage_path() . '/uploads/' . $store->theme_dir . '/' . $store->theme_dir . '.json';
    $getStoreThemeSetting = json_decode(file_get_contents($path), true);
}

// store RTL

$data = DB::table('settings');

$data = $data
    ->where('created_by', '>', 1)
    ->where('store_id', $store->id)
    ->where('name', 'SITE_RTL')
    ->first();

    $imgpath=\App\Models\Utility::get_file('uploads/');
    $s_logo = \App\Models\Utility::get_file('uploads/store_logo/');
@endphp

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ ucfirst(env('APP_NAME')) }} - {{ ucfirst($store->tagline) }}">
    <meta name="keywords" content="{{ $store->metakeyword }}">
    <meta name="description" content="{{ $store->metadesc }}">

    <title>@yield('page-title') - {{ $store->tagline ? $store->tagline : config('APP_NAME', ucfirst($store->name)) }}
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon"
        href="{{ asset(Storage::url('uploads/logo/') . (!empty($setting->value) ? $setting->value : 'favicon.png')) }}"
        type="image/png">

    <link rel="stylesheet" href="{{ asset('custom/libs/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/theme3/css/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/libs/animate.css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/theme3/css/purpose.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/theme3/css/storego.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/theme3/css/' . (!empty($store->store_theme) ? $store->store_theme : 'white-yellow-color.css')) }}">
    <link rel="stylesheet" href="{{ asset('custom/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    @if (isset($data->value) && $data->value == 'on')
        <link rel="stylesheet" href="{{ asset('css/bootstrap-rtl.css ') }}">
    @endif

    @stack('css-page')
</head>

<body class="{{ Request::segment(3) == '' ? 'bg-body' : '' }}">
    @php
        if (!empty(session()->get('lang'))) {
            $currantLang = session()->get('lang');
        } else {
            $currantLang = $store->lang;
        }
        $languages = \App\Models\Utility::languages();
        $storethemesetting = \App\Models\Utility::demoStoreThemeSetting($store->id, $store->theme_dir);
    @endphp

    <header class="header inner-page" id="header-main">
        <!-- Main navbar -->
        <nav class="navbar navbar-main navbar-expand-lg navbar-transparent" id="navbar-main">
            <div class="container px-lg-0">
                <!-- Logo -->
                <a class="navbar-brand mr-lg-5" href="{{ route('store.slug', $store->slug) }}">
                    @if (!empty($store->logo))
                        <img alt="Image placeholder"
                            src="{{ $s_logo . $store->logo }}" id="navbar-logo"
                            style="height: 40px;">
                        <img alt="Image placeholder" class="mobile-view"
                            src="{{ $s_logo . $store->logo }}" id="navbar-logo">
                    @else
                        <img alt="Image placeholder" src="{{ asset(Storage::url('uploads/store_logo/logo3.png')) }}"
                            id="navbar-logo" style="height: 40px;">
                        <img alt="Image placeholder" src="{{ asset(Storage::url('uploads/store_logo/logo3.png')) }}"
                            class="mobile-view" id="navbar-logo">
                    @endif
                </a>
                <!-- Navbar collapse trigger -->
                <button class="navbar-toggler pr-0" type="button" data-toggle="collapse"
                    data-target="#navbar-main-collapse" aria-controls="navbar-main-collapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Navbar nav -->
                <div class="collapse navbar-collapse" id="navbar-main-collapse">

                    <ul class="navigation-menu align-items-lg-center">
                        <!-- Home - Overview  -->
                        <li class="nav-item ">
                            <a class="nav-link"
                                href="{{ route('store.slug', $store->slug) }}">{{ ucfirst($store->name) }}</a>
                        </li>
                        @if (!empty($page_slug_urls))
                            @foreach ($page_slug_urls as $k => $page_slug_url)
                                @if ($page_slug_url->enable_page_header == 'on')
                                    <li class="nav-item ">
                                        <a class="nav-link"
                                            href="{{ env('APP_URL') . '/page/' . $page_slug_url->slug }}">{{ ucfirst($page_slug_url->name) }}</a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                        @if ($store['blog_enable'] == 'on' && !empty($blog))
                            <li class="nav-item ">
                                <a class="nav-link"
                                    href="{{ route('store.blog', $store->slug) }}">{{ __('Blog') }}</a>
                            </li>
                        @endif
                    </ul>
                    <ul class="navbar-nav align-items-lg-center ml-lg-auto nav-my-store">
                        <li class="nav-item store-bg">
                            <a class="nav-heart btn btn-black ml-2 mr-2 rounded-pill hover-translate-y-n3 "
                                class="nav-link" data-action="omnisearch-open" data-target="#omnisearch">
                                <i class="fas fa-search"></i>
                            </a>
                        </li>
                        @if (Utility::CustomerAuthCheck($store->slug) == true)
                            <li class="nav-item store-bg">
                                <a class="nav-heart btn btn-black ml-2 mr-2 rounded-pill hover-translate-y-n3 "
                                    href="{{ route('store.wishlist', $store->slug) }}">
                                    <i class="fas fa-heart"></i>
                                </a>
                            </li>
                        @endif
                        <li class="nav-item store-bg">
                            <a href="{{ route('store.cart', $store->slug) }}"
                                class="nav-heart btn btn-black ml-2 mr-2 rounded-pill hover-translate-y-n3 ">
                                <i class="fas fa-shopping-basket"></i>
                                <p class="badge badge-pill badge-floating bg-green border-dark shoping_counts"
                                    id="shoping_counts">
                                    {{ !empty($total_item) ? $total_item : '0' }}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class=" nav-heart btn btn-black ml-2 mr-2 rounded-pill hover-translate-y-n3 text-white"
                                href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <!-- <i class="fas fa-language"></i> -->
                                {{ Str::upper($currantLang) }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                @foreach ($languages as $language)
                                    <a href="{{ route('change.languagestore', [$store->slug, $language]) }}"
                                        class="dropdown-item @if ($language == $currantLang) active-language text-primary @endif">
                                        <span> {{ Str::upper($language) }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </li>
                        @if (Utility::CustomerAuthCheck($store->slug) == true)
                            <div class="drop-down">
                                <div id="dropDown" class="drop-down__button ">
                                    <a
                                        class="nav-link nav-link btn ml-2 bg--gray hover-translate-y-n3 icon-font login_btn btn-black">{{ ucFirst(Auth::guard('customers')->user()->name) }}
                                        <i class="fas fa-sort-down ml-2 mr-0 down_icon"></i>
                                    </a>
                                </div>
                                <div class="drop-down__menu-box">
                                    <ul class="drop-down__menu">
                                        <li data-name="profile" class="drop-down__item">
                                            <a href="{{ route('store.slug', $store->slug) }}" class="nav-link">
                                                {{ __('My Dashboard') }}
                                            </a>
                                        </li>
                                        <li data-name="activity" class="drop-down__item">
                                            <a href="" data-size="lg"
                                                data-url="{{ route('customer.profile', [$store->slug, \Illuminate\Support\Facades\Crypt::encrypt(Auth::guard('customers')->user()->id)]) }}"
                                                data-ajax-popup="true" data-title="{{ __('Edit Profile') }}"
                                                data-toggle="modal" class="nav-link">

                                                {{ __('My Profile') }}
                                            </a>
                                        </li>
                                        <li data-name="activity" class="drop-down__item">
                                            <a href="{{ route('customer.home', $store->slug) }}" class="nav-link">

                                                {{ __('My Orders') }}
                                            </a>
                                        </li>
                                        <li>
                                            @if (Utility::CustomerAuthCheck($store->slug) == false)
                                                <a href="{{ route('customer.login', $store->slug) }}"
                                                    class="nav-link">
                                                    {{ __('Sign in') }}
                                                </a>
                                            @else
                                                <a href="#"
                                                    onclick="event.preventDefault(); document.getElementById('customer-frm-logout').submit();"
                                                    class="nav-link">
                                                    {{ __('Logout') }}
                                                </a>
                                                <form id="customer-frm-logout"
                                                    action="{{ route('customer.logout', $store->slug) }}"
                                                    method="POST" class="d-none">
                                                    {{ csrf_field() }}
                                                </form>
                                            @endif
                                        </li>


                                    </ul>
                                </div>
                            </div>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('customer.login', $store->slug) }}"
                                    class="nav-link btn ml-2 btn btn-black ml-2 mr-2 text-white hover-translate-y-n3 login_btn_2"
                                    style="width: 90px;
        border-radius: 7px;">{{ __('Log in') }}</a>
                            </li>
                        @endif


                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div id="omnisearch" class="omnisearch">
        <div class="container">
            <!-- Search form -->
            <form class="omnisearch-form"
                action="{{ route('store.categorie.product', [$store->slug, 'Start shopping']) }}" method="get">
                <div class="form-group">
                    <div class="input-group input-group-merge input-group-flush">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input type="text" name="search_data" class="form-control form-control-flush"
                            placeholder="Type your product...">
                        {{-- <input type="text" class="form-control" placeholder="Type and hit enter ..."> --}}
                    </div>
                </div>
            </form>
        </div>
    </div>
    <main>
        @yield('content')
    </main>

    <footer id="footer-main">
        <div class="container">
            @if ($getStoreThemeSetting[5]['section_enable'] == 'on')

                <div class="row pt-md top-footer delimiter-top">
                    @if (!empty($getStoreThemeSetting[5]))
                        <div class="col-lg-12 mb-5 mb-lg-0">
                            <a href="{{ route('store.slug', $store->slug) }}">
                                <img class="mb-3"
                                    src="{{ $imgpath . $getStoreThemeSetting[5]['inner-list'][0]['field_default_text']}}"
                                    alt="Footer logo" style="height: 40px;">
                            </a>
                        </div>
                    @endif
                </div>
            @endif
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 footer-content">
                    <ul class="list-unstyled f-list">
                        @if ($getStoreThemeSetting[5]['section_enable'] == 'on')
                        @if (!empty($getStoreThemeSetting[6]['inner-list'][0]['field_default_text']) &&
                            $getStoreThemeSetting[6]['inner-list'][0]['field_default_text'] == 'on')
                            @if (isset($getStoreThemeSetting[7]['homepage-header-quick-link-name-1']) ||
                                isset($getStoreThemeSetting[7]['homepage-header-quick-link-1']))
                                <li>
                                    <a class="t-gray" target="_blank"
                                        href="{{ $getStoreThemeSetting[7]['homepage-header-quick-link-1'][0] }}">
                                        {{ $getStoreThemeSetting[7]['homepage-header-quick-link-name-1'][0] }}
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a class="t-gray" target="_blank"
                                        href="{{ $getStoreThemeSetting[7]['inner-list'][1]['field_default_text'] }}">
                                        {{ $getStoreThemeSetting[7]['inner-list'][0]['field_default_text'] }}
                                    </a>
                                </li>
                            @endif
                        @endif

                        @if (!empty($getStoreThemeSetting[8]['inner-list'][0]['field_default_text']) &&
                            $getStoreThemeSetting[8]['inner-list'][0]['field_default_text'] == 'on')
                            @if (isset($getStoreThemeSetting[9]['homepage-header-quick-link-name-2']) ||
                                isset($getStoreThemeSetting[9]['homepage-header-quick-link-2']))
                                <li>
                                    <a class="t-gray" target="_blank"
                                        href="{{ $getStoreThemeSetting[9]['homepage-header-quick-link-2'][0] }}">
                                        {{ $getStoreThemeSetting[9]['homepage-header-quick-link-name-2'][0] }}
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a class="t-gray" target="_blank"
                                        href="{{ $getStoreThemeSetting[9]['inner-list'][1]['field_default_text'] }}">
                                        {{ $getStoreThemeSetting[9]['inner-list'][0]['field_default_text'] }}
                                    </a>
                                </li>
                            @endif
                        @endif

                        @if (!empty($getStoreThemeSetting[10]['inner-list'][0]['field_default_text']) &&
                            $getStoreThemeSetting[10]['inner-list'][0]['field_default_text'] == 'on')
                            @if (isset($getStoreThemeSetting[11]['homepage-header-quick-link-name-3']) ||
                                isset($getStoreThemeSetting[11]['homepage-header-quick-link-3']))
                                <li>
                                    <a class="t-gray" target="_blank"
                                        href="{{ $getStoreThemeSetting[11]['homepage-header-quick-link-3'][0] }}">
                                        {{ $getStoreThemeSetting[11]['homepage-header-quick-link-name-3'][0] }}
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a class="t-gray" target="_blank"
                                        href="{{ $getStoreThemeSetting[11]['inner-list'][1]['field_default_text'] }}">
                                        {{ $getStoreThemeSetting[11]['inner-list'][0]['field_default_text'] }}
                                    </a>
                                </li>
                            @endif
                        @endif

                        @if (!empty($getStoreThemeSetting[12]['inner-list'][0]['field_default_text']) &&
                            $getStoreThemeSetting[12]['inner-list'][0]['field_default_text'] == 'on')
                            @if (isset($getStoreThemeSetting[13]['homepage-header-quick-link-name-4']) ||
                                isset($getStoreThemeSetting[13]['homepage-header-quick-link-4']))
                                <li>
                                    <a class="t-gray" target="_blank"
                                        href="{{ $getStoreThemeSetting[13]['homepage-header-quick-link-4'][0] }}">
                                        {{ $getStoreThemeSetting[13]['homepage-header-quick-link-name-4'][0] }}
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a class="t-gray" target="_blank"
                                        href="{{ $getStoreThemeSetting[13]['inner-list'][1]['field_default_text'] }}">
                                        {{ $getStoreThemeSetting[13]['inner-list'][0]['field_default_text'] }}
                                    </a>
                                </li>
                            @endif
                        @endif

                        @endif
                    </ul>
                    @if ($getStoreThemeSetting[14]['section_enable'] == 'on')
                        <div class="footer-social">
                            <ul class="nav justify-content-center justify-content-md-end mt-3 mt-md-0">
                                <li class="nav-item d-flex align-items-center">
                                    <p class="mb-0 text-uppercase">{{ __('Follow us on') }} :</p>
                                </li>
                                @if (isset($getStoreThemeSetting[14]['homepage-footer-2-social-icon']) ||
                                    isset($getStoreThemeSetting[14]['homepage-footer-2-social-link']))
                                    @if (isset($getStoreThemeSetting[14]['inner-list'][1]['field_default_text']) &&
                                        isset($getStoreThemeSetting[14]['inner-list'][0]['field_default_text']))
                                        @foreach ($getStoreThemeSetting[14]['homepage-footer-2-social-icon'] as $icon_key => $storethemesettingicon)
                                            @foreach ($getStoreThemeSetting[14]['homepage-footer-2-social-link'] as $link_key => $storethemesettinglink)
                                                @if ($icon_key == $link_key)
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{ $storethemesettinglink }}"
                                                            target="_blank">
                                                            {!! $storethemesettingicon !!}
                                                        </a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @endif
                                @else
                                    @for ($i = 0; $i < $getStoreThemeSetting[14]['loop_number']; $i++)
                                        @if (isset($getStoreThemeSetting[14]['inner-list'][1]['field_default_text']) &&
                                            isset($getStoreThemeSetting[14]['inner-list'][0]['field_default_text']))
                                            <li class="nav-item storelinkicon">
                                                <a class="nav-link"
                                                    href="{{ $getStoreThemeSetting[14]['inner-list'][1]['field_default_text'] }}"
                                                    target="_blank">
                                                    {!! $getStoreThemeSetting[14]['inner-list'][0]['field_default_text'] !!}
                                                </a>
                                            </li>
                                        @endif
                                    @endfor
                                @endif
                            </ul>
                        </div>
                    @endif

                </div>
            </div>
            {{-- @DD($getStoreThemeSetting[14]) --}}
            @if (isset($getStoreThemeSetting[14]['section_enable']) && $getStoreThemeSetting[14]['section_enable'] == 'on')
                <div class="row align-items-center justify-content-md-between py-2 delimiter-top">
                    <div class="col-md-12">
                        <div class="copyright text-sm font-weight-bold text-center text-md-left">
                            {{ $getStoreThemeSetting[15]['inner-list'][0]['field_default_text'] }}
                        </div>
                    </div>
                </div>

            @endif



        </div>
    </footer>

    <div class="modal fade" id="commonModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center">
                    <div class="modal-title">
                        <h6 class="mb-0" id="modelCommanModelLabel"></h6>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>

    {{-- <script src="{{asset('assets/theme3/js/all.min.js')}}"></script> --}}
    <script src="{{ asset('assets/theme3/js/purpose.core.js') }}"></script>
    <script src="{{ asset('custom/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/theme3/js/swiper.min.js') }}"></script>
    <script src="{{ asset('assets/theme3/js/purpose.js') }}"></script>
    <script>
        var dataTabelLang = {
            paginate: {
                previous: "{{ 'Previous' }}",
                next: "{{ 'Next' }}"
            },
            lengthMenu: "{{ 'Show' }} MENU {{ 'entries' }}",
            zeroRecords: "{{ 'No data available in table' }}",
            info: "{{ 'Showing' }} START {{ 'to' }} END {{ 'of' }} TOTAL {{ 'entries' }}",
            infoEmpty: " ",
            search: "{{ 'Search:' }}"
        }
    </script>
    <script src="{{ asset('custom/js/custom.js') }}"></script>
    <script src="{{ asset('custom/libs/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    @if (App\Models\Utility::getValByName('gdpr_cookie') == 'on')
        <script type="text/javascript">
            var defaults = {
                'messageLocales': {
                    /*'en': 'We use cookies to make sure you can have the best experience on our website. If you continue to use this site we assume that you will be happy with it.'*/
                    'en': "{{ App\Models\Utility::getValByName('cookie_text') }}"
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
    @if (Session::has('success'))
        <script>
            show_toastr('{{ __('Success') }}', '{!! session('success') !!}', 'success');
        </script>
        {{ Session::forget('success') }}
    @endif
    @if (Session::has('error'))
        <script>
            show_toastr('{{ __('Error') }}', '{!! session('error') !!}', 'error');
        </script>
        {{ Session::forget('error') }}
    @endif
    @php
        $store_settings = \App\Models\Store::where('slug', $store->slug)->first();
    @endphp
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $store_settings->google_analytic }}"></script>

    {!! $store_settings->storejs !!}
    <script>
        $(".add_to_cart").click(function(e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            var variants = [];
            $(".variant-selection").each(function(index, element) {
                variants.push(element.value);
            });

            if (jQuery.inArray('', variants) != -1) {
                show_toastr('Error', "{{ __('Please select all option.') }}", 'error');
                return false;
            }
            var variation_ids = $('#variant_id').val();

            $.ajax({
                url: '{{ route('user.addToCart', ['__product_id', $store->slug, 'variation_id']) }}'
                    .replace(
                        '__product_id', id).replace('variation_id', variation_ids ?? 0),
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    variants: variants.join(' : '),
                },
                success: function(response) {
                    if (response.status == "Success") {
                        show_toastr('Success', response.success, 'success');
                        $("#shoping_counts").html(response.item_count);
                    } else {
                        show_toastr('Error', response.error, 'error');
                    }
                },
                error: function(result) {
                    console.log('error');
                }
            });
        });

        $(document).on('change', '#pro_variants_name', function() {
            var variants = [];
            $(".variant-selection").each(function(index, element) {
                variants.push(element.value);
            });
            if (variants.length > 0) {
                $.ajax({
                    url: '{{ route('get.products.variant.quantity') }}',
                    data: {
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                        variants: variants.join(' : '),
                        product_id: $('#product_id').val()
                    },

                    success: function(data) {
                        $('.variation_price').html(data.price);
                        $('#variant_id').val(data.variant_id);
                        $('#variant_qty').val(data.quantity);
                    }
                });
            }
        });
    </script>
    <script>
        $(".productTab").click(function(e) {
            e.preventDefault();
            $('.productTab').removeClass('active')

        });

        $("#pro_scroll").click(function() {
            $('html, body').animate({
                scrollTop: $("#pro_items").offset().top
            }, 1000);
        });

        $(document).on('click', '.add_to_wishlist', function(e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                url: '{{ route('store.addtowishlist', [$store->slug, '__product_id']) }}'.replace(
                    '__product_id', id),
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    if (response.status == "Success") {
                        show_toastr('Success', response.message, 'success');
                        $('.wishlist_' + response.id).removeClass('add_to_wishlist');
                        $('.wishlist_' + response.id).html('<i class="fas fa-heart"></i>');
                        $('.wishlist_count').html(response.count);
                    } else {
                        show_toastr('Error', response.error, 'error');
                    }
                },
                error: function(result) {}
            });
        });
    </script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', '{{ $store_settings->google_analytic }}');
    </script>

    <!-- Facebook Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '{{ $store_settings->fbpixel_code }}');
        fbq('track', 'PageView');
    </script>



    <script type="text/javascript">
        $(function() {
            $(".drop-down__button ").on("click", function(e) {
                $(".drop-down").addClass("drop-down--active");
                e.stopPropagation()
            });
            $(document).on("click", function(e) {
                if ($(e.target).is(".drop-down") === false) {
                    $(".drop-down").removeClass("drop-down--active");
                }
            });
        });
    </script>


    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=0000&ev=PageView&noscript={{ $store_settings->fbpixel_code }}" /></noscript>

</body>

</html>
