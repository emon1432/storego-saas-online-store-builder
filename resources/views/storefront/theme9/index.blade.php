@extends('storefront.layout.theme9')

@section('page-title')
    {{ __('Home') }}
@endsection

@push('css-page')
@endpush
@php
    $imgpath = \App\Models\Utility::get_file('uploads/');
    $productImg = \App\Models\Utility::get_file('uploads/is_cover_image/');
    $catimg = \App\Models\Utility::get_file('uploads/product_image/');
    $default = \App\Models\Utility::get_file('uploads/theme7/header/img01.jpg');
    $s_logo = \App\Models\Utility::get_file('uploads/store_logo/');

@endphp
@section('content')
    <!-- Main Banner -->
    <div class="position-relative">

        <div class="swiper-js-container position-relative home-banner">
            <div class="swiper-container" data-swiper-items="1" data-swiper-space-between="0">
                <div class="swiper-wrapper">
                    @php

                        $homepage_header_text = $homepage_header_btn = $homepage_header_bg_img = '';
                        $homepage_header_2_key = array_search('Home-Header', array_column($getStoreThemeSetting, 'section_name'));

                        if (!empty($getStoreThemeSetting[$homepage_header_2_key])) {
                            $homepage_header_2 = $getStoreThemeSetting[$homepage_header_2_key];
                        }

                    @endphp

                    @for ($i = 0; $i < $homepage_header_2['loop_number']; $i++)
                        @php
                            foreach ($homepage_header_2['inner-list'] as $homepage_header_2_value) {
                                if ($homepage_header_2_value['field_slug'] == 'header-sub-title') {
                                    $homepage_header_sub_title = $homepage_header_2_value['field_default_text'];
                                }
                                if ($homepage_header_2_value['field_slug'] == 'homepage-header-title') {
                                    $homepage_header_text = $homepage_header_2_value['field_default_text'];
                                }
                                if ($homepage_header_2_value['field_slug'] == 'homepage-sub-text') {
                                    $homepage_header_sub_text = $homepage_header_2_value['field_default_text'];
                                }
                                if ($homepage_header_2_value['field_slug'] == 'homepage-header-button') {
                                    $homepage_header_btn = $homepage_header_2_value['field_default_text'];
                                }
                                if ($homepage_header_2_value['field_slug'] == 'homepage-header-bg-image') {
                                    $homepage_header_bg_img = $homepage_header_2_value['field_default_text'];
                                }

                                if (!empty($homepage_header_2[$homepage_header_2_value['field_slug']])) {
                                    if ($homepage_header_2_value['field_slug'] == 'header-sub-title') {
                                        $homepage_header_sub_title = $homepage_header_2[$homepage_header_2_value['field_slug']][$i];
                                    }
                                    if ($homepage_header_2_value['field_slug'] == 'homepage-header-title') {
                                        $homepage_header_text = $homepage_header_2[$homepage_header_2_value['field_slug']][$i];
                                    }
                                    if ($homepage_header_2_value['field_slug'] == 'homepage-sub-text') {
                                        $homepage_header_sub_text = $homepage_header_2[$homepage_header_2_value['field_slug']][$i];
                                    }
                                    if ($homepage_header_2_value['field_slug'] == 'homepage-header-button') {
                                        $homepage_header_btn = $homepage_header_2[$homepage_header_2_value['field_slug']][$i];
                                    }
                                    if ($homepage_header_2_value['field_slug'] == 'homepage-header-bg-image') {
                                        $homepage_header_bg_img = $homepage_header_2[$homepage_header_2_value['field_slug']][$i]['field_prev_text'];
                                    }
                                }
                            }
                        @endphp
                        @if ($getStoreThemeSetting[0]['section_enable'] == 'on')
                            <section class="py-md-9 py-6 w-100 swiper-slide" data-offset-top="#header-main"
                                style="background-image: url({{ $imgpath . $homepage_header_bg_img }}); background-position: center center;">
                                <div class="container pb-lg-9">
                                    <div class="row align-items-center">
                                        <div class="col-md-8 col-xl-6 text-center mx-auto">
                                            <h6 class="font-size-12 font-weight-300 ls-2 mb-3 text-uppercase text-white">
                                                {{ $homepage_header_sub_title }}</h6>
                                            <h2 class="store-title text-white">
                                                <span class="font-weight-600">
                                                    {{ $homepage_header_text }}
                                                </span>
                                            </h2>
                                            <p class="col-md-10 col-10 mx-auto mx-md-0 mt-4 px-0 store-dcs text-white">

                                                {{ $homepage_header_sub_text }}
                                            </p>
                                            <div>
                                                <a href="{{ route('store.categorie.product', [$store->slug, 'Start shopping']) }}"
                                                    class="btn btn-outline-white mt-4 mr-md-4">
                                                    {{ $homepage_header_btn }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </section>
                        @endif
                    @endfor
                </div>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination mt-4"></div>
            @if ($getStoreThemeSetting[0]['section_enable'] == 'on')
                <ul class="list-unstyled pl-0 m-0 slider-social">

                    @if (isset($getStoreThemeSetting[1]['homepage-sidebar-social-icon']) ||
                        isset($getStoreThemeSetting[1]['homepage-sidebar-social-link']))
                        @if (isset($getStoreThemeSetting[1]['inner-list'][1]['field_default_text']) &&
                            isset($getStoreThemeSetting[1]['inner-list'][0]['field_default_text']))
                            @foreach ($getStoreThemeSetting[1]['homepage-sidebar-social-icon'] as $icon_key => $storethemesettingicon)
                                @foreach ($getStoreThemeSetting[1]['homepage-sidebar-social-link'] as $link_key => $storethemesettinglink)
                                    @if ($icon_key == $link_key)
                                        <li class="my-2">
                                            <a href="{{ $storethemesettinglink }}"
                                                class="d-flex align-items-center justify-content-center bg--gray rounded-circle">
                                                {!! $storethemesettingicon !!}
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            @endforeach
                        @endif
                    @else
                        @for ($i = 0; $i < $getStoreThemeSetting[1]['loop_number']; $i++)
                            @if (isset($getStoreThemeSetting[1]['inner-list'][1]['field_default_text']) &&
                                isset($getStoreThemeSetting[1]['inner-list'][0]['field_default_text']))
                                <li class="my-2">
                                    <a class="d-flex align-items-center justify-content-center bg--gray rounded-circle footer-icon"
                                        href="{{ $getStoreThemeSetting[1]['inner-list'][1]['field_default_text'] }}"
                                        target="_blank">
                                        {!! $getStoreThemeSetting[1]['inner-list'][0]['field_default_text'] !!}
                                    </a>
                                </li>
                            @endif
                        @endfor
                    @endif

                </ul>
            @endif
        </div>
        @if ($getStoreThemeSetting[0]['section_enable'] == 'on')
            <div
                class="bottom-0 left-0 no-gutters position-absolute row zindex-100 w-100 additional-items d-none d-lg-block">
                <div class="col-lg-10 col-xl-8 w-100  position-relative">
                    <div class="swiper-container" data-swiper-items="2" data-swiper-space-between="0"
                        data-swiper-sm-items="2" data-swiper-xl-items="2">
                        <div class="swiper-wrapper">
                            @foreach ($theme9_product_random as $kei => $headerProduct)
                                <div class="swiper-slide col-md-6 px-0 h-auto">
                                    <div
                                        class="row align-items-center no-gutters h-100 header-bottom {{ $kei == 0 ? 'bg-white' : 'bg-gray-100' }}">
                                        <div class="col-md-3">
                                            <div class="p-2">
                                                <a
                                                    href="{{ route('store.product.product_view', [$store->slug, $headerProduct->id]) }}">
                                                    @if (!empty($headerProduct->is_cover) && \Storage::exists('uploads/is_cover_image/' . $headerProduct->is_cover))
                                                        <img alt="Image placeholder"
                                                            src="{{ $productImg . $headerProduct->is_cover }}"
                                                            class="img-center img-fluid img_setting">
                                                    @else
                                                        <img alt="Image placeholder"
                                                            src="{{ asset(Storage::url('uploads/is_cover_image/default.jpg')) }}"
                                                            class="img-center img-fluid">
                                                    @endif
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-7 pl-4">
                                            <p class="text-small mb-1">
                                                <span class="font-weight-500">
                                                    {{ $headerProduct->product_category() }}:
                                                </span>

                                            </p>
                                            <h4 class="font-weight-300"><span class="font-weight-700 d-block">
                                                    <a
                                                        href="{{ route('store.product.product_view', [$store->slug, $headerProduct->id]) }}">
                                                        {{ $headerProduct->name }}
                                                    </a>
                                                </span>

                                            </h4>
                                            <span class="mb-0 p-price text-secondary variation_price">
                                                {{ \App\Models\Utility::priceFormat($headerProduct->price) }}
                                            </span>
                                            <span class="mb-0 sub-price ml-4">
                                                {{ \App\Models\Utility::priceFormat($headerProduct->last_price) }}
                                            </span>

                                        </div>

                                        <div class="col-md-2 text-center">
                                            <a href="javascript:void(0)"type="button" class="add_to_cart"
                                                data-toggle="tooltip" data-placement="top" title="ADD TO CART"
                                                data-id="{{ $headerProduct->id }}">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_24_20384)">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M14 16C15.1046 16 16 15.1046 16 14L16 12.8889L16 2C16 0.895429 15.1046 -1.86821e-06 14 -1.81993e-06L8 -1.55766e-06L7.7 -1.54454e-06C7.33181 -1.52845e-06 7.03333 0.298475 7.03333 0.666665C7.03333 1.03485 7.33181 1.33333 7.7 1.33333L8 1.33333L14 1.33333C14.3682 1.33333 14.6667 1.63181 14.6667 2L14.6667 12.8889L14.6667 14C14.6667 14.3682 14.3682 14.6667 14 14.6667L8 14.6667L7.7 14.6667C7.33181 14.6667 7.03333 14.9651 7.03333 15.3333C7.03333 15.7015 7.33181 16 7.7 16L8 16L14 16ZM5.96667 15.3333C5.96667 14.9651 5.66819 14.6667 5.3 14.6667L4.7 14.6667C4.33181 14.6667 4.03333 14.9651 4.03333 15.3333C4.03333 15.7015 4.33181 16 4.7 16L5.3 16C5.66819 16 5.96667 15.7015 5.96667 15.3333ZM5.96666 0.666666C5.96666 0.298475 5.66819 -1.45573e-06 5.3 -1.43964e-06L4.7 -1.41341e-06C4.33181 -1.39732e-06 4.03333 0.298475 4.03333 0.666666C4.03333 1.03485 4.33181 1.33333 4.7 1.33333L5.3 1.33333C5.66819 1.33333 5.96666 1.03485 5.96666 0.666666ZM2.96667 15.3333C2.96667 14.9651 2.66819 14.6667 2.3 14.6667L2 14.6667C1.9638 14.6667 1.92872 14.6638 1.89485 14.6585C1.53112 14.6014 1.18993 14.8499 1.13277 15.2136C1.07561 15.5773 1.32413 15.9185 1.68785 15.9757C1.78994 15.9917 1.89423 16 2 16L2.3 16C2.66819 16 2.96667 15.7015 2.96667 15.3333ZM2.96666 0.666666C2.96666 0.298475 2.66819 -1.3246e-06 2.3 -1.3085e-06L2 -1.29539e-06C1.89423 -1.29077e-06 1.78994 0.00826612 1.68785 0.0243107C1.32412 0.0814721 1.0756 0.422668 1.13277 0.786394C1.18993 1.15012 1.53112 1.39864 1.89485 1.34148C1.92872 1.33616 1.9638 1.33333 2 1.33333L2.3 1.33333C2.66819 1.33333 2.96666 1.03485 2.96666 0.666666ZM0.786393 14.8672C1.15012 14.8101 1.39864 14.4689 1.34148 14.1051C1.33616 14.0713 1.33333 14.0362 1.33333 14L1.33333 13.7C1.33333 13.3318 1.03485 13.0333 0.666665 13.0333C0.298475 13.0333 -2.02398e-06 13.3318 -2.00788e-06 13.7L-1.99477e-06 14C-1.99015e-06 14.1058 0.00826542 14.2101 0.02431 14.3121C0.0814723 14.6759 0.422667 14.9244 0.786393 14.8672ZM0.786393 1.13277C0.422667 1.07561 0.0814718 1.32413 0.0243095 1.68785C0.00826487 1.78995 -2.52393e-06 1.89423 -2.51931e-06 2L-2.50619e-06 2.3C-2.4901e-06 2.66819 0.298475 2.96667 0.666665 2.96666C1.03485 2.96666 1.33333 2.66819 1.33333 2.3L1.33333 2C1.33333 1.9638 1.33616 1.92872 1.34148 1.89485C1.39864 1.53112 1.15012 1.18993 0.786393 1.13277ZM0.666665 11.9667C1.03485 11.9667 1.33333 11.6682 1.33333 11.3L1.33333 10.7C1.33333 10.3318 1.03485 10.0333 0.666665 10.0333C0.298475 10.0333 -2.15511e-06 10.3318 -2.13902e-06 10.7L-2.11279e-06 11.3C-2.0967e-06 11.6682 0.298475 11.9667 0.666665 11.9667ZM0.666665 8.96667C1.03485 8.96667 1.33333 8.66819 1.33333 8.3L1.33333 7.7C1.33333 7.33181 1.03485 7.03333 0.666665 7.03333C0.298475 7.03333 -2.28625e-06 7.33181 -2.27015e-06 7.7L-2.24393e-06 8.3C-2.22783e-06 8.66819 0.298475 8.96667 0.666665 8.96667ZM0.666665 5.96667C1.03485 5.96667 1.33333 5.66819 1.33333 5.3L1.33333 4.7C1.33333 4.33181 1.03485 4.03333 0.666665 4.03333C0.298475 4.03333 -2.41738e-06 4.33181 -2.40129e-06 4.7L-2.37506e-06 5.3C-2.35897e-06 5.66819 0.298475 5.96667 0.666665 5.96667ZM5.33309 7.33333C4.9649 7.33333 4.66642 7.63181 4.66642 8C4.66642 8.36819 4.9649 8.66667 5.33309 8.66667L9.05723 8.66667L8.1953 9.5286C7.93495 9.78894 7.93495 10.2111 8.1953 10.4714C8.45565 10.7318 8.87776 10.7318 9.13811 10.4714L11.1381 8.4714C11.2631 8.34638 11.3334 8.17681 11.3334 8C11.3334 7.82319 11.2631 7.65362 11.1381 7.5286L9.13811 5.5286C8.87776 5.26825 8.45565 5.26825 8.1953 5.5286C7.93495 5.78894 7.93495 6.21106 8.1953 6.4714L9.05723 7.33333L5.33309 7.33333Z"
                                                            fill="#282827" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_24_20384">
                                                            <rect width="16" height="16" fill="white"
                                                                transform="matrix(-1 0 0 1 16 0)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>


                </div>
            </div>
        @endif
    </div>


    <!-- Products -->
    <section class="bestsellers-section {{ $getStoreThemeSetting[0]['section_enable'] == 'off' ? 'mt-8' : '' }}">
        @foreach ($getStoreThemeSetting as $storethemesetting)
            @if (isset($storethemesetting['section_name']) &&
                $storethemesetting['section_name'] == 'Home-Email-Subscriber' &&
                $storethemesetting['section_enable'] == 'on')
                @php
                    $SubscriberTitle_key = array_search('Subscriber Title', array_column($storethemesetting['inner-list'], 'field_name'));
                    $SubscriberTitle = $storethemesetting['inner-list'][$SubscriberTitle_key]['field_default_text'];
                @endphp
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h2 class="font-weight-300 mt-4 text-primary title-size">
                                <span class="font-weight-100 d-block">
                                    {{ $SubscriberTitle }}
                                </span>

                            </h2>
                        </div>
                        <div class="col-md-6 mt-4">
                            {{ Form::open(['route' => ['subscriptions.store_email', $store->id], 'method' => 'POST']) }}
                            <div class="d-flex form-group position-relative">
                                <span class="left-3 position-absolute top-2">
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="customize-icon">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M0 8.25C0 12.8063 3.69365 16.5 8.25 16.5C10.1548 16.5 11.9088 15.8545 13.3052 14.7702C13.3578 14.8815 13.4302 14.9858 13.5222 15.0778L20.1222 21.6778C20.5518 22.1074 21.2482 22.1074 21.6778 21.6778C22.1074 21.2482 22.1074 20.5518 21.6778 20.1222L15.0778 13.5222C14.9858 13.4302 14.8815 13.3578 14.7702 13.3052C15.8545 11.9088 16.5 10.1548 16.5 8.25C16.5 3.69365 12.8063 0 8.25 0C3.69365 0 0 3.69365 0 8.25ZM2.2 8.25C2.2 4.90868 4.90868 2.2 8.25 2.2C11.5913 2.2 14.3 4.90868 14.3 8.25C14.3 11.5913 11.5913 14.3 8.25 14.3C4.90868 14.3 2.2 11.5913 2.2 8.25Z"
                                            fill="#793838" />
                                    </svg>
                                </span>
                                {{ Form::email('email', null, ['class' => 'font-size-12 pl-5 form-control h-100 py-3 rounded-0 border-0 bg-white shadow-none', 'aria-label' => 'Enter your email address', 'placeholder' => __('Enter Your Email Address')]) }}
                                <button class="bg-primary border-0 h-100 position-absolute px-3 right-0 rounded-0 top-0"
                                    type="submit">
                                    <svg width="25" height="24" viewBox="0 0 25 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_8_776)">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M0.5 12C0.5 11.4477 0.947715 11 1.5 11L21.0858 11L14.7932 4.7071C14.4026 4.31657 14.4027 3.6834 14.7932 3.29288C15.1837 2.90236 15.8169 2.90238 16.2074 3.29291L24.2071 11.2929C24.5976 11.6834 24.5976 12.3166 24.2071 12.7071L16.2074 20.7071C15.8169 21.0976 15.1837 21.0976 14.7932 20.7071C14.4027 20.3166 14.4026 19.6834 14.7932 19.2929L21.0858 13L1.5 13C0.947715 13 0.5 12.5523 0.5 12Z"
                                                fill="white"></path>
                                        </g>
                                    </svg>
                                </button>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

        @if (count($topRatedProducts) > 0)
            <div class="bestsellers-tabs mt-5">
                <div class="col-lg-12 swiper-js-container">
                    <div class="swiper-container swiper-container-horizontal" data-swiper-items="1"
                        data-swiper-space-between="0" data-swiper-sm-items="2" data-swiper-xl-items="4">
                        <div class="swiper-wrapper">
                            @foreach ($topRatedProducts as $k => $topRatedProduct)
                                <div class="col-lg-3 col-sm-6 col-md-4 product-box swiper-slide">
                                    <div class="border-0 card card-product rounded-lg">
                                        <div
                                            class="align-items-center border-0 card-header d-flex justify-content-between p-0 pt-4 pr-3">
                                            @if (Auth::guard('customers')->check())
                                                @if (!empty($wishlist) && isset($wishlist[$topRatedProduct->product->id]['product_id']))
                                                    @if ($wishlist[$topRatedProduct->product->id]['product_id'] != $topRatedProduct->product->id)
                                                        <button data-toggle="tooltip" data-original-title="Wishlist"
                                                            type="button"
                                                            class="badge badge-primary border-0 p-0 position-absolute px-2 py-2 right-4 rounded-circle top-3 zindex-100  add_to_wishlist wishlist_{{ $topRatedProduct->product->id }}"
                                                            data-id="{{ $topRatedProduct->product->id }}">

                                                            <i class="far fa-heart text-white"></i>
                                                        </button>
                                                    @else
                                                        <button data-toggle="tooltip" data-original-title="Wishlist"
                                                            type="button"
                                                            class="badge badge-primary border-0 p-0 position-absolute px-2 py-2 right-4 rounded-circle top-3 zindex-100 "
                                                            data-id="{{ $topRatedProduct->product->id }}" disabled>
                                                            <i class="fas fa-heart text-white"></i>
                                                        </button>
                                                    @endif
                                                @else
                                                    <button data-toggle="tooltip" data-original-title="Wishlist"
                                                        type="button"
                                                        class="badge badge-primary border-0 p-0 position-absolute px-2 py-2 right-4 rounded-circle top-3 zindex-100  add_to_wishlist wishlist_{{ $topRatedProduct->product->id }}"
                                                        data-id="{{ $topRatedProduct->product->id }}">
                                                        <i class="far fa-heart text-white"></i>
                                                    </button>
                                                @endif
                                            @else
                                                <button data-toggle="tooltip" data-original-title="Wishlist"
                                                    type="button"
                                                    class="badge badge-primary border-0 p-0 position-absolute px-2 py-2 right-4 rounded-circle top-3 zindex-100  add_to_wishlist wishlist_{{ $topRatedProduct->product->id }}"
                                                    data-id="{{ $topRatedProduct->product->id }}">
                                                    <i class="far fa-heart text-white"></i>
                                                </button>
                                            @endif
                                        </div>
                                        <div class="card-image col-9 mx-auto pt-4 pb-4">

                                            <a
                                                href="{{ route('store.product.product_view', [$store->slug, $topRatedProduct->product->id]) }}">
                                                @if (!empty($topRatedProduct->product->is_cover) &&
                                                    \Storage::exists('uploads/is_cover_image/' . $topRatedProduct->product->is_cover))
                                                    <img alt="Image placeholder"
                                                        src="{{ $productImg . $topRatedProduct->product->is_cover }}"
                                                        class="img-center img-fluid topratedImage">
                                                @else
                                                    <img alt="Image placeholder"
                                                        src="{{ asset(Storage::url('uploads/is_cover_image/default.jpg')) }}"
                                                        class="img-center img-fluid topratedImage">
                                                @endif
                                            </a>

                                        </div>
                                        <div class="card-body pt-0 pb-4 px-4 px-md-3 px-lg-4">
                                            <h6>
                                                <a class="font-weight-300 text-primary"
                                                    href="{{ route('store.product.product_view', [$store->slug, $topRatedProduct->product->id]) }}">
                                                    <span class="font-weight-600">
                                                        {{ $topRatedProduct->product->name }}
                                                    </span>
                                                </a>
                                            </h6>
                                            <div class="mb-3">
                                                <span class="font-size-12 font-weight-600 text-primary">
                                                    <svg width="14" height="14" viewBox="0 0 14 14"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-1">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M5.6846 1.54449C6.14218 0.144023 8.10781 0.144027 8.5654 1.54449L9.38429 4.05075C9.41301 4.13865 9.4936 4.19876 9.5854 4.20075L12.1696 4.25677C13.5864 4.28749 14.191 6.08576 13.0846 6.97816L10.9486 8.70091C10.8804 8.75594 10.8516 8.84689 10.8757 8.93155L11.6348 11.6008C12.0332 13.0019 10.4448 14.1165 9.27925 13.2537L7.25325 11.7538C7.17694 11.6973 7.07306 11.6973 6.99675 11.7538L4.97074 13.2537C3.80522 14.1165 2.21676 13.0019 2.61521 11.6008L3.37428 8.93155C3.39835 8.84689 3.36961 8.75594 3.30138 8.70091L1.16544 6.97816C0.0590049 6.08576 0.663576 4.28749 2.08036 4.25677L4.6646 4.20075C4.7564 4.19876 4.83699 4.13865 4.86571 4.05075L5.6846 1.54449ZM7.33077 1.95425C7.2654 1.75419 6.9846 1.75419 6.91923 1.95425L6.10034 4.46051C5.89929 5.07584 5.33518 5.49658 4.69255 5.51051L2.10831 5.56653C1.90592 5.57092 1.81955 5.82782 1.97761 5.9553L4.11356 7.67806C4.59113 8.06325 4.79234 8.69988 4.62381 9.2925L3.86474 11.9617C3.80782 12.1619 4.03475 12.3211 4.20125 12.1978L6.22726 10.698C6.76144 10.3025 7.48855 10.3025 8.02274 10.698L10.0487 12.1978C10.2153 12.3211 10.4422 12.1619 10.3853 11.9617L9.62618 9.2925C9.45765 8.69988 9.65887 8.06324 10.1364 7.67806L12.2724 5.9553C12.4305 5.82782 12.3441 5.57092 12.1417 5.56653L9.55745 5.51051C8.91482 5.49658 8.35071 5.07584 8.14966 4.46051L7.33077 1.95425Z"
                                                            fill="#8A8A8A" />
                                                    </svg>
                                                    {{ $topRatedProduct->product->product_rating() }} /
                                                    {{ __('5.0') }}
                                                </span>
                                                <span class="text-primary mx-1">•</span>
                                                <span class="font-size-12  text-primary">
                                                    <b class="font-weight-600 text-lg text-primary">
                                                        @if ($topRatedProduct->product->enable_product_variant == 'on')
                                                            {{ __('In variant') }}
                                                        @else
                                                            {{ \App\Models\Utility::priceFormat($topRatedProduct->product->price) }}
                                                        @endif

                                                    </b>
                                                </span>
                                                <span class="font-weight-600 text-lg text-primary sub-price">
                                                    @if ($topRatedProduct->product->enable_product_variant == 'off')
                                                        {{ \App\Models\Utility::priceFormat($topRatedProduct->product->last_price) }}
                                                    @endif
                                                </span>
                                            </div>
                                            {{-- <button type="button"
                                                class="border-0 btn btn-block btn-primary rounded-pill">
                                                ADD TO
                                                CART
                                            </button> --}}

                                            @if ($topRatedProduct->product->enable_product_variant == 'on')
                                                <a href="{{ route('store.product.product_view', [$store->slug, $topRatedProduct->product->id]) }}"
                                                    class="border-0 btn btn-block btn-secondary  rounded-pill">
                                                    {{ __('ADD TO CART') }}
                                                </a>
                                            @else
                                                <a href="javascript:void(0)"
                                                    class="border-0 btn btn-block btn-secondary  rounded-pill add_to_cart"
                                                    data-id="{{ $topRatedProduct->product->id }}">
                                                    {{ __('ADD TO CART') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                    </div>
                    <!-- Add Arrow -->
                    <div class="swiper-button-prev swiper-button-disabled left-2" tabindex="0" role="button"
                        aria-label="Previous slide" aria-disabled="true"></div>
                    <div class="swiper-button-next right-2" tabindex="0" role="button" aria-label="Next slide"
                        aria-disabled="false"></div>
                </div>
            </div>
        @endif
    </section>


    <!-- Image with Text -->
    {{-- @DD($getStoreThemeSetting) --}}
    @foreach ($getStoreThemeSetting as $ThemeSetting)
        @if (isset($ThemeSetting['section_name']) &&
            $ThemeSetting['section_name'] == 'Top-Purchased' &&
            $ThemeSetting['section_enable'] == 'on')
            @php

                $homepage_header_title_key = array_search('Title', array_column($ThemeSetting['inner-list'], 'field_name'));
                $homepage_header_title = $ThemeSetting['inner-list'][$homepage_header_title_key]['field_default_text'];

                $homepage_header_subtext_key = array_search('Sub text', array_column($ThemeSetting['inner-list'], 'field_name'));
                $homepage_header_subtext = $ThemeSetting['inner-list'][$homepage_header_subtext_key]['field_default_text'];

                $homepage_header_btn_key = array_search('Button Text', array_column($ThemeSetting['inner-list'], 'field_name'));
                $homepage_header_btn = $ThemeSetting['inner-list'][$homepage_header_btn_key]['field_default_text'];
            @endphp
            <section class="image-with-text pt-md-4 most-purchased">
                <div class="container pb-5 py-md-0">
                    <div class="row">

                        <div class="col-md-6 mx-auto">
                            <div class="position-relative">
                                @foreach ($mostPurchased as $product)
                                    <a
                                        href="{{ route('store.product.product_view', [$store->slug, $product->productImg($product->product_id)->id]) }}">
                                        @if (!empty($product->productImg($product->product_id)->is_cover) &&
                                            \Storage::exists('uploads/is_cover_image/' . $product->productImg($product->product_id)->is_cover))
                                            <img alt="Image placeholder"
                                                src="{{ $productImg . $product->productImg($product->product_id)->is_cover }}"
                                                class="img-center img-fluid rounded-md">
                                        @else
                                            <img alt="Image placeholder"
                                                src="{{ asset(Storage::url('uploads/is_cover_image/default.jpg')) }}"
                                                class="img-center img-fluid rounded-md">
                                        @endif
                                    </a>
                                @endforeach

                            </div>
                        </div>
                        <div class="col-md-6 mb-4 mb-md-0 pt-5">
                            <h4 class="mb-4 text-primary title-size font-weight-300">
                                <span class="font-weight-600 d-block">
                                    {{ $homepage_header_title }}
                                </span>
                            </h4>
                            <p class="col-md-10 font-size-12 font-weight-300 mb-4 px-0 text-primary">
                                {{ $homepage_header_subtext }}
                            </p>
                            @foreach ($mostPurchased as $product)
                                <a href="{{ route('store.product.product_view', [$store->slug, $product->productImg($product->product_id)->id]) }}"
                                    class="btn btn-primary px-6 rounded-pill text-capitalize">
                                    {{ $homepage_header_btn }}</a>
                            @endforeach

                        </div>

                    </div>
                </div>
            </section>
        @endif
    @endforeach



    <!-- Quick Services -->
    @if ($getStoreThemeSetting[4]['section_enable'] == 'on')
        <div class="quick-services bg-primary mt-md-n5 py-5">
            <div class="container">
                <div class="row no-gutters position-relative zindex-100">
                    @foreach ($getStoreThemeSetting as $key => $storethemesetting)
                        @if ($storethemesetting['section_name'] == 'Home-Promotions' &&
                            $storethemesetting['array_type'] == 'multi-inner-list')
                            @if (isset($storethemesetting['homepage-promotions-font-icon']) ||
                                isset($storethemesetting['homepage-promotions-title']) ||
                                isset($storethemesetting['homepage-promotions-description']))
                                @for ($i = 0; $i < $storethemesetting['loop_number']; $i++)
                                    <div class="col-md-4">
                                        <div class="py-md-5 py-4 px-4 service-item">
                                            <span class="d-block mb-3">
                                                {!! $storethemesetting['homepage-promotions-font-icon'][$i] !!}
                                            </span>
                                            <h5 class="font-weight-500 text-white mb-3">
                                                {{ $storethemesetting['homepage-promotions-title'][$i] }}
                                            </h5>
                                            <p class="font-size-12 text-white">
                                                {{ $storethemesetting['homepage-promotions-description'][$i] }}</p>
                                        </div>
                                    </div>
                                @endfor
                            @else
                                @for ($i = 0; $i < $storethemesetting['loop_number']; $i++)
                                    <div class="col-md-4">
                                        <div class="py-md-5 py-4 px-4 service-item">
                                            <span class="d-block mb-3">
                                                {!! $storethemesetting['inner-list'][0]['field_default_text'] !!}
                                            </span>
                                            <h5 class="font-weight-500 text-white mb-3">
                                                {{ $storethemesetting['inner-list'][1]['field_default_text'] }}</h5>
                                            </h5>
                                            <p class="font-size-12 text-white">
                                                {{ $storethemesetting['inner-list'][2]['field_default_text'] }}</p>
                                        </div>
                                    </div>
                                @endfor
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- Products -->
    <section class="bestsellers-section pt-3">
        <div class="container">
            <div class="col-12 d-flex align-items-center justify-content-between ">

                <ul class="tabs " role="tablist" id="myTab">

                    @foreach ($categories as $key => $category)
                        <li class="index-categories px-1">
                            <a href="#{!! preg_replace('/[^A-Za-z0-9\-]/', '_', $category) !!}" data-id="{{ $key }}"
                                class="{{ $key == 0 ? 'active' : '' }} productTab bg-primary" id="electronic-tab"
                                data-toggle="tab" role="tab" aria-controls="home" aria-selected="false">
                                {{ __($category) }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                <div class="col-md-6 text-md-right">
                    <a href="{{ route('store.categorie.product', [$store->slug, 'Start shopping']) }}"
                        class="btn btn-primary">{{ __('GO TO SHOP') }}</a>
                </div>

            </div>
        </div>

        <div class="container">

            <div class="bestsellers-tabs mt-5">
                @foreach ($products as $key => $items)
                    <div class="col-lg-12 px-0 tab-content row {{ $key == 'Start shopping' ? 'active ' : '' }} "
                        id="{!! preg_replace('/[^A-Za-z0-9\-]/', '_', $key) !!}" role="tabpanel" aria-labelledby="shopping-tab">
                        @foreach ($items as $key => $product)
                            @if ($key < 4)
                                <div class="col-lg-3 col-sm-6 col-md-4 product-box swiper-slide">
                                    <div class="border-0 card card-product rounded-lg">
                                        <div  class="align-items-center border-0 card-header d-flex justify-content-between p-0 pt-4 pr-3">
                                            @if (Auth::guard('customers')->check())
                                                @if (!empty($wishlist) && isset($wishlist[$product->id]['product_id']))
                                                    @if ($wishlist[$product->id]['product_id'] != $product->id)
                                                        <button data-toggle="tooltip" data-original-title="Wishlist"
                                                            type="button"
                                                            class="badge badge-primary border-0 p-0 position-absolute px-2 py-2 right-4 rounded-circle top-3 zindex-100  add_to_wishlist wishlist_{{ $product->id }}"
                                                            data-id="{{ $product->id }}">
                                                            <i class="far fa-heart text-white"></i>
                                                        </button>
                                                    @else
                                                        <button data-toggle="tooltip" data-original-title="Wishlist"
                                                            type="button"
                                                            class="badge badge-primary border-0 p-0 position-absolute px-2 py-2 right-4 rounded-circle top-3 zindex-100 "
                                                            data-id="{{ $product->id }}" disabled>
                                                            <i class="fas fa-heart text-white"></i>
                                                        </button>
                                                    @endif
                                                @else
                                                    <button data-toggle="tooltip" data-original-title="Wishlist"
                                                        type="button"
                                                        class="badge badge-primary border-0 p-0 position-absolute px-2 py-2 right-4 rounded-circle top-3 zindex-100  add_to_wishlist wishlist_{{ $product->id }}"
                                                        data-id="{{ $product->id }}">
                                                        <i class="far fa-heart text-white"></i>
                                                    </button>
                                                @endif
                                            @else
                                                <button data-toggle="tooltip" data-original-title="Wishlist"
                                                    type="button"
                                                    class="badge badge-primary border-0 p-0 position-absolute px-2 py-2 right-4 rounded-circle top-3 zindex-100  add_to_wishlist wishlist_{{ $product->id }}"
                                                    data-id="{{ $product->id }}">
                                                    <i class="far fa-heart text-white"></i>
                                                </button>
                                            @endif
                                        </div>
                                        <div class="card-image col-9 mx-auto pt-4 pb-4">
                                            <a
                                                href="{{ route('store.product.product_view', [$store->slug, $product->id]) }}">
                                                @if (!empty($product->is_cover) && \Storage::exists('uploads/is_cover_image/' . $product->is_cover))
                                                    <img alt="Image placeholder"
                                                        src="{{ $productImg . $product->is_cover }}"
                                                        class="img-center img-fluid">
                                                @else
                                                    <img alt="Image placeholder"
                                                        src="{{ asset(Storage::url('uploads/is_cover_image/default.jpg')) }}"
                                                        class="img-center img-fluid">
                                                @endif
                                            </a>
                                        </div>
                                        <div class="card-body pt-0 pb-4 px-4 px-md-3 px-lg-4">
                                            <h6>
                                                <a class="font-weight-300 text-primary"
                                                    href="{{ route('store.product.product_view', [$store->slug, $product->id]) }}">
                                                    <span class="font-weight-600">
                                                        {{ $product->name }}
                                                    </span>

                                                </a>
                                            </h6>
                                            <p class="text-sm">
                                                <span class="td-gray">{{ __('Category:') }}</span>
                                                {{ $product->categories->name }}
                                            </p>
                                            <div class="mb-3">
                                                <span class="font-weight-600 text-lg text-primary">
                                                    @if ($product->enable_product_variant == 'on')
                                                        {{ __('In variant') }}
                                                    @else
                                                        {{ \App\Models\Utility::priceFormat($product->price) }}
                                                        <span class="font-weight-500 text-sm text-primary sub-price">
                                                            @if ($product->enable_product_variant == 'off')
                                                                {{ \App\Models\Utility::priceFormat($product->last_price) }}
                                                            @endif
                                                        </span>
                                                    @endif
                                                </span>
                                                <div>
                                                    <span class="font-size-12 font-weight-600 text-primary">
                                                        <svg width="14" height="14" viewBox="0 0 14 14"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg"
                                                            class="mr-1">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M5.6846 1.54449C6.14218 0.144023 8.10781 0.144027 8.5654 1.54449L9.38429 4.05075C9.41301 4.13865 9.4936 4.19876 9.5854 4.20075L12.1696 4.25677C13.5864 4.28749 14.191 6.08576 13.0846 6.97816L10.9486 8.70091C10.8804 8.75594 10.8516 8.84689 10.8757 8.93155L11.6348 11.6008C12.0332 13.0019 10.4448 14.1165 9.27925 13.2537L7.25325 11.7538C7.17694 11.6973 7.07306 11.6973 6.99675 11.7538L4.97074 13.2537C3.80522 14.1165 2.21676 13.0019 2.61521 11.6008L3.37428 8.93155C3.39835 8.84689 3.36961 8.75594 3.30138 8.70091L1.16544 6.97816C0.0590049 6.08576 0.663576 4.28749 2.08036 4.25677L4.6646 4.20075C4.7564 4.19876 4.83699 4.13865 4.86571 4.05075L5.6846 1.54449ZM7.33077 1.95425C7.2654 1.75419 6.9846 1.75419 6.91923 1.95425L6.10034 4.46051C5.89929 5.07584 5.33518 5.49658 4.69255 5.51051L2.10831 5.56653C1.90592 5.57092 1.81955 5.82782 1.97761 5.9553L4.11356 7.67806C4.59113 8.06325 4.79234 8.69988 4.62381 9.2925L3.86474 11.9617C3.80782 12.1619 4.03475 12.3211 4.20125 12.1978L6.22726 10.698C6.76144 10.3025 7.48855 10.3025 8.02274 10.698L10.0487 12.1978C10.2153 12.3211 10.4422 12.1619 10.3853 11.9617L9.62618 9.2925C9.45765 8.69988 9.65887 8.06324 10.1364 7.67806L12.2724 5.9553C12.4305 5.82782 12.3441 5.57092 12.1417 5.56653L9.55745 5.51051C8.91482 5.49658 8.35071 5.07584 8.14966 4.46051L7.33077 1.95425Z"
                                                                fill="#8A8A8A" />
                                                        </svg>

                                                        {{ $product->product_rating() }} / {{ __('5.0') }}
                                                    </span>
                                                </div>
                                                @if ($product->enable_product_variant == 'on')
                                                    <a href="{{ route('store.product.product_view', [$store->slug, $product->id]) }}"
                                                        class="border-0 btn btn-block btn-primary rounded-pill">
                                                        {{ __('ADD TO CART') }}
                                                    </a>
                                                @else
                                                    <a href="javascript:void(0)"
                                                        class="border-0 btn btn-block btn-primary rounded-pill add_to_cart"
                                                        data-id="{{ $product->id }}">
                                                        {{ __('ADD TO CART') }}
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </div>
                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                @endforeach
            </div>

        </div>

    </section>


    <section class="featured-collection">
        <div class="container">
            <div class="row">
                {{-- @DD($pro_categories) --}}
                @foreach ($latest2category as $key_c => $category)
                    @if ($key_c < 2)
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="item overflow-hidden position-relative rounded-lg category-1">
                                @if (!empty($category->categorie_img) && \Storage::exists('uploads/product_image/' . $category->categorie_img))
                                    <img alt="Image placeholder"
                                        src="{{ $catimg . (!empty($category->categorie_img) ? $category->categorie_img : 'default.jpg') }}">
                                @else
                                    <img alt="Image placeholder"
                                        src="{{ asset(Storage::url('uploads/product_image/default.jpg')) }}">
                                @endif
                                <div
                                    class="bottom-0 caption col-md-11 col-lg-8 left-0 pb-3 pl-3 pb-lg-5 pl-lg-5 position-absolute">
                                    <h2 class="font-weight-300 mb-4 text-white">
                                        <span class="font-weight-600">
                                            {{ $category->name }}
                                        </span>

                                    </h2>
                                    <a href="{{ route('store.categorie.product', [$store->slug, $category->name]) }}"
                                        class="btn btn-white rounded-pill text-primary">
                                        {{ __('VIEW') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

            </div>
        </div>
    </section>


    <!-- Image with Text -->
    @php

        $homepage_header_text = $homepage_header_btn = $homepage_header_bg_img = '';
        $homepage_header_2_key = array_search('Central-Banner', array_column($getStoreThemeSetting, 'section_name'));

        if (!empty($getStoreThemeSetting[$homepage_header_2_key])) {
            $homepage_header_2 = $getStoreThemeSetting[$homepage_header_2_key];
        }

    @endphp

    @for ($i = 0; $i < $homepage_header_2['loop_number']; $i++)
        @php
            foreach ($homepage_header_2['inner-list'] as $homepage_header_2_value) {
                if ($homepage_header_2_value['field_slug'] == 'bannner-title') {
                    $homepage_header_sub_title = $homepage_header_2_value['field_default_text'];
                }

                if ($homepage_header_2_value['field_slug'] == 'central-sub-text') {
                    $homepage_header_sub_text = $homepage_header_2_value['field_default_text'];
                }
                if ($homepage_header_2_value['field_slug'] == 'central-header-button') {
                    $homepage_header_btn = $homepage_header_2_value['field_default_text'];
                }
                if ($homepage_header_2_value['field_slug'] == 'central-header-bg-image') {
                    $homepage_header_bg_img = $homepage_header_2_value['field_default_text'];
                }

                if (!empty($homepage_header_2[$homepage_header_2_value['field_slug']])) {
                    if ($homepage_header_2_value['field_slug'] == 'bannner-title') {
                        $homepage_header_sub_title = $homepage_header_2[$homepage_header_2_value['field_slug']][$i];
                    }
                    if ($homepage_header_2_value['field_slug'] == 'central-sub-text') {
                        $homepage_header_sub_text = $homepage_header_2[$homepage_header_2_value['field_slug']][$i];
                    }
                    if ($homepage_header_2_value['field_slug'] == 'central-header-button') {
                        $homepage_header_btn = $homepage_header_2[$homepage_header_2_value['field_slug']][$i];
                    }
                    if ($homepage_header_2_value['field_slug'] == 'central-header-bg-image') {
                        $homepage_header_bg_img = $homepage_header_2[$homepage_header_2_value['field_slug']][$i]['field_prev_text'];
                    }
                }
            }
        @endphp
        @if ($getStoreThemeSetting[5]['section_enable'] == 'on')
            <section class="mt-4 mt-md-n6 pt-5 pb-5 pb-md-9 pt-md-5 w-100"
                style="background-image: url({{ $imgpath . $homepage_header_bg_img }}); background-position: center center;">
                <div class="container pt-md-9">
                    <div class="row align-items-center">
                        <div class="col-md-8 col-lg-6 text-center mx-auto">
                            <h2 class="store-title text-white">
                                <span class="font-weight-600">
                                    {{ $homepage_header_sub_title }}
                                </span>
                            </h2>
                            <p class="col-md-10 mt-4 px-0 store-dcs text-white">
                                {{ $homepage_header_sub_text }}

                            </p>
                            <div>
                                <a href="{{ route('store.categorie.product', [$store->slug, 'Start shopping']) }}"
                                    class="btn btn-outline-white mt-4 mr-4">{{ $homepage_header_btn }}</a>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        @endif
    @endfor


    <!-- Articles -->
    @if ($getStoreThemeSetting[6]['section_enable'] == 'on')
        <section class="slice categorie-section pt-6 pb-4 position-relative">
            <div class="container">
                @foreach ($getStoreThemeSetting as $storethemesetting)
                    @if (isset($storethemesetting['section_name']) &&
                        $storethemesetting['section_name'] == 'Home-Categories' &&
                        !empty($pro_categories))
                        @php
                            $Titlekey = array_search('Title', array_column($storethemesetting['inner-list'], 'field_name'));
                            $Title = $storethemesetting['inner-list'][$Titlekey]['field_default_text'];

                            $Description_key = array_search('Description', array_column($storethemesetting['inner-list'], 'field_name'));
                            $Description = $storethemesetting['inner-list'][$Description_key]['field_default_text'];
                        @endphp
                        <div class="row">
                            <div class="col-lg-6 mx-auto">
                                <div class="mb-5 text-center">
                                    <h2 class="my-3 text-primary text-uppercase font-weight-600">{{ $Title }}</h2>
                                    <p class="font-size-12">
                                        {{ $Description }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                <div class="row mx-n2">

                    @foreach ($pro_categories as $pro_categorie)
                        <div
                            class="col-sm-6  px-2 mb-3 mb-md-0 {{ count($pro_categories) == 4 ? 'col-md-3' : 'col-md-4' }}">
                            <div class="cat-box overflow-hidden position-relative rounded-lg">
                                @if (!empty($pro_categorie->categorie_img) &&
                                    \Storage::exists('uploads/product_image/' . $pro_categorie->categorie_img))
                                    <img alt="Image placeholder"
                                        src="{{ $catimg . (!empty($pro_categorie->categorie_img) ? $pro_categorie->categorie_img : 'default.jpg') }}">
                                @else
                                    <img alt="Image placeholder"
                                        src="{{ asset(Storage::url('uploads/product_image/default.jpg')) }}">
                                @endif
                                <div
                                    class="bottom-0 caption left-0 pb-5 px-5 px-sm-3 px-lg-5 pb-sm-3 pb-lg-5 position-absolute">
                                    <p class="ls-2 mb-2 text-small text-white"></p>
                                    <h4 class="font-weight-300 mb-4 text-white">
                                        <span class="font-weight-600 d-block">
                                            {{ $pro_categorie->name }}
                                        </span>
                                    </h4>
                                    <p class="font-size-12 text-white">
                                    </p>


                                    <a href="{{ route('store.categorie.product', [$store->slug, $pro_categorie->name]) }}"
                                        class="btn btn-white rounded-pill text-primary btn-block ">{{ __('VIEW') }}</a>

                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
    @endif

    <!-- Testimonials (v1) -->
    @if ($getStoreThemeSetting[7]['section_enable'] == 'on')
        <section class="slice testimonial-section pb-md-7 pt-md-5">
            <div class="container pt-4">
                <h2 class="text-center text-primary title-size mb-3">
                    {{ $getStoreThemeSetting[7]['inner-list'][0]['field_default_text'] }}</h2>
                <div class="testimonial-slider position-relative">
                    <div class="swiper-js-container position-relative">

                        <div class="swiper-container" data-swiper-items="1" data-swiper-space-between="0"
                            data-swiper-sm-items="1" data-swiper-xl-items="1">
                            <div class="swiper-wrapper">

                                {{-- <div class="swiper-slide p-3">
                                <div class="border-0 card rounded-0 shadow-none text-center bg-transparent">
                                    <div class="card-body p-3 col-md-10 col-lg-8 mx-auto">
                                        <h5 class="text-primary font-weight-300 mb-4">
                                            Contrary to popular belief, Lorem
                                            Ipsum is not simply random text. It has roots in a piece of classical Latin
                                            literature from 45 BC, making it over 2000 years old.
                                        </h5>
                                        <p
                                            class="align-items-center d-flex justify-content-center text-primary font-size-12 mb-0">
                                            <span class="badge-circle badge-md badge-primary mr-3"></span>
                                            <span
                                                class="font-weight-600">JOHN DOE,
                                             </span> COMPANY.COM
                                        </p>
                                    </div>
                                </div>
                            </div> --}}

                                @foreach ($getStoreThemeSetting as $key => $storethemesetting)
                                    @if (isset($storethemesetting['section_name']) &&
                                        $storethemesetting['section_name'] == 'Home-Testimonial' &&
                                        $storethemesetting['array_type'] == 'multi-inner-list')
                                        @if (isset($storethemesetting['homepage-testimonial-card-image']) ||
                                            isset($storethemesetting['homepage-testimonial-card-title']) ||
                                            isset($storethemesetting['homepage-testimonial-card-sub-text']) ||
                                            isset($storethemesetting['homepage-testimonial-card-description']) ||
                                            isset($storethemesetting['homepage-testimonial-card-enable']))
                                            @for ($i = 0; $i < $storethemesetting['loop_number']; $i++)
                                                @if ($storethemesetting['homepage-testimonial-card-enable'][$i] == 'on')
                                                    <div class="swiper-slide p-3">
                                                        <div
                                                            class="border-0 card rounded-0 shadow-none text-center bg-transparent">
                                                            <div class="card-body p-3 col-md-10 col-lg-8 mx-auto">
                                                                <div class="message">
                                                                    <h5 class="text-primary font-weight-300 mb-4">
                                                                        {{ $storethemesetting['homepage-testimonial-card-description'][$i] }}
                                                                    </h5>
                                                                    <p
                                                                        class="align-items-center d-flex justify-content-center text-primary font-size-12 mb-0">

                                                                        <img alt="Image placeholder"
                                                                            src="{{ $imgpath . $storethemesetting['homepage-testimonial-card-image'][$i]['field_prev_text'] }}"
                                                                            class=" badge-circle badge-md badge-white mr-3">

                                                                        <span class="font-weight-600">
                                                                            {{ $storethemesetting['homepage-testimonial-card-title'][$i] }}
                                                                        </span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endfor
                                        @else
                                            @for ($i = 0; $i < $storethemesetting['loop_number']; $i++)
                                                <div class="swiper-slide p-3">
                                                    <div
                                                        class="border-0 card rounded-0 shadow-none text-center bg-transparent">
                                                        <div class="card-body p-3 col-md-10 col-lg-8 mx-auto">
                                                            <div class="message">
                                                                <h5 class="text-primary font-weight-300 mb-4">
                                                                    {{ $storethemesetting['inner-list'][3]['field_default_text'] }}
                                                                </h5>
                                                                <p
                                                                    class="align-items-center d-flex justify-content-center text-primary font-size-12 mb-0">

                                                                    <img alt="Image placeholder"
                                                                        src="{{ $imgpath . (!empty($storethemesetting['inner-list'][1]['field_default_text']) ? $storethemesetting['inner-list'][1]['field_default_text'] : 'avatar.png') }}"
                                                                        class=" badge-circle badge-md badge-white mr-3">
                                                                    <span class="font-weight-600">
                                                                        {{ $storethemesetting['inner-list'][2]['field_default_text'] }}
                                                                    </span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endfor
                                        @endif
                                    @endif
                                @endforeach

                            </div>
                        </div>
                        <!-- Add Pagination -->
                        <div class="swiper-pagination w-100 mt-1 d-flex align-items-center justify-content-center"></div>

                        <!-- Add Arrow -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection

@push('script-page')
    <script>
        $(document).ready(function() {
            $("#myTab li:eq(0)").addClass('active');
        });
        // Tab js
        $('ul.tabs li').click(function() {
            // alert('hello')
            var $this = $(this);
            var $theTab = $(this).attr('data-tab');
            if ($this.hasClass('active')) {} else {
                $this.closest('.tabs-wrapper').find('ul.tabs li, .tabs-container .tab-content').removeClass(
                    'active');
                $('.tabs-container .tab-content[id="' + $theTab + '"], ul.tabs li[data-tab="' + $theTab + ']')
                    .addClass('active');
            }
            $('ul.tabs li').removeClass('active');
            $(this).addClass('active');
            // $('.product-tab-slider').slick('refresh');
        });

        $(".productTab").click(function(e) {
            e.preventDefault();
            $('.productTab').removeClass('active')

        });


        $("#start_shopping").click(function() {
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#shopping_section").offset().top
            }, 2000);
        });
    </script>
    <script>
        $(document).on('change', '.variant-selection', function() {

            var variants = [];

            $(this).each(function(index, element) {

                variants.push(element.value);
            });

            let product_id = $(this).closest(".card-body").find('.product_id').val();
            let variation_price = $(this).closest(".card-product").find('.variation_price');

            if (variants.length > 0) {

                $.ajax({
                    url: '{{ route('get.products.variant.quantity') }}',
                    data: {
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                        variants: variants.join(' : '),
                        product_id: product_id
                    },


                    success: function(data) {

                        variation_price.html(data.price);
                        $('#variant_id').val(data.variant_id);
                        $('#variant_qty').val(data.quantity);
                    }
                });
            }
        });
    </script>
@endpush
